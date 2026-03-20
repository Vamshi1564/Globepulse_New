<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalInfoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_digital_informations';
    public $timestamps = false;
}
