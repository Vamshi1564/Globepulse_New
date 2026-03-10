<?php

namespace App\Livewire\Seller;

use App\Models\Invoicess;
use App\Models\Invoicess_products;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PackingListInvoice extends Component
{

    public $exporter, $exporter_address, $invoice_no, $invoice_date, $exporter_reference;
    public $buyer_order_no, $buyer_order_date, $buyer_name, $buyer_address;
    public $consignee, $other_consignee, $notify_party;
    public $origin_country, $destination_country, $description_goods, $kind_pkg;
    public $pre_carriage, $receipt_place, $vessel_flight_no, $port_loading, $port_discharge, $final_destination;
    public $marks_no, $terms, $container_no, $currency;
    // public $Invoices_type;

    public $type = 'PACKING_LIST';


    // Products Array
    public $products = [
        [
            'product_name' => '',
            'hs_code' => '',
            'quantity_kg' => 0,
            'quantity_box' => 0,
            'pieces' => 0,
            'net_weight' => 0,
            'gross_weight' => 0,

        ]
    ];

    // Validation Rules
    protected function rules()
    {
        return [
            'exporter' => 'required',
            'exporter_address' => 'required',
            'invoice_no' => 'required',
            'invoice_date' => 'required',
            'exporter_reference' => 'required',
            'buyer_order_no' => 'required',
            'buyer_order_date' => 'required',
            'buyer_name' => 'required',
            'buyer_address' => 'required',
            'container_no' => 'required',
            'marks_no' => 'required',
            'consignee' => 'required',
            'other_consignee' => 'required',
            'notify_party' => 'required',
            'origin_country' => 'required',
            'destination_country' => 'required',
            'description_goods' => 'required',
            'kind_pkg' => 'required',
            'pre_carriage' => 'required',
            'receipt_place' => 'required',
            'vessel_flight_no' => 'required',
            'port_loading' => 'required',
            'port_discharge' => 'required',
            'final_destination' => 'required',
            'currency' => 'required',
            'terms' => 'required',
            'products.*.product_name' => 'required',
            'products.*.hs_code' => 'required',
            'products.*.quantity_kg' => 'required',
            'products.*.quantity_box' => 'required',
            'products.*.pieces' => 'required',
            'products.*.net_weight' => 'required',
            'products.*.gross_weight' => 'required',
        ];
    }

    public function addItem()
    {
        $this->products[] = [
            'product_name' => '',
            'hs_code' => '',
            'quantity_kg' => '',
            'quantity_box' => '',
            'pieces' => '',
            'net_weight' => '',
            'gross_weight' => '',

        ];
    }

    // Method to remove an item from the items array
    public function removeItem($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products); // Reindex the array after removal
    }

    // Save the invoice
    // Update your saveInvoice method:
    public function saveInvoice()
    {
        $this->validate();

        try {

            // Retrieve customer ID from the flashed session
            $customerId = Session::get('id');

            // Check if customer_id is set, otherwise throw an error
            if (!$customerId) {
                session()->flash('error', 'Customer ID is not found in session.');
                return;
            }


            $invoice = Invoicess::create([
                'exporter' => $this->exporter,
                'customer_id' => $customerId,
                'exporter_address' => $this->exporter_address,
                'invoice_no' => $this->invoice_no,
                'invoice_date' => $this->invoice_date,
                'exporter_reference' => $this->exporter_reference,
                'buyer_order_no' => $this->buyer_order_no,
                'buyer_order_date' => $this->buyer_order_date,
                'buyer_name' => $this->buyer_name,
                'buyer_address' => $this->buyer_address,
                'consignee' => $this->consignee,
                'other_consignee' => $this->other_consignee,
                'notify_party' => $this->notify_party,
                'origin_country' => $this->origin_country,
                'destination_country' => $this->destination_country,
                'description_goods' => $this->description_goods,
                'kind_pkg' => $this->kind_pkg,
                'pre_carriage' => $this->pre_carriage,
                'receipt_place' => $this->receipt_place,
                'vessel_flight_no' => $this->vessel_flight_no,
                'port_loading' => $this->port_loading,
                'port_discharge' => $this->port_discharge,
                'final_destination' => $this->final_destination,
                'marks_no' => $this->marks_no,
                'terms' => $this->terms,
                'container_no' => $this->container_no,
                'currency' => $this->currency,
                'type' => $this->type,
            ]);

            foreach ($this->products as $product) {
                Invoicess_products::create([
                    'invoice_id' => $invoice->id,
                    'product_name' => $product['product_name'],
                    'hs_code' => $product['hs_code'],
                    'quantity_kg' => $product['quantity_kg'],
                    'quantity_box' => $product['quantity_box'],
                    'pieces' => $product['pieces'],
                    'net_weight' => $product['net_weight'],
                    'gross_weight' => $product['gross_weight'],

                ]);
            }



            $this->reset();

            session()->flash('success', 'Invoice created successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create invoice: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.seller.packing-list-invoice');
    }
}
