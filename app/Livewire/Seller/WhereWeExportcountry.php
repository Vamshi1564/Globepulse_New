<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class WhereWeExportcountry extends Component
{
     use WithFileUploads;
    use CustomerIdTrait;

    public $country_name;
    public $img_link;
    public $isEdit = false;
    public $exportcountryId;
    public $exportcountries = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchexportcountries();
    }
    public function fetchexportcountries()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.export_country_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->exportcountries = $response->json()['data'];
            return $this->exportcountries;
        }
    }


    public function AddexportCountry()
    {

        $this->validate([
            'country_name' => 'required',
            'img_link' => $this->isEdit ? 'nullable' : 'required',  // Validation for the main image
        ]);

        // $customerId = Session::get('id');
        $imagePath = $this->img_link;


        if ($this->img_link && is_object($this->img_link)) {
            $response = Http::attach(
                'image',
                file_get_contents($this->img_link->getRealPath()),
                $this->img_link->getClientOriginalName()
            )->post(config('api.base_url') . config('api.image_upload'), [
                'path_name' => 'export_country',
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
            'country_name' => $this->country_name,
            'img_link' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->exportcountryId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.export_country_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Data updated successfully.' : 'Data added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Brochure.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editExportCountry($exportcountryId)
    {
        // Find the product to prefill fields
        $fetchexportcountries = $this->fetchexportcountries();

        $exportcountry = collect($fetchexportcountries)->firstWhere('id', $exportcountryId);

        if ($exportcountry) {
            $this->isEdit = true;
            $this->exportcountryId = $exportcountry['id'];
            $this->country_name = $exportcountry['country_name'];
            $this->img_link = $exportcountry['img_link']; // Store current image path
        }
    }

    public function DeleteExportCountry($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.export_country_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Data Deleted successfully.');
            $this->fetchexportcountries();
        } 
    }

    public function render()
    {
        return view('livewire.seller.where-we-exportcountry');
    }
}
