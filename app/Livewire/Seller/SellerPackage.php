<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\Membership;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SellerPackage extends Component
{
    public function render()
    {
        $customerId = Session::get('id'); // Get user ID from session
        $lead = Customer::where('id', $customerId)->first();
        $package = ItemsModel::find($lead->package_id);

        

        return view('livewire.seller.seller-package' , compact('package'));
    }
}
