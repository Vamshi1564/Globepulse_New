<?php
// FILE: app/Livewire/Front/Seller.php

namespace App\Livewire\Front;

use Livewire\Component;

class Sellerl extends Component
{
    // Form fields (only used after we wire up DB — for now just public vars)
    public $name          = '';
    public $email         = '';
    public $phonenumber   = '';
    public $company       = '';
    public $company_website = '';
    public $country       = '';
    public $countries     = [];

    public function mount()
    {
        // Load countries — same model your existing signup uses
        // Change \App\Models\Country to whatever model name you use
        $this->countries = \App\Models\Country::orderBy('short_name')->get();
    }

    public function submit()
    {
        // DB logic will go here later
        // For now just redirect to OTP page to test the view
        session()->flash('message', 'OTP sent to ' . $this->email);
        return redirect()->route('seller.verify.otp');
    }

    public function render()
    {
        // ✅ NO ->extends() or ->layout() — your blade handles header/footer directly
        // Same pattern as your existing signup component
        return view('livewire.front.sellerl');
    }
}