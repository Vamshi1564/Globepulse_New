<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $table = 'tblitems';
    public $timestamps = false;
    protected $fillable = [
        'description',
        'long_description',
        'rate',
        'tax',
        'tax2',
        'unit',
        'group_id',
        'project_completion_day',
        'project_manager_id',
        'commission_status',
        'commission_amount',
        'customized_services',
        'status',
        'img_link',
        'yt_img_link',
        'yt_link',
        'speech',
        'yt_des',
    ];
}
