<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RefundPolicy extends Component
{
       use CustomerIdTrait;

    public $description;
    public $isEdit = false;
    public $refundId;
    public $refunds = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchrefunds();
    }
    public function fetchrefunds()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.refund_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->refunds = $response->json()['data'];
            return $this->refunds;
        }
    }


    public function AddRefund()
    {

        $this->validate([
            'description' => 'required',  // Validation for the main image
        ]);



        // Prepare data for the SLider (whether adding or updating)
        $data = [
            'description' => $this->description,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->refundId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.refund_api'), $data);

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

    public function editRefund($refundId)
    {
        // Find the product to prefill fields
        $fetchrefunds = $this->fetchrefunds();

        $refund = collect($fetchrefunds)->firstWhere('id', $refundId);

        if ($refund) {
            $this->isEdit = true;
            $this->refundId = $refund['id'];
            $this->description = $refund['description'];
        }
    }

    public function DeleteRefund($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.refund_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Data Deleted successfully.');
            $this->fetchrefunds();
        } 
    }

    public function render()
    {
        return view('livewire.seller.refund-policy');
    }
}
