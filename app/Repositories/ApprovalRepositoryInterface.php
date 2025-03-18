<?php

namespace App\Repositories;

interface ApprovalRepositoryInterface {

    public function create(array $data);
    public function approveExpense(array $data);
    public function getPendingApprovals(int $expenseId);
}