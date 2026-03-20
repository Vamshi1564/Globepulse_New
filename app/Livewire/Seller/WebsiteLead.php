<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use App\Models\TblCustomer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class WebsiteLead extends Component
{
    use CustomerIdTrait;

    public $webleads;
    public $clientId;


    public function mount()
    {
        // $this->fetchCustomerId();

        $customerId = Session::get('id');
  
        if ($customerId) {
            $response = Http::post(config('api.base_url') . config('api.website_lead'), [
                'lead_id' => $customerId,
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
    
                // Check if 'data' key exists and contains 'leadData'
                if (isset($responseData['data']['leadData'])) {
                    $this->webleads = $responseData['data']['leadData'];
                } else {
                    $this->webleads = []; // Set an empty array to avoid errors
                }
            } else {
                $this->webleads = $response->json()['msg'] ?? 'Failed to fetch data';
            }
        } else {
            session()->flash('error', 'Client ID is not set. Cannot fetch website leads.');
        }
    }

    public function render()
    {
        return view('livewire.seller.website-lead');
    }
}
