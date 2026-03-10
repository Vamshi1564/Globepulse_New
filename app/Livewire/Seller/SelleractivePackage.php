<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\PackagesModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SelleractivePackage extends Component
{
    public function render()
    {
        $customerId = Session::get('id'); // Get user ID from session
        $customer = Customer::find($customerId);
        $PackageId = $customer->package_id;

        // $package = PackagesModel::with('points')->find($PackageId);
        $package = ItemsModel::with('points')->find($PackageId);

        // Get all packages in the order you display them
        $borderColors = [
            '#4ECDC4',
            '#F7B801',
            '#FF6F61',
            '#FF9671',
            '#845EC2',
            '#00C9A7',
        ];

        // Assign color directly based on package ID order
        $firstPackageId = ItemsModel::orderBy('id')->first()?->id ?? 1;
        $index = ($package->id - $firstPackageId) % count($borderColors);

        $activeColor = $borderColors[$index];

        return view('livewire.seller.selleractive-package', compact('PackageId', 'package', 'activeColor'));
    }
}
