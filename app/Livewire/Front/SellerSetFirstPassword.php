<?php
// FILE: app/Livewire/Front/SellerSetFirstPassword.php
// For OLD sellers imported from tblleads — they have no password
// Flow: Enter email → send OTP → verify OTP → set password → login

namespace App\Livewire\Front;

use App\Mail\SellerOtpMail;
use App\Models\Seller;
use App\Services\SellerSmsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SellerSetFirstPassword extends Component
{
    public int    $step     = 1;  // 1=email, 2=OTP, 3=set password

    // Step 1
    public string $email    = '';

    // Step 2 — 4-digit OTP boxes
    public string $d1 = '', $d2 = '', $d3 = '', $d4 = '';

    // Step 3
    public string $password         = '';
    public string $password_confirm = '';

    public string $errorMsg   = '';
    public string $successMsg = '';

    public function mount()
    {
        // Pre-fill email if coming from login page
        $this->email = session('seller_register_email', '');

        if (session('info')) {
            $this->successMsg = session('info');
        }
    }

    // ── STEP 1: Send OTP to email ─────────────────────────────
    public function sendOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $this->validate([
            'email' => 'required|email',
        ]);

        $emailLower = strtolower(trim($this->email));

        $seller = Seller::where('email', $emailLower)->first();

        if (!$seller) {
            $this->errorMsg = 'No account found with this email. Please register first.';
            return;
        }

        if (!empty($seller->password_hash)) {
            // Already set a password — use forgot-password instead
            $this->errorMsg = 'You have already set a password for this account. Please use "Forgot Password" on the login page to reset it.';
            return;
        }

        if ($seller->is_active == 0) {
            $this->errorMsg = 'Your account is suspended. Please contact support.';
            return;
        }

        // Generate 4-digit OTP
        $otp  = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $name = $seller->details?->legal_business_name ?? $seller->name ?? 'Seller';

        Cache::put('seller_firstpw_' . md5($emailLower), [
            'otp_hash'  => bcrypt($otp),
            'seller_id' => $seller->id,
            'name'      => $name,
        ], now()->addMinutes(10));

        // Send OTP email
        try {
            Mail::to($emailLower)->send(new SellerOtpMail($otp, $name, $emailLower));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('SellerSetFirstPassword: email failed — ' . $e->getMessage());
        }

        // Send OTP SMS
        try {
            app(SellerSmsService::class)->sendOtpSms(
                $seller->phone, $otp, $name, $seller->country_id ?? null
            );
        } catch (\Exception $e) {}

        session(['seller_register_email' => $emailLower]);

        $this->step       = 2;
        $this->successMsg = 'A 4-digit code has been sent to ' . $emailLower . '. Check your inbox.';
    }

    // ── STEP 2: Verify OTP ────────────────────────────────────
    public function verifyOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $entered = $this->d1 . $this->d2 . $this->d3 . $this->d4;

        if (strlen($entered) < 4 || !ctype_digit($entered)) {
            $this->errorMsg = 'Please enter all 4 digits.';
            return;
        }

        $cacheKey = 'seller_firstpw_' . md5(strtolower(trim($this->email)));
        $cached   = Cache::get($cacheKey);

        if (!$cached) {
            $this->errorMsg = 'Code has expired. Please go back and request a new one.';
            return;
        }

        if (!password_verify($entered, $cached['otp_hash'])) {
            $this->errorMsg = 'Incorrect code. Please check your email and try again.';
            return;
        }

        // OTP verified — move to password step
        $this->step       = 3;
        $this->successMsg = 'Code verified! Now set your new password.';
    }

    // ── STEP 3: Set Password ──────────────────────────────────
    public function setPassword()
    {
        $this->errorMsg = $this->successMsg = '';

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
            'password.regex'        => 'Must include uppercase, number and symbol (@$!%*#?&).',
            'password_confirm.same' => 'Passwords do not match.',
        ]);

        $emailLower = strtolower(trim($this->email));
        $cacheKey   = 'seller_firstpw_' . md5($emailLower);
        $cached     = Cache::get($cacheKey);

        if (!$cached) {
            $this->errorMsg = 'Session expired. Please start again.';
            $this->step     = 1;
            return;
        }

        $seller = Seller::find($cached['seller_id']);

        if (!$seller) {
            $this->errorMsg = 'Account not found. Please contact support.';
            return;
        }

        // Save password and mark account as fully active
        // email_verified=1 prevents signup loop; must_change_password=0 prevents set-password redirect
        $seller->password_hash        = Hash::make($this->password);
        $seller->must_change_password = 0;
        $seller->email_verified       = 1;   // old sellers were pre-verified — mark confirmed now
        $seller->save();

        Cache::forget($cacheKey);
        session()->forget('seller_register_email');

        return redirect()->route('seller.login')
            ->with('login_success', '✅ Password set! You can now login with your email and new password.');
    }

    // ── Resend OTP ────────────────────────────────────────────
    public function resendOtp()
    {
        $this->errorMsg = $this->successMsg = '';
        $emailLower = strtolower(trim($this->email));

        $seller = Seller::where('email', $emailLower)->first();
        if (!$seller) { $this->errorMsg = 'Account not found.'; return; }

        $otp  = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $name = $seller->details?->legal_business_name ?? $seller->name ?? 'Seller';

        Cache::put('seller_firstpw_' . md5($emailLower), [
            'otp_hash'  => bcrypt($otp),
            'seller_id' => $seller->id,
            'name'      => $name,
        ], now()->addMinutes(10));

        Mail::to($emailLower)->send(new SellerOtpMail($otp, $name, $emailLower));

        $this->d1 = $this->d2 = $this->d3 = $this->d4 = '';
        $this->successMsg = 'New code sent to ' . $emailLower;
    }

    public function render()
    {
        return view('livewire.front.seller-set-first-password');
    }
}