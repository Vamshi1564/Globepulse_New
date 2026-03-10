<?php
// FILE: app/Livewire/Front/SellerSetPassword.php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerSetPassword extends Component
{
    public $password         = '';
    public $password_confirm = '';
    public $errorMsg         = '';
    public $sellerName       = '';

    public function mount()
    {
        // Must be logged in
        if (!session('seller_id')) {
            return redirect()->route('seller.login');
        }

        $seller = Seller::find(session('seller_id'));

        // If already changed password → go to dashboard
        if ($seller && $seller->must_change_password == 0) {
            return redirect()->route('seller.dashboard');
        }

        $this->sellerName = $seller?->details?->legal_business_name
                         ?? session('seller_name', 'Seller');
    }

    public function save()
    {
        $this->errorMsg = '';

        $this->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',        // at least one uppercase
                'regex:/[0-9]/',        // at least one number
                'regex:/[@$!%*#?&]/',   // at least one special char
            ],
            'password_confirm' => 'required|same:password',
        ], [
            'password.min'            => 'Password must be at least 8 characters.',
            'password.regex'          => 'Password must include uppercase, number and special character (@$!%*#?&).',
            'password_confirm.same'   => 'Passwords do not match.',
        ]);

        $seller = Seller::find(session('seller_id'));

        if (!$seller) {
            return redirect()->route('seller.login');
        }

        // Make sure new password is different from temp password
        if (Hash::check($this->password, $seller->password_hash)) {
            $this->errorMsg = 'New password cannot be the same as your temporary password. Please choose a different one.';
            return;
        }

        // Update password
        $seller->password_hash        = Hash::make($this->password);
        $seller->must_change_password = 0;
        $seller->save();

        // Update session
        session(['seller_name' => $this->sellerName]);

        return redirect()->route('seller.dashboard')
            ->with('dashboard_success', '✅ Password updated successfully! Welcome to GlobPulse.');
    }

    public function render()
    {
        return view('livewire.front.seller-set-password');
    }
}