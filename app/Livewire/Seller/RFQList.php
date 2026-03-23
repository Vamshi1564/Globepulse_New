<?php
namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\RFQ;

class RFQList extends Component
{
    public $rfqs = [];

    public function mount()
    {
        $sellerUuid = session('seller_uuid');

        

        $this->rfqs = RFQ::with(['product', 'buyer'])
            ->where('supplier_uuid', $sellerUuid)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.rfq-list');
    }
}