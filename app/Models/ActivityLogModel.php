<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogModel extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'table_name',
        'record_id',
        'user_id',
        'action',
        'route',
        'action_pagename',
        'old_values',
        'new_values',
        'created_at',
        'updated_at',
    ];
}
