<?php
// FILE: app/Models/Seller.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table        = 'sellers';
    protected $keyType      = 'int';
    public    $incrementing = true;     // AUTO_INCREMENT — must be public

    protected $fillable = [
        'email', 'phone', 'name', 'company', 'profile_image',
        'password_hash', 'country_code', 'country_id',
        'account_type', 'email_verified', 'status',
        'is_active', 'must_change_password', 'package_id',
        'last_login_at',
    ];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'email_verified'       => 'boolean',
        'is_active'            => 'boolean',
        'must_change_password' => 'boolean',
        'last_login_at'        => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function details()
    {
        return $this->hasOne(SellerDetail::class, 'seller_id');
    }

    public function documents()
    {
        return $this->hasMany(SellerDocument::class, 'seller_id');
    }

    // Package info is fetched via DB::connection('b2b_remote')
    // in Profile.php and SellerLogin.php — no Eloquent relationship
    // needed since it's on a different DB connection
}