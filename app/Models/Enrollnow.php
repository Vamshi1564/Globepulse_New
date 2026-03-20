<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollnow extends Model
{
    use HasFactory;
    protected $table = 'tbl_enroll_now';
    public $timestamps = false;
    protected $fillable = [
        'lead_id',
        'course_id',
    ];
}