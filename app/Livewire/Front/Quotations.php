<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Quotation;
use Illuminate\Support\Facades\Session;


class Quotations extends Component
{
    public $quotations = [];

   public function mount()
{
    $buyerUuid = Session::get('buyer_uuid');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

    $this->quotations = Quotation::with(['rfq.product', 'supplier'])
        ->where('buyer_uuid', $buyerUuid)
        ->latest()
        ->get();
}

    public function render()
    {
        return view('livewire.front.quotations');
    }

    

public function accept($id)
{
    Quotation::where('id', $id)->update(['status' => 1]);

    $this->mount(); // refresh
}

public function reject($id)
{
    Quotation::where('id', $id)->update(['status' => 2]);

    $this->mount();
}

}