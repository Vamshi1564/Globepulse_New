<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'title',
        'message',
        'read_status',
        'datetime',
        'rel_id',
        'task_id',
        'rel_type',
    ];

    protected $table = 'tbl_notification';

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'package_id', 'id');
    }
}
