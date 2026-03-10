<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'tbldistribution';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'product_seller_id',
        'product_id',
        'lead_id',
        'staffid',
        'phone_number',
        'city',
        'country',
        'message',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'lead_id'); // or 'customer_id'
    }
    public function productseller()
    {
        return $this->belongsTo(Customer::class, 'product_seller_id'); // or 'customer_id'
    }
    public function countrymodel()
    {
        return $this->belongsTo(Country::class, 'country'); // or 'customer_id'
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // or 'customer_id'
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffid'); // or 'customer_id'
    }
}
