<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicess extends Model
{
    use HasFactory;

    public $timestamps = false; // Add this line
    protected $table = 'proforma_invoice';

    protected $fillable = [
        'invoice_no',
        'customer_id',
        'invoice_date',
        'exporter',
        'exporter_address',
        'exporter_reference',
        'buyer_order_no',
        'buyer_order_date',
        'buyer_name',
        'buyer_address',
        'consignee',
        'other_consignee',
        'notify_party',
        'origin_country',
        'destination_country',
        'description_goods',
        'kind_pkg',
        'pre_carriage',
        'receipt_place',
        'vessel_flight_no',
        'port_loading',
        'port_discharge',
        'final_destination',
        'marks_no',
        'terms',
        'container_no',
        'currency',
        'type'
    ];



    // Add this relationship
    public function Invoicess_products()
    {
        return $this->hasMany(Invoicess_products::class, 'invoice_id'); // Adjust the foreign key if needed
    }
}
