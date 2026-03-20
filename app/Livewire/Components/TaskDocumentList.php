<?php

namespace App\Livewire\Components;

use App\Models\ClientDocList;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TaskDocumentList extends Component
{
    public $searchTerm = '';
    public $listData = [];
    public $perPage = 10;
    public $page = 1;
    public $totalPages = 0;
    public $formKey;

    /* =======================
     * LIST DATA (GROUPED)
     * ======================= */

    protected $listeners = ['refreshServiceDocList' => 'loadListData'];

    public function mount()
    {
        $this->loadListData();
    }
    public function search()
    {
        $this->page = 1; // reset pagination
        $this->loadListData(); // reload filtered data
        $this->formKey = now()->timestamp; // force input re-render
    }
    public function loadListData()
    {
        $query = ClientDocList::select(
            'serviceid',
            DB::raw('COUNT(DISTINCT doc_name_id) AS doc_count')
        )
            ->with('service:id,name')
            ->groupBy('serviceid');

        if (!empty($this->searchTerm)) {
            $term = "%{$this->searchTerm}%";
            $query->whereHas(
                'service',
                fn($q) =>
                $q->where('name', 'LIKE', $term)
            );
        }

        $total = $query->get()->count();
        $this->totalPages = ceil($total / $this->perPage);

        $this->listData = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->loadListData();
        }
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadListData();
        }
    }
    public function render()
    {
        return view('livewire.components.task-document-list');
    }
}
