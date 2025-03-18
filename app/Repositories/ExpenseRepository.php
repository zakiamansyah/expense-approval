<?php

namespace App\Repositories;

use App\Models\Expense;

class ExpenseRepository implements ExpenseRepositoryInterface {

    public function create(array $data) {
        return Expense::create($data);
    }
    
    public function update($id, array $data) {
        return Expense::where('id', $id)->update($data);
    }

    public function updateStatus(int $expenseId, int $statusId) {
        return Expense::where('id', $expenseId)->update(['status_id' => $statusId]);
    }
    
    public function getExpense(int $expenseId) {
        return Expense::with(['status', 'approvals.approver'])->findOrFail($expenseId);
    }

}