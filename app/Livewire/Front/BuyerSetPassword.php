<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BuyerSetPassword extends Component
{
    public $password = '';
    public $password_confirm = '';
    public $errorMsg = '';
    public $buyerName = '';

    public function mount()
    {
        if (!session('buyer_id')) {
            return redirect()->route('buyer.login');
        }

        $buyer = DB::table('buyers')
            ->where('id', session('buyer_id'))
            ->first();

        if (!$buyer) {
            return redirect()->route('buyer.login');
        }

        if ($buyer->must_change_password == 0) {
            return redirect()->route('buyer.dashboard');
        }

        $this->buyerName = $buyer->full_name;
    }

    public function save()
    {
        $this->errorMsg = '';

        $this->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'password_confirm' => 'required|same:password',
        ]);

        $buyer = DB::table('buyers')
            ->where('id', session('buyer_id'))
            ->first();

        if (!$buyer) {
            return redirect()->route('buyer.login');
        }

        if (Hash::check($this->password, $buyer->password_hash)) {
            $this->errorMsg = 'New password cannot be the same as temporary password.';
            return;
        }

        DB::table('buyers')
            ->where('id',$buyer->id)
            ->update([
                'password_hash' => Hash::make($this->password),
                'must_change_password' => 0,
                'updated_at'=>now()
            ]);

        return redirect()->route('buyer.dashboard')
            ->with('dashboard_success','Password updated successfully!');
    }

    public function render()
    {
        return view('livewire.front.buyer-set-password');
    }
}