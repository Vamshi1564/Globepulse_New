<?php

namespace App\Livewire\Seller;

use App\DocDownloadTrait;
use App\Models\Material;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReportList extends Component
{
    use DocDownloadTrait;
    use WithPagination;

    public $procatId;
    // public $proreport = [];

    public $page = 1;
    public $perPage = 12;
    public $totalPages;
    public $showPagination = true;

    public $productPage = 1;
    public $productPerPage = 12;

    public function mount($procatId)
    {
        $this->procatId = $procatId;
        // $this->loadData();
    }

    // public function updatedPage()
    // {
    //     $this->loadData();
    // }

    // public function loadData()
    // {
    //     $query = Material::where('procat_id', $this->procatId);
    //     // $total = $query->count();

    //     // $this->totalPages = ceil($total / $this->perPage);
    //     // $this->showPagination = $total > $this->perPage;

    //     // $this->proreport = $query
    //     //     ->skip(($this->page - 1) * $this->perPage)
    //     //     ->take($this->perPage)
    //     //     ->get();

    //     $this->proreport = $query->paginate($this->perPage);
    // }

    public function nextPageProduct()
    {
        $this->productPage++;
    }

    public function prevPageProduct()
    {
        if ($this->productPage > 1) {
            $this->productPage--;
        }
    }

    public function getTotalProductRecordsProperty()
    {
        return Material::where('procat_id', $this->procatId)->count();
    }

    public function render()
    {

        // $proreport = Material::where('procat_id', $this->procatId)->paginate($this->perPage);;
        // $proreport = $query->paginate($this->perPage);

        // $productOffset = ($this->productPage - 1) * $this->productPerPage;

        // $proreport = Material::where('procat_id', $this->procatId)
        //     ->orderBy('id', 'desc')
        //     ->offset($productOffset)
        //     ->limit($this->productPerPage)
        //     ->get();
        $proreport = Material::where('procat_id', $this->procatId)
            ->orderBy('id', 'desc')
            ->paginate($this->productPerPage); // example: 10 per page


        return view('livewire.seller.product-report-list', [
            'proreport' => $proreport,
            'totalProductRecords' => $this->getTotalProductRecordsProperty(),
        ]);
    }
}
