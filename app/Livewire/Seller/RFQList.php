<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RFQ;

class RFQList extends Component
{
    use WithPagination;

    public $search = ''; // ✅ ADD THIS

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        $sellerId = session('seller_id');

        if (!$sellerId) {
            abort(403, 'Seller not logged in');
        }

        $search = request()->get('search');

        $rfqs = RFQ::with(['product', 'buyer'])
            ->where('supplier_uuid', $sellerId)

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    // 🔍 RFQ fields
                    $q->where('quantity', 'like', "%$search%")
                      ->orWhere('target_price', 'like', "%$search%")
                      ->orWhere('delivery_time', 'like', "%$search%")
                      ->orWhere('payment_terms', 'like', "%$search%");

                    // 🔍 Product
                    $q->orWhereHas('product', function ($p) use ($search) {
                        $p->where('title', 'like', "%$search%");
                    });

                    // 🔍 Buyer
                    $q->orWhereHas('buyer', function ($b) use ($search) {
                        $b->where('full_name', 'like', "%$search%");
                    });

                });

            })

            ->latest()
            ->paginate(10)
            ->withQueryString(); // ✅ SAME AS BUYER

        return view('livewire.seller.rfq-list', compact('rfqs'));
    }
}