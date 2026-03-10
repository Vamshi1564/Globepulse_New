<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'tblclients';
    public $timestamps = false;

    protected $fillable = [
        'company',
        'phonenumber',
        'city',
        'datecreated',
        'active',
        'leadid',
        'registration_confirmed',
        'addedfrom',
    ];


    public function InvoicePaymentRecord()
    {
        return $this->hasMany(InvoicePaymentRecordModel::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoicemodel::class, 'clientid', 'userid');
    }
}
