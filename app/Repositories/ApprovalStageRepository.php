<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

class ApprovalStageRepository implements ApprovalStageRepositoryInterface {
    
    public function create(array $data) {
        return ApprovalStage::create($data);
    }

    public function update($id, array $data) {
        $approvalStage = ApprovalStage::findOrFail($id);
        $approvalStage->update($data);
        return $approvalStage;
    }
}