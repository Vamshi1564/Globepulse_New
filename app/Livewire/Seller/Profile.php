<?php
// FILE: app/Livewire/Seller/Profile.php
// Steps: 1=Basic, 2=Business, 3=Company Profile, 4=Verification/Docs, 5=Plan (last)

namespace App\Livewire\Seller;

use App\Models\Seller;
use App\Models\SellerDetail;
use App\Models\SellerDocument;
use App\Models\SellerSubscription;
use App\Models\Country;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $activeStep = 1;

    // Step 1: Basic
    public $email      = '';
    public $phone      = '';
    public $country_id = '';   // Country.country_id (int)

    // Step 2: Business
    public $legal_business_name  = '';
    public $business_type        = '';
    public $year_established     = '';
    public $company_website      = '';
    public $num_employees        = '';
    public $business_address     = '';
    public $city                 = '';
    public $state_province       = '';
    public $business_country_id  = '';
    public $doc_business_registration;

    // Step 3: Company Profile
    public $company_description = '';
    public $main_products       = '';
    public $factory_size_sqm    = '';
    public $production_capacity = '';
    public $export_markets      = '';
    public $certifications      = '';
    public $logo_file;

    // Step 4: KYC Docs
    public $doc_owner_id_passport;
    public $doc_business_license;
    public $doc_tax_id;
    public $doc_selfie;

    // Step 5: Plan
    public $selected_plan = 'free';

    // UI state
    public $successMsg  = '';
    public $errorMsg    = '';
    public $countries   = [];
    public $documents   = [];
    public $currentPlan = null;

    // ─── Document validation warnings (shown to user before upload) ───
    // Maps document_type → warning message shown if file looks wrong
    public $docWarnings = [];

    public function mount()
    {
        $sellerId = Session::get('seller_id');
        $seller   = Seller::with('details', 'activeSubscription')->find($sellerId);
        $details  = $seller?->details;

        // Step 1
        $this->email = $seller?->email ?? '';
        $this->phone = $seller?->phone ?? '';

        // Resolve country_id from DB (may be stored in sellers.country_id column if migration ran,
        // otherwise try to match stored country_code back to Country table)
        $this->country_id = $this->resolveCountryId($seller);

        // Step 2
        $this->legal_business_name  = $details?->legal_business_name ?? '';
        $this->business_type        = $details?->business_type ?? '';
        $this->year_established     = $details?->year_established ?? '';
        $this->company_website      = $details?->company_website ?? '';
        $this->num_employees        = $details?->num_employees ?? '';
        $this->business_address     = $details?->business_address ?? '';
        $this->city                 = $details?->city ?? '';
        $this->state_province       = $details?->state_province ?? '';
        $this->business_country_id  = $details?->business_country_id ?? '';

        // Step 3
        $this->company_description  = $details?->company_description ?? '';
        $this->main_products        = $details?->main_products ?? '';
        $this->factory_size_sqm     = $details?->factory_size_sqm ?? '';
        $this->production_capacity  = $details?->production_capacity ?? '';
        $this->export_markets       = $details?->export_markets ?? '';
        $this->certifications       = $details?->certifications ?? '';

        // Step 5
        $this->currentPlan   = $seller?->activeSubscription;
        $this->selected_plan = $this->currentPlan?->plan_name ?? 'free';

        // Load supporting data
        $this->countries = Country::orderBy('short_name')->get();
        $this->loadDocuments($sellerId);

        // Resume from saved step
        $savedStep        = (int)($details?->onboarding_step ?? 1);
        $this->activeStep = min(max($savedStep, 1), 5);
    }

    // Try to find the country_id for the current seller
    private function resolveCountryId($seller): string
    {
        if (!$seller) return '';

        // 1. If sellers table has country_id column (migration ran), use it directly
        try {
            $raw = DB::table('sellers')->where('id', $seller->id)->value('country_id');
            if ($raw) return (string)$raw;
        } catch (\Exception $e) {}

        // 2. Fallback: find country by stored country_code via short_name first 2 chars
        if ($seller->country_code) {
            $match = Country::all()->first(function ($c) use ($seller) {
                return strtoupper(substr($c->short_name, 0, 2)) === strtoupper($seller->country_code);
            });
            if ($match) return (string)$match->country_id;
        }

        return '';
    }

    private function loadDocuments(string $sellerId): void
    {
        $this->documents = SellerDocument::where('seller_id', $sellerId)
            ->where('is_latest', 1)
            ->get()
            ->keyBy('document_type');
    }

    // ── Completion ────────────────────────────────────────────
    public function getCompletionProperty(): int
    {
        $checks = [
            !empty($this->phone),
            !empty($this->country_id),
            !empty($this->legal_business_name),
            !empty($this->business_type),
            !empty($this->business_address),
            !empty($this->city),
            !empty($this->num_employees),
            !empty($this->company_description),
            !empty($this->main_products),
            !empty($this->selected_plan),
            $this->documents->has('business_registration'),
            $this->documents->has('owner_id_passport'),
            $this->documents->has('tax_id'),
        ];
        return (int) round(count(array_filter($checks)) / count($checks) * 100);
    }

    public function getStepScoreProperty(): array
    {
        return array_combine([1,2,3,4,5], array_map([$this,'stepScore'], [1,2,3,4,5]));
    }

    private function stepScore(int $step): int
    {
        $fields = match($step) {
            1 => [!empty($this->phone), !empty($this->country_id)],
            2 => [
                !empty($this->legal_business_name), !empty($this->business_type),
                !empty($this->business_address), !empty($this->city),
                !empty($this->num_employees), $this->documents->has('business_registration'),
            ],
            3 => [!empty($this->company_description), !empty($this->main_products), !empty($this->export_markets)],
            4 => [$this->documents->has('owner_id_passport'), $this->documents->has('tax_id')],
            5 => [!empty($this->selected_plan)],
            default => [],
        };
        if (empty($fields)) return 0;
        return (int) round(count(array_filter($fields)) / count($fields) * 100);
    }

    // ── Step 1: Save Basic ────────────────────────────────────
    public function saveStep1()
    {
        $this->errorMsg = '';
        $this->validate([
            'phone'      => 'required|string|max:30',
            'country_id' => 'required',
        ], [
            'phone.required'      => 'Phone number is required.',
            'country_id.required' => 'Please select your country.',
        ]);

        $sellerId = Session::get('seller_id');
        $country  = Country::find($this->country_id);

        // Always save to seller_details so we don't lose data
        SellerDetail::updateOrCreate(
            ['seller_id' => $sellerId],
            ['onboarding_step' => 2]
        );

        // Save phone + country_code to sellers table
        // Also try saving country_id if column exists
        $updateData = [
            'phone'        => $this->phone,
            'country_code' => $country ? strtoupper(substr($country->short_name, 0, 2)) : DB::table('sellers')->where('id',$sellerId)->value('country_code'),
        ];

        try {
            // Check if column exists before adding it
            $hasCol = DB::getSchemaBuilder()->hasColumn('sellers', 'country_id');
            if ($hasCol) {
                $updateData['country_id'] = $this->country_id;
            }
        } catch (\Exception $e) {}

        DB::table('sellers')->where('id', $sellerId)->update($updateData);

        $this->successMsg = 'Basic info saved!';
        $this->activeStep = 2;
    }

    // ── Step 2: Save Business ─────────────────────────────────
    public function saveStep2()
    {
        $this->errorMsg = '';

        // Fix URL: add https:// if user typed without protocol
        if (!empty($this->company_website) && !preg_match('#^https?://#i', $this->company_website)) {
            $this->company_website = 'https://' . $this->company_website;
        }

        $this->validate([
            'legal_business_name' => 'required|string|max:255',
            'business_type'       => 'required|string',
            'business_address'    => 'required|string',
            'city'                => 'required|string|max:100',
            'num_employees'       => 'required|string',
            'year_established'    => 'nullable|digits:4|integer|min:1800|max:' . date('Y'),
            'company_website'     => 'nullable|string|max:255',   // URL validated manually above
        ], [
            'legal_business_name.required' => 'Business name is required.',
            'business_type.required'       => 'Please select a business type.',
            'business_address.required'    => 'Business address is required.',
            'city.required'                => 'City is required.',
            'num_employees.required'       => 'Please select number of employees.',
        ]);

        $sellerId = Session::get('seller_id');

        $data = [
            'legal_business_name' => $this->legal_business_name,
            'business_type'       => $this->business_type,
            'year_established'    => $this->year_established ?: null,
            'company_website'     => $this->company_website ?: null,
            'num_employees'       => $this->num_employees,
            'business_address'    => $this->business_address,
            'city'                => $this->city,
            'state_province'      => $this->state_province,
            'onboarding_step'     => 3,
        ];

        // Try saving business_country_id if column exists
        try {
            $hasCol = DB::getSchemaBuilder()->hasColumn('seller_details', 'business_country_id');
            if ($hasCol) {
                $data['business_country_id'] = $this->business_country_id ?: null;
            } else {
                // Fallback: store country name in business_country_code
                if ($this->business_country_id) {
                    $c = Country::find($this->business_country_id);
                    $data['business_country_code'] = $c ? strtoupper(substr($c->short_name, 0, 2)) : null;
                }
            }
        } catch (\Exception $e) {}

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], $data);

        // Upload business reg doc if provided
        if ($this->doc_business_registration) {
            $this->uploadDoc('business_registration', $this->doc_business_registration);
            $this->reset('doc_business_registration');
        }

        $this->successMsg = 'Business details saved!';
        $this->activeStep = 3;
    }

    // ── Step 3: Save Company Profile ──────────────────────────
    public function saveStep3()
    {
        $this->errorMsg = '';
        $this->validate([
            'company_description' => 'nullable|string|max:2000',
            'main_products'       => 'nullable|string|max:500',
            'factory_size_sqm'    => 'nullable|integer|min:1',
            'production_capacity' => 'nullable|string|max:200',
            'export_markets'      => 'nullable|string|max:500',
            'certifications'      => 'nullable|string|max:500',
            'logo_file'           => 'nullable|file|mimes:png,svg,jpg,jpeg|max:2048',
        ]);

        $sellerId = Session::get('seller_id');
        $data = [
            'company_description' => $this->company_description ?: null,
            'main_products'       => $this->main_products ?: null,
            'factory_size_sqm'    => $this->factory_size_sqm ?: null,
            'production_capacity' => $this->production_capacity ?: null,
            'export_markets'      => $this->export_markets ?: null,
            'certifications'      => $this->certifications ?: null,
            'onboarding_step'     => 4,
        ];

        if ($this->logo_file) {
            $path = $this->logo_file->storeAs(
                'seller-assets/' . $sellerId,
                'logo.' . $this->logo_file->getClientOriginalExtension(),
                'public'
            );
            $data['logo_url'] = $path;
            $this->reset('logo_file');
        }

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], $data);

        $this->successMsg = 'Company profile saved!';
        $this->activeStep = 4;
    }

    // ── Step 4: Save Docs ─────────────────────────────────────
    public function saveStep4()
    {
        $this->errorMsg = '';

        // Validate each uploaded doc
        $rules = [];
        foreach (['owner_id_passport','business_license','tax_id','selfie'] as $type) {
            $field = 'doc_' . $type;
            if ($this->$field) {
                $rules[$field] = 'file|mimes:pdf,jpg,jpeg,png|max:5120'; // 5MB
            }
        }
        if (!empty($rules)) {
            $this->validate($rules, [
                'doc_owner_id_passport.mimes' => 'Owner ID must be PDF, JPG or PNG.',
                'doc_business_license.mimes'  => 'Business License must be PDF, JPG or PNG.',
                'doc_tax_id.mimes'            => 'Tax ID must be PDF, JPG or PNG.',
                'doc_selfie.mimes'            => 'Selfie must be JPG or PNG.',
                'doc_owner_id_passport.max'   => 'File too large (max 5MB).',
                'doc_business_license.max'    => 'File too large (max 5MB).',
                'doc_tax_id.max'              => 'File too large (max 5MB).',
                'doc_selfie.max'              => 'File too large (max 5MB).',
            ]);
        }

        $sellerId  = Session::get('seller_id');
        $uploaded  = 0;

        foreach (['owner_id_passport','business_license','tax_id','selfie'] as $type) {
            $field = 'doc_' . $type;
            if ($this->$field) {
                $this->uploadDoc($type, $this->$field);
                $this->reset($field);
                $uploaded++;
            }
        }

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], ['onboarding_step' => 5]);

        $this->successMsg = $uploaded > 0 ? "{$uploaded} document(s) uploaded successfully!" : 'Proceeding to plan selection.';
        $this->activeStep = 5;
    }

    // ── Step 5: Save Plan & Submit ────────────────────────────
    public function saveStep5()
    {
        $this->validate(['selected_plan' => 'required|in:free,growth,global']);

        $sellerId = Session::get('seller_id');

        $existing = SellerSubscription::where('seller_id', $sellerId)->where('status','active')->first();

        if (!$existing || $existing->plan_name !== $this->selected_plan) {
            if ($existing) {
                $existing->update(['status' => 'cancelled', 'cancelled_at' => now()]);
            }

            $plans = [
                'free'   => ['price'=>0,   'max'=>10,  'badge'=>0,'rfq'=>0,'analytics'=>0,'global'=>0,'ai'=>0,'premium'=>0,'cycle'=>'lifetime'],
                'growth' => ['price'=>49,  'max'=>100, 'badge'=>1,'rfq'=>1,'analytics'=>1,'global'=>0,'ai'=>0,'premium'=>0,'cycle'=>'monthly'],
                'global' => ['price'=>199, 'max'=>null,'badge'=>1,'rfq'=>1,'analytics'=>1,'global'=>1,'ai'=>1,'premium'=>1,'cycle'=>'monthly'],
            ];
            $p = $plans[$this->selected_plan];

            SellerSubscription::create([
                'id'                   => (string) Str::uuid(),
                'seller_id'            => $sellerId,
                'plan_name'            => $this->selected_plan,
                'price_usd'            => $p['price'],
                'billing_cycle'        => $p['cycle'],
                'max_products'         => $p['max'],
                'has_verified_badge'   => $p['badge'],
                'has_rfq_priority'     => $p['rfq'],
                'has_analytics'        => $p['analytics'],
                'has_global_promotion' => $p['global'],
                'has_ai_buyer_matching'=> $p['ai'],
                'has_premium_badge'    => $p['premium'],
                'status'               => 'active',
                'started_at'           => now(),
            ]);
        }

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], [
            'kyc_status'      => 'submitted',
            'submitted_at'    => now(),
            'onboarding_step' => 5,
        ]);

        DB::table('sellers')->where('id', $sellerId)->update(['status' => 'under_review']);

        session(['seller_name' => $this->legal_business_name]);

        return redirect()->route('seller.dashboard')
            ->with('login_success', '🎉 Profile submitted! Your account is under review (24–48 hrs).');
    }

    // ── Shared doc upload helper ──────────────────────────────
    private function uploadDoc(string $type, $file): void
    {
        $sellerId = Session::get('seller_id');
        $ext      = $file->getClientOriginalExtension();
        $fileName = $sellerId . '_' . $type . '_' . time() . '.' . $ext;
        $path     = $file->storeAs('seller-docs/' . $sellerId, $fileName, 'public');

        SellerDocument::where('seller_id', $sellerId)
            ->where('document_type', $type)
            ->update(['is_latest' => 0]);

        SellerDocument::create([
            'id'              => (string) Str::uuid(),
            'seller_id'       => $sellerId,
            'document_type'   => $type,
            'file_name'       => $fileName,
            'file_size_bytes' => $file->getSize(),
            'mime_type'       => $file->getMimeType(),
            'storage_url'     => $path,
            'review_status'   => 'pending',
            'is_latest'       => 1,
        ]);

        $this->loadDocuments($sellerId);
    }

    // Called via wire:change on file inputs — shows a warning if filename looks suspicious
    public function checkDocFile(string $docType, string $fileName): void
    {
        $nameLower = strtolower($fileName);

        $hints = [
            'owner_id_passport' => [
                'keywords' => ['passport','id','aadhaar','aadhar','license','driving','pan','national','identity','voter'],
                'warning'  => 'Please upload a government-issued ID (passport, Aadhaar, driving licence, etc.).',
            ],
            'business_registration' => [
                'keywords' => ['registration','certificate','incorporation','company','business','reg','gst','cin'],
                'warning'  => 'Please upload your official business registration or incorporation certificate.',
            ],
            'tax_id' => [
                'keywords' => ['gst','tax','pan','tin','vat','ein','itr','return','certificate'],
                'warning'  => 'Please upload your GST certificate, PAN card, or tax identification document.',
            ],
            'business_license' => [
                'keywords' => ['license','licence','permit','trade','shop','establishment'],
                'warning'  => 'Please upload your trade license or business permit.',
            ],
            'selfie' => [
                'keywords' => ['selfie','photo','pic','image','jpg','jpeg','png','face'],
                'warning'  => 'Please upload a clear photo of yourself holding your ID.',
            ],
        ];

        if (!isset($hints[$docType])) return;

        $matched = collect($hints[$docType]['keywords'])
            ->contains(fn($kw) => str_contains($nameLower, $kw));

        if (!$matched) {
            // Filename doesn't match expected keywords — warn the user
            $this->docWarnings[$docType] = $hints[$docType]['warning'];
        } else {
            unset($this->docWarnings[$docType]);
        }
    }

    public function goToStep(int $step): void
    {
        $this->activeStep  = $step;
        $this->successMsg  = '';
        $this->errorMsg    = '';
        $this->docWarnings = [];
    }

    public function render()
    {
        $seller = Seller::with('details','documents','activeSubscription')
            ->find(Session::get('seller_id'));

        return view('livewire.seller.profile', [
            'seller'     => $seller,
            'completion' => $this->completion,
            'stepScore'  => $this->stepScore,
        ]);
    }
}
?>