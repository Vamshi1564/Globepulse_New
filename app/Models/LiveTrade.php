<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveTrade extends Model
{
    use HasFactory;
    protected $table = 'tbl_live_trade';

    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'name',
        'des',
        'weight',
        'packing',
        'country',
        'status',
        'verified_status',
    ];
}
