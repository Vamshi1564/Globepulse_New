<?php

namespace App\Models;

use App\Livewire\Front\Hotdeal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
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
    ];

    protected $table = 'tbl_products';



    protected static function booted()
    {

        static::created(function ($product) {
            Sitemap::create([
                'slug' => $product->slug,
                'url' => url('product-detail/' . $product->slug), // The product's URL
                'created_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
            ]);
        });

        // static::updated(function ($product) {
        //     // Handle both create and update using the `saved` event
        //     // $newSlug = str_replace(' ', '-', strtolower($product->title));
        //     // if (!$product->slug) {
        //     //     return;
        //     // }

        //     // // Extract the random number from the existing slug
        //     // preg_match('/-(\d+)$/', $product->slug, $matches);
        //     // $randomNumber = $matches[1] ?? rand(100, 99999);
        //     // $newSlug = str_replace(' ', '-', strtolower($product->title)) . '-' . $randomNumber;

        //     // if ($product->slug !== $newSlug) {
        //     //     $product->slug = $newSlug;
        //     //     $product->save(); // Save without triggering another update event
        //     // }

        //     // Sitemap::updateOrCreate(
        //     //     ['slug' => $product->getOriginal('slug')], // Look for an existing record with the same slug
        //     //     [
        //     //         'slug' => $newSlug,
        //     //         'url' => url('product-detail/' . $newSlug), // The product's URL
        //     //         'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(), // Set the last modified timestamp
        //     //     ]
        //     // );

        //     Sitemap::where('slug', $product->getOriginal('slug')) // Find the existing entry by old slug
        //         ->update([
        //             'slug' => $product->slug, // Update to the new slug entered in form
        //             'url' => url('products-detail/' . $product->slug),
        //             'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
        //         ]);
        // });

        static::updated(function ($product) {
            if ($product->isDirty('slug')) { // Check if slug is being updated
                $oldSlug = $product->getOriginal('slug'); // Get the old slug

                // Update the sitemap entry
                Sitemap::where('slug', $oldSlug)->update([
                    'slug' => $product->slug,
                    'url' => url('product-detail/' . $product->slug),
                    'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                ]);
            }
        });
    }

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
        return $this->belongsTo(Country::class, 'country_id'); // Adjust the foreign key if necessary
    }
    public function enquiries()
    {
        return $this->hasMany(ProductEnquiry::class);
    }
    public function hotdeal()
    {
        return $this->hasMany(HotDealModal::class , 'product_id');
    }
    public function distribution()
    {
        return $this->hasMany(Distribution::class , 'product_id');
    }
}
