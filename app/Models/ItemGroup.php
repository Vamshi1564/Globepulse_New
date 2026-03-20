<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;
    protected $table = 'tblitems_groups';

    public $timestamps = false;
    protected $fillable = [
        'name',
        'status_code',
        'img_link',
        'lead_tracker',
    ];

    public function customer()
    {
        return $this->hasMany(Customer::class, 'lead_products');
    }

    public function staff()
    {
        return $this->hasMany(ProductTeamAssignModel::class, 'products_id', 'id');
    }
}
