<?php

namespace App\Livewire;

use App\Livewire\Admin\Customers;
use App\Models\Customer;
use App\Models\CustomerAddGroup;
use App\Models\CustomerGroups;
use Livewire\Component;

class GroupMembers extends Component
{
    // public $groups;
    // public $selectedGroupId;
    // public $members = [];
    // public $newCustomerId;
    // public $availableCustomers = [];
    // public $selectedCustomerIds = [];
    // public $memberPage = 1;
    // public $membersPerPage = 10;
    // public $totalMembers = 0;


    public $groups, $selectedGroupId;
    public $members = [];
    public $memberPage = 1;
    public $membersPerPage = 5;
    public $totalMembers = 0;

    public $memberSearch = '';
    public $customerSearch = '';


    public $availableCustomers = [];
    public $customerPage = 1;
    public $customersPerPage = 5;
    public $totalCustomers = 0;


    public function mount()
    {
        $this->groups = CustomerGroups::all();
    }

    public function selectGroup($groupId)
    {
        $this->selectedGroupId = $groupId;
        $this->memberPage = 1;
        $this->customerPage = 1;
        $this->loadGroupData();
    }

    public function searchMembers()
    {
        $this->memberPage = 1; // reset pagination
        $this->loadGroupData();
    }

    public function searchCustomers()
    {
        $this->customerPage = 1; // reset pagination
        $this->loadGroupData();
    }

    public function loadGroupData()
    {

        //filtered only new lead id match list show correct 
        // $membersQuery = CustomerAddGroup::with('customer')
        //     ->where('groupid', $this->selectedGroupId)
        //     ->whereHas('customer', function ($q) {
        //         $q->when($this->memberSearch, function ($q) {
        //             $q->where('name', 'like', '%' . $this->memberSearch . '%')
        //                 ->orWhere('phonenumber', 'like', '%' . $this->memberSearch . '%');
        //         });
        //     })
        //     ->orderBy('id', 'desc');

        $membersQuery = CustomerAddGroup::with('customer')
            ->where('groupid', $this->selectedGroupId)
            ->where(function ($q) {
                if (!empty($this->memberSearch)) {
                    // Only filter if search is present
                    $q->whereHas('customer', function ($q2) {
                        $q2->where('name', 'like', '%' . $this->memberSearch . '%')
                            ->orWhere('phonenumber', 'like', '%' . $this->memberSearch . '%');
                    });
                }
                // If no search, do nothing, return all members
            })
            ->orderBy('id', 'desc');


        $this->totalMembers = $membersQuery->count();

        $this->members = $membersQuery
            ->skip(($this->memberPage - 1) * $this->membersPerPage)
            ->take($this->membersPerPage)
            ->get();

        // Available customers (not in this group)
        $allMemberIds = CustomerAddGroup::where('groupid', $this->selectedGroupId)
            ->pluck('lead_id')
            ->toArray();

        $customersQuery = Customer::where('client_id', '!=', 0)
            ->whereNotIn('id', $allMemberIds)
            ->when($this->customerSearch, function ($q) {
                $q->where('name', 'like', '%' . $this->customerSearch . '%')
                    ->orWhere('phonenumber', 'like', '%' . $this->customerSearch . '%');
            })
            ->orderBy('id', 'desc');

        $this->totalCustomers = $customersQuery->count();

        $this->availableCustomers = $customersQuery
            ->skip(($this->customerPage - 1) * $this->customersPerPage)
            ->take($this->customersPerPage)
            ->get();
    }

    // Member pagination
    public function nextMemberPage()
    {
        if ($this->memberPage * $this->membersPerPage < $this->totalMembers) {
            $this->memberPage++;
            $this->loadGroupData();
        }
    }

    public function prevMemberPage()
    {
        if ($this->memberPage > 1) {
            $this->memberPage--;
            $this->loadGroupData();
        }
    }

    // Customer pagination
    public function nextCustomerPage()
    {
        if ($this->customerPage * $this->customersPerPage < $this->totalCustomers) {
            $this->customerPage++;
            $this->loadGroupData();
        }
    }

    public function prevCustomerPage()
    {
        if ($this->customerPage > 1) {
            $this->customerPage--;
            $this->loadGroupData();
        }
    }

    public function updatedSelectedGroupId($value)
    {
        $this->memberPage = 1;
        $this->customerPage = 1;
        $this->loadGroupData();
    }

    public function addMember($customerId)
    {
        if ($this->selectedGroupId) {
            $customer = Customer::find($customerId);
            CustomerAddGroup::firstOrCreate([
                'lead_id' => $customer->id,
                'groupid' => $this->selectedGroupId,
                // 'customer_id' => $customer->client_id,
            ]);

            // Reset pagination
            $this->memberPage = 1;
            $this->customerPage = 1;
            $this->loadGroupData();

            session()->flash('message', 'Customer added successfully.');
        }
    }


    public function removeMember($memberId)
    {
        $member = CustomerAddGroup::find($memberId);
        if ($member) {
            $member->delete();

            // Reset pagination
            $this->memberPage = 1;
            $this->customerPage = 1;
            $this->loadGroupData();

            session()->flash('message', 'Member removed successfully.');
        }
    }
    public function render()
    {
        return view('livewire.group-members');
    }
}
