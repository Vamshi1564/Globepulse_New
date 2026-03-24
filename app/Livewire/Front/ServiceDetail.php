<?php
// FILE: app/Livewire/Front/ServiceDetail.php

namespace App\Livewire\Front;

use App\Models\SellerService;
use Livewire\Component;

class ServiceDetail extends Component
{
    public $service;
    public $seller;
    public array  $inclusions     = [];
    public array  $galleryImages  = [];
    public array  $images         = [];   // all images (cover + gallery) for the slider
    public array  $similarServices = [];
    public ?string $brochurePdf   = null;

    public function mount(string $slug)
    {
        // Load service — show pending & approved (admin reviews before approving)
        $this->service = SellerService::where('slug', $slug)
            ->whereIn('status', ['pending', 'approved'])
            ->firstOrFail();

        // Seller info from sellers table (same gfe_global DB — default connection)
        $this->seller = \Illuminate\Support\Facades\DB::table('sellers')
            ->where('id', $this->service->customer_id)
            ->first();

        // Decode inclusions JSON
        if ($this->service->inclusions) {
            $decoded           = json_decode($this->service->inclusions, true) ?? [];
            $this->inclusions  = $decoded;
            $this->brochurePdf = $decoded['brochure_pdf'] ?? null;
        }

        // Build images array for slider (cover first, then gallery)
        $this->images = [];
        if (!empty($this->service->cover_image)) {
            $this->images[] = $this->service->cover_image;
        }
        if ($this->service->portfolio_images) {
            $gallery = json_decode($this->service->portfolio_images, true) ?? [];
            $this->images = array_merge($this->images, array_filter($gallery));
        }
        $this->galleryImages = $this->images;

        // Similar services — map to plain arrays so Livewire can serialize them
        // Blade accesses as $simService['slug'] etc. — updated in blade too
        $this->similarServices = SellerService::where('category_id', $this->service->category_id)
            ->where('status', 'approved')
            ->where('id', '!=', $this->service->id)
            ->limit(10)
            ->get()
            ->map(fn($s) => [
                'id'          => $s->id,
                'title'       => $s->title,
                'slug'        => $s->slug,
                'cover_image' => $s->cover_image,
                'min_price'   => $s->min_price,
                'price_unit'  => $s->price_unit,
                'service_type'=> $s->service_type,
            ])
            ->toArray();
    }

    // Smart image URL — S3 or local public storage
    public function imgUrl(?string $path): string
    {
        if (!$path) return '';
        if (str_starts_with($path, 'http')) return $path;
        $aws = config('app.pub_aws_url');
        return $aws
            ? rtrim($aws, '/') . '/' . ltrim($path, '/')
            : asset('storage/' . $path);
    }

    public function render()
    {
        return view('livewire.front.service-detail');
    }
}