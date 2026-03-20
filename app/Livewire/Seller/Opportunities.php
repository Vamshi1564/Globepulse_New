<?php

namespace App\Livewire\Seller;

use App\Models\ProductCategoryModal;
use Livewire\Component;

class Opportunities extends Component
{
    public function render()
    {
        $procatId7 = ProductCategoryModal::find(7); // Adjust the query as needed.
        $procatId8 = ProductCategoryModal::find(8);

        return view('livewire.seller.opportunities' , compact('procatId7' , 'procatId8'));
    }
}
