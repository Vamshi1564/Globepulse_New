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
    public $description     = '';
    public $brand_name      = '';
    public $keywords        = '';
    public $banError        = '';

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
    public $price_type    = 'range';
    public $min_price     = '';
    public $max_price     = '';
    public $fixed_price   = '';
    public $unit          = 'Piece';
    public $min_order     = '';
    public $HSN           = '';
    public $business_type = '';

    // ── Trade Details ─────────────────────────────────────────
    public $supply_ability    = '';
    public $lead_time         = '';
    public $payment_terms     = '';
    public $port_of_dispatch  = '';
    public $country_of_origin = 'India';

    // ── Specifications ────────────────────────────────────────
    public $certifications    = '';
    public $packaging_details = '';
    public $sample_available  = 'no';
    public $sample_price      = '';

    // ── Documents ─────────────────────────────────────────────
    public $documents      = [];
    public $new_document   = null;
    public $document_label = '';
    public $document_list  = [];

    // ── SEO ───────────────────────────────────────────────────
    public $seo_title       = '';
    public $seo_description = '';
    public $seo_keywords    = '';

    // ── Slug ──────────────────────────────────────────────────
    public $slug = '';

    // ── Step state ────────────────────────────────────────────
    public int $activeStep = 1;
    public int $totalSteps = 4;

    // ── Edit mode ─────────────────────────────────────────────
    public ?int   $editId            = null;
    public bool   $isEditMode        = false;
    public string $existingImagePath = '';

    // ── Plan / Package usage (displayed in blade sidebar) ─────
    //
    // Populated by loadPlanInfo() during mount() so the sidebar
    // widget is visible immediately when the page loads.
    //
    // ⚠️  FIELD NAME ASSUMPTIONS — update these if your DB differs:
    //   PackagesModel columns : product_limit, service_limit, name / package_name
    //   Service model class   : \App\Models\Service  (with customer_id + status)
    //   Draft status value    : 3  (excluded from usage counts)
    // ─────────────────────────────────────────────────────────
    public string $planName         = '';
    public int    $planProductLimit = 0;   // 0 = unlimited
    public int    $planServiceLimit = 0;   // 0 = unlimited
    public int    $planProductUsed  = 0;
    public int    $planServiceUsed  = 0;
    public bool   $planLimitBlocked = false; // true = product limit hit on CREATE

    // ─────────────────────────────────────────────────────────
    // resolveCustomer()
    //
    // Checks both session keys ('id' and 'customer_id') plus the
    // seller_email fallback.  Does NOT call auth() — this app uses
    // manual session auth, and auth()->id() can return an Admin/
    // Seller ID that is absent from the customers table, causing
    // Customer::find() to return null and a false "Session expired".
    // ─────────────────────────────────────────────────────────
    private function resolveCustomer(): array
    {
        $sellerId = Session::get('seller_id');

        // Step 1: Direct customer ID from session
        $customerId = Session::get('id')
                   ?? Session::get('customer_id')
                   ?? Session::get('seller_customer_id')
                   ?? null;
        $customer   = $customerId ? Customer::find($customerId) : null;

        // Step 2: Match via seller_email in session
        if (!$customer && Session::get('seller_email')) {
            $customer = Customer::where('email', Session::get('seller_email'))->first();
            if ($customer) {
                $customerId = $customer->id;
                Session::put('id', $customerId);
            }
        }

        // Step 3: Match via Seller record
        if (!$customer && $sellerId) {
            $seller = Seller::find($sellerId);
            if ($seller) {
                if (!empty($seller->customer_id)) {
                    $customer = Customer::find($seller->customer_id);
                }
                if (!$customer && !empty($seller->email)) {
                    $customer = Customer::where('email', $seller->email)->first();
                }
                if ($customer) {
                    $customerId = $customer->id;
                    Session::put('id', $customerId);
                }
            }
        }

        // Step 4 (critical fallback): use seller_id as customerId
        // For platforms where sellers are not in the customers table.
        // Products are linked via customer_id = seller_id.
        if (!$customerId && $sellerId) {
            $customerId = $sellerId;
            $customer   = Customer::find($customerId); // may still be null — that's OK
        }

        // $isSellerOnly = true when seller_id exists but no Customer record found
        $isSellerOnly = ($sellerId && !$customer);

        return [$customerId, $customer, $sellerId, $isSellerOnly];
    }

    // ─────────────────────────────────────────────────────────
    // resolvePackageLimits()
    //
    // Returns the seller's package limits and current usage for
    // BOTH products and services so the same data can be used for
    // the limit check in submit() and the sidebar widget.
    //
    // Priority:
    //   1. Seller → PackagesModel  (new seller system)
    //   2. Customer->product_upload_limit  (legacy GFE system)
    //
    // ⚠️  Adjust column names here if your schema differs:
    //   product_limit → PackagesModel column for product cap
    //   service_limit → PackagesModel column for service cap
    //   name / package_name → display name of the plan
    // ─────────────────────────────────────────────────────────
    private function resolvePackageLimits(?int $customerId, ?int $sellerId, ?Customer $customer): array
    {
        $productLimit = 0;   // 0 = unlimited
        $serviceLimit = 0;   // 0 = unlimited
        $packageName  = 'Standard';

        if ($sellerId) {
            $seller  = Seller::find($sellerId);
            $package = ($seller && $seller->package_id)
                ? PackagesModel::find($seller->package_id)
                : null;

            if ($package) {
                // ── Package display name ──────────────────────
                $packageName = $package->name
                            ?? $package->package_name
                            ?? 'Your Plan';

                // ── Product slot limit ────────────────────────
                // ⚠️  Change 'product_limit' if your column name differs
                $rawProd      = $package->product_limit ?? null;
                $productLimit = ($rawProd !== null && (int) $rawProd > 0)
                    ? (int) $rawProd : 0;

                // ── Service slot limit ────────────────────────
                // ⚠️  Change 'service_limit' if your column name differs
                $rawSvc       = $package->service_limit ?? null;
                $serviceLimit = ($rawSvc !== null && (int) $rawSvc > 0)
                    ? (int) $rawSvc : 0;
            }
        } elseif ($customer) {
            // Legacy system: product limit stored on the customer row
            $rawProd      = $customer->product_upload_limit ?? null;
            $productLimit = ($rawProd !== null && (int) $rawProd > 0)
                ? (int) $rawProd : 0;
        }

        // ── Current product usage (exclude drafts, status = 3) ───
        $productUsed = Product::where('customer_id', $customerId)
                              ->where('status', '!=', 3)
                              ->count();

        // ── Current service usage ─────────────────────────────────
        // ⚠️  Change \App\Models\Service to the actual class in your app.
        //     Common names: Service, Listing, ServiceListing, ItemsModel.
        //     The model must have customer_id and status columns.
        $serviceUsed = 0;
        try {
            if (class_exists(\App\Models\Service::class)) {
                $serviceUsed = \App\Models\Service::where('customer_id', $customerId)
                                                  ->where('status', '!=', 3)
                                                  ->count();
            }
        } catch (\Throwable $e) {
            $serviceUsed = 0; // model not yet available — skip silently
        }

        return compact('packageName', 'productLimit', 'serviceLimit', 'productUsed', 'serviceUsed');
    }

    // ─────────────────────────────────────────────────────────
    // loadPlanInfo()
    //
    // Fetches package limits + usage and writes them into the
    // public $plan* properties so the blade sidebar can render
    // a live plan-usage widget.
    //
    // Also sets $planLimitBlocked = true when a seller is in
    // CREATE mode and has already hit their product limit.
    // The blade uses this flag to disable the submit button.
    // ─────────────────────────────────────────────────────────
    private function loadPlanInfo(?int $customerId, ?int $sellerId, ?Customer $customer, bool $isNewProduct): void
    {
        if (!$customerId) return; // no session — leave plan properties at defaults
        $limits = $this->resolvePackageLimits($customerId, $sellerId, $customer);

        $this->planName         = $limits['packageName'];
        $this->planProductLimit = $limits['productLimit'];
        $this->planServiceLimit = $limits['serviceLimit'];
        $this->planProductUsed  = $limits['productUsed'];
        $this->planServiceUsed  = $limits['serviceUsed'];

        // Only block when CREATING.  Editing never blocks — the slot exists.
        $this->planLimitBlocked = $isNewProduct
            && $limits['productLimit'] > 0
            && $limits['productUsed'] >= $limits['productLimit'];
    }

    // ─────────────────────────────────────────────────────────
    public function mount(): void
    {
        $editId = request()->query('edit');

        [$customerId, $customer, $sellerId, $isSellerOnly] = $this->resolveCustomer();

        // Populate plan widget immediately on page load
        $this->loadPlanInfo($customerId, $sellerId, $customer, empty($editId));

        if (!$editId) return;

        if (!$customerId) return; // cannot load product without session

        $product = Product::where('id', $editId)
            ->where('customer_id', $customerId)
            ->first();

        if (!$product) return;

        $this->editId     = (int) $editId;
        $this->isEditMode = true;

        // Step 1
        $this->title       = $product->title       ?? '';
        $this->description = $product->description ?? '';
        $this->brand_name  = $product->brand_name  ?? '';
        $this->keywords    = $product->keywords    ?? '';

        // Step 2
        $this->existingImagePath = $product->product_img      ?? '';
        $this->product_video_url = $product->product_video_url ?? '';

        $gallery = Productgallery::where('product_id', $editId)->get();
        $this->gallery_images = $gallery->pluck('gallery_images')->toArray();

        // Step 3
        if ($product->min_price && $product->max_price && $product->min_price != $product->max_price) {
            $this->price_type = 'range';
            $this->min_price  = $product->min_price;
            $this->max_price  = $product->max_price;
        } elseif ($product->min_price) {
            $this->price_type  = 'fixed';
            $this->fixed_price = $product->min_price;
        }
        $this->unit              = $product->unit              ?? 'Piece';
        $this->min_order         = $product->min_order         ?? '';
        $this->HSN               = $product->HSN               ?? '';
        $this->business_type     = $product->business_type     ?? '';
        $this->supply_ability    = $product->supply_ability    ?? '';
        $this->lead_time         = $product->lead_time         ?? '';
        $this->payment_terms     = $product->payment_terms     ?? '';
        $this->port_of_dispatch  = $product->port_of_dispatch  ?? '';
        $this->country_of_origin = $product->country_of_origin ?? 'India';

        // Step 4
        $this->certifications    = $product->certifications    ?? '';
        $this->packaging_details = $product->packaging_details ?? '';
        $this->sample_available  = $product->sample_available  ?? 'no';
        $this->sample_price      = $product->sample_price      ?? '';
        $this->seo_title         = $product->seo_title         ?? '';
        $this->seo_description   = $product->seo_description   ?? '';
        $this->seo_keywords      = $product->seo_keywords       ?? '';

        // Category
        $this->category_id        = $product->category_id        ?? '';
        $this->subcategory_id     = $product->subcategory_id     ?? '';
        $this->sub_subcategory_id = $product->sub_subcategory_id ?? '';

        if ($this->category_id) {
            $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        }
        if ($this->subcategory_id) {
            $this->sub_subcategories = SubSubCategory::where('subcategory_id', $this->subcategory_id)->get();
        }
    }

    public function render()
    {
        // Re-resolve customer on every render so plan usage stays live
        [$customerId, $customer, $sellerId, $isSellerOnly] = $this->resolveCustomer();
        if ($customerId) {
            $this->loadPlanInfo($customerId, $sellerId, $customer, !$this->isEditMode);
        }

        $categories = Category::all();

        // $limitReached is an alias for $planLimitBlocked — used in some blade versions
        $limitReached = $this->planLimitBlocked;

        return view('livewire.seller.product-add', [
            'categories'      => $categories,
            // Plan / package variables — passed explicitly so the blade
            // always has them even if the public property hydration is delayed
            'planName'         => $this->planName,
            'planProductLimit' => $this->planProductLimit,
            'planProductUsed'  => $this->planProductUsed,
            'planServiceLimit' => $this->planServiceLimit,
            'planServiceUsed'  => $this->planServiceUsed,
            'planLimitBlocked' => $this->planLimitBlocked,
            'limitReached'     => $limitReached,  // backward-compat alias
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

    public function addDocument()
    {
        // Validate before adding
        $this->validate([
            'document_label' => 'required|string',
            'new_document'   => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ], [
            'document_label.required' => 'Please select a document type.',
            'new_document.required'   => 'Please select a file to upload.',
            'new_document.mimes'      => 'Allowed formats: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX.',
            'new_document.max'        => 'File must be under 10 MB.',
        ]);

        $this->document_list[] = [
            'label' => $this->document_label,
            'file'  => $this->new_document,
        ];
        $this->reset(['new_document', 'document_label']);
    }

    public function removeDocument(int $index): void
    {
        array_splice($this->document_list, $index, 1);
    }

    public function syncDescription(string $html): void
    {
        $this->description = $html;
    }

    public function nextStep()
    {
        if ($this->activeStep < $this->totalSteps) $this->activeStep++;
    }

    public function prevStep()
    {
        if ($this->activeStep > 1) $this->activeStep--;
    }

    public function goToStep(int $step)
    {
        if ($step >= 1 && $step <= $this->totalSteps) $this->activeStep = $step;
    }

    // ── Save as Draft ─────────────────────────────────────────
    // Drafts are saved with status = 3 and are NOT counted against
    // plan limits, so no package check is performed here.
    public function saveDraft()
    {
        try {
            [$customerId, $customer, $sellerId, $isSellerOnly] = $this->resolveCustomer();

            // Block only if we have no customer ID at all (truly no session)
            if (!$customerId) {
                session()->flash('error', 'Session expired. Please login again.');
                return;
            }
            // If $customer is null but $customerId exists (seller-only session),
            // we proceed — $customerId (= seller_id) is used as the owner ID.

            if (empty($this->slug) && !empty($this->title)) {
                $this->slug = Str::slug($this->title) . '-' . rand(100, 999999);
            } elseif (empty($this->slug)) {
                $this->slug = 'draft-' . $customerId . '-' . time();
            }

            $imagePath = null;
            if ($this->product_img && is_object($this->product_img)) {
                $ext        = $this->product_img->getClientOriginalExtension();
                $baseName   = Str::slug(pathinfo($this->product_img->getClientOriginalName(), PATHINFO_FILENAME));
                $uniqueName = $baseName . '-' . rand(1000, 999999) . '.' . $ext;
                $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
                $imagePath  = 'uploads/product/' . $uniqueName;
            }

            $minPrice = $this->price_type === 'range' ? ($this->min_price ?: 0)
                      : ($this->price_type === 'fixed' ? ($this->fixed_price ?: 0) : 0);
            $maxPrice = $this->price_type === 'range' ? ($this->max_price ?: 0)
                      : ($this->price_type === 'fixed' ? ($this->fixed_price ?: 0) : 0);

            $product = Product::create([
                'title'             => $this->title           ?: 'Untitled Draft',
                'description'       => $this->description     ?: '',
                'product_img'       => $imagePath             ?: '',
                'category_id'       => $this->category_id     ?: null,
                'subcategory_id'    => $this->subcategory_id  ?: null,
                'sub_subcategory_id'=> $this->sub_subcategory_id ?: null,
                'min_price'         => $minPrice,
                'max_price'         => $maxPrice,
                'min_order'         => $this->min_order        ?: null,
                'unit'              => $this->unit,
                'business_type'     => $this->business_type   ?: null,
                'slug'              => $this->slug,
                'HSN'               => $this->HSN              ?: null,
                'customer_id'       => $customerId,
                'seller_id'         => $sellerId               ?? null,
                'country_id'        => $customer?->country_id  ?? null,
                'status'            => 3,
                'brand_name'        => $this->brand_name        ?: null,
                'keywords'          => $this->keywords          ?: null,
                'supply_ability'    => $this->supply_ability    ?: null,
                'lead_time'         => $this->lead_time         ?: null,
                'certifications'    => $this->certifications    ?: null,
                'packaging_details' => $this->packaging_details ?: null,
                'sample_available'  => $this->sample_available  ?: 'no',
                'sample_price'      => $this->sample_price      ?: null,
                'product_video_url' => $this->product_video_url ?: null,
                'seo_title'         => $this->seo_title         ?: null,
                'seo_description'   => $this->seo_description   ?: null,
                'seo_keywords'      => $this->seo_keywords       ?: null,
            ]);

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

    // ── Final Submit ──────────────────────────────────────────
    public function submit()
    {
        // ── Validation ────────────────────────────────────────
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
            [$customerId, $customer, $sellerId, $isSellerOnly] = $this->resolveCustomer();

            // Block only if we have no customer ID at all (truly no session)
            if (!$customerId) {
                session()->flash('error', 'Session expired. Please login again.');
                return;
            }
            // If $customer is null but $customerId exists (seller-only session),
            // we proceed — $customerId (= seller_id) is used as the owner ID.

            // ── Package / plan limit check ─────────────────────────
            //
            // CREATE mode
            //   • Products: HARD BLOCK — cannot submit if at or over limit.
            //   • Services: SOFT WARNING — we do not block a product save
            //     because of service usage, but we inform the seller.
            //
            // EDIT mode
            //   • Never block — the product slot already exists.
            //   • Show a soft warning if they're over limit due to a plan
            //     downgrade, but still save their changes.
            // ─────────────────────────────────────────────────────────
            $limits = $this->resolvePackageLimits($customerId, $sellerId, $customer);

            if (!$this->isEditMode) {

                // Hard block: product limit hit on CREATE
                if ($limits['productLimit'] > 0 && $limits['productUsed'] >= $limits['productLimit']) {
                    session()->flash('error',
                        "🚫 Product limit reached — your \"{$limits['packageName']}\" plan includes "
                        . "{$limits['productLimit']} product(s) and you have already used "
                        . "{$limits['productUsed']}. Please upgrade your plan to add more products."
                    );
                    return;
                }

                // Soft warning: service limit also hit (informational only)
                if ($limits['serviceLimit'] > 0 && $limits['serviceUsed'] >= $limits['serviceLimit']) {
                    session()->flash('warning',
                        "⚠️ Note: You have also reached your service listing limit "
                        . "({$limits['serviceUsed']}/{$limits['serviceLimit']}) on your "
                        . "\"{$limits['packageName']}\" plan. This product has been saved, "
                        . "but no more services can be added without upgrading."
                    );
                }

            } else {

                // Soft warning: over product limit in edit mode (plan downgrade scenario)
                if ($limits['productLimit'] > 0 && $limits['productUsed'] > $limits['productLimit']) {
                    session()->flash('warning',
                        "⚠️ Your \"{$limits['packageName']}\" plan allows {$limits['productLimit']} product(s), "
                        . "but you currently have {$limits['productUsed']}. Your changes have been saved — "
                        . "please upgrade your plan or remove some listings to stay within your limit."
                    );
                }

                // Soft warning: over service limit too in edit mode
                if ($limits['serviceLimit'] > 0 && $limits['serviceUsed'] > $limits['serviceLimit']) {
                    session()->flash('warning',
                        "⚠️ You are also over your service listing limit "
                        . "({$limits['serviceUsed']}/{$limits['serviceLimit']}) on the "
                        . "\"{$limits['packageName']}\" plan. Please upgrade or remove some service listings."
                    );
                }
            }

            // ── Duplicate title check ─────────────────────────────
            $dupQuery = Product::where('customer_id', $customerId)
                ->where('title', $this->title)
                ->where('status', '!=', 3);
            if ($this->isEditMode) $dupQuery->where('id', '!=', $this->editId);
            if ($dupQuery->exists()) {
                session()->flash('error', '⚠️ You already have a product with this name. Please use a different title.');
                return;
            }

            // ── Image upload ──────────────────────────────────────
            if ($this->product_img && is_object($this->product_img)) {
                $ext        = $this->product_img->getClientOriginalExtension();
                $baseName   = Str::slug(pathinfo($this->product_img->getClientOriginalName(), PATHINFO_FILENAME));
                $uniqueName = $baseName . '-' . rand(1000, 999999) . '.' . $ext;
                $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
                $imagePath  = 'uploads/product/' . $uniqueName;
            } else {
                $imagePath = $this->existingImagePath ?: null;
            }

            // ── Slug ──────────────────────────────────────────────
            $slug = $this->isEditMode
                ? (Product::find($this->editId)?->slug ?? Str::slug($this->title) . '-' . rand(100, 999999))
                : Str::slug($this->title) . '-' . rand(100, 999999);

            // ── Price ─────────────────────────────────────────────
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
                'country_id'        => $customer?->country_id ?? null,
                // Edit: keep the existing status so a draft stays a draft,
                // a rejected product stays rejected, etc.
                // New products always start as 0 (pending admin review).
                'status'            => $this->isEditMode
                    ? (Product::where('id', $this->editId)->value('status') ?? 0)
                    : 0,
                'seo_title'         => $this->seo_title       ?: $this->title,
                'seo_description'   => $this->seo_description ?: null,
                'seo_keywords'      => $this->seo_keywords     ?: $this->keywords,
                'brand_name'        => $this->brand_name        ?: null,
                'keywords'          => $this->keywords          ?: null,
                'supply_ability'    => $this->supply_ability    ?: null,
                'lead_time'         => $this->lead_time         ?: null,
                'payment_terms'     => $this->payment_terms     ?: null,
                'port_of_dispatch'  => $this->port_of_dispatch  ?: null,
                'country_of_origin' => $this->country_of_origin ?: 'India',
                'product_video_url' => $this->product_video_url ?: null,
                'certifications'    => $this->certifications    ?: null,
                'packaging_details' => $this->packaging_details ?: null,
                'sample_available'  => $this->sample_available,
                'sample_price'      => $this->sample_available === 'yes' ? ($this->sample_price ?: null) : null,
            ];

            if ($this->isEditMode && $this->editId) {
                $product = Product::where('id', $this->editId)
                    ->where('customer_id', $customerId)
                    ->first();
                if ($product) $product->update($productData);
            } else {
                $product = Product::create($productData);
            }

            // ── Gallery ───────────────────────────────────────────
            foreach ($this->gallery_images as $gi) {
                if (!is_object($gi)) continue;
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

            // ── Documents ─────────────────────────────────────────
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
                    } catch (\Exception $e) { /* table may not exist yet */ }
                }
            }

            $this->reset();

            // Build redirect message based on what the product's status actually is
            // after save — a draft edit stays a draft, not 'submitted for review'.
            $savedStatus = $this->isEditMode
                ? (Product::where('id', $this->editId)->value('status') ?? 0)
                : 0;
            $redirectMsg = match(true) {
                !$this->isEditMode                => '✅ Product submitted for review! Goes live once approved by admin.',
                $savedStatus === 3                => '💾 Draft updated successfully. Publish it from My Listings when ready.',
                default                           => '✅ Product updated successfully!',
            };

            return redirect()->route('my-listings')->with('message', $redirectMsg);

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title) . '-' . rand(100, 999999999);
    }

    public function updatedTitle($value)
{
    $this->banError = '';

    $title = strtolower($value);

    $banned = \App\Models\BanProduct::where(function ($query) use ($title) {

        // Match product title
        $query->whereRaw('LOWER(product_title) LIKE ?', ["%{$title}%"]);

        // Match keywords
        $query->orWhere(function ($q) use ($title) {
            $bans = \App\Models\BanProduct::pluck('keywords');

            foreach ($bans as $keywords) {
                if (!$keywords) continue;

                $words = array_map('trim', explode(',', strtolower($keywords)));

                foreach ($words as $word) {
                    if ($word && str_contains($title, $word)) {
                        $q->orWhere('keywords', 'LIKE', "%{$word}%");
                    }
                }
            }
        });

    })->exists();

    if ($banned) {
        $this->banError = '🚫 This product has been banned. Please add another product.';
    }
}
}