<?php
// FILE: app/Livewire/Seller/MyListings.php

namespace App\Livewire\Seller;

use App\Models\PackagesModel;
use App\Models\Product;
use App\Models\Productgallery;
use App\Models\Seller;
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

    // ── Plan usage — passed to blade so Publish button can be disabled ──
    // Computed once per render() call via resolvePackageLimits().
    public int    $planProductLimit  = 0;   // 0 = unlimited
    public int    $planProductUsed   = 0;
    public int    $planServiceLimit  = 0;   // 0 = unlimited
    public int    $planServiceUsed   = 0;
    public string $planName          = '';

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
        $this->loadCounts();
    }

    // ── Resolve customer ID (same logic as ServiceAdd) ────────
    private function getCustomerId(): mixed
    {
        return Session::get('id')
            ?? Session::get('customer_id')
            ?? Session::get('user_id')
            ?? (auth()->check() ? auth()->id() : null);
    }

    // ── Resolve package product + service limits ─────────────
    // Same logic as ProductAdd::resolvePackageLimits().
    // Returns product limit, service limit, and current usage counts.
    //
    // ⚠️  Adjust column names if your schema differs:
    //   product_limit / service_limit / name / package_name
    private function resolvePackageLimits(): array
    {
        $cid      = $this->getCustomerId();
        $sellerId = Session::get('seller_id');

        $productLimit = 0;
        $serviceLimit = 0;
        $packageName  = 'Standard';

        if ($sellerId) {
            $seller  = Seller::find($sellerId);
            $package = ($seller && $seller->package_id)
                ? PackagesModel::find($seller->package_id)
                : null;

            if ($package) {
                $packageName  = $package->name ?? $package->package_name ?? 'Your Plan';
                $rawProd      = $package->product_limit ?? null;
                $productLimit = ($rawProd !== null && (int) $rawProd > 0) ? (int) $rawProd : 0;
                $rawSvc       = $package->service_limit ?? null;
                $serviceLimit = ($rawSvc  !== null && (int) $rawSvc  > 0) ? (int) $rawSvc  : 0;
            }
        } else {
            // Legacy: limit stored directly on customer row
            $customer = $cid ? \App\Models\Customer::find($cid) : null;
            if ($customer) {
                $rawProd      = $customer->product_upload_limit ?? null;
                $productLimit = ($rawProd !== null && (int) $rawProd > 0) ? (int) $rawProd : 0;
            }
        }

        // Current active product count (exclude drafts, status != 3)
        $productUsed = Product::where('customer_id', $cid)
                              ->where('status', '!=', 3)
                              ->count();

        // Current service count
        $serviceUsed = 0;
        try {
            if ($this->servicesTableExists() && class_exists(\App\Models\SellerService::class)) {
                $serviceUsed = \App\Models\SellerService::where('customer_id', $cid)
                                                           ->where('status', '!=', 'draft')
                                                           ->count();
            }
        } catch (\Throwable $e) {
            $serviceUsed = 0;
        }

        return compact('packageName', 'productLimit', 'serviceLimit', 'productUsed', 'serviceUsed');
    }

    // ── Check seller_services table exists ────────────────────
    private function servicesTableExists(): bool
    {
        try {
            return Schema::hasTable('seller_services');
        } catch (\Exception $e) {
            return false;
        }
    }

    // ── Format service price safely — works with Eloquent model OR stdClass ──
    private function formatServicePrice($s): string
    {
        $minPrice    = is_object($s) ? ($s->min_price    ?? null) : null;
        $priceUnit   = is_object($s) ? ($s->price_unit   ?? null) : null;
        $pricingType = is_object($s) ? ($s->pricing_type ?? null) : null;

        if ($minPrice && $priceUnit) {
            return '₹' . number_format($minPrice) . ' / ' . $priceUnit;
        }
        if ($minPrice) {
            return '₹' . number_format($minPrice);
        }
        if ($pricingType === 'quote_based') {
            return 'Get Quote';
        }
        return '—';
    }

    private function loadCounts(): void
    {
        $cid = $this->getCustomerId();

        // ── Product counts ────────────────────────────────────
        $pTotal    = Product::where('customer_id', $cid)->count();
        $pPending  = Product::where('customer_id', $cid)->where('status', 0)->count();
        $pApproved = Product::where('customer_id', $cid)->where('status', 1)->count();
        $pRejected = Product::where('customer_id', $cid)->where('status', 2)->count();
        $pDraft    = Product::where('customer_id', $cid)->where('status', 3)->count();

        // ── Service counts ────────────────────────────────────
        $sTotal = $sPending = $sApproved = $sRejected = 0;
        if ($this->servicesTableExists()) {
            try {
                // FIXED: always use customer_id (same key used in ServiceAdd)
                $sTotal    = \App\Models\SellerService::where('customer_id', $cid)->count();
                $sPending  = \App\Models\SellerService::where('customer_id', $cid)->where('status', 'pending')->count();
                $sApproved = \App\Models\SellerService::where('customer_id', $cid)->where('status', 'approved')->count();
                $sRejected = \App\Models\SellerService::where('customer_id', $cid)->where('status', 'rejected')->count();
            } catch (\Exception $e) {
                Log::warning('[MyListings] service count failed: ' . $e->getMessage());
            }
        }

        $this->counts = [
            'all'        => $pTotal + $sTotal,
            'products'   => $pTotal,
            'services'   => $sTotal,
            'p_pending'  => $pPending,
            'p_approved' => $pApproved,
            'p_rejected' => $pRejected,
            'p_draft'    => $pDraft,
            's_pending'  => $sPending,
            's_approved' => $sApproved,
            's_rejected' => $sRejected,
        ];
    }

    public function publishProduct(int $id): void
    {
        $cid     = $this->getCustomerId();
        $product = Product::where('id', $id)->where('customer_id', $cid)->first();
        if (!$product) return;

        // ── Package limit check ───────────────────────────────
        // A draft has status=3 and is NOT counted in the active product
        // count. Publishing moves it to status=0 (pending review), which
        // WILL count against the limit. So we check before publishing.
        // Resubmitting a rejected product (status=2) already counts, so
        // we only block when going from draft (status=3).
        if ((int) $product->status === 3) {
            $limits = $this->resolvePackageLimits();

            if ($limits['productLimit'] > 0 && $limits['productUsed'] >= $limits['productLimit']) {
                session()->flash('error',
                    '🚫 Cannot publish — your "' . $limits['packageName'] . '" plan allows '
                    . $limits['productLimit'] . ' product(s) and you have already used '
                    . $limits['productUsed'] . '. Please upgrade your plan or delete an '
                    . 'existing listing before publishing this draft.'
                );
                return;
            }
        }

        $product->update(['status' => 0]);
        $this->loadCounts();
        session()->flash('message', '✅ Product submitted for review! Goes live once approved.');
    }

    public function publishService(int $id): void
    {
        if (!$this->servicesTableExists()) return;

        $cid     = $this->getCustomerId();
        $service = \App\Models\SellerService::where('id', $id)
                        ->where('customer_id', $cid)
                        ->first();
        if (!$service) return;

        // Only draft→pending consumes a new slot.
        // Rejected services already occupy a slot, so resubmit is never blocked.
        if ($service->status === 'draft') {
            $limits = $this->resolvePackageLimits();

            if ($limits['serviceLimit'] > 0 && $limits['serviceUsed'] >= $limits['serviceLimit']) {
                session()->flash('error',
                    '🚫 Cannot publish — your "' . $limits['packageName'] . '" plan allows '
                    . $limits['serviceLimit'] . ' service(s) and you have already used '
                    . $limits['serviceUsed'] . '. Please upgrade your plan or delete an '
                    . 'existing listing before publishing this draft.'
                );
                return;
            }
        }

        $service->update(['status' => 'pending']);
        $this->loadCounts();
        session()->flash('message', '✅ Service submitted for review! Goes live once approved.');
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
        if (!$this->servicesTableExists()) return;
        try {
            $cid = $this->getCustomerId();
            \App\Models\SellerService::where('id', $id)
                ->where('customer_id', $cid)
                ->delete();
            $this->loadCounts();
            session()->flash('message', 'Service deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Could not delete service: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cid = $this->getCustomerId();

        // ── Products ──────────────────────────────────────────
        $products = collect();
        if (in_array($this->activeTab, ['all', 'products'])) {
            $products = collect(Product::where('customer_id', $cid)
                ->when($this->search, fn($q) =>
                    $q->where('title', 'like', "%{$this->search}%")
                )
                ->when($this->statusFilter !== 'all', fn($q) =>
                    $q->where('status', match($this->statusFilter) {
                        'approved' => 1,
                        'rejected' => 2,
                        'draft'    => 3,
                        default    => 0,
                    })
                )
                ->orderByDesc('created_at')
                ->get()
                ->map(fn($p) => [
                    'id'            => $p->id,
                    'type'          => 'product',
                    'title'         => $p->title,
                    'brand_name'    => $p->brand_name ?? '',
                    'description'   => $p->description ?? '',
                    'image'         => $p->product_img,
                    'status'        => match((int)$p->status) {
                        1           => 'approved',
                        2           => 'rejected',
                        3           => 'draft',
                        default     => 'pending',
                    },
                    'price'         => $p->min_price
                                        ? '₹' . number_format($p->min_price) . ' – ₹' . number_format($p->max_price ?? $p->min_price) . ($p->unit ? ' / ' . $p->unit : '')
                                        : '—',
                    'meta'          => 'MOQ: ' . ($p->min_order ?? '—'),
                    'keywords'      => $p->keywords ?? '',
                    'certifications'=> $p->certifications ?? '',
                    'lead_time'     => $p->lead_time ?? '',
                    'supply_ability'=> $p->supply_ability ?? '',
                    'country_of_origin' => $p->country_of_origin ?? '',
                    'rejection_reason'  => $p->rejection_reason ?? '',
                    'edit_route'    => route('product_add') . '?edit=' . $p->id,
                    'created_at'    => $p->created_at,
                ]));
        }

        // ── Services ──────────────────────────────────────────
        $services = collect();
        if ($this->servicesTableExists() && in_array($this->activeTab, ['all', 'services'])) {
            try {
                $services = collect(\App\Models\SellerService::where('customer_id', $cid)
                    ->when($this->search, fn($q) =>
                        $q->where('title', 'like', "%{$this->search}%")
                          ->orWhere('service_type', 'like', "%{$this->search}%")
                    )
                    ->when($this->statusFilter !== 'all', fn($q) =>
                        $q->where('status', $this->statusFilter)
                    )
                    ->orderByDesc('created_at')
                    ->get()
                    ->map(fn($s) => [
                        'id'            => $s->id,
                        'type'          => 'service',
                        'title'         => $s->title,
                        'brand_name'    => '',
                        'description'   => $s->description ?? '',
                        'image'         => $s->cover_image,
                        'status'        => $s->status ?? 'pending',
                        'price'         => $this->formatServicePrice($s),
                        'meta'          => trim(($s->service_type ?? '') . ($s->delivery_mode ? ' · ' . $s->delivery_mode : '')),
                        'keywords'      => $s->keywords ?? '',
                        'certifications'=> $s->certifications ?? '',
                        'lead_time'     => $s->turnaround_time ?? '',
                        'supply_ability'=> $s->service_area ?? '',
                        'country_of_origin' => '',
                        'rejection_reason'  => $s->rejection_reason ?? '',
                        'edit_route'    => route('service_add') . '?edit=' . $s->id,
                        'created_at'    => $s->created_at,
                    ]));
            } catch (\Exception $e) {
                Log::error('[MyListings] SellerService query failed: ' . $e->getMessage());
            }
        }

        // ── Merge & paginate ──────────────────────────────────
        // CRITICAL: wrap in collect() (base Collection) before merge.
        // Product::get()->map() returns an Eloquent Collection whose merge()
        // calls getKey() on each item — which fails on plain arrays.
        // collect() converts to a base Illuminate\Support\Collection
        // whose merge() works correctly with plain arrays.
        $merged = collect($products)->merge(collect($services))
            ->sortByDesc('created_at')
            ->values();

        $page      = $this->getPage();
        $total     = $merged->count();
        $paginated = $merged->forPage($page, $this->perPage);

        $listings = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginated, $total, $this->perPage, $page,
            [
                'path'     => request()->url(),
                'query'    => request()->query(),
                'pageName' => 'page',
            ]
        );

        // Resolve plan limits once per render so the blade can
        // disable the Publish button when the product limit is hit.
        $limits = $this->resolvePackageLimits();
        $this->planProductLimit = $limits['productLimit'];
        $this->planProductUsed  = $limits['productUsed'];
        $this->planName         = $limits['packageName'];

        $this->planServiceLimit = $limits['serviceLimit'];
        $this->planServiceUsed  = $limits['serviceUsed'];

        $planAtProductLimit = $limits['productLimit'] > 0
                           && $limits['productUsed'] >= $limits['productLimit'];

        $planAtServiceLimit = $limits['serviceLimit'] > 0
                           && $limits['serviceUsed'] >= $limits['serviceLimit'];

        return view('livewire.seller.my-listings', compact('listings', 'planAtProductLimit', 'planAtServiceLimit'));
    }
}