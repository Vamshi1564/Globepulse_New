<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\DashboardItemAccessModel;
use App\Models\ProductCategoryModal;
use App\Models\SellerDashboardItemModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class SellerDashboard extends Component
{
    public function render()
    {
        $customerId = Session::get('id'); // Get user ID from session
        $PackageId = Customer::where('id', $customerId)->value('package_id'); // only fetch package_id

        // $procatId1 = ProductCategoryModal::find(1); // Adjust the query as needed.
        // $procatId2 = ProductCategoryModal::find(2); // Adjust the query as needed.
        // $procatId3 = ProductCategoryModal::find(3); // Adjust the query as needed.
        // $procatId4 = ProductCategoryModal::find(4); // Adjust the query as needed.
        // $procatId5 = ProductCategoryModal::find(5); // Adjust the query as needed.
        // $procatId6 = ProductCategoryModal::find(6); // Adjust the query as needed.
        // $procatId7 = ProductCategoryModal::find(7); // Adjust the query as needed.
        // $procatId8 = ProductCategoryModal::find(8); // Adjust the query as needed.


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

        // $dynamicRoutes = [
        //     'latter-head-form'      => ['id' => $customerId],
        //     // 'some-other-route'      => ['customer_id' => Session::get('id')],
        //     // 'another-route-example' => ['user' => Session::get('id')],
        // ];

        foreach ($dashboardItems as $item) {
            // if (isset($dynamicRoutes[$item->route])) {
            //     // Use parameters from mapping
            //     $item->fullRoute = route($item->route, $dynamicRoutes[$item->route]);
            // } 
            if (isset($procatMapping[$item->route])) {
                $item->fullRoute = route($item->route, ['procatId' => $procatMapping[$item->route]]);
            } else {
                $item->fullRoute = Str::startsWith($item->route, ['http://', 'https://'])
                    ? $item->route
                    : route($item->route);
            }
        }

        return view('livewire.seller.seller-dashboard', compact('PackageId', 'dashboardItems'));
    }
}
