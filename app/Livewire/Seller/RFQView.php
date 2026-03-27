<?php
namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\RFQ;

class RFQView extends Component
{
    public $rfq;

   public function mount($id)
{
    $sellerId = session('seller_id');

    $this->rfq = RFQ::with(['product', 'buyer'])
        ->where('supplier_uuid', $sellerId)
        ->findOrFail($id);
}

    public function render()
    {
        return view('livewire.seller.rfq-view');
    }

public function updateStatusAndRedirect($status)
{
    if (!in_array($status, ['accepted', 'rejected'])) {
        return;
    }

    $sellerId = session('seller_id');

    $rfq = RFQ::where('supplier_uuid', $sellerId)
        ->findOrFail($this->rfq->id);

    $rfq->update([
        'status' => $status
    ]);

    return redirect()->route('seller.rfq.view', $rfq->id);
}
}