<?php

namespace App\Livewire\Seller;

use App\Models\BuyleadEnquiry;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TotalBuyleadEnquiry extends Component
{

    public $postrequirementID;

    public $search = '';
    public $searchActive = false;

    public function searchBuyleadEnquiry()
    {
        $this->searchActive = true;
    }


    public function mount($postrequirementID)
    {
        $this->postrequirementID = $postrequirementID;
    }
    public function render()
    {
        // $supplierId = Session::get('id');

        if ($this->search) {
            $buyleadinquiry = BuyleadEnquiry::with('customer')
                ->where('postbyrequirement_id', $this->postrequirementID) // Filter by postrequirementID
                ->where(function ($query) {
                    $query->where('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phonenumber', 'like', '%' . $this->search . '%');
                })
                ->get();
        } else {
            // $buyleadinquiry = BuyleadEnquiry::with('customer')->paginate(10);
            $buyleadinquiry = BuyleadEnquiry::with('customer')->where('postbyrequirement_id', $this->postrequirementID)->paginate(10);
        }
        return view('livewire.seller.total-buylead-enquiry', compact('buyleadinquiry'));
    }
}
