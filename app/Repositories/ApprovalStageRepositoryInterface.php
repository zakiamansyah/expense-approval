<?php

namespace App\Repositories;

interface ApprovalStageRepositoryInterface {

    public function create(array $data);

    public function update($id, array $data);
}