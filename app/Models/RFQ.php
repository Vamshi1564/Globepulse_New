<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class RFQ extends Model
{
    use HasFactory;

    protected $table = 'rfqs';

    // If your table has timestamps (created_at, updated_at) → keep true
    public $timestamps = true;

    protected $fillable = [
    'product_id',
    'supplier_id',
    'buyer_id',

    'quantity',
    'target_price',
    'delivery_time',
    'shipping_terms',
    'destination_port',
    'payment_terms',
    'message',

    'name',
    'email',
    'phone',
    'company_name',
    'attachment',
    'status',
];
public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}
public function supplier()
{
    return $this->belongsTo(\App\Models\Customer::class, 'supplier_id');
}

}