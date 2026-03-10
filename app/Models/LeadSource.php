<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSource extends Model
{
    use HasFactory;
    protected $table = 'tblleads_sources';

    public function customer()
    {
        return $this->hasMany(Customer::class, 'source');
    }
    public function productLeadSources()
    {
        return $this->hasMany(ProductLeaadSourceModel::class, 'source_id');
    }
    public function ProductStaffAssignedSource()
    {
        return $this->hasMany(ProductStaffAssignedSourceModel::class, 'source_id');
    }
}
