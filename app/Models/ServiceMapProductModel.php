<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMapProductModel extends Model
{
    use HasFactory;
    protected $table = 'tbladd_service_map_prodcut';
    public $timestamps = false;

    protected $fillable = [
        'products_id',
        'tbladd_service_list_id',
        'task_completion_day',
        'client_hide',
        'status',
        'createddate',
        'Offer',
    ];
    public function item()
    {
        return $this->belongsTo(ItemsModel::class, 'products_id');
    }

    public function service()
    {
        return $this->belongsTo(ServiceListModel::class, 'tbladd_service_list_id');
    }

    public function staffMappings()
    {
        return $this->hasMany(ServiceMapStaff::class, 'service_id');
    }
}
