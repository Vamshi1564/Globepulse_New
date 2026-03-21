<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Quotation;
use Illuminate\Support\Facades\Session;

class Quotations extends Component
{
    public $quotations = [];

public function mount()
{
    $sellerId = Session::get('seller_id'); // string
    $buyerId  = Session::get('buyer_id');

    $this->quotations = Quotation::with(['rfq.product', 'buyer'])
        ->where(function ($query) use ($sellerId, $buyerId) {
            $query->where('supplier_id', $sellerId);

            if ($buyerId) {
                $query->orWhere('buyer_id', $buyerId);
            }
        })
        ->latest()
        ->get();
}

    public function render()
    {
        return view('livewire.seller.quotations');
    }
}