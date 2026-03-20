<?php

namespace App\Livewire\Seller;

use App\Models\BuyerInformationModel;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class BuyerInformasion extends Component
{
    public $date, $buyer_name, $contact_number, $buyer_address, $product_name;
    public $sale_rate, $quantity, $total_sale, $payment_done_date, $lead_id;

    public $buyerPage = 1;
    public $perPage = 10;
    public $totalPages;
    public $buyers = [];
    public $search = '';

    public function mount()
    {
        $this->lead_id = Session::get('id');
        $this->loadBuyers();
    }

    public function runSearch()
    {
        $this->buyerPage = 1;
        $this->loadBuyers();
    }
    public function updatedBuyerPage()
    {
        $this->loadBuyers();
    }
    public function loadBuyers()
    {
        $query = BuyerInformationModel::where('lead_id', $this->lead_id);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('buyer_name', 'like', '%' . $this->search . '%')
                    ->orWhere('contact_number', 'like', '%' . $this->search . '%')
                    ->orWhere('product_name', 'like', '%' . $this->search . '%');
            });
        }
        $total = $query->count();


        $this->totalPages = ceil($total / $this->perPage);

        $this->buyers = $query->latest()
            ->skip(($this->buyerPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }
    public function save()
    {
        $this->validate([
            'date' => 'required',
            'buyer_name' => 'required',
            'contact_number' => 'required',
            'buyer_address' => 'required',
            'product_name' => 'required',
            'sale_rate' => 'required',
            'quantity' => 'required',
            'total_sale' => 'required',
            'payment_done_date' => 'required',
        ]);

        BuyerInformationModel::create([
            'date' => $this->date,
            'buyer_name' => $this->buyer_name,
            'contact_number' => $this->contact_number,
            'buyer_address' => $this->buyer_address,
            'product_name' => $this->product_name,
            'sale_rate' => $this->sale_rate,
            'quantity' => $this->quantity,
            'total_sale' => $this->total_sale,
            'payment_done_date' => $this->payment_done_date,
            'lead_id' => $this->lead_id,
            'status' => 1,
        ]);
        $this->reset([
            'date',
            'buyer_name',
            'contact_number',
            'buyer_address',
            'product_name',
            'sale_rate',
            'quantity',
            'total_sale',
            'payment_done_date'
        ]);
        $this->loadBuyers();
    }

    public function prevBuyerPage()
    {
        if ($this->buyerPage > 1) {
            $this->buyerPage--;
            $this->loadBuyers();
        }
    }

    public function nextBuyerPage()
    {
        if ($this->buyerPage < $this->totalPages) {
            $this->buyerPage++;
            $this->loadBuyers();
        }
    }


    public function render()
    {
        return view('livewire.seller.buyer-informasion');
    }
}
