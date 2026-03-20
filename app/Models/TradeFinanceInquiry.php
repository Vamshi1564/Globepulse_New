<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeFinanceInquiry extends Model
{
    use HasFactory;

    protected $table = 'tbl_tradefinance_inquiry';

    protected $fillable = ['name', 'phonenumber', 'email', 'subject', 'inquiry_type'];


    public function TradeinquiryType()
    {
        return $this->belongsTo(TradeFinanceInquiryType::class , 'inquiry_type');  // Adjust the foreign key name accordingly
    }

}
