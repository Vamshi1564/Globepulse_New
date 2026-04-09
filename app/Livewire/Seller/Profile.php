<?php
// FILE: app/Livewire/Seller/Profile.php

namespace App\Livewire\Seller;

use App\Models\Seller;
use App\Models\SellerDetail;
use App\Models\SellerDocument;
use App\Models\SellerKyc;
use App\Models\Country;
use App\Models\PackagesModel;
use App\Services\DocumentVerifier;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
    public $video_file;
    public $logo_url  = '';   // persisted path — drives step score
    public $video_url = '';   // persisted path — drives step score

    // Step 4
    public $doc_owner_id_passport;
    public $doc_business_license;
    public $doc_tax_id;
    public $doc_selfie;

    // Step 5 — Package Selection (from b2b_remote_db.tbl_package_membership)
    public $selected_package_id = null;  // stores tbl_package_membership.id
    public array $packages       = [];   // loaded in mount()

    // ── Step 6: KYC ───────────────────────────────────────────────────────
    // Tab 1: Bank Account
    public string $kyc_account_holder_name         = '';
    public string $kyc_account_holder_type         = 'company';
    public string $kyc_bank_account_number         = '';
    public string $kyc_bank_account_number_confirm = '';
    public string $kyc_bank_ifsc_code              = '';
    public string $kyc_bank_swift_code             = '';
    public string $kyc_bank_name                   = '';
    public string $kyc_bank_branch_name            = '';
    public string $kyc_bank_account_type           = '';

    // Tab 2: Tax / PAN
    public bool   $kyc_is_gst_registered = false;
    public string $kyc_gstin             = '';
    public string $kyc_pan_number        = '';
    public string $kyc_tan_number        = '';

    // Tab 3: Documents (CCAvenue-specific — not already collected in Step 4)
    public $kyc_upload_cancelled_cheque;
    public $kyc_upload_pan_card;
    public $kyc_upload_incorporation_cert;
    public $kyc_upload_moa;

    public string $kyc_doc_cancelled_cheque        = '';
    public string $kyc_doc_cancelled_cheque_name   = '';
    public string $kyc_doc_pan_card                = '';
    public string $kyc_doc_pan_card_name           = '';
    public string $kyc_doc_incorporation_cert      = '';
    public string $kyc_doc_incorporation_cert_name = '';
    public string $kyc_doc_moa                     = '';
    public string $kyc_doc_moa_name                = '';

    // Declaration
    public bool   $kyc_declaration = false;

    // KYC state
    public int    $kycActiveTab  = 1;
    public string $kycStatus     = 'draft';
    public bool   $kycIsLocked   = false;
    public array  $kycTabScores  = [];
    // ── End Step 6 ────────────────────────────────────────────────────────

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
        $seller   = Seller::with('details')->find($sellerId);
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
        $this->logo_url             = $details?->logo_url ?? '';
        $this->video_url            = $details?->video_url ?? '';

        // Load packages from b2b_remote_db.tbl_package_membership via PackagesModel
        $this->packages = PackagesModel::orderBy('id')->get()->toArray();

        // Set currently selected package from sellers.package_id
        $this->selected_package_id = $seller?->package_id ?? null;

        $this->countries = Country::orderBy('short_name')->get();
        $this->loadDocuments($sellerId);

        $savedStep        = (int)($details?->onboarding_step ?? 1);
        $this->activeStep = min(max($savedStep, 1), 6);

        // ── Load KYC ────────────────────────────────────────────
        $this->loadKyc($sellerId);
    }

    // ── KYC: Load ───────────────────────────────────────────────────────────
    private function loadKyc(string $sellerId): void
    {
        $kyc = SellerKyc::where('seller_id', $sellerId)->first();
        if (!$kyc) { $this->kycTabScores = $this->computeKycTabScores(); return; }

        // Bank
        $this->kyc_account_holder_name         = $kyc->account_holder_name ?? '';
        $this->kyc_account_holder_type         = $kyc->account_holder_type ?? 'company';
        $this->kyc_bank_account_number         = $kyc->bank_account_number ?? '';
        $this->kyc_bank_account_number_confirm = $kyc->bank_account_number ?? '';
        $this->kyc_bank_ifsc_code              = $kyc->bank_ifsc_code ?? '';
        $this->kyc_bank_swift_code             = $kyc->bank_swift_code ?? '';
        $this->kyc_bank_name                   = $kyc->bank_name ?? '';
        $this->kyc_bank_branch_name            = $kyc->bank_branch_name ?? '';
        $this->kyc_bank_account_type           = $kyc->bank_account_type ?? '';

        // Tax
        $this->kyc_is_gst_registered = (bool)($kyc->is_gst_registered ?? false);
        $this->kyc_gstin             = $kyc->gstin ?? '';
        $this->kyc_pan_number        = $kyc->pan_number ?? '';
        $this->kyc_tan_number        = $kyc->tan_number ?? '';

        // Documents
        $this->kyc_doc_cancelled_cheque        = $kyc->doc_cancelled_cheque ?? '';
        $this->kyc_doc_cancelled_cheque_name   = $kyc->doc_cancelled_cheque_name ?? '';
        $this->kyc_doc_pan_card                = $kyc->doc_pan_card ?? '';
        $this->kyc_doc_pan_card_name           = $kyc->doc_pan_card_name ?? '';
        $this->kyc_doc_incorporation_cert      = $kyc->doc_incorporation_cert ?? '';
        $this->kyc_doc_incorporation_cert_name = $kyc->doc_incorporation_cert_name ?? '';
        $this->kyc_doc_moa                     = $kyc->doc_moa ?? '';
        $this->kyc_doc_moa_name                = $kyc->doc_moa_name ?? '';

        $this->kycStatus    = $kyc->internal_status ?? 'draft';
        $this->kycIsLocked  = in_array($this->kycStatus, ['submitted', 'approved']);
        $this->kycTabScores = $this->computeKycTabScores();
    }

    // ── KYC: Tab scores — only 3 tabs now ──────────────────────────────────
    private function computeKycTabScores(): array
    {
        return [1=>$this->kycTabScore(1), 2=>$this->kycTabScore(2), 3=>$this->kycTabScore(3)];
    }

    private function kycTabScore(int $tab): int
    {
        $fields = match($tab) {
            1 => [
                !empty($this->kyc_account_holder_name),
                !empty($this->kyc_bank_account_number),
                !empty($this->kyc_bank_ifsc_code),
                !empty($this->kyc_bank_name),
                !empty($this->kyc_bank_account_type),
            ],
            2 => [
                !empty($this->kyc_pan_number),
                !$this->kyc_is_gst_registered || !empty($this->kyc_gstin),
            ],
            3 => [
                !empty($this->kyc_doc_cancelled_cheque),
                !empty($this->kyc_doc_pan_card),
                !empty($this->kyc_doc_incorporation_cert),
            ],
            default => [],
        };
        if (empty($fields)) return 0;
        return (int) round(count(array_filter($fields)) / count($fields) * 100);
    }

    public function getKycOverallScoreProperty(): int
    {
        $s = array_map(fn($t) => $this->kycTabScore($t), [1, 2, 3]);
        return (int) round(array_sum($s) / count($s));
    }

    // ── KYC: Navigation (enforces sequential locking) ────────────────────────
    public function goToKycTab(int $tab): void
    {
        if ($this->kycIsLocked) {
            $this->kycActiveTab = $tab; $this->successMsg = ''; $this->errorMsg = ''; return;
        }
        if ($tab <= $this->kycActiveTab) {
            $this->kycActiveTab = $tab; $this->successMsg = ''; $this->errorMsg = ''; return;
        }
        for ($i = 1; $i < $tab; $i++) {
            if (($this->kycTabScores[$i] ?? 0) < 100) {
                $this->errorMsg     = 'Please complete Step ' . $i . ' before proceeding.';
                $this->kycActiveTab = $i;
                return;
            }
        }
        $this->kycActiveTab = $tab; $this->successMsg = ''; $this->errorMsg = '';
    }

    // ── KYC: Save Tab 1 — Bank ───────────────────────────────────────────────
    public function saveKycTab1(): void
    {
        $this->errorMsg = '';
        $this->validate([
            'kyc_account_holder_name'         => 'required|string|max:200',
            'kyc_account_holder_type'         => 'required|in:individual,company',
            'kyc_bank_account_number'         => 'required|string|min:9|max:20|regex:/^[0-9]+$/',
            'kyc_bank_account_number_confirm' => 'required|same:kyc_bank_account_number',
            'kyc_bank_ifsc_code'              => ['required','string','regex:/^[A-Z]{4}0[A-Z0-9]{6}$/i'],
            'kyc_bank_name'                   => 'required|string|max:150',
            'kyc_bank_account_type'           => 'required|in:savings,current,business',
        ], [
            'kyc_bank_account_number.regex'          => 'Account number must contain digits only.',
            'kyc_bank_account_number_confirm.same'   => 'Account numbers do not match. Please re-enter carefully.',
            'kyc_bank_ifsc_code.regex'               => 'Invalid IFSC format. Example: HDFC0001234',
        ]);
        $this->saveKycFields([
            'account_holder_name' => trim($this->kyc_account_holder_name),
            'account_holder_type' => $this->kyc_account_holder_type,
            'bank_account_number' => $this->kyc_bank_account_number,
            'bank_ifsc_code'      => strtoupper(trim($this->kyc_bank_ifsc_code)),
            'bank_swift_code'     => $this->kyc_bank_swift_code ?: null,
            'bank_name'           => trim($this->kyc_bank_name),
            'bank_branch_name'    => $this->kyc_bank_branch_name ?: null,
            'bank_account_type'   => $this->kyc_bank_account_type,
        ]);
        $this->successMsg   = '✅ Bank details saved.';
        $this->kycTabScores = $this->computeKycTabScores();
        $this->kycActiveTab = 2;
    }

    // ── KYC: Save Tab 2 — Tax ────────────────────────────────────────────────
    public function saveKycTab2(): void
    {
        $this->errorMsg = '';
        $rules = ['kyc_pan_number' => ['required','string','regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/i']];
        if ($this->kyc_is_gst_registered) {
            $rules['kyc_gstin'] = ['required','string','regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i'];
        }
        $this->validate($rules, [
            'kyc_pan_number.regex' => 'Invalid PAN. Format: 5 letters, 4 digits, 1 letter. Example: ABCDE1234F',
            'kyc_gstin.regex'      => 'Invalid GSTIN. Must be 15 characters. Example: 22AAAAA0000A1Z5',
        ]);
        $this->saveKycFields([
            'pan_number'        => strtoupper(trim($this->kyc_pan_number)),
            'gstin'             => $this->kyc_is_gst_registered ? strtoupper(trim($this->kyc_gstin)) : null,
            'tan_number'        => $this->kyc_tan_number ? strtoupper(trim($this->kyc_tan_number)) : null,
            'is_gst_registered' => $this->kyc_is_gst_registered,
        ]);
        $this->successMsg   = '✅ Tax details saved.';
        $this->kycTabScores = $this->computeKycTabScores();
        $this->kycActiveTab = 3;
    }

    // ── KYC: Save Tab 3 — Documents ──────────────────────────────────────────
    public function saveKycTab3(): void
    {
        $this->errorMsg = '';
        $sellerId = Session::get('seller_id');

        $rules = [];
        foreach (['kyc_upload_cancelled_cheque','kyc_upload_pan_card','kyc_upload_incorporation_cert','kyc_upload_moa'] as $f) {
            if ($this->$f) $rules[$f] = 'file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        if (!empty($rules)) {
            $this->validate($rules, [
                'kyc_upload_cancelled_cheque.mimes'   => 'Must be PDF or image.',
                'kyc_upload_pan_card.mimes'           => 'Must be PDF or image.',
                'kyc_upload_incorporation_cert.mimes' => 'Must be PDF or image.',
                'kyc_upload_moa.mimes'                => 'Must be PDF or image.',
                'kyc_upload_cancelled_cheque.max'     => 'Max file size is 5 MB.',
                'kyc_upload_pan_card.max'             => 'Max file size is 5 MB.',
                'kyc_upload_incorporation_cert.max'   => 'Max file size is 5 MB.',
            ]);
        }

        $missing = [];
        if (empty($this->kyc_doc_cancelled_cheque) && !$this->kyc_upload_cancelled_cheque) $missing[] = 'Cancelled Cheque / Bank Statement';
        if (empty($this->kyc_doc_pan_card) && !$this->kyc_upload_pan_card)                 $missing[] = 'PAN Card';
        if (empty($this->kyc_doc_incorporation_cert) && !$this->kyc_upload_incorporation_cert) $missing[] = 'Incorporation Certificate';
        if (!empty($missing)) { $this->errorMsg = 'Please upload: ' . implode(', ', $missing) . '.'; return; }

        $docMap = [
            'kyc_upload_cancelled_cheque'   => ['doc_cancelled_cheque',   'doc_cancelled_cheque_name',   'kyc_doc_cancelled_cheque',   'kyc_doc_cancelled_cheque_name'],
            'kyc_upload_pan_card'           => ['doc_pan_card',           'doc_pan_card_name',           'kyc_doc_pan_card',           'kyc_doc_pan_card_name'],
            'kyc_upload_incorporation_cert' => ['doc_incorporation_cert', 'doc_incorporation_cert_name', 'kyc_doc_incorporation_cert', 'kyc_doc_incorporation_cert_name'],
            'kyc_upload_moa'                => ['doc_moa',                'doc_moa_name',                'kyc_doc_moa',                'kyc_doc_moa_name'],
        ];
        $data = [];
        foreach ($docMap as $uploadField => [$dbPath, $dbName, $localPath, $localName]) {
            if ($this->$uploadField) {
                $file     = $this->$uploadField;
                $ext      = strtolower($file->getClientOriginalExtension());
                $fileName = $sellerId . '_kyc_' . $uploadField . '_' . time() . '.' . $ext;
                $disk     = config('filesystems.default','public') === 's3' ? ['disk'=>'s3','visibility'=>'public'] : 'public';
                $path     = $file->storeAs('seller-kyc/' . $sellerId, $fileName, $disk);
                $data[$dbPath] = $path;
                $data[$dbName] = $file->getClientOriginalName();
                $this->$localPath = $path;
                $this->$localName = $file->getClientOriginalName();
                $this->reset($uploadField);
            }
        }
        if (!empty($data)) $this->saveKycFields($data);

        $this->successMsg   = '✅ Documents saved. Please review and submit.';
        $this->kycTabScores = $this->computeKycTabScores();
    }


    // ── KYC: Submit ──────────────────────────────────────────────────────────
    public function submitKyc(): void
    {
        $this->errorMsg = '';
        $this->validate(['kyc_declaration' => 'accepted'], [
            'kyc_declaration.accepted' => 'You must confirm the declaration before submitting.',
        ]);
        $sellerId = Session::get('seller_id');
        $kyc      = SellerKyc::where('seller_id', $sellerId)->first();
        if (!$kyc || !$kyc->isCoreComplete()) {
            $this->errorMsg = 'Some required information is missing. Go back and complete all steps.'; return;
        }
        $kyc->update(['internal_status' => 'submitted', 'submitted_at' => now()]);
        $this->kycStatus    = 'submitted';
        $this->kycIsLocked  = true;
        $this->kycTabScores = $this->computeKycTabScores();
        $this->successMsg   = '🎉 KYC submitted! Our team will review within 2–3 business days.';
    }

    // ── KYC: Upsert helper ───────────────────────────────────────────────────
    private function saveKycFields(array $data): void
    {
        $sellerId = Session::get('seller_id');
        SellerKyc::updateOrCreate(['seller_id' => $sellerId], array_merge($data, ['updated_at' => now()]));
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
            !empty($this->company_description), !empty($this->main_products),
            !empty($this->logo_url),
            !empty($this->selected_package_id),
            $this->documents->has('business_registration'),
            $this->documents->has('owner_id_passport'),
            $this->documents->has('tax_id'),
        ];
        return (int) round(count(array_filter($checks)) / count($checks) * 100);
    }

    public function getStepScoreProperty(): array
    {
        return array_combine([1,2,3,4,5,6], array_map([$this,'stepScore'], [1,2,3,4,5,6]));
    }

    private function stepScore(int $step): int
    {
        $fields = match($step) {
            1 => [!empty($this->phone), !empty($this->country_id)],
            2 => [!empty($this->legal_business_name), !empty($this->business_type),
                  !empty($this->business_address), !empty($this->city), !empty($this->num_employees),
                  $this->documents->has('business_registration')],
            3 => [!empty($this->company_description),!empty($this->main_products),
                  !empty($this->export_markets),!empty($this->logo_url),!empty($this->video_url)],
            4 => [$this->documents->has('owner_id_passport'), $this->documents->has('tax_id')],
            5 => [!empty($this->selected_package_id)],
            6 => [($this->kycTabScores[1]??0)===100,($this->kycTabScores[2]??0)===100,
                  ($this->kycTabScores[3]??0)===100],
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
        [
            'phone' => ['required', 'regex:/^[0-9+\-\s]+$/', 'min:10', 'max:30'],
            'country_id' => 'required',
        ],
        [
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone must contain only numbers and + symbol',
            'country_id.required' => 'Please select your country.',
        ]
        );

        $sellerId = Session::get('seller_id');
        $country  = Country::find($this->country_id);
        $update   = ['phone' => $this->phone];
        if ($country) {
            // Use dedicated ISO code column if available, otherwise skip overwriting country_code
            // to avoid corrupting it with a substr hack (e.g. 'India' -> 'IN' coincidentally works
            // but 'United States' -> 'UN' is wrong). country_id FK is the reliable reference.
            $isoCode = $country->iso_code
                ?? $country->code
                ?? $country->iso2
                ?? $country->alpha2
                ?? null;
            if ($isoCode) {
                $update['country_code'] = strtoupper($isoCode);
            }
            // Always save country_id — that's the reliable FK
        }

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
            'legal_business_name' => 'required|regex:/^[a-zA-Z0-9\s\.\-&]+$/|max:255',
            'business_type'       => 'required|string',
            'business_address' => 'required|string|min:5|max:500',
            'city' => 'required|regex:/^[a-zA-Z\s]+$/|max:100',
            'num_employees'       => 'required|string',
            'year_established'    => 'nullable|digits:4|integer|min:1800|max:' . date('Y'),
            'company_website' => 'nullable|url|max:255',
        ],
        [
            'legal_business_name.regex' => 'Only letters, numbers, . & - allowed',
            'city.regex' => 'City must contain only alphabets',
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
                $isoC = $c->iso_code ?? $c->code ?? $c->iso2 ?? $c->alpha2 ?? null;
                $data['business_country_code'] = $isoC ? strtoupper($isoC) : null;
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
            'company_description' => 'nullable|string|min:10|max:2000',
            'main_products'       => 'nullable|regex:/^[a-zA-Z0-9,\s]+$/|max:500',
            'factory_size_sqm'    => 'nullable|integer|min:1',
            'production_capacity' => 'nullable|string|max:200',
            'export_markets'      => 'nullable|regex:/^[a-zA-Z,\s]+$/|max:500',
            'certifications'      => 'nullable|string|max:500',
            'logo_file'           => 'nullable|file|mimes:png,svg,jpg,jpeg|max:2048',
        ],
        [
        // Company Description
        'company_description.min' => 'Company description must be at least 10 characters',
        'company_description.max' => 'Company description cannot exceed 2000 characters',

        // Main Products
        'main_products.regex' => 'Main products can only contain letters, numbers, and commas',
        'main_products.max'   => 'Main products cannot exceed 500 characters',

        // Factory Size
        'factory_size_sqm.integer' => 'Factory size must be a valid number',
        'factory_size_sqm.min'     => 'Factory size must be greater than 0',

        // Production Capacity
        'production_capacity.max' => 'Production capacity cannot exceed 200 characters',

        // Export Markets
        'export_markets.regex' => 'Export markets should contain only letters and commas',
        'export_markets.max'   => 'Export markets cannot exceed 500 characters',

        // Certifications
        'certifications.max' => 'Certifications cannot exceed 500 characters',

        // Logo File
        'logo_file.mimes' => 'Logo must be a PNG, JPG, JPEG, or SVG file',
        'logo_file.max'   => 'Logo size must be less than 2MB',
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
            $ext      = $this->logo_file->getClientOriginalExtension();
            $filename = 'logo_' . time() . '.' . $ext;
            $destPath = 'seller-assets/' . $sellerId . '/' . $filename;

            // Use S3 on production, public disk locally
            $disk = config('filesystems.default', 'public') === 's3' ? 's3' : 'public';

            $storeOptions = $disk === 's3'
                ? ['disk' => 's3', 'visibility' => 'public']
                : $disk;
            $this->logo_file->storeAs(
                'seller-assets/' . $sellerId,
                $filename,
                $storeOptions
            );

            // Persist full public URL so admin app (different folder/domain)
            // can display the image directly from DB without needing asset()
            $fullLogoUrl       = $this->buildStorageUrl($destPath);
            $data['logo_url']  = $fullLogoUrl;
            $this->logo_url    = $fullLogoUrl;
            $this->reset('logo_file');
        }

        if ($this->video_file) {
            $videoPath     = 'seller-assets/' . $sellerId . '/video_' . time() . '.' .
                             $this->video_file->getClientOriginalExtension();
            $videoDisk = config('filesystems.default', 'public') === 's3'
                ? ['disk' => 's3', 'visibility' => 'public']
                : 'public';
            $this->video_file->storeAs(
                'seller-assets/' . $sellerId,
                basename($videoPath),
                $videoDisk
            );
            $fullVideoUrl      = $this->buildStorageUrl($videoPath);
            $data['video_url'] = $fullVideoUrl;
            $this->video_url   = $fullVideoUrl;
            $this->reset('video_file');
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
        $messages = [];
        foreach (['owner_id_passport','business_license','tax_id','selfie'] as $t) {
            if ($this->{'doc_'.$t}) $rules['doc_'.$t] = 'file|mimes:pdf,jpg,jpeg,png|max:5120';

            // Custom messages
            $messages['doc_'.$t.'.mimes'] = strtoupper(str_replace('_',' ', $t)) . ' must be PDF, JPG, JPEG or PNG';
            $messages['doc_'.$t.'.max']   = strtoupper(str_replace('_',' ', $t)) . ' size must be less than 5MB';
        }
        if (!empty($rules)) {
        $this->validate($rules, $messages);
        }

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

    // ── Step 5: Package Selection ──────────────────────────────
    public function saveStep5()
    {
        $this->errorMsg = '';

        $this->validate([
            'selected_package_id' => 'required|integer',
        ], [
            'selected_package_id.required' => 'Please select a package to continue.',
        ]);

        $sellerId = Session::get('seller_id');

        // Verify the selected package exists in tbl_package_membership
        $package = PackagesModel::find($this->selected_package_id);

        if (!$package) {
            $this->errorMsg = 'Selected package not found. Please choose again.';
            return;
        }

        // Save package_id to sellers table
        DB::table('sellers')
            ->where('id', $sellerId)
            ->update([
                'package_id' => $this->selected_package_id,
                'updated_at' => now(),
            ]);

        // Update seller status + kyc
        SellerDetail::updateOrCreate(['seller_id' => $sellerId], [
            'kyc_status'      => 'submitted',
            'submitted_at'    => now(),
            'onboarding_step' => 6,
        ]);

        DB::table('sellers')
            ->where('id', $sellerId)
            ->update(['status' => 'under_review']);

        // Update session with package info
        session([
            'seller_name'       => $this->legal_business_name,
            'seller_package_id' => $this->selected_package_id,
        ]);

        $this->successMsg = '✅ Package selected! Please complete KYC to enable escrow payments.';
        $this->activeStep = 6;
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
        $docDisk = config('filesystems.default', 'public') === 's3'
            ? ['disk' => 's3', 'visibility' => 'public']
            : 'public';
        $path = $file->storeAs('seller-docs/' . $sellerId, $fileName, $docDisk);

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
            // id is INT AUTO_INCREMENT — do NOT set it manually
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

    // ── Real-time doc file name preview / validation ─────────
    public function checkDocFile(string $type, string $fileName): void
    {
        if (empty($fileName)) {
            unset($this->docVerification[$type]);
            return;
        }
        $ext     = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
        if (!in_array($ext, $allowed)) {
            $this->docVerification[$type] = [
                'status'  => 'error',
                'message' => 'Only PDF, JPG, JPEG, or PNG files are allowed.',
            ];
        } else {
            $this->docVerification[$type] = [
                'status'  => 'ok',
                'message' => 'File looks good — click Save to upload.',
            ];
        }
    }

    public function goToStep(int $step): void
    {
        $this->activeStep  = $step;
        $this->successMsg  = '';
        $this->errorMsg    = '';
    }

    public function render()
    {
        $sellerId = \Illuminate\Support\Facades\Session::get('seller_id');
        $seller   = \App\Models\Seller::with('details', 'documents')
                        ->find($sellerId);

        $missingDetails = [];
        if (empty($this->phone))               $missingDetails[] = 'Phone number';
        if (empty($this->country_id))          $missingDetails[] = 'Country';
        if (empty($this->legal_business_name)) $missingDetails[] = 'Business name';
        if (empty($this->business_type))       $missingDetails[] = 'Business type';
        if (empty($this->business_address))    $missingDetails[] = 'Business address';
        if (empty($this->city))                $missingDetails[] = 'City';
        if (empty($this->num_employees))       $missingDetails[] = 'Number of employees';
        if (empty($this->company_description)) $missingDetails[] = 'Company description';
        if (empty($this->main_products))       $missingDetails[] = 'Main products';

        // Selected package object for sidebar display
        $selectedPackage = $this->selected_package_id
            ? collect($this->packages)->firstWhere('id', $this->selected_package_id)
            : null;

        // Always resolve to full public URLs so the blade works regardless of
        // whether it uses $logo_url, $logo_full_url, or $seller->details->logo_url
        $logoFullUrl  = $this->buildStorageUrl($this->logo_url);
        $videoFullUrl = $this->buildStorageUrl($this->video_url);

        // Sync resolved URLs back onto the loaded $seller object so that
        // $seller->details->logo_url in the blade also gives the correct URL
        // (header blade uses this path — profile blade should too)
        if ($seller?->details) {
            $seller->details->logo_url  = $logoFullUrl;
            $seller->details->video_url = $videoFullUrl;
        }

        return view('livewire.seller.profile', [
            'seller'            => $seller,
            'customer'          => $seller,
            'countries'         => collect($this->countries ?? []),
            'documents'         => $this->documents ?? collect(),
            'docVerification'   => $this->docVerification ?? [],
            'completion'        => $this->completion,
            'profilePercentage' => $this->completion,
            'stepScore'         => $this->stepScore,
            'missingDetails'    => $missingDetails,
            'packages'          => $this->packages,
            'selectedPackage'   => $selectedPackage,
            'currentPlan'       => $selectedPackage,
            'logo_url'          => $logoFullUrl,
            'video_url'         => $videoFullUrl,
            'logo_full_url'     => $logoFullUrl,
            'video_full_url'    => $videoFullUrl,
            'successMsg'        => $this->successMsg ?? '',
            'errorMsg'          => $this->errorMsg ?? '',
            // KYC
            'kycTabScores'      => $this->kycTabScores,
            'kycOverallScore'   => $this->kycOverallScore,
            'kycStatus'         => $this->kycStatus,
            'kycIsLocked'       => $this->kycIsLocked,
        ]);
    }

    // Build correct public URL for a stored file path
    private function buildStorageUrl(?string $path): string
    {
        if (!$path) return '';
        // Already a full URL (e.g. S3 https://)
        if (str_starts_with($path, 'http')) return $path;
        // S3 production: use AWS public URL from config
        $awsBase = config('app.pub_aws_url', '');
        if ($awsBase) {
            return rtrim($awsBase, '/') . '/' . ltrim($path, '/');
        }
        // Local: symlinked storage
        return asset('storage/' . $path);
    }
    private function cleanInput($value)
{
    return trim(strip_tags($value));
}
}

?>