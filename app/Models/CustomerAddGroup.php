<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddGroup extends Model
{
    use HasFactory;

    protected $table = 'tblcustomer_groups';

    public $timestamps = false;
    protected $fillable = [
        'groupid',
        'customer_id',
        'lead_id'
    ];

    public function notificationtrigger()
    {
        return $this->belongsTo(NotificationTrigger::class , 'rel_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'lead_id');
    }
    public function grouptype()
    {
        return $this->hasMany(Grouptype::class, 'groupid');
    }
}
