<?php
// FILE: app/Livewire/Front/SellerSignup.php
// CHANGE: 4-digit OTP (999 → 9999), added SMS notification on signup

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use App\Models\SellerDetail;
use App\Models\AuditLog;
use App\Mail\SellerOtpMail;
use App\Services\SellerSmsService;
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
        $countryRow = \App\Models\Country::find($this->country);
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
            $this->fireOtp($existingSeller->id, $emailLower, $this->phonenumber, $sellerName, $newTempPassword);
            session(['seller_register_email' => $emailLower]);

            return redirect()->route('seller.verify.otp')
                ->with('otp_success', 'Your account was not verified yet. A new code has been sent to ' . $emailLower);
        }

        $tempPassword = $this->generateTempPassword();

        $seller = Seller::create([
            'id'                   => (string) Str::uuid(),
            'email'                => $emailLower,
            'phone'                => $this->phonenumber,
            'password_hash'        => Hash::make($tempPassword),
            'country_id'           => $this->country,
            'country_code'         => $countryRow?->short_name ?? 'XX',
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

        $this->fireOtp($seller->id, $emailLower, $this->phonenumber, trim($this->name), $tempPassword);
        session(['seller_register_email' => $emailLower]);

        return redirect()->route('seller.verify.otp')
            ->with('otp_success', 'A 4-digit code has been sent to ' . $emailLower . '. Please check your inbox.');
    }

    private function fireOtp(string $sellerId, string $email, string $phone, string $name, string $tempPassword): void
    {
        // ── 4-digit OTP ──────────────────────────────────────
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        Cache::put('seller_otp_' . md5($email), [
            'otp_hash'      => bcrypt($otp),
            'seller_name'   => $name,
            'temp_password' => $tempPassword,
            'seller_id'     => $sellerId,
        ], now()->addMinutes(10));

        // Email OTP
        Mail::to($email)->send(new SellerOtpMail($otp, $name, $email));

        // SMS OTP (non-blocking — failures logged, don't stop registration)
        try {
            app(SellerSmsService::class)->sendOtpSms($phone, $otp, $name);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('SellerSignup: SMS failed — ' . $e->getMessage());
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
?>