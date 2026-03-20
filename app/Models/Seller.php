<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use Notifiable;

    protected $table        = 'sellers';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = true;               // created_at / updated_at

    // Columns DB sets automatically — don't let Eloquent touch them
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'id', 'email', 'phone', 'password_hash',
        'country_code', 'account_type', 'email_verified',
        'status', 'is_active', 'must_change_password', 'last_login_at',
    ];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'email_verified'      => 'boolean',
        'is_active'           => 'boolean',
        'must_change_password'=> 'boolean',
        'last_login_at'       => 'datetime',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
    ];

    // Laravel Auth needs this to find the password field
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // ── Relationships ────────────────────────────────────────
    public function details()
    {
        return $this->hasOne(SellerDetail::class, 'seller_id');
    }

    public function documents()
    {
        return $this->hasMany(SellerDocument::class, 'seller_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(SellerSubscription::class, 'seller_id');
    }

    public function payouts()
    {
        return $this->hasMany(SellerPayout::class, 'seller_id');
    }

    // Get only the active subscription
    public function activeSubscription()
    {
        return $this->hasOne(SellerSubscription::class, 'seller_id')
                    ->where('status', 'active')
                    ->latest('started_at');
    }

    // Get latest version of each document type
    public function latestDocuments()
    {
        return $this->hasMany(SellerDocument::class, 'seller_id')
                    ->where('is_latest', 1);
    }
}

?>