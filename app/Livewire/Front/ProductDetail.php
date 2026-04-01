<?php

namespace App\Livewire\Front;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Distribution;
use App\Models\Product;
use App\Models\Productgallery;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\RFQ;
use App\Mail\RFQMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Buyer;


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
    public $rfq_quantity;
public $rfq_target_price;
public $rfq_shipping_terms;
public $rfq_delivery_time;
public $rfq_message;
public $rfq_destination_port;
public $rfq_payment_terms;
public $rfq_attachment;


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
                session()->forget(['rfq_resume', 'rfq_data']); // prevent loop
                return redirect()->route('home')->with('error', 'Product not found.');
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

             // ✅ 🔥 ADD THIS BLOCK AT END
            if (session('rfq_resume') && session('rfq_data')) {

            $data = session('rfq_data');

            $this->rfq_quantity = $data['rfq_quantity'] ?? null;
            $this->rfq_target_price = $data['rfq_target_price'] ?? null;
            $this->rfq_shipping_terms = $data['rfq_shipping_terms'] ?? null;
            $this->rfq_delivery_time = $data['rfq_delivery_time'] ?? null;
            $this->rfq_message = $data['rfq_message'] ?? null;
            $this->rfq_destination_port = $data['rfq_destination_port'] ?? null;
            $this->rfq_payment_terms = $data['rfq_payment_terms'] ?? null;

            
           // reopen modal AFTER render cycle
            $this->dispatch('openRFQModalDelayed');

            // clear session AFTER using it
            session()->forget(['rfq_resume', 'rfq_data']);
        }

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

   public function submitRFQ()
{
    try {
        // ✅ SAME AS ProductInquiry
        $buyerId = Session::get('buyer_id');

        if (!$buyerId) {

    session([
        'rfq_pending' => true,
        'rfq_data' => [
            'product_id' => $this->product->id,
            'product_slug' => $this->product->slug, 
            'rfq_quantity' => $this->rfq_quantity,
            'rfq_target_price' => $this->rfq_target_price,
            'rfq_shipping_terms' => $this->rfq_shipping_terms,
            'rfq_delivery_time' => $this->rfq_delivery_time,
            'rfq_message' => $this->rfq_message,
            'rfq_destination_port' => $this->rfq_destination_port,
            'rfq_payment_terms' => $this->rfq_payment_terms,
        ]
    ]);

    return redirect()->route('buyer.login')
        ->with('error', 'Please login to continue RFQ');
}

        $buyer = Buyer::find($buyerId);

        // ✅ VALIDATION
        $this->validate([
            'rfq_quantity' => 'required|numeric|min:' . $this->product->min_order,
            'rfq_message' => 'required|min:10',
        ]);

        // ✅ SAVE RFQ
      $supplier = Seller::find($this->product->seller_id);
    

$rfq = RFQ::create([
    'product_id'     => $this->product->id,

    'supplier_id'    => $supplier->id,     // optional (keep for safety)
    'supplier_uuid'  => $supplier->id,   // ✅ MAIN FIELD

    'buyer_id'       => $buyer->id,
    'buyer_uuid'     => $buyer->id,      // ✅ ADD THIS

    'quantity'        => $this->rfq_quantity,
    'target_price'    => $this->rfq_target_price,
    'delivery_time'   => $this->rfq_delivery_time,
    'shipping_terms'  => $this->rfq_shipping_terms,
    'destination_port'=> $this->rfq_destination_port,
    'payment_terms'   => $this->rfq_payment_terms,
    'message'         => $this->rfq_message,

    'name'          => $buyer->name ?? null,
    'email'         => $buyer->email ?? null,
    'phone'         => $buyer->phone ?? null,
    'company_name'  => $buyer->company_name ?? null,
    'status'        => 'pending',
]);

        // ✅ TEMP: disable mail (test DB first)
  
        $supplier = Seller::find($this->product->seller_id);

        if ($supplier?->email) {
            Mail::to($supplier->email)->send(
                new RFQMail($rfq, $buyer, $supplier, 'supplier')
            );
        }

        if ($buyer?->email) {
            Mail::to($buyer->email)->send(
                new RFQMail($rfq, $buyer, $supplier, 'buyer')
            );
        }
      

        // ✅ RESET
        $this->reset([
            'rfq_quantity',
            'rfq_target_price',
            'rfq_shipping_terms',
            'rfq_delivery_time',
            'rfq_message'
        ]);

        // ✅ CLOSE POPUP
        $this->dispatch('closeRFQModal');

        // ✅ SUCCESS MESSAGE
        session()->flash('message', 'RFQ sent successfully!');

    } catch (\Exception $e) {
        session()->flash('message', 'Error: ' . $e->getMessage());
    }
}
public function updated($field)
{
    if (!in_array($field, ['rfq_quantity', 'rfq_message'])) return;

    $this->validateOnly($field, [
        'rfq_quantity' => 'required|numeric|min:' . $this->product->min_order,
        'rfq_message' => 'required|min:10',
    ]);
}
protected function rules()
{
    return [
        'rfq_quantity' => 'required|numeric|min:' . $this->product->min_order,
        'rfq_message' => 'required|min:10',
    ];
}

protected function messages()
{
    return [
        'rfq_quantity.required' => 'Quantity is required',
        'rfq_quantity.numeric' => 'Quantity must be a number',
        'rfq_quantity.min' => 'Minimum order quantity is ' . $this->product->min_order,
        'rfq_message.required' => 'Requirement is required',
        'rfq_message.min' => 'Requirement must be at least 10 characters',
    ];
}
}