<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoLinksModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_cms_web_links';

    public $timestamps = false;
    // created_at already che, updated_at nathi

    protected $fillable = [
        'demo_key',
        'demo_url',
        'categories'
    ];
}
