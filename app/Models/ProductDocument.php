<?php
// FILE: app/Models/ProductDocument.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    protected $table    = 'product_documents';
    protected $fillable = [
        'product_id',
        'customer_id',
        'label',
        'file_path',
        'file_ext',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}