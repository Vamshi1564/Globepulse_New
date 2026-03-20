<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyInfo extends Component
{
    use WithFileUploads;
    use CustomerIdTrait;
    

    public $heading;
    public $content;
    public $mission;
    public $vision;
    public $img_link;
    public $customer_id;
    public $isEdit = false;
    public $AboutusId;
    public $Aboutusdetails;
    public $clientId;


    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchDetails();

    }


    public function fetchDetails()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.about_us_list'), [
            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->Aboutusdetails = $response->json()['data'];
        }
    }


    public function AddAbout()
    {

        $this->validate([
            'heading' => 'required',
            'content' => 'required',
            'mission' => 'required',
            'vision' => 'required',
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
                'path_name' => 'about',
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
            'heading' => $this->heading,
            'content' => $this->content,
            'mission' => $this->mission,
            'vision' => $this->vision,
            'img_link' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->AboutusId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.about_us_update'), $data);


        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'About Us Details updated successfully.' : 'About Us Details added successfully.');
            $this->reset(); // Reset the form
            $this->fetchDetails();
        } else {
            session()->flash('error', 'Failed to save About Us Details.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editAbout($AboutusId)
    {
        // Find the product to prefill fields

        $about = collect($this->Aboutusdetails)->firstWhere('id', $AboutusId);

        if ($about) {
            $this->isEdit = true;
            $this->AboutusId = $about['id'];
            $this->heading = $about['heading'];
            $this->content = $about['content'];
            $this->mission = $about['mission'];
            $this->vision = $about['vision'];
            $this->img_link = $about['img_link']; // Store current image path
        }
    }

    public function DeleteAbout($id)
    {

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.about_us_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'About Us Details Deleted successfully.');
            $this->fetchDetails();
        }
    }


    public function render()
    {
        return view('livewire.seller.company-info');
    }
}
