<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUserAssignModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_project_user_assigns';

    protected $fillable = [
        'project_id',
        'user_id',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(ItemsModel::class, 'project_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'user_id', 'staffid');
    }
}
