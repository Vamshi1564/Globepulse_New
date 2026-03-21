<?php
// FILE: app/Livewire/Seller/ServiceAdd.php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\SellerService;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use App\Models\Customer;
use App\Models\ItemsModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceAdd extends Component
{
    use WithFileUploads;

    public int $activeTab = 1;

    // ── Tab 1: Basic Details ──────────────────────────────────
    public $title             = '';
    public $price             = '';
    public $price_unit        = '';
    public $description       = '';
    public $cover_image;
    public $gallery_images    = [];
    public $new_gallery_images= [];
    public $video_url         = '';
    public $brochure_pdf;

    // ── Tab 2: Specifications ─────────────────────────────────
    public $category_id          = '';
    public $subcategory_id       = '';
    public $sub_subcategory_id   = '';
    public $subcategories        = [];
    public $sub_subcategories    = [];

    public $service_type         = '';
    public $pricing_model        = '';
    public $contract_duration    = '';
    public $business_type_target = '';
    public array $industries_served = [];
    public $delivery_mode        = '';
    public $experience_years     = '';
    public $certifications       = '';
    public $keywords             = '';

    // ── Product score ─────────────────────────────────────────
    public function getProductScoreProperty(): int
    {
        $score = 0;
        if (strlen($this->title) >= 3)                          $score += 10;
        if ($this->price)                                       $score += 15;
        if (strlen(strip_tags($this->description ?? '')) > 100) $score += 20;
        if ($this->cover_image)                                 $score += 15;
        if (!empty($this->gallery_images))                      $score += 10;
        if ($this->video_url)                                   $score += 10;
        if ($this->brochure_pdf)                                $score += 5;
        if ($this->service_type)                                $score += 5;
        if ($this->pricing_model)                               $score += 5;
        if ($this->certifications)                              $score += 5;
        return min($score, 100);
    }

    public function getScoreColorProperty(): string
    {
        $s = $this->productScore;
        if ($s >= 70) return '#059669';
        if ($s >= 40) return '#f59e0b';
        return '#ef4444';
    }

    public function getScoreLabelProperty(): string
    {
        $s = $this->productScore;
        if ($s >= 70) return 'Good';
        if ($s >= 40) return 'Low';
        return 'Very Low';
    }

    // ── Toggle industry ───────────────────────────────────────
    public function toggleIndustry(string $industry): void
    {
        if (in_array($industry, $this->industries_served)) {
            $this->industries_served = array_values(
                array_filter($this->industries_served, fn($i) => $i !== $industry)
            );
        } else {
            $this->industries_served[] = $industry;
        }
    }

    // ── Render ────────────────────────────────────────────────
    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.service-add', compact('categories'));
    }

    // ── Category watchers ─────────────────────────────────────
    public function updatedCategoryId($val)
    {
        $this->subcategories      = Subcategory::where('category_id', $val)->get();
        $this->subcategory_id     = '';
        $this->sub_subcategories  = [];
        $this->sub_subcategory_id = '';
    }

    public function updatedSubcategoryId($val)
    {
        $this->sub_subcategories  = SubSubCategory::where('subcategory_id', $val)->get();
        $this->sub_subcategory_id = '';
    }

    // ── Gallery accumulator ───────────────────────────────────
    public function updatedNewGalleryImages()
    {
        foreach ($this->new_gallery_images as $img) {
            $this->gallery_images[] = $img;
        }
        $this->new_gallery_images = [];
    }

    // ── Tab 1 → Tab 2 ─────────────────────────────────────────
    public function saveAndContinue()
    {
        $this->validate([
            'title'       => 'required|string|min:3|max:255',
            'price'       => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,webp,png|max:4096',
            'video_url'   => 'nullable|url|max:500',
        ], [
            'title.required' => 'Service / Product name is required.',
            'title.min'      => 'Name must be at least 3 characters.',
        ]);

        $this->activeTab = 2;
    }

    // ── Final submit ──────────────────────────────────────────
    public function submit()
    {
        // ── 1. Validate ───────────────────────────────────────
        $this->validate([
            'title'       => 'required|string|min:3|max:255',
            'category_id' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,webp,png|max:4096',
            'video_url'   => 'nullable|url|max:500',
        ], [
            'title.required'    => 'Service name is required.',
            'category_id.required' => 'Please select a category.',
        ]);

        // ── 2. Auth & session guard ───────────────────────────
        // Try common session key variants used across different auth setups
        $customerId = Session::get('id')
            ?? Session::get('customer_id')
            ?? Session::get('user_id')
            ?? (auth()->check() ? auth()->id() : null);

        if (!$customerId) {
            session()->flash('error', 'Session expired. Please log in again.');
            return;
        }

        $customer = Customer::find($customerId);
        if (!$customer) {
            session()->flash('error', 'Account not found (ID: ' . $customerId . '). Please contact support.');
            return;
        }

        // ── 3. Package / limit check ──────────────────────────
        // Skip limit check if package system is not set up yet
        if ($customer->package_id && $customer->package_id != 0) {
            $existingCount = SellerService::where('customer_id', $customerId)
                ->whereNotIn('status', ['rejected'])
                ->count();

            $serviceLimit = $customer->product_upload_limit
                ?? optional(ItemsModel::find($customer->package_id))->product_limit
                ?? 0;

            if ($serviceLimit > 0 && $existingCount >= $serviceLimit) {
                session()->flash('error', 'You have reached your service listing limit for this package.');
                return;
            }
        }

        try {
            // ── 4. Upload cover image ─────────────────────────
            $coverPath = null;
            if ($this->cover_image) {
                $ext      = $this->cover_image->getClientOriginalExtension();
                $uname    = 'svc-' . $customerId . '-' . rand(1000, 999999) . '.' . $ext;
                $this->cover_image->storeAs('public/uploads/services', $uname, 's3');
                $coverPath = 'uploads/services/' . $uname;
            }

            // ── 5. Upload gallery images ──────────────────────
            $galleryPaths = [];
            foreach ($this->gallery_images as $gi) {
                try {
                    $ext   = $gi->getClientOriginalExtension();
                    $uname = 'svc-g-' . $customerId . '-' . rand(1000, 999999) . '.' . $ext;
                    $gi->storeAs('public/uploads/services', $uname, 's3');
                    $galleryPaths[] = 'uploads/services/' . $uname;
                } catch (\Exception $e) {
                    // Skip failed gallery uploads — don't abort the whole save
                }
            }

            // ── 6. Upload PDF brochure ────────────────────────
            $pdfPath = null;
            if ($this->brochure_pdf) {
                $ext   = $this->brochure_pdf->getClientOriginalExtension();
                $uname = 'svc-pdf-' . $customerId . '-' . rand(1000, 999999) . '.' . $ext;
                $this->brochure_pdf->storeAs('public/uploads/services', $uname, 's3');
                $pdfPath = 'uploads/services/' . $uname;
            }

            // ── 7. Derive slug ────────────────────────────────
            $slug = Str::slug($this->title) . '-' . $customerId . '-' . rand(100, 99999);

            // ── 8. Map pricing model → pricing_type ──────────
            $pricingType = match ($this->pricing_model) {
                'Hourly'           => 'hourly',
                'Monthly Retainer' => 'fixed',
                'Project Based'    => 'fixed',
                default            => 'quote_based',
            };

            // ── 9. Persist ────────────────────────────────────
            SellerService::create([
                'customer_id'        => $customerId,
                'title'              => $this->title,
                'slug'               => $slug,
                'description'        => $this->description ?: null,
                'service_type'       => $this->service_type ?: null,
                'category_id'        => $this->category_id ?: null,
                'subcategory_id'     => $this->subcategory_id ?: null,
                'sub_subcategory_id' => $this->sub_subcategory_id ?: null,
                'keywords'           => $this->keywords ?: null,
                'pricing_type'       => $pricingType,
                'min_price'          => $this->price ?: null,
                'max_price'          => $this->price ?: null,
                'price_unit'         => $this->price_unit ?: $this->pricing_model ?: null,
                'delivery_mode'      => $this->delivery_mode ?: null,
                'certifications'     => $this->certifications ?: null,
                'experience_years'   => $this->experience_years ?: null,
                'cover_image'        => $coverPath,
                'portfolio_images'   => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
                'video_url'          => $this->video_url ?: null,
                // Extra spec fields stored as JSON in inclusions
                'inclusions' => json_encode([
                    'pricing_model'        => $this->pricing_model,
                    'contract_duration'    => $this->contract_duration,
                    'business_type_target' => $this->business_type_target,
                    'industries_served'    => $this->industries_served,
                    'brochure_pdf'         => $pdfPath,
                ]),
                'status' => 'pending',
            ]);

            $this->reset();

            return redirect()->route('my-listings')
                ->with('message', '✅ Service listed successfully! Goes live once approved.');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}