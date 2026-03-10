<?php

namespace App\Livewire\Front;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Distribution;
use App\Models\Product;
use App\Models\Productgallery;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductDetail extends Component
{
    // public $slug;
    // public $images = "../../../assets/img/products/details/blue_front.png","../../../assets/img/products/details/blue_back.png","../../../assets/img/products/details/blue_side.png";
    public $product;
    public $customer;

    public $images;
    public $similarProducts;
    public $metaTitle;
    public $metaDescription;
    public $metaKeywords;
    public $sitemapUrl;
    public $countries;
    public $message;
    public $country;
    public $city;
    public $phone_number;
    public $email;
    public $name;
    public $productGalleries;


    // public function copyProductLink()
    // {
    //     $link = url('product-detail/' . $this->product->slug);
    //     $this->dispatchBrowserEvent('copyToClipboard', ['text' => $link]);
    //     session()->flash('message', 'Product link copied successfully!');
    // }
    public function mount($slug)
    {
        // $this->slug = $slug;
        // $this->images = [
        //     "../../../assets/img/products/details/blue_front.png",
        //     "../../../assets/img/products/details/blue_back.png",
        //     "../../../assets/img/products/details/blue_side.png"
        // ];
        // $customerId = Session::get('id');

        // $this->customer = Customer::find($customerId);
        try {
            $this->countries = Country::select('country_id', 'short_name')->orderBy('short_name')->get();

            $this->product = Product::with('customer')->where('slug', $slug)->first();


            // ❗ If product not found → redirect
            if (!$this->product) {
                return redirect()->route('product.notfound');
            }

            // ❗ 2. Customer missing → redirect
            if (!$this->product->customer) {
                return redirect()->route('product.notfound');
            }
            if ($this->product) {
                $this->similarProducts = Product::where('category_id', $this->product->category_id)
                    ->where('status', 1)
                    ->where('id', '!=', $this->product->id)
                    ->limit(10)
                    ->get();
            }

            $this->sitemapUrl = url('product-detail/' . $slug);

            // $this->product = Product::where('slug', $slug)->firstOrFail();


            $this->metaTitle = $this->product->seo_title ?? null;
            $this->metaDescription = $this->product->seo_description ?? null;
            $this->metaKeywords = $this->product->seo_keywords ?? null;
        } catch (\Exception $e) {
            // ❗ Any error occurs → redirect to not found page
            return redirect()->route('product.notfound');
        }
    }

    public function addDistribution()
    {
        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Please login to apply as a distributor.');
        }


        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
            'country' => 'required',
            'message' => 'required',
        ]);

        Distribution::create([
            'name'          => $this->name,
            'product_seller_id'   => $this->product->customer_id,
            'product_id'   => $this->product->id,
            'lead_id'   => $customerId,
            'email'         => $this->email,
            'phone_number'  => $this->phone_number,
            'city'          => $this->city,
            'country'       => $this->country,
            'message'       => $this->message,
        ]);

        // $this->resetForm();
        $this->reset(['name', 'email', 'phone_number', 'city', 'country', 'message']);

        session()->flash('message', 'Distribution Data added successfully.');

        // return redirect()->to(url()->previous())->with('success', 'Distribution Data added successfully.');
    }
    public function render()
    {
        if ($this->product) {

            // Ensure product image fallback
            $this->images = [];
            if (!empty($this->product->product_img)) {
                $this->images[] = $this->product->product_img;
            }

            // Load gallery images safely
            $this->productGalleries = Productgallery::where('product_id', $this->product->id)->get();

            $galleryImages = $this->productGalleries
                ->pluck('gallery_images')
                ->filter() // remove null/empty
                ->map(function ($img) {
                    return trim($img);  // remove accidental spaces
                })
                ->toArray();

            $this->images = array_merge($this->images, $galleryImages);
        } else {
            $this->images = [];
            $this->productGalleries = collect();
        }

        return view('livewire.front.product-detail', [
            'productGalleries' => $this->productGalleries,
        ]);
    }
}