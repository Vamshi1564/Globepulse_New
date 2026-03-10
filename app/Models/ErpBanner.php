<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErpBanner extends Model
{
    use HasFactory;

    protected $table = 'tbl_app_banner';

    public $timestamps = false;
    protected $fillable = [
        'name',
        'img_link',
        'status',
        'department',
    ];
}
