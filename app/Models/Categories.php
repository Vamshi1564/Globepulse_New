<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'alt_text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'image'
    ];

    public function articles()
    {
        return $this->hasMany(ArticleDetails::class, 'category_id');
    }
}
