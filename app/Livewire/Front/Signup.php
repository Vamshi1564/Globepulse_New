<?php

namespace App\Livewire\Front;

use App\Models\Country;
use App\Models\Customer;
use Exception;
use Livewire\Component;

class Signup extends Component
{
    public $name;
    public $company;
    public $email;
    public $country = 101;
    public $phonenumber;
    public $password;
    // public $user_type;
    public $confirm_password;

    public $customerId;
    public $customer;

    public function mount($id = null)
    {

        if (!$id) {
            session()->flash('error', 'Verify your email First ');
            return redirect()->route('emailverify');
        }

        $sessionEmail = session('otp_email'); // email stored in session

        $this->customerId = $id;
        $this->customer = Customer::find($id);

        if ($this->customer->email != $sessionEmail) {
            session()->flash('error', 'Invalid signup link.');
            return redirect()->route('emailverify');
        }

        // Prefill data
        $this->email = $this->customer->email;
        $this->country = $this->customer->country_id;
    }


    public function render()
    {
        $countries = Country::all();
        return view('livewire.front.signup', compact('countries'));
    }

    public function submit()
    {
        $validated = $this->validate([
            'name' => 'required',
            'company' => 'required',
            'country' => 'required',
            // 'email' => 'required|email|unique:tblleads,email',
            'phonenumber' => 'required|numeric|unique:tblleads,phonenumber',
            // 'user_type' => 'required',
            // 'password' => 'required|min:6',
            // 'confirm_password' => 'required|same:password'
        ]);

        // $existingCustomer = Customer::where('phonenumber', $this->phonenumber)->first();
        // if ($existingCustomer) {
        //     session()->flash('error', 'The phone number is already registered. Please use a different number.');
        //     return;
        // }

        if ($this->country == 101) {
            $this->phonenumber = preg_replace('/\D/', '', $this->phonenumber);
            if (strlen($this->phonenumber) > 10) {
                $this->phonenumber = substr($this->phonenumber, -10);
            }
        }
        try {



            // Customer::create([
            //     'name' => $this->name,
            //     'company' => $this->company,
            //     'email' => $this->email,
            //     'country_id' => $this->country,
            //     'phonenumber' => $this->phonenumber,
            //     // 'password' => $this->password,
            //     // 'user_type' => $this->user_type,
            //     'source' => 21,
            //     'dateadded' => now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            //     'created_at' => now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            //     'updated_at' => now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            // ]);

            if ($this->customer) {
                // Update existing
                $this->customer->update([
                    'name' => $this->name,
                    'company' => $this->company,
                    // 'email' => $this->email,
                    'country_id' => $this->country,
                    'phonenumber' => $this->phonenumber,
                    'updated_at' => now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
                session(['otp_country' => $this->country]);
            }
            // session()->flash('message', 'Account has been Successfully Created.');
            return redirect()->route('login')
                ->with('message', 'Account has been Created Successfully');
            $this->reset();
        } catch (Exception $e) {
            // Log::error("Excel Import Error: " . $e->getMessage());
            // session()->flash('error', value: 'Something went Wrong.');
            // Log::error("Excel Import Error: " . $e->getMessage());
            session()->flash('error', 'Something went wrong. ' . $e->getMessage());
        }
    }
}
