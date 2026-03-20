<?php
namespace App\Livewire\Seller;

use Livewire\Component; // ✅ ADD THIS
use App\Models\RFQ;

class RFQList extends Component
{
    public $rfqs;

    public function mount()
    {
        $sellerId = session('id'); // or auth()->id()

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