<?php
// FILE: app/Livewire/Seller/SellerDashboard.php
// UPDATED: Now reads from seller session (seller_id) set by new SellerLogin.php
// instead of old customer session ('id') + Customer model

namespace App\Livewire\Seller;

use App\Models\Seller;
use App\Models\DashboardItemAccessModel;
use App\Models\SellerDashboardItemModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\RFQ;

class SellerDashboard extends Component
{
    public function render()
    {
        // ─── NEW: read seller_id from new session (set by SellerLogin.php) ───
        $sellerId = Session::get('seller_id');
        $seller   = Seller::find($sellerId);

        // Read package_id directly from sellers table (stored during profile Step 5)
        $PackageId = $seller?->package_id ?? null;

        // ─── Rest of logic unchanged from original ───

        // Get all allowed dashboard item IDs for that package
        $allowedItemIds = DashboardItemAccessModel::where('product_id', $PackageId)
            ->pluck('dashboard_items_id')
            ->toArray();

        // Fetch only those dashboard items
        $dashboardItems = SellerDashboardItemModel::whereIn('id', $allowedItemIds)->get();

        $procatMapping = [
            'reference-materials' => 1,
            'product-reports'     => 2,
            'create-trade'        => 3,
            'shipment-list'       => 4,
            'action-plan'         => 5,
            'templates'           => 6,
            'lois'                => 7,
            'pos'                 => 8,
        ];

        foreach ($dashboardItems as $item) {
            if (isset($procatMapping[$item->route])) {
                $item->fullRoute = route($item->route, ['procatId' => $procatMapping[$item->route]]);
            } else {
                $item->fullRoute = Str::startsWith($item->route, ['http://', 'https://'])
                    ? $item->route
                    : route($item->route);
            }
        }

        return view('livewire.seller.seller-dashboard', compact('PackageId', 'dashboardItems', 'seller'));
    }

    public $rfqs;

public function mount()
{
    $sellerId = session('seller_id');

    $this->rfqs = RFQ::with('product')
        ->where('supplier_id', $sellerId)
        ->latest()
        ->take(10) // optional
        ->get();
}
}