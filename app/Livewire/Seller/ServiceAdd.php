<?php
// FILE: app/Livewire/Seller/ServiceAdd.php
// Route: Route::get('/seller/service-add', ServiceAdd::class)->name('service_add');

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Customer;
use App\Models\SellerService;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceAdd extends Component
{
    use WithFileUploads;

    // ── Step state ────────────────────────────────────────────
    public int $activeStep  = 1;
    public int $totalSteps  = 3;

    // ── Step 1: Basic Info ────────────────────────────────────
    public $title            = '';
    public $description      = '';
    public $service_type     = '';
    public $category_id      = '';
    public $subcategory_id   = '';
    public $sub_subcategory_id = '';
    public $keywords         = '';
    public $subcategories    = [];
    public $sub_subcategories = [];

    // ── Step 2: Pricing & Delivery ───────────────────────────
    public $pricing_type         = 'quote_based';
    public $min_price            = '';
    public $max_price            = '';
    public $price_unit           = 'per project';
    public $delivery_mode        = 'Both';
    public $turnaround_time      = '';
    public $service_area         = '';
    public $payment_terms        = '';
    public $sample_consultation  = 'no';

    // ── Step 3: Credentials & Media ──────────────────────────
    public $experience_years     = '';
    public $projects_completed   = '';
    public $certifications       = '';
    public $languages            = 'English';
    public $inclusions           = '';
    public $exclusions           = '';
    public $cover_image;
    public $portfolio_files      = [];
    public $new_portfolio_files  = [];
    public $video_url            = '';

    // ─────────────────────────────────────────────────────────
    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.service-add', compact('categories'));
    }

    public function updatedCategoryId($val)
    {
        $this->subcategories       = Subcategory::where('category_id', $val)->get();
        $this->subcategory_id      = null;
        $this->sub_subcategories   = [];
        $this->sub_subcategory_id  = null;
    }

    public function updatedSubcategoryId($val)
    {
        $this->sub_subcategories  = SubSubCategory::where('subcategory_id', $val)->get();
        $this->sub_subcategory_id = null;
    }

    public function updatedNewPortfolioFiles()
    {
        foreach ($this->new_portfolio_files as $f) {
            $this->portfolio_files[] = $f;
        }
        $this->new_portfolio_files = [];
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
                'title'        => 'required|string|min:10|max:255',
                'description'  => 'required|string|min:30',
                'service_type' => 'required|string',
                'category_id'  => 'required',
                'keywords'     => 'nullable|string|max:500',
            ], [
                'title.min'       => 'Title must be at least 10 characters.',
                'description.min' => 'Description must be at least 30 characters.',
                'service_type.required' => 'Please select a service type.',
                'category_id.required'  => 'Please select a category.',
            ]),
            2 => $this->validate([
                'pricing_type'    => 'required|in:fixed,hourly,negotiable,quote_based',
                'min_price'       => 'nullable|numeric|min:0',
                'max_price'       => 'nullable|numeric|gte:min_price',
                'delivery_mode'   => 'required|string',
                'turnaround_time' => 'nullable|string|max:100',
                'service_area'    => 'nullable|string|max:300',
            ], [
                'max_price.gte' => 'Max price must be ≥ min price.',
            ]),
            3 => $this->validate([
                'cover_image'        => 'nullable|image|mimes:jpg,jpeg,webp,png|max:4096',
                'portfolio_files'    => 'nullable|array|max:10',
                'portfolio_files.*'  => 'image|mimes:jpg,jpeg,webp,png|max:4096',
                'video_url'          => 'nullable|url|max:500',
                'experience_years'   => 'nullable|string|max:50',
                'projects_completed' => 'nullable|integer|min:0',
                'certifications'     => 'nullable|string|max:500',
                'languages'          => 'nullable|string|max:200',
                'inclusions'         => 'nullable|string|max:1000',
                'exclusions'         => 'nullable|string|max:1000',
            ]),
            default => null,
        };
    }

    // ── Submit ────────────────────────────────────────────────
    public function submit()
    {
        $this->validateCurrentStep();

        try {
            $customerId = Session::get('id');
            $customer   = Customer::find($customerId);

            // Upload cover image
            $coverPath = null;
            if ($this->cover_image) {
                $ext        = $this->cover_image->getClientOriginalExtension();
                $uniqueName = 'service-cover-' . $customerId . '-' . rand(1000, 999999) . '.' . $ext;
                $this->cover_image->storeAs('public/uploads/services', $uniqueName, 's3');
                $coverPath = 'uploads/services/' . $uniqueName;
            }

            // Upload portfolio images
            $portfolioPaths = [];
            if (!empty($this->portfolio_files)) {
                foreach ($this->portfolio_files as $pf) {
                    $ext     = $pf->getClientOriginalExtension();
                    $uname   = 'service-portfolio-' . $customerId . '-' . rand(1000, 999999) . '.' . $ext;
                    $pf->storeAs('public/uploads/services', $uname, 's3');
                    $portfolioPaths[] = 'uploads/services/' . $uname;
                }
            }

            $slug = Str::slug($this->title) . '-' . $customerId . '-' . rand(100, 99999);

            SellerService::create([
                'customer_id'         => $customerId,
                'title'               => $this->title,
                'slug'                => $slug,
                'description'         => $this->description,
                'service_type'        => $this->service_type,
                'category_id'         => $this->category_id    ?: null,
                'subcategory_id'      => $this->subcategory_id ?: null,
                'sub_subcategory_id'  => $this->sub_subcategory_id ?: null,
                'pricing_type'        => $this->pricing_type,
                'min_price'           => $this->min_price       ?: null,
                'max_price'           => $this->max_price       ?: null,
                'price_unit'          => $this->price_unit      ?: null,
                'delivery_mode'       => $this->delivery_mode   ?: null,
                'turnaround_time'     => $this->turnaround_time ?: null,
                'service_area'        => $this->service_area    ?: null,
                'inclusions'          => $this->inclusions      ?: null,
                'exclusions'          => $this->exclusions      ?: null,
                'certifications'      => $this->certifications  ?: null,
                'languages'           => $this->languages       ?: null,
                'experience_years'    => $this->experience_years    ?: null,
                'projects_completed'  => $this->projects_completed  ?: null,
                'cover_image'         => $coverPath,
                'portfolio_images'    => !empty($portfolioPaths) ? $portfolioPaths : null,
                'video_url'           => $this->video_url       ?: null,
                'payment_terms'       => $this->payment_terms   ?: null,
                'sample_consultation' => $this->sample_consultation,
                'keywords'            => $this->keywords        ?: null,
                'status'              => 'pending',
            ]);

            $this->reset();
            return redirect()->route('service_list')
                ->with('message', '✅ Service submitted for review! It will go live once approved by admin.');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}