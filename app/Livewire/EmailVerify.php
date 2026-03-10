<?php

namespace App\Livewire;

use App\Mail\OtpEmail;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;


class EmailVerify extends Component
{
    public $email, $country_id, $otp;
    public $step = 1;
    public function flushSession()
    {
        session()->flush();
        return redirect()->route('login'); // redirect to login page
    }

    public function sendOtp()
    {
        $this->validate(
            [
                'email' => 'required|email|unique:tblleads,email',
                'country_id' => 'required',
            ],
            [
                'country_id.required' => 'Please select a country.',
            ]
        );

        $otpCode = rand(100000, 999999);
        session([
            'otp_email' => $this->email,
            'otp_country' => $this->country_id,
            'otp_code' => $otpCode,
        ]);

        Mail::to($this->email)->send(new OtpEmail("Your OTP is {$otpCode}", 'Email Verification OTP', $otpCode));

        $this->step = 2;
    }

    public function verifyOtp()
    {
        if ($this->otp == session('otp_code')) {
            $customer = Customer::create([
                'email' => $this->email,
                'country_id' => $this->country_id,

                // add any other fields if needed
            ]);
            // Redirect to signup page with customer ID
            return redirect()->route('signup', ['id' => $customer->id]);
        } else {
            session()->flash('error', 'Invalid OTP. Please try again.');
        }
    }
    public function render()
    {
        $countries = Country::orderBy('short_name')->get();

        return view('livewire.email-verify', compact('countries'));
    }
}
