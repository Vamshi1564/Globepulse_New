<?php

namespace App\Livewire\Seller;

use App\Models\ProductCategoryModal;
use Livewire\Component;

class MyResources extends Component
{
    public function render()
    {

        $procatId1 = ProductCategoryModal::find(1); // Adjust the query as needed.
        $procatId2 = ProductCategoryModal::find(2); // Adjust the query as needed.
        $procatId3 = ProductCategoryModal::find(3); // Adjust the query as needed.
        $procatId4 = ProductCategoryModal::find(4); // Adjust the query as needed.
        $procatId5 = ProductCategoryModal::find(5); // Adjust the query as needed.
        $procatId6 = ProductCategoryModal::find(6); // Adjust the query as needed.
        $procatId7 = ProductCategoryModal::find(7); // Adjust the query as needed.
        $procatId8 = ProductCategoryModal::find(8); // Adjust the query as needed.
        // $procatId9 = ProductCategoryModal::find(9); // Adjust the query as needed.
        // $procatId10 = ProductCategoryModal::find(9); // Adjust the query as needed.
        // $procatId11 = ProductCategoryModal::find(9); // Adjust the query as needed.
        // $procatId12 = ProductCategoryModal::find(9); // Adjust the query as needed.

        return view('livewire.seller.my-resources', compact('procatId1', 'procatId2', 'procatId3', 'procatId4', 'procatId5', 'procatId6', 'procatId7', 'procatId8'));
    }
}
