<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerDashboardItemModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_seller_dashboard_items';

    protected $fillable = [
        'item_name'
    ];
}
