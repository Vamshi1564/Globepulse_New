<?php

namespace App\Livewire\Front;

use App\Models\HotDealModal;
use Carbon\Carbon;
use Livewire\Component;

class Hotdeal extends Component
{
    public $hotDeals;
    public $hotdealPage = 1;
    public $hotdealPerPage = 5;
    public $hotdealTotalPages;
    public $search = '';
    public $searchTriggered = false;



    public function updatedSearch()
    {
        $this->hotdealPage = 1; // Reset to first page on search
        $this->loadDeals();
    }
    public function mount()
    {
        $this->loadDeals();
    }

    public function searchHotDeals()
    {
        $this->hotdealPage = 1;
        $this->searchTriggered = true;
        $this->loadDeals();
    }
    public function setHotdealPage($page)
    {
        $this->hotdealPage = $page;
        $this->loadDeals();
    }
    public function loadDeals()
    {

        $query = HotDealModal::with('product.country')->where('deal_enddate', '>', Carbon::now())->where('status' , 2);

        if ($this->searchTriggered && !empty($this->search)) {
            $query->whereHas('product', function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            });
        }

     
        $total = $query->count();
        $this->hotdealTotalPages = ceil($total / $this->hotdealPerPage);

        $this->hotDeals = $query
            ->orderBy('id', 'desc')
            ->skip(($this->hotdealPage - 1) * $this->hotdealPerPage)
            ->take($this->hotdealPerPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.hotdeal');
    }
}
