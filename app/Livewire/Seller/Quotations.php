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
    $sellerUuid = Session::get('seller_uuid');
    $buyerUuid  = Session::get('buyer_uuid');

    $this->quotations = Quotation::with(['rfq.product', 'buyer'])
        ->where(function ($query) use ($sellerUuid, $buyerUuid) {

            if ($sellerUuid && $buyerUuid) {
                $query->where('supplier_uuid', $sellerUuid)
                      ->orWhere('buyer_uuid', $buyerUuid);
            } elseif ($sellerUuid) {
                $query->where('supplier_uuid', $sellerUuid);
            } elseif ($buyerUuid) {
                $query->where('buyer_uuid', $buyerUuid);
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