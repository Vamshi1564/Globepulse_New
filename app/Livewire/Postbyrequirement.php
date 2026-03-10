<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Postrequirment;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Postbyrequirement extends Component
{
    public $product_name;
    public $quantity;
    public $mobile;
    public $location;

    public function mount()
    {
        $customerId = Session::get('id');

        // Retrieve customer details based on the customer_id
        $customer = Customer::find($customerId);
        if ($customer) {
            $this->mobile = $customer->phonenumber;  
            $this->location = $customer->state;  
        }
    }


    public function submit()
    {
        $validated = $this->validate([
            'product_name' => 'required',
            'quantity' => 'required',
            'mobile' => 'required|numeric',
            'location' => 'required',
        ]);


        $customerId = Session::get('id');
        $customer = Customer::find($customerId);
        $countryId =  $customer->country_id; 

        Postrequirment::create([
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'location' => $this->location,
            'mobile' => $this->mobile,
            'customer_id' => $customerId, // Automatically store logged-in customer's ID
            'country_id' => $countryId ,
            'status' => 2
        ]);

        session()->flash('message', 'Submited Successfully.');
        $this->reset();
        return redirect()->to(request()->header('Referer'));

    }
    public function render()
    {
        return view('livewire.postbyrequirement');
    }
}
