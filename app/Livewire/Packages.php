<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\PackagesModel;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Packages extends Component
{
    public $customerId;
    public $PackageId;
    public $packages;
    // public $customerPackages = [];

    public $couponCodes = []; // store coupon code for each package
    public $discountedPrices = []; // store calculated discounted price for each package

    public function mount()
    {
        $this->customerId = Session::get('id');

        $customer = Customer::find($this->customerId);

        if ($customer) {
            $this->PackageId = $customer->package_id; // Store the package ID
        }

        $this->packages = ItemsModel::where('b2b_status' , 1)->with('points')->orderBy('package_sequence', 'asc')->get();


        foreach ($this->packages as $pkg) {
            $key = "discounted_price_{$this->customerId}_{$pkg->id}";
            $this->discountedPrices[$pkg->id] = session($key, $pkg->rate);
        }

        // if ($customer) {
        //     // Fetch the list of package IDs that the customer has purchased
        //     $this->customerPackages = $customer->payments->pluck('id')->toArray();
        // } 

    }

    public function applyCoupon($packageId)
    {
        $package = ItemsModel::find($packageId);

        if (!$package) return;

        $enteredCoupon = $this->couponCodes[$packageId] ?? null;

        if ($enteredCoupon && $package->coupon_code === $enteredCoupon) {
            // if ($package->discount_amount) {
            //     $this->discountedPrices[$packageId] = max($package->price - $package->discount_amount, 0);
            // }
            $discountedPrice = max($package->rate - $package->discount_amount, 0);
            $this->discountedPrices[$packageId] = $discountedPrice;

            session()->put("discounted_price_{$this->customerId}_{$packageId}", $discountedPrice);

            session()->flash('message', 'Coupon applied successfully!');
        } else {
            session()->forget("discounted_price_{$this->customerId}_{$packageId}");

            $this->discountedPrices[$packageId] = $package->rate;
            session()->flash('error', 'Invalid coupon code!');
        }
    }


    public function render()
    {
        return view('livewire.packages');
    }
}
