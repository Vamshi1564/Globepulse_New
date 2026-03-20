<?php

namespace App;

trait SearchTrait
{
    // public $searchTerm; 
    // public $searchType = 'product'; 


    public function submitSearch()
    {
        if (empty(trim($this->searchTerm))) {
            // Optionally, you can add a session flash message or error handling here
            session()->flash('error', 'Please enter a search term.');
            return;
        }

        if ($this->searchType == 'product') {
            return redirect()->route('product', ['searchTerm' => $this->searchTerm]);
        } elseif ($this->searchType == 'supplier') {
            return redirect()->route('suppliers', ['searchTerm' => $this->searchTerm]);
        } elseif ($this->searchType == 'buylead') {
            return redirect()->route('byleads', ['searchTerm' => $this->searchTerm]);
        }
    }
}
