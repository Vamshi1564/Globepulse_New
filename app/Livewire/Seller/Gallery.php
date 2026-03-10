<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gallery extends Component
{
    use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $img_link;
    public $customer_id;
    public $isEdit = false;
    public $GalleryId;
    public $Gallerydetails;
    public $clientId;


    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchDetails();
    }

    
    public function fetchDetails()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.photo_gallery_list'), [
            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->Gallerydetails = $response->json()['data'];
        } 

    }


    public function AddGalleryImages()
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
                'path_name' => 'gallery',
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
            'id' => $this->isEdit ? $this->GalleryId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.photo_gallery_update'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Gallery Details updated successfully.' : 'Gallery Details added successfully.');
            $this->reset(); // Reset the formd
            $this->fetchDetails();
        } else {
            session()->flash('error', 'Faile to save Gallery Details.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editGallery($GalleryId)
    {
        // Find the product to prefill fields

        $Gallery = collect($this->Gallerydetails)->firstWhere('id', $GalleryId);

        if ($Gallery) {
            $this->isEdit = true;
            $this->GalleryId = $Gallery['id'];
            $this->name = $Gallery['name'];
            $this->img_link = $Gallery['img_link']; // Store current image path
        }
    }

    public function DeleteGallery($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.photo_gallery_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Gallery Details Deleted successfully.');
            $this->fetchDetails();
        } 
    }

    public function render()
    {
        return view('livewire.seller.gallery');
    }
}
