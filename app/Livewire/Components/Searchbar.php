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

        } elseif ($this->searchType === 'service') {

            $services = DB::table('seller_services')
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
                    'type' => 'Service',
                    'url'  => url('/service-detail/' . $r->slug),
                ])
                ->values()
                ->toArray();

            // $serviceCategories = DB::table('tbl_service_category')
            //     ->where('cat_name', 'LIKE', $q)
            //     ->where('status', 1)
            //     ->whereNotNull('slug')
            //     ->where('slug', '!=', '')
            //     ->whereNotNull('cat_name')
            //     ->where('cat_name', '!=', '')
            //     ->limit(4)
            //     ->get(['id', 'cat_name', 'slug'])
            //     ->map(fn($r) => [
            //         'name' => (string) $r->cat_name,
            //         'type' => 'Service Category',
            //         'url'  => url('/services-category/' . $r->slug),
            //     ])
            //     ->values()
            //     ->toArray();

            $this->suggestions = array_values(array_merge($services));

        } elseif ($this->searchType === 'buyer') {

            // ✅ Shows buyer names in dropdown → redirects to /buyer_info/{id}
            $this->suggestions = DB::table('buyers')
                ->where('is_active', 1)
                ->where(function ($query) use ($q) {
                    $query->where('full_name', 'LIKE', $q)
                          ->orWhere('company_name', 'LIKE', $q)
                          ->orWhere('email', 'LIKE', $q);
                })
                ->whereNotNull('full_name')
                ->where('full_name', '!=', '')
                ->limit(10)
                ->get(['id', 'full_name', 'company_name', 'email'])
                ->map(fn($r) => [
                    'name' => (string) ($r->company_name ?: $r->full_name),
                    'type' => 'Buyer',
                    'url'  => url('/buyer_info/' . $r->id),  // ✅ redirects to buyer info page
                ])
                ->values()
                ->toArray();

        } elseif ($this->searchType === 'seller') {

            // ✅ Shows seller names in dropdown → redirects to seller's products page
            $this->suggestions = DB::table('sellers')
                ->where('is_active', 1)
                ->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', $q)
                          ->orWhere('company', 'LIKE', $q)
                          ->orWhere('email', 'LIKE', $q);
                })
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->limit(10)
                ->get(['id', 'name', 'company', 'email'])
                ->map(fn($r) => [
                    'name' => (string) ($r->company ?: $r->name),  // ✅ shows seller name in dropdown
                    'type' => 'Seller',
                    'url'  => url('/products?seller_id=' . $r->id),  // ✅ redirects to seller's products
                ])
                ->values()
                ->toArray();

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

        match ($this->searchType) {
            'seller' => $this->redirect(url('/products?seller_search=' . urlencode($this->searchTerm))),
            'buyer'  => $this->redirect(url('/buyer_info?q=' . urlencode($this->searchTerm))),
            default  => $this->redirect(url('/products?q=' . urlencode($this->searchTerm) . '&type=' . $this->searchType)),
        };
    }

    public function render()
    {
        return view('livewire.components.searchbar2');
    }
}