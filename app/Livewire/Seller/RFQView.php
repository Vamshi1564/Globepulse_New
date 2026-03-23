<?php
namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\RFQ;

class RFQView extends Component
{
    public $rfq;

   public function mount($id)
{
    $sellerUuid = session('seller_uuid');

    $this->rfq = RFQ::with(['product', 'buyer'])
        ->where('supplier_uuid', $sellerUuid)
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

    $sellerUuid = session('seller_uuid');

    $rfq = RFQ::where('supplier_uuid', $sellerUuid)
        ->findOrFail($this->rfq->id);

    $rfq->update([
        'status' => $status
    ]);

    return redirect()->route('seller.rfq.view', $rfq->id);
}
}