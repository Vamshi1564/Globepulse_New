<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChamberMembershipCard extends Component
{
    public $lead;

    public function mount($leadId)
    {
        $this->lead = DB::table('tblleads')->find($leadId);
    }
    public function render()
    {
        return view('livewire.seller.chamber-membership-card');
    }
}
