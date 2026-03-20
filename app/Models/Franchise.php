<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'tblfranchises';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'city',
        'country',
        'message',
    ];
}
