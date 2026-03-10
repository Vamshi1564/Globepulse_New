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
        // Auth::logout(); // Log out the user
        Session::flush();
        return redirect()->route('login'); // Redirect to the login page

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

        $customerId = Session::get('id'); // Assuming you're storing user ID in session
        //    if ($customerId) {
        $this->customer = Customer::find($customerId); // Retrieve the user from the database
        //    $this->profile_image = $customer->profile_image; // Get the profile image
        //    }
    }
    public function render()
    {
        return view('livewire.front.layout.header');
    }
}
