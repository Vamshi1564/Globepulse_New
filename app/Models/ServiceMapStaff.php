<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMapStaff extends Model
{
    use HasFactory;
    protected $table = 'tbladd_service_map_staff';
    public $timestamps = false;

    protected $fillable = [
        'products_id',
        'service_id',
        'staff_id',
        'task_assing',
        'status',
        'createddate',
    ];
      public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staffid');
    }
}
