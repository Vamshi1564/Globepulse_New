<?php

namespace App\Livewire\Front;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductEnquiry;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductInquiry extends Component
{
    public $buyer_id;
    public $supplier_id;
    public $product_id;
    public $quantity;
    public $customer_id;

    public $email;
    public $phonenumber;
    public $company_name;
    public $product_name;

    public $product; // 🔹 store product

    public function mount($customer_id, $product_id)
    {

        if (!Session::has('id')) {
            return redirect()->route('login')
                ->with('error', 'Access Denied. Please login first.');
        }

        $this->buyer_id = Session::get('id');
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;

        // 🔹 load product
        $this->product = Product::find($product_id);

        if ($this->product) {

            $this->product_name = $this->product->title;
            $this->supplier_id = $this->product->customer_id;

            // MOQ default quantity
            $this->quantity = $this->product->min_order;
        }

        // buyer details
        $customer = Customer::find($this->buyer_id);

        if ($customer) {
            $this->email = $customer->email;
            $this->phonenumber = $customer->phonenumber;
            $this->company_name = $customer->company;
        }
    }

    public function submit()
    {
        $product = Product::find($this->product_id);

        $this->validate([
            'email' => 'required|email',
            'phonenumber' => 'required|numeric',
            'company_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|integer|min:' . $product->min_order,
        ]);

        ProductEnquiry::create([
            'buyer_id' => $this->buyer_id,
            'customer_id' => $this->customer_id,
            'supplier_id' => $this->supplier_id,
            'product_id' => $this->product_id,
            'email' => $this->email,
            'phonenumber' => $this->phonenumber,
            'company_name' => $this->company_name,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
        ]);

        return redirect()->route('product-detail', ['slug' => $product->slug])
            ->with('message', 'Your inquiry has been sent successfully!');
    }

    public function render()
    {
        return view('livewire.front.product-inquiry', [
            'product' => $this->product
        ]);
    }
}