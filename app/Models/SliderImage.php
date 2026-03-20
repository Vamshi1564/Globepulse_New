<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;

    protected $table = 'tbl_portfolio_slider';

    protected $fillable = [
        'slider_img',
        'lead_id',
    ];

}
