<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grouptype extends Model
{
    use HasFactory;

    protected $table = 'tbl_grouptype';


    public function customerGroups()
    {
        return $this->hasMany(CustomerGroups::class);
    }
}
