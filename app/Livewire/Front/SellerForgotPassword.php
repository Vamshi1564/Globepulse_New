<?php
// FILE: app/Livewire/Front/SellerForgotPassword.php
// Handles both steps:
//   Step 1 — enter email → send OTP
//   Step 2 — enter OTP + new password → reset

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use App\Mail\SellerOtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SellerForgotPassword extends Component
{
    public int    $step       = 1;   // 1=enter email, 2=enter OTP + new password

    // Step 1
    public $email    = '';

    // Step 2
    public $d1=''; public $d2=''; public $d3='';
    public $d4=''; public $d5=''; public $d6='';
    public $password         = '';
    public $password_confirm = '';

    public $errorMsg   = '';
    public $successMsg = '';

    // ── STEP 1: Send OTP ─────────────────────────────────────────────────────
    public function sendResetOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $this->validate(['email' => 'required|email'], [
            'email.required' => 'Please enter your email address.',
            'email.email'    => 'Please enter a valid email address.',
        ]);

        $emailLower = strtolower(trim($this->email));
        $seller     = Seller::where('email', $emailLower)
                            ->where('email_verified', 1)
                            ->first();

        // Always show same message (security: don't confirm if email exists)
        if (!$seller) {
            $this->successMsg = 'If this email is registered, a reset code has been sent.';
            return;
        }

        if ($seller->is_active == 0) {
            $this->errorMsg = 'Your account has been suspended. Please contact support.';
            return;
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store in cache (TTL 10 min)
        Cache::put('seller_reset_' . md5($emailLower), [
            'otp_hash'  => bcrypt($otp),
            'seller_id' => $seller->id,
        ], now()->addMinutes(10));

        // Send OTP email (reuse same OTP mail template)
        $name = $seller->details?->legal_business_name ?? 'Seller';
        Mail::to($emailLower)->send(new SellerOtpMail($otp, $name, $emailLower));

        $this->step       = 2;
        $this->successMsg = 'A 6-digit reset code has been sent to ' . $emailLower . '. Check your inbox.';
    }

    // ── STEP 2: Verify OTP + Set New Password ────────────────────────────────
    public function resetPassword()
    {
        $this->errorMsg = $this->successMsg = '';

        // Validate new password
        $this->validate([
            'password' => [
                'required', 'string', 'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'password_confirm' => 'required|same:password',
        ], [
            'password.min'          => 'Password must be at least 8 characters.',
            'password.regex'        => 'Password must include uppercase, number and special character.',
            'password_confirm.same' => 'Passwords do not match.',
        ]);

        $entered  = $this->d1.$this->d2.$this->d3.$this->d4.$this->d5.$this->d6;
        $emailLower = strtolower(trim($this->email));

        if (strlen($entered) < 6 || !ctype_digit($entered)) {
            $this->errorMsg = 'Please enter all 6 digits of the reset code.';
            return;
        }

        $cacheKey = 'seller_reset_' . md5($emailLower);
        $cached   = Cache::get($cacheKey);

        if (!$cached) {
            $this->errorMsg = 'Reset code has expired. Please go back and request a new one.';
            return;
        }

        if (!password_verify($entered, $cached['otp_hash'])) {
            $this->errorMsg = 'Incorrect code. Please check your email and try again.';
            return;
        }

        // ✅ OTP correct → update password
        $seller = Seller::find($cached['seller_id']);
        if (!$seller) {
            $this->errorMsg = 'Account not found. Please contact support.';
            return;
        }

        $seller->password_hash        = Hash::make($this->password);
        $seller->must_change_password = 0;
        $seller->save();

        Cache::forget($cacheKey);

        return redirect()->route('seller.login')
            ->with('login_success', '✅ Password reset successfully! Please login with your new password.');
    }

    // ── Resend Reset OTP ──────────────────────────────────────────────────────
    public function resendResetOtp()
    {
        $this->errorMsg = $this->successMsg = '';
        $emailLower = strtolower(trim($this->email));

        $seller = Seller::where('email', $emailLower)->where('email_verified', 1)->first();
        if (!$seller) { $this->errorMsg = 'Account not found.'; return; }

        $otp  = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $name = $seller->details?->legal_business_name ?? 'Seller';

        Cache::put('seller_reset_' . md5($emailLower), [
            'otp_hash'  => bcrypt($otp),
            'seller_id' => $seller->id,
        ], now()->addMinutes(10));

        Mail::to($emailLower)->send(new SellerOtpMail($otp, $name, $emailLower));

        $this->d1=$this->d2=$this->d3=$this->d4=$this->d5=$this->d6='';
        $this->successMsg = 'A new code has been sent to ' . $emailLower;
        $this->dispatch('otp-resent');
    }

    public function goBack()
    {
        $this->step       = 1;
        $this->errorMsg   = '';
        $this->successMsg = '';
        $this->d1=$this->d2=$this->d3=$this->d4=$this->d5=$this->d6='';
    }

    public function render()
    {
        return view('livewire.front.seller-forgot-password');
    }
}