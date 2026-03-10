<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycInformationModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_clientkyc_info';

    public $timestamps = false;
}