<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\CustomerAddGroup;
use App\Models\CustomerGroups;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Lecturespage extends Component
{
    public $lectures = [];
    public $batchName;
    public $attendedLectures = [];
    public $batchId; // Declare batchId as a public property



    public function attendLecture($lectureId)
    {

        $leadId = Session::get('id');

        $lead = Customer::find($leadId);

        if (!$lead) {
            session()->flash('error', 'Unable to find lead information. Please try again.');
            return;
        }

        $customerId = $lead->client_id;

        // $existingAttendance = CustomerAddGroup::where('groupid', $lectureId)
        //     ->where('customer_id', $customerId)
        //     ->first();

        // if ($existingAttendance) {
        //     // If already added, show a message and return
        //     session()->flash('error', 'You have already added this lecture.');
        //     return;
        // }


        CustomerAddGroup::create([
            'groupid' => $lectureId,
            // 'customer_id' => $customerId,
            'lead_id' => $leadId
        ]);

        // $this->attendedLectures[] = $lectureId;

        // You can show a message or refresh the list after adding
        session()->flash('message', 'Attendance recorded successfully!');
        return redirect()->to(request()->header('Referer'));
    }

    public function loadLectures()
    {

        $batch = CustomerGroups::find($this->batchId);  // Get the batch using batchId
        $this->batchName = $batch->name;

        $this->lectures = CustomerGroups::where('parent_groupid', $this->batchId)->get();

        // Get the list of lectures the customer has attended
        $leadId = Session::get('id');
        $lead = Customer::find($leadId);

        if ($lead) {
            // $customerId = $lead->client_id;
            $attendedLectures = CustomerAddGroup::where('lead_id', $leadId)
                ->pluck('groupid')
                ->toArray();
            $this->attendedLectures = $attendedLectures;
        }
    }

    public function mount($batchId)
    {
        $this->batchId = $batchId;
        $this->loadLectures();
    }
    public function render()
    {
        return view('livewire.seller.lecturespage');
    }
}
