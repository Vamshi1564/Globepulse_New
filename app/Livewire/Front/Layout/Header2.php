<?php

namespace App\Livewire\Front\Layout;

use App\Models\Category;
use App\Models\Customer;
use App\Models\NewsSlider;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header2 extends Component
{

    public $categories;
    public $customer; // Property for the profile image
    public $slides;
    public $subcategories;


 public function logout()
{
    // Buyer logout
    if(Session::has('buyer_id')){
        Session::forget(['buyer_id','buyer_email','buyer_name']);
        return redirect()->route('buyer.login');
    }

    // Seller logout
    if(Session::has('seller_id')){
        Session::forget(['seller_id','seller_email','seller_name']);
        return redirect()->route('seller.login')
            ->with('login_success', 'You have been logged out successfully.');
    }

    // Customer logout
    if(Session::has('id')){
        Session::forget(['id']);
        return redirect()->route('login');
    }

    // Fallback
    Session::flush();
    return redirect()->route('login');
}


    public function redirectToProductAdd()
    {
        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Access Denied, You must be logged in to access.'); // Redirect to login if not authenticated
        }

        // Retrieve the customer from the database using the session ID
        // $user = Customer::find($customerId);

        // // Check if user is a seller
        // if ($user && $user->user_type !== 'Seller' && $user->user_type !== "Both") {
        //     session()->flash('error', 'You must create an account as a seller to add products.');
        //     return redirect()->route('signup'); // Redirect to signup if not a seller
        // }

        // Redirect to product add page if user is a seller
        return redirect()->route('product_add');
    }



    public function redirectToPostByRequirement()
    {

        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Access Denied, You must be logged in to access.');
        }

        // Retrieve the customer from the database using the session ID
        // $user = Customer::find($customerId);

        // // Check if user is a seller
        // if ($user && $user->user_type !== 'Seller' && $user->user_type !== "Both") {
        //     session()->flash('error', 'You must create an account as a seller to post requirements.');
        //     return redirect()->route('signup'); // Redirect to signup if not a seller
        // }

        // Redirect to post requirements page if user is a seller
        return redirect()->route('postbyrequirement');
    }


 public function mount()
{
    $this->slides = NewsSlider::all();
    $this->categories = Category::with('subcategory')->get();

    $this->customer = null;

    if(Session::has('buyer_id')){
        $this->customer = \App\Models\Buyer::find(Session::get('buyer_id'));
    } 
    elseif(Session::has('seller_id')){
        $this->customer = \App\Models\Seller::find(Session::get('seller_id'));
    } 
    elseif(Session::has('id')){
        $this->customer = Customer::find(Session::get('id'));
    }
}
    public function render()
    {
        return view('livewire.front.layout.header2');
    }
}
