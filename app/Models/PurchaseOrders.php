<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';

    public $timestamps = false; // Add this line

    protected $fillable = [
        'customer_id',
        'po_number',
        'po_date',
        'invoice_number',
        'invoice_date',
        'company_name',
        'company_address',
        'company_email',
        'contact_person',
        'company_registration',
        'sr_no',
        'commodity',
        'grade_specification',
        'quantity',
        'rate',
        'amount',
        'currency',
        'payment_terms'
    ];
}
