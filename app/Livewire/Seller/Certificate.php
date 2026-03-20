<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Certificate extends Component
{
     use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $img_link;
    public $isEdit = false;
    public $certificateId;
    public $certificates = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchCertificates();
    }
    public function fetchCertificates()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.certificate_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->certificates = $response->json()['data'];
            return $this->certificates;
        }
    }


    public function AddCertificate()
    {

        $this->validate([
            'name' => 'required',
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
                'path_name' => 'certificate',
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
            'id' => $this->isEdit ? $this->certificateId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.certificate_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Certificate updated successfully.' : 'Certificate added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Certificate.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editCertificate($certificateId)
    {
        // Find the product to prefill fields
        $fetchCertificates = $this->fetchCertificates();

        $certi = collect($fetchCertificates)->firstWhere('id', $certificateId);

        if ($certi) {
            $this->isEdit = true;
            $this->certificateId = $certi['id'];
            $this->name = $certi['name'];
            $this->img_link = $certi['img_link']; // Store current image path
        }
    }

    public function DeleteCertificate($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.certificate_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Certificate Deleted successfully.');
            $this->fetchCertificates();
        } 
    }

    public function render()
    {
        return view('livewire.seller.certificate');
    }
}
