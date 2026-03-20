<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table = 'tblcontacts';
    public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'userid',
        'is_primary',
        'firstname',
        'email',
        'phonenumber',
        'datecreated',
        'password',
        'active',
        'invoice_emails',
        'task_emails',
        'project_emails',
        'ticket_emails',
    ];
}
