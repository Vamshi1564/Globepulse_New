<?php
// FILE: app/Livewire/Front/SellerSignup.php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use App\Models\SellerDetail;
use App\Models\AuditLog;
use App\Mail\SellerOtpMail;
use App\Services\SellerSmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SellerSignup extends Component
{
    public $name            = '';
    public $email           = '';
    public $phonenumber     = '';
    public $company         = '';
    public $company_website = '';
    public $country         = '';   // stores tblcountries.country_id
    public $countries       = [];

    public function mount()
    {
        // Use DB::table directly — Country model uses 'id' PK but tblcountries uses 'country_id'
        $this->countries = DB::table('tblcountries')
            ->select('country_id', 'short_name', 'long_name', 'iso2', 'calling_code')
            ->orderBy('short_name')
            ->get();
    }

    public function submit()
    {
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

        // ── Lookup country from tblcountries using country_id ──
        $countryRow = DB::table('tblcountries')
            ->where('country_id', $this->country)
            ->first();

        Log::info("SellerSignup: country input=[{$this->country}] found=" . ($countryRow ? $countryRow->short_name : 'NULL'));

        // Extract values to store
        // country_code = full country name  e.g. "India"
        // country_id   = calling code       e.g. "91"
        // long_name is empty in tblcountries — use short_name
        $countryName    = (!empty($countryRow?->long_name) ? $countryRow->long_name : ($countryRow?->short_name ?? 'Unknown'));
        $callingCode    = $countryRow
            ? preg_replace('/[^0-9]/', '', explode(',', $countryRow->calling_code ?? '91')[0]) ?: '91'
            : '91';
        $tblCountryId   = $countryRow?->country_id; // actual tblcountries PK for SMS service

        // ── Check existing email ───────────────────────────────
        $existingSeller = Seller::where('email', $emailLower)->first();

        if ($existingSeller) {
            if ($existingSeller->email_verified == 1) {
                $this->addError('email', 'This email is already registered. Please login instead.');
                return;
            }
            $newTempPassword = $this->generateTempPassword();
            $existingSeller->password_hash        = Hash::make($newTempPassword);
            $existingSeller->must_change_password = 1;
            $existingSeller->save();

            $sellerName = $existingSeller->details?->legal_business_name ?? trim($this->name);
            $this->fireOtp($existingSeller->id, $emailLower, $this->phonenumber, $sellerName, $newTempPassword, $tblCountryId);
            session(['seller_register_email' => $emailLower]);

            return redirect()->route('seller.verify.otp')
                ->with('otp_success', 'OTP sent to your Email, SMS & WhatsApp (' . $emailLower . '). Enter the 4-digit code below.');
        }

        // ── New registration ───────────────────────────────────
        $tempPassword = $this->generateTempPassword();

        $seller = Seller::create([
            'id'                   => (string) Str::uuid(),
            'email'                => $emailLower,
            'phone'                => $this->phonenumber,
            'password_hash'        => Hash::make($tempPassword),
            'country_id'           => $tblCountryId,   // tblcountries.country_id integer (101 for India)
            'country_code'         => $countryName,    // e.g. "India" — full country name
            'account_type'         => 'seller',
            'email_verified'       => 0,
            'status'               => 'pending',
            'is_active'            => 1,
            'must_change_password' => 1,
        ]);

        SellerDetail::create([
            'id'                  => (string) Str::uuid(),
            'seller_id'           => $seller->id,
            'legal_business_name' => trim($this->company),
            'company_website'     => $this->company_website ?: null,
            'onboarding_step'     => 1,
            'kyc_status'          => 'not_started',
            'is_locked'           => 0,
        ]);

        AuditLog::record(
            action:     'SELLER_REGISTERED',
            entityType: 'sellers',
            entityId:   $seller->id,
            newValue:   ['email' => $seller->email, 'company' => $this->company]
        );

        $this->fireOtp($seller->id, $emailLower, $this->phonenumber, trim($this->name), $tempPassword, $tblCountryId);
        session(['seller_register_email' => $emailLower]);

        return redirect()->route('seller.verify.otp')
            ->with('otp_success', 'OTP sent to your Email, SMS & WhatsApp (' . $emailLower . '). Enter the 4-digit code below.');
    }

    private function fireOtp(string $sellerId, string $email, string $phone, string $name, string $tempPassword, mixed $tblCountryId = null): void
    {
        // 4-digit OTP
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        Cache::put('seller_otp_' . md5($email), [
            'otp_hash'      => bcrypt($otp),
            'seller_name'   => $name,
            'temp_password' => $tempPassword,
            'seller_id'     => $sellerId,
        ], now()->addMinutes(10));

        // Email OTP
        try {
            Mail::to($email)->send(new SellerOtpMail($otp, $name, $email));
        } catch (\Exception $e) {
            Log::error("SellerSignup: Email OTP failed — " . $e->getMessage());
        }

        // SMS + WhatsApp OTP
        try {
            app(SellerSmsService::class)->sendOtpSms($phone, $otp, $name, $tblCountryId);
        } catch (\Exception $e) {
            Log::error("SellerSignup: SMS/WA OTP failed — " . $e->getMessage());
        }
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