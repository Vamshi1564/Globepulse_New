<?php

namespace App\Livewire\Seller;

use App\DocDownloadTrait;
use App\Models\Material;
use Livewire\Component;

class CreateTradeDocs extends Component
{

    use DocDownloadTrait;

    public $procatId;

    public function mount($procatId)
    {
        $this->procatId = $procatId;
    }

    public $documents = [
        ['id' => 1, 'name' => 'PROFORMA INVOICE', 'type' => 'proforma'],
        ['id' => 2, 'name' => 'COMMERCIAL INVOICE', 'type' => 'commercial'],
        ['id' => 3, 'name' => 'PACKING LIST INVOICE', 'type' => 'packing_list'],
        ['id' => 3, 'name' => 'PURCHASE ORDER INVOICE', 'type' => 'purchas_order'],
    ];

    public function render()
    {
        $createtrade = Material::where('procat_id', $this->procatId)->paginate(10); // Fetch materials by ID.

        return view('livewire.seller.create-trade-docs' , compact('createtrade'));
    }
}
