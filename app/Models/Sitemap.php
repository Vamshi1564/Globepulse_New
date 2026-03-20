<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
    protected $table = 'tbl_sitemap';
    public $timestamps = true;


    protected $fillable = [
        'url',
        'slug',
        'updated_at',
        'created_at',
    ];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
