<?php

namespace App\Livewire\Seller;

use App\CustomerIdTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateWebsiteForm extends Component
{
  
    public function render()
    {
     
        return view('livewire.seller.create-website-form');
    }
}
