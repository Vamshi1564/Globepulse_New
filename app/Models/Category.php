<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_category';


    protected $fillable = [
        'cat_name',
        'cat_des',
        'slug',
        'icon_class',
        'main_cat_img',
        'maincat_bgimg',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected static function booted()
    {

        static::created(function ($category) {
            Sitemap::create([
                'slug' => $category->slug,
                'url' => url('products-category/' . $category->slug), // The category URL
                'created_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
            ]);
        });


        static::updated(function ($category) {
            // Handle both create and update using the `saved` event
            // $newSlug = str_replace(' ', '-', strtolower($category->cat_name));

            // if ($category->slug !== $newSlug) {
            //     $category->slug = $newSlug;
            //     $category->save(); // Save without triggering another update event
            // }

            // Sitemap::updateOrCreate(
            //     ['slug' => $category->getOriginal('slug')], // Look for an existing record with the same slug
            //     [
            //         'slug' => $newSlug,
            //         'url' => url('products-category/' . $newSlug), // The category URL
            //         'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(), // Set the updated timestamp
            //     ]
            // );

            Sitemap::where('slug', $category->getOriginal('slug')) // Find the existing entry by old slug
                ->update([
                    'slug' => $category->slug, // Update to the new slug entered in form
                    'url' => url('products-category/' . $category->slug),
                    'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                ]);
        });


        // static::updating(function ($category) {
        //     if ($category->isDirty('slug')) { // Check if slug is being updated
        //         $oldSlug = $category->getOriginal('slug'); // Get the old slug

        //         // Update the sitemap entry
        //         Sitemap::where('slug', $oldSlug)->update([
        //             'slug' => $category->slug,
        //             'url' => url('products-category/' . $category->slug),
        //             'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
        //         ]);
        //     }
        // });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function sitemap()
    {
        return $this->hasMany(Sitemap::class);
    }
    // public function subSubcategories()
    // {
    //     return $this->hasMany(Subsubcategory::class);  // Adjust as per your structure
    // }

     public function VerifybuyersModal()
    {
        return $this->hasMany(VerifybuyersModal::class , 'category_id');
    }

    public function subSubcategories()
    {
        return $this->hasManyThrough(SubSubCategory::class, SubCategory::class);
    }
}
