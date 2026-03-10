<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetails extends Model
{
    use HasFactory;

    protected $table = 'article_details';

    protected $fillable = [
        'title',
        'content',
        'domain_type',
        'slug',
        'thumbnail',
        'category_id',
        'is_published',
        'alt_text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'admin_id',
        'author_id',
        'publish_date',
    ];

    public function Categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function Author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
