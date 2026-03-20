<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Productgallery;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SellerProductEdit extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $product_img;
    public $existing_product_img;
    // public $category_id;
    public $max_price;
    public $gallery_images;
    public $min_price;
    public $min_order;
    public $business_type;
    public $slug;
    public $HSN;
    public $productId;
    public $customerId;

    public function mount($productId)
    {

        $product = Product::with('galleryimages')->find($productId);
        if ($product) {
            // $this->id = $product->id;
            $this->title = $product->title;
            $this->description = $product->description;
            $this->existing_product_img = $product->product_img;
            $this->gallery_images = $product->galleryimages;
            // $this->category_id = $product->category_id;
            $this->max_price = $product->max_price;
            $this->min_price = $product->min_price;
            $this->min_order = $product->min_order;
            $this->business_type = $product->business_type;
            $this->slug = $product->slug;
            $this->HSN = $product->HSN;
            $this->customerId = $product->customer_id;
        }
    }
    public function update()
    {
        try {
            date_default_timezone_set('Asia/Kolkata');

            $validated = $this->validate([
                'title' => 'required',
                'description' => 'required',
                'product_img' => 'nullable|mimes:webp,jpg|dimensions:width=1080,height=1080',
                'gallery_images' => 'nullable|array',
                'max_price' => 'required|numeric',
                'min_price' => 'required|numeric',
                // 'category_id' => 'required',
                'min_order' => 'required',
                'business_type' => 'required'
            ], [
                // 'category_id.required' => 'Please select a category.',
                'product_img.required' => 'The product img is required.',
                'product_img.dimensions' => 'The product image must be exactly 1080px by 1080px.',
                'product_img.mimes' => 'The product image must be in webp or jpg format.',
            ]);



            $product = Product::find($this->productId);

            if ($this->product_img instanceof \Illuminate\Http\UploadedFile) {
                // Handle image upload only if it's a new upload

                if ($this->existing_product_img) {
                    Storage::delete('public/' . $this->existing_product_img);
                }

                $originalName = $this->product_img->getClientOriginalName();
                $nameOnly = preg_replace('/[[:space:]]+/', '-', trim(preg_replace('/\x{00A0}/u', ' ', pathinfo($originalName, PATHINFO_FILENAME))));
                $extension = $this->product_img->getClientOriginalExtension();
                $randomNumber = rand(1000, 999999);
                $uniqueName = $nameOnly . '-' . $randomNumber . '.' . $extension;

                $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
                $product->product_img = 'uploads/product/' . $uniqueName;
            }

            // Update product details
            $product->update([
                'title' => $this->title,
                'description' => $this->description,
                // 'category_id' => $this->category_id,
                'max_price' => $this->max_price,
                'min_price' => $this->min_price,
                'min_order' => $this->min_order,
                'business_type' => $this->business_type,
                'slug' => $this->slug,
                'HSN' => $this->HSN,
                'customer_id' => $this->customerId,
                'updated_at' => Carbon::now(),
            ]);

            if (!empty($this->gallery_images)) {
                // Productgallery::where('product_id', $this->id)->delete();

                foreach ($this->gallery_images as $galleryImage) {
                    if ($galleryImage instanceof \Illuminate\Http\UploadedFile) {

                        $this->validate(
                            [
                                'gallery_images.*' => 'nullable|mimes:webp,jpg|dimensions:width=1080,height=1080'
                            ],
                            [
                                'gallery_images.*.dimensions' => 'Gallery Image must be exactly 1080px by 1080px.',
                                'gallery_images.*.mimes' => 'Gallery Image must be in webp or jpg format.',
                            ]
                        );

                        $originalName = $galleryImage->getClientOriginalName();
                        $nameOnly = preg_replace('/[[:space:]]+/', '-', trim(preg_replace('/\x{00A0}/u', ' ', pathinfo($originalName, PATHINFO_FILENAME))));
                        $extension = $galleryImage->getClientOriginalExtension();
                        $randomNumber = rand(1000, 999999);
                        $uniqueName = $nameOnly . '-' . $randomNumber . '.' . $extension;

                        $galleryImage->storeAs('public/uploads/gallery', $uniqueName, 's3');
                        $galleryImagePath = 'uploads/gallery/' . $uniqueName;

                        Productgallery::create([
                            'product_id' => $product->id,
                            'gallery_images' => $galleryImagePath,
                            'customer_id' => $this->customerId,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
            $this->reset();
            session()->flash('message', 'Product Updated Successfully!');
        } catch (\Exception $e) {
            // Log::error('Product update error: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while updating the product.');
        }
    }


    public function removeImage($key)
    {
        // Remove image from the temporary uploads
        unset($this->gallery_images[$key]);
        // Re-index the array to prevent issues
        $this->gallery_images = array_values($this->gallery_images);
    }

    public function removeImageFromDB($imageId)
    {
        // Find the gallery image by ID
        $image = Productgallery::find($imageId);

        if ($image) {
            // Delete the image file from the storage
            Storage::delete('public/' . $image->gallery_images);

            // Delete the image record from the database
            $image->delete();

            // Refresh the gallery images after deletion
            $this->gallery_images = Productgallery::where('product_id', $this->productId)->get();
        }
    }
    public function render()
    {
        return view('livewire.seller.seller-product-edit');
    }
}
