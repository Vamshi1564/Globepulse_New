<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Testimonial extends Component
{

    use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $content;
    public $img_link;
    public $customer_id;
    public $isEdit = false;
    public $TestimonialId;
    public $testimonials;
    public $clientId;
    public $page = 1; 
    
    public function mount()
    {
        $this->fetchCustomerId();
    }
    public function fetchTestimonial()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.testimonial_list') , [
            
            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $testimonials = $response->json()['data'];
            return $this->testimonials = $testimonials;
        } 

    }


    public function AddTestimonial()
    {

        $this->validate([
            'name' => 'required',
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
                'path_name' => 'testimonial',
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
            'content' => $this->content,
            'img_link' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->TestimonialId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.testimonial_update'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Testimonial updated successfully.' : 'Testimonial added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Testimonial.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editTestimonial($TestimonialId)
    {
        // Find the product to prefill fields
        $testimonial = $this->fetchTestimonial();

        $testimon = collect($testimonial)->firstWhere('id', $TestimonialId);

        if ($testimon) {
            $this->isEdit = true;
            $this->TestimonialId = $testimon['id'];
            $this->name = $testimon['name'];
            $this->content = $testimon['content'];
            $this->img_link = $testimon['img_link']; // Store current image path
        }
    }

    public function DeleteTestimonial($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.testimonial_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Testimonial Deleted successfully.');
            $this->fetchTestimonial();
        } 
    }
    
    public function render()
    {
        $testimonials = collect($this->fetchTestimonial())->forPage($this->page, 10); // Show 5 products per page
        $total = count($this->fetchTestimonial());
        return view('livewire.seller.testimonial' ,[
            'testimonials' => $testimonials,
            'totalPages' => ceil($total / 10), 
        ]);
    }
}
