<?php

namespace App\Livewire\Seller;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Postrequirment;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class PrimaryDetails extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phonenumber;
    public $alternative_mobile;
    public $designation;
    public $pin_code;
    public $city;
    public $district;
    public $state;
    public $country;
    public $address;
    public $landmark;
    public $web_url;
    public $instagram;
    public $twitter;
    public $facebook;
    public $linkedin;
    public $company;
    public $profile_image;
    public $gstno;
    public $employeecount;
    public $annualturnover;
    public $establishment;
    public $workingday;
    public $paymentmode;
    public $status = '';

    public function mount()
    {
        $this->loadCustomerDetails();
    }

    public function clearStatus()
    {
        $this->status = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function loadCustomerDetails()
    {
        $customerId = Session::get('id');
        if (!$customerId) {
            return redirect()->route('login');
        }
        
        $customer = Customer::find($customerId);
        if (!$customer) {
            session()->flash('error', 'Customer not found.');
            return redirect()->route('login');
        }

        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phonenumber = $customer->phonenumber;
        $this->alternative_mobile = $customer->alternative_mobile;
        $this->designation = $customer->designation;
        $this->pin_code = $customer->pin_code;
        $this->city = $customer->city;
        $this->district = $customer->district;
        $this->state = $customer->state;

        $country = Country::find($customer->country_id);
        $this->country = $country ? $country->short_name : null;
        $this->address = $customer->address;
        $this->landmark = $customer->landmark;
        $this->web_url = $customer->web_url;
        $this->instagram = $customer->instagram;
        $this->twitter = $customer->twitter;
        $this->facebook = $customer->facebook;
        $this->linkedin = $customer->linkedin;
        $this->company = $customer->company;
        $this->profile_image = $customer->profile_image;
        $this->gstno = $customer->gst_no;
        $this->employeecount = $customer->employee_count;
        $this->annualturnover = $customer->annual_turnoer;
        $this->establishment = $customer->company_establish_date;
        $this->workingday = $customer->working_day;
        $this->paymentmode = $customer->payment_mode;
    }

    public function update()
    {
        $customerId = Session::get('id');
        $customer = Customer::find($customerId);

        // ✅ Check if profile image is required
        if (!$customer->profile_image && !$this->profile_image) {
            $this->addError('profile_image', 'Please upload a profile image.');
            return;
        }

        $country = Country::where('short_name', $this->country)->first();

        if (!$country) {
            // Throw a validation error if the country is not found
            $this->addError('country', 'The entered country name is not valid.');
            return;
        }



        $logoPath = is_object($this->profile_image) ? $this->profile_image->store('uploads/profile_image', 'public', 's3') : Customer::find($customerId)->profile_image;


        // Use updateOrCreate to update existing or create a new record
        Customer::updateOrCreate(
            ['id' => $customerId], // Condition to find the record
            [
                'name' => $this->name,
                'email' => $this->email,
                'phonenumber' => $this->phonenumber,
                'alternative_mobile' => $this->alternative_mobile,
                'designation' => $this->designation,
                'pin_code' => $this->pin_code,
                'city' => $this->city,
                'district' => $this->district,
                'state' => $this->state,
                'country_id' => $country->country_id,
                'address' => $this->address,
                'gst_no' => $this->gstno,
                'employee_count' => $this->employeecount,
                'annual_turnoer' => $this->annualturnover,
                'company_establish_date' => $this->establishment,
                'working_day' => $this->workingday,
                'payment_mode' => $this->paymentmode,
                'landmark' => $this->landmark,
                'web_url' => $this->web_url,
                'instagram' => $this->instagram,
                'twitter' => $this->twitter,
                'facebook' => $this->facebook,
                'linkedin' => $this->linkedin,
                'company' => $this->company,
                'profile_image' => $logoPath,
            ]
        );

        Product::where('customer_id', $customerId)->update([
            'country_id' => $country->country_id
        ]);
        Postrequirment::where('customer_id', $customerId)->update([
            'country_id' => $country->country_id
        ]);
        $this->reset();
        $this->loadCustomerDetails();
        session()->flash('message', 'Details Saved Successfully!');

        return redirect()->route('primary_details');
    }

    // public function clearStatus()
    // {
    //     session()->forget(['message', 'error']);
    // }

    public function render()
    {
        return view('livewire.seller.primary-details');
    }
}
