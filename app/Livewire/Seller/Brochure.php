<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Brochure extends Component
{
     use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $brochure_link;
    public $isEdit = false;
    public $brochureId;
    public $brochures = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchbrochures();
    }
    public function fetchbrochures()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.brochure_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->brochures = $response->json()['data'];
            return $this->brochures;
        }
    }


    public function Addbrochure()
    {

        $this->validate([
            'name' => 'required',
            'brochure_link' => $this->isEdit ? 'nullable' : 'required',  // Validation for the main image
        ]);

        // $customerId = Session::get('id');
        $imagePath = $this->brochure_link;


        if ($this->brochure_link && is_object($this->brochure_link)) {
            $response = Http::attach(
                'image',
                file_get_contents($this->brochure_link->getRealPath()),
                $this->brochure_link->getClientOriginalName()
            )->post(config('api.base_url') . config('api.image_upload'), [
                'path_name' => 'brochure',
            ]);

            if ($response->successful()) {
                $imagePath = $response->json('data'); // Get the new image path
            } else {
                session()->flash('error', 'Failed to upload the main image.');
                return;
            }
        }

        // Prepare data for the SLider (whether adding or updating)
        $data = [
            'name' => $this->name,
            'img_link' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->brochureId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.brochure_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Brochure updated successfully.' : 'Brochure added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Brochure.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editBrochure($brochureId)
    {
        // Find the product to prefill fields
        $fetchBrochures = $this->fetchbrochures();

        $brochure = collect($fetchBrochures)->firstWhere('id', $brochureId);

        if ($brochure) {
            $this->isEdit = true;
            $this->brochureId = $brochure['id'];
            $this->name = $brochure['name'];
            $this->brochure_link = $brochure['brochure_link']; // Store current image path
        }
    }

    public function DeleteBrochure($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.brochure_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Brochure Deleted successfully.');
            $this->fetchbrochures();
        } 
    }

    public function render()
    {
        return view('livewire.seller.brochure');
    }
}
