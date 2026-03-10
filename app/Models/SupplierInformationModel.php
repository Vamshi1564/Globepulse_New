<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInformationModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_supplier_information';

    protected $fillable = [
        'date',
        'product_name',
        'count',
        'country',
        'supplier_name',
        'contact_number',
        'purchase_rate',
        'quantity',
        'total_amount',
        'payment_done_date',
        'lead_id',
        'status',
    ];
    public function countrymodel()
    {
        return $this->belongsTo(Country::class, 'country');  // Assuming the foreign key exists
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'lead_id');  // Assuming the foreign key exists
    }
}
