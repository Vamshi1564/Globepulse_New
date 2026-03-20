<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceListModel extends Model
{
    use HasFactory;
    protected $table = 'tbladd_service_list';
    public $timestamps = false;

    protected $fillable = [
        'priority_sequence',
        'name',
        'group_title',
        'status',
        'price',
        'task_completion_day',
        'assigned_staffid',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'assigned_staffid');
    }
}
