<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\RFQ;

class ViewRFQ extends Component
{
    public $rfq;

    public function mount($id)
    {
        $buyerId = session('buyer_id');

        if (!$buyerId) {
            return redirect()->route('buyer.login');
        }

        $this->rfq = RFQ::with('product', 'supplier')
            ->where('buyer_id', $buyerId)
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.front.view-rfq');
    }
}