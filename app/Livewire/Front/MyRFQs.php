<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\RFQ;
use Livewire\WithPagination;

class MyRFQs extends Component
{
    // public $rfqs = [];
    protected $listeners = ['deleteRFQEvent' => 'deleteRFQ']; // 🔥 ADD THIS
    

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
    $buyerUuid = session('buyer_uuid') ?? session('buyer_id');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

    $search = request()->get('search');

    $rfqs = \App\Models\RFQ::with('product')
        ->where('buyer_uuid', $buyerUuid)
        ->when($search, function ($query) use ($search) {

    $query->where(function ($q) use ($search) {

        // 🔍 RFQ fields
        $q->where('quantity', 'like', "%$search%")
          ->orWhere('target_price', 'like', "%$search%")
          ->orWhere('delivery_time', 'like', "%$search%")
          ->orWhere('shipping_terms', 'like', "%$search%")
          ->orWhere('destination_port', 'like', "%$search%")
          ->orWhere('payment_terms', 'like', "%$search%")
          ->orWhere('message', 'like', "%$search%")
          ->orWhere('company_name', 'like', "%$search%")
          ->orWhere('name', 'like', "%$search%");

        // 🔍 Product search
        $q->orWhereHas('product', function ($p) use ($search) {
            $p->where('title', 'like', "%$search%");
        });

    });

})
        ->latest()
        ->paginate(10)
        ->withQueryString(); // 🔥 IMPORTANT (keeps search in pagination)

    return view('livewire.front.buyer-rfqs', compact('rfqs'));
}

}