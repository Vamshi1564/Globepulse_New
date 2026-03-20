<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Productgallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportPagination\HandlesPagination;

class ProductList extends Component
{
    use HandlesPagination;


    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            // Delete gallery images associated with the product
            $galleryImages = Productgallery::where('product_id', $productId)->get();

            foreach ($galleryImages as $image) {
                Storage::delete('public/' . $image->gallery_images); // Delete image from storage
                $image->delete(); // Delete image record from the database
            }

            // Delete the product itself
            $product->delete();

            // Refresh the product list
            // $this->products = Product::where('customer_id', $this->client->id)->get();

            session()->flash('message', 'Product and gallery images deleted successfully.');
        }
    }

    public function render()
    {
        $customerId = Session::get('id');

        $products = Product::where('customer_id', $customerId)->paginate(12);


        return view('livewire.seller.product-list', compact('products'));
    }
}
