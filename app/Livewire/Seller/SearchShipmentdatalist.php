<?php

// namespace App\Livewire\Seller;

// use App\Models\ShipmentDataModal;
// use Livewire\Component;

// class SearchShipmentdatalist extends Component
// {
//     public $search = '';
//     public $searchBy = 'hsncode';
//     public $perPage = 12;
//     public $currentPage = 1;

//     public function mount(): void
//     {
//         $this->search = request()->query('search', '');
//         $this->searchBy = request()->query('searchBy', 'hsncode');
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
//     {
//         $totalCount = ShipmentDataModal::where($this->searchBy, 'LIKE', '%' . $this->search . '%')->count();
//         return (int) ceil($totalCount / $this->perPage);
//     }

//     public function render()
//     {
//         $offset = ($this->currentPage - 1) * $this->perPage;

//         $shipments = ShipmentDataModal::where($this->searchBy, 'LIKE', '%' . $this->search . '%')
//             ->skip($offset)
//             ->take($this->perPage)
//             ->get()
//             ->map(function ($item) {
//                 // Match country with Country model (case-insensitive)
//                 $country = \App\Models\Country::whereRaw('LOWER(short_name) = ?', [strtolower($item->country_of_discharge)])
//                     ->first();

//                 // Add flag image
//                 $item->flag_img = $country->flag_img ?? null;

//                 return $item;
//             });

//         $totalShipments = ShipmentDataModal::where($this->searchBy, 'LIKE', '%' . $this->search . '%')->count();
//         $totalPages = $this->getTotalPages();

//         return view('livewire.seller.search-shipmentdatalist', [
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
use Livewire\Component;

class SearchShipmentdatalist extends Component
{
    public $search = '';
    public $searchBy = 'hsncode';
    public $country = '';   // 👈 added property
    public $perPage = 12;
    public $currentPage = 1;

    public function mount(): void
    {
        $this->search   = request()->query('search', '');
        $this->searchBy = request()->query('searchBy', 'hsncode');
        $this->country  = request()->query('country', ''); // 👈 capture country from URL
    }

    public function goToPage($page)
    {
        $totalPages = $this->getTotalPages();
        if ($page >= 1 && $page <= $totalPages) {
            $this->currentPage = $page;
        }
    }

    public function nextPage()
    {
        $totalPages = $this->getTotalPages();
        if ($this->currentPage < $totalPages) {
            $this->currentPage++;
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    private function getQuery()
    {
        // 👇 centralize query so both render() and pagination use same logic
        $query = ShipmentDataModal::query()
            ->where($this->searchBy, 'LIKE', '%' . $this->search . '%');

        if (!empty($this->country)) {
            $query->where('country_of_discharge', $this->country);
        }

        return $query;
    }

    private function getTotalPages()
    {
        $totalCount = $this->getQuery()->count();
        return (int) ceil($totalCount / $this->perPage);
    }

    public function render()
    {
        $offset = ($this->currentPage - 1) * $this->perPage;

        $shipments = $this->getQuery()
            ->skip($offset)
            ->take($this->perPage)
            ->get()
            ->map(function ($item) {
                // Match country with Country model (case-insensitive)
                $country = \App\Models\Country::whereRaw('LOWER(short_name) = ?', [strtolower($item->country_of_discharge)])
                    ->first();

                // Add flag image
                $item->flag_img = $country->flag_img ?? null;

                return $item;
            });

        $totalShipments = $this->getQuery()->count();
        $totalPages     = $this->getTotalPages();

        return view('livewire.seller.search-shipmentdatalist', [
            'shipmentData'    => $shipments,
            'totalShipments'  => $totalShipments,
            'totalPages'      => $totalPages,
            'perPage'         => $this->perPage,
            'currentPage'     => $this->currentPage,
        ]);
    }
}
