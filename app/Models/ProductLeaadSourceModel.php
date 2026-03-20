<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLeaadSourceModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_productleadssource';

    protected $fillable = [
        'product_id',
        'source_id',
        'title',
        'tracking_parameter',
        'status',
    ];

    public function products()
    {
        return $this->belongsTo(ItemsModel::class, 'product_id', 'id');
    }
    public function source()
    {
        return $this->belongsTo(LeadSource::class, 'source_id');
    }
}
