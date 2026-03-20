<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Buyer extends Authenticatable
{
    use Notifiable;

    protected $table        = 'buyers';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = true;

    protected $fillable = [
        'id', 'full_name', 'email', 'phone',
        'password_hash', 'country_code', 'company_name',
        'email_verified', 'is_active', 'last_login_at',
    ];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'email_verified' => 'boolean',
        'is_active'      => 'boolean',
        'last_login_at'  => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}






?>