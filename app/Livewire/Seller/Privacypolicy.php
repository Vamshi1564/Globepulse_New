<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Privacypolicy extends Component
{
      use CustomerIdTrait;

    public $description;
    public $isEdit = false;
    public $policyId;
    public $policies = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchpolicy();
    }
    public function fetchpolicy()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.privacy_policy_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->policies = $response->json()['data'];
            return $this->policies;
        }
    }


    public function AddPolicy()
    {

        $this->validate([
            'description' => 'required',  // Validation for the main image
        ]);



        // Prepare data for the SLider (whether adding or updating)
        $data = [
            'description' => $this->description,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->policyId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.privacy_policy_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Data updated successfully.' : 'Data added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Terms.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editPolicy($privacyId)
    {
        // Find the product to prefill fields
        $fetchpolicy = $this->fetchpolicy();

        $policy = collect($fetchpolicy)->firstWhere('id', $privacyId);

        if ($policy) {
            $this->isEdit = true;
            $this->policyId = $policy['id'];
            $this->description = $policy['description'];
        }
    }

    public function DeletePolicy($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.privacy_policy_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Data Deleted successfully.');
            $this->fetchpolicy();
        } 
    }

    public function render()
    {
        return view('livewire.seller.privacypolicy');
    }
}
