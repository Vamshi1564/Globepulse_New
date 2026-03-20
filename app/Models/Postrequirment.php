<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postrequirment extends Model
{
    use HasFactory;

    protected $table = 'tbl_postbyrequirment';

    protected $fillable = [
        'product_name',
        'quantity',
        'mobile',
        'location',
        'customer_id',
        'country_id',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function buyleadenquiry()
    {
        return $this->hasMany(BuyleadEnquiry::class, 'postbyrequirement_id');
    }
}
