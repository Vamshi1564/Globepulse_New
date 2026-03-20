<?php

namespace App\Livewire\Seller;

use App\Models\ProductEnquiry;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class TotalEnquiries extends Component
{
    use WithPagination;

    public function render()
    {
        $supplierId = Session::get('id');

        $productInquiry = ProductEnquiry::with('customer')->where('supplier_id', $supplierId)->paginate(12);
        return view('livewire.seller.total-enquiries', compact('productInquiry'));
    }
}
