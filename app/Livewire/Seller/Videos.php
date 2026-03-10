<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Videos extends Component
{
    use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $link;
    public $isEdit = false;
    public $videoId;
    public $videos = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchVideos();
    }
    public function fetchVideos()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.video_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
                $this->videos = $response->json()['data'];

        }
    }


    public function AddVideo()
    {

        $this->validate([
            'name' => 'required',
            'link' => $this->isEdit ? 'nullable' : 'required',  // Validation for the main image
        ]);

        // $customerId = Session::get('id');
        // $imagePath = $this->img_link;


        // if ($this->img_link && is_object($this->img_link)) {
        //     $response = Http::attach(
        //         'image',
        //         file_get_contents($this->img_link->getRealPath()),
        //         $this->img_link->getClientOriginalName()
        //     )->post(config('api.base_url') . config('api.image_upload'), [
        //         'path_name' => 'video',
        //     ]);

        //     if ($response->successful()) {
        //         $imagePath = $response->json('data'); // Get the new image path
        //     } else {
        //         session()->flash('error', 'Failed to upload the main image.');
        //         return;
        //     }
        // }

        // Prepare data for the SLider (whether adding or updating)
        $data = [
            'name' => $this->name,
            'link' => $this->link,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->videoId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.video_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Video updated successfully.' : 'Video added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Video.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editVideo($videoId)
    {
        // Find the product to prefill fields
        $video = collect($this->videos)->firstWhere('id', $videoId);


        if ($video) {
            $this->isEdit = true;
            $this->videoId = $video['id'];
            $this->name = $video['name'];
            $this->link = $video['link']; // Store current image path
        }
    }

    public function Deletevideo($id)
    {

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.video_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Video Deleted successfully.');
            $this->fetchVideos();
        }
    }

    public function render()
    {
        return view('livewire.seller.videos');
    }
}
