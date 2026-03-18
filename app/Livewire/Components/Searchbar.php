<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\BuyLead;

class Searchbar extends Component
{
    public $searchTerm   = '';
    public $searchType   = 'product';
    public $showDropdown = false;

    public $suggestions = [
        'products'   => [],
        'categories' => [],
        'buyleads'   => [],
    ];

    // Called by JS via wire:click — bypasses wire:model reactivity issues entirely
    public function search($value)
    {
        $this->searchTerm = $value;

        if (strlen(trim($value)) < 2) {
            $this->showDropdown = false;
            $this->suggestions  = ['products' => [], 'categories' => [], 'buyleads' => []];
            return;
        }

        $term = '%' . trim($value) . '%';

        $this->suggestions = [
            'products'   => Product::where('name',  'LIKE', $term)->limit(8)->get(['id', 'name'])->toArray(),
            'categories' => Category::where('name', 'LIKE', $term)->limit(5)->get(['id', 'name'])->toArray(),
            'buyleads'   => BuyLead::where('title', 'LIKE', $term)->limit(5)->get(['id', 'title'])->toArray(),
        ];

        $this->showDropdown = true;
    }

    // Also keep this so wire:model.live still works if it does fire
    public function updatedSearchTerm($value)
    {
        $this->search($value);
    }

    public function selectSuggestion($value)
    {
        $this->searchTerm   = $value;
        $this->showDropdown = false;
        $this->suggestions  = ['products' => [], 'categories' => [], 'buyleads' => []];
    }

    public function closeDropdown()
    {
        $this->showDropdown = false;
    }

    public function submitSearch()
    {
        $this->showDropdown = false;

        return redirect()->route('search.results', [
            'q'    => $this->searchTerm,
            'type' => $this->searchType,
        ]);
    }

    public function render()
    {
        return view('livewire.components.searchbar');
    }
}