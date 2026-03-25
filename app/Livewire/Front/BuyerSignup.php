<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Mail\BuyerOtpMail;
use Propaganistas\LaravelPhone\Rules\Phone;

class BuyerSignup extends Component
{
    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $company_name = '';
    public $country_code = '';

    public $countries = [];

    public function mount()
    {
        $this->countries = Country::orderBy('short_name')->get();
    }

    public function submit()
    {
       $this->validate([
            'full_name' => [
                'required','string','min:3','max:100',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'email' => [
                'required','email','max:150'
            ],

             'phone' => [
                'required',
                'regex:/^\+?[1-9]\d{7,14}$/'
            ],

            'company_name' => [
                'nullable','string','max:150'
            ],

            'country_code' => [
                'required','exists:countries,iso2'
            ],

        ], [
            'full_name.required' => 'Full name is required',
            'full_name.min' => 'Name must be at least 3 characters',
            'full_name.regex' => 'Only letters allowed',

            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email',

            'phone.required' => 'Mobile number is required',
            'phone.phone' => 'Enter valid mobile number for selected country',

            'country_code.required' => 'Please select your country',
            'country_code.exists' => 'Invalid country selected',
        ]);

        $emailLower = strtolower(trim($this->email));

        // 1️⃣ Check if buyer already exists
        $existingBuyer = DB::table('buyers')
            ->where('email', $emailLower)
            ->first();

if ($existingBuyer) {

    // Already verified account
    if ($existingBuyer->email_verified == 1) {

        $this->addError(
            'email',
            'This email is already registered. Please login instead.'
        );

        return;
    }

    // Account exists but email not verified → resend OTP
    $newTempPassword = $this->generateTempPassword();

    DB::table('buyers')
        ->where('id', $existingBuyer->id)
        ->update([
            'password_hash' => Hash::make($newTempPassword),
            'updated_at' => now()
        ]);

    $this->fireOtp(
        $existingBuyer->id,
        $emailLower,
        $existingBuyer->full_name,
        $newTempPassword
    );

    session(['buyer_register_email' => $emailLower]);

    return redirect()->route('buyer.verify.otp')
        ->with('otp_success', 'Account already exists but not verified. A new OTP has been sent to your email.');


            // Not verified → resend OTP
            $newTempPassword = $this->generateTempPassword();

            DB::table('buyers')
                ->where('id', $existingBuyer->id)
                ->update([
                    'password_hash' => Hash::make($newTempPassword),
                    'updated_at' => now()
                ]);

            $this->fireOtp(
                $existingBuyer->id,
                $emailLower,
                $this->full_name,
                $newTempPassword
            );

            session(['buyer_register_email' => $emailLower]);

            return redirect()->route('buyer.verify.otp')
                ->with('otp_success', 'Your account was not verified yet. A new OTP was sent.');
        }

        // 2️⃣ New Buyer Registration
        $buyerId = (string) Str::uuid();

        $tempPassword = $this->generateTempPassword();

        DB::table('buyers')->insert([
            'id' => $buyerId,
            'full_name' => $this->full_name,
            'email' => $emailLower,
            'phone' => $this->phone,
            'company_name' => $this->company_name,
            'country_code' => $this->country_code,
            'password_hash' => Hash::make($tempPassword),
            'email_verified' => 0,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 3️⃣ Send OTP
        $this->fireOtp(
            $buyerId,
            $emailLower,
            $this->full_name,
            $tempPassword
        );

        session(['buyer_register_email' => $emailLower]);

        return redirect()->route('buyer.verify.otp')
            ->with('otp_success', 'A 4-digit code has been sent to ' . $emailLower);
    }

    // Generate OTP + send email
 private function fireOtp(string $buyerId, string $email, string $name, string $tempPassword)
{
    // Generate 4 digit OTP
    $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

    Cache::put('buyer_otp_' . md5($email), [
        'otp_hash' => bcrypt($otp),
        'buyer_name' => $name,
        'temp_password' => $tempPassword,
        'buyer_id' => $buyerId,
    ], now()->addMinutes(10));

    Mail::to($email)->send(new BuyerOtpMail($otp, $name, $email));
}

    private function generateTempPassword(): string
    {
        $words = ['Trade','Buyer','Market','Source','Global','Pulse'];
        $specials = ['@','#','!','$'];

        return $words[array_rand($words)]
            .$specials[array_rand($specials)]
            .rand(1000,9999);
    }

    public function render()
    {
        return view('livewire.front.buyer-register');
    }
}