<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RFQ extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rfqs';

    protected $fillable = [
        'product_id',

        // 🔥 ONLY KEEP UUID
        'supplier_uuid',
        'buyer_uuid',

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

    // ✅ Product
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    // ✅ Seller (UUID → id)
// Seller basic info
public function sellerAccount()
{
    return $this->belongsTo(\App\Models\Seller::class, 'supplier_uuid', 'id');
}

// Seller company details
public function supplier()
{
    return $this->belongsTo(\App\Models\SellerDetail::class, 'supplier_uuid', 'seller_id');
}
public function buyer()
{
    return $this->belongsTo(\App\Models\Buyer::class, 'buyer_uuid', 'id');
}

    // ✅ Quotations
    public function quotations()
    {
        return $this->hasMany(\App\Models\Quotation::class, 'rfq_id');
    }
}