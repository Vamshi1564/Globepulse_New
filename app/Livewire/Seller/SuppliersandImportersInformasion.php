<?php

// namespace App\Livewire\Seller;

// use Livewire\Component;

// class SuppliersandImporters extends Component
// {
//     public function render()
//     {
//         return view('livewire.seller.suppliersand-importers');
//     }
// }

// namespace App\Livewire\Seller;

// use App\Models\SuppliersAndImporterModel;
// use Illuminate\Support\Facades\Session;
// use Livewire\Component;

// class SuppliersandImporters extends Component
// {
//     public $company_name, $profile, $contact_person_owner, $contact_no_1, $contact_no_2, $email, $remarks_1, $remarks_2;
//     public $isEditing = false;
//     public $selectedId;
//     public $isModalOpen = false;

//     public function render()
//     {
//         $leadId = Session::get('id'); // Get the currently logged-in user's ID
//         $data = SuppliersAndImporterModel::where('lead_id', $leadId)
//             ->get();

//         return view('livewire.seller.suppliersand-importers', compact('data'));
//     }


//     public function openModal()
//     {
//         $this->resetForm(); // Optional: reset previous form values
//         $this->isEditing = false;
//         $this->isModalOpen = true;
//     }

//     public function closeModal()
//     {
//         $this->isModalOpen = false;
//     }

//     public function addData()
//     {
//         $this->validate([
//             'company_name' => 'required',
//             'profile' => 'required',
//             'contact_person_owner' => 'required',
//             'contact_no_1' => 'required',
//             'contact_no_2' => 'required',
//             'email' => 'required|email',
//             'remarks_1' => 'required',
//             'remarks_2' => 'required',
//         ]);

//         $suppliersId = Session::get('id');

//         SuppliersAndImporterModel::create([
//             'lead_id' => $suppliersId,
//             'company_name' => $this->company_name,
//             'profile' => $this->profile,
//             'contact_person_owner' => $this->contact_person_owner,
//             'contact_no_1' => $this->contact_no_1,
//             'contact_no_2' => $this->contact_no_2,
//             'email' => $this->email,
//             'remarks_1' => $this->remarks_1,
//             'remarks_2' => $this->remarks_2,
//         ]);


//         $this->resetForm();
//         $this->closeModal();
//         session()->flash('message', 'Data added successfully.');
//     }

//     public function editSupp($id)
//     {
//         $record = SuppliersAndImporterModel::findOrFail($id);
//         $this->selectedId = $id;
//         $this->company_name = $record->company_name;
//         $this->profile = $record->profile;
//         $this->contact_person_owner = $record->contact_person_owner;
//         $this->contact_no_1 = $record->contact_no_1;
//         $this->contact_no_2 = $record->contact_no_2;
//         $this->email = $record->email;
//         $this->remarks_1 = $record->remarks_1;
//         $this->remarks_2 = $record->remarks_2;

//         $this->isEditing = true;
//         $this->isModalOpen = true; // ✅ VERY IMPORTANT - open modal

//     }

//     public function updateData()
//     {
//         $this->validate([
//             'company_name' => 'required',
//             'email' => 'nullable|email',
//         ]);

//         if ($this->selectedId) {
//             $record = SuppliersAndImporterModel::findOrFail($this->selectedId);
//             $record->update($this->only([
//                 'company_name',
//                 'profile',
//                 'contact_person_owner',
//                 'contact_no_1',
//                 'contact_no_2',
//                 'email',
//                 'remarks_1',
//                 'remarks_2'
//             ]));
//             session()->flash('message', 'Data updated successfully.');
//         }
//         $this->closeModal();
//         $this->resetForm();
//     }

//     public function deleteSupp($id)
//     {
//         SuppliersAndImporterModel::findOrFail($id)->delete();
//         session()->flash('message', 'Data deleted successfully.');
//     }

//     public function resetForm()
//     {
//         $this->company_name = '';
//         $this->profile = '';
//         $this->contact_person_owner = '';
//         $this->contact_no_1 = '';
//         $this->contact_no_2 = '';
//         $this->email = '';
//         $this->remarks_1 = '';
//         $this->remarks_2 = '';
//     }
// }

namespace App\Livewire\Seller;

use App\Models\SuppliersAndImporterModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SuppliersandImportersInformasion extends Component
{
    public $company_name, $profile, $contact_person_owner, $contact_no_1, $contact_no_2, $email, $remarks_1, $remarks_2;
    public $isEditing = false;
    public $selectedId;
    public $isModalOpen = false;

    public $page = 1;
    public $perPage = 10;
    public $totalPages;
    public $showPagination = true;
    public $records = [];

    public function mount()
    {
        $this->loadData();
    }

    public function updatedPage()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $leadId = Session::get('id');

        $query = SuppliersAndImporterModel::where('lead_id', $leadId);
        $total = $query->count();

        $this->totalPages = ceil($total / $this->perPage);
        $this->showPagination = $total > $this->perPage;

        $this->records = $query
            ->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.suppliersand-importers-informasion', [
            'data' => $this->records,
            'currentPage' => $this->page,
            'totalPages' => $this->totalPages,
            'showPagination' => $this->showPagination,
        ]);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function addData()
    {
        $this->validate([
            'company_name' => 'required',
            'profile' => 'required',
            'contact_person_owner' => 'required',
            'contact_no_1' => 'required',
            'contact_no_2' => 'required',
            'email' => 'required|email',
            'remarks_1' => 'required',
            'remarks_2' => 'required',
        ]);

        $leadId = Session::get('id');

        SuppliersAndImporterModel::create([
            'lead_id' => $leadId,
            'company_name' => $this->company_name,
            'profile' => $this->profile,
            'contact_person_owner' => $this->contact_person_owner,
            'contact_no_1' => $this->contact_no_1,
            'contact_no_2' => $this->contact_no_2,
            'email' => $this->email,
            'remarks_1' => $this->remarks_1,
            'remarks_2' => $this->remarks_2,
            'dateadded' => Carbon::now(),
        ]);

        $this->resetForm();
        $this->closeModal();
        $this->loadData();

        session()->flash('message', 'Data added successfully.');
    }

    public function editSupp($id)
    {
        $record = SuppliersAndImporterModel::findOrFail($id);
        $this->selectedId = $id;
        $this->company_name = $record->company_name;
        $this->profile = $record->profile;
        $this->contact_person_owner = $record->contact_person_owner;
        $this->contact_no_1 = $record->contact_no_1;
        $this->contact_no_2 = $record->contact_no_2;
        $this->email = $record->email;
        $this->remarks_1 = $record->remarks_1;
        $this->remarks_2 = $record->remarks_2;

        $this->isEditing = true;
        $this->isModalOpen = true;
    }

    public function updateData()
    {
        $this->validate([
            'company_name' => 'required',
            'email' => 'nullable|email',
        ]);

        if ($this->selectedId) {
            $record = SuppliersAndImporterModel::findOrFail($this->selectedId);
            $record->update($this->only([
                'company_name',
                'profile',
                'contact_person_owner',
                'contact_no_1',
                'contact_no_2',
                'email',
                'remarks_1',
                'remarks_2'
            ]));
            session()->flash('message', 'Data updated successfully.');
        }

        $this->closeModal();
        $this->resetForm();
        $this->loadData();
    }

    public function deleteSupp($id)
    {
        SuppliersAndImporterModel::findOrFail($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
        $this->loadData();
    }

    public function resetForm()
    {
        $this->company_name = '';
        $this->profile = '';
        $this->contact_person_owner = '';
        $this->contact_no_1 = '';
        $this->contact_no_2 = '';
        $this->email = '';
        $this->remarks_1 = '';
        $this->remarks_2 = '';
    }
}
