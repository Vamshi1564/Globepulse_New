<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'tbl_package_membership';
    
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'package_id', 'id');
    }

}
