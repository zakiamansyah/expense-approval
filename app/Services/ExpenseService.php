<?php

namespace App\Services;

use App\Models\Expense;
use App\Repositories\ApprovalRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovalStage;
use App\Models\Approval;

class ExpenseService {

    protected $expenseRepository;
    protected $approvalRepository;

    public function __construct(ExpenseRepository $expenseRepository, ApprovalRepository $approvalRepository) {
        $this->expenseRepository = $expenseRepository;
        $this->approvalRepository = $approvalRepository;
    }

    public function approveExpense($expenseId, array $data)
{
    return DB::transaction(function () use ($expenseId, $data) {
        $pendingApproval = $this->approvalRepository->getPendingApprovals($expenseId);

        // Jika belum ada approval, izinkan approver pertama
        if (!$pendingApproval) {
            $firstApprover = ApprovalStage::orderBy('id')->first();
            if ($firstApprover->approver_id == $data['approver_id']) {
                Approval::create([
                    'expense_id' => $expenseId,
                    'approver_id' => $data['approver_id'],
                    'status_id' => 2
                ]);
                return;
            }
        }

        // Jika sudah ada approval, cek apakah approval dilakukan secara berurutan
        if ($pendingApproval->approver_id != $data['approver_id']) {
            throw new \Exception("Approval must follow the correct sequence.");
        }

        // Perbarui status approval
        $pendingApproval->update(['status_id' => 2]);

        return $pendingApproval;
    });
}


    public function getExpense($expenseId) {
        return $this->expenseRepository->getExpense($expenseId);
    }

    public function createExpense(array $data) {
        return DB::transaction(function () use ($data) {
            $data['status_id'] = 1;
            return $this->expenseRepository->create($data);
        });
    }
}