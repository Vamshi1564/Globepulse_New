<?php
// FILE: app/Livewire/Front/SellerVerifyOtp.php
// CHANGE: 4-digit OTP validation, WhatsApp welcome on successful verify

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use App\Models\AuditLog;
use App\Mail\SellerCredentialsMail;
use App\Services\SellerSmsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SellerVerifyOtp extends Component
{
    public $d1=''; public $d2=''; public $d3=''; public $d4='';

    public $email      = '';
    public $errorMsg   = '';
    public $successMsg = '';

    public function mount()
    {
        $this->email = session('seller_register_email', '');
        if (empty($this->email)) {
            return redirect()->route('seller.register')
                ->with('error', 'Session expired. Please register again.');
        }
        if (session('otp_success')) {
            $this->successMsg = session('otp_success');
        }
    }

    public function verifyOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        // ── 4-digit validation ────────────────────────────────
        $entered = $this->d1.$this->d2.$this->d3.$this->d4;

        if (strlen($entered) < 4 || !ctype_digit($entered)) {
            $this->errorMsg = 'Please enter all 4 digits.';
            return;
        }

        $cacheKey = 'seller_otp_' . md5($this->email);
        $cached   = Cache::get($cacheKey);

        if (!$cached) {
            $this->errorMsg = 'Code has expired. Click "Resend Code" to get a new one.';
            return;
        }

        if (!password_verify($entered, $cached['otp_hash'])) {
            $this->errorMsg = 'Incorrect code. Please check your email and try again.';
            return;
        }

        $seller = Seller::find($cached['seller_id']);
        if (!$seller) {
            $this->errorMsg = 'Account not found. Please register again.';
            return;
        }

        $seller->email_verified = 1;
        $seller->save();

        AuditLog::record(
            action:     'EMAIL_VERIFIED',
            entityType: 'sellers',
            entityId:   $seller->id,
            newValue:   ['email' => $this->email],
            actorId:    $seller->id,
            actorType:  'seller'
        );

        // Send credentials email
        Mail::to($this->email)->send(
            new SellerCredentialsMail(
                $cached['seller_name'],
                $this->email,
                $cached['temp_password']
            )
        );

        // Send welcome WhatsApp + SMS
        try {
            app(SellerSmsService::class)->sendWelcomeWhatsApp(
                $seller->phone,
                $cached['seller_name'],
                $this->email,
                $cached['temp_password'],
                $seller->country_id  // pass country_id to get correct calling code
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('SellerVerifyOtp: WhatsApp failed — ' . $e->getMessage());
        }

        Cache::forget($cacheKey);
        session()->forget('seller_register_email');

        return redirect()->route('seller.login')
            ->with('login_success', '✅ Email verified! Your login credentials have been sent to ' . $this->email . '. Please check your inbox.');
    }

    public function resendOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        if (empty($this->email)) {
            $this->errorMsg = 'Session expired. Please register again.';
            return;
        }

        $cacheKey = 'seller_otp_' . md5($this->email);
        $cached   = Cache::get($cacheKey);

        if (!$cached) {
            $seller = Seller::where('email', $this->email)->where('email_verified', 0)->first();
            if (!$seller) {
                $this->errorMsg = 'Account not found or already verified. Please login instead.';
                return;
            }
            // Extra guard: if they have no password, they should use set-first-password
            if (empty($seller->password_hash)) {
                return redirect()->route('seller.set-first-password')
                    ->with('info', 'Please use the "Set Password" link to set up your account.');
            }
            $newTempPassword = $this->generateTempPassword($seller);
            $seller->password_hash        = Hash::make($newTempPassword);
            $seller->must_change_password = 1;
            $seller->save();

            $sellerName = $seller->details?->legal_business_name ?? 'Seller';
            $cached = [
                'seller_name'   => $sellerName,
                'temp_password' => $newTempPassword,
                'seller_id'     => $seller->id,
            ];
        }

        // 4-digit OTP
        $newOtp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        Cache::put($cacheKey, array_merge($cached, [
            'otp_hash' => bcrypt($newOtp),
        ]), now()->addMinutes(10));

        Mail::to($this->email)->send(
            new \App\Mail\SellerOtpMail($newOtp, $cached['seller_name'], $this->email)
        );

        // Resend SMS too
        try {
            $seller = $seller ?? Seller::find($cached['seller_id']);
            if ($seller?->phone) {
                app(SellerSmsService::class)->sendOtpSms($seller->phone, $newOtp, $cached['seller_name'], $seller->country_id ?? null);
            }
        } catch (\Exception $e) {}

        $this->d1=$this->d2=$this->d3=$this->d4='';
        $this->successMsg = '✅ New OTP sent via Email, SMS & WhatsApp to ' . $this->email . '.';
        $this->dispatch('otp-resent');
    }

    private function generateTempPassword(Seller $seller): string
    {
        $words    = ['Trade', 'Globe', 'Seller', 'Export', 'Market', 'Pulse'];
        $specials = ['@', '#', '!', '$'];
        return $words[array_rand($words)] . $specials[array_rand($specials)] . rand(1000, 9999);
    }

    public function render()
    {
        return view('livewire.front.seller-verify-otp');
    }
}