<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lmscourse extends Model
{
    use HasFactory;

    protected $table = 'tbl_lms_course';
    public $timestamps = false;
    protected $fillable = [
        'thumbnail',
        'title',
        'course_id',
        'price',
        'discount_price',
        'intro_video_url',
        'description',
    ];

}