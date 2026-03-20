<?php

namespace App\Livewire\Seller;

use App\Models\PurchaseOrders;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
// use App\Models\PurchaseOrder; // Import the PurchaseOrder model
use Illuminate\Validation\Rule;

class PurchaseOrder extends Component
{
    public $po_number, $po_date, $invoice_number, $invoice_date, $company_name, $company_address,
        $company_email, $contact_person, $company_registration, $commodity, $grade_specification, $quantity, $rate, $amount, $currency, $payment_terms;

    // Fields for items
    public $items = [
        ['commodity' => '', 'grade_specification' => '', 'quantity' => '', 'rate' => '', 'amount' => '', 'payment_terms' => '']
    ];

    // Validation rules
    protected $rules = [
        'po_number' => 'required',
        'po_date' => 'required',
        'invoice_number' => 'required',
        'invoice_date' => 'required',
        'company_name' => 'required',
        'company_address' => 'required',
        'company_email' => 'required',
        'contact_person' => 'required',
        'company_registration' => 'required',
        'currency' => 'required',
        // Add item validation here
        'items.*.commodity' => 'required',
        'items.*.grade_specification' => 'required',
        'items.*.quantity' => 'required|numeric',
        'items.*.rate' => 'required|numeric',
        'items.*.amount' => 'required|numeric',
        'items.*.payment_terms' => 'required',
    ];

    // Method to add a new item to the items array
    public function addItem()
    {
        $this->items[] = [
            'commodity' => '',
            'grade_specification' => '',
            'quantity' => '',
            'rate' => '',
            'amount' => '',
            'payment_terms' => ''
        ];
    }

    // Method to remove an item from the items array
    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array after removal
    }

    public function savePurchaseOrder()
    {
        $this->validate();

        // Retrieve customer ID from the flashed session
        $customerId = Session::get('id');

        // Check if customer_id is set, otherwise throw an error
        if (!$customerId) {
            session()->flash('error', 'Customer ID is not found in session.');
            return;
        }

        // Save PurchaseOrder logic here, example:
        // $purchaseOrder = PurchaseOrders::create([
        //     'customer_id' => $customerId,
        //     'po_number' => $this->po_number,
        //     'po_date' => $this->po_date,
        //     'invoice_number' => $this->invoice_number,
        //     'invoice_date' => $this->invoice_date,
        //     'company_name' => $this->company_name,
        //     'company_address' => $this->company_address,
        //     'company_email' => $this->company_email,
        //     'contact_person' => $this->contact_person,
        //     'company_registration' => $this->company_registration,
        //     'commodity' => $this->commodity,
        //     'grade_specification' => $this->grade_specification,
        //     'quantity' => $this->quantity,
        //     'rate' => $this->rate,
        //     'amount' => $this->amount,
        //     'payment_terms' => $this->payment_terms,
        //     // Loop through items and save
        //     // Save each item to a separate table if needed
        // ]);

        // Iterate through each item and save in the same table
        foreach ($this->items as $item) {
            PurchaseOrders::create([
                'customer_id' => $customerId,
                'po_number' => $this->po_number,
                'po_date' => $this->po_date,
                'invoice_number' => $this->invoice_number,
                'invoice_date' => $this->invoice_date,
                'company_name' => $this->company_name,
                'company_address' => $this->company_address,
                'company_email' => $this->company_email,
                'contact_person' => $this->contact_person,
                'company_registration' => $this->company_registration,
                'currency' => $this->currency,
                'commodity' => $item['commodity'],
                'grade_specification' => $item['grade_specification'],
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'amount' => $item['amount'],
                'payment_terms' => $item['payment_terms'],
                // Add other necessary fields like po_date, invoice_number, etc.
            ]);
        }

        session()->flash('message', 'Purchase Order created successfully.');
        $this->reset();
    }


    public function render()
    {
        return view('livewire.seller.purchase-order');
    }
}
