<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalInformationModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_digital_informations';   // table name (change if needed)

    protected $fillable = [
        'name',
        'company_logo',
        'email',
        'mobile',
        'address',
        'company_name',
        'professional_email',
        'product_list',
        'about_company',
        'birth_date',
        'pan_number',
        'demo_link',
        'lead_id',
    ];
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'lead_id', 'id');
    }
}
