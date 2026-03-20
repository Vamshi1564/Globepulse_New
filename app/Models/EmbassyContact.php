<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbassyContact extends Model
{
    use HasFactory;

    protected $table = 'tbl_embassy_contacts';

    protected $fillable = ['name', 'embassy_email', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }
}
