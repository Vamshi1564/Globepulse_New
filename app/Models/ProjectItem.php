<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    use HasFactory;
    protected $table = 'tbl_projectitem';

    protected $fillable = [
        'projectid',
        'project_name',
        'price',
        'groupid',
        'receive_amount',
        'discount',
        'lead_id',
        'payment_verify',
        'description',
        'invoice_id',
        'project_completion_days',
        'created_at',
        'updated_at',
    ];

    public function batches()
    {
        return $this->hasMany(ProjectItemBatch::class, 'projectitem_id');
    }
}
