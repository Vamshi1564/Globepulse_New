<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    protected $table = 'tbl_sub_subcategory';

    protected $fillable = [
        'sub_subcat_name',
        'slug',
        'subcategory_id',
        'icon_class',
        'sub_subcat_img',
        'category_id',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];




    protected static function booted()
    {

        static::created(function ($subsubcategory) {
            // Handle only the creation event
            Sitemap::create([
                'slug' => $subsubcategory->slug,
                'url' => url('products-category/' . $subsubcategory->subcategory->category->slug . '/' . $subsubcategory->subcategory->slug . '/' . $subsubcategory->slug), // The subsubcategory URL
                'created_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(), // Set the created timestamp
                'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(), // Set the updated timestamp as well (same for creation)
            ]);
        });

        static::updated(function ($subsubcategory) {
            // Handle both create and update using the `saved` event

            // $newSlug = str_replace(' ', '-', strtolower($subsubcategory->sub_subcat_name));

            // if ($subsubcategory->slug !== $newSlug) {
            //     $subsubcategory->slug = $newSlug;
            //     $subsubcategory->save(); // Save without triggering another update event
            // }

            // Sitemap::updateOrCreate(
            //     ['slug' => $subsubcategory->getOriginal('slug')], // Look for an existing record with the same slug
            //     [
            //         'slug' => $newSlug,
            //         'url' => url('products-category/' . $subsubcategory->subcategory->category->slug . '/' . $subsubcategory->subcategory->slug . '/' . $newSlug), // The subsubcategory URL
            //         'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(), // Set the updated timestamp
            //     ]
            // );

            Sitemap::where('slug', $subsubcategory->getOriginal('slug')) // Find the existing entry by old slug
                ->update([
                    'slug' => $subsubcategory->slug, // Update to the new slug entered in form
                    'url' => url('products-category/' . $subsubcategory->subcategory->category->slug . '/' . $subsubcategory->subcategory->slug . '/' . $subsubcategory->slug),
                    'updated_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                ]);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
