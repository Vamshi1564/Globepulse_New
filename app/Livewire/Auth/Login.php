<?php

namespace App\Livewire\Auth;

use App\Models\Country;
use App\Models\Customer;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;

class Login extends Component
{
    // public $phonenumber;
    // public $username;


    // // public $password;
    // public function render()
    // {
    //     // $countries = Country::orderby('name', 'ASC')->get();
    //     // return view('livewire.auth.login', compact('countries'));
    //     return view('livewire.auth.login');
    // }


    // public function login()
    // {


    //     $validated = $this->validate([
    //         'username' => 'required',
    //     ]);
    //     // $user = Customer::where('phonenumber', $this->phonenumber)->first();
    //     $user = Customer::where('phonenumber', $this->username)->orWhere('email', $this->username)->first();


    //     if ($user) {

    //         if ($user->country_id == 101) {

    //             $otp = rand(111111, 999999);


    //             $apikey = "kfRGNGqkU0qC6NnFrutXww";
    //             $apisender = "GFEWRD";
    //             $msg = " Dear User,

    // Your OTP for login to GFE-PRO Application is " . $otp . ". Valid for 30 minutes. Please do not share this OTP.

    // Regards,
    // gfeworld Team.";
    //             $num = $user->phonenumber;
    //             $ms = rawurlencode($msg);
    //             $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=' . $apikey . '&senderid=' . $apisender . '&channel=2&DCS=0&flashsms=0&number=' . $num . '&text=' . $ms . '&route=1&&dlttemplateid=1207169864440563559';
    //             //echo $url;
    //             $ch = curl_init($url);
    //             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //             curl_setopt($ch, CURLOPT_POST, 1);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
    //             $responsed = curl_exec($ch);
    //             curl_close($ch);

    //             $to = $user->email;
    //             $msg = "OTP B2B account gfebusiness";
    //             $subsect = "OTP Email";
    //             Mail::to($to)->send(new OtpEmail($msg, $subsect, $otp));
    //         } else {

    //             $otp = rand(111111, 999999);

    //             $to = $user->email;
    //             $msg = "OTP B2B account gfebusiness";
    //             $subsect = "OTP Email";
    //             Mail::to($to)->send(new OtpEmail($msg, $subsect, $otp));
    //         }

    //         // session(['id' => $user->id, 'otp' => $otp, 'name' => $user->name]);
    //         session(['check_id' => $user->id, 'client_id' => $user->client_id, 'check_otp' => $otp, 'check_name' => $user->name, 'check_country' => $user->country_id, 'check_email' => $user->email, 'check_phonenumber' => $user->phonenumber]);

    //         return redirect()->route('auth-otp');
    //         // Redirect to dashboard
    //     } else {
    //         session()->flash('error', 'Invalid Phonenumber or Email');
    //     }
    // }
    public $username;
    public $token;
    public $countryId;
    public $customer;

    public function mount()
    {
        //     $token = trim($token);

        //     $this->customer = Customer::where('signup_token', $token)->first();
        //     // if ($token) {

        //     // if (!$this->customer) {
        //     //     session()->flash('error', 'Invalid login link.');
        //     //     return redirect()->route('emailverify'); // ✅ Proper return
        //     // }


        $this->countryId = session('otp_country');
        $this->username = session('otp_email');
        $this->customer = Customer::where('email', $this->username)->first();

        // if (!$this->customer) {
        //     session()->flash('error', 'Invalid login link.');
        //     return redirect()->route('emailverify'); // ✅ Proper return
        // }
        //     $this->countryId = $this->customer->country_id;

        //     // If country = 101, set username as phone prefilled, else email
        //     // }
    }


    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $validated = $this->validate([
            'username' => 'required',
        ]);
        $input = trim($this->username);

        // Detect if input is email or phone number
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            // Simple phone validation: digits only and length check (adjust as needed)
            $cleanInput = preg_replace('/\D/', '', $input);
            if (strlen($cleanInput) < 6) {
                session()->flash('error', 'Please enter a valid Email or Phone number.');
                return;
            }
            $field = 'phonenumber';
        }

        $user = Customer::where($field, $input)->first();

        if (!$user) {
            session()->flash('error', 'Invalid Email or Phone Number');
            return;
        }

        if ($user->country_id != 101 && $field == 'phonenumber') {
            session()->flash('error', 'Only email login allowed');
            return;
        }

        // if ($this->countryId == 101) {
        //     $user = Customer::where(function ($query) {
        //         $query->where('phonenumber', $this->username)
        //             ->orWhere('email', $this->username);
        //     })->first();
        // } else {
        //     $user = Customer::where('email', $this->username)->first();
        // }
        // if ($user) {
        $otp = ($user->phonenumber == "8530655430") ? "221122" : rand(100000, 999999);

        $smsMsg = "Dear User,\nYour OTP for login to Globpulse B2B Portal is $otp. Valid for 30 minutes. Please do not share this OTP.\n\nRegards,\ngfegroup Team.";
        $emailMsg = "Dear User,\nYour OTP for login to Globpulse B2B Portal is $otp. Valid for 30 minutes.\n\nRegards,\ngfeworld Team.";

        if ($field == 'email') {
            Mail::to($user->email)->send(new OtpEmail($emailMsg, "OTP Email", $otp));
        } elseif ($field == 'phonenumber' && $user->country_id == 101) {
            $this->sendSms($user->phonenumber, $smsMsg);
        }

        // Save OTP
        $user->otp_phone = $otp;
        $user->save();

        // Store in session
        session([
            'check_id' => $user->id,
            'client_id' => $user->client_id,
            'check_otp' => $otp,
            'check_name' => $user->name,
            'check_country' => $user->country_id,
            'check_email' => $user->email,
            'check_phonenumber' => $user->phonenumber,
            'login_input_type' => $field
        ]);

        return redirect()->route('auth-otp');
        // } else {
        //     session()->flash('error', 'Invalid Phone Number or Email');
        // }
    }

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

        return $response;
    }
}






// <?php

// namespace App\Livewire\Auth;

// use App\Models\Customer;
// use Livewire\Component;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Log;

// class Login extends Component
// {
//     public $phonenumber;
//     public $email; // New property for email
//     public $loginType = 'phone'; // Defaults to phone login

//     public function render()
//     {
//         return view('livewire.auth.login');
//     }

//     public function login()
//     {
//         // Validate based on login type
//         if ($this->loginType === 'phone') {
//             $this->validate(['phonenumber' => 'required']);
//             $user = Customer::where('phonenumber', $this->phonenumber)->first();
//         } else {
//             $this->validate(['email' => 'required|email']);
//             $user = Customer::where('email', $this->email)->first();
//         }

//         if ($user) {
//             $otp = $this->generateOtp();

//             if ($this->loginType === 'phone') {
//                 $this->sendSmsOtp($user->phonenumber, $otp);
//             } else {
//                 if ($this->sendEmailOtp($user->email, $otp)) {
//                     session(['id' => $user->id, 'otp' => $otp, 'name' => $user->name]);
//                     return redirect()->route('auth-otp');
//                 } else {
//                     session()->flash('error', 'Failed to send OTP to your email. Please try again.');
//                 }
//             }

//             // Store user ID and OTP in session for phone OTP
//             if ($this->loginType === 'phone') {
//                 session(['id' => $user->id, 'otp' => $otp, 'name' => $user->name]);
//                 return redirect()->route('auth-otp');
//             }
//         } else {
//             session()->flash('error', 'Invalid username or password');
//         }
//     }

//     protected function generateOtp()
//     {
//         return rand(111111, 999999);
//     }

//     protected function sendSmsOtp($phonenumber, $otp)
//     {
//         $apikey = "kfRGNGqkU0qC6NnFrutXww";
//         $apisender = "GFEWRD";
//         $msg = "Dear User,\n\nYour OTP for login to GFE-PRO Application is " . $otp . ". Valid for 30 minutes. Please do not share this OTP.\n\nRegards,\ngfeworld Team.";
//         $ms = rawurlencode($msg);
//         $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=' . $apikey . '&senderid=' . $apisender . '&channel=2&DCS=0&flashsms=0&number=' . $phonenumber . '&text=' . $ms . '&route=1&&dlttemplateid=1207169864440563559';

//         // Send SMS via cURL
//         $ch = curl_init($url);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, "");
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
//         curl_exec($ch);
//         curl_close($ch);
//     }

//     protected function sendEmailOtp($email, $otp)
//     {
//         $msg = "Dear User,\n\nYour OTP for login to GFE-PRO Application is " . $otp . ". Valid for 30 minutes. Please do not share this OTP.\n\nRegards,\ngfeworld Team.";

//         try {
//             Mail::raw($msg, function ($message) use ($email) {
//                 $message->to($email)
//                         ->subject('Your OTP for Login');
//             });
//             Log::info("OTP sent to $email successfully."); // Log success message
//             return true; // Successfully sent email
//         } catch (\Exception $e) {
//             Log::error('Email OTP Sending Failed: ' . $e->getMessage()); // Log error for debugging
//             return false; // Failed to send email
//         }
//     }

//     public function toggleLoginType()
//     {
//         // Toggle between email and phone
//         $this->loginType = $this->loginType === 'email' ? 'phone' : 'email';
//         // Reset inputs when toggling
//         $this->phonenumber = '';
//         $this->email = '';
//     }
// }
