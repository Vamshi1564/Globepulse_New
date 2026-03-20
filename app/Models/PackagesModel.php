<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_packages';

    protected $fillable = ['title', 'subtitle', 'price' , 'label' ,'coupon_code', 'discount_amount'];


    // public function points()
    // {
    //     return $this->hasMany(PackagesPoint::class , 'package_id');
    // }
}
