<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Approver",
 *     type="object",
 *     title="Approver",
 *     description="Approver Model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe")
 * )
 */

class Approver extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
}
