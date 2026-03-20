<?php

// namespace App\Livewire\Seller;

// use Livewire\Component;

// class ExpoterCompanyDetails extends Component
// {
//     public function render()
//     {
//         return view('livewire.seller.expoter-company-details');
//     }
// }

// namespace App\Livewire\Seller;

// use App\Models\ShipmentDataModal;
// use Livewire\Component;

// class ExpoterCompanyDetails extends Component
// {
//     public $exporter;
//     public $shipments = [];
//     public $perPage = 10;
//     public $currentPage = 1;
//     public $totalPages = 1;
//     public $shipmentCount;
//     public $totalFobValueFormatted;
//     public $countryCount;
//     public $productCount;

//     public function mount($id)
//     {
//         $this->exporter = ShipmentDataModal::findOrFail($id);

//         $this->shipmentData();

//         // Count all records having the same exporter_name
//         $this->shipmentCount = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name)->count();
//         // Sum total FOB value
//         $total = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name)
//             ->sum('total_fob_value');
//         $this->totalFobValueFormatted = $this->formatCurrencyShort($total);
//         // Unique country_of_discharge count
//         $this->countryCount = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name)
//             ->distinct('country_of_discharge')
//             ->count('country_of_discharge');
//         // ✅ Count of unique product descriptions
//         $this->productCount = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name)
//             ->distinct('product_description')
//             ->count('product_description');
//     }

//     public function shipmentData()
//     {
//         $allShipments = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name)->get();

//         $this->totalPages = ceil($allShipments->count() / $this->perPage);

//         $this->shipments = $allShipments->slice(($this->currentPage - 1) * $this->perPage, $this->perPage);
//     }
//     public function goToPage($page)
//     {
//         $this->currentPage = max(1, min($page, $this->totalPages));
//         $this->shipmentData();
//     }

//     public function nextPage()
//     {
//         if ($this->currentPage < $this->totalPages) {
//             $this->currentPage++;
//             $this->shipmentData();
//         }
//     }

//     public function prevPage()
//     {
//         if ($this->currentPage > 1) {
//             $this->currentPage--;
//             $this->shipmentData();
//         }
//     }

//     private function formatCurrencyShort($number)
//     {
//         if ($number >= 1000000000) {
//             return '₹' . round($number / 1000000000, 2) . 'B';
//         } elseif ($number >= 1000000) {
//             return '₹' . round($number / 1000000, 2) . 'M';
//         } elseif ($number >= 1000) {
//             return '₹' . round($number / 1000, 2) . 'K';
//         }
//         return '₹' . number_format($number, 2);
//     }


//     public function render()
//     {
//         return view('livewire.seller.expoter-company-details');
//     }
// }


namespace App\Livewire\Seller;

use App\Models\ShipmentDataModal;
use Livewire\Component;

class ExpoterCompanyDetails extends Component
{
    public $exporter;
    public $shipments = [];
    public $searchInput = ''; // temp input
    public $perPage = 12;
    public $currentPage = 1;
    public $totalPages = 1;
    public $shipmentCount;
    public $totalFobValueFormatted;
    public $countryCount;
    public $productCount;

    public $search = ''; // ✅ Search input
    public $productSearch = '';
    public $buyerSearch = '';


    public function mount($id)
    {
        $this->exporter = ShipmentDataModal::findOrFail($id);
        $this->shipmentData();

        $exporterName = $this->exporter->exporter_name;

        $this->shipmentCount = ShipmentDataModal::where('exporter_name', $exporterName)->count();

        $total = ShipmentDataModal::where('exporter_name', $exporterName)->sum('total_fob_value');
        $this->totalFobValueFormatted = $this->formatCurrencyShort($total);

        $this->countryCount = ShipmentDataModal::where('exporter_name', $exporterName)
            ->distinct('country_of_discharge')->count('country_of_discharge');

        $this->productCount = ShipmentDataModal::where('exporter_name', $exporterName)
            ->distinct('product_description')->count('product_description');
    }

    public function updatedSearch()
    {
        $this->currentPage = 1;
        $this->shipmentData();
    }

    public function shipmentData()
    {
        // $query = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name);

        // if (!empty($this->search)) {
        //     $query->where(function ($q) {
        //         $q->Where('country_of_discharge', 'like', '%' . $this->search . '%')
        //             ->orWhere('importer_buyer_name', 'like', '%' . $this->search . '%')
        //             ->orWhere('total_fob_value', 'like', '%' . $this->search . '%');
        //     });
        // }

        // $allShipments = $query->get();

        $allShipments = $this->getGroupedShipments(); // 🔁 New variable from new function

        $this->totalPages = ceil($allShipments->count() / $this->perPage);
        $this->shipments = $allShipments->slice(($this->currentPage - 1) * $this->perPage, $this->perPage);
    }

    public function getGroupedShipments()
    {
        $query = ShipmentDataModal::where('exporter_name', $this->exporter->exporter_name);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('country_of_discharge', 'like', '%' . $this->search . '%')
                    ->orWhere('importer_buyer_name', 'like', '%' . $this->search . '%')
                    ->orWhere('total_fob_value', 'like', '%' . $this->search . '%');
            });
        }

        // Product-specific search (separate)
        if (!empty($this->productSearch)) {
            $query->where('product_description', 'like', '%' . $this->productSearch . '%');
        }

        if (!empty($this->buyerSearch)) {
            $query->where(function ($q) {
                $q->where('importer_buyer_name', 'like', '%' . $this->buyerSearch . '%')
                    ->orWhere('country_of_discharge', 'like', '%' . $this->buyerSearch . '%')
                    ->orWhere('importer_buyer_address', 'like', '%' . $this->buyerSearch . '%');
            });
        }


        $rawShipments = $query->get();

        $grouped = $rawShipments->groupBy(function ($item) {
            return $item->importer_buyer_name . '___' . $item->country_of_discharge;
        });

        $groupedShipments = collect();

        foreach ($grouped as $group) {
            $first = $group->first();

            $groupedShipments->push((object)[
                'importer_buyer_name' => $first->importer_buyer_name,
                'importer_buyer_address' => $first->importer_buyer_address,
                'country_of_discharge' => $first->country_of_discharge,
                'total_fob_value' => $group->sum('total_fob_value'),
                'dateadded' => $group->sortByDesc('dateadded')->first()->dateadded,
                'shipments_count' => $group->count(),

                // 👇 Add these extra fields to prevent undefined errors
                'month' => \Carbon\Carbon::parse($first->dateadded)->format('F'),
                'year' => \Carbon\Carbon::parse($first->dateadded)->format('Y'),

                'product_description' => $first->product_description,
                'hsncode' => $first->hsncode,
                'chapter' => $first->chapter,
                'quantity' => $first->quantity,
                'uqc' => $first->uqc,
                'unit_rate' => $first->unit_rate,
                'unit_rate_currency' => $first->unit_rate_currency,
                'fob_value_currency' => $first->fob_value_currency,
            ]);
        }

        return $groupedShipments;
    }

    public function applySearch()
    {
        $this->search = $this->searchInput;
        $this->currentPage = 1;
        $this->shipmentData();
    }

    public function applyProductSearch()
    {
        $this->currentPage = 1;
        $this->shipmentData(); // Refresh list
    }
    public function applyBuyerSearch()
    {
        $this->currentPage = 1;
        $this->shipmentData(); // Refresh list
    }

    public function goToPage($page)
    {
        $this->currentPage = max(1, min($page, $this->totalPages));
        $this->shipmentData();
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->shipmentData();
        }
    }

    public function prevPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->shipmentData();
        }
    }

    private function formatCurrencyShort($number)
    {
        if ($number >= 1000000000) {
            return '₹' . round($number / 1000000000, 2) . 'B';
        } elseif ($number >= 1000000) {
            return '₹' . round($number / 1000000, 2) . 'M';
        } elseif ($number >= 1000) {
            return '₹' . round($number / 1000, 2) . 'K';
        }
        return '₹' . number_format($number, 2);
    }

    public function render()
    {
        return view('livewire.seller.expoter-company-details');
    }
}
