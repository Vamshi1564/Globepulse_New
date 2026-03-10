<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryModal extends Model
{
    use HasFactory;

    protected $table = 'tbl_productcategory';

    public function material()
    {
        return $this->hasMany(Material::class); // Adjust the foreign key and local key as needed
    }}
