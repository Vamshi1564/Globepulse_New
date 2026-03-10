<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TermsConditionsWebsite extends Component
{
    use CustomerIdTrait;

    public $description;
    public $isEdit = false;
    public $termsId;
    public $terms = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchTerms();
    }
    public function fetchTerms()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.terms_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->terms = $response->json()['data'];
            return $this->terms;
        }
    }


    public function AddTerms()
    {

        $this->validate([
            'description' => 'required',  // Validation for the main image
        ]);



        // Prepare data for the SLider (whether adding or updating)
        $data = [
            'description' => $this->description,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->termsId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.terms_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Terms updated successfully.' : 'Terms added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Terms.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editTerms($termsId)
    {
        // Find the product to prefill fields
        $fetchterms = $this->fetchTerms();

        $term = collect($fetchterms)->firstWhere('id', $termsId);

        if ($term) {
            $this->isEdit = true;
            $this->termsId = $term['id'];
            $this->description = $term['description'];
        }
    }

    public function DeleteTerms($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.terms_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Terms Deleted successfully.');
            $this->fetchTerms();
        } 
    }

    public function render()
    {
        return view('livewire.seller.terms-conditions-website');
    }
}
