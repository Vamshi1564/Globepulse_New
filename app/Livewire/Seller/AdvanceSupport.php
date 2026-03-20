<?php

// namespace App\Livewire\Seller;

// use App\Models\AdvanceSupportModel;
// use Livewire\Component;

// class AdvanceSupport extends Component
// {
//     public $AdvanceSupport = [];

//     public function mount()
//     {
//         $this->AdvanceSupport = AdvanceSupportModel::all();
//     }
//     public function render()
//     {
//         return view('livewire.seller.advance-support');
//     }
// }

namespace App\Livewire\Seller;

use App\Models\AdvanceSupportModel;
use Livewire\Component;

class AdvanceSupport extends Component
{
    public $AdvanceSupport = [];
    public $page = 1;
    public $perPage = 10;
    public $totalPages;
    public $showPagination = true;

    public function mount()
    {
        $this->loadData();
    }

    public function updatedPage()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $query = AdvanceSupportModel::query();
        $total = $query->count();

        $this->totalPages = ceil($total / $this->perPage);
        $this->showPagination = $total > $this->perPage;

        $this->AdvanceSupport = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.advance-support', [
            'AdvanceSupport' => $this->AdvanceSupport,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
