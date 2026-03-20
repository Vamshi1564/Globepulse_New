<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEnquiry extends Model
{
    use HasFactory;

    protected $table = 'tbl_product_inquiry';

    protected $fillable = [
        'product_name',
        'email',
        'phonenumber',
        'company_name',
        'customer_id',
        'product_id',
        'buyer_id',
        'supplier_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'buyer_id'); // Adjust the foreign key if needed
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
