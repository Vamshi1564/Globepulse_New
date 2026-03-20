<?php

namespace App\Livewire\Seller;

use App\Models\HotDealModal;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Hotdealproductform extends Component
{

    use WithFileUploads;

    public $scrollToTop = false;

    public $description, $end_time, $seller_id;
    public $product_id = '';
    public $products = [];
    public $dealproducts = [];
    public $page = 1; // Current page for pagination
    public $perPage = 10;
    public $dealproductId;
    public $totalPages;
    public $totalSlides;
    public $isEditing = false;


    public function mount()
    {
        $sellerId = Session::get('id');
        $this->seller_id = $sellerId;
        $this->products = Product::where('customer_id', $this->seller_id)->get();
        $this->updateDealList();
    }


    // Use polling for auto-refresh every 5 seconds
    // public function autoRefresh()
    // {
    //     $this->updateDealList();
    // }

    public function clearStatus()
    {
        if (session()->has('message') || session()->has('error')) {
            session()->forget(['message', 'error']);
        }
    }


    public function updateDealList()
    {

        $query = HotDealModal::with('product')->where('seller_id', $this->seller_id)->where('deal_enddate', '>=', Carbon::now());

        $this->totalSlides = $query->count();
        $this->totalPages = ceil($this->totalSlides / $this->perPage);

        $this->dealproducts = $query
            ->orderBy('id', 'desc')
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function submit()
    {

        $this->validate([
            'product_id' => 'required',
            'description' => 'required',
            'end_time' => 'required'
        ], [
            'product_id.required'  => 'Select Product'
        ]);

        $product = Product::find($this->product_id);

        $endTime = Carbon::createFromFormat('Y-m-d\TH:i', $this->end_time)->format('Y-m-d H:i:s');

        HotDealModal::create([
            'product_id' => $this->product_id,
            'seller_id' => $product->customer_id,
            'description' => $this->description,
            'deal_enddate' => $endTime,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session()->flash('message', 'Deal uploaded successfully!');
        $this->reset(['product_id', 'description', 'end_time']);
        $this->updateDealList();
    }

    public function editSlide($id)
    {
        $dealproduct = HotDealModal::findOrFail($id);
        $this->dealproductId = $dealproduct->id;
        $this->product_id = $dealproduct->product_id;
        $this->description = $dealproduct->description;
        $this->end_time = $dealproduct->deal_enddate;
        $this->isEditing = true;

        $this->scrollToTop = true;
    }

    public function updateData()
    {
        date_default_timezone_set('Asia/Kolkata');

        // $this->validate([
        //     'company_name' => 'required',
        //     'email' => 'required',
        //     'link' => 'nullable',
        // ] , [
        //     'procat_id.*' => 'Select Product Category'
        // ]);

        // if ($this->link && is_object($this->link)) {
        //     // Store new image and delete old one if it exists
        //     $imagePath = $this->link->store('uploads/link', 'public');
        //     if ($material->link && Storage::disk('public')->exists($material->link)) {
        //         Storage::disk('public')->delete($material->link);
        //     }
        //     $material->link = $imagePath;
        // }
        $dealproduct = HotDealModal::findOrFail($this->dealproductId);
        $dealproduct->update([
            'product_id' => $this->product_id,
            'description' => $this->description,
            'deal_enddate' => $this->end_time,
        ]);

        $this->reset(['product_id', 'description', 'end_time']);
        session()->flash('message', 'Deal Updated Successfully.');

        $this->isEditing = false;
        $this->updateDealList();
    }

    public function deleteDeal($id)
    {
        $dealproduct = HotDealModal::findOrFail($id);
        $dealproduct->delete();
        session()->flash('message', 'HotDeal Deleted Successfully!');
        $this->updateDealList();
    }

    public function render()
    {
        return view('livewire.seller.hotdealproductform', [
            'currentPage' => $this->page,
            'showPagination' => $this->totalSlides > 10
        ]);
    }
}
