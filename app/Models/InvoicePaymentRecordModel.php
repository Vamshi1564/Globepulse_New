<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePaymentRecordModel extends Model
{
    use HasFactory;

    protected $table = 'tblinvoicepaymentrecords';

    public $timestamps = false;

    protected $fillable = [
        'invoiceid',
        'amount',
        'paymentmode',
        'date',
        'daterecorded',
        'sale_agent_id',
    ];
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'sale_agent_id', 'staffid');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'clientid', 'userid');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoicemodel::class, 'invoiceid', 'id');  // Invoice connection
    }
}
