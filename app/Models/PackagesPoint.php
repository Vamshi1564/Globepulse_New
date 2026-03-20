<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesPoint extends Model
{
    use HasFactory;
    protected $table = 'tbl_package_points';


    protected $fillable = ['product_id', 'category', 'point'];


    // public function packages()
    // {
    //     return $this->belongsTo(PackagesModel::class , 'package_id');
    // }
    public function items()
    {
        return $this->belongsTo(ItemsModel::class , 'product_id');
    }
}
