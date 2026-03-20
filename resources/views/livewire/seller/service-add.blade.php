{{-- FILE: resources/views/livewire/seller/service-add.blade.php
     IndiaMART-style: 2-tab layout, radio specs, live product score --}}
<div>
<livewire:seller.layout.header />

<style>
/* ── Page header ── */
.sa-page-header{background:#fff;border-bottom:1px solid #e5e9f2;padding:12px 20px;
  display:flex;align-items:center;gap:12px;}
.sa-back-btn{color:#1a56db;font-size:.84rem;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:4px;}
.sa-back-btn:hover{color:#1e40af;}
.sa-page-title{font-size:1rem;font-weight:800;color:#0f172a;}

/* ── 2-tab bar — IndiaMART style ── */
.sa-tabs{display:flex;background:#f1f5f9;border-radius:0;}
.sa-tab{flex:1;padding:14px 20px;text-align:center;font-size:.88rem;font-weight:700;cursor:pointer;
  border:none;background:transparent;color:#64748b;border-bottom:3px solid transparent;transition:all .2s;}
.sa-tab.active{background:#1e3a8a;color:#fff;border-bottom-color:#1e3a8a;}
.sa-tab.done{background:#f0fdf4;color:#059669;border-bottom-color:#10b981;}
.sa-tab:disabled{cursor:not-allowed;opacity:.5;}

/* ── Main layout ── */
.sa-main{display:grid;grid-template-columns:1fr 280px;gap:20px;padding:20px;}
@media(max-width:992px){.sa-main{grid-template-columns:1fr;}}

/* ── Form card ── */
.sa-form-card{background:#fff;border:1px solid #e5e9f2;border-radius:12px;overflow:hidden;}
.sa-form-head{background:#1e3a8a;color:#fff;padding:14px 20px;font-size:.9rem;font-weight:800;}
.sa-form-body{padding:20px;}

/* ── Fields ── */
.sa-label{font-size:.8rem;font-weight:700;color:#374151;margin-bottom:6px;display:block;}
.sa-input,.sa-select,.sa-textarea{border:1.5px solid #d1d5db;border-radius:8px;padding:.5rem .85rem;
  font-size:.88rem;width:100%;outline:none;transition:border .2s;background:#fff;}
.sa-input:focus,.sa-select:focus,.sa-textarea:focus{border-color:#1e3a8a;box-shadow:0 0 0 3px rgba(30,58,138,.08);}
.sa-textarea{resize:vertical;min-height:180px;}
.sa-hint{font-size:.72rem;color:#94a3b8;margin-top:3px;}
.sa-err{font-size:.75rem;color:#dc2626;margin-top:3px;font-weight:600;}

/* ── Price row ── */
.price-row{display:flex;align-items:center;gap:8px;}
.price-symbol{background:#f8fafc;border:1.5px solid #d1d5db;border-radius:8px 0 0 8px;
  padding:.5rem 12px;font-size:.88rem;font-weight:700;color:#374151;border-right:none;}
.price-input{border:1.5px solid #d1d5db;border-radius:0;padding:.5rem .85rem;font-size:.88rem;
  width:160px;outline:none;transition:border .2s;background:#fff;}
.price-input:focus{border-color:#1e3a8a;}
.price-per{font-size:.84rem;color:#64748b;font-weight:600;padding:0 8px;}
.price-unit-select{border:1.5px solid #d1d5db;border-radius:0 8px 8px 0;padding:.5rem .85rem;
  font-size:.84rem;outline:none;background:#fff;cursor:pointer;flex:1;max-width:220px;}
.price-unit-select:focus{border-color:#1e3a8a;}

/* ── Photo upload area ── */
.photo-grid{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:10px;}
.photo-slot{width:80px;height:80px;border:1.5px dashed #d1d5db;border-radius:10px;
  display:flex;align-items:center;justify-content:center;flex-direction:column;
  cursor:pointer;background:#f8fafc;transition:all .15s;position:relative;}
.photo-slot:hover{border-color:#1e3a8a;background:#eff6ff;}
.photo-slot img{width:100%;height:100%;object-fit:cover;border-radius:9px;}
.photo-slot-main{width:120px;height:120px;font-size:2rem;}
.media-btn{border:1.5px solid #d1d5db;border-radius:8px;padding:8px 14px;background:#f8fafc;
  font-size:.8rem;font-weight:700;color:#374151;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all .15s;}
.media-btn:hover{border-color:#1e3a8a;color:#1e3a8a;background:#eff6ff;}
.media-btn.active{border-color:#059669;color:#059669;background:#f0fdf4;}

/* ── Spec radio/checkbox ── */
.spec-section{margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #f1f5f9;}
.spec-section:last-child{border-bottom:none;}
.spec-title{font-size:.84rem;font-weight:800;color:#1e3a8a;margin-bottom:12px;display:flex;align-items:center;gap:6px;}
.spec-badge{font-size:.6rem;background:#fef3c7;color:#92400e;padding:1px 6px;border-radius:20px;font-weight:700;}
.spec-options{display:flex;flex-wrap:wrap;gap:8px;}
.spec-radio-label,.spec-check-label{display:flex;align-items:center;gap:6px;padding:7px 14px;
  border:1.5px solid #e2e8f0;border-radius:20px;cursor:pointer;font-size:.8rem;font-weight:600;
  color:#374151;background:#fff;transition:all .15s;user-select:none;}
.spec-radio-label:hover,.spec-check-label:hover{border-color:#1e3a8a;color:#1e3a8a;background:#eff6ff;}
.spec-radio-label input,.spec-check-label input{accent-color:#1e3a8a;width:14px;height:14px;}
.spec-radio-label.selected,.spec-check-label.selected{border-color:#1e3a8a;background:#eff6ff;color:#1e3a8a;}

/* ── Product score (IndiaMART right panel) ── */
.score-card{background:#fff;border:1px solid #e5e9f2;border-radius:12px;padding:18px;position:sticky;top:70px;}
.score-title{font-size:.84rem;font-weight:800;color:#0f172a;margin-bottom:12px;}
.score-circle{width:52px;height:52px;border-radius:50%;border:3px solid #e2e8f0;
  display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:900;
  margin-bottom:8px;}
.score-bar-wrap{background:#e5e9f2;border-radius:20px;height:8px;margin-bottom:4px;overflow:hidden;}
.score-bar{height:100%;border-radius:20px;transition:width .4s,background .4s;}
.score-0-100{display:flex;justify-content:space-between;font-size:.68rem;color:#94a3b8;margin-bottom:16px;}
.score-item{display:flex;justify-content:space-between;align-items:center;font-size:.78rem;
  padding:6px 0;border-bottom:1px solid #f1f5f9;}
.score-item:last-child{border-bottom:none;}
.score-item-label{color:#374151;font-weight:600;}
.score-item-pts{font-weight:800;}
.score-item-pts.earned{color:#059669;}
.score-item-pts.missing{color:#94a3b8;}

/* ── Buttons ── */
.btn-save-continue{background:#0d9488;color:#fff;border:none;border-radius:8px;
  padding:.65rem 2rem;font-size:.9rem;font-weight:800;cursor:pointer;
  box-shadow:0 4px 14px rgba(13,148,136,.3);transition:all .2s;display:flex;align-items:center;gap:.5rem;}
.btn-save-continue:hover{background:#0f766e;transform:translateY(-1px);}
.btn-finish{background:#1e3a8a;color:#fff;border:none;border-radius:8px;
  padding:.65rem 2rem;font-size:.9rem;font-weight:800;cursor:pointer;
  box-shadow:0 4px 14px rgba(30,58,138,.3);transition:all .2s;}
.btn-finish:hover{background:#1e40af;transform:translateY(-1px);}
.btn-back-tab{background:#f1f5f9;color:#374151;border:1px solid #e2e8f0;border-radius:8px;
  padding:.6rem 1.4rem;font-size:.86rem;font-weight:700;cursor:pointer;transition:all .15s;}

/* ── Alerts ── */
.sa-alert{border-radius:10px;padding:12px 16px;margin-bottom:1rem;font-size:.84rem;
  font-weight:600;display:flex;align-items:center;gap:8px;}
.sa-alert.success{background:#d1fae5;border:1.5px solid #6ee7b7;color:#065f46;}
.sa-alert.error{background:#fee2e2;border:1.5px solid #fca5a5;color:#991b1b;}
</style>

{{-- Page header --}}
<div class="sa-page-header">
  <a href="{{ route('my-listings') }}" class="sa-back-btn">
    <i class="bi bi-arrow-left"></i> Back
  </a>
  <span style="color:#d1d5db;">|</span>
  <span class="sa-page-title">Add Product / Service</span>
</div>

{{-- 2 tabs --}}
<div class="sa-tabs">
  <button class="sa-tab {{ $activeTab == 1 ? 'active' : ($activeTab > 1 ? 'done' : '') }}"
          wire:click="$set('activeTab', 1)" type="button">
    @if($activeTab > 1)<i class="bi bi-check-circle me-1"></i>@endif
    Basic Details
  </button>
  <button class="sa-tab {{ $activeTab == 2 ? 'active' : '' }}"
          wire:click="$set('activeTab', 2)" type="button"
          {{ $activeTab < 2 ? 'disabled' : '' }}>
    Specification / Additional Details
  </button>
</div>

<div class="container-fluid px-3 py-0">

  @if(session('message'))
  <div class="sa-alert success mt-3"><i class="bi bi-check-circle-fill"></i> {{ session('message') }}</div>
  @endif
  @if(session('error'))
  <div class="sa-alert error mt-3"><i class="bi bi-x-circle-fill"></i> {{ session('error') }}</div>
  @endif

  <div class="sa-main">

    {{-- ══ LEFT: Form ══ --}}
    <div>

      {{-- ─────────── TAB 1: Basic Details ─────────── --}}
      @if($activeTab == 1)
      <form wire:submit.prevent="saveAndContinue">

        <div class="sa-form-card mb-3">
          <div class="sa-form-body">

            {{-- Photos on left, fields on right — IndiaMART layout --}}
            <div class="row g-4">

              {{-- LEFT: Photo upload --}}
              <div class="col-md-4">
                <label class="sa-label">Photos</label>
                <div style="margin-bottom:10px;">
                  @if($cover_image)
                    <div class="photo-slot photo-slot-main" style="width:120px;height:120px;border:none;">
                      <img src="{{ $cover_image->temporaryUrl() }}" style="border-radius:10px;">
                    </div>
                  @else
                    <label for="mainImg" class="photo-slot photo-slot-main" style="width:120px;height:120px;border-style:dashed;">
                      <i class="bi bi-camera" style="font-size:1.6rem;color:#94a3b8;"></i>
                      <div style="font-size:.68rem;color:#94a3b8;margin-top:4px;font-weight:700;">Add Photo</div>
                    </label>
                  @endif
                  <input type="file" id="mainImg" class="d-none" wire:model="cover_image" accept="image/*">
                </div>

                {{-- Gallery thumbs --}}
                <div class="photo-grid">
                  @foreach($gallery_images as $gi)
                  <div class="photo-slot" style="width:72px;height:72px;">
                    <img src="{{ $gi->temporaryUrl() }}">
                  </div>
                  @endforeach
                  @if(count($gallery_images) < 9)
                  <label for="galleryImgs" class="photo-slot" style="width:72px;height:72px;">
                    <i class="bi bi-plus-lg" style="color:#94a3b8;font-size:1.2rem;"></i>
                  </label>
                  @endif
                  <input type="file" id="galleryImgs" class="d-none" wire:model="new_gallery_images" multiple accept="image/*">
                </div>

                {{-- Video + PDF buttons --}}
                <div style="display:flex;flex-direction:column;gap:6px;margin-top:10px;">
                  <label for="videoUrl" class="media-btn {{ $video_url ? 'active' : '' }}" style="cursor:default;">
                    <i class="bi bi-play-circle"></i> Add Video
                  </label>
                  <div style="display:none;"><input type="url" id="videoUrl" wire:model.lazy="video_url"></div>
                  @if(!$video_url)
                  <input class="sa-input" wire:model.lazy="video_url" placeholder="YouTube / Vimeo URL" style="font-size:.78rem;padding:.4rem .7rem;">
                  @else
                  <div style="font-size:.72rem;color:#059669;font-weight:700;">✅ Video added</div>
                  @endif

                  <label for="pdfUpload" class="media-btn {{ $brochure_pdf ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-pdf"></i>
                    {{ $brochure_pdf ? '✅ PDF added' : 'Add PDF' }}
                  </label>
                  <input type="file" id="pdfUpload" class="d-none" wire:model="brochure_pdf" accept=".pdf">
                </div>

                <div wire:loading wire:target="cover_image,new_gallery_images,brochure_pdf"
                  style="font-size:.75rem;color:#1e3a8a;font-weight:700;margin-top:6px;">
                  <i class="bi bi-arrow-repeat me-1"></i> Uploading...
                </div>
              </div>

              {{-- RIGHT: Fields --}}
              <div class="col-md-8">
                {{-- Name --}}
                <div class="mb-3">
                  <label class="sa-label">Product / Service Name *</label>
                  <input class="sa-input" wire:model.lazy="title"
                    placeholder="Enter product or service name (use at least 3 words)">
                  @error('title')<div class="sa-err">{{ $message }}</div>@enderror
                </div>

                {{-- Price + Unit — IndiaMART style --}}
                <div class="mb-3">
                  <label class="sa-label">Price</label>
                  <div class="price-row">
                    <span class="price-symbol">₹</span>
                    <input type="number" class="price-input" wire:model.lazy="price"
                      placeholder="Enter price" min="0">
                    <span class="price-per">- per -</span>
                    <select class="price-unit-select" wire:model.lazy="price_unit">
                      <option value="">Enter Unit</option>
                      <option value="Hour">Hour</option>
                      <option value="Day">Day</option>
                      <option value="Week">Week</option>
                      <option value="Month">Month</option>
                      <option value="Year">Year</option>
                      <option value="Project">Project</option>
                      <option value="Piece">Piece</option>
                      <option value="Unit">Unit</option>
                      <option value="Kg">Kg</option>
                      <option value="Meter">Meter</option>
                      <option value="Square Feet">Square Feet</option>
                    </select>
                  </div>
                  <div class="sa-hint">Leave blank if price varies — buyers can send enquiry</div>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                    <label class="sa-label" style="margin:0;">Product / Service Description</label>
                    <span style="font-size:.7rem;color:#94a3b8;">Uses, Details, Benefits, etc.</span>
                  </div>

                  {{-- Toolbar --}}
                  <div style="border:1.5px solid #d1d5db;border-radius:8px 8px 0 0;border-bottom:none;
                    padding:6px 10px;background:#f8fafc;display:flex;gap:4px;flex-wrap:wrap;" wire:ignore>
                    @foreach([
                      ['bold','bi-type-bold','B'],
                      ['italic','bi-type-italic','I'],
                      ['insertUnorderedList','bi-list-ul','☰'],
                      ['insertOrderedList','bi-list-ol','1.'],
                    ] as [$cmd,$icon,$label])
                    <button type="button" onclick="document.execCommand('{{ $cmd }}');saSync()"
                      style="border:1px solid #e2e8f0;background:#fff;border-radius:4px;padding:3px 8px;
                        font-size:.78rem;cursor:pointer;font-weight:700;color:#374151;">
                      {{ $label }}
                    </button>
                    @endforeach
                  </div>

                  <div wire:ignore>
                    <div id="sa-editor" contenteditable="true"
                      style="border:1.5px solid #d1d5db;border-radius:0 0 8px 8px;min-height:180px;
                        padding:10px 12px;font-size:.88rem;background:#fff;outline:none;line-height:1.7;"
                      placeholder="Describe your service..."></div>
                  </div>
                  <input type="hidden" wire:model="description" id="sa-desc-hidden">
                  <div style="text-align:right;font-size:.7rem;color:#94a3b8;margin-top:4px;">
                    {{ strlen(strip_tags($description)) }} characters (maximum 4000)
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        {{-- Tips --}}
        <div style="margin-bottom:16px;">
          <button type="button" style="background:none;border:none;color:#1e3a8a;font-size:.82rem;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:4px;">
            <i class="bi bi-lightbulb"></i> Tips
          </button>
        </div>

        {{-- Save and Continue button --}}
        <div style="display:flex;justify-content:flex-end;">
          <button type="submit" class="btn-save-continue" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="saveAndContinue">Save and Continue →</span>
            <span wire:loading wire:target="saveAndContinue"><i class="bi bi-arrow-repeat me-1"></i> Saving...</span>
          </button>
        </div>

      </form>
      @endif {{-- end tab 1 --}}


      {{-- ─────────── TAB 2: Specifications ─────────── --}}
      @if($activeTab == 2)
      <form wire:submit.prevent="submit">

        {{-- Category breadcrumb like IndiaMART --}}
        <div style="background:#fff;border:1px solid #e5e9f2;border-radius:12px;padding:14px 20px;margin-bottom:16px;
          display:flex;align-items:center;gap:10px;">
          <label class="sa-label" style="margin:0;white-space:nowrap;">Category</label>
          <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
            <select class="sa-select" wire:model.live="category_id" style="max-width:200px;">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
              @endforeach
            </select>
            @if($category_id)
            <select class="sa-select" wire:model.live="subcategory_id" style="max-width:200px;">
              <option value="">Sub Category</option>
              @foreach($subcategories as $sub)
                <option value="{{ $sub->id }}">{{ $sub->sub_cat_name }}</option>
              @endforeach
            </select>
            @endif
          </div>
        </div>

        <div class="sa-form-card mb-3">
          <div class="sa-form-body">

            {{-- ── Service Type ── --}}
            <div class="spec-section">
              <div class="spec-title">
                Service Type <span class="spec-badge">Important</span>
              </div>
              <div class="spec-options">
                @foreach([
                  'Full Service','Consulting Only','Implementation','Managed Service',
                  'On-Demand','Subscription','One-Time Project','Retainer','Other'
                ] as $opt)
                <div class="spec-radio-label {{ $service_type === $opt ? 'selected' : '' }}"
                     wire:click="$set('service_type', '{{ $opt }}')">
                  {{ $opt }}
                </div>
                @endforeach
              </div>
            </div>

            {{-- ── Pricing Model ── --}}
            <div class="spec-section">
              <div class="spec-title">
                Pricing Model <span class="spec-badge">Important</span>
              </div>
              <div class="spec-options">
                @foreach([
                  'Monthly Retainer','Project Based','Hourly',
                  'Performance Based','Daily Rate','Annual Contract','Other'
                ] as $opt)
                <div class="spec-radio-label {{ $pricing_model === $opt ? 'selected' : '' }}"
                     wire:click="$set('pricing_model', '{{ $opt }}')">
                  {{ $opt }}
                </div>
                @endforeach
              </div>
            </div>

            {{-- ── Contract Duration ── --}}
            <div class="spec-section">
              <div class="spec-title">
                Contract Duration <span class="spec-badge">Important</span>
              </div>
              <div class="spec-options">
                @foreach(['1 Month','3 Months','6 Months','12 Months','Above 12 Months','One-Time','Ongoing','Other'] as $opt)
                <div class="spec-radio-label {{ $contract_duration === $opt ? 'selected' : '' }}"
                     wire:click="$set('contract_duration', '{{ $opt }}')">
                  {{ $opt }}
                </div>
                @endforeach
              </div>
            </div>

            {{-- ── Delivery Mode ── --}}
            <div class="spec-section">
              <div class="spec-title">Delivery Mode</div>
              <div class="spec-options">
                @foreach(['Onsite','Remote / Online','Both Onsite & Remote','Pan India','International'] as $opt)
                <div class="spec-radio-label {{ $delivery_mode === $opt ? 'selected' : '' }}"
                     wire:click="$set('delivery_mode', '{{ $opt }}')">
                  {{ $opt }}
                </div>
                @endforeach
              </div>
            </div>

            {{-- ── Business Type (who is your target client) ── --}}
            <div class="spec-section">
              <div class="spec-title">Business Type <span style="font-size:.7rem;color:#94a3b8;">(Target Client)</span></div>
              <div class="spec-options">
                @foreach(['Startup','SME','Large Enterprise','Agency','D2C Brand','Manufacturer','Exporter','Other'] as $opt)
                <div class="spec-radio-label {{ $business_type_target === $opt ? 'selected' : '' }}"
                     wire:click="$set('business_type_target', '{{ $opt }}')">
                  {{ $opt }}
                </div>
                @endforeach
              </div>
            </div>

            {{-- ── Industries Served (checkbox — multiple) ── --}}
            <div class="spec-section">
              <div class="spec-title">Industries Served</div>
              <div class="spec-options">
                @foreach([
                  'Ecommerce','Education','Healthcare','Real Estate','Travel','Manufacturing',
                  'Retail','Food & Beverage','Textile','Chemicals','Automobile','IT & Software',
                  'Finance','Logistics','Agriculture','Other'
                ] as $industry)
                <div class="spec-check-label {{ in_array($industry, $industries_served) ? 'selected' : '' }}"
                     wire:click="toggleIndustry('{{ $industry }}')">
                  @if(in_array($industry, $industries_served))
                  <i class="bi bi-check-square-fill" style="color:#1e3a8a;font-size:.8rem;"></i>
                  @else
                  <i class="bi bi-square" style="color:#94a3b8;font-size:.8rem;"></i>
                  @endif
                  {{ $industry }}
                </div>
                @endforeach
              </div>
            </div>

            {{-- ── Additional fields ── --}}
            <div class="spec-section">
              <div class="spec-title">Provider Details</div>
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="sa-label">Years of Experience</label>
                  <input class="sa-input" wire:model.lazy="experience_years" placeholder="e.g. 10 Years">
                </div>
                <div class="col-md-8">
                  <label class="sa-label">Certifications / Accreditations</label>
                  <input class="sa-input" wire:model.lazy="certifications"
                    placeholder="e.g. ISO 9001, MSME, Export House, Google Partner">
                </div>
                <div class="col-12">
                  <label class="sa-label">Keywords (for search)</label>
                  <input class="sa-input" wire:model.lazy="keywords"
                    placeholder="e.g. digital marketing, SEO, social media, PPC">
                </div>
              </div>
            </div>

          </div>
        </div>

        {{-- Finish button --}}
        <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:2rem;">
          <button type="button" class="btn-back-tab" wire:click="$set('activeTab', 1)">
            ← Back
          </button>
          <button type="submit" class="btn-finish" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submit">Finish</span>
            <span wire:loading wire:target="submit"><i class="bi bi-arrow-repeat me-1"></i> Submitting...</span>
          </button>
        </div>

      </form>
      @endif {{-- end tab 2 --}}

    </div> {{-- end left --}}


    {{-- ══ RIGHT: Product Score — IndiaMART style ══ --}}
    <div>
      <div class="score-card">
        <div class="score-title">Product Score:</div>

        {{-- Score circle + bar --}}
        @php
          $score = $this->productScore;
          $color = $this->scoreColor;
          $label = $this->scoreLabel;
        @endphp
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
          <div class="score-circle" style="border-color:{{ $color }};color:{{ $color }};">
            {{ $score }}
          </div>
          <div>
            <div style="font-size:.84rem;font-weight:700;color:{{ $color }};">{{ $label }}</div>
          </div>
        </div>
        <div class="score-bar-wrap">
          <div class="score-bar" style="width:{{ $score }}%;background:{{ $color }};"></div>
        </div>
        <div class="score-0-100"><span>0</span><span>100</span></div>

        {{-- Score breakdown like IndiaMART --}}
        <div style="border-top:1px solid #f1f5f9;padding-top:12px;">
          <div style="font-size:.78rem;font-weight:800;color:#374151;margin-bottom:8px;">Basic details</div>

          @foreach([
            ['Name (>=3 Words)',   strlen($title) >= 3,                      10],
            ['Price (with Unit)',  $price && $price_unit,                    15],
            ['Description (>100)',strlen(strip_tags($description ?? ''))>100, 20],
            ['Video',             !empty($video_url),                        10],
            ['Product PDF',       !empty($brochure_pdf),                      5],
          ] as [$lbl, $earned, $pts])
          <div class="score-item">
            <span class="score-item-label">{{ $lbl }}</span>
            <span class="score-item-pts {{ $earned ? 'earned' : 'missing' }}">
              {{ $earned ? $pts : '0' }}/{{ $pts }}
            </span>
          </div>
          @endforeach

          <div style="font-size:.78rem;font-weight:800;color:#374151;margin:10px 0 8px;">Specifications</div>

          @foreach([
            ['Photos',           !empty($cover_image), 15],
            ['Gallery Images',   count($gallery_images) > 0, 10],
            ['Service Type',     !empty($service_type), 5],
            ['Pricing Model',    !empty($pricing_model), 5],
            ['Certifications',   !empty($certifications), 5],
          ] as [$lbl, $earned, $pts])
          <div class="score-item">
            <span class="score-item-label">{{ $lbl }}</span>
            <span class="score-item-pts {{ $earned ? 'earned' : 'missing' }}">
              {{ $earned ? $pts : '0' }}/{{ $pts }}
            </span>
          </div>
          @endforeach

        </div>
      </div>
    </div>

  </div>
</div>

<livewire:seller.layout.footer />

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editor = document.getElementById('sa-editor');
    const hidden = document.getElementById('sa-desc-hidden');
    if (!editor) return;

    editor.innerHTML = @json($description ?? '');

    window.saSync = function() {
        if (hidden) {
            hidden.value = editor.innerHTML;
            @this.set('description', editor.innerHTML);
        }
    };
    editor.addEventListener('input', saSync);
});
</script>
</div>