<?php
// FILE: app/Livewire/Seller/ServiceAdd.php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Customer;
use App\Models\SellerService;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceAdd extends Component
{
    use WithFileUploads;

    // ── Step state (4 steps like ProductAdd) ─────────────────
    public int $activeStep = 1;
    public int $totalSteps = 4;

    // ── Step 1: Basic Info ────────────────────────────────────
    public $title       = '';
    public $description = '';
    public $keywords    = '';

    // ── Step 2: Media ─────────────────────────────────────────
    public $cover_image;
    public $gallery_images     = [];
    public $new_gallery_images = [];
    public $video_url          = '';
    public $brochure_pdf;

    // ── Step 3: Pricing & Delivery ───────────────────────────
    public $price               = '';
    public $price_unit          = 'per project';
    public $pricing_model       = '';
    public $delivery_mode       = 'Both';
    public $turnaround_time     = '';
    public $service_area        = '';
    public $payment_terms       = '';
    public $sample_consultation = 'no';

    // ── Step 4: Specs & Category ──────────────────────────────
    public $category_id          = '';
    public $subcategory_id       = '';
    public $sub_subcategory_id   = '';
    public $subcategories        = [];
    public $sub_subcategories    = [];
    public $service_type         = '';
    public $contract_duration    = '';
    public $business_type_target = '';
    public array $industries_served = [];
    public $experience_years     = '';
    public $certifications       = '';

    // ── UI state ──────────────────────────────────────────────
    public string $alertMessage = '';
    public string $alertType    = '';

    // ─────────────────────────────────────────────────────────
    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.service-add', compact('categories'));
    }

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

    public function updatedNewGalleryImages()
    {
        foreach ($this->new_gallery_images as $img) {
            $this->gallery_images[] = $img;
        }
        $this->new_gallery_images = [];
    }

    public function removeGalleryImage(int $index): void
    {
        array_splice($this->gallery_images, $index, 1);
    }

    // ── Step navigation ───────────────────────────────────────
    public function nextStep()
    {
        $this->validateCurrentStep();
        if ($this->activeStep < $this->totalSteps) $this->activeStep++;
    }

    public function prevStep()
    {
        if ($this->activeStep > 1) $this->activeStep--;
    }

    public function goToStep(int $step)
    {
        if ($step < $this->activeStep) $this->activeStep = $step;
    }

    private function validateCurrentStep(): void
    {
        match ($this->activeStep) {
            1 => $this->validate([
                    'title'       => 'required|string|min:3|max:255',
                    'description' => 'nullable|string',
                    'keywords'    => 'nullable|string|max:500',
                ], [
                    'title.required' => 'Service name is required.',
                    'title.min'      => 'Name must be at least 3 characters.',
                ]),

            2 => $this->validate([
                    'cover_image'    => 'nullable|image|mimes:jpg,jpeg,webp,png|max:4096',
                    'gallery_images' => 'nullable|array|max:9',
                    'video_url'      => 'nullable|url|max:500',
                    'brochure_pdf'   => 'nullable|file|mimes:pdf|max:10240',
                ], [
                    'cover_image.max'    => 'Cover image must be under 4MB.',
                    'brochure_pdf.max'   => 'PDF must be under 10MB.',
                    'brochure_pdf.mimes' => 'Brochure must be a PDF file.',
                ]),

            3 => $this->validate([
                    'price' => 'nullable|numeric|min:0',
                ]),

            default => null,
        };
    }

    // ── Resolve customer ID ───────────────────────────────────
    // Supports both old (session 'id') and new (session 'seller_id' + 'seller_email')
    private function resolveCustomerId(): mixed
    {
        // New seller system
        if (Session::get('seller_id') && Session::get('seller_email')) {
            $customer = Customer::where('email', Session::get('seller_email'))->first();
            if ($customer) {
                Session::put('id', $customer->id);
                return $customer->id;
            }
        }
        return Session::get('id')
            ?? Session::get('customer_id')
            ?? (auth()->check() ? auth()->id() : null);
    }

    // ── Upload image ──────────────────────────────────────────
    private function uploadImage($file): ?string
    {
        if (!$file) return null;
        try {
            $ext      = $file->getClientOriginalExtension();
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        . '-' . time() . '-' . rand(100, 9999) . '.' . $ext;
            try {
                $file->storeAs('public/uploads/services', $filename, 's3');
                Log::info('[ServiceAdd] Image uploaded to S3: uploads/services/' . $filename);
            } catch (\Exception $e) {
                // S3 failed — fall back to local public disk
                Log::warning('[ServiceAdd] S3 upload FAILED, using local disk. Error: ' . $e->getMessage());
                Storage::disk('public')->put('uploads/services/' . $filename, file_get_contents($file->getRealPath()));
            }
            return 'uploads/services/' . $filename;
        } catch (\Exception $e) {
            Log::warning('[ServiceAdd] uploadImage completely failed: ' . $e->getMessage());
            return null;
        }
    }

    // ── Upload PDF ────────────────────────────────────────────
    private function uploadPdf($file): ?string
    {
        if (!$file) return null;
        try {
            $filename     = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                            . '-' . time() . '-' . rand(100, 9999) . '.pdf';
            $s3Folder     = 'public/uploads/services/pdf';
            $returnFolder = 'uploads/services/pdf';
            try {
                Storage::disk('s3')->putFileAs($s3Folder, $file->getRealPath(), $filename);
                Log::info('[ServiceAdd] PDF uploaded to S3: ' . $returnFolder . '/' . $filename);
            } catch (\Exception $e) {
                Log::warning('[ServiceAdd] S3 PDF upload FAILED, using local disk. Error: ' . $e->getMessage());
                Storage::disk('public')->putFileAs('uploads/services/pdf', $file->getRealPath(), $filename);
            }
            return $returnFolder . '/' . $filename;
        } catch (\Exception $e) {
            Log::error('[ServiceAdd] uploadPdf completely failed: ' . $e->getMessage());
            return null;
        }
    }

    // ── Build DB data array ───────────────────────────────────
    private function buildData(int $customerId, string $status, ?string $coverPath = null, array $galleryPaths = [], ?string $pdfPath = null): array
    {
        $pricingType = match ($this->pricing_model) {
            'Hourly'           => 'hourly',
            'Monthly Retainer' => 'fixed',
            'Project Based'    => 'fixed',
            default            => 'quote_based',
        };

        return [
            'customer_id'         => $customerId,
            'title'               => trim($this->title) ?: 'Draft - ' . now()->format('d M H:i'),
            'slug'                => Str::slug($this->title ?: 'draft') . '-' . $customerId . '-' . rand(100, 99999),
            'description'         => $this->description      ?: null,
            'service_type'        => $this->service_type     ?: null,
            'category_id'         => $this->category_id      ?: null,
            'subcategory_id'      => $this->subcategory_id   ?: null,
            'sub_subcategory_id'  => $this->sub_subcategory_id ?: null,
            'keywords'            => $this->keywords          ?: null,
            'pricing_type'        => $pricingType,
            'min_price'           => is_numeric($this->price) ? $this->price : null,
            'max_price'           => is_numeric($this->price) ? $this->price : null,
            'price_unit'          => $this->price_unit        ?: $this->pricing_model ?: null,
            'delivery_mode'       => $this->delivery_mode     ?: null,
            'turnaround_time'     => $this->turnaround_time   ?: null,
            'service_area'        => $this->service_area      ?: null,
            'payment_terms'       => $this->payment_terms     ?: null,
            'sample_consultation' => $this->sample_consultation,
            'certifications'      => $this->certifications    ?: null,
            'experience_years'    => $this->experience_years  ?: null,
            'cover_image'         => $coverPath,
            'portfolio_images'    => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'video_url'           => $this->video_url         ?: null,
            'status'              => $status,
            'inclusions'          => json_encode([
                'pricing_model'        => $this->pricing_model,
                'contract_duration'    => $this->contract_duration,
                'business_type_target' => $this->business_type_target,
                'industries_served'    => $this->industries_served,
                'brochure_pdf'         => $pdfPath,
            ]),
        ];
    }

    // ── Save as Draft ─────────────────────────────────────────
    public function saveDraft(): void
    {
        $this->alertMessage = '';

        if (empty(trim($this->title))) {
            $this->alertMessage = 'Please enter a service name to save as draft.';
            $this->alertType    = 'error';
            $this->activeStep   = 1;
            return;
        }

        $customerId = $this->resolveCustomerId();
        if (!$customerId) {
            $this->alertMessage = 'Session expired. Please log in again.';
            $this->alertType    = 'error';
            return;
        }

        try {
            $coverPath    = $this->cover_image  ? $this->uploadImage($this->cover_image)  : null;
            $pdfPath      = $this->brochure_pdf ? $this->uploadPdf($this->brochure_pdf)   : null;
            $galleryPaths = [];
            foreach ($this->gallery_images as $gi) {
                $p = $this->uploadImage($gi);
                if ($p) $galleryPaths[] = $p;
            }

            SellerService::create($this->buildData($customerId, 'draft', $coverPath, $galleryPaths, $pdfPath));

            $this->reset();
            redirect()->route('my-listings')
                ->with('message', '📝 Service saved as draft. Publish anytime from My Listings.');

        } catch (\Exception $e) {
            $this->alertMessage = 'Could not save draft: ' . $e->getMessage();
            $this->alertType    = 'error';
            Log::error('[ServiceAdd] saveDraft: ' . $e->getMessage());
        }
    }

    // ── Submit ────────────────────────────────────────────────
    public function submit(): void
    {
        $this->alertMessage = '';

        try {
            $this->validate([
                'title'        => 'required|string|min:3|max:255',
                'video_url'    => 'nullable|url|max:500',
                'brochure_pdf' => 'nullable|file|mimes:pdf|max:10240',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->activeStep = 1;
            throw $e;
        }

        $customerId = $this->resolveCustomerId();
        if (!$customerId) {
            $this->alertMessage = 'Session expired. Please log in again.';
            $this->alertType    = 'error';
            return;
        }

        // Duplicate check
        if (SellerService::where('customer_id', $customerId)
            ->where('title', trim($this->title))
            ->where('status', '!=', 'draft')
            ->exists()) {
            $this->alertMessage = '⚠️ You already have a service with this name.';
            $this->alertType    = 'error';
            return;
        }

        try {
            $coverPath    = $this->uploadImage($this->cover_image);
            $pdfPath      = $this->uploadPdf($this->brochure_pdf);
            $galleryPaths = [];
            foreach ($this->gallery_images as $gi) {
                $p = $this->uploadImage($gi);
                if ($p) $galleryPaths[] = $p;
            }

            $service = SellerService::create(
                $this->buildData($customerId, 'pending', $coverPath, $galleryPaths, $pdfPath)
            );

            if (!$service?->exists) {
                $this->alertMessage = 'Service could not be saved. Please try again.';
                $this->alertType    = 'error';
                return;
            }

            $this->reset();
            redirect()->route('my-listings')
                ->with('message', '✅ Service submitted for review! Goes live once approved by admin.');

        } catch (\Illuminate\Database\QueryException $dbEx) {
            $this->alertMessage = 'Database error: ' . $dbEx->getMessage();
            $this->alertType    = 'error';
        } catch (\Exception $e) {
            $this->alertMessage = 'Something went wrong: ' . $e->getMessage();
            $this->alertType    = 'error';
        }
    }
}