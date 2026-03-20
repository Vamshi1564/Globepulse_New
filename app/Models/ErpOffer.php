<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErpOffer extends Model
{
    use HasFactory;
    protected $table = 'tbl_app_offer';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'original_price',
        'offer_price',
        'img_link',
        'description',
        'status',
    ];
}