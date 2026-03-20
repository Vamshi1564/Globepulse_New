<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMemberModel extends Model
{
    use HasFactory;
    
    protected $table = 'tblproject_members';

    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'project_id',
    ];
}
