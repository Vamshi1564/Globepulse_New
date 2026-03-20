<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardItemAccessModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_dashboard_items_access';

    protected $fillable = [
        'product_id',
        'dashboard_items_id',
    ];

    // DashboardItemAccessModel.php
    public function dashboardItem()
    {
        return $this->belongsTo(SellerDashboardItemModel::class, 'dashboard_items_id');
    }

    public function items()
    {
        return $this->belongsTo(ItemsModel::class, 'product_id');
    }
}
