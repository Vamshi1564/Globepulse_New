<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'tbl_subcategory';

    protected $fillable = [
        'sub_cat_name',
        'subcat_des',
        'slug',
        'sub_cat_img',
        'subcat_bgimg',
        'icon_class',
        'category_id',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected static function booted()
    {

        static::created(function ($subcategory) {
            Sitemap::create([
                'slug' => $subcategory->slug,
                'url' => url('products-category/' . $subcategory->category->slug . '/' . $subcategory->slug), // The subcategory URL
                'created_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
            ]);
        });

        static::updated(function ($subcategory) {
            // Handle both create and update using the `saved` event

            // $newSlug = str_replace(' ', '-', strtolower($subcategory->sub_cat_name));

            // if ($subcategory->slug !== $newSlug) {
            //     $subcategory->slug = $newSlug;
            //     $subcategory->save(); // Save without triggering another update event
            // }

            // Sitemap::updateOrCreate(
            //     ['slug' => $subcategory->getOriginal('slug')], // Look for an existing record with the same slug
            //     [
            //         'slug' => $newSlug,
            //         'url' => url('products-category/' . $subcategory->category->slug . '/' . $newSlug), // The subcategory URL
            //         'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(), // Set the updated timestamp
            //     ]
            // );


            Sitemap::where('slug', $subcategory->getOriginal('slug')) // Find the existing entry by old slug
                ->update([
                    'slug' => $subcategory->slug, // Update to the new slug entered in form
                    'url' => url('products-category/' . $subcategory->category->slug . '/' . $subcategory->slug),
                    'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                ]);
        });

        // static::updating(function ($subcategory) {
        //     if ($subcategory->isDirty('slug')) { // Check if slug is being updated
        //         $oldSlug = $subcategory->getOriginal('slug'); // Get the old slug

        //         // Update the sitemap entry
        //         Sitemap::where('slug', $oldSlug)->update([
        //             'slug' => $subcategory->slug,
        //             'url' => url('products-category/' . $subcategory->category->slug . '/' .  $subcategory->slug),
        //             'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
        //         ]);
        //     }
        // });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function SubSubCategory()
    {
        return $this->hasMany(SubSubCategory::class);
    }
}
