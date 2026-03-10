<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStoryModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_success_story';

    protected $fillable = [
        'logo',
        'client_name',
        'company_name',
        'city',
        'state',
        'country',
        'description',
    ];
}
