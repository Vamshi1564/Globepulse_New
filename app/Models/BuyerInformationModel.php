<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInformationModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_buyer_information'; // replace with your actual table name

    protected $fillable = [
        'date',
        'buyer_name',
        'contact_number',
        'buyer_address',
        'product_name',
        'sale_rate',
        'quantity',
        'total_sale',
        'payment_done_date',
        'status',
        'lead_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'lead_id'); // Adjust the foreign key if needed
    }
}
