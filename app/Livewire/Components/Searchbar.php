<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Searchbar extends Component
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

            // By title
            $byTitle = DB::table('tbl_products')
                ->where('status', 1)
                ->where('title', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->whereNotNull('title')->where('title', '!=', '')
                ->limit(5)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Product',
                    'url'  => url('/product-detail/' . $r->slug),
                ])->values()->toArray();

            // By keywords
            $byKeyword = DB::table('tbl_products')
                ->where('status', 1)
                ->where('keywords', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->whereNotNull('title')->where('title', '!=', '')
                ->limit(3)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Product',
                    'url'  => url('/product-detail/' . $r->slug),
                ])->values()->toArray();

            // By tbl_category → cat_name
            $catIds = DB::table('tbl_category')
                ->where('status', 1)
                ->where('cat_name', 'LIKE', $q)
                ->pluck('id');

            $byCategory = DB::table('tbl_products')
                ->where('status', 1)
                ->whereIn('category_id', $catIds)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(3)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Product',
                    'url'  => url('/product-detail/' . $r->slug),
                ])->values()->toArray();

            // Also show matching category names directly
            $categoryDirect = DB::table('tbl_category')
                ->where('status', 1)
                ->where('cat_name', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(3)
                ->get(['id', 'cat_name', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->cat_name,
                    'type' => 'Category',
                    'url'  => url('/products-category/' . $r->slug),
                ])->values()->toArray();

            // By tbl_subcategory → sub_cat_name
            $subCatIds = DB::table('tbl_subcategory')
                ->where('status', 1)
                ->where('sub_cat_name', 'LIKE', $q)
                ->pluck('id');

            $bySubCategory = DB::table('tbl_products')
                ->where('status', 1)
                ->whereIn('subcategory_id', $subCatIds)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(2)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Product',
                    'url'  => url('/product-detail/' . $r->slug),
                ])->values()->toArray();

            // By tbl_sub_subcategory → sub_subcat_name
            $subSubCatIds = DB::table('tbl_sub_subcategory')
                ->where('status', 1)
                ->where('sub_subcat_name', 'LIKE', $q)
                ->pluck('id');

            $bySubSubCategory = DB::table('tbl_products')
                ->where('status', 1)
                ->whereIn('sub_subcategory_id', $subSubCatIds)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(2)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Product',
                    'url'  => url('/product-detail/' . $r->slug),
                ])->values()->toArray();

            // Merge, deduplicate by url, limit 10
            $this->suggestions = $this->deduplicateAndLimit(
                array_merge($byTitle, $byKeyword, $categoryDirect, $byCategory, $bySubCategory, $bySubSubCategory),
                10
            );

        } elseif ($this->searchType === 'service') {

           // By title — FIXED: removed potentially mismatched status filter to test
$byTitle = DB::table('seller_services')
    ->where('title', 'LIKE', $q)
    ->whereNotNull('slug')->where('slug', '!=', '')
    ->whereNotNull('title')->where('title', '!=', '')
    ->limit(5)
    ->get(['id', 'title', 'slug'])
    ->map(fn($r) => [
        'name' => (string) $r->title,
        'type' => 'Service',
        'url'  => url('/service-detail/' . $r->slug),
    ])->values()->toArray();

            // By keywords
            $byKeyword = DB::table('seller_services')
                ->where('status', 1)
                ->where('keywords', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(3)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Service',
                    'url'  => url('/service-detail/' . $r->slug),
                ])->values()->toArray();

            // By service_type
            $byServiceType = DB::table('seller_services')
                ->where('status', 1)
                ->where('service_type', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(3)
                ->get(['id', 'title', 'slug', 'service_type'])
                ->map(fn($r) => [
                    'name' => (string) $r->title . ' (' . $r->service_type . ')',
                    'type' => 'Service',
                    'url'  => url('/service-detail/' . $r->slug),
                ])->values()->toArray();

            // By categories table → name column
            $catIds = DB::table('categories')
                ->where('name', 'LIKE', $q)
                ->pluck('id');

            $byCategory = DB::table('seller_services')
                ->where('status', 1)
                ->whereIn('category_id', $catIds)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(3)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Service',
                    'url'  => url('/service-detail/' . $r->slug),
                ])->values()->toArray();

            // Also show matching category names directly
            $categoryDirect = DB::table('categories')
                ->where('name', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(3)
                ->get(['id', 'name', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->name,
                    'type' => 'Service Category',
                    'url'  => url('/services-category/' . $r->slug),
                ])->values()->toArray();

            // By tbl_subcategory → sub_cat_name
            $subCatIds = DB::table('tbl_subcategory')
                ->where('status', 1)
                ->where('sub_cat_name', 'LIKE', $q)
                ->pluck('id');

            $bySubCategory = DB::table('seller_services')
                ->where('status', 1)
                ->whereIn('subcategory_id', $subCatIds)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(2)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Service',
                    'url'  => url('/service-detail/' . $r->slug),
                ])->values()->toArray();

            // By tbl_sub_subcategory → sub_subcat_name
            $subSubCatIds = DB::table('tbl_sub_subcategory')
                ->where('status', 1)
                ->where('sub_subcat_name', 'LIKE', $q)
                ->pluck('id');

            $bySubSubCategory = DB::table('seller_services')
                ->where('status', 1)
                ->whereIn('sub_subcategory_id', $subSubCatIds)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->limit(2)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Service',
                    'url'  => url('/service-detail/' . $r->slug),
                ])->values()->toArray();

            $this->suggestions = $this->deduplicateAndLimit(
                array_merge($byTitle, $byKeyword, $byServiceType, $categoryDirect, $byCategory, $bySubCategory, $bySubSubCategory),
                10
            );

        } elseif ($this->searchType === 'buyer') {

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
                    'url'  => url('/buyer_info/' . $r->id),
                ])->values()->toArray();

        } elseif ($this->searchType === 'seller') {

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
                    'name' => (string) ($r->company ?: $r->name),
                    'type' => 'Seller',
                    'url'  => url('/products?seller_id=' . $r->id),
                ])->values()->toArray();

        } elseif ($this->searchType === 'buylead') {

            $this->suggestions = DB::table('tbl_buyleads')
                ->where('title', 'LIKE', $q)
                ->whereNotNull('slug')->where('slug', '!=', '')
                ->whereNotNull('title')->where('title', '!=', '')
                ->limit(8)
                ->get(['id', 'title', 'slug'])
                ->map(fn($r) => [
                    'name' => (string) $r->title,
                    'type' => 'Buy Lead',
                    'url'  => url('/buylead/' . $r->slug),
                ])->values()->toArray();
        }

        $this->dispatch('suggestionsUpdated');
    }

    // ✅ Helper: remove duplicate URLs and limit results
    private function deduplicateAndLimit(array $items, int $limit = 10): array
    {
        $seen   = [];
        $unique = [];

        foreach ($items as $item) {
            if (!in_array($item['url'], $seen)) {
                $seen[]   = $item['url'];
                $unique[] = $item;
            }
            if (count($unique) >= $limit) break;
        }

        return array_values($unique);
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
            'buyer'  => $this->redirect(url('/buyer_info?q='           . urlencode($this->searchTerm))),
            default  => $this->redirect(url('/products?q='             . urlencode($this->searchTerm) . '&type=' . $this->searchType)),
        };
    }

    public function render()
    {
        return view('livewire.components.searchbar');
    }
}