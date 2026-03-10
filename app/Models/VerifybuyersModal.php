<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifybuyersModal extends Model
{
    use HasFactory;

    protected $table = 'tbl_verifybuyersdata';

    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'countryid',
        // 'address',
        'hsncode',
        'staffid',
        'website',
        'phone_02',
        'chapter',
        'product_description',
        'product_name',
        'contact_person',
        'category_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryid', 'country_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
