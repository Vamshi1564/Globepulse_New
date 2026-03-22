<?php
// FILE: app/Livewire/Seller/ProductAdd.php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\Product;
use App\Models\Productgallery;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductAdd extends Component
{
    use WithFileUploads;

    // ── Basic Info ────────────────────────────────────────────
    public $title           = '';
    public $description     = '';  // rich text via JS editor
    public $brand_name      = '';  // NEW — for brand store page
    public $keywords        = '';

    // ── Category ─────────────────────────────────────────────
    public $category_id         = '';
    public $subcategory_id      = '';
    public $sub_subcategory_id  = '';
    public $subcategories       = [];
    public $sub_subcategories   = [];

    // ── Images ───────────────────────────────────────────────
    public $product_img;
    public $gallery_images      = [];
    public $new_gallery_images  = [];
    public $product_video_url   = '';

    // ── Pricing ───────────────────────────────────────────────
    // price_type: 'range' (min-max) | 'fixed' | 'negotiable' | 'quote'
    public $price_type     = 'range';
    public $min_price      = '';
    public $max_price      = '';
    public $fixed_price    = '';
    public $unit           = 'Piece';
    public $min_order      = '';
    public $HSN            = '';
    public $business_type  = '';

    // ── Trade Details ─────────────────────────────────────────
    public $supply_ability   = '';
    public $lead_time        = '';
    public $payment_terms    = '';
    public $port_of_dispatch = '';
    public $country_of_origin = 'India';

    // ── Specifications ────────────────────────────────────────
    public $certifications     = '';
    public $packaging_details  = '';
    public $sample_available   = 'no';
    public $sample_price       = '';

    // ── Documents (multiple — brochure, spec sheet, etc.) ─────
    public $documents          = [];   // uploaded file objects
    public $new_document       = null; // temp upload slot
    public $document_label     = '';   // e.g. "Brochure", "Spec Sheet"
    public $document_list      = [];   // [{label, file}] collected before submit

    // ── SEO ───────────────────────────────────────────────────
    public $seo_title       = '';
    public $seo_description = '';
    public $seo_keywords    = '';

    // ── Slug (auto-generated) ─────────────────────────────────
    public $slug = '';

    // ── Step state ────────────────────────────────────────────
    public int $activeStep = 1;
    public int $totalSteps = 4;

    // ─────────────────────────────────────────────────────────
    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.product-add', compact('categories'));
    }

    public function updatedCategoryId($val)
    {
        $this->subcategories      = Subcategory::where('category_id', $val)->get();
        $this->subcategory_id     = null;
        $this->sub_subcategories  = [];
        $this->sub_subcategory_id = null;
    }

    public function updatedSubcategoryId($val)
    {
        $this->sub_subcategories  = SubSubCategory::where('subcategory_id', $val)->get();
        $this->sub_subcategory_id = null;
    }

    public function updatedNewGalleryImages()
    {
        foreach ($this->new_gallery_images as $img) {
            $this->gallery_images[] = $img;
        }
        $this->new_gallery_images = [];
    }

    // ── Add document to list ──────────────────────────────────
    public function addDocument()
    {
        if ($this->new_document && $this->document_label) {
            $this->document_list[] = [
                'label' => $this->document_label,
                'file'  => $this->new_document,
            ];
            $this->reset(['new_document', 'document_label']);
        }
    }

    public function removeDocument(int $index): void
    {
        array_splice($this->document_list, $index, 1);
    }

    // ── Step navigation ───────────────────────────────────────
    // Steps navigate freely — NO validation on continue
    // All validation happens only on final submit
    public function nextStep()
    {
        if ($this->activeStep < $this->totalSteps) {
            $this->activeStep++;
        }
    }

    public function prevStep()
    {
        if ($this->activeStep > 1) {
            $this->activeStep--;
        }
    }

    public function goToStep(int $step)
    {
        // Allow jumping to any step freely
        if ($step >= 1 && $step <= $this->totalSteps) {
            $this->activeStep = $step;
        }
    }

    // ── Save as Draft (no validation, just save) ─────────────
    public function saveDraft()
    {
        try {
            $customerId = Session::get('id');
            $customer   = Customer::find($customerId);

            if (!$customer) {
                session()->flash('error', 'Session expired. Please login again.');
                return;
            }

            // Auto-generate slug if not set
            if (empty($this->slug) && !empty($this->title)) {
                $this->slug = \Illuminate\Support\Str::slug($this->title) . '-' . rand(100, 999999);
            } elseif (empty($this->slug)) {
                $this->slug = 'draft-' . $customerId . '-' . time();
            }

            // Upload main image if provided
            $imagePath = null;
            if ($this->product_img && is_object($this->product_img)) {
                $ext        = $this->product_img->getClientOriginalExtension();
                $baseName   = \Illuminate\Support\Str::slug(pathinfo($this->product_img->getClientOriginalName(), PATHINFO_FILENAME));
                $uniqueName = $baseName . '-' . rand(1000, 999999) . '.' . $ext;
                $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
                $imagePath  = 'uploads/product/' . $uniqueName;
            }

            // Determine prices
            $minPrice = $this->price_type === 'range' ? ($this->min_price ?: 0)
                      : ($this->price_type === 'fixed' ? ($this->fixed_price ?: 0) : 0);
            $maxPrice = $this->price_type === 'range' ? ($this->max_price ?: 0)
                      : ($this->price_type === 'fixed' ? ($this->fixed_price ?: 0) : 0);

            $product = Product::create([
                'title'             => $this->title          ?: 'Untitled Draft',
                'description'       => $this->description    ?: '',
                'product_img'       => $imagePath            ?: '',
                'category_id'       => $this->category_id   ?: null,
                'subcategory_id'    => $this->subcategory_id ?: null,
                'sub_subcategory_id'=> $this->sub_subcategory_id ?: null,
                'min_price'         => $minPrice,
                'max_price'         => $maxPrice,
                'min_order'         => $this->min_order      ?: null,
                'unit'              => $this->unit,
                'business_type'     => $this->business_type  ?: null,
                'slug'              => $this->slug,
                'HSN'               => $this->HSN             ?: null,
                'customer_id'       => $customerId,
                'country_id'        => $customer->country_id ?? null,
                'status'            => 3, // 3 = draft (not visible to buyers)
                'brand_name'        => $this->brand_name        ?: null,
                'keywords'          => $this->keywords           ?: null,
                'supply_ability'    => $this->supply_ability     ?: null,
                'lead_time'         => $this->lead_time          ?: null,
                'certifications'    => $this->certifications     ?: null,
                'packaging_details' => $this->packaging_details  ?: null,
                'sample_available'  => $this->sample_available   ?: 'no',
                'sample_price'      => $this->sample_price       ?: null,
                'product_video_url' => $this->product_video_url  ?: null,
                'seo_title'         => $this->seo_title          ?: null,
                'seo_description'   => $this->seo_description    ?: null,
                'seo_keywords'      => $this->seo_keywords        ?: null,
            ]);

            // Upload gallery if any
            foreach ($this->gallery_images as $gi) {
                try {
                    $gName = \Illuminate\Support\Str::slug(pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME));
                    $gExt  = $gi->getClientOriginalExtension();
                    $gFile = $gName . '-' . rand(1000, 999999) . '.' . $gExt;
                    $gi->storeAs('public/uploads/gallery', $gFile, 's3');
                    Productgallery::create([
                        'product_id'     => $product->id,
                        'gallery_images' => 'uploads/gallery/' . $gFile,
                        'customer_id'    => $customerId,
                    ]);
                } catch (\Exception $e) {}
            }

            $this->reset();
            return redirect()->route('my-listings')
                ->with('message', '📝 Product saved as draft. You can publish it anytime from My Listings.');

        } catch (\Exception $e) {
            session()->flash('error', 'Could not save draft: ' . $e->getMessage());
        }
    }

    // ── Final submit ──────────────────────────────────────────
    public function submit()
    {
        // Reset to step 1 if basic fields missing, step 3 if pricing missing
        // This way seller sees exactly where the error is
        try {
        // ── Validate all required fields at submit ────────────
        $this->validate([
            'title'          => 'required|string|min:5|max:255',
            'description'    => 'required|string|min:20',
            'category_id'    => 'required',
            'subcategory_id' => 'required',
            'product_img'    => 'required|image|mimes:webp,jpg,jpeg,png|max:4096',
            'price_type'     => 'required|in:range,fixed,negotiable,quote',
            'min_price'      => 'required_if:price_type,range|nullable|numeric|min:0',
            'max_price'      => 'required_if:price_type,range|nullable|numeric|gte:min_price',
            'fixed_price'    => 'required_if:price_type,fixed|nullable|numeric|min:0',
            'unit'           => 'required|string',
            'min_order'      => 'required|string|max:100',
            'business_type'  => 'required|string',
            'HSN'            => 'required|string|max:20',
            'sample_available' => 'required|in:yes,no',
            'product_video_url'=> 'nullable|url|max:500',
            'seo_title'      => 'nullable|string|max:255',
        ], [
            'title.required'              => 'Product title is required.',
            'title.min'                   => 'Title must be at least 5 characters.',
            'description.required'        => 'Product description is required.',
            'description.min'             => 'Description must be at least 20 characters.',
            'category_id.required'        => 'Please select a category.',
            'subcategory_id.required'     => 'Please select a sub category.',
            'product_img.required'        => 'Please upload a main product image.',
            'min_price.required_if'       => 'Min price is required for price range.',
            'max_price.required_if'       => 'Max price is required for price range.',
            'fixed_price.required_if'     => 'Please enter the fixed price.',
            'unit.required'               => 'Please select a unit.',
            'min_order.required'          => 'Minimum order quantity is required.',
            'business_type.required'      => 'Please select your business type.',
            'HSN.required'                => 'HSN/SAC code is required.',
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Auto-navigate to the step that has errors
            $errors = $e->errors();
            if (array_intersect_key($errors, array_flip(['title','description','category_id','subcategory_id','sub_subcategory_id']))) {
                $this->activeStep = 1;
            } elseif (array_intersect_key($errors, array_flip(['product_img']))) {
                $this->activeStep = 2;
            } elseif (array_intersect_key($errors, array_flip(['min_price','max_price','fixed_price','unit','min_order','business_type','HSN']))) {
                $this->activeStep = 3;
            }
            throw $e; // Re-throw so Livewire shows the errors
        }

        try {
            $customerId = Session::get('id');
            $customer   = $customerId ? Customer::find($customerId) : null;

            // Fallback: resolve customer from seller_email session (new seller system)
            if (!$customer && Session::get('seller_email')) {
                $customer   = Customer::where('email', Session::get('seller_email'))->first();
                $customerId = $customer?->id;
                if ($customerId) Session::put('id', $customerId);
            }

            // New seller system uses subscription plans, not package_id
            // Check subscription plan product limit instead
            $sellerId = Session::get('seller_id');
            if ($sellerId) {
                $sub = \App\Models\SellerSubscription::where('seller_id', $sellerId)
                    ->where('status', 'active')->first();
                $maxProducts = $sub?->max_products ?? 10; // free plan default
                $existingProducts = Product::where('customer_id', $customerId)->count();
                if ($maxProducts !== null && $existingProducts >= $maxProducts) {
                    session()->flash('error', 'You have reached your plan product limit. Upgrade to add more.');
                    return;
                }
            } elseif ($customer) {
                // Legacy GFE system: use package_id check
                $existingProducts = Product::where('customer_id', $customerId)->count();
                $productLimit = !empty($customer->product_upload_limit)
                    ? $customer->product_upload_limit
                    : 999; // no limit if no package system
                if ($existingProducts >= $productLimit) {
                    session()->flash('error', 'You have reached your product upload limit.');
                    return;
                }
            }

            // Upload main image
            $ext        = $this->product_img->getClientOriginalExtension();
            $baseName   = Str::slug(pathinfo($this->product_img->getClientOriginalName(), PATHINFO_FILENAME));
            $uniqueName = $baseName . '-' . rand(1000, 999999) . '.' . $ext;
            $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
            $imagePath = 'uploads/product/' . $uniqueName;

            // Auto-generate slug
            $slug = Str::slug($this->title) . '-' . rand(100, 999999);

            // Determine price values
            $minPrice = $this->price_type === 'range' ? $this->min_price
                      : ($this->price_type === 'fixed' ? $this->fixed_price : 0);
            $maxPrice = $this->price_type === 'range' ? $this->max_price
                      : ($this->price_type === 'fixed' ? $this->fixed_price : 0);

            $product = Product::create([
                'title'             => $this->title,
                'description'       => $this->description,
                'product_img'       => $imagePath,
                'category_id'       => $this->category_id,
                'subcategory_id'    => $this->subcategory_id,
                'sub_subcategory_id'=> $this->sub_subcategory_id,
                'min_price'         => $minPrice,
                'max_price'         => $maxPrice,
                'min_order'         => $this->min_order,
                'unit'              => $this->unit,
                'business_type'     => $this->business_type,
                'slug'              => $slug,
                'HSN'               => $this->HSN,
                'customer_id'       => $customerId,
                'country_id'        => $customer->country_id,
                'status'            => 0,
                'seo_title'         => $this->seo_title   ?: $this->title,
                'seo_description'   => $this->seo_description ?: null,
                'seo_keywords'      => $this->seo_keywords ?: $this->keywords,
                // B2B fields
                'brand_name'        => $this->brand_name        ?: null,
                'keywords'          => $this->keywords           ?: null,
                'supply_ability'    => $this->supply_ability     ?: null,
                'lead_time'         => $this->lead_time          ?: null,
                'payment_terms'     => $this->payment_terms      ?: null,
                'port_of_dispatch'  => $this->port_of_dispatch   ?: null,
                'country_of_origin' => $this->country_of_origin  ?: 'India',
                'product_video_url' => $this->product_video_url  ?: null,
                'certifications'    => $this->certifications     ?: null,
                'packaging_details' => $this->packaging_details  ?: null,
                'sample_available'  => $this->sample_available,
                'sample_price'      => $this->sample_available === 'yes' ? ($this->sample_price ?: null) : null,
            ]);

            // Upload gallery images
            foreach ($this->gallery_images as $gi) {
                $gName = Str::slug(pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME));
                $gExt  = $gi->getClientOriginalExtension();
                $gFile = $gName . '-' . rand(1000, 999999) . '.' . $gExt;
                $gi->storeAs('public/uploads/gallery', $gFile, 's3');
                Productgallery::create([
                    'product_id'     => $product->id,
                    'gallery_images' => 'uploads/gallery/' . $gFile,
                    'customer_id'    => $customerId,
                ]);
            }

            // Upload documents (brochure, spec sheet, etc.)
            foreach ($this->document_list as $doc) {
                if (!empty($doc['file'])) {
                    $dExt  = $doc['file']->getClientOriginalExtension();
                    $dName = Str::slug($doc['label']) . '-' . rand(1000, 999999) . '.' . $dExt;
                    $doc['file']->storeAs('public/uploads/product-docs', $dName, 's3');
                    // Store in product_documents table if it exists, otherwise skip
                    try {
                        \App\Models\ProductDocument::create([
                            'product_id'  => $product->id,
                            'customer_id' => $customerId,
                            'label'       => $doc['label'],
                            'file_path'   => 'uploads/product-docs/' . $dName,
                            'file_ext'    => $dExt,
                        ]);
                    } catch (\Exception $e) {
                        // Table may not exist yet — skip silently
                    }
                }
            }

            $this->reset();
            return redirect()->route('my-listings')
                ->with('message', '✅ Product submitted for review! Goes live once approved by admin.');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title) . '-' . rand(100, 999999999);
    }
}