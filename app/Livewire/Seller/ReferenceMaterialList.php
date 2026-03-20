<?php

namespace App\Livewire\Seller;

use App\DocDownloadTrait;
use App\Models\Material;
use Livewire\Component;

class ReferenceMaterialList extends Component
{
    use DocDownloadTrait;

    public $procatId;
    public $materials = [];
    public $page = 1;
    public $perPage = 12;
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

        $this->materials = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.reference-material-list', [
            'materials' => $this->materials,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
