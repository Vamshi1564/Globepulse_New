<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    public $timestamps = false; // Add this line

    protected $fillable = [
        'name',
        'description',
        'status',
        'clientid',
        'start_date',
        'deadline',
        'project_created',
        'progress',
        'progress_from_tasks',
        'addedfrom',
        'contact_notification',
    ];


    public function customer()
    {
        // return $this->belongsTo(Customer::class, 'clientid');
        return $this->belongsTo(Customer::class, 'clientid', 'client_id'); // id to client id when add remark and send mail

    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'addedfrom');
    }

    protected $table = 'tblprojects';

    public function taskstatus()
    {
        return $this->belongsTo(TaskStatus::class, 'status');
    }
    public function task()
    {
        return $this->belongsTo(Task::class, 'rel_id');  // Assuming the foreign key exists
    }
    public function RaisTicket()
    {
        return $this->hasMany(TicketModel::class , 'project_id' , 'id');
    }
    //   public function productLeadSources()
    // {
    //     return $this->hasMany(ProductLeaadSourceModel::class, 'product_id');
    // }
}
