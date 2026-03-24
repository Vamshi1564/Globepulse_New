<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\RFQ;

class MyRFQs extends Component
{
    public $rfqs = [];

    public function mount()
{
    $buyerUuid = session('buyer_uuid') ?? session('buyer_id');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

    $this->rfqs = RFQ::with('product')
        ->where('buyer_uuid', $buyerUuid)
        ->latest()
        ->get();
}

    public function render()
    {
        return view('livewire.front.buyer-rfqs');
    }
}