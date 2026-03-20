<?php

namespace App\Livewire\Seller;

use App\Models\Task;
use App\StatusTrait;
use Livewire\Component;

class TasksList extends Component
{
    use StatusTrait;
    
    public $tasks;
    public function mount($projectId){

        $this->tasks = Task::where('rel_id', $projectId)->get();
    }


    public function render()
    {
        return view('livewire.seller.tasks-list');
    }
}
