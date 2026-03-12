<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class SellerDetail extends Model
// {
//     protected $table        = 'seller_details';
//     public    $incrementing = false;
//     protected $keyType      = 'string';
//     public    $timestamps   = true;

//     protected $fillable = [
//         'id', 'seller_id', 'onboarding_step',
//         // Step 3 — Business Info
//         'legal_business_name', 'business_type', 'year_established',
//         'company_website', 'num_employees', 'business_address',
//         'city', 'state_province', 'business_country_code',
//         // Step 6 — Company Profile
//         'company_description', 'main_products', 'factory_size_sqm',
//         'production_capacity', 'export_markets', 'certifications',
//         'logo_url', 'factory_photo_urls', 'video_url',
//         // KYC & Approval
//         'kyc_status', 'submitted_at', 'approved_at', 'approved_by',
//         'rejection_reason', 'is_locked',
//     ];

//     protected $casts = [
//         'factory_photo_urls' => 'array',    // JSON column → PHP array automatically
//         'is_locked'          => 'boolean',
//         'submitted_at'       => 'datetime',
//         'approved_at'        => 'datetime',
//     ];

//     public function seller()
//     {
//         return $this->belongsTo(Seller::class, 'seller_id');
//     }
// }



// FILE: app/Models/SellerDetail.php
// UPDATED: Added business_country_id to fillable

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerDetail extends Model
{
    protected $table        = 'seller_details';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = true;

    protected $fillable = [
        'id', 'seller_id', 'onboarding_step',
        'legal_business_name', 'business_type', 'year_established',
        'company_website', 'num_employees', 'business_address',
        'city', 'state_province', 'business_country_code', 'business_country_id',
        'company_description', 'main_products', 'factory_size_sqm',
        'production_capacity', 'export_markets', 'certifications',
        'logo_url', 'factory_photo_urls', 'video_url',
        'kyc_status', 'submitted_at', 'approved_at', 'approved_by',
        'rejection_reason', 'is_locked',
    ];

    protected $casts = [
        'factory_photo_urls' => 'array',
        'is_locked'          => 'boolean',
        'submitted_at'       => 'datetime',
        'approved_at'        => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
?>