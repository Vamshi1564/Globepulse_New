<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'tbl_payment_membership';


    protected $fillable = [
        'payment_id',
        'order_id',
        'customer_id',
        'amount',
        'package_id',
        'status'
    ];


    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
}
