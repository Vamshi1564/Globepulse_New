<?php

namespace App\Livewire\Components;

use App\SearchTrait;
use Livewire\Component;

class Searchbar extends Component
{
    use SearchTrait; 
     public string $searchTerm = '';
    public string $searchType = 'product';

    public function render()
    {
        return view('livewire.components.searchbar');
    }
}
