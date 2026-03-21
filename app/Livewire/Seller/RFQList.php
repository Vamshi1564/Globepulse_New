<?php
namespace App\Livewire\Seller;

use Livewire\Component; // ✅ ADD THIS
use App\Models\RFQ;

class RFQList extends Component
{
    public $rfqs;

public function mount()
{
    if (!session()->has('seller_id')) {
        return redirect()->route('seller.login');
    }

    $sellerId = trim(session('seller_id'));   // remove spaces
    $sellerId = (int) $sellerId;              // force int

    // 🔥 DEBUG
    // dd($sellerId);

    $this->rfqs = RFQ::with(['product', 'buyer'])
        ->where('supplier_id', $sellerId)
        ->latest()
        ->get();
}

    public function render()
    {
        return view('livewire.seller.rfq-list');
    }
}