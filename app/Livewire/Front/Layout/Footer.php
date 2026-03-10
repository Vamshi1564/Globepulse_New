<?php

namespace App\Livewire\Front\Layout;

use App\Models\Category;
use App\Models\Customer;
use Livewire\Component;

class Footer extends Component
{
    public function redirectToProductAdd()
    {
        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Access Denied, You must be logged in to access.'); // Redirect to login if not authenticated
        }

        // Retrieve the customer from the database using the session ID
        $user = Customer::find($customerId);

        // Check if user is a seller
        // if ($user && $user->user_type !== 'Seller' && $user->user_type !== "Both") {
        //     session()->flash('error', 'You must create an account as a seller to add products.');
        //     return redirect()->route('signup'); // Redirect to signup if not a seller
        // }
        if (!$user) {
            session()->flash('error', 'You must create an account to add products.');
            return redirect()->route('signup'); // Redirect to signup if not a seller
        }

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
        $user = Customer::find($customerId);

        // Check if user is a seller
        // if ($user && $user->user_type !== 'Seller' && $user->user_type !== "Both") {
        //     session()->flash('error', 'You must create an account as a seller to post requirements.');
        //     return redirect()->route('signup'); // Redirect to signup if not a seller
        // }

        if (!$user) {
            session()->flash('error', 'You must create an account to add post requirements.');
            return redirect()->route('signup'); // Redirect to signup if not a seller
        }

        // Redirect to post requirements page if user is a seller
        return redirect()->route('postbyrequirement');
    }

    public function render()
    {
        $categories = Category::limit(4)->get();
        return view('livewire.front.layout.footer', compact('categories'));
    }
}
