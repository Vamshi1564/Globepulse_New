<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentTitle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tbl_shipment_title';

    protected $fillable = [
        'title'
    ];

    public function shipmentdata()
    {
        return $this->hasMany(ShipmentDataModal::class, 'shipment_titleid');
    }
}
