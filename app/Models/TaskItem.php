<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    use HasFactory;
    protected $table = 'tbl_taskitem';
    // public $timestamps = false; 
    protected $fillable = [
        'task_name',
        'status',
        'projectitemid',
        'task_completion_days',
        'updated_at',
        'created_at',
    ];
}
