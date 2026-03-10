<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRotationModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_project_rotation';

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'last_assigned_user'

    ];

    public function project()
    {
        return $this->belongsTo(ItemsModel::class, 'project_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'last_assigned_user', 'staffid');
    }
}
