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
    $sellerId = session('seller_id'); // ✅ make sure this exists
    $buyerUuid = Session::get('buyer_uuid');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

  $this->quotations = Quotation::with(['rfq.product', 'buyer', 'supplier'])
        ->where(function ($query) use ($sellerId, $buyerUuid) {
            if ($sellerId && $buyerUuid) {
                $query->where('supplier_uuid', $sellerId)
                      ->orWhere('buyer_uuid', $buyerUuid);
            } elseif ($sellerId) {
                $query->where('supplier_uuid', $sellerId);
            } elseif ($buyerUuid) {
                $query->where('buyer_uuid', $buyerUuid);
            }
        })
        ->latest()
        ->get();
}

    public function render()
    {
        return view('livewire.front.quotations');
    }

    



}