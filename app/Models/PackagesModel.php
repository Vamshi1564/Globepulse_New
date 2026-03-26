<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class PackagesModel extends Model
// {
//     use HasFactory;
//     protected $table = 'tbl_packages';

//     protected $fillable = ['title', 'subtitle', 'price' , 'label' ,'coupon_code', 'discount_amount'];


//     // public function points()
//     // {
//     //     return $this->hasMany(PackagesPoint::class , 'package_id');
//     // }
// }



// FILE: app/Models/PackagesModel.php
// Table: gfe_global.tbl_package_membership (default connection)
// Columns: id, package_name, price, shipmentdata, buyer_lead, product_limit

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagesModel extends Model
{
    protected $table        = 'tbl_package_membership';
    protected $keyType      = 'int';
    public    $incrementing = true;
    public    $timestamps   = false;

    protected $fillable = [
        'package_name',
        'price',
        'shipmentdata',
        'buyer_lead',
        'product_limit',
    ];
}