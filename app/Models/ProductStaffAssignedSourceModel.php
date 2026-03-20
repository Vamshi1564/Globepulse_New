<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStaffAssignedSourceModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_productstaffassigned';

    protected $fillable = [
        'productleadsource_id',
        'item_id',
        'source_id',
        'staffid',
        'status',
        'assigned_status',
    ];

    public function productLeadSource()
    {
        return $this->belongsTo(ProductLeaadSourceModel::class, 'productleadsource_id');
    }

    public function items()
    {
        return $this->belongsTo(ItemsModel::class, 'item_id');
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class, 'source_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffid');
    }
}
