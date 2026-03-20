<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroups extends Model
{
    use HasFactory;

    protected $table = 'tblcustomers_groups';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'grouptype_id',
        'parent_groupid',
        'lac_datetime'
    ];

    
    public function grouptype()
    {
        return $this->belongsTo(Grouptype::class);
    }

    public function Notification()
    {
        return $this->belongsTo(Notification::class);
    }
    public function notificationtrigger()
    {
        return $this->hasMany(NotificationTrigger::class , 'rel_id');
    }

    public function members()
    {
        return $this->hasMany(CustomerAddGroup::class, 'groupid');
    }
    public function whatsappcampaign()
    {
        return $this->hasMany(WhatsappCampaign::class, 'group_id');
    }
}
