<?php

namespace App\Services;

use App\Repositories\ApprovalRepositoryInterface;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApprovalService {

    protected $approvalRepository;
    protected $expenseRepository;

    public function __construct(ApprovalRepositoryInterface $approvalRepository, ExpenseRepositoryInterface $expenseRepository) {
        $this->approvalRepository = $approvalRepository;
        $this->expenseRepository = $expenseRepository;
    }

    public function approveExpense(array $data) {
        return DB::transaction(function () use ($data) {
            $pendingApproval = $this->approvalRepository->getPendingApprovals($data['expense_id']);
            if (!$pendingApproval || $pendingApproval->approver_id != $data['approver_id']) {
                throw new \Exception("Approval must follow the correct sequence.");
            }
            $pendingApproval->update(['status_id' => $data['status_id']]);
            if (!$this->approvalRepository->getPendingApprovals($data['expense_id'])) {
                $this->expenseRepository->updateStatus($data['expense_id'], 2);
            }
            return $pendingApproval;
        });
    }

    public function createApproval(array $data) {
        return DB::transaction(fn() => $this->approvalRepository->create($data));
    }

}