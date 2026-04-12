<?php

namespace App\Livewire\Front\Layout;

use App\Models\Category;
use App\Models\Customer;
use App\Models\NewsSlider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public $categories;
    public $customer; // Property for the profile image
    public $slides;

    public function flushSession()
    {
        session()->flush();
        return redirect()->route('login'); // redirect to login page
    }
 public function logout()
{
    // Detect user type before clearing
    $isBuyer = session()->has('buyer_id');
    $isSeller = session()->has('seller_id');
    $isCustomer = session()->has('id');

    // Clear ALL session
    session()->flush();

    // Redirect based on type
    if ($isBuyer) {
        return redirect()->route('buyer.login')
            ->with('login_success', 'Logged out successfully');
    }

    if ($isSeller) {
        return redirect()->route('seller.login')
            ->with('login_success', 'Logged out successfully');
    }

    if ($isCustomer) {
        return redirect()->route('buyer.login')
            ->with('login_success', 'Logged out successfully');
    }

    // fallback
    return redirect()->route('home');
}


    public function redirectToProductAdd()
    {
        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('seller.login')->with('error', 'Access Denied, You must be logged in to access.'); // Redirect to login if not authenticated
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
    // Buyer logged in → allow
    if (session()->has('buyer_id')) {
        return redirect()->route('postbyrequirement');
    }

    // Seller logged in → block or redirect
    if (session()->has('seller_id')) {
        return redirect()->route('buyer.login')
            ->with('error', 'Please login as Buyer to post requirement.');
    }

    // Not logged in
    return redirect()->route('buyer.login')
        ->with('error', 'Please login first.');
}


    // public function mount()
    // {
    //     $this->slides = NewsSlider::all();

    //     $this->categories = Category::with('subcategory')->get();

    //     $customerId = Session::get('id'); // Assuming you're storing user ID in session
    //     //    if ($customerId) {
    //     $this->customer = Customer::find($customerId); // Retrieve the user from the database
    //     //    $this->profile_image = $customer->profile_image; // Get the profile image
    //     //    }
    // }

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
        return view('livewire.front.layout.header');
    }
}
