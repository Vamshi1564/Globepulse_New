<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productgallery extends Model
{
    use HasFactory;
    protected $table = 'tbl_products_gallery';
    protected $fillable = ['product_id', 'gallery_images', 'customer_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
