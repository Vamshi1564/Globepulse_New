<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaGroupModel extends Model
{
    use HasFactory;


    protected $table = 'tbl_socialmediagrouptrade';

    protected $fillable = [
        'group_type',
        'group_name',
        'group_link',
    ];
}
