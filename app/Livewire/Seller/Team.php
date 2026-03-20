<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Team extends Component
{

    use WithFileUploads;
    use CustomerIdTrait;

    public $name;
    public $designation;
    public $img_link;
    public $customer_id;
    public $isEdit = false;
    public $TeamId;
    public $teams = [];
    public $clientId;
    public $page = 1;

    public function mount()
    {
        $this->fetchCustomerId();
        $this->fetchTeam();
    }
    public function fetchTeam()
    {
        // $CustomerId = Session::get('id');
        $response = Http::post(config('api.base_url') . config('api.team_list'), [

            'customer_id' => $this->clientId,
        ]);

        if ($response->successful()) {
            $this->teams = $response->json()['data'];
            return $this->teams;
        }
    }


    public function AddTeam()
    {

        $this->validate([
            'name' => 'required',
            'designation' => 'required',
            'img_link' => $this->isEdit ? 'nullable' : 'required',  // Validation for the main image
        ]);

        // $customerId = Session::get('id');
        $imagePath = $this->img_link;


        if ($this->img_link && is_object($this->img_link)) {
            $response = Http::attach(
                'image',
                file_get_contents($this->img_link->getRealPath()),
                $this->img_link->getClientOriginalName()
            )->post(config('api.base_url') . config('api.image_upload'), [
                'path_name' => 'team',
            ]);

            if ($response->successful()) {
                $imagePath = $response->json('data'); // Get the new image path
            } else {
                session()->flash('error', 'Failed to upload the main image.');
                return;
            }
        }

        // Prepare data for the SLider (whether adding or updating)
        $data = [
            'name' => $this->name,
            'designation' => $this->designation,
            'img_link' => $imagePath,  // Use new or existing image
            'customer_id' => $this->clientId,
            'api_type' => $this->isEdit ? 'update' : 'insert',
            'id' => $this->isEdit ? $this->TeamId : null,
        ];

        // Send the API request to update or insert the product
        $response = Http::post(config('api.base_url') . config('api.team_api'), $data);

        // Check the response and handle success or failure
        if ($response->successful()) {
            session()->flash('message', $this->isEdit ? 'Team updated successfully.' : 'Team added successfully.');
            $this->reset(); // Reset the form
            // $this->fetchProducts();
        } else {
            session()->flash('error', 'Failed to save Team.');
        }
        $this->reset();
        return redirect()->to(request()->header('Referer'));
    }

    public function editTeam($TeamId)
    {
        // Find the product to prefill fields
        $fetchteam = $this->fetchTeam();

        $team = collect($fetchteam)->firstWhere('id', $TeamId);

        if ($team) {
            $this->isEdit = true;
            $this->TeamId = $team['id'];
            $this->name = $team['name'];
            $this->designation = $team['designation'];
            $this->img_link = $team['img_link']; // Store current image path
        }
    }

    public function DeleteTeam($id){

        $apiData = [
            'id' => $id,
            'api_type' => 'delete'
        ];

        $response = Http::post(config('api.base_url') . config('api.team_api'), $apiData);

        if ($response->successful()) {
            session()->flash('message', 'Team Deleted successfully.');
            $this->fetchTeam();
        } 
    }
    public function render()
    {
        $teams = collect($this->fetchTeam())->forPage($this->page, 10); // Show 5 products per page
        $total = count($this->fetchTeam());
        return view('livewire.seller.team', [
            'teams' => $teams,
            'totalPages' => ceil($total / 10),
        ]);
    }
}
