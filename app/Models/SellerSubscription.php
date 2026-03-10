<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerSubscription extends Model
{
    protected $table        = 'seller_subscriptions';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'id', 'seller_id', 'plan_name', 'price_usd', 'billing_cycle',
        'max_products', 'has_verified_badge', 'has_rfq_priority',
        'has_analytics', 'has_global_promotion', 'has_ai_buyer_matching',
        'has_premium_badge', 'status', 'started_at', 'ends_at',
        'cancelled_at',
    ];

    protected $casts = [
        'has_verified_badge'    => 'boolean',
        'has_rfq_priority'      => 'boolean',
        'has_analytics'         => 'boolean',
        'has_global_promotion'  => 'boolean',
        'has_ai_buyer_matching' => 'boolean',
        'has_premium_badge'     => 'boolean',
        'price_usd'             => 'decimal:2',
        'started_at'            => 'datetime',
        'ends_at'               => 'datetime',
        'cancelled_at'          => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}


?>