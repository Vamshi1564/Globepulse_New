<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'tbl_material';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'link',
        'procat_id'
    ];

    public function productcategory()
    {
        return $this->belongsTo(ProductCategoryModal::class , 'procat_id'); // Adjust the foreign key and local key as needed
    }
}
