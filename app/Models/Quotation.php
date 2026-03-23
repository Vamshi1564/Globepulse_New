<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
    'rfq_id',

    'supplier_id',     // optional (old)
    'buyer_id',        // optional (old)

    'supplier_uuid',   // ✅ NEW
    'buyer_uuid',      // ✅ NEW

    'price',
    'delivery_time',
    'payment_terms',
    'message',
    'status'
];

    public function rfq()
    {
        return $this->belongsTo(RFQ::class, 'rfq_id'); // ✅ FIXED
    }

public function supplier()
{
    return $this->belongsTo(\App\Models\Seller::class, 'supplier_uuid', 'id');
}
public function buyer()
{
    return $this->belongsTo(\App\Models\Buyer::class, 'buyer_uuid', 'id');
}
}