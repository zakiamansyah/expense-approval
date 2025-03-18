<?php

namespace App\Repositories;

use App\Models\Approver;

interface ApproverRepositoryInterface
{
    public function getAll();
    public function findById(int $id);
    public function create(array $data);
}
