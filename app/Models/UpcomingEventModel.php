<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingEventModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_app_slider';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'web_url',
        'img_link',
        'web_slider',
        'web_popup',
        'date',
        'status_code',
    ];
}
