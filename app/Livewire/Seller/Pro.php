<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pro extends Component
{
    use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $des;
    public $long_des;
    public $product_cat;
    public $main_img;
    public $customer_id;
    public $isEdit = false;
    public $productId;
    public $clientId;
    public $pro_categories = [];  // To store categories
    public $products = [];  // To store categories
    public $page = 1; // For pagination



    public function mount()
    {
        // Fetch categories when the component is mounted
        $this->fetchCustomerId();
        $this->fetchCategories();
        // $this->fetchProducts();
    }

    public function fetchCategories()
    { 
        // $CustomerId = Session::get('id');
        // Replace with the actual API or data source to fetch categories
        $response = Http::post(config('api.base_url'). config('api.procat_list'), [
            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->pro_categories = $response->json()['data'];  // Assuming the response contains 'data' with categories
        }
        // dd($this->pro_categories);
    }


    public function fetchProducts()
    {
        // $customerId = Session::get('id');

        $response = Http::post(config('api.base_url') . config('api.product_list'), [

            'customer_id' => $this->clientId,
        ]);


        if ($response->successful()) {
            $products = $response->json()['data'];

            foreach ($products as &$product) {
                // Find the category by category ID (product_cat)
                $category = collect($this->pro_categories)->firstWhere('id', $product['product_cat']);

                // Add the category name to the product, if found
                $product['category_name'] = $category ? $category['name'] : '';
            }
            // dd($this->products);
            return $this->products = $products;
        }
    }

    public function AddProduct()
    {

        $this->validate([
            'name' => 'required',
            'des' => 'required',
            'long_des' => 'required',
            'product_cat' => 'required',
            'main_img' => $this->isEdit ? 'nullable' : 'required',  // Validation for the main image
        ]);

        // $customerId = Session::get('id');
        $imagePath = $this->main_img;


        if ($this->main_img && is_object($this->main_img)) {
            $response = Http::attach(
                'image',
                file_get_contents($this->main_img->getRealPath()),
                $this->main_img->getClientOriginalName()
            )->post(config('api.base_url') . config('api.image_upload'), [
                'path_name' => 'product',
            ]);

            if ($response->successful()) {
                $imagePath = $response->json('data'); // Get the new image path
            } else {
                session()->flash('error', 'Failed to upload the main image.');
                return;
            }
        }

        // Prepare data for the product (whether adding or updating)
        $data = [
            'name' => $this->name,
            'des' => $this->des,
            'long_des' => $this->long_des,
            'product_cat' => $this->product_cat,
            'main_img' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->productId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.product_update'), $data);


        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Product updated successfully.' : 'Product added successfully.');
            $this->reset(); // Reset the form
            $this->fetchCategories();
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save product.');
        }
        return redirect()->to(request()->header('Referer'));
        $this->reset();

    }

    public function editProduct($productId)
    {
        // Find the product to prefill fields
        $products = $this->fetchProducts();

        $product = collect($products)->firstWhere('id', $productId);

        if ($product) {
            $this->isEdit = true;
            $this->productId = $product['id'];
            $this->name = $product['name'];
            $this->des = $product['des'];
            $this->long_des = $product['long_des'];
            $this->product_cat = $product['product_cat'];
            $this->main_img = $product['main_img']; // Store current image path
        }
    }

    public function DeleteProduct($id)
    {

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.product_update'), $apiData);
        

        if ($response->successful()) {
            session()->flash('message', 'Product Deleted successfully.');
            $this->fetchProducts();
        }
    }

    public function render()
    {
        $products = collect($this->fetchProducts())->forPage($this->page, 10); // Show 5 products per page
        $total = count($this->fetchProducts());

        return view('livewire.seller.pro', [
            'products' => $products,
            'totalPages' => ceil($total / 10),
        ]);
    }
}
