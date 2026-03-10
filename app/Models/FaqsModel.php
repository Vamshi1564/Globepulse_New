<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqsModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_faqs'; // make sure your DB table is named 'faqs'

    protected $fillable = [
        'faqs_que',
        'faqs_ans',
    ];
}
