<?php

namespace App\Livewire\Seller;

use App\Models\TblCustomer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Logo extends Component
{
    use WithFileUploads;

    public $logo;
    public $customerlogo;
    public $clientId;


    public function mount()
    {
        // Retrieve the current logo from the database or API
        $customerId = Session::get('id');

        $response = Http::post(config('api.base_url') . config('api.customer_all_info'), [
            'lead_id' => $customerId,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->customerlogo = $data['data'][0]['logo'] ?? null;
            $this->clientId = $data['data'][0]['id'] ?? null;
        } 
    }


    public function submit()
    {
        $validated = $this->validate([
            'logo' => 'required',

        ]);

        // $customerId = Session::get('id');


        if (!$this->clientId) {
            return session()->flash('error', 'Customer not found.');
        }
        // $imagePath = $this->logo->store('uploads/web_logo', 'public');


        $response = Http::attach(
            'image',  // 'image' is the name of the form field on the API
            file_get_contents($this->logo->getRealPath()),
            $this->logo->getClientOriginalName()
        )->post(config('api.base_url') . config('api.image_upload'), [
            'path_name' => 'logo',
            // 'customer_id' => $customerId,
            // 'form_name' => 'personal',
        ]);
        // $customerId = Session::get('id');

        if ($response->successful()) {

            // dd($response->json(), $response->status());

            // Store the success message in session
            $filePath = $response->json('data');

            $apiData = [
                'id' => $this->clientId,
                'logo' => $filePath,
                'form_name' => 'personal', // Pass form_name here
            ];

            $updateResponse = Http::post(config('api.base_url') . config('api.customer_all_info_update'), $apiData);

            // dd($updateResponse->status(), $updateResponse->json());


            if ($updateResponse->successful()) {
                $this->customerlogo = $filePath;
                session()->flash('message', 'Logo updated successfully.');
            } else {
                session()->flash('error', 'Failed to update customer logo.');
            }
        } else {
            // Store the error message in session
            session()->flash('error', 'Failed to upload the file.');
        }

        $this->reset('logo');
    }



    public function render()
    {

        return view('livewire.seller.logo');
    }
}
