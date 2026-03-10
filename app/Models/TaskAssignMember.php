<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignMember extends Model
{
    use HasFactory;
    protected $table = 'tbl_taskassign_member';
    protected $fillable = [
        'taskid',
        'staffid',
        'created_at',
        'updated_at',
    ];
}
