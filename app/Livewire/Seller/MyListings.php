<?php
// FILE: app/Livewire/Seller/MyListings.php
// FIXED:
//  1. seller_services table may not exist yet — wrapped in try/catch
//  2. Products use Session::get('id') which may be UUID or int — handle both
//  3. Services use seller_id (UUID from globpulse sellers table)
//  4. Graceful fallback if SellerService table missing

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Productgallery;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class MyListings extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $activeTab    = 'all';
    public string $statusFilter = 'all';
    public string $search       = '';
    public int    $perPage      = 15;
    public array  $counts       = [];
    public bool   $servicesEnabled = false; // true once seller_services table exists

    protected $queryString = [
        'activeTab'    => ['except' => 'all'],
        'statusFilter' => ['except' => 'all'],
        'search'       => ['except' => ''],
    ];

    public function updatedActiveTab()    { $this->resetPage(); $this->statusFilter = 'all'; }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedSearch()       { $this->resetPage(); }

    public function mount(): void
    {
        // Check if seller_services table exists
        try {
            $this->servicesEnabled = Schema::hasTable('seller_services');
        } catch (\Exception $e) {
            $this->servicesEnabled = false;
        }
        $this->loadCounts();
    }

    // ── Get correct customer_id for product queries ───────────
    // Products table uses GFE integer customer_id
    // Session 'id' stores this integer (set during SellerLogin for backward compat)
    private function getCustomerId(): mixed
    {
        return Session::get('id'); // integer GFE customer_id
    }

    // ── Get seller UUID for services ──────────────────────────
    private function getSellerId(): ?string
    {
        return Session::get('seller_id'); // UUID from sellers table
    }

    private function loadCounts(): void
    {
        $cid = $this->getCustomerId();

        // Product counts
        $pTotal    = Product::where('customer_id', $cid)->count();
        $pPending  = Product::where('customer_id', $cid)->where('status', 0)->count();
        $pApproved = Product::where('customer_id', $cid)->where('status', 1)->count();
        $pRejected = Product::where('customer_id', $cid)->where('status', 2)->count();

        // Service counts (only if table exists)
        $sTotal = $sPending = $sApproved = $sRejected = 0;
        if ($this->servicesEnabled) {
            try {
                $sid       = $this->getSellerId() ?? $cid;
                $sTotal    = \App\Models\SellerService::where('customer_id', $sid)->count();
                $sPending  = \App\Models\SellerService::where('customer_id', $sid)->where('status', 'pending')->count();
                $sApproved = \App\Models\SellerService::where('customer_id', $sid)->where('status', 'approved')->count();
                $sRejected = \App\Models\SellerService::where('customer_id', $sid)->where('status', 'rejected')->count();
            } catch (\Exception $e) {
                $this->servicesEnabled = false;
            }
        }

        $this->counts = [
            'all'        => $pTotal + $sTotal,
            'products'   => $pTotal,
            'services'   => $sTotal,
            'p_pending'  => $pPending,
            'p_approved' => $pApproved,
            'p_rejected' => $pRejected,
            's_pending'  => $sPending,
            's_approved' => $sApproved,
            's_rejected' => $sRejected,
        ];
    }

    public function deleteProduct(int $id): void
    {
        $cid     = $this->getCustomerId();
        $product = Product::where('id', $id)->where('customer_id', $cid)->first();
        if ($product) {
            Productgallery::where('product_id', $id)->each(function ($img) {
                Storage::delete('public/' . $img->gallery_images);
                $img->delete();
            });
            $product->delete();
            $this->loadCounts();
            session()->flash('message', 'Product deleted successfully.');
        }
    }

    public function deleteService(int $id): void
    {
        if (!$this->servicesEnabled) return;
        try {
            $sid = $this->getSellerId() ?? $this->getCustomerId();
            \App\Models\SellerService::where('id', $id)->where('customer_id', $sid)->delete();
            $this->loadCounts();
            session()->flash('message', 'Service deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Could not delete service.');
        }
    }


    public function publishProduct(int $id): void
    {
        $cid     = $this->getCustomerId();
        $product = \App\Models\Product::where('id', $id)->where('customer_id', $cid)->first();
        if ($product) {
            $product->update(['status' => 0]); // 0 = pending admin review
            $this->loadCounts();
            session()->flash('message', 'Product submitted for admin review!');
        }
    }

    public function render()
    {
        $cid = $this->getCustomerId();
        $sid = $this->getSellerId() ?? $cid;

        // ── Products ──────────────────────────────────────────
        $products = collect();
        if (in_array($this->activeTab, ['all', 'products'])) {
            $products = Product::with('country')
                ->where('customer_id', $cid)
                ->when($this->search, fn($q) =>
                    $q->where('title', 'like', "%{$this->search}%")
                )
                ->when($this->statusFilter !== 'all', fn($q) =>
                    $q->where('status', match($this->statusFilter) {
                        'approved' => 1,
                        'rejected' => 2,
                        default    => 0,
                    })
                )
                ->orderByDesc('created_at')
                ->get()
                ->map(fn($p) => (object)[
                    'id'         => $p->id,
                    'type'       => 'product',
                    'title'      => $p->title,
                    'image'      => $p->product_img,
                    'status'     => match((int)$p->status) {
                        1        => 'approved',
                        2        => 'rejected',
                        default  => 'pending'
                    },
                    'price'      => '₹' . number_format($p->min_price ?? 0)
                                  . ' – ₹' . number_format($p->max_price ?? 0),
                    'meta'       => 'MOQ: ' . ($p->min_order ?? '—'),
                    'edit_route'   => route('seller-product-edit', $p->id),
                    'created_at' => $p->created_at,
                ]);
        }

        // ── Services ──────────────────────────────────────────
        $services = collect();
        if ($this->servicesEnabled && in_array($this->activeTab, ['all', 'services'])) {
            try {
                $services = \App\Models\SellerService::where('customer_id', $sid)
                    ->when($this->search, fn($q) =>
                        $q->where('title', 'like', "%{$this->search}%")
                          ->orWhere('service_type', 'like', "%{$this->search}%")
                    )
                    ->when($this->statusFilter !== 'all', fn($q) =>
                        $q->where('status', $this->statusFilter)
                    )
                    ->orderByDesc('created_at')
                    ->get()
                    ->map(fn($s) => (object)[
                        'id'         => $s->id,
                        'type'       => 'service',
                        'title'      => $s->title,
                        'image'      => $s->cover_image,
                        'status'     => $s->status,
                        'price'      => $s->price_display,
                        'meta'       => $s->service_type
                                      . ($s->delivery_mode ? ' · ' . $s->delivery_mode : ''),
                        'edit_route'   => route('service_add') . '?edit=' . $s->id,
                        'created_at' => $s->created_at,
                    ]);
            } catch (\Exception $e) {
                Log::warning('MyListings: SellerService query failed — ' . $e->getMessage());
                $this->servicesEnabled = false;
            }
        }

        // ── Merge + paginate ──────────────────────────────────
        $merged = $products->merge($services)
            ->sortByDesc('created_at')
            ->values();

        $page      = $this->getPage();
        $total     = $merged->count();
        $paginated = $merged->forPage($page, $this->perPage);

        $listings = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginated, $total, $this->perPage, $page,
            ['path' => request()->url()]
        );

        return view('livewire.seller.my-listings', compact('listings'));
    }
}