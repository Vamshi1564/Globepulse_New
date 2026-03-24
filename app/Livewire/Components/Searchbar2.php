<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Searchbar2 extends Component
{
    public string $searchTerm = '';
    public string $searchType = 'product';
    public array $suggestions = [];

    public function updatedSearchTerm(string $value): void
    {
        $this->suggestions = [];

        if (strlen(trim($value)) < 2) return;

        $q = '%' . trim($value) . '%';

        if ($this->searchType === 'product') {

            $products = DB::table('tbl_products')
                ->where('title', 'LIKE', $q)
                ->where('status', 1)
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->whereNotNull('title')
                ->where('title', '!=', '')
                ->limit(8)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Product',
                    'url'  => url('/product-detail/' . $r->slug),
                ])
                ->values()
                ->toArray();

            $categories = DB::table('tbl_category')
                ->where('cat_name', 'LIKE', $q)
                ->where('status', 1)
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->whereNotNull('cat_name')
                ->where('cat_name', '!=', '')
                ->limit(4)
                ->get(['id', 'cat_name', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->cat_name,
                    'type' => 'Category',
                    'url'  => url('/products-category/' . $r->slug),
                ])
                ->values()
                ->toArray();

            $this->suggestions = array_values(array_merge($products, $categories));

        } elseif ($this->searchType === 'buylead') {

            $this->suggestions = DB::table('tbl_buyleads')
                ->where('title', 'LIKE', $q)
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->whereNotNull('title')
                ->where('title', '!=', '')
                ->limit(8)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Buy Lead',
                    'url'  => url('/buylead/' . $r->slug),
                ])
                ->values()
                ->toArray();
        }

        $this->dispatch('suggestionsUpdated');
    }

    public function updatedSearchType(): void
    {
        $this->updatedSearchTerm($this->searchTerm);
    }

    public function submitSearch(): void
    {
        if (trim($this->searchTerm) === '') return;

        $this->redirect(url('/products?q=' . urlencode($this->searchTerm) . '&type=' . $this->searchType));
    }

    public function render()
    {
        return view('livewire.components.searchbar2');
    }
}