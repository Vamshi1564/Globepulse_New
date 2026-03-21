<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'rfq_id',
        'supplier_id',
        'buyer_id',
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
        return $this->belongsTo(Seller::class, 'supplier_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
}