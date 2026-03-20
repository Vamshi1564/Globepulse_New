<?php

namespace App\Livewire\Seller;

use App\Models\Distribution;
use Livewire\Component;
use Livewire\WithPagination;

class DistributionInquiries extends Component
{
    use WithPagination;
    public $perPage = 6;

    public function updatingPerPage()
    {
        $this->resetPage();
    }
   

    public function render()
    {
        $customerId = session('id');

        $distributions = Distribution::with(['customer', 'countrymodel' , 'product'])->where('product_seller_id', $customerId)->paginate($this->perPage);

        return view('livewire.seller.distribution-inquiries', compact('distributions'));
    }
}
