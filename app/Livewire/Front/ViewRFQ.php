<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\RFQ;
use App\Models\Quotation;

class ViewRFQ extends Component
{
    public $rfq;

    public function mount($id)
{
    $buyerUuid = session('buyer_uuid') ?? session('buyer_id');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

   $this->rfq = RFQ::with([
    'product',
    'supplier',        // seller_details
    'sellerAccount',   // sellers table
    'quotations'
])
->where('buyer_uuid', $buyerUuid)
->where('id', $id)
->firstOrFail();
}

    public function render()
    {
        return view('livewire.front.view-rfq');
    }
// ✅ ACCEPT QUOTE (SECURE)
    public function acceptQuote($id)
{
    $buyerUuid = session('buyer_uuid') ?? session('buyer_id');

    $quote = Quotation::where('id', $id)
        ->where('buyer_uuid', $buyerUuid)
        ->firstOrFail();

    $quote->update([
        'status' => 1 // accepted
    ]);

    // ✅ close RFQ
    $quote->rfq->update([
        'status' => 'accepted' // use ENUM value (important)
    ]);

    // ✅ refresh UI
    $this->rfq = $this->rfq->fresh();

    session()->flash('message', 'Quotation accepted!');
}

    // ✅ REJECT QUOTE (SECURE)
    public function rejectQuote($id)
{
    $buyerUuid = session('buyer_uuid') ?? session('buyer_id');

    $quote = Quotation::where('id', $id)
        ->where('buyer_uuid', $buyerUuid)
        ->firstOrFail();

    $quote->update([
        'status' => 2 // rejected
    ]);

    // ✅ refresh UI
    $this->rfq = $this->rfq->fresh();

    session()->flash('message', 'Quotation rejected!');
}
    
}