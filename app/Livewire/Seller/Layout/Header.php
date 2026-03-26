<?php
// FILE: app/Livewire/Seller/Layout/Header.php
// UPDATED: Reads session('seller_id') + Seller model instead of session('id') + Customer model
// All ticket/project/notification logic preserved — null-safe guarded so no crashes

namespace App\Livewire\Seller\Layout;

use App\Models\Seller;
use App\Models\LetterHeadModel;
use App\Models\Notification;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\RFQ;
use App\Models\Quotation;
class Header extends Component
{
    public $clientId;
    public $username;
    public $letterHeads;
    public $unreadCount  = 0;
    public $sellerName   = '';
    public $sellerEmail  = '';

    // Ticket Form Fields
    public $projects       = [];
    public $project_id;
    public $project_name;
    public $tasklist       = [];
    public $selectedTaskTitle;
    public $description;
    public $leadId;
    public $hasProjectTask = false;

    public $contactNumber;
    public $whatsappNumber;
    public $emailAddress;
    public $client_id;
     public $rfqCount = 0;
    public $recentRfqs = [];
    public $quotationCount;
public $recentQuotations;

    public function mount()
    {
        // ─── NEW: read from seller session ───────────────────────────────────
        $sellerId = Session::get('seller_id');
        $seller   = Seller::find($sellerId);

        if (!$seller) {
            // Seller not found (session expired etc.) — set safe defaults and return
            // SellerAuth middleware will handle the redirect, we just avoid crashing
            $this->sellerName  = Session::get('seller_name', '');
            $this->sellerEmail = Session::get('seller_email', '');
            $this->unreadCount = 0;
            $this->projects    = [];
            $this->hasProjectTask = false;
            $this->contactNumber  = '6353702511';
            $this->whatsappNumber = '916353702511';
            $this->emailAddress   = 'care@globpulse.com';
            return;
        }

        // Basic seller info for header display
        $this->sellerName  = $seller->details?->legal_business_name ?? Session::get('seller_name', $seller->email);
        $this->sellerEmail = $seller->email;
        $this->leadId      = $seller->id;   // used in ticket creation
        $this->client_id   = null;          // sellers don't have client_id yet

        // ─── LetterHeads ─────────────────────────────────────────────────────
        // LetterHeadModel uses customer_id — sellers won't have entries yet,
        // but this won't crash, just returns null
        $this->letterHeads = LetterHeadModel::where('customer_id', $sellerId)->first();

        // ─── Unread notifications ─────────────────────────────────────────────
        $this->unreadCount = Notification::where('rel_id', $sellerId)
            ->where('read_status', 1)
            ->where('rel_type', 'client')
            ->count();

        // ─── Projects (sellers won't have projects in old system yet) ─────────
        $this->projects       = [];
        $this->hasProjectTask = false;

        // ─── Contact info defaults ────────────────────────────────────────────
        $this->contactNumber  = '6353702511';
        $this->whatsappNumber = '916353702511';
        $this->emailAddress   = 'care@globpulse.com';


      $this->recentRfqs = RFQ::with('product')
    ->where('supplier_uuid', $sellerId)
    ->latest()
    ->take(5)
    ->get();

$this->rfqCount = RFQ::where('supplier_uuid', $sellerId)
    
    ->count();

      $this->quotationCount = Quotation::where('supplier_uuid', $sellerId)->count();

$this->recentQuotations = Quotation::with('rfq.product')
    ->where('supplier_uuid', $sellerId)
    ->latest()
    ->limit(5)
    ->get();
    
    }

    public function logout()
    {
        Session::forget(['seller_id', 'id', 'seller_email', 'seller_name']);
        return redirect()->route('seller.login')
            ->with('login_success', 'You have been logged out successfully.');
    }

    public function downloadMembershipCard()
    {
        $sellerId = Session::get('seller_id');
        $lead = DB::table('tblleads')->find($sellerId);

        $pdf = Pdf::loadView('livewire.seller.chamber-membership-card', compact('lead'))
            ->setPaper('A4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'membership-card.pdf');
    }

    /**
     * Load tasks when project is selected
     */
    public function updatedProjectId()
    {
        $this->tasklist = Task::where('rel_id', $this->project_id)->get();
        $this->selectedTaskTitle = null;
    }

    /**
     * Save support ticket
     */
    public function ticketSave()
    {
        $startDate  = Carbon::now();
        $endDate    = $startDate->copy();
        $hoursToAdd = 48;

        while ($hoursToAdd > 0) {
            $endDate->addHour();
            if ($endDate->isWeekday()) {
                $hoursToAdd--;
            }
        }

        $defaultManager  = Staff::where('exclamation_manager', 's1')->first();
        $defaultStatus   = TicketStatuses::where('name', 'Unverified')->first();
        $defaultPriority = TicketPriority::where('name', 'High')->first();
        $assignedStaffId = TaskAssignModal::where('taskid', $this->selectedTaskTitle)
            ->orderByDesc('id')
            ->value('staffid');

        TicketModel::create([
            'ticket_number'          => 'TIC-' . rand(100000, 999999),
            'task_title'             => $this->selectedTaskTitle,
            'project_id'             => $this->project_id,
            'lead_id'                => $this->leadId,
            'priority'               => $defaultPriority?->id,
            'staffid'                => $assignedStaffId,
            'description'            => $this->description,
            'start_date'             => $startDate,
            'end_date'               => $endDate,
            'exclamation_manager_id' => $defaultManager?->staffid,
            'status'                 => $defaultStatus?->id,
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
            'tick_created_id'        => $this->leadId,
            'tick_created_type'      => 'seller',   // changed from 'lead' to 'seller'
        ]);

        $this->reset(['selectedTaskTitle', 'description', 'project_id', 'project_name', 'tasklist']);

        session()->flash('message', 'Ticket Created Successfully.');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        $sellerId = Session::get('seller_id');
        $seller   = Seller::find($sellerId);
        return view('livewire.seller.layout.header', compact('seller'));
         
    }
}

?>