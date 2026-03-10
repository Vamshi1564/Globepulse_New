<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\TicketModel;
use App\Models\TicketStatuses;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SellerQueryTickets extends Component
{

    public $tickets;
    public $statuses;

    // 🔹 Pagination variables
    public $search = '';
    public $searchActive = false;
    public $taskPage = 1;
    public $taskPerPage = 10;
    public $perPageOptions = [5, 10, 25, 50, 100];
    public $totalTaskRecords;
    public $client;

    public function mount()
    {
        // $customerId = Session::get('id');
        // $this->client = Customer::find($customerId);

        $this->statuses = TicketStatuses::all();
        $this->loadTickets();
    }

    public function changePerPage()
    {
        $this->taskPage = 1;
        $this->loadTickets();
    }

    public function searchStaff()
    {
        $this->searchActive = true;
        $this->taskPage = 1;
        $this->loadTickets();
    }

    public function nextPageTask()
    {
        if ($this->taskPage < ceil($this->totalTaskRecords / $this->taskPerPage)) {
            $this->taskPage++;
            $this->loadTickets();
        }
    }

    public function prevPageTask()
    {
        if ($this->taskPage > 1) {
            $this->taskPage--;
            $this->loadTickets();
        }
    }

    public function goToPage($page)
    {
        $this->taskPage = $page;
        $this->loadTickets();
    }

    public function loadTickets()
    {
        $client = Session::get('id');

        $query = TicketModel::with(['staff', 'customer', 'ExclamationManager', 'TicketPriority', 'tasks'])
            ->where('lead_id', $client) // 🔹 Only client’s own tickets
            ->latest();

        // Optional: Add search functionality
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->Where('ticket_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('tasks', function ($q3) {
                        $q3->Where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $results = $query->get();
        $this->totalTaskRecords = $results->count();

        $start = ($this->taskPage - 1) * $this->taskPerPage;
        $this->tickets = $results->slice($start, $this->taskPerPage)->values();
    }

    public function render()
    {
        $this->loadTickets();

        $customerId = Session::get('id');
        $client = Customer::find($customerId);

        return view('livewire.seller.seller-query-tickets', [
            'tickets' => $this->tickets,
            'totalTaskRecords' => $this->totalTaskRecords,
            'taskPage' => $this->taskPage,
            'taskPerPage' => $this->taskPerPage,
            'perPageOptions' => $this->perPageOptions,
        ]);
        // return view('livewire.seller.seller-query-tickets');
    }
}
