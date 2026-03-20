<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ProductCat extends Component
{
    public $name;
    public $customer_id = 5;

    public function submit()
    {
        $response = Http::post('https://demo.digiexpertpro.com/api/product_cat_update_api.php',[
            'customer_id' => $this->customer_id,
            'name' => $this->name,
            'api_type'=> 'insert',
        ]);

       
    }

    public function render() 
    {
        return view('livewire.product-cat');
    }
}
