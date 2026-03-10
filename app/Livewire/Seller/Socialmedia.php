<?php

namespace App\Livewire\Seller;

use App\Models\TblCustomer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Socialmedia extends Component
{

    public $twitter;
    public $facebook;
    public $youtube;
    public $instagram;
    public $linkedin;
    public $clientId;


    public function mount()
    {
        $this->fetchSocialMediaData();
    }

    private function fetchSocialMediaData()
    {
        $customerId = Session::get('id');

        // Fetch data from API
        $response = Http::post(config('api.base_url') . config('api.customer_all_info'), [
            'lead_id' => $customerId,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->twitter = $data['data'][0]['twitter'] ?? null;
            $this->facebook = $data['data'][0]['facebook'] ?? null;
            $this->youtube = $data['data'][0]['youtube'] ?? null;
            $this->instagram = $data['data'][0]['instagram'] ?? null;
            $this->linkedin = $data['data'][0]['linkedin'] ?? null;
            $this->clientId = $data['data'][0]['id'] ?? null;
        }
    }


    public function submit()
    {
        $validated = $this->validate([
            'twitter' => 'required',
            'facebook' => 'required',
            'youtube' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
        ]);

        // $customerId = Session::get('id');

        // $customer = TblCustomer::find($customerId);

        if (!$this->clientId) {
            return session()->flash('error', 'Customer not found.');
        }

        $apiData = [
            'id'   => $this->clientId, // Lead ID to be passed to the API
            'twitter'   => $this->twitter,
            'facebook'  => $this->facebook,
            'youtube'   => $this->youtube,
            'instagram' => $this->instagram,
            'linkedin'  => $this->linkedin,
            'form_name' => 'social_media',
        ];

        $response = Http::post(config('api.base_url') . config('api.customer_all_info_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Social Media Added Successfully!');
            $this->fetchSocialMediaData();
        } else {
            session()->flash('error', 'Failed to update social media.');
        }
    }


    public function render()
    {
        return view('livewire.seller.socialmedia');
    }
}
