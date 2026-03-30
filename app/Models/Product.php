<?php
// FILE: app/Models/Product.php
// CHANGES: Added new B2B fields to $fillable only
// Everything else (booted, relationships) is UNCHANGED

namespace App\Models;

use App\Livewire\Front\Hotdeal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tbl_products';

    protected $fillable = [
        // ── Existing fields (unchanged) ──
        'title',
        'brand_name', 
        'description',
        'product_img',
        'max_price',
        'min_price',
        'min_order',
        'business_type',
        'category_id',
        'subcategory_id',
        'sub_subcategory_id',
        'customer_id',
        'country_id',
        'status',
        'slug',
        'HSN',
        'seo_title',
        'seo_description',
        'seo_keywords',
        // ── NEW B2B fields (added via migration) ──
        'unit',
        'supply_ability',
        'lead_time',
        'packaging_details',
        'certifications',
        'sample_available',
        'sample_price',
        'payment_terms',
        'port_of_dispatch',
        'country_of_origin',
        'product_video_url',
        'keywords',
        // ── GlobPulse seller fields ──
        'seller_id',
        'rejection_reason',
    ];

    protected static function booted()
    {
        static::created(function ($product) {
            Sitemap::create([
                'slug'       => $product->slug,
                'url'        => url('product-detail/' . $product->slug),
                'created_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
            ]);
        });

        static::updated(function ($product) {
            if ($product->isDirty('slug')) {
                $oldSlug = $product->getOriginal('slug');
                Sitemap::where('slug', $oldSlug)->update([
                    'slug'       => $product->slug,
                    'url'        => url('product-detail/' . $product->slug),
                    'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                ]);
            }
        });
    }

    // ── Relationships (unchanged) ─────────────────────────
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function galleryimages()
    {
        return $this->hasMany(Productgallery::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCategory::class, 'sub_subcategory_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function enquiries()
    {
        return $this->hasMany(ProductEnquiry::class);
    }

    public function hotdeal()
    {
        return $this->hasMany(HotDealModal::class, 'product_id');
    }

    public function distribution()
    {
        return $this->hasMany(Distribution::class, 'product_id');
    }

    // ── NEW: GlobPulse seller relationship ───────────────
    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class, 'seller_id');
    }
}