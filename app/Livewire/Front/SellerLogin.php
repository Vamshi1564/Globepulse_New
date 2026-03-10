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
    public $remember   = false;
    public $errorMsg   = '';
    public $successMsg = '';

    public function mount()
    {
        // ✅ ALWAYS wipe any existing seller session when the login page loads.
        //
        // Why? Because if someone registered yesterday and the browser still
        // has session('seller_id') stored, visiting /seller/login should NOT
        // silently skip the login form and redirect to set-password.
        //
        // Every user MUST re-enter their email + temp password here first.
        // Only AFTER successful login() do we re-create the session.
        // This way set-password always knows exactly whose password to change.
        session()->forget(['seller_id', 'seller_email', 'seller_name']);

        // Show success flash from OTP verification ("Email verified! Login below")
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

        // Find seller by email
        $seller = Seller::where('email', $emailLower)->first();

        // Wrong email
        if (!$seller) {
            $this->errorMsg = 'No account found with this email address.';
            return;
        }

        // Email not verified yet
        if ($seller->email_verified == 0) {
            session(['seller_register_email' => $emailLower]);
            return redirect()->route('seller.verify.otp')
                ->with('otp_success', 'Please verify your email first.');
        }

        // Account suspended
        if ($seller->is_active == 0) {
            $this->errorMsg = 'Your account has been suspended. Please contact support.';
            return;
        }

        // Wrong password
        if (!Hash::check($this->password, $seller->password_hash)) {
            $this->errorMsg = 'Incorrect password. Please try again.';
            return;
        }

        // ✅ Credentials verified — NOW create the session
        // From this point, session('seller_id') is set for THIS seller only
        session([
            'seller_id'    => $seller->id,
            'seller_email' => $seller->email,
            'seller_name'  => $seller->details?->legal_business_name ?? $seller->email,
        ]);

        // Update last login timestamp
        $seller->last_login_at = now();
        $seller->save();

        // First login (temp password not yet changed) → force set-password
        // At this point session('seller_id') is set so set-password knows exactly
        // which seller to update — no ambiguity possible
        if ($seller->must_change_password == 1) {
            return redirect()->route('seller.set-password');
        }

        // Normal login → dashboard
        return redirect()->route('seller.dashboard');
    }

    public function render()
    {
        return view('livewire.front.seller-login');
    }
}