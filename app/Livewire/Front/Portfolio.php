<?php

namespace App\Livewire\Front;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SliderImage;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Portfolio extends Component
{
    // public $products;
    public $customer;
    public $company;

    public $slider_images;
    // public $profile_image; 

    public $perPage = 12;
    public $galleryPerPage = 8; // Add a variable for gallery images per page


    public function mount($customer_id)
    {
        // Fetch the customer by ID
        $this->customer = Customer::with('products')->where('id', $customer_id)->first();

        // Get all products associated with this customer
        // $this->products = Product::with('galleryimages')->where('customer_id', $customer_id)->get();

        // If customer not found, redirect to homepage
        if (!$this->customer) {
            return Redirect::to('/');
        }

        $this->slider_images = SliderImage::where('lead_id', $customer_id)->get();
    }

    public function loadMore()
    {
        // Increase the number of products to load more
        $this->perPage += 12;
    }
    public function loadMoregalley()
    {
        // Increase the number of products to load more
        $this->galleryPerPage += 8; // Add a variable for gallery images per page
    }

    public function render()
    {

        $products = Product::with(['galleryimages' => function ($query) {
            $query->paginate($this->galleryPerPage); // Paginate gallery images
        }])
            ->where('customer_id', $this->customer->id)
            ->where('status', '1')
            ->paginate($this->perPage);

        return view('livewire.front.portfolio', compact('products'));
    }
}
