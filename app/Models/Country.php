<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'tblcountries';

    protected $primaryKey = 'country_id';


    public function products()
    {
        return $this->hasMany(Product::class, 'country_id');
    }
    public function postrequirement()
    {
        return $this->hasMany(Postrequirment::class, 'country_id');
    }
    public function distribution()
    {
        return $this->hasMany(Distribution::class, 'country');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'country_id'); // Adjust the model name if needed
    }

    public function RealShipmentData()
    {
        return $this->hasMany(ShipmentDataModal::class, 'countryid', 'country_id');
    }
    public function supplierinfo()
    {
        return $this->belongsTo(SupplierInformationModel::class, 'country');  // Assuming the foreign key exists
    }
}
