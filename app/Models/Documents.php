<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $table = 'tbl_document';
    public $timestamps = false;
    
    protected $fillable = [
        'doc_name',
        'description',
        'sample_doc_link',
        'status',
    ];
}
