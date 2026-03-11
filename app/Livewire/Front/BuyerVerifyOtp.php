<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Buyer;
use App\Models\AuditLog;
use App\Mail\BuyerCredentialsMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class BuyerVerifyOtp extends Component
{
    public $d1=''; public $d2=''; public $d3='';
    public $d4=''; public $d5=''; public $d6='';

    public $email      = '';
    public $errorMsg   = '';
    public $successMsg = '';

    public function mount()
    {
        $this->email = session('buyer_register_email', '');

        if (empty($this->email)) {
            return redirect()->route('buyer.register')
                ->with('error', 'Session expired. Please register again.');
        }

        if (session('otp_success')) {
            $this->successMsg = session('otp_success');
        }
    }

    // ── Verify OTP ─────────────────────────────────────────────
    public function verifyOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $entered = $this->d1.$this->d2.$this->d3.$this->d4.$this->d5.$this->d6;

        if (strlen($entered) < 6 || !ctype_digit($entered)) {
            $this->errorMsg = 'Please enter all 6 digits.';
            return;
        }

        $cacheKey = 'buyer_otp_' . md5($this->email);
        $cached   = Cache::get($cacheKey);

        if (!$cached) {
            $this->errorMsg = 'Code has expired. Click "Resend Code" to get a new one.';
            return;
        }

        if (!password_verify($entered, $cached['otp_hash'])) {
            $this->errorMsg = 'Incorrect code. Please check your email and try again.';
            return;
        }

        // OTP correct
        $buyer = Buyer::find($cached['buyer_id']);

        if (!$buyer) {
            $this->errorMsg = 'Account not found. Please register again.';
            return;
        }

        $buyer->email_verified = 1;
        $buyer->save();

        AuditLog::record(
            action:    'EMAIL_VERIFIED',
            entityType:'buyers',
            entityId:  $buyer->id,
            newValue:  ['email' => $this->email],
            actorId:   $buyer->id,
            actorType: 'buyer'
        );

        // Send credentials
        Mail::to($this->email)->send(
            new BuyerCredentialsMail(
                $cached['buyer_name'],
                $this->email,
                $cached['temp_password']
            )
        );

        Cache::forget($cacheKey);
        session()->forget('buyer_register_email');

        return redirect()->route('buyer.login')
            ->with('login_success',
                '✅ Email verified! Your login credentials have been sent to '.$this->email
            );
    }

    // ── Resend OTP ─────────────────────────────────────────────
    public function resendOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        if (empty($this->email)) {
            $this->errorMsg = 'Session expired. Please register again.';
            return;
        }

        $cacheKey = 'buyer_otp_' . md5($this->email);
        $cached   = Cache::get($cacheKey);

        if (!$cached) {

            $buyer = Buyer::where('email', $this->email)
                          ->where('email_verified', 0)
                          ->first();

            if (!$buyer) {
                $this->errorMsg = 'Account not found or already verified.';
                return;
            }

            $newTempPassword = $this->generateTempPassword();

            $buyer->password_hash = Hash::make($newTempPassword);
            $buyer->save();

            $cached = [
                'buyer_name'  => $buyer->full_name,
                'temp_password'=> $newTempPassword,
                'buyer_id'    => $buyer->id,
            ];
        }

        $newOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put($cacheKey, array_merge($cached, [
            'otp_hash' => bcrypt($newOtp),
        ]), now()->addMinutes(10));

        Mail::to($this->email)->send(
            new \App\Mail\BuyerOtpMail($newOtp, $cached['buyer_name'], $this->email)
        );

        $this->d1=$this->d2=$this->d3=$this->d4=$this->d5=$this->d6='';

        $this->successMsg = 'A new code has been sent to '.$this->email;

        $this->dispatch('otp-resent');
    }

    private function generateTempPassword(): string
    {
        $words    = ['Trade', 'Buyer', 'Market', 'Source', 'Global'];
        $specials = ['@','#','!','$'];

        return $words[array_rand($words)]
            .$specials[array_rand($specials)]
            .rand(1000,9999);
    }

    public function render()
    {
        return view('livewire.front.buyer-verify-otp');
    }
}