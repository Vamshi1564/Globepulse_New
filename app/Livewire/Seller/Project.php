<?php

namespace App\Livewire\Seller;

use App\Models\Client;
use App\Models\Customer;
use App\Models\Projects;
use App\Models\Staff;
use App\Models\Task;
use App\Models\TaskAssignModal;
use App\Models\TicketModel;
use App\Models\TicketPriority;
use App\Models\TicketStatuses;
use App\StatusTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class Project extends Component
{
    use StatusTrait;

    public $projects;
    public $tasks;
    public $tasklist = [];
    public $tasksByProject;

    // Ticket form fields
    public $project_id;
    public $project_name;
    public $selectedTaskTitle;
    public $description;
    public $leadId;

    public function mount()
    {
        $customerId = Session::get('id');
        // $client = Client::where('leadid', $customerId)->first();
        $client = Customer::find($customerId);

        if (!$client || !$client->client_id) {
            session()->flash('error', 'Project or task not found.');
            $this->projects = collect();
            $this->tasksByProject = collect();
            return;
        }

        $userId = $client->client_id;
        $this->leadId = $customerId; // 🔑 save lead id for ticket

        $this->projects = Projects::where('clientid', $userId)->get();
        $projectIds = $this->projects->pluck('id');
        $tasks = Task::whereIn('rel_id', $projectIds)->get();

        // Group tasks by keywords in the name
        foreach ($this->projects as $project) {
            $projectTasks = $tasks->where('rel_id', $project->id);

            $this->tasksByProject[$project->id] = [
                'training' => $projectTasks->filter(fn($t) => str_contains(strtolower($t->group_title), 'training')),
                'documents' => $projectTasks->filter(fn($t) => str_contains(strtolower($t->group_title), 'document')),
                'b2b_social_media' => $projectTasks->filter(
                    fn($t) =>
                    str_contains(strtolower($t->group_title), 'b2b_social_media')
                    // ||
                    //     str_contains(strtolower($t->name), 'social')
                ),
                'details' => $projectTasks->filter(fn($t) => str_contains(strtolower($t->group_title), 'detail')),
            ];
        }
    }

    // / Load tasks when a project is selected
    public function updatedProjectId($projectId)
    {
        $this->tasklist = Task::where('rel_id', $projectId)->get();
        $project = $this->projects->find($projectId);
        $this->project_name = $project ? $project->name : null;

        // Reset selected task
        $this->selectedTaskTitle = null;
    }

    // 🆕 Ticket Save method
    public function ticketSave()
    {
        $startDate = Carbon::now();
        $endDate = $startDate->copy();
        $hoursToAdd = 48;

        while ($hoursToAdd > 0) {
            $endDate->addHour();
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
            'tick_created_id' => $this->leadId,
            'tick_created_type' => 'lead'
        ]);

        // $ticket->update([
        //     'ticket_number' => 'TIC-' . $ticket->id,
        // ]);


        // Reset form
        $this->reset(['selectedTaskTitle', 'description', 'project_id', 'project_name', 'tasks']);

        session()->flash('message', 'Ticket Created Successfully.');
        return redirect(request()->header('Referer'));
    }


    public function render()
    {
        return view('livewire.seller.project');
    }
}
