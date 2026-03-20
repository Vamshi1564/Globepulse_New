<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemable extends Model
{
    use HasFactory;

    protected $table = 'tblitemable'; 

     public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'rel_id',
        'rel_type',
        'description',
        'long_description',
        'qty',
        'unit',
        'item_order',
        'rate',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoicemodel::class ,'rel_id' , 'id'); // Adjust the foreign key and local key as needed
    }

}
