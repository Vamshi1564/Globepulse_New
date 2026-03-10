<?php

namespace App\Livewire\Seller;

use App\Models\EmbassyContact;
use Livewire\Component;

class EmbassyContactsShow extends Component
{
    public $EmbassyContacts = [];

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
        $query = EmbassyContact::with('country');

        $total = $query->count();
        $this->totalPages = ceil($total / $this->perPage);
        $this->showPagination = $total > $this->perPage;

        $this->EmbassyContacts = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.embassy-contacts-show', [
            'EmbassyContacts' => $this->EmbassyContacts,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
