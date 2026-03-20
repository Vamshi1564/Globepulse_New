<?php

namespace App\Http\Controllers;

use Illuminate\http\Response;
use App\Models\Sitemap;

// use Illuminate\Support\Facades\File;
class SitemapController extends Controller
{
    // public function syncAllData()
    // {
    //     // Sync Categories
    //     $categories = Category::all();
    //     foreach ($categories as $category) {
    //         if (!Sitemap::where('slug', $category->slug)->exists()) {
    //             Sitemap::create([
    //                 'slug' => $category->slug,
    //                 'url' => url('products-category/' . $category->slug),
    //                 'type' => 'category',
    //             ]);
    //         }
    //     }

    //     // Sync Subcategories
    //     $subcategories = Subcategory::all();
    //     foreach ($subcategories as $subcategory) {
    //         if (!Sitemap::where('slug', $subcategory->slug)->exists()) {
    //             Sitemap::create([
    //                 'slug' => $subcategory->slug,
    //                 'url' => url('products-category/' . $subcategory->category->slug . '/' . $subcategory->slug),
    //                 'type' => 'subcategory',
    //             ]);
    //         }
    //     }

    //     // Sync SubSubCategories
    //     $subsubcategories = SubSubCategory::all();
    //     foreach ($subsubcategories as $subsubcategory) {
    //         if (!Sitemap::where('slug', $subsubcategory->slug)->exists()) {
    //             Sitemap::create([
    //                 'slug' => $subsubcategory->slug,
    //                 'url' => url('products-category/' . $subsubcategory->category->slug . '/' . $subsubcategory->subcategory->slug . '/' . $subsubcategory->slug),
    //                 'type' => 'subsubcategory',
    //             ]);
    //         }
    //     }

    //     // Sync Products
    //     $products = Product::all();
    //     foreach ($products as $product) {
    //         if (!Sitemap::where('slug', $product->slug)->exists()) {
    //             Sitemap::create([
    //                 'slug' => $product->slug,
    //                 'url' => url('product/' . $product->slug),
    //                 'type' => 'product',
    //             ]);
    //         }
    //     }

    //     return response()->json(['message' => 'All data synced to the sitemap.']);
    // }
     public function index(): Response
    {
         $posts = Sitemap::latest()->get();
         return response()->view('livewire.sitemap', [
            'posts' => $posts
            ])->header('Content-Type', 'text/xml');
    }
}