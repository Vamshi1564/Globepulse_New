<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BuyerLogin extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public $errorMsg = '';
    public $successMsg = '';

    public function mount()
    {
        // Clear old buyer session
        session()->forget(['buyer_id','buyer_email','buyer_name']);

        if(session('login_success')){
            $this->successMsg = session('login_success');
        }
    }

    public function login()
    {
        $this->errorMsg = '';

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $emailLower = strtolower(trim($this->email));

        $buyer = DB::table('buyers')
            ->where('email',$emailLower)
            ->first();

        if(!$buyer){
            $this->errorMsg = 'No account found with this email.';
            return;
        }

        if($buyer->email_verified == 0){

            session(['buyer_register_email'=>$emailLower]);

            return redirect()->route('buyer.verify.otp')
                ->with('otp_success','Please verify your email first.');
        }

        if($buyer->is_active == 0){
            $this->errorMsg = 'Your account is inactive.';
            return;
        }

        if(!Hash::check($this->password,$buyer->password_hash)){
            $this->errorMsg = 'Incorrect password.';
            return;
        }

        // Create session
        session([
    'buyer_id' => $buyer->id,
    'buyer_email' => $buyer->email,
    'buyer_name' => $buyer->full_name
]);

DB::table('buyers')
    ->where('id',$buyer->id)
    ->update([
        'last_login_at'=>now()
    ]);

if ($buyer->must_change_password == 1) {
    return redirect()->route('buyer.set-password');
}

return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.front.buyer-login');
    }
}