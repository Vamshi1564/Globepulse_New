<?php
// FILE: app/Models/SellerService.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerService extends Model
{
    use HasFactory;

    protected $table = 'seller_services';

    protected $fillable = [
        'customer_id', 'title', 'slug', 'description',
        'service_type', 'category_id', 'subcategory_id', 'sub_subcategory_id',
        'pricing_type', 'min_price', 'max_price', 'price_unit',
        'delivery_mode', 'turnaround_time', 'service_area',
        'inclusions', 'exclusions', 'certifications', 'languages',
        'experience_years', 'projects_completed',
        'cover_image', 'portfolio_images', 'video_url',
        'payment_terms', 'sample_consultation', 'keywords',
        'status', 'rejection_reason',
    ];

    protected $casts = [
        'portfolio_images' => 'array',
        'min_price'        => 'decimal:2',
        'max_price'        => 'decimal:2',
    ];

    // ── Relationships ─────────────────────────────────────────
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    // ── Scopes ────────────────────────────────────────────────
    public function scopeApproved($q)    { return $q->where('status', 'approved'); }
    public function scopePending($q)     { return $q->where('status', 'pending'); }
    public function scopeForSeller($q, $id) { return $q->where('customer_id', $id); }

    // ── Helpers ───────────────────────────────────────────────
    public function getPriceDisplayAttribute(): string
    {
        if ($this->pricing_type === 'quote_based') return 'Get Quote';
        if ($this->pricing_type === 'negotiable')  return 'Negotiable';
        if ($this->min_price && $this->max_price)
            return '₹' . number_format($this->min_price) . ' – ₹' . number_format($this->max_price);
        if ($this->min_price)
            return 'From ₹' . number_format($this->min_price);
        return 'Contact for Price';
    }

    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            'approved'  => ['bg' => '#d1fae5', 'color' => '#065f46', 'label' => '✅ Live'],
            'rejected'  => ['bg' => '#fee2e2', 'color' => '#991b1b', 'label' => '❌ Rejected'],
            'inactive'  => ['bg' => '#f1f5f9', 'color' => '#475569', 'label' => '⏸ Inactive'],
            default     => ['bg' => '#fef3c7', 'color' => '#92400e', 'label' => '⏳ Under Review'],
        };
    }
}