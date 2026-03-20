<?php

namespace App\Livewire\Seller;

use App\Models\SocialMediaGroupModel;
use Livewire\Component;

class SocialMediaGroupShow extends Component
{
    public $SocialMedia = [];

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
        $query = SocialMediaGroupModel::query();

        $total = $query->count();
        $this->totalPages = ceil($total / $this->perPage);
        $this->showPagination = $total > $this->perPage;

        $this->SocialMedia = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.social-media-group-show', [
            'SocialMedia' => $this->SocialMedia,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
