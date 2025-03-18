<?php

namespace App\Repositories;

use App\Models\Approver;

class ApproverRepository implements ApproverRepositoryInterface
{
    public function getAll()
    {
        return Approver::all();
    }

    public function findById(int $id)
    {
        return Approver::findOrFail($id);
    }

    public function create(array $data)
    {
        return Approver::create($data);
    }
}
