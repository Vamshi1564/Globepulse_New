<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallTypeModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_call_types';

    protected $fillable = ['name'];

    public $timestamps = true;
}
