<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersAndImporterModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_suppliers_and_importers';
    protected $fillable = [
        'lead_id',
        'company_name',
        'profile',
        'contact_person_owner',
        'contact_no_1',
        'contact_no_2',
        'email',
        'remarks_1',
        'remarks_2',
        'dateadded',
    ];
}
