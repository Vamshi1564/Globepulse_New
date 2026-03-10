<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tbltasks';
    public $timestamps = false;


    protected $fillable = [
        'is_readed',
        'is_follow_up',
        'follow_up_date',
        'status',
        'service_id',
        'name',
        'auto_reminder',
        'dateadded',
        'startdate',
        'group_title',
        'duedate',
        'addedfrom',
        'rel_id',
        'priority',
        'rel_type',
        'visible_to_client',
    ];

    public function taskstatus()
    {
        return $this->belongsTo(TaskStatus::class, 'status');  // Assuming the foreign key exists
    }
    public function project()
    {
        return $this->belongsTo(Projects::class, 'rel_id');  // Assuming the foreign key exists
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'assigned');  // Assuming the foreign key exists
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'assigned', 'staffid');
    }
    public function assignedStaff()
    {
        return $this->hasMany(TaskAssignModal::class, 'taskid', 'id');
    }
}
