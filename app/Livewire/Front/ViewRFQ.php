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



public function acceptQuote($id)
{
    $quote = Quotation::find($id);
    $quote->update(['status' => 1]);

    // close RFQ
    $quote->rfq->update(['status' => 2]);

    session()->flash('message', 'Quotation accepted!');
}

public function rejectQuote($id)
{
    Quotation::find($id)->update(['status' => 2]);

    session()->flash('message', 'Quotation rejected!');
}
}