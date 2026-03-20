<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeFinanceInquiryType extends Model
{
    use HasFactory;
    protected $table = 'trade_financeinquiry_type';

    public function TradeinquiryType()
    {
        return $this->hasMany(TradeFinanceInquiry::class , 'inquiry_type');  // Adjust the foreign key name accordingly
    }

}
