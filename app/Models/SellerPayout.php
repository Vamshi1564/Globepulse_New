<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerPayout extends Model
{
    protected $table        = 'seller_payouts';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = true;

    protected $fillable = [
        'id', 'seller_id', 'account_type', 'account_name',
        'account_number', 'routing_code', 'bank_name',
        'bank_country', 'currency_code', 'is_primary', 'is_verified',
    ];

    protected $hidden = ['account_number'];   // Never expose encrypted field

    protected $casts = [
        'is_primary'  => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
?>