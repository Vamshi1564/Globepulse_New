<?php
// FILE: app/Livewire/Front/SellerVerifyOtp.php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use App\Models\AuditLog;
use App\Mail\SellerCredentialsMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SellerVerifyOtp extends Component
{
    public $d1=''; public $d2=''; public $d3='';
    public $d4=''; public $d5=''; public $d6='';

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

    // ── Verify OTP ────────────────────────────────────────────────────────────
    public function verifyOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $entered = $this->d1.$this->d2.$this->d3.$this->d4.$this->d5.$this->d6;

        if (strlen($entered) < 6 || !ctype_digit($entered)) {
            $this->errorMsg = 'Please enter all 6 digits.';
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

        // ✅ OTP correct
        $seller = Seller::find($cached['seller_id']);
        if (!$seller) {
            $this->errorMsg = 'Account not found. Please register again.';
            return;
        }

        $seller->email_verified = 1;
        $seller->save();

        AuditLog::record(
            action:    'EMAIL_VERIFIED',
            entityType:'sellers',
            entityId:  $seller->id,
            newValue:  ['email' => $this->email],
            actorId:   $seller->id,
            actorType: 'seller'
        );

        // Send credentials email
        Mail::to($this->email)->send(
            new SellerCredentialsMail(
                $cached['seller_name'],
                $this->email,
                $cached['temp_password']
            )
        );

        Cache::forget($cacheKey);
        session()->forget('seller_register_email');

        return redirect()->route('seller.login')
            ->with('login_success', '✅ Email verified! Your login credentials have been sent to ' . $this->email . '. Please check your inbox.');
    }

    // ── Resend OTP ─────────────────────────────────────────────────────────────
    public function resendOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        if (empty($this->email)) {
            $this->errorMsg = 'Session expired. Please register again.';
            return;
        }

        $cacheKey = 'seller_otp_' . md5($this->email);
        $cached   = Cache::get($cacheKey);

        // If cache expired, rebuild from DB
        if (!$cached) {
            $seller = Seller::where('email', $this->email)
                            ->where('email_verified', 0)
                            ->first();

            if (!$seller) {
                $this->errorMsg = 'Account not found or already verified. Please login or register again.';
                return;
            }

            // Generate new temp password since old one is lost (cache expired)
            $newTempPassword = $this->generateTempPassword($seller);
            $seller->password_hash        = Hash::make($newTempPassword);
            $seller->must_change_password = 1;
            $seller->save();

            $sellerName = $seller->details?->legal_business_name ?? 'Seller';

            $cached = [
                'seller_name'  => $sellerName,
                'temp_password'=> $newTempPassword,
                'seller_id'    => $seller->id,
            ];
        }

        // New OTP
        $newOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put($cacheKey, array_merge($cached, [
            'otp_hash' => bcrypt($newOtp),
        ]), now()->addMinutes(10));

        Mail::to($this->email)->send(
            new \App\Mail\SellerOtpMail($newOtp, $cached['seller_name'], $this->email)
        );

        $this->d1=$this->d2=$this->d3=$this->d4=$this->d5=$this->d6='';
        $this->successMsg = 'A new code has been sent to ' . $this->email;
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