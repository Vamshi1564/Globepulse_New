<?php

namespace App\Livewire\Auth;

use App\Models\Customer;
use Livewire\Component;

class AuthOtp extends Component
{
    public $otp;

    public function render()
    {
        return view('livewire.auth.auth-otp');
    }

    public function login_otp()
    {


        if (session('check_otp') == $this->otp) {

            session(['id' => session('check_id'), 'client_id' => session('client_id'), 'name' => session('check_name')]);
            session()->pull('check_id', 'check_otp', 'client_id', 'check_name', 'check_country', 'check_phonenumber', 'check_email');

            $userId = session('id');
            $user = Customer::find($userId);

            config(['session.lifetime' => 14400]);
            // if ($user && $user->user_type == 'Seller' || $user->user_type == 'Both') {
            //     return redirect()->route('seller')->with('message', 'Login successful! Welcome'. ' ' . $user->name);
            // } else {
            //     return redirect()->route('home')->with('message', 'Welcome to the platform!' . ' '. $user->name);  // Redirect to home page for non-sellers
            // }

            if ($user) {
                return redirect()->route('seller')->with('message', 'Login successful! Welcome' . ' ' . $user->name);
            }
        } else {
            session()->flash('error', 'Invalid OTP');
        }
    }
}
