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

        if ($seller->email_verified == 0) {
            session(['seller_register_email' => $emailLower]);
            return redirect()->route('seller.verify.otp')
                ->with('otp_success', 'Please verify your email first.');
        }

        if ($seller->is_active == 0) {
            $this->errorMsg = 'Your account has been suspended. Please contact support.';
            return;
        }

        if (!Hash::check($this->password, $seller->password_hash)) {
            $this->errorMsg = 'Incorrect password. Please try again.';
            return;
        }

        // ✅ Credentials verified — create session
        session([
            'seller_id'    => $seller->id,
            'seller_uuid'  => $seller->id,
            'id'           => $seller->id,   // ← old dashboard pages use Session::get('id')
            'seller_email' => $seller->email,
            'seller_name'  => $seller->details?->legal_business_name ?? $seller->email,
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