<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $customerId = Session::get('id');

        $customer = Customer::where('id' , $customerId)->first();

        return view('livewire.seller.profile' , compact('customer'));
    }
}
