<?php

namespace App\Repositories;

use App\Models\Approval;
use App\Models\ApprovalStage;

class ApprovalRepository implements ApprovalRepositoryInterface {

    public function create(array $data) {
        return Approval::create($data);
    }

    public function approveExpense(array $data) {
        return Approval::create($data);
    }

    public function getPendingApprovals(int $expenseId) {
        $pending = Approval::where('expense_id', $expenseId)
                ->whereNull('status_id')
                ->orderBy('id')
                ->first();

        if (!$pending) {
            // Jika belum ada approval, pilih approver pertama berdasarkan ApprovalStage
            return Approval::create([
                'expense_id' => $expenseId,
                'approver_id' => ApprovalStage::orderBy('id')->first()->approver_id,
                'status_id' => null
            ]);
        }

        return $pending;
    }
    
}