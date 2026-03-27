<?php
// FILE: app/Livewire/Front/SellerLogin.php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SellerLogin extends Component
{
    public $email      = '';
    public $password   = '';
    public $errorMsg   = '';
    public $successMsg = '';

    public function mount()
    {
        // Always clear session on login page — forces re-authentication
        session()->forget(['seller_id', 'id', 'seller_email', 'seller_name']);

        if (session('login_success')) {
            $this->successMsg = session('login_success');
        }
    }

    public function login()
    {
        $this->errorMsg = '';

        $this->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $emailLower = strtolower(trim($this->email));
        $seller     = Seller::where('email', $emailLower)->first();

        if (!$seller) {
            $this->errorMsg = 'No account found with this email address.';
            return;
        }

        if ($seller->is_active == 0) {
            $this->errorMsg = 'Your account has been suspended. Please contact support.';
            return;
        }

        // ── Old seller imported from tblleads: no password yet ──
        // Must go through set-first-password (email OTP → set password)
        // This check comes BEFORE email_verified check because old sellers
        // may still have email_verified=0 until they complete set-first-password
        if (empty($seller->password_hash)) {
            session(['seller_register_email' => $emailLower]);
            return redirect()->route('seller.set-first-password')
                ->with('info', 'Welcome! Please set a password for your account to continue.');
        }

        // ── New seller: registered but not yet verified email ──
        // Only applies to genuinely new registrations (has temp password but not verified)
        if ($seller->email_verified == 0) {
            session(['seller_register_email' => $emailLower]);
            return redirect()->route('seller.verify.otp')
                ->with('otp_success', 'Please verify your email first.');
        }

        if (!Hash::check($this->password, $seller->password_hash)) {
            $this->errorMsg = 'Incorrect password. Please try again.';
            return;
        }

        // ✅ Credentials verified — create session
        // sellers.id = tblleads.id (same integer value — imported with same ID)
        // So Session::get('id') and Session::get('seller_id') are both the same integer
        // tbl_products.customer_id and seller_services.customer_id reference this directly
        session([
            'seller_id'    => $seller->id,   // sellers.id (= tblleads.id integer)
            'seller_uuid'  => $seller->id,
            'id'           => $seller->id,   // same value — old pages use Session::get('id')
            'seller_email' => $seller->email,
            'seller_name'  => $seller->details?->legal_business_name ?? $seller->email,
            'package_id'   => $seller->package_id,  // for package limit checks
        ]);

        $seller->last_login_at = now();
        $seller->save();

        // Force password change first
        if ($seller->must_change_password == 1) {
            return redirect()->route('seller.set-password');
        }

        // Profile incomplete → redirect to profile completion
        // Profile is complete when onboarding_step >= 5 AND kyc submitted
        $details = $seller->details;
        $profileComplete = $details
            && $details->onboarding_step >= 5
            && in_array($details->kyc_status, ['submitted', 'verified']);

        if (!$profileComplete) {
            return redirect()->route('profile')
                ->with('login_success', 'Welcome! Please complete your profile to get started.');
        }

        // Fully set up → dashboard
        return redirect()->route('seller.dashboard');
    }

    public function render()
    {
        return view('livewire.front.seller-login');
    }
}
?>