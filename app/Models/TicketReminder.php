<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReminder extends Model
{
    use HasFactory;

    protected $table = 'ticket_remark';

    protected $fillable = [
        'description',
        'date',
        'ticket_id',
        'lead_id',
        'staff',
        'priority',
        'ticket_status'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'staff');
    }
    public function TicketStatuses()
    {
        return $this->belongsTo(TicketStatuses::class, 'ticket_status', 'id');
    }
    public function TicketPriorityyy()
    {
        return $this->belongsTo(TicketPriority::class, 'priority', 'id');
    }
}
