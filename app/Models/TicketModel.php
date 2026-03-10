<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    use HasFactory;

    protected $table = 'tickets_crm';

    protected $fillable = [
        'ticket_number',
        'task_title',
        'project_id',
        'description',
        'priority',
        'lead_id',
        'exclamation_manager_id',
        'status',
        'staffid',
        'start_date',
        'end_date',
        'tick_created_id',
        'tick_created_type',
        'verify_staff'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffid');
    }
    public function ExclamationManager()
    {
        return $this->belongsTo(Staff::class, 'exclamation_manager_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'lead_id');
    }
    public function TicketStatuses()
    {
        return $this->belongsTo(TicketStatuses::class, 'status', 'id');
    }
    public function TicketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_title', 'id');
    }
    public function createdByStaff()
    {
        return $this->belongsTo(Staff::class, 'tick_created_id', 'staffid');
    }
    public function verifyByStaff()
    {
        return $this->belongsTo(Staff::class, 'verify_staff', 'staffid');
    }

    public function createdByCustomer()
    {
        return $this->belongsTo(Customer::class, 'tick_created_id', 'id');
    }
}
