<?php

namespace App\Livewire\Components;

use App\SearchTrait;
use Livewire\Component;

class Searchbar2 extends Component
{
    use SearchTrait;

    public $searchTerm = '';
    public $searchType = 'product';

    /**
     * 🔐 This will auto-fix array issue from Livewire hydration
     */
    public function updatedSearchTerm($value)
    {
        if (is_array($value)) {
            $this->searchTerm = $value[0] ?? '';
        } else {
            $this->searchTerm = (string) $value;
        }
    }

    public function render()
    {
        return view('livewire.components.searchbar2');
    }
}
