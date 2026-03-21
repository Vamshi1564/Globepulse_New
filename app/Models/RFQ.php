<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQ extends Model
{
    use HasFactory;

    protected $table = 'rfqs';

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

    // ✅ Product Relation
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    // ✅ Supplier (Seller)
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'supplier_id');
    }

    // ✅ Buyer (IMPORTANT ADD THIS)
    public function buyer()
    {
        return $this->belongsTo(\App\Models\Buyer::class, 'buyer_id');
    }
public function quotations()
{
    return $this->hasMany(\App\Models\Quotation::class, 'rfq_id'); // ✅ FIX
}
}