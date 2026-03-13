<?php
// FILE: app/Livewire/Seller/Profile.php

namespace App\Livewire\Seller;

use App\Models\Seller;
use App\Models\SellerDetail;
use App\Models\SellerDocument;
use App\Models\SellerSubscription;
use App\Models\Country;
use App\Services\DocumentVerifier;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $activeStep = 1;

    // Step 1
    public $email      = '';
    public $phone      = '';
    public $country_id = '';

    // Step 2
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

    // Step 3
    public $company_description = '';
    public $main_products       = '';
    public $factory_size_sqm    = '';
    public $production_capacity = '';
    public $export_markets      = '';
    public $certifications      = '';
    public $logo_file;

    // Step 4
    public $doc_owner_id_passport;
    public $doc_business_license;
    public $doc_tax_id;
    public $doc_selfie;

    // Step 5
    public $selected_plan = 'free';

    // UI state
    public $successMsg  = '';
    public $errorMsg    = '';
    public $countries   = [];
    public $documents   = [];
    public $currentPlan = null;

    // AI verification results per doc type
    // Shape: ['owner_id_passport' => ['status'=>'ok'|'warn'|'checking', 'message'=>'...']]
    public $docVerification = [];

    public function mount()
    {
        $sellerId = Session::get('seller_id');
        $seller   = Seller::with('details', 'activeSubscription')->find($sellerId);
        $details  = $seller?->details;

        $this->email      = $seller?->email ?? '';
        $this->phone      = $seller?->phone ?? '';
        $this->country_id = $this->resolveCountryId($seller);

        $this->legal_business_name  = $details?->legal_business_name ?? '';
        $this->business_type        = $details?->business_type ?? '';
        $this->year_established     = $details?->year_established ?? '';
        $this->company_website      = $details?->company_website ?? '';
        $this->num_employees        = $details?->num_employees ?? '';
        $this->business_address     = $details?->business_address ?? '';
        $this->city                 = $details?->city ?? '';
        $this->state_province       = $details?->state_province ?? '';
        $this->business_country_id  = $details?->business_country_id ?? '';

        $this->company_description  = $details?->company_description ?? '';
        $this->main_products        = $details?->main_products ?? '';
        $this->factory_size_sqm     = $details?->factory_size_sqm ?? '';
        $this->production_capacity  = $details?->production_capacity ?? '';
        $this->export_markets       = $details?->export_markets ?? '';
        $this->certifications       = $details?->certifications ?? '';

        $this->currentPlan   = $seller?->activeSubscription;
        $this->selected_plan = $this->currentPlan?->plan_name ?? 'free';

        $this->countries = Country::orderBy('short_name')->get();
        $this->loadDocuments($sellerId);

        $savedStep        = (int)($details?->onboarding_step ?? 1);
        $this->activeStep = min(max($savedStep, 1), 5);
    }

    private function resolveCountryId($seller): string
    {
        if (!$seller) return '';
        try {
            $raw = DB::table('sellers')->where('id', $seller->id)->value('country_id');
            if ($raw) return (string)$raw;
        } catch (\Exception $e) {}
        if ($seller->country_code) {
            $match = Country::all()->first(fn($c) =>
                strtoupper(substr($c->short_name, 0, 2)) === strtoupper($seller->country_code)
            );
            if ($match) return (string)$match->country_id;
        }
        return '';
    }

    private function loadDocuments(string $sellerId): void
    {
        $this->documents = SellerDocument::where('seller_id', $sellerId)
            ->where('is_latest', 1)->get()->keyBy('document_type');
    }

    // ── Completion ────────────────────────────────────────────
    public function getCompletionProperty(): int
    {
        $checks = [
            !empty($this->phone), !empty($this->country_id),
            !empty($this->legal_business_name), !empty($this->business_type),
            !empty($this->business_address), !empty($this->city), !empty($this->num_employees),
            !empty($this->company_description), !empty($this->main_products), !empty($this->selected_plan),
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
            2 => [!empty($this->legal_business_name), !empty($this->business_type),
                  !empty($this->business_address), !empty($this->city), !empty($this->num_employees),
                  $this->documents->has('business_registration')],
            3 => [!empty($this->company_description), !empty($this->main_products), !empty($this->export_markets)],
            4 => [$this->documents->has('owner_id_passport'), $this->documents->has('tax_id')],
            5 => [!empty($this->selected_plan)],
            default => [],
        };
        if (empty($fields)) return 0;
        return (int) round(count(array_filter($fields)) / count($fields) * 100);
    }

    // ── Step 1 ────────────────────────────────────────────────
    public function saveStep1()
    {
        $this->errorMsg = '';
        $this->validate(
            ['phone' => 'required|string|max:30', 'country_id' => 'required'],
            ['phone.required' => 'Phone number is required.', 'country_id.required' => 'Please select your country.']
        );

        $sellerId = Session::get('seller_id');
        $country  = Country::find($this->country_id);
        $update   = ['phone' => $this->phone];
        if ($country) $update['country_code'] = strtoupper(substr($country->short_name, 0, 2));

        try {
            if (DB::getSchemaBuilder()->hasColumn('sellers', 'country_id')) {
                $update['country_id'] = $this->country_id;
            }
        } catch (\Exception $e) {}

        DB::table('sellers')->where('id', $sellerId)->update($update);
        SellerDetail::updateOrCreate(['seller_id' => $sellerId], ['onboarding_step' => 2]);

        $this->successMsg = 'Basic info saved!';
        $this->activeStep = 2;
    }

    // ── Step 2 ────────────────────────────────────────────────
    public function saveStep2()
    {
        $this->errorMsg = '';

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
            'company_website'     => 'nullable|string|max:255',
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

        try {
            if (DB::getSchemaBuilder()->hasColumn('seller_details', 'business_country_id')) {
                $data['business_country_id'] = $this->business_country_id ?: null;
            } elseif ($this->business_country_id) {
                $c = Country::find($this->business_country_id);
                $data['business_country_code'] = $c ? strtoupper(substr($c->short_name, 0, 2)) : null;
            }
        } catch (\Exception $e) {}

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], $data);

        if ($this->doc_business_registration) {
            $this->uploadDocWithVerification('business_registration', $this->doc_business_registration);
            $this->reset('doc_business_registration');
        }

        $this->successMsg = 'Business details saved!';
        $this->activeStep = 3;
    }

    // ── Step 3 ────────────────────────────────────────────────
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
            $path = $this->logo_file->storeAs('seller-assets/'.$sellerId,
                'logo.'.$this->logo_file->getClientOriginalExtension(), 'public');
            $data['logo_url'] = $path;
            $this->reset('logo_file');
        }

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], $data);
        $this->successMsg = 'Company profile saved!';
        $this->activeStep = 4;
    }

    // ── Step 4 ────────────────────────────────────────────────
    public function saveStep4()
    {
        $this->errorMsg = '';
        $rules = [];
        foreach (['owner_id_passport','business_license','tax_id','selfie'] as $t) {
            if ($this->{'doc_'.$t}) $rules['doc_'.$t] = 'file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        if ($rules) $this->validate($rules);

        $sellerId = Session::get('seller_id');
        $uploaded = 0;

        foreach (['owner_id_passport','business_license','tax_id','selfie'] as $type) {
            $field = 'doc_' . $type;
            if ($this->$field) {
                $this->uploadDocWithVerification($type, $this->$field);
                $this->reset($field);
                $uploaded++;
            }
        }

        SellerDetail::updateOrCreate(['seller_id' => $sellerId], ['onboarding_step' => 5]);
        $this->successMsg = $uploaded > 0 ? "{$uploaded} document(s) uploaded!" : 'Proceeding to plan selection.';
        $this->activeStep = 5;
    }

    // ── Step 5 ────────────────────────────────────────────────
    public function saveStep5()
    {
        $this->validate(['selected_plan' => 'required|in:free,growth,global']);
        $sellerId = Session::get('seller_id');

        $existing = SellerSubscription::where('seller_id', $sellerId)->where('status','active')->first();
        if (!$existing || $existing->plan_name !== $this->selected_plan) {
            if ($existing) $existing->update(['status'=>'cancelled','cancelled_at'=>now()]);
            $p = [
                'free'   => ['price'=>0,  'max'=>10,  'badge'=>0,'rfq'=>0,'analytics'=>0,'global'=>0,'ai'=>0,'premium'=>0,'cycle'=>'lifetime'],
                'growth' => ['price'=>49, 'max'=>100, 'badge'=>1,'rfq'=>1,'analytics'=>1,'global'=>0,'ai'=>0,'premium'=>0,'cycle'=>'monthly'],
                'global' => ['price'=>199,'max'=>null,'badge'=>1,'rfq'=>1,'analytics'=>1,'global'=>1,'ai'=>1,'premium'=>1,'cycle'=>'monthly'],
            ][$this->selected_plan];

            SellerSubscription::create([
                'id'=>(string)Str::uuid(),'seller_id'=>$sellerId,'plan_name'=>$this->selected_plan,
                'price_usd'=>$p['price'],'billing_cycle'=>$p['cycle'],'max_products'=>$p['max'],
                'has_verified_badge'=>$p['badge'],'has_rfq_priority'=>$p['rfq'],'has_analytics'=>$p['analytics'],
                'has_global_promotion'=>$p['global'],'has_ai_buyer_matching'=>$p['ai'],
                'has_premium_badge'=>$p['premium'],'status'=>'active','started_at'=>now(),
            ]);
        }

        SellerDetail::updateOrCreate(['seller_id'=>$sellerId], [
            'kyc_status'=>'submitted','submitted_at'=>now(),'onboarding_step'=>5,
        ]);
        DB::table('sellers')->where('id',$sellerId)->update(['status'=>'under_review']);
        session(['seller_name' => $this->legal_business_name]);

        return redirect()->route('seller.dashboard')
            ->with('login_success','🎉 Profile submitted for review! We\'ll notify you within 24–48 hrs.');
    }

    // ── Upload with basic validation ─────────────────────────
    private function uploadDocWithVerification(string $type, $file): void
    {
        $sellerId = Session::get('seller_id');
        $ext      = strtolower($file->getClientOriginalExtension());
        $fileName = $sellerId . '_' . $type . '_' . time() . '.' . $ext;

        // Run basic validation BEFORE storing
        $result = DocumentVerifier::validate(
            $file->getClientOriginalName(),
            $file->getMimeType(),
            $ext,
            $file->getSize(),
            $type
        );

        // Hard block on error — do not store the file
        if (!$result['valid']) {
            $this->docVerification[$type] = [
                'status'  => 'error',
                'message' => $result['message'],
            ];
            return;
        }

        // Store the file
        $path = $file->storeAs('seller-docs/' . $sellerId, $fileName, 'public');

        // Save verification result for UI feedback
        $this->docVerification[$type] = [
            'status'  => $result['status'],   // 'ok' or 'warn'
            'message' => $result['message'],
        ];

        // Mark old docs as not latest
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

    public function goToStep(int $step): void
    {
        $this->activeStep  = $step;
        $this->successMsg  = '';
        $this->errorMsg    = '';
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