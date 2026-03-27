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
    $sellerIid = Session::get('seller_id');
    $buyerUuid  = Session::get('buyer_uuid');

    $this->quotations = Quotation::with(['rfq.product', 'buyer'])
        ->where(function ($query) use ($sellerIid, $buyerUuid) {

            if ($sellerIid && $buyerUuid) {
                $query->where('supplier_uuid', $sellerIid)
                      ->orWhere('buyer_uuid', $buyerUuid);
            } elseif ($sellerIid) {
                $query->where('supplier_uuid', $sellerIid);
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