<?php

namespace App\Livewire\Front;

use App\Models\BuyleadEnquiry;
use App\Models\Customer;
use App\Models\Postrequirment;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class BuyleadInquiry extends Component
{
    public $buyer_id;
    public $supplier_id;
    public $postbyrequirement_id;
    public $customer_id;
    public $title;
    public $email;
    public $phonenumber;
    public $company_name;
    public $product_name;

    public function mount($customer_id, $postbyrequirement_id)
    {


        if (!Session::has('id')) {
            // Redirect to login page if the session ID is missing
            return redirect()->route('login')->with('error' , 'Access Denied , You must be logged in to access');
        }


        // Get sender_id (logged-in customer) from session
        $this->buyer_id = Session::get('id');

        // Set the customer_id from the parameter
        $this->customer_id = $customer_id;


        // Get product details
        $postbyrequirement = Postrequirment::find($postbyrequirement_id);

        if ($postbyrequirement) {
            $this->product_name = $postbyrequirement->product_name;
            $this->supplier_id = $postbyrequirement->customer_id; // Assuming product has a seller_id field
        }

        // Get customer details for sender 
        if ($this->buyer_id) {
            $customer = Customer::find($this->buyer_id);
            if ($customer) {
                $this->email = $customer->email;
                $this->phonenumber = $customer->phonenumber;
                $this->company_name = $customer->company;
            }
        }
    }

    public function submit()
    {
        // Validate form data
        $this->validate([
            'email' => 'required|email',
            'phonenumber' => 'required|numeric',
            'company_name' => 'required',
            'product_name' => 'required',
        ]);

        // Store inquiry with sender_id (from session) and receiver_id (product's owner)
        BuyleadEnquiry::create([
            'buyer_id'  => $this->buyer_id,   // Sender's customer_id (the one making the inquiry)
            'customer_id' => $this->customer_id,   // Sender's customer_id (the one making the inquiry)
            'supplier_id' => $this->supplier_id,  // Receiver's customer_id (product's owner/seller)
            'postbyrequirement_id' => $this->postbyrequirement_id,   // The product the inquiry is about
            'email' => $this->email,      // The inquiry message
            'phonenumber' => $this->phonenumber,      // The inquiry message
            'company_name' => $this->company_name,      // The inquiry message
            'product_name' => $this->product_name,      // The inquiry message
        ]);

        $this->reset();

        // After storing, you can show a success message or redirect the user
        return redirect()->route('byleads')
            ->with('message', 'Your inquiry has been sent successfully!');
        // session()->flash('message', 'Your Enquiry has been sent successfully!');
    }
    
    public function render()
    {
        return view('livewire.front.buylead-inquiry');
    }
}
