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
            'price' => 'required',
            'message' => 'required|min:5',
        ]);

        $quotation = Quotation::create([
            'rfq_id' => $this->rfq->id,
            'supplier_uuid' => session('seller_uuid'),
            'buyer_uuid'    => $this->rfq->buyer_uuid,
            'price' => $this->price,
            'delivery_time' => $this->delivery_time,
            'payment_terms' => $this->payment_terms,
            'message' => $this->message,
            'status' => 0,
        ]);

        // ✅ Load relations for email
        $quotation->load(['buyer', 'rfq.product']);

        // ✅ SEND EMAIL
        if ($quotation->buyer && $quotation->buyer->email) {
            Mail::to($quotation->buyer->email)
                ->send(new QuotationSentMail($quotation));
        }

        // update RFQ status → quoted
        if ($this->rfq->status === 'quoted') {
            session()->flash('error', 'Quote already submitted');
            return;
        }

        session()->flash('message', 'Quotation sent successfully!');

        return redirect()->route('seller.rfqs');
    }

    public function render()
    {
        return view('livewire.seller.rfq-quote');
    }
}