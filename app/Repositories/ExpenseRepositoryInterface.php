<?php

namespace App\Repositories;

interface ExpenseRepositoryInterface {

    public function create(array $data);

    public function update($id, array $data);

    public function updateStatus(int $expenseId, int $statusId);
    
}