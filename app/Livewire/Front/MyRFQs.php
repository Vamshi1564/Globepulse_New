<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\RFQ;

class MyRFQs extends Component
{
    public $rfqs = [];

    public function mount()
    {
        $buyerId = session('buyer_id');

        if (!$buyerId) {
            return redirect()->route('buyer.login');
        }

        // 🔥 CORE LOGIC
        $this->rfqs = RFQ::with('product')
            ->where('buyer_id', $buyerId)
            ->latest()
            ->get();
    }

  public function render()
{
   return view('livewire.front.buyer-rfqs');
}
}