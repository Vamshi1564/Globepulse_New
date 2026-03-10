<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTrigger extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'groupid',
        'msg_status',
        'datetime',
        'rel_type',
        'remark',
        'read_status',
        'rel_id',
        'task_id',
        'whatsapp_status',
        'chat_status',
        'email_status',
        'sms_status',
        'notification_status',
        'created_at',
        'updated_at'
    ];

    protected $table = 'tbl_notification_trigger';

    public function customergroups()
    {
        return $this->belongsTo(CustomerGroups::class, 'rel_id');
    }

    public function customeraddgroup()
    {
        return $this->hasMany(CustomerAddGroup::class, 'rel_id');
    }

    // App\Models\NotificationTrigger.php

    public function campaignGroups()
    {
        return $this->hasMany(CampaignGroupModel::class, 'campaign_id');
    }

    public function leadCapture()
    {
        return $this->hasMany(CampaignLeadCaptureModel::class, 'campaign_id');
    }

    // App\Models\NotificationTrigger.php

    public function getLeadCountAttribute()
    {
        return $this->leadCapture
            ->unique('lead_id')
            ->count();
    }
}
