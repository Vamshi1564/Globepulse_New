<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsModel extends Model
{
    use HasFactory;
    protected $table = 'tblitems';

    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'description',
        'rate',
        'purchase_rate',
        'long_description',
        'package_title',
        'project_completion_day',
        'project_manager_id',
        'commission_amount',
        'commission_status',
        'customized_services',
        'status',
        'subtitle',
        'label',
        'coupon_code',
        'discount_amount',
        'b2b_status',
        'shipmentdata',
        'buyer_lead',
        'product_limit',

    ];


    public function serviceMapProducts()
    {
        return $this->hasMany(ServiceMapProductModel::class, 'products_id');
    }
    public function productLeadSources()
    {
        return $this->hasMany(ProductLeaadSourceModel::class, 'product_id', 'id');
    }
    public function points()
    {
        return $this->hasMany(PackagesPoint::class, 'product_id');
    }
}
