<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'news_img',
        'description'
    ];

    protected $table = 'tbl_liveudate_slider';
}
