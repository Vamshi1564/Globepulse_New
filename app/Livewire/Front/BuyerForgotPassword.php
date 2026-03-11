<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyerOtpMail;

class BuyerForgotPassword extends Component
{
    public int $step = 1;

    public $email = '';

    public $d1=''; public $d2=''; public $d3='';
    public $d4=''; public $d5=''; public $d6='';

    public $password = '';
    public $password_confirm = '';

    public $errorMsg = '';
    public $successMsg = '';

    /*
    |--------------------------------------------------------------------------
    | STEP 1 : Send Reset OTP
    |--------------------------------------------------------------------------
    */

    public function sendResetOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $this->validate([
            'email' => 'required|email'
        ],[
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email.'
        ]);

        $emailLower = strtolower(trim($this->email));

        $buyer = DB::table('buyers')
            ->where('email', $emailLower)
            ->where('email_verified', 1)
            ->first();

        // security message
        if (!$buyer) {
            $this->successMsg = 'If this email is registered, a reset code has been sent.';
            return;
        }

        if ($buyer->is_active == 0) {
            $this->errorMsg = 'Your account has been suspended. Contact support.';
            return;
        }

        $otp = str_pad(random_int(0,999999),6,'0',STR_PAD_LEFT);

        Cache::put('buyer_reset_'.md5($emailLower),[
            'otp_hash' => bcrypt($otp),
            'buyer_id' => $buyer->id
        ], now()->addMinutes(10));

        Mail::to($emailLower)->send(
            new BuyerOtpMail($otp,$buyer->full_name,$emailLower)
        );

        $this->step = 2;

        $this->successMsg =
        'A 6-digit reset code has been sent to '.$emailLower;
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 2 : Reset Password
    |--------------------------------------------------------------------------
    */

    public function resetPassword()
    {
        $this->errorMsg = $this->successMsg = '';

        $this->validate([
            'password'=>[
                'required','string','min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'password_confirm'=>'required|same:password'
        ],[
            'password.min'=>'Password must be at least 8 characters.',
            'password.regex'=>'Password must include uppercase, number and symbol.',
            'password_confirm.same'=>'Passwords do not match.'
        ]);

        $entered = $this->d1.$this->d2.$this->d3.$this->d4.$this->d5.$this->d6;

        $emailLower = strtolower(trim($this->email));

        if(strlen($entered) < 6 || !ctype_digit($entered)){
            $this->errorMsg = 'Please enter the full 6 digit code.';
            return;
        }

        $cacheKey = 'buyer_reset_'.md5($emailLower);

        $cached = Cache::get($cacheKey);

        if(!$cached){
            $this->errorMsg = 'Reset code expired. Request a new one.';
            return;
        }

        if(!password_verify($entered,$cached['otp_hash'])){
            $this->errorMsg = 'Incorrect reset code.';
            return;
        }

        $buyer = DB::table('buyers')
            ->where('id',$cached['buyer_id'])
            ->first();

        if(!$buyer){
            $this->errorMsg = 'Account not found.';
            return;
        }

        DB::table('buyers')
            ->where('id',$buyer->id)
            ->update([
                'password_hash'=>Hash::make($this->password),
                'updated_at'=>now()
            ]);

        Cache::forget($cacheKey);

        return redirect()
            ->route('buyer.login')
            ->with('login_success',
            'Password reset successfully! Please login.');
    }

    /*
    |--------------------------------------------------------------------------
    | RESEND OTP
    |--------------------------------------------------------------------------
    */

    public function resendResetOtp()
    {
        $this->errorMsg = $this->successMsg = '';

        $emailLower = strtolower(trim($this->email));

        $buyer = DB::table('buyers')
            ->where('email',$emailLower)
            ->where('email_verified',1)
            ->first();

        if(!$buyer){
            $this->errorMsg = 'Account not found.';
            return;
        }

        $otp = str_pad(random_int(0,999999),6,'0',STR_PAD_LEFT);

        Cache::put('buyer_reset_'.md5($emailLower),[
            'otp_hash'=>bcrypt($otp),
            'buyer_id'=>$buyer->id
        ], now()->addMinutes(10));

        Mail::to($emailLower)->send(
            new BuyerOtpMail($otp,$buyer->full_name,$emailLower)
        );

        $this->d1=$this->d2=$this->d3=$this->d4=$this->d5=$this->d6='';

        $this->successMsg = 'A new reset code has been sent.';
    }

    public function goBack()
    {
        $this->step = 1;

        $this->errorMsg = '';
        $this->successMsg = '';

        $this->d1=$this->d2=$this->d3=$this->d4=$this->d5=$this->d6='';
    }

    public function render()
    {
        return view('livewire.front.buyer-forgot-password');
    }
}