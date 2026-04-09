<?php
// FILE: app/Livewire/Seller/ProductAdd.php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\PackagesModel;
use App\Models\Product;
use App\Models\Productgallery;
use App\Models\Seller;
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
    public $unit           = '';
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

    // ── Edit mode ─────────────────────────────────────────────
    public ?int  $editId            = null;
    public bool  $isEditMode        = false;
    public string $existingImagePath = '';  // saved product_img path for edit

    // ── Package limit ─────────────────────────────────────────
    public bool   $limitReached = false;
    public string $limitMessage = '';
    public int    $productCount = 0;
    public int    $productLimit = 0;

    // ─────────────────────────────────────────────────────────
    // FIX: Centralised, robust customer/seller resolver.
    // Previously submit() and saveDraft() only checked Session::get('id'),
    // while mount() also checked 'customer_id' and auth(). That mismatch
    // caused "Session expired" errors when session key was 'customer_id'
    // instead of 'id', or when Laravel auth was the active guard.
    // ─────────────────────────────────────────────────────────
    private function resolveCustomer(): array
    {
        $sellerId   = Session::get('seller_id');
        $customerId = Session::get('id')
                   ?? Session::get('customer_id')
                   ?? (auth()->check() ? auth()->id() : null);

        $customer = $customerId ? Customer::find($customerId) : null;

        // Fallback 1: new seller system stores email in session
        if (!$customer && Session::get('seller_email')) {
            $customer   = Customer::where('email', Session::get('seller_email'))->first();
            $customerId = $customer?->id;
            if ($customerId) Session::put('id', $customerId);
        }

        // Fallback 2: look up via seller record email
        if (!$customer && $sellerId) {
            $seller = Seller::find($sellerId);
            if ($seller?->email) {
                $customer   = Customer::where('email', $seller->email)->first();
                $customerId = $customer?->id;
                if ($customerId) Session::put('id', $customerId);
            }
        }

        // Fallback 3: if still no customer record in tblleads, use seller_id
        // so products are still saved with a non-null customer_id
        if (!$customerId && $sellerId) {
            $customerId = $sellerId;
        }

        return [$customerId, $customer, $sellerId];
    }

    // ─────────────────────────────────────────────────────────
    public function mount(): void
    {
        $editId = request()->query('edit');
        if (!$editId) return;

        [, $customer, ] = $this->resolveCustomer();   // use shared helper
        $customerId = $customer?->id;

        $product = Product::where('id', $editId)
            ->where('customer_id', $customerId)
            ->first();

        if (!$product) return;

        $this->editId    = (int) $editId;
        $this->isEditMode = true;

        // Step 1 — Basic Info
        $this->title       = $product->title       ?? '';
        $this->description = $product->description ?? '';
        $this->brand_name  = $product->brand_name  ?? '';
        $this->keywords    = $product->keywords    ?? '';

        // Step 2 — Images
        $this->existingImagePath = $product->product_img ?? '';
        $this->product_video_url = $product->product_video_url ?? '';

        // Load existing gallery — store as string paths (not file objects)
        $gallery = Productgallery::where('product_id', $editId)->get();
        $this->gallery_images = $gallery->pluck('gallery_images')->toArray();

        // Step 3 — Pricing
        if ($product->min_price && $product->max_price && $product->min_price != $product->max_price) {
            $this->price_type = 'range';
            $this->min_price  = $product->min_price;
            $this->max_price  = $product->max_price;
        } elseif ($product->min_price) {
            $this->price_type  = 'fixed';
            $this->fixed_price = $product->min_price;
        }
        $this->unit           = $product->unit          ?? 'Piece';
        $this->min_order      = $product->min_order     ?? '';
        $this->HSN            = $product->HSN           ?? '';
        $this->business_type  = $product->business_type ?? '';
        $this->supply_ability = $product->supply_ability ?? '';
        $this->lead_time      = $product->lead_time     ?? '';
        $this->payment_terms  = $product->payment_terms ?? '';
        $this->port_of_dispatch  = $product->port_of_dispatch  ?? '';
        $this->country_of_origin = $product->country_of_origin ?? 'India';

        // Step 4 — Specs & SEO
        $this->certifications    = $product->certifications    ?? '';
        $this->packaging_details = $product->packaging_details ?? '';
        $this->sample_available  = $product->sample_available  ?? 'no';
        $this->sample_price      = $product->sample_price      ?? '';
        $this->seo_title         = $product->seo_title         ?? '';
        $this->seo_description   = $product->seo_description   ?? '';
        $this->seo_keywords      = $product->seo_keywords      ?? '';

        // Category
        $this->category_id       = $product->category_id       ?? '';
        $this->subcategory_id    = $product->subcategory_id    ?? '';
        $this->sub_subcategory_id = $product->sub_subcategory_id ?? '';

        if ($this->category_id) {
            $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        }
        if ($this->subcategory_id) {
            $this->sub_subcategories = SubSubCategory::where('subcategory_id', $this->subcategory_id)->get();
        }

        // ── Package limit check ───────────────────────────────
        // In add mode: check if limit reached and set banner
        // In edit mode: still load counts for preview but don't block
        $this->checkPackageLimit();
        // In edit mode, the banner is hidden by blade @if(!$isEditMode)
    }

    // ── Package limit check ───────────────────────────────────
    // Returns [bool $limitReached, string $message, int $count, int $limit]
    // Called from mount() (to show banner), saveDraft(), and submit().
    // ALWAYS skipped in edit mode — editing an existing product never consumes quota.
    private function getPackageLimit(): array
    {
        [$customerId, $customer, $sellerId] = $this->resolveCustomer();
        if (!$customerId) return [false, '', 0, 999];

        // Count active products (pending=0, approved=1, draft=3) — exclude rejected
        $existingCount = Product::where('customer_id', $customerId)
            ->whereIn('status', [0, 1, 3])
            ->count();

        $limit = null; // null = not set (unlimited)

        if ($sellerId) {
            $seller  = Seller::find($sellerId);
            $package = $seller?->package_id ? PackagesModel::find($seller->package_id) : null;
            // Only enforce if package explicitly sets a product_limit > 0
            if ($package && $package->product_limit !== null && $package->product_limit > 0) {
                $limit = (int) $package->product_limit;
            }
        } elseif ($customer && !empty($customer->product_upload_limit)) {
            $limit = (int) $customer->product_upload_limit;
        }

        if ($limit !== null && $existingCount >= $limit) {
            return [
                true,
                "You have reached your plan limit of {$limit} product(s). You currently have {$existingCount} active product(s). Please upgrade your package to add more.",
                $existingCount,
                $limit,
            ];
        }

        return [false, '', $existingCount, $limit ?? 999];
    }

    private function checkPackageLimit(): void
    {
        [$reached, $message, $count, $limit] = $this->getPackageLimit();
        $this->limitReached = $reached;
        $this->limitMessage = $message;
        $this->productCount = $count;
        $this->productLimit = $limit;
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.product-add', compact('categories'))
            ->with([
                'limitReached' => $this->limitReached,
                'limitMessage' => $this->limitMessage,
                'productCount' => $this->productCount,
                'productLimit' => $this->productLimit,
            ]);
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

    // ── Sync description from JS editor before step change ────
    public function syncDescription(string $html): void
    {
        $this->description = $html;
    }

    // ── Step navigation ───────────────────────────────────────
    public function nextStep(string $desc = '')
    {
        if ($desc !== '') $this->description = $desc;
        if ($this->activeStep < $this->totalSteps) {
            $this->activeStep++;
        }
    }

    public function prevStep(string $desc = '')
    {
        if ($desc !== '') $this->description = $desc;
        if ($this->activeStep > 1) {
            $this->activeStep--;
        }
    }

    public function goToStep(int $step)
    {
        if ($step >= 1 && $step <= $this->totalSteps) {
            $this->activeStep = $step;
        }
    }

    // ── Save as Draft ─────────────────────────────────────────
    public function saveDraft(string $desc = '')
    {
        if ($desc !== '') $this->description = $desc;
        try {
            [$customerId, $customer, $sellerId] = $this->resolveCustomer();

            if (!$customer) {
                session()->flash('error', 'Session expired. Please login again.');
                return;
            }

            // ── Package limit check (skip for edit mode) ─────────
            if (!$this->isEditMode) {
                [$reached, $message] = $this->getPackageLimit();
                if ($reached) {
                    session()->flash('error', $message);
                    return;
                }
            }

            // Auto-generate slug if not set
            if (empty($this->slug) && !empty($this->title)) {
                $this->slug = Str::slug($this->title) . '-' . rand(100, 999999);
            } elseif (empty($this->slug)) {
                $this->slug = 'draft-' . $customerId . '-' . time();
            }

            // Upload main image if a new one was selected
            $imagePath = $this->existingImagePath ?: null; // keep existing by default
            if ($this->product_img && is_object($this->product_img)) {
                $ext        = $this->product_img->getClientOriginalExtension();
                $baseName   = Str::slug(pathinfo($this->product_img->getClientOriginalName(), PATHINFO_FILENAME));
                $uniqueName = $baseName . '-' . rand(1000, 999999) . '.' . $ext;
                $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
                $imagePath = 'uploads/product/' . $uniqueName;
            }

            // Determine prices
            $minPrice = $this->price_type === 'range' ? ($this->min_price ?: 0)
                      : ($this->price_type === 'fixed' ? ($this->fixed_price ?: 0) : 0);
            $maxPrice = $this->price_type === 'range' ? ($this->max_price ?: 0)
                      : ($this->price_type === 'fixed' ? ($this->fixed_price ?: 0) : 0);

            $productData = [
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
                'seller_id'         => $sellerId ?? null,
                'country_id'        => $customer?->country_id ?? null,
                'status'            => $this->isEditMode ? 3 : 3, // always draft
                'brand_name'        => $this->brand_name        ?: null,
                'keywords'          => $this->keywords           ?: null,
                'supply_ability'    => $this->supply_ability     ?: null,
                'lead_time'         => $this->lead_time          ?: null,
                'payment_terms'     => $this->payment_terms      ?: null,
                'port_of_dispatch'  => $this->port_of_dispatch   ?: null,
                'country_of_origin' => $this->country_of_origin  ?: 'India',
                'certifications'    => $this->certifications     ?: null,
                'packaging_details' => $this->packaging_details  ?: null,
                'sample_available'  => $this->sample_available   ?: 'no',
                'sample_price'      => $this->sample_price       ?: null,
                'product_video_url' => $this->product_video_url  ?: null,
                'seo_title'         => $this->seo_title          ?: null,
                'seo_description'   => $this->seo_description    ?: null,
                'seo_keywords'      => $this->seo_keywords        ?: null,
            ];

            // ── Edit mode: UPDATE existing product ───────────────
            if ($this->isEditMode && $this->editId) {
                $product = Product::where('id', $this->editId)
                    ->where('customer_id', $customerId)
                    ->first();
                if ($product) {
                    unset($productData['slug']); // preserve original slug
                    $product->update($productData);
                    $this->reset();
                    return redirect()->route('my-listings')
                        ->with('message', '📝 Product draft updated successfully.');
                }
                session()->flash('error', 'Product not found.');
                return;
            }

            // ── Add mode: CREATE new product ─────────────────────
            $product = Product::create($productData);

            // Upload gallery images (new uploads only — skip string paths from edit mode)
            foreach ($this->gallery_images as $gi) {
                if (!is_object($gi)) continue;
                try {
                    $gName = Str::slug(pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME));
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
    public function submit(string $desc = '')
    {
        if ($desc !== '') $this->description = $desc;
        try {
    $this->validate([
        'title'       => ['required','string','min:5','max:255','regex:/^[a-zA-Z0-9\s\-\&\,\.]+$/'],
        'brand_name' => [
    'nullable',
    'regex:/^[a-zA-Z0-9\s\&\.]+$/',
    'not_regex:/^\d+$/'
],
        'description' => ['required','string','min:20','not_regex:/^\d+$/'],

        'category_id'    => 'required',
        'subcategory_id' => 'required',

        'product_img' => ($this->isEditMode && $this->existingImagePath)
            ? 'nullable|image|mimes:webp,jpg,jpeg,png|max:4096'
            : 'required|image|mimes:webp,jpg,jpeg,png|max:4096',

        'price_type'     => 'required|in:range,fixed',

        'min_price'      => 'required_if:price_type,range|nullable|numeric|min:0',
        'max_price'      => 'required_if:price_type,range|nullable|numeric|gte:min_price',
        'fixed_price'    => 'required_if:price_type,fixed|nullable|numeric|min:0',

        'unit'           => 'required|string',

        // ✅ FIXED (only numbers)
        'min_order'      => ['required','regex:/^[0-9]+$/'],

        'business_type'  => ['required','regex:/^[a-zA-Z\s\/]+$/'],

        // ✅ FIXED (only digits)
        'HSN'            => ['required','regex:/^[0-9]+$/'],

        'sample_available' => 'required|in:yes,no',

        'product_video_url'=> 'nullable|url|max:500',
        'seo_title'      => 'nullable|string|max:255',

    ], [

        // REQUIRED
        'title.required'              => 'Product title is required.',
        'title.min'                   => 'Title must be at least 5 characters.',
        'description.required'        => 'Product description is required.',
        'description.min'             => 'Description must be at least 20 characters.',
        'category_id.required'        => 'Please select a category.',
        'subcategory_id.required'     => 'Please select a sub category.',
        'product_img.required'        => 'Please upload a main product image.',

        // PRICE
        'min_price.required_if'       => 'Min price is required for price range.',
        'max_price.required_if'       => 'Max price is required for price range.',
        'fixed_price.required_if'     => 'Please enter the fixed price.',

        // OTHER REQUIRED
        'unit.required'               => 'Please select a unit.',
        'min_order.required'          => 'Minimum order quantity is required.',
        'business_type.required'      => 'Please select your business type.',
        'HSN.required'                => 'HSN/SAC code is required.',

        // ✅ REGEX / SMART VALIDATION
        'title.regex' => 'Title should not contain invalid special characters.',
        'brand_name.regex' => 'Brand name can contain only letters, numbers, spaces, & and dot.',
        'brand_name.not_regex' => 'Brand name cannot be only numbers.',
        'business_type.regex' => 'Business type should contain only text.',
        'description.not_regex' => 'Description cannot be only numbers.',
        'min_order.regex' => 'MOQ must be only numbers.',
        'HSN.regex' => 'HSN must contain only digits.',
    ]);

} catch (\Illuminate\Validation\ValidationException $e) {

    $errors = $e->errors();

    if (array_intersect_key($errors, array_flip([
        'title','description','category_id','subcategory_id','sub_subcategory_id'
    ]))) {
        $this->activeStep = 1;

    } elseif (array_intersect_key($errors, array_flip([
        'product_img'
    ]))) {
        $this->activeStep = 2;

    } elseif (array_intersect_key($errors, array_flip([
        'min_price','max_price','fixed_price','unit','min_order','business_type','HSN'
    ]))) {
        $this->activeStep = 3;
    }

    throw $e;
}

        try {
            // FIX: Use shared resolver — same fallbacks as mount() and saveDraft().
            // Previously submit() only checked Session::get('id'), missing
            // 'customer_id' and auth() fallbacks, causing null customer errors.
            [$customerId, $customer, $sellerId] = $this->resolveCustomer();

            // FIX: Guard against null customer BEFORE accessing any property.
            // Previously $customer->country_id was used with no null check,
            // causing "Something went wrong: country_id / null" errors.
            if (!$customer) {
                session()->flash('error', 'Session expired. Please login again.');
                return;
            }

            // Check product limit — skip for edit mode (already owns this product)
            if (!$this->isEditMode) {
                [$reached, $message] = $this->getPackageLimit();
                if ($reached) {
                    session()->flash('error', $message);
                    return;
                }
            }

            // Check for duplicate product title
            $dupQuery = Product::where('customer_id', $customerId)
                ->where('title', $this->title)
                ->where('status', '!=', 3);
            if ($this->isEditMode) $dupQuery->where('id', '!=', $this->editId);
            if ($dupQuery->exists()) {
                session()->flash('error', '⚠️ You already have a product with this name. Please use a different title.');
                return;
            }

            // Upload new image (or keep existing in edit mode)
            if ($this->product_img && is_object($this->product_img)) {
                $ext        = $this->product_img->getClientOriginalExtension();
                $baseName   = Str::slug(pathinfo($this->product_img->getClientOriginalName(), PATHINFO_FILENAME));
                $uniqueName = $baseName . '-' . rand(1000, 999999) . '.' . $ext;
                $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
                $imagePath = 'uploads/product/' . $uniqueName;
            } else {
                $imagePath = $this->existingImagePath ?: null;
            }

            // Auto-generate slug
            $slug = $this->isEditMode
                ? (Product::find($this->editId)?->slug ?? Str::slug($this->title) . '-' . rand(100, 999999))
                : Str::slug($this->title) . '-' . rand(100, 999999);

            // Determine price values
            $minPrice = $this->price_type === 'range' ? $this->min_price
                      : ($this->price_type === 'fixed' ? $this->fixed_price : 0);
            $maxPrice = $this->price_type === 'range' ? $this->max_price
                      : ($this->price_type === 'fixed' ? $this->fixed_price : 0);

            $productData = [
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
                'seller_id'         => $sellerId,
                // FIX: null-safe access — $customer is guaranteed non-null above,
                // but ?? null guards against the column itself being unset on model.
                'country_id'        => $customer->country_id ?? null,
                'status'            => 0,
                'seo_title'         => $this->seo_title   ?: $this->title,
                'seo_description'   => $this->seo_description ?: null,
                'seo_keywords'      => $this->seo_keywords ?: $this->keywords,
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
            ];

            if ($this->isEditMode && $this->editId) {
                $product = Product::where('id', $this->editId)
                    ->where('customer_id', $customerId)
                    ->first();
                if ($product) {
                    $product->update($productData);
                }
            } else {
                $product = Product::create($productData);
            }

            // Upload gallery images — skip string paths (edit mode existing images)
            foreach ($this->gallery_images as $gi) {
                if (!is_object($gi)) continue; // FIX: skip string paths from edit mode
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

            // Upload documents
            foreach ($this->document_list as $doc) {
                if (!empty($doc['file'])) {
                    $dExt  = $doc['file']->getClientOriginalExtension();
                    $dName = Str::slug($doc['label']) . '-' . rand(1000, 999999) . '.' . $dExt;
                    $doc['file']->storeAs('public/uploads/product-docs', $dName, 's3');
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
                ->with('message', $this->isEditMode
                    ? '✅ Product updated successfully!'
                    : '✅ Product submitted for review! Goes live once approved by admin.');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title) . '-' . rand(100, 999999999);
    }
}