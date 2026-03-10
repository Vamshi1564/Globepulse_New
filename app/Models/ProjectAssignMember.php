<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssignMember extends Model
{
    use HasFactory;
    protected $table = 'tbl_projectassign_member';

    protected $fillable = [
        'staffid',
        'projectid',
    ];
}
