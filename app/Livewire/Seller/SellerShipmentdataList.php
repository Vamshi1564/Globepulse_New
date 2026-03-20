<?php

// namespace App\Livewire\Seller;

// use App\Models\ShipmentDataModal;
// use Livewire\Component;

// class SellerShipmentdataList extends Component
// {

//     public $search = '';
//     public $perPage = 10;
//     public $currentPage = 1;
//     public $searchBy = 'hsncode'; // default option


//     public function searchHSN()
//     {
//         $this->currentPage = 1;
//     }
//     public function updatingSearch()
//     {
//         $this->currentPage = 1;
//     }

//     public function goToPage($page)
//     {
//         $totalPages = $this->getTotalPages();
//         if ($page >= 1 && $page <= $totalPages) {
//             $this->currentPage = $page;
//         }
//     }

//     public function nextPage()
//     {
//         $totalPages = $this->getTotalPages();
//         if ($this->currentPage < $totalPages) {
//             $this->currentPage++;
//         }
//     }

//     public function previousPage()
//     {
//         if ($this->currentPage > 1) {
//             $this->currentPage--;
//         }
//     }
//     private function getTotalPages()
// {
//     $totalCount = ShipmentDataModal::where($this->searchBy, 'LIKE', '%' . $this->search . '%')->count();
//     return (int) ceil($totalCount / $this->perPage);
// }




//     public function render()
//     {
//         $offset = ($this->currentPage - 1) * $this->perPage;

//         $shipments = ShipmentDataModal::where($this->searchBy, 'LIKE', '%' . $this->search . '%')
//         ->skip($offset)
//         ->take($this->perPage)
//         ->get();

//             $totalShipments = ShipmentDataModal::where($this->searchBy, 'LIKE', '%' . $this->search . '%')->count();

//         $totalPages = $this->getTotalPages();

//         return view('livewire.seller.seller-shipmentdata-list', [
//             'shipmentData' => $shipments,
//             'totalShipments' => $totalShipments,
//             'totalPages' => $totalPages,
//             'perPage' => $this->perPage,
//             'currentPage' => $this->currentPage,
//         ]);
//     }
// }


namespace App\Livewire\Seller;

use App\Models\ShipmentDataModal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SellerShipmentdataList extends Component
{
    public $search = '';
    public $searchBy = 'hsncode'; // hsncode or product_description
    public $countryFilter = '';


    public function searchHSN()
    {
        if (!empty($this->search)) {
            return redirect()->route('search-shipmentdatalist', [
                'search' => $this->search,
                'searchBy' => $this->searchBy,
                'country'     => $this->countryFilter,
            ]);
        }
    }

    public function render()
    {
        $total = ShipmentDataModal::count();

        $shipmentCount = ShipmentDataModal::count();

        $countryStats = ShipmentDataModal::select('country_of_discharge', DB::raw('count(*) as total'))
            ->groupBy('country_of_discharge')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($total) {
                $item->percentage = $total > 0 ? round(($item->total / $total) * 100, 2) : 0;

                // Match country name with Country model using 'name' column
                $country = \App\Models\Country::whereRaw('LOWER(short_name) = ?', [strtolower($item->country_of_discharge)])
                    ->first();

                // Assign flag image URL
                $item->flag_img = $country->flag_img ?? null;

                return $item;
            });

        return view('livewire.seller.seller-shipmentdata-list', [
            'countryStats' => $countryStats,
            'shipmentCount' => $shipmentCount
        ]);
    }
}
