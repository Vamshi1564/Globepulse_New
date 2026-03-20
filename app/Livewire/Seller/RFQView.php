<?php
namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\RFQ;

class RFQView extends Component
{
    public $rfq;

    public function mount($id)
    {
        $this->rfq = RFQ::with(['product', 'supplier'])
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.seller.rfq-view');
    }
}