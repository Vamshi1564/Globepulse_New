<?php

namespace App\Livewire\Seller;

use App\Models\TblCustomer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ContactUs extends Component
{
    public $business_email;
    public $business_phone;
    public $business_whatsapp;
    public $comany_name;
    public $address;
    public $pin_code;
    public $inquiry_email;
    public $map_link;
    public $clientId;


    // public function mount()
    // {
    //     $customerId = Session::get('id');

    //     if (!$customerId) {
    //         session()->flash('error', 'Customer not found.');
    //         return;
    //     }

    //     // Fetch existing data from the API
    //     $response = Http::get('https://demo.digiexpertpro.com/api/customer_all_info_api.php', [
    //         'lead_id' => $customerId,
    //     ]);

    //     if ($response->successful()) {
    //         $data = $response->json();

    //         // Pre-fill the form fields
    //         $this->business_email = $data['business_email'] ?? '';
    //         $this->business_phone = $data['business_phone'] ?? '';
    //         $this->business_whatsapp = $data['business_whatsapp'] ?? '';
    //         $this->comany_name = $data['comany_name'] ?? '';
    //         $this->address = $data['address'] ?? '';
    //         $this->pin_code = $data['pin_code'] ?? '';
    //         $this->inquiry_email = $data['inquiry_email'] ?? '';
    //         $this->map_link = $data['map_link'] ?? '';
    //     } else {
    //         session()->flash('error', 'Failed to fetch existing data.');
    //     }
    // }


    public function mount()
    {
        $this->fetchContactData();
    }

    private function fetchContactData()
    {
        $customerId = Session::get('id');

        // Fetch data from API
        $response = Http::post(config('api.base_url') . config('api.customer_all_info'), [
            
            'lead_id' => $customerId,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->business_email = $data['data'][0]['business_email'] ?? '';
            $this->business_phone = $data['data'][0]['business_phone'] ?? '';
            $this->business_whatsapp = $data['data'][0]['business_whatsapp'] ?? '';
            $this->comany_name = $data['data'][0]['comany_name'] ?? '';
            $this->address = $data['data'][0]['address'] ?? '';
            $this->pin_code = $data['data'][0]['pin_code'] ?? '';
            $this->inquiry_email = $data['data'][0]['inquiry_email'] ?? '';
            $this->map_link = $data['data'][0]['map_link'] ?? '';
            $this->clientId = $data['data'][0]['id'] ?? null;

        }
    }

    public function submit()
    {
        $validated = $this->validate([
            'business_email' => 'required',
            'business_phone' => 'required',
            'business_whatsapp' => 'required',
            'comany_name' => 'required',
            'address' => 'required',
            'pin_code' => 'required',
            'inquiry_email' => 'required',
            'map_link' => 'required',
        ]);

        // $customerId = Session::get('id');

        // Fetch or create customer

        if (!$this->clientId) {
            return session()->flash('error', 'Customer not found.');
        }


        $apiData = [
            'id' => $this->clientId, // Lead ID to be passed to the API
            'business_email'   => $this->business_email,
            'business_phone'  => $this->business_phone,
            'business_whatsapp'   => $this->business_whatsapp,
            'comany_name' => $this->comany_name,
            'address'  => $this->address,
            'pin_code'  => $this->pin_code,
            'inquiry_email'  => $this->inquiry_email,
            'map_link'  => $this->map_link,
            'form_name' => 'contact',

        ];

        $response = Http::post(config('api.base_url') . config('api.customer_all_info_update'), $apiData);

        if ($response->successful()) {
            // Update the customer social media fields if API call is successful
            // $customer->update($apiData);
            session()->flash('message', 'Contact Details Added Successfully!');
            $this->fetchContactData();
        } else {
            session()->flash('error', 'Failed to update Contact Details.');
        }
    }

    public function render()
    {
        return view('livewire.seller.contact-us');
    }
}
