<?php

namespace App\Livewire\Seller;

use App\Models\CustomerGroups;
use Livewire\Component;

class Batchespage extends Component
{
    public $batches = [];

    public function loadBatches()
    {
        $this->batches = CustomerGroups::where('grouptype_id', '1')->get();
    }
    public function render()
    {
        return view('livewire.seller.batchespage');
    }
}
