<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicess_products extends Model
{
    use HasFactory;

    public $timestamps = false; // Add this line

    protected $table = 'proforma_products';
    protected $fillable = [
        'invoice_id',
        'product_name',
        'hs_code',
        'packing',
        'quantity_kg',
        'quantity_box',
        'rate_usd',
        'dos_amount_usd',
        'fob_amount',
        'net_weight',
        'gross_weight',
        'pieces'
    ];
}
