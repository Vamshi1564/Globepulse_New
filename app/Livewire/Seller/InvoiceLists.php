<?php

namespace App\Livewire\Seller;

use App\Models\Invoicess;
use App\Models\PurchaseOrders;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class InvoiceLists extends Component
{

    public $type;
    public $invoiceList = [];
    public $isPurchaseOrder = false;

    public function mount($type)
    {

        $this->type = $type; // Assign type when the component is initialized

        // dd(Session::get('id'), $type);


        $customerId = Session::get('id');

        if ($this->type === 'purchas_order') {
            // If "PURCHASE ORDER" is selected, fetch data from purchase_orders table
            $this->invoiceList = PurchaseOrders::where('customer_id', $customerId)->get();
            $this->isPurchaseOrder = true;
        } else {
            $this->invoiceList = Invoicess::where('type', $type)
                ->where('customer_id', $customerId)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.seller.invoice-lists');
    }
}
