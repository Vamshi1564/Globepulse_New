<?php

namespace App\Livewire\Front;

use App\Models\Country;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    // public $slug;
    public $searchTerm;
    public $countries = [];
    public $searchCountry = '';
    public $selectedCountries = [];
    public $minPrice;
    public $maxPrice;
    public $minOrder = 0;
    public $loadingPage = 8;



    public function mount()
    {

        // $this->searchTerm = $searchTerm;
        $this->searchTerm = trim(request()->query('searchTerm', ''));
        // $this->products = ModelsProduct::where('status', 1)->where('title', 'like', '%' . $this->searchTerm . '%')->get();
        //   $this->products = ModelsProduct::all();

        // $this->slug = $slug;
        // $this->searchTerm = $query;

        $this->minPrice = Session::get('minPrice');
        $this->maxPrice = Session::get('maxPrice');
        $this->minOrder = Session::get('minOrder');
        $this->selectedCountries = Session::get('selectedCountries', []);

        $this->countries = Country::all();  // Fetch all countries


        $this->loadProducts();
    }

    public function loadMore()
    {
        $this->loadingPage += 8; // Increment number of products loaded

    }

    public function updatedSelectedCountries()
    {
        Session::put('selectedCountries', $this->selectedCountries);


        // Reload products whenever selected countries change
        $this->loadProducts();
    }

    public function loadProducts()
    {

        $query = ModelsProduct::query()->where('status', 1);

        if (!empty($this->searchTerm)) {
            $query->where('title', 'like', '%' . $this->searchTerm . '%');
        }

        // Apply filters
        if (!empty($this->minPrice)) {
            $query->where('min_price', '>=', $this->minPrice);
        }

        if (!empty($this->maxPrice)) {  
            $query->where('max_price', '<=', $this->maxPrice);
        }

        if (!empty($this->minOrder)) {
            $query->where('min_order', '=', $this->minOrder);
        }

        if (is_array($this->selectedCountries) && count($this->selectedCountries) > 0) {
            $query->whereIn('country_id', $this->selectedCountries); // Filter by selected country IDs
        }


        return $query->paginate($this->loadingPage);
    }


    public function applyFilters()
    {
        // Save minPrice and maxPrice to session
        Session::put('minPrice', $this->minPrice);
        Session::put('maxPrice', $this->maxPrice);
        Session::put('minOrder', $this->minOrder);

        // Reload products after applying filters
        $this->loadProducts();
    }

    public function render()
    {
        // $product = Product::where('slug',$this->slug)->first();
        // $products = ModelsProduct::where('status', 1)
        //     ->where('title', 'like', '%' . $this->searchTerm . '%')
        //     ->paginate(10);

        $products = $this->loadProducts();

        $filteredCountries = Country::where('short_name', 'like', '%' . $this->searchCountry . '%')->get();

        return view('livewire.front.product', [
            'products' => $products,
            'filteredCountries' => $filteredCountries,
        ]);
    }
}
