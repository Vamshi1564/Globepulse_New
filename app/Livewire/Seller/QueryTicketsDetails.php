<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\Projects;
use App\Models\TicketModel;
use App\Models\TicketReminder;
use Livewire\Component;

class QueryTicketsDetails extends Component
{

    public $ticketId;
    public $ticketDetail;
    public $ticketReply;
    public $client_name;
    public $client_email;
    public $project_name;

    public function mount($id)
    {
        $this->ticketId = $id;

        $this->ticketDetail = TicketModel::with(['staff', 'TicketPriority'])->findOrFail($id);

        $this->ticketReply = TicketReminder::with(['staffs', 'TicketStatuses', 'TicketPriorityyy'])
            ->where('ticket_id', $this->ticketId)
            ->latest()
            ->get();

        $client = Customer::find($this->ticketDetail->lead_id);
        $this->client_name = $client->name ?? 'N/A';
        $this->client_email = $client->email ?? 'N/A';

        $project = Projects::find($this->ticketDetail->project_id);
        $this->project_name = $project->name ?? 'N/A';
    }

    public function render()
    {
        return view('livewire.seller.query-tickets-details', [
            'ticketDetail' => $this->ticketDetail,
            'ticketReply' => $this->ticketReply,
        ]);
    }
}
