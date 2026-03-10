<?php

namespace App\Livewire\Seller;

use App\Models\FaqsModel;
use Livewire\Component;
use Livewire\WithPagination;

class FaqsShow extends Component
{
    use WithPagination;
    // public $Faqs = [];

    public $page = 1;
    public $perPage = 10;
    // public $totalPages;
    // public $showPagination = true;

    // public function mount()
    // {
    //     $this->loadData();
    // }

    // public function updatedPage()
    // {
    //     $this->loadData();
    // }

    // public function loadData()
    // {
    //     $query = FaqsModel::query();

    //     // $total = $query->count();
    //     // $this->totalPages = ceil($total / $this->perPage);
    //     // $this->showPagination = $total > $this->perPage;

    //     // $this->Faqs = $query
    //     //     ->skip(($this->page - 1) * $this->perPage)
    //     //     ->take($this->perPage)
    //     //     ->get();

    //     $this->Faqs = $query->paginate($this->perPage);
    // }

    public function render()
    {

         $Faqs = FaqsModel::paginate($this->perPage);
         
        return view('livewire.seller.faqs-show', [
            'Faqs' => $Faqs,
            // 'currentPage' => $this->page,
            // 'totalPages' => $this->totalPages,
            // 'showPagination' => $this->showPagination,
        ]);
    }
}
