<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    use HasFactory;

    protected $table = 'tbl_all_links';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'link',
    ];
}