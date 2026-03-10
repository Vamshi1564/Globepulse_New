<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Group;

class Grouplist extends Model
{
    use HasFactory;

    protected $table = 'tblcustomers_groups';

    protected $fillable = [
        'name',

    ];

    public $timestamps = false;


    // public function group()
    // {
    //     return $this->belongsTo(group::class, 'id', 'name');
    // }
}