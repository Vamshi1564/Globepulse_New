<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Slider extends Component
{
    use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $img_link;
    public $customer_id;
    public $isEdit = false;
    public $sliderId;
    public $sliders;
    public $clientId;
    public $page = 1; 



    public function mount()
    {
        $this->fetchCustomerId();
    }

    public function fetchSlider()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.slider_list') , [
            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $sliders = $response->json()['data'];
            return $this->sliders = $sliders;
        } 

    }


    public function AddSlider()
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
                'path_name' => 'slider',
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
            'id' => $this->isEdit ? $this->sliderId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.slider_update'), $data);
        

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Slider updated successfully.' : 'Slider added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Slider.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editSlider($sliderId)
    {
        // Find the product to prefill fields
        $slider = $this->fetchSlider();

        $slider = collect($slider)->firstWhere('id', $sliderId);

        if ($slider) {
            $this->isEdit = true;
            $this->sliderId = $slider['id'];
            $this->name = $slider['name'];
            $this->img_link = $slider['img_link']; // Store current image path
        }
    }

    public function DeleteSlider($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.slider_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Slider Deleted successfully.');
            $this->fetchSlider();
        } 
    }
    
    public function render()
    {
        $sliders = collect($this->fetchSlider())->forPage($this->page, 10); // Show 5 products per page
        $total = count($this->fetchSlider());

        return view('livewire.seller.slider' , [
            'sliders' => $sliders,
            'totalPages' => ceil($total / 10), 
        ]);
    }
}
