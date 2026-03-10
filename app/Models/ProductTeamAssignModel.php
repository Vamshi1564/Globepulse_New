<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTeamAssignModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_products_users';
    public $timestamps = false;


    protected $fillable = [
        'products_id',
        // 'source_id',
        'staff_id',
        'lead_assign',
        'status',
        // 'updateddate',
        // 'createddate',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\ItemGroup::class, 'products_id', 'id');
    }

    /**
     * Source relation
     * Assumes the lead/source records live in the LeadSource model/table
     * FK on this table  => source_id
     * PK on LeadSource  => id
     */
    public function source()
    {
        return $this->belongsTo(\App\Models\LeadSource::class, 'source_id', 'id');
    }

    /**
     * Staff relation
     * Assumes staff table primary key is `staffid`.
     * If staff PK is `id` change the third argument to 'id'.
     */
    public function staff()
    {
        return $this->belongsTo(\App\Models\Staff::class, 'staff_id', 'staffid');
    }
}