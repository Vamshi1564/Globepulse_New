<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDataModal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tbl_shipmentdata';

    protected $fillable = [
        'shipment_titleid',
        'exporter_name',
        'exporter_address',
        'port_of_discharge',
        'importer_buyer_name',
        'importer_buyer_address',
        'port_of_loading',
        'country_of_discharge',
        'chapter',
        'hsncode',
        'product_description',
        'month',
        'year',
        'quantity',
        'uqc',
        'unit_rate',
        'unit_rate_currency',
        'total_fob_value',
        'fob_value_currency',
        'mode_shipment',
        'dateadded',
    ];

    public function shipmenttitle()
    {
        return $this->belongsTo(ShipmentTitle::class, 'shipment_titleid');
    }
}
