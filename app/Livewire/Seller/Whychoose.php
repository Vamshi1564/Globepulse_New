<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Whychoose extends Component
{
    use WithFileUploads;
    use CustomerIdTrait;


    public $heading;
    public $content;
    public $img_link;
    public $customer_id;
    public $isEdit = false;
    public $whyusId;
    public $whyusdetails;
    public $clientId;


    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchWhyusDetails();
    }


    public function fetchWhyusDetails()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.whyus_list'), [
            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->whyusdetails = $response->json()['data'];
        }
    }


    public function Addwhyus()
    {

        $this->validate([
            'heading' => 'required',
            'content' => 'required',
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
                'path_name' => 'whyus',
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
            'img_link' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->whyusId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.why_choose_us_update'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Whyus Details updated successfully.' : 'Whyus Details added successfully.');
            $this->reset(); // Reset the formd
            $this->fetchWhyusDetails();
        } else {
            session()->flash('error', 'Faile to xsave Whyus Details.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editWhyus($whyusId)
    {
        // Find the product to prefill fields

        $Whyus = collect($this->whyusdetails)->firstWhere('id', $whyusId);

        if ($Whyus) {
            $this->isEdit = true;
            $this->whyusId = $Whyus['id'];
            $this->heading = $Whyus['heading'];
            $this->content = $Whyus['content'];
            $this->img_link = $Whyus['img_link']; // Store current image path
        }
    }

    public function DeleteWhyus($id)
    {

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.why_choose_us_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Whyus Details Deleted successfully.');
            $this->fetchWhyusDetails();
        }
    }

    public function render()
    {
        return view('livewire.seller.whychoose');
    }
}
