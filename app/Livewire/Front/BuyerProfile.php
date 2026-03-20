<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BuyerProfile extends Component
{
    public $activeStep = 1;

    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $company_name = '';

    public $city = '';
    public $state = '';
    public $country = '';

    public $interested_products = '';
    public $import_volume = '';

    public function mount()
    {
        if(!session('buyer_id')){
            return redirect()->route('buyer.login');
        }

        $buyer = DB::table('buyers')
        ->where('id',session('buyer_id'))
        ->first();

        if($buyer){

            $this->full_name = $buyer->full_name ?? '';
            $this->email = $buyer->email ?? '';
            $this->phone = $buyer->phone ?? '';
            $this->company_name = $buyer->company_name ?? '';

            $this->city = $buyer->city ?? '';
            $this->state = $buyer->state ?? '';
            $this->country = $buyer->country ?? '';

            $this->interested_products = $buyer->interested_products ?? '';
            $this->import_volume = $buyer->import_volume ?? '';
        }
    }

    public function saveStep1()
    {
        DB::table('buyers')
        ->where('id',session('buyer_id'))
        ->update([
            'full_name'=>$this->full_name,
            'phone'=>$this->phone,
            'company_name'=>$this->company_name
        ]);

        $this->activeStep = 2;
    }

    public function saveStep2()
    {
        DB::table('buyers')
        ->where('id',session('buyer_id'))
        ->update([
            'city'=>$this->city,
            'state'=>$this->state,
            'country'=>$this->country
        ]);

        $this->activeStep = 3;
    }

    public function saveStep3()
    {
        DB::table('buyers')
        ->where('id',session('buyer_id'))
        ->update([
            'interested_products'=>$this->interested_products,
            'import_volume'=>$this->import_volume
        ]);

        session()->flash('success','Profile updated successfully.');
    }

    public function goToStep($step)
    {
        $this->activeStep = $step;
    }

    public function render()
    {
        return view('livewire.front.buyer-profile');
    }
}