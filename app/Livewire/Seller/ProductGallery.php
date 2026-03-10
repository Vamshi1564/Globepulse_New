<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Productgallery as ModelsProductgallery;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductGallery extends Component
{

    use WithFileUploads;

    public $productId;
    public $gallery_images;

    public function mount($productId)
    {
        $this->productId = $productId;

        $product = Product::find($this->productId);

        if (!$product) {
            return Redirect()->route('product_add'); // Adjust the route name as needed
            // Session::flash('error', "Your account doesn't exist. create First");
        }
    }


    public function saveDetail()
    {

        $validated = $this->validate([
            'gallery_images' => 'required|array',
            'gallery_images.*' => 'mimes:webp,jpg|dimensions:width=1080,height=1080'
        ] ,[
            'gallery_images.mimes' => 'The product image must be a webp,jpg.',
            'gallery_images.dimensions' => 'The product image must be exactly 1080px by 1080px.',
        ]);

        // dd($this->gallery_images);

        $customerId = Session::get('id');

        if (!empty($this->gallery_images)) {
            foreach ($this->gallery_images as $galleryImage) {

                $galleryImagePath = $galleryImage->store('uploads/gallery', 'public', 's3');
                ModelsProductgallery::create([
                    'product_id' => $this->productId,
                    'gallery_images' => $galleryImagePath,
                    'customer_id' => $customerId
                ]);
            }
        }
        $this->reset();
        // session()->flash('message', 'Product Added Successfully!');
        return redirect()->route('product_list')->with('message', 'Product Added Successfully!');


    }
    public function render()
    {
        return view('livewire.seller.product-gallery');
    }
}
