<?php
namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Quotation;
use Illuminate\Support\Facades\Session;


class Quotations extends Component
{
//     public $quotations = [];

//    public function mount()
// {
//     $sellerId = session('seller_id'); // ✅ make sure this exists
//     $buyerUuid = Session::get('buyer_uuid');

//     if (!$buyerUuid) {
//         abort(403, 'Buyer not logged in');
//     }

//   $this->quotations = Quotation::with(['rfq.product', 'buyer', 'supplier'])
//         ->where(function ($query) use ($sellerId, $buyerUuid) {
//             if ($sellerId && $buyerUuid) {
//                 $query->where('supplier_uuid', $sellerId)
//                       ->orWhere('buyer_uuid', $buyerUuid);
//             } elseif ($sellerId) {
//                 $query->where('supplier_uuid', $sellerId);
//             } elseif ($buyerUuid) {
//                 $query->where('buyer_uuid', $buyerUuid);
//             }
//         })
//         ->latest()
//         ->get();
// }

public function render()
{
    $buyerUuid = session('buyer_uuid');

    if (!$buyerUuid) {
        abort(403, 'Buyer not logged in');
    }

    $search = request('search');

    $quotations = \App\Models\Quotation::with(['rfq.product', 'buyer', 'supplier'])
        ->where('buyer_uuid', $buyerUuid)
       ->when($search, function ($q) use ($search) {

    $q->where(function ($query) use ($search) {

        // 🔍 Search in quotation fields
        $query->where('price', 'like', "%$search%")
              ->orWhere('delivery_time', 'like', "%$search%")
              ->orWhere('payment_terms', 'like', "%$search%")
              ->orWhere('message', 'like', "%$search%");

        // 🔍 Search in product
        $query->orWhereHas('rfq.product', function ($q2) use ($search) {
            $q2->where('title', 'like', "%$search%");
        });

        // 🔍 Search in supplier
        $query->orWhereHas('supplier', function ($q3) use ($search) {
            $q3->where('legal_business_name', 'like', "%$search%");
        });

        // 🔍 Search in buyer
        $query->orWhereHas('buyer', function ($q4) use ($search) {
            $q4->where('full_name', 'like', "%$search%");
        });

    });

})
        ->latest()
        ->paginate(5) // ✅ MUST
        ->withQueryString();

    return view('livewire.front.quotations', compact('quotations'));
}

    



}