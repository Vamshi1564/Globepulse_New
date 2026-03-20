<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProCat extends Component
{
    use CustomerIdTrait;

    public $product_categories = [];
    public $name;
      public $selectedproductCatId= null;
    public $selectedProcatname = null; // Store the selected category
     public $showPopup = false;
    public $productCatId;
    public $clientId;
    public $isEdit = false;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchCategories();
    }


     public function showDeletePopup($productCatId, $Procatname)
    {
        $this->selectedproductCatId = $productCatId;
        $this->selectedProcatname = $Procatname;
        // $this->selectedProductimg = $proimg;
        $this->showPopup = true;
    }

    public function closePopup()
    {
        $this->showPopup = false;
        $this->selectedproductCatId = null;
        $this->selectedProcatname = null;
        // return redirect()->to(request()->header('Referer'));
    }
    public function fetchCategories()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.procat_list'), [
            'customer_id' => $this->clientId,
        ]);
        if ($response->successful()) {
            $responseData = $response->json();

            // Check if 'data' key exists in the response
            if (isset($responseData['data'])) {
                $this->product_categories = $responseData['data'];
            } else {
                // Handle the case where 'data' key is missing
                session()->flash('error', 'No categories found.');
            }
        } else {
            // Handle unsuccessful response
            session()->flash('error', 'Failed to fetch categories.');
        }

        // dd($this->product_categories);
    }


    public function AddCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);

        // $CustomerId = Session::get('id');

        $data = [
            'name' => $this->name,
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->productCatId : null,
        ];

        $response = Http::post(config('api.base_url') . config('api.procat_update'), $data);

        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Category updated successfully.' : 'Category saved successfully.');
            $this->reset();
            $this->fetchCategories();
        } else {
            session()->flash('error', 'Failed to save category.');
        }
        return redirect()->to(request()->header('Referer'));

    }

    public function editCatname($id)
    {
        $product_cat = collect($this->product_categories)->firstWhere('id', $id);

        $this->productCatId = $product_cat['id'];  // Set the ID
        $this->name = $product_cat['name'];   // Set the name

        // Set edit mode to true
        $this->isEdit = true;
    }

    public function DeleteCatname($id)
    {

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.procat_update'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Category Deleted successfully.');
            $this->fetchCategories();
        }
         $this->closePopup(); // Hide the popup after deletion
    }

    public function render()
    {
        return view('livewire.seller.pro-cat');
    }
}
