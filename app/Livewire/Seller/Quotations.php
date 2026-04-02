<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Quotation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Quotations extends Component
{

    use WithPagination;

    public $statusFilter = '';
    public $search = '';
    public $sort = '';



    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'statusFilter' => ['except' => ''],
        'search' => ['except' => ''],
        'sort' => ['except' => ''],
    ];

    public $sellerId;
    public $buyerUuid;

    // ================= INIT =================
   public function mount()
{
    $this->sellerId = Session::get('seller_id');
    $this->buyerUuid = Session::get('buyer_uuid');

    $this->search = request('search', '');
    $this->statusFilter = request('statusFilter', ''); // FIXED
    $this->sort = request('sort', '');
}

    // ================= BASE QUERY =================
    private function baseQuery()
    {
        return Quotation::with(['rfq.product', 'buyer'])
            ->when($this->sellerId && $this->buyerUuid, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('supplier_uuid', $this->sellerId)
                        ->orWhere('buyer_uuid', $this->buyerUuid);
                });
            })
            ->when($this->sellerId && !$this->buyerUuid, function ($q) {
                $q->where('supplier_uuid', $this->sellerId);
            })
            ->when(!$this->sellerId && $this->buyerUuid, function ($q) {
                $q->where('buyer_uuid', $this->buyerUuid);
            });
    }

    // ================= APPLY FILTERS (REUSABLE) =================
    private function applyFilters($query)
    {
        return $query
            // STATUS
            ->when($this->statusFilter !== '', function ($q) {
                $q->where('status', (int)$this->statusFilter);
            })

            // SEARCH
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereHas('rfq.product', function ($q2) {
                        $q2->whereRaw("title COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$this->search}%"]);
                    })
                    ->orWhereHas('buyer', function ($q2) {
                        $q2->whereRaw("full_name COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$this->search}%"]);
                    });
                });
            })

            // SORT
            ->when($this->sort === 'price_low', function ($q) {
    $q->orderBy('price', 'asc');
})
->when($this->sort === 'price_high', function ($q) {
    $q->orderBy('price', 'desc');
})
->when($this->sort === 'latest', function ($q) {
    $q->latest();
})
->when(!$this->sort, function ($q) {
    $q->latest(); // default
});
    }

    // ================= DATA =================
   public function getQuotationsProperty()
    {
        return $this->applyFilters($this->baseQuery())
            ->paginate(8)
            ->withQueryString();
    }

    // ================= EXPORT =================
    public function exportCsv()
    {
        $fileName = "quotations.csv";

        // ✅ APPLY FILTERS HERE ALSO (FIXED BUG)
        $quotes = $this->applyFilters($this->baseQuery())->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($quotes) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Product', 'Buyer', 'Price', 'Quantity', 'Total', 'Status']);

            foreach ($quotes as $q) {
                fputcsv($file, [
                    $q->rfq->product->title ?? '',
                    $q->buyer->full_name ?? '',
                    $q->price,
                    $q->rfq->quantity,
                    $q->price * $q->rfq->quantity,
                    $q->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ================= STATS =================
    public function getStatsProperty()
    {
        $data = $this->baseQuery()->get();

        return [
            'total' => $data->count(),
            'pending' => $data->where('status', 0)->count(),
            'accepted' => $data->where('status', 1)->count(),
            'rejected' => $data->where('status', 2)->count(),
            'value' => $data
                ->where('status', 1)
                ->sum(fn($q) => $q->price * ($q->rfq->quantity ?? 0)),
        ];
    }

    // ================= RENDER =================
   public function render()
    {
        return view('livewire.seller.quotations', [
            'quotations' => $this->quotations,
            'stats' => $this->stats,
        ]);
    }
}