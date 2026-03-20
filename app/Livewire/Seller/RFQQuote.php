<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\RFQ;
use App\Models\Quotation;

class RFQQuote extends Component
{
    public $rfq;

    public $price;
    public $delivery_time;
    public $payment_terms;
    public $message;

    public function mount($id)
    {
        $this->rfq = RFQ::findOrFail($id);
    }

    public function submitQuote()
    {
        $this->validate([
            'price' => 'required',
            'message' => 'required|min:5',
        ]);

        Quotation::create([
            'rfq_id' => $this->rfq->id,
            'supplier_id' => session('id'),
            'buyer_id' => $this->rfq->buyer_id,

            'price' => $this->price,
            'delivery_time' => $this->delivery_time,
            'payment_terms' => $this->payment_terms,
            'message' => $this->message,
        ]);

        // update RFQ status → quoted
        $this->rfq->update(['status' => 1]);

        session()->flash('message', 'Quotation sent successfully!');

        return redirect()->route('seller.rfqs');
    }

    public function render()
    {
        return view('livewire.seller.rfq-quote');
    }
}