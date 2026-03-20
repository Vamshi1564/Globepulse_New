<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPrice extends Model
{
    use HasFactory;
    protected $table = 'tbl_daily_price';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'des',
        'india_price',
        'dubai_price',
        'img_link',
        'status_code',
        'date',
    ];

}