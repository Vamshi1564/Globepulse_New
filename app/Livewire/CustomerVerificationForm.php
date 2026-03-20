<?php

namespace App\Livewire;

use App\Mail\EmailOtpVerification;
use App\Models\Customer;
use App\Models\LeadConversionDraftModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CustomerVerificationForm extends Component
{
    public $draft;
    public $draftId;

    public $showModal = true;

    public $name;
    public $phone;
    public $email;
    public $lead;

    public $phoneOtp;
    public $emailOtp;

    public $phoneVerified = false;
    public $emailVerified = false;

    public $phoneOtpSent = false;
    public $emailOtpSent = false;


    /*
    |--------------------------------------------------------------------------
    | MOUNT
    |--------------------------------------------------------------------------
    */

    public function mount($draftId)
    {
        $this->draftId = $draftId;

        // dd($draftId);

        $this->draft = LeadConversionDraftModel::with('customer')->where('id', $draftId)
            ->first();

        // $this->lead = Customer::where('lead_id', $this->draft->lead_id)->first();

        if (!$this->draft || !$this->draft->customer) {
            session()->flash('error', 'Invalid draft');
            return;
        }

        if (
            $this->draft->payment_expire_at &&
            now()->toDateString() > Carbon::parse($this->draft->payment_expire_at)->toDateString()

        ) {
            $this->showModal = false;
        }

        // $this->lead = Customer::where('id', $this->draft->lead_id)->first();


        $this->name  = $this->draft->name ?? 'N/A';
        $this->phone = $this->draft->customer->phonenumber ?? '';
        $this->email = $this->draft->email ?? 'N/A';

        $this->phoneVerified = $this->draft->customer->phone_verified == 1;
        $this->emailVerified = $this->draft->customer->email_verified == 1;

        // If already verified → hide modal
        if ($this->phoneVerified && $this->emailVerified) {
            $this->showModal = false;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CLEAN PHONE
    |--------------------------------------------------------------------------
    */

    // public function updatedPhone($value)
    // {
    //     $this->phone = preg_replace('/[^0-9]/', '', $value);
    // }

    // private function cleanPhone($phone)
    // {
    //     $phone = preg_replace('/[^0-9]/', '', $phone);
    //     $phone = ltrim($phone, '0');

    //     // if (strlen($phone) == 10) {
    //     //     $phone = '91' . $phone; // India code
    //     // }

    //     return $phone;
    // }

    /*
    |--------------------------------------------------------------------------
    | SMS GATEWAY
    |--------------------------------------------------------------------------
    */

    private function sendSms($number, $message)
    {
        $apikey = "kfRGNGqkU0qC6NnFrutXww";
        $apisender = "GFEWRD";

        $encodedMsg = rawurlencode($message);

        $url = "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey={$apikey}&senderid={$apisender}&channel=2&DCS=0&flashsms=0&number={$number}&text={$encodedMsg}&route=1&dlttemplateid=1207175696631996806";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        // dd('SMS RESPONSE: ' . $response);
        // logger('SMS RESPONSE: ' . $response);

        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | PHONE OTP
    |--------------------------------------------------------------------------
    */


    public function sendPhoneOtp()
    {
        // $this->phone = $this->cleanPhone($this->phone);

        $this->validate([
            'name'  => 'required',
            // 'phone' => 'required',
            'phone' => [
                'required',
                'regex:/^[6-9][0-9]{9}$/'
            ],
        ]);

        $otp = rand(100000, 999999);

        session(['phone_otp' => $otp]);

        // $message = "Your OTP for payment verification is {$otp}. Do not share.";
        $message = "Dear User,\nYour OTP for login to Globpulse B2B Portal is $otp. Valid for 30 minutes. Please do not share this OTP.\n\nRegards,\ngfegroup Team.";

        $response = $this->sendSms($this->phone, $message);

        if (!$response) {
            session()->flash('error', 'Failed to send OTP');
            return;
        }

        $this->phoneOtpSent = true;
        session()->flash('msg', 'OTP sent to mobile');
    }

    public function verifyPhoneOtp()
    {
        $this->validate([
            'phoneOtp' => 'required|digits:6'
        ], [
            'phoneOtp.required' => 'Please enter OTP',
            'phoneOtp.digits'   => 'OTP must be 6 digits'
        ]);

        if ($this->phoneOtp == session('phone_otp')) {
            $this->phoneVerified = true;
            $this->phoneOtpSent = false;

            $this->draft->customer->update([
                'phone_verified' => 1,
            ]);

            session()->forget('phone_otp');
        } else {
            session()->flash('error', 'Invalid OTP');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EMAIL OTP
    |--------------------------------------------------------------------------
    */

    public function sendEmailOtp()
    {

        $this->validate([
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
        ]);

        $otp = rand(100000, 999999);

        session(['email_otp' => $otp]);

        // Mail::raw(
        //     "Your OTP is {$otp}",
        //     fn($m) => $m->to($this->email)->subject('Email Verification OTP')
        // );

        Mail::to($this->email)->send(new EmailOtpVerification($otp, $this->name));
        $this->emailOtpSent = true;
        session()->flash('msg', 'OTP sent to email');
    }

    public function verifyEmailOtp()
    {

        $this->validate([
            'emailOtp' => 'required|digits:6'
        ], [
            'emailOtp.required' => 'Please enter OTP',
            'emailOtp.digits'   => 'OTP must be 6 digits'
        ]);

        if ($this->emailOtp == session('email_otp')) {
            $this->emailVerified = true;
            $this->emailOtpSent = false;

            $this->draft->customer->update([
                'email_verified' => 1,
            ]);

            session()->forget('email_otp');
        } else {
            session()->flash('error', 'Invalid OTP');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    */

    public function verified()
    {

        $this->validate([
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required|email|email:rfc,dns',
        ]);

        if (!$this->phoneVerified || !$this->emailVerified) {
            session()->flash('error', 'Please verify both fields');
            return;
        }

        $this->draft->update([
            'name' => $this->name,
            'phonenumber' => $this->phone,
            'email' => $this->email,
        ]);


        if ($this->draft->customer) {
            $this->draft->customer->update([
                'name' => $this->name,
                'phonenumber' => $this->phone,
                'email' => $this->email,
            ]);
        }

        $this->showModal = false;

        return redirect()->to(url()->previous())->with('message', 'Your details have been verified successfully. Now you can proceed with your payment.');
        // $this->dispatch('verified');
    }

    public function render()
    {
        return view('livewire.customer-verification-form');
    }
}
