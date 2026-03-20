<?php

namespace App\Livewire\Seller;

use App\Models\Country;
use App\Models\SupplierInformationModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SuppliersInformasion extends Component
{

    public $date, $product_name, $count, $country, $supplier_name, $contact_number;
    public $purchase_rate, $quantity, $total_amount, $payment_done_date, $lead_id;

    public $supplierPage = 1;
    public $perPage = 10;
    public $totalPages;
    public $suppliers = [];
    public $search = '';
    public $allCountries = [];

    public function mount()
    {
        $this->lead_id = Session::get('id');
        $this->allCountries = Country::orderBy('short_name')->get();

        $this->loadSuppliers();
    }

    public function runSearch()
    {
        $this->supplierPage = 1;
        $this->loadSuppliers();
    }

    public function updatedSupplierPage()
    {
        $this->loadSuppliers();
    }

    public function loadSuppliers()
    {
        $query = SupplierInformationModel::with('countrymodel')->where('lead_id', $this->lead_id);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('supplier_name', 'like', '%' . $this->search . '%')
                    ->orWhere('contact_number', 'like', '%' . $this->search . '%')
                    ->orWhere('product_name', 'like', '%' . $this->search . '%');
            });
        }

        $total = $query->count();
        $this->totalPages = ceil($total / $this->perPage);

        $this->suppliers = $query->latest()
            ->skip(($this->supplierPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function save()
    {
        $this->validate([
            'date' => 'required',
            'product_name' => 'required',
            'count' => 'required',
            'country' => 'nullable',
            'supplier_name' => 'required',
            'contact_number' => 'required',
            'purchase_rate' => 'required',
            'quantity' => 'required',
            'total_amount' => 'required',
            'payment_done_date' => 'required',
        ]);

        SupplierInformationModel::create([
            'date' => $this->date,
            'product_name' => $this->product_name,
            'count' => $this->count,
            'country' => $this->country,
            'supplier_name' => $this->supplier_name,
            'contact_number' => $this->contact_number,
            'purchase_rate' => $this->purchase_rate,
            'quantity' => $this->quantity,
            'total_amount' => $this->total_amount,
            'payment_done_date' => $this->payment_done_date,
            'lead_id' => $this->lead_id,
            'status' => 1,
        ]);

        $this->reset([
            'date',
            'product_name',
            'count',
            'country',
            'supplier_name',
            'contact_number',
            'purchase_rate',
            'quantity',
            'total_amount',
            'payment_done_date'
        ]);

        $this->loadSuppliers();
    }

    public function prevSupplierPage()
    {
        if ($this->supplierPage > 1) {
            $this->supplierPage--;
            $this->loadSuppliers();
        }
    }

    public function nextSupplierPage()
    {
        if ($this->supplierPage < $this->totalPages) {
            $this->supplierPage++;
            $this->loadSuppliers();
        }
    }

    public function render()
    {
        return view('livewire.seller.suppliers-informasion');
    }
}
