<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignModal extends Model
{
    use HasFactory;
    protected $table = 'tbltask_assigned';

    public $timestamps = false;


    protected $fillable = [
        'taskid',
        'staffid',
        'assigned_from',
    ];
    public function staff()
{
    return $this->belongsTo(Staff::class, 'staffid');
}

}
