<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\RFQ;
use App\Models\Quotation;
use App\Mail\QuotationSentMail;
use Illuminate\Support\Facades\Mail;

class RFQQuote extends Component
{
    public $rfq;

    public $price;
    public $delivery_time;
    public $payment_terms;
    public $message;

    public function mount($id)
{
    $sellerUuid = session('seller_uuid');

   

    // 🔒 SECURITY: ensure seller owns this RFQ
    $this->rfq = RFQ::where('id', $id)
        ->where('supplier_uuid', $sellerUuid)
        ->firstOrFail();
}

    public function submitQuote()
{
    $this->validate([
        'price' => 'required|numeric|min:1',
        'message' => 'required|min:5',
    ]);

    $sellerUuid = session('seller_uuid');

    // ✅ CHECK FIRST
    $exists = Quotation::where('rfq_id', $this->rfq->id)
        ->where('supplier_uuid', $sellerUuid)
        ->exists();

    if ($exists) {
        session()->flash('error', 'You already submitted a quote.');
        return;
    }

    // ✅ CREATE
    $quotation = Quotation::create([
        'rfq_id' => $this->rfq->id,
        'supplier_uuid' => $sellerUuid,
        'buyer_uuid' => $this->rfq->buyer_uuid,
        'price' => $this->price,
        'delivery_time' => $this->delivery_time,
        'payment_terms' => $this->payment_terms,
        'message' => $this->message,
        'status' => 0,
    ]);

    // ✅ UPDATE RFQ STATUS
    $this->rfq->update([
        'status' => 'quoted'
    ]);

    // ✅ EMAIL
    $quotation->load(['buyer', 'rfq.product']);

    if ($quotation->buyer?->email) {
        Mail::to($quotation->buyer->email)
            ->send(new QuotationSentMail($quotation));
    }

    session()->flash('message', 'Quotation sent successfully!');

    return redirect()->route('seller.rfqs');
}

    public function render()
    {
        return view('livewire.seller.rfq-quote');
    }
    public function getPriceValProperty()
{
    return (float) ($this->price ?? 0);
}

public function getTotalProperty()
{
    return $this->priceVal * (float) ($this->rfq->quantity ?? 0);
}
}