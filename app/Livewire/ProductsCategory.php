<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsCategory extends Component
{
    use WithPagination;
    public $category;
    public $subcategory;
    public $subSubcategory;
    public $loadingPage = 8;
    public $loadedProducts = 0;
    public $countries = [];
    public $searchCountry = '';
    public $selectedCountries = [];
    public $minPrice;
    public $maxPrice;
    public $minOrder;
    public $metaTitle; // Fields for the update form
    public $metaDescription; // Fields for the update form
    public $metaKeywords;
    public $sitemapUrl;
    public $bgImage;

    public function mount($categorySlug, $subcategorySlug = null, $subSubcategorySlug = null)
    {
        // Load the main category
        $this->category = Category::where('slug', $categorySlug)->firstOrFail();

        // Load subcategory if provided
        if ($subcategorySlug) {
            $this->subcategory = Subcategory::where('slug', $subcategorySlug)
                ->where('category_id', $this->category->id)
                ->first();
        }

        // Load sub-subcategory if provided
        // if ($subSubcategorySlug) {
        //     $this->subSubcategory = SubSubCategory::where('slug', $subSubcategorySlug)
        //         ->where('subcategory_id', $this->subcategory->id)
        //         ->first();
        // }
        if ($subSubcategorySlug && $this->subcategory) {
            $this->subSubcategory = SubSubCategory::where('slug', $subSubcategorySlug)
                ->where('subcategory_id', $this->subcategory->id)
                ->first();
        }


        // Determine the background image
        if ($this->subSubcategory) {
            $this->bgImage = ''; // No background for sub-subcategory
        } elseif ($this->subcategory) {
            $this->bgImage = asset('storage/' . $this->subcategory->subcat_bgimg);
        } elseif ($this->category) {
            $this->bgImage = asset('storage/' . $this->category->maincat_bgimg); // Use main category background if available
        } else {
            $this->bgImage = asset('assets/img/background-img-cat.jpg');
        }

        $this->sitemapUrl = url('products-category/' . $categorySlug);

        if ($subcategorySlug) {
            $this->sitemapUrl .= '/' . $subcategorySlug;
        }

        if ($subSubcategorySlug) {
            $this->sitemapUrl .= '/' . $subSubcategorySlug;
        }


        // $this->minPrice = Session::get('minPrice');
        // $this->maxPrice = Session::get('maxPrice');
        // $this->minOrder = Session::get('minOrder');
        // $this->selectedCountries = Session::get('selectedCountries', []);


        // Initialize loaded products
        // $this->loadedProducts = $this->loadingPage;

        $this->countries = Country::all();  // Fetch all countries

        // Load products based on the selected category hierarchy
        $this->loadProducts();


        // if ($this->subSubcategory) {

        //     $this->subSubcategory = SubSubCategory::where('slug', $subSubcategorySlug)->firstOrFail();

        //     $this->metaTitle = $this->subSubcategory->seo_title ?? null;
        //     $this->metaDescription = $this->subSubcategory->seo_description ?? null;
        //     $this->metaKeywords = $this->subSubcategory->seo_keywords ?? null;
        // } elseif ($this->subcategory) {

        //     $this->subcategory = Subcategory::where('slug', $subcategorySlug)->firstOrFail();

        //     $this->metaTitle = $this->subcategory->seo_title ?? null;
        //     $this->metaDescription = $this->subcategory->seo_description ?? null;
        //     $this->metaKeywords = $this->subcategory->seo_keywords ?? null;
        // } else {

        //     $this->category = Category::where('slug', $categorySlug)->firstOrFail();


        //     $this->metaTitle = $this->category->seo_title ?? null;
        //     $this->metaDescription = $this->category->seo_description ?? null;
        //     $this->metaKeywords = $this->category->seo_keywords ?? null;
        // }

        if ($this->subSubcategory) {
            $this->metaTitle = $this->subSubcategory->seo_title ?? null;
            $this->metaDescription = $this->subSubcategory->seo_description ?? null;
            $this->metaKeywords = $this->subSubcategory->seo_keywords ?? null;
        } elseif ($this->subcategory) {
            $this->metaTitle = $this->subcategory->seo_title ?? null;
            $this->metaDescription = $this->subcategory->seo_description ?? null;
            $this->metaKeywords = $this->subcategory->seo_keywords ?? null;
        } else {
            $this->metaTitle = $this->category->seo_title ?? null;
            $this->metaDescription = $this->category->seo_description ?? null;
            $this->metaKeywords = $this->category->seo_keywords ?? null;
        }


        // $this->category = Category::where('slug', $categorySlug)->firstOrFail();

        // $this->metaTitle = $this->category->seo_title ?? null;
        // $this->metaDescription = $this->category->seo_description ?? null;
        // $this->metaKeywords = $this->category->seo_keywords ?? null;
    }

    public function loadMore()
    {
        $this->loadingPage += 8; // Increment number of products loaded
        // $this->loadProducts();
    }


    // public function loadProducts()
    // {
    //     if ($this->subSubcategory) {
    //         return Product::where('sub_subcategory_id', $this->subSubcategory->id);
    //     } elseif ($this->subcategory) {
    //         return Product::where('subcategory_id', $this->subcategory->id);
    //     } else {
    //         return Product::where('category_id', $this->category->id);
    //     }
    // }


    public function updatedSelectedCountries()
    {
        // When a country is selected or unselected
        // if (!empty($value)) {
        // $this->selectedCountries = [$value]; // Only allow one selected country
        // Session::put('selectedCountries', $this->selectedCountries);
        // } 
        // else {
        //     $this->selectedCountries = []; // Clear selection if none is chosen
        //     Session::forget('selectedCountries'); // Remove from session
        // }

        // Reload products w henever selected countries change
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $query = Product::query()->where('status', 1);

        if ($this->subSubcategory) {
            $query->where('sub_subcategory_id', $this->subSubcategory->id);
        } elseif ($this->subcategory) {
            $query->where('subcategory_id', $this->subcategory->id);
        } else {
            $query->where('category_id', $this->category->id);
        }

        // Apply filters
        if ($this->minPrice !== null && $this->minPrice !== '') {
            $query->where('min_price', '>=', $this->minPrice);
        }

        if ($this->maxPrice !== null && $this->maxPrice !== '') {
            $query->where('max_price', '<=', $this->maxPrice);
        }

        if ($this->minOrder !== null && $this->minOrder !== '') {
            $query->where('min_order', '=', $this->minOrder);
        }

        if (is_array($this->selectedCountries) && count($this->selectedCountries) > 0) {
            $query->whereIn('country_id', $this->selectedCountries); // Filter by selected country IDs
        }
        // $query->whereIn('country', $this->countries)
        //     ->where('min_price', '>=', $this->minPrice)
        //     ->where('max_price', '<=', $this->maxPrice);
        // ->where('min_order', '>=', $this->minOrder);

        return $query->paginate($this->loadingPage);

        // infinite scrolling
        // return $query->take($this->loadingPage)->get();

    }


    public function applyFilters()
    {
        // Save minPrice and maxPrice to session
        // Session::put('minPrice', $this->minPrice);
        // Session::put('maxPrice', $this->maxPrice);
        // Session::put('minOrder', $this->minOrder);

        // Reload products after applying filters
        $this->loadProducts();
    }


    public function render()
    {

        $subcategories = Subcategory::where('category_id', $this->category->id)->get();

        $subSubcategories = [];

        // If there is a selected subcategory, fetch its sub-subcategories
        if ($this->subcategory) {
            $subSubcategories = SubSubcategory::where('subcategory_id', $this->subcategory->id)->get();
        }

        $products = $this->loadProducts();

        $filteredCountries = Country::where('short_name', 'like', '%' . $this->searchCountry . '%')->get();


        return view('livewire.products-category', [
            'subcategories' => $subcategories,
            'subSubcategories' => $subSubcategories,
            'products' => $products,
            'filteredCountries' => $filteredCountries,

        ]);
    }
}
