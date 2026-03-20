<?php

// namespace App\Livewire\Seller;

// use App\DocDownloadTrait;
// use App\Models\DocumentsUpload;
// use App\Models\Material;
// use Illuminate\Support\Facades\Session;
// use Livewire\Component;

// class LoisPage extends Component
// {
//     use DocDownloadTrait;

//     public $procatId;
//     public $documents;

//     public function mount($procatId)
//     {
//         $this->procatId = $procatId;

//         $CustomerId = Session::get('id');

//         $this->documents = $this->documents = DocumentsUpload::with('documents')
//             ->where('lead_id', $CustomerId)
//             ->whereHas('documents', function ($query) {
//                 $query->where('id', 16);
//             })
//             ->get();
//     }

//     public function render()
//     {
//         $lois = Material::where('procat_id', $this->procatId)->paginate(10); // Fetch materials by ID.

//         return view('livewire.seller.lois-page', compact('lois'));
//     }
// }

// Add New pagination 
namespace App\Livewire\Seller;

use App\DocDownloadTrait;
use App\Models\DocumentsUpload;
use App\Models\Material;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LoisPage extends Component
{
    use DocDownloadTrait;

    public $procatId;
    public $documents = [];
    public $lois = [];

    public $page = 1;
    public $perPage = 10;
    public $totalPages;
    public $showPagination = true;

    public function mount($procatId)
    {
        $this->procatId = $procatId;

        $CustomerId = Session::get('id');

        $this->documents = DocumentsUpload::with('documents')
            ->where('lead_id', $CustomerId)
            ->whereHas('documents', function ($query) {
                $query->where('id', 16);
            })
            ->get();

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

        $this->lois = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.lois-page', [
            'lois' => $this->lois,
            'documents' => $this->documents,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
