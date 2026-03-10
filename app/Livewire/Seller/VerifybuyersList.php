<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\Membership;
use App\Models\Product;
use App\Models\VerifybuyersModal;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class VerifybuyersList extends Component
{

    use WithPagination;

    public $hsncode;
    public $verifyBuyers;


    public function submit()
    {
        $this->validate([
            'hsncode' => 'required',
        ]);

        $customerId = Session::get('id'); // Get user ID from session
        $lead = Customer::where('id', $customerId)->first();
        $package = ItemsModel::find($lead->package_id);
    
        // Fetch shipment data based on selected HSNode cand limit
        $this->verifyBuyers = VerifybuyersModal::with('country')->where('hsncode', $this->hsncode)
            ->limit($package->shipmentdata)
            ->get();
    }

    // public function download()
    // {
    //     $this->validate([
    //         'hsncode' => 'required',
    //     ]);

    //     $customerId = Session::get('id'); // Get user ID from session
    //     $lead = Customer::where('id', $customerId)->first();
    //     $package = Membership::find($lead->package_id);


    //     $shipmentData = RealShipmentData::with('country')->where('hsncode', $this->hsncode)
    //     ->limit($package->shipmentdata)
    //     ->get();
        
    //     $response = new StreamedResponse(function () use ($shipmentData) {
    //         $handle = fopen('php://output', 'w');
    //         // Add CSV header
    //         fputcsv($handle, ['company_name', 'email', 'phone', 'country', 'address', 'hsncode' , 'website']); // Update with your actual fields

    //         foreach ($shipmentData as $shipment) {
    //             fputcsv($handle, [
    //                 $shipment->company_name,
    //                 $shipment->email,
    //                 $shipment->phone,
    //                 $shipment->country->short_name,
    //                 $shipment->address, // Replace with actual field names
    //                 $shipment->hsncode,
    //                 $shipment->website,
    //             ]);
    //         }
    //         fclose($handle);
    //     });

    //     $response->headers->set('Content-Type', 'text/csv');
    //     $response->headers->set('Content-Disposition', 'attachment; filename="shipment_data.csv"');

    //     return $response;
    // }

    public function render()
    {
        $customerId = Session::get('id'); // Get user ID from session
        // $lead = Customer::where('id', $customerId)->first();
        // $package = Membership::find($lead->package_id);

        $HsnCode = Product::where('customer_id', $customerId)
            // ->select('HSN')
            // ->distinct()
            ->get();
        return view('livewire.seller.verifybuyers-list' , compact('HsnCode'));
    }
}
