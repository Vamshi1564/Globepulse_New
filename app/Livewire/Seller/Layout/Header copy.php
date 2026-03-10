<?php

namespace App\Livewire\Seller\Layout;

use App\CustomerIdTrait;
use App\Models\Customer;
use App\Models\LetterHeadModel;
use App\Models\Notification;
use App\Models\NotificationTrigger;
use App\Models\Projects;
use App\Models\Staff;
use App\Models\Task;
use App\Models\TaskAssignModal;
use App\Models\TicketModel;
use App\Models\TicketPriority;
use App\Models\TicketStatuses;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Header extends Component
{
    public $clientId;
    public $username;
    public $letterHeads;
    public $unreadCount;

    // Ticket Form Fields
    public $projects = [];
    public $project_id;
    public $project_name;
    public $tasklist = [];
    public $selectedTaskTitle;
    public $description;
    public $leadId;
    public $hasProjectTask;

    public $contactNumber;
    public $whatsappNumber;
    public $emailAddress;
    public $client_id;

    public function mount()
    {
        $this->fetchClientId();

        $customerId = Session::get('id'); // Get the currently logged-in user's ID

        $this->letterHeads = LetterHeadModel::where('customer_id', $customerId)
            ->first();

        $this->unreadCount = Notification::where('rel_id', $customerId)
            ->where('read_status', 1)
            ->where('rel_type', 'client')
            ->count();
        // $clientUnread = Notification::where('rel_type', 'client')
        //     ->where('rel_id', $customerId)
        //     ->where('read_status', 1)
        //     ->count();

        // // $groupUnread = 0;
        // $groupIds = DB::table('tblcustomer_groups')
        //     ->where('lead_id', $customerId)
        //     ->pluck('groupid');

        // // ❗ If no group found by lead_id
        // if ($groupIds->isEmpty()) {

        //     // customerId → customers.id
        //     $clientId = DB::table('tblleads')
        //         ->where('id', $customerId)
        //         ->value('client_id');

        //     if ($clientId) {
        //         // now match customer_id with client_id
        //         $groupIds = DB::table('tblcustomer_groups')
        //             ->where('customer_id', $clientId)
        //             ->pluck('groupid');
        //     }
        // }

        // $groupUnread = 0;
        // if ($groupIds->isNotEmpty()) {
        //     $groupUnread = NotificationTrigger::whereIn('groupid', $groupIds)
        //         ->where('read_status', 1) // jo column hoy to
        //         ->count();
        // }

        // $this->unreadCount = $clientUnread + $groupUnread;


        // Load client projects
        $client = Customer::find($customerId);
        $this->leadId = $client->id;
        $this->client_id = $client->client_id;
        if ($client && $client->client_id) {
            $this->projects = Projects::where('clientid', $client->client_id)->get();
        }

        $projectIds = collect($this->projects)->pluck('id')->toArray();
        // dd($projectIds);

        if (!empty($projectIds)) {
            $this->hasProjectTask = Task::whereIn('rel_id', $projectIds)->where('rel_type', 'project')->where(function ($q) {
                $q->where('name', 'like', '%website%')
                    ->orWhere('description', 'like', '%website%');
            })->exists();
        } else {
            $this->hasProjectTask = false;
        }

        // Default fallback contact info
        $this->contactNumber = '6353702511';
        $this->whatsappNumber = '916353702511';
        $this->emailAddress = 'care@impexperts.com';

        if ($client && $client->client_id == 0) {
            // Get the lead assigned to this client
            // $lead = Customer::where('client_id', $client->client_id)->first();

            if ($client->assigned) {
                $staff = Staff::find($client->assigned);
                if ($staff) {
                    $this->contactNumber = $staff->phonenumber ?? $this->contactNumber;
                    $this->whatsappNumber = $staff->whatsapp_number ?? $this->whatsappNumber;
                    $this->emailAddress = $staff->email ?? $this->emailAddress;
                }
            }
        }
    }

    private function fetchClientId()
    {
        $customerId = Session::get('id');
        if ($customerId) {
            try {
                $response = Http::post(config('api.base_url') . config('api.customer_all_info'), [
                    'lead_id' => $customerId,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $this->clientId = $data['data'][0]['id'] ?? null;
                    $this->username = $data['data'][0]['username'] ?? null;
                } else {
                    logger()->error('API Error', ['response' => $response->body()]);
                }
            } catch (\Exception $e) {
                logger()->error('Fetch Client ID Error', ['message' => $e->getMessage()]);
            }
        }
    }

    public function logout()
    {
        // Auth::logout(); // Log out the user
        Session::flush();
        return redirect()->route('login'); // Redirect to the login page

    }
    public function downloadMembershipCard()

    {
        $customerId = Session::get('id');
        $lead = DB::table('tblleads')->find($customerId);

        $pdf = Pdf::loadView('livewire.seller.chamber-membership-card', compact('lead'))->setPaper('A4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'membership-card.pdf');
    }

    /**
     * Load tasks dynamically when project is selected
     */
    public function updatedProjectId()
    {
        // `$this->project_id` ma select thayeli project ni id already avi gayi che
        $this->tasklist = Task::where('rel_id', $this->project_id)->get();

        // Reset task title
        $this->selectedTaskTitle = null;
    }


    /**
     * Save ticket
     */
    public function ticketSave()
    {
        $startDate = Carbon::now();
        $endDate = $startDate->copy();
        $hoursToAdd = 48;

        while ($hoursToAdd > 0) {
            $endDate->addHour();

            // Faqat weekday na hours j count karva
            if ($endDate->isWeekday()) {
                $hoursToAdd--;
            }
        }

        // Fetch default S1 manager
        $defaultManager = Staff::where('exclamation_manager', 's1')->first();

        // Fetch default "Open" status from TicketStatuses table
        $defaultStatus = TicketStatuses::where('name', 'Unverified')->first();
        $defaultPriority = TicketPriority::where('name', 'High')->first();
        $assignedStaffId = TaskAssignModal::where('taskid', $this->selectedTaskTitle)
            ->orderByDesc('id')
            ->value('staffid');

        $ticket = TicketModel::create([
            'ticket_number' => 'TIC-' . rand(100000, 999999),
            'task_title'    => $this->selectedTaskTitle,
            'project_id'    => $this->project_id,
            'lead_id'       => $this->leadId,
            'priority' => $defaultPriority?->id,
            'staffid' => $assignedStaffId, // auto set to the staff assigned to the task
            'description'   => $this->description,
            'start_date'    => $startDate,
            'end_date'      => $endDate,
            'exclamation_manager_id' => $defaultManager?->staffid, // auto set to S1 staff
            'status'              => $defaultStatus?->id,  // TicketStatuses.id of "Open"
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
            // define who is created the ticket
            'tick_created_id' => $this->leadId,
            'tick_created_type' => 'lead'
        ]);


        // $ticket->update([
        //     'ticket_number' => 'TIC-' . $ticket->id,
        // ]);


        // Reset form
        $this->reset(['selectedTaskTitle', 'description', 'project_id', 'project_name', 'tasklist']);

        session()->flash('message', 'Ticket Created Successfully.');
        return redirect(request()->header('Referer'));
    }


    public function render()
    {
        $customerId = Session::get('id');
        $customer = Customer::find($customerId);
        return view('livewire.seller.layout.header', compact('customer'));
    }
}
