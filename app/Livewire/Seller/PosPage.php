<?php

// namespace App\Livewire\Seller;

// use App\DocDownloadTrait;
// use App\Models\DocumentsUpload;
// use App\Models\Material;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Storage;
// use Livewire\Component;

// class PosPage extends Component
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
//                 $query->where('id', 17);
//             })
//             ->get();
//     }

//     public function render()
//     {
//         $pos = Material::where('procat_id', $this->procatId)->paginate(10); // Fetch materials by ID.

//         return view('livewire.seller.pos-page', compact('pos'));
//     }
// }

//Add New Pagination Workble 

namespace App\Livewire\Seller;

use App\DocDownloadTrait;
use App\Models\DocumentsUpload;
use App\Models\Material;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PosPage extends Component
{
    use DocDownloadTrait;

    public $procatId;
    public $documents = [];
    public $pos = [];

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
                $query->where('id', 17);
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

        $this->pos = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.pos-page', [
            'pos' => $this->pos,
            'documents' => $this->documents,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
