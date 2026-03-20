<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceSupportModel extends Model
{
    use HasFactory;

    // Optional: Only if your table name is NOT 'advance_supports'
    protected $table = 'advance_supports';

    protected $fillable = [
        'tital',
        'whatsApp_no',
        'phone_no',
        'email',
    ];
}
