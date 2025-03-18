<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'status_id'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function approvals() {
        return $this->hasMany(Approval::class);
    }

    public function checkAndUpdateStatus()
    {
        $totalApprovals = $this->approvals()->count();
        $approvedCount = $this->approvals()->where('status_id', 2)->count();

        $totalApprovers = ApprovalStage::count();
        if ($totalApprovers > 0 && $totalApprovers == $approvedCount) {
            $this->update(['status_id' => 2]); // Ubah status menjadi "Disetujui"
        }
    }

}
