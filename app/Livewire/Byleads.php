<?php

// namespace App\Livewire;

// use App\Models\Postrequirment;
// use Illuminate\Support\Facades\Session;
// use Livewire\Component;
// use Livewire\WithPagination;

// class Byleads extends Component
// {
//     use WithPagination;
//     public $searchTerm;

//     public function mount()
//     {
//         $this->searchTerm = request()->query('searchTerm');
//     }
//     public function render()
//     {

//         $CustomerId = Session::get('id');

//         $postrequirments = Postrequirment::with('customer')->where('status', 1)->where('product_name', 'like', '%' . $this->searchTerm . '%')->where('customer_id', '!=', $CustomerId)
//             ->whereDoesntHave('buyleadenquiry', function ($query) use ($CustomerId) {
//                 $query->where('buyer_id', $CustomerId);
//             })
//             ->orderBy('id', 'desc')
//             ->paginate(5);
//         return view('livewire.byleads', compact('postrequirments'));
//     }
// }

//Add New Code Search With Pagination
namespace App\Livewire;

use App\Models\Postrequirment;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Byleads extends Component
{
    public $searchTerm;
    public $postrequirments = [];

    public $page = 1;
    public $perPage = 12;
    public $totalPages;
    public $showPagination = true;

    public function mount()
    {
        $this->searchTerm = request()->query('searchTerm', '');
        $this->loadData();
    }

    public function updatedSearchTerm()
    {
        $this->page = 1;
        $this->loadData();
    }

    public function updatedPage()
    {
        $this->loadData();
    }
    public function redirectToPostByRequirement()
    {

        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Access Denied, You must be logged in to access.');
        }
        return redirect()->route('postbyrequirement');
    }


    public function loadData()
    {
        $CustomerId = Session::get('id');

        $query = Postrequirment::with('customer')
            ->where('status', 1)
            ->where('product_name', 'like', '%' . $this->searchTerm . '%')
            ->where('customer_id', '!=', $CustomerId)
            ->whereDoesntHave('buyleadenquiry', function ($q) use ($CustomerId) {
                $q->where('buyer_id', $CustomerId);
            })
            ->orderBy('id', 'desc');

        $total = $query->count();
        $this->totalPages = ceil($total / $this->perPage);
        $this->showPagination = $total > $this->perPage;

        $this->postrequirments = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.byleads', [
            'postrequirments' => $this->postrequirments,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }
}
