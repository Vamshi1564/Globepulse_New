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
    $sellerUuid = session('seller_uuid'); // ✅ make sure this exists
    $buyerUuid = Session::get('buyer_uuid');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

  $this->quotations = Quotation::with(['rfq.product', 'buyer', 'supplier'])
        ->where(function ($query) use ($sellerUuid, $buyerUuid) {
            if ($sellerUuid && $buyerUuid) {
                $query->where('supplier_uuid', $sellerUuid)
                      ->orWhere('buyer_uuid', $buyerUuid);
            } elseif ($sellerUuid) {
                $query->where('supplier_uuid', $sellerUuid);
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