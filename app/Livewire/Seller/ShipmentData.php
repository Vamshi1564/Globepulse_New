<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\ExcelShipment;
use App\Models\ItemsModel;
use App\Models\Membership;
use App\Models\Product;
use App\Models\ShipmentDataModal;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShipmentData extends Component
{
    use WithPagination;

    public $hsncode;

    public function submit()
    {
        $this->validate([
            'hsncode' => 'required',
        ]);
    }


    public function download()
    {
        $this->validate([
            'hsncode' => 'required',
        ]);

        $customerId = Session::get('id'); // Get user ID from session
        $lead = Customer::where('id', $customerId)->first();
        $package = ItemsModel::find($lead->package_id);


        $shipmentData = ShipmentDataModal::where('hsncode', $this->hsncode)->limit($package->shipmentdata)->get();

        $response = new StreamedResponse(function () use ($shipmentData) {
            $handle = fopen('php://output', 'w');
            // Add CSV header
            fputcsv($handle, [
                'Export From Indian Port',
                'Exporter Name',
                'Exporter Address',
                'City/State',
                'Importer/Buyer Name',
                'Importer/Buyer Address',
                'Foreign Port',
                'Foreign Country',
                'Chapter',
                'HSN Code',
                'Product Description',
            ]);
            // CSV Data rows
            foreach ($shipmentData as $shipment) {
                fputcsv($handle, [
                    $shipment->export_from_indian_port,
                    $shipment->exporter_name,
                    $shipment->exporter_address,
                    $shipment->city_state,
                    $shipment->importer_buyer_name,
                    $shipment->importer_buyer_address,
                    $shipment->foreign_port,
                    $shipment->foreign_country,
                    $shipment->chapter,
                    $shipment->hsncode,
                    $shipment->product_description,
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="shipment_data.csv"');

        return $response;
    }



    public function render()
    {
        $customerId = Session::get('id'); // Get user ID from session
        $lead = Customer::where('id', $customerId)->first();
        $package = ItemsModel::find($lead->package_id);

        $HsnCode = Product::where('customer_id', $customerId)
            // ->select('HSN')
            // ->distinct()
            ->get();

        $shipmentData = ShipmentDataModal::where('hsncode', $this->hsncode)->limit($package->shipmentdata)->get();
        return view('livewire.seller.shipment-data', compact('shipmentData', 'HsnCode'));
    }
}
