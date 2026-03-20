<?php

namespace App\Livewire\Seller;

use App\DocDownloadTrait;
use App\Models\Material;
use Livewire\Component;

class Templates extends Component
{
    use DocDownloadTrait;

    public $procatId;
    public $templates = [];

    public $page = 1;
    public $perPage = 10;
    public $totalPages;
    public $showPagination = true;

    public function mount($procatId)
    {
        $this->procatId = $procatId;
        $this->loadData();
    }

    public function updatedPage()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $query = Material::where('procat_id', $this->procatId);
        $total = $query->count();

        $this->totalPages = ceil($total / $this->perPage);
        $this->showPagination = $total > $this->perPage;

        $this->templates = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.templates', [
            'templates' => $this->templates,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
