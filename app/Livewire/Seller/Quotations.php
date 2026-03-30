<?php

namespace App\Livewire\Seller;

use Livewire\Component;

use App\Models\Quotation;
use Illuminate\Support\Facades\Session;

class Quotations extends Component
{
   

    public $statusFilter = '';
    public $search = '';

    
    protected $queryString = [
    'statusFilter' => ['except' => ''],
    'search' => ['except' => ''],
];

    public $sellerId;
public $buyerUuid;

    // ================= INIT =================
    public function mount()
    {
        $this->sellerId = Session::get('seller_id');
        $this->buyerUuid = Session::get('buyer_uuid');
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


    // ================= PAGINATED DATA =================
public function getQuotationsProperty()
{
    $search = request('search');
    $status = request('status');

    return $this->baseQuery()
        ->when($status !== null && $status !== '', function ($q) use ($status) {
            $q->where('status', (int)$status);
        })
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->whereHas('rfq.product', function ($q2) use ($search) {
                    $q2->whereRaw("title COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$search}%"]);
                })
                ->orWhereHas('buyer', function ($q2) use ($search) {
                    $q2->whereRaw("full_name COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$search}%"]);
                });
            });
        })
        ->latest()
        ->get(); // ✅ REQUIRED (no pagination now)
}

    // ================= EXPORT FULL DATA =================
    public function exportCsv()
    {
        $fileName = "quotations.csv";

        // 🔥 IMPORTANT: use FULL data, not paginated
        $quotes = $this->baseQuery()->get();

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

    // ================= RENDER =================
    public function render()
    {
        return view('livewire.seller.quotations', [
            'quotations' => $this->quotations, // ✅ computed property
            'stats' => $this->stats, // ✅ ADD THIS
           
        ]);
    }
    public function getStatsProperty()
{
    $data = $this->baseQuery()->get();

    return [
        'total' => $data->count(),
        'pending' => $data->where('status', 0)->count(),
        'accepted' => $data->where('status', 1)->count(),
        'rejected' => $data->where('status', 2)->count(),
        'value' => $data->sum(fn($q) => $q->price * $q->rfq->quantity),
    ];
}

}