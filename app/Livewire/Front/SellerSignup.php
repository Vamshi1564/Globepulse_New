<?php
// FILE: app/Livewire/Front/SellerSignup.php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use App\Models\SellerDetail;
use App\Models\AuditLog;
use App\Mail\SellerOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SellerSignup extends Component
{
    public $name            = '';
    public $email           = '';
    public $phonenumber     = '';
    public $company         = '';
    public $company_website = '';
    public $country         = '';
    public $countries       = [];

    public function mount()
    {
        $this->countries = \App\Models\Country::orderBy('short_name')->get();
    }

    public function submit()
    {
        // 1. Validate
        $this->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phonenumber'     => 'required|string|max:30',
            'company'         => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'country'         => 'required',
        ], [
            'country.required'    => 'Please select your country.',
            'company_website.url' => 'Please enter a valid URL e.g. https://yoursite.com',
        ]);

        $emailLower = strtolower(trim($this->email));

        // 2. Check if email already exists
        $existingSeller = Seller::where('email', $emailLower)->first();

        if ($existingSeller) {

            // Already verified → tell them to login
            if ($existingSeller->email_verified == 1) {
                $this->addError('email', 'This email is already registered. Please login instead.');
                return;
            }

            // Exists but NOT verified → generate new OTP + new password, resend
            $newTempPassword = $this->generateTempPassword();
            $existingSeller->password_hash        = Hash::make($newTempPassword);
            $existingSeller->must_change_password = 1;
            $existingSeller->save();

            $sellerName = $existingSeller->details?->legal_business_name ?? trim($this->name);

            $this->fireOtp($existingSeller->id, $emailLower, $sellerName, $newTempPassword);

            session(['seller_register_email' => $emailLower]);

            return redirect()->route('seller.verify.otp')
                ->with('otp_success', 'Your account was not verified yet. A new code has been sent to ' . $emailLower);
        }

        // 3. Brand new registration
        $countryRow  = \App\Models\Country::find($this->country);
        $countryCode = $countryRow ? strtoupper(substr($countryRow->short_name, 0, 2)) : 'XX';

        $tempPassword = $this->generateTempPassword();

        $seller = Seller::create([
            'id'                  => (string) Str::uuid(),
            'email'               => $emailLower,
            'phone'               => $this->phonenumber,
            'password_hash'       => Hash::make($tempPassword),
            'country_code'        => $countryCode,
            'account_type'        => 'seller',
            'email_verified'      => 0,
            'status'              => 'pending',
            'is_active'           => 1,
            'must_change_password'=> 1,
        ]);

        SellerDetail::create([
            'id'                  => (string) Str::uuid(),
            'seller_id'           => $seller->id,
            'legal_business_name' => trim($this->company),
            'company_website'     => $this->company_website ?: null,
            'onboarding_step'     => 3,
            'kyc_status'          => 'not_started',
            'is_locked'           => 0,
        ]);

        AuditLog::record(
            action:     'SELLER_REGISTERED',
            entityType: 'sellers',
            entityId:   $seller->id,
            newValue:   ['email' => $seller->email, 'company' => $this->company]
        );

        $this->fireOtp($seller->id, $emailLower, trim($this->name), $tempPassword);

        session(['seller_register_email' => $emailLower]);

        return redirect()->route('seller.verify.otp')
            ->with('otp_success', 'A 6-digit code has been sent to ' . $emailLower . '. Please check your inbox.');
    }

    // Store OTP in cache + send email
    private function fireOtp(string $sellerId, string $email, string $name, string $tempPassword): void
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put('seller_otp_' . md5($email), [
            'otp_hash'     => bcrypt($otp),
            'seller_name'  => $name,
            'temp_password'=> $tempPassword,
            'seller_id'    => $sellerId,
        ], now()->addMinutes(10));

        Mail::to($email)->send(new SellerOtpMail($otp, $name, $email));
    }

    private function generateTempPassword(): string
    {
        $words    = ['Trade', 'Globe', 'Seller', 'Export', 'Market', 'Pulse'];
        $specials = ['@', '#', '!', '$'];
        return $words[array_rand($words)] . $specials[array_rand($specials)] . rand(1000, 9999);
    }

    public function render()
    {
        return view('livewire.front.sellersignup');
    }
}