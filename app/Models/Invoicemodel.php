<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicemodel extends Model
{
    use HasFactory;

    protected $table = 'tblinvoices';

    public $timestamps = false;
    protected $fillable = [
        'clientid',
        'number',
        'prefix',
        'number_format',
        'datecreated',
        'date',
        'duedate',
        'currency',
        'subtotal',
        'total',
        'addedfrom',
        'status',
        'sale_agent',
        'project_id',
        'products_id',
    ];

    public function itemables()
    {
        return $this->hasMany(Itemable::class, 'rel_id', 'id'); // Adjust the foreign key and local key as needed
    }

    public function taskstatus()
    {
        return $this->belongsTo(TaskStatus::class, 'id'); // Assume there's a 'task_status_id' in the invoices table
    }

    public function paymentRecords()
    {
        return $this->hasMany(InvoicePaymentRecordModel::class, 'invoiceid');  // Correct relation
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'clientid', 'userid'); // Adjust the foreign key and local key
    }
}
