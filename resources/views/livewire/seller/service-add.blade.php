{{-- FILE: resources/views/livewire/seller/service-add.blade.php --}}
<div>
<livewire:seller.layout.header />

<style>
/* ── Wizard ── */
.sw-bar{background:#fff;border-bottom:1px solid #e5e9f2;position:sticky;top:0;z-index:100;}
.sw-steps{display:flex;overflow-x:auto;}
.sw-step{flex:1;min-width:130px;display:flex;flex-direction:column;align-items:center;justify-content:center;
  padding:14px 10px;cursor:pointer;border-bottom:3px solid transparent;transition:all .2s;gap:4px;}
.sw-step.active{border-bottom-color:#7c3aed;color:#7c3aed;background:#faf5ff;}
.sw-step.done{border-bottom-color:#10b981;color:#059669;}
.sw-step.pending{color:#94a3b8;}
.sw-num{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:800;}
.sw-step.active .sw-num{background:#7c3aed;color:#fff;}
.sw-step.done .sw-num{background:#d1fae5;color:#059669;}
.sw-step.pending .sw-num{background:#f1f5f9;color:#94a3b8;}
.sw-label{font-size:.72rem;font-weight:700;}

/* ── Cards ── */
.sa-card{background:#fff;border-radius:14px;border:1px solid #e8ecf4;box-shadow:0 2px 12px rgba(0,0,0,.04);margin-bottom:1.25rem;overflow:hidden;}
.sa-head{padding:14px 20px;font-size:.85rem;font-weight:800;display:flex;align-items:center;gap:.5rem;color:#fff;}
.sa-body{padding:20px;}

/* ── Fields ── */
.sa-label{font-size:.78rem;font-weight:700;color:#374151;margin-bottom:5px;display:block;}
.sa-input{border:1.5px solid #e2e8f0;border-radius:10px;padding:.5rem .85rem;font-size:.85rem;width:100%;outline:none;transition:border .2s;background:#fafafa;}
.sa-input:focus{border-color:#7c3aed;background:#fff;box-shadow:0 0 0 3px rgba(124,58,237,.08);}
.sa-select{border:1.5px solid #e2e8f0;border-radius:10px;padding:.5rem .85rem;font-size:.85rem;width:100%;outline:none;background:#fafafa;cursor:pointer;transition:border .2s;}
.sa-select:focus{border-color:#7c3aed;background:#fff;box-shadow:0 0 0 3px rgba(124,58,237,.08);}
.sa-textarea{border:1.5px solid #e2e8f0;border-radius:10px;padding:.6rem .85rem;font-size:.85rem;width:100%;outline:none;transition:border .2s;background:#fafafa;resize:vertical;}
.sa-textarea:focus{border-color:#7c3aed;background:#fff;box-shadow:0 0 0 3px rgba(124,58,237,.08);}
.sa-hint{font-size:.71rem;color:#94a3b8;margin-top:3px;}
.sa-err{font-size:.75rem;color:#dc2626;margin-top:3px;font-weight:600;}
.sa-tip{background:#faf5ff;border-left:3px solid #7c3aed;border-radius:0 10px 10px 0;padding:10px 14px;font-size:.78rem;color:#6d28d9;margin-bottom:16px;line-height:1.6;}

/* ── Pricing toggle ── */
.price-type-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
.pt-pill{padding:8px 18px;border-radius:20px;border:1.5px solid #e2e8f0;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .15s;background:#f8fafc;color:#374151;}
.pt-pill:hover{border-color:#7c3aed;color:#7c3aed;}
.pt-pill.active{background:#7c3aed;color:#fff;border-color:#7c3aed;box-shadow:0 4px 12px rgba(124,58,237,.25);}

/* ── Delivery mode ── */
.dm-pills{display:flex;gap:8px;flex-wrap:wrap;}
.dm-pill{padding:7px 16px;border-radius:20px;border:1.5px solid #e2e8f0;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .15s;background:#f8fafc;}
.dm-pill.active{background:#0891b2;color:#fff;border-color:#0891b2;}

/* ── Image drop ── */
.img-drop{border:2px dashed #d1d5db;border-radius:14px;padding:24px 20px;text-align:center;cursor:pointer;transition:all .2s;background:#f9fafb;}
.img-drop:hover{border-color:#7c3aed;background:#faf5ff;}
.portfolio-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(84px,1fr));gap:10px;margin-top:12px;}
.portfolio-thumb{aspect-ratio:1;border-radius:10px;overflow:hidden;border:1.5px solid #e5e9f2;}
.portfolio-thumb img{width:100%;height:100%;object-fit:cover;}

/* ── Nav buttons ── */
.btn-prev{background:#f1f5f9;color:#374151;border:none;border-radius:10px;padding:.55rem 1.4rem;font-size:.85rem;font-weight:700;cursor:pointer;transition:all .15s;}
.btn-next{background:#7c3aed;color:#fff;border:none;border-radius:10px;padding:.55rem 1.4rem;font-size:.85rem;font-weight:700;cursor:pointer;box-shadow:0 4px 14px rgba(124,58,237,.3);transition:all .15s;}
.btn-submit{background:linear-gradient(135deg,#7c3aed,#0891b2);color:#fff;border:none;border-radius:10px;padding:.6rem 2rem;font-size:.9rem;font-weight:800;cursor:pointer;box-shadow:0 4px 18px rgba(124,58,237,.3);transition:all .2s;}
.btn-submit:hover{transform:translateY(-1px);}

/* ── Preview card ── */
.preview-card{background:#fff;border-radius:14px;border:1px solid #e8ecf4;box-shadow:0 2px 12px rgba(0,0,0,.05);position:sticky;top:70px;overflow:hidden;}

/* ── Alert ── */
.sa-alert{border-radius:12px;padding:14px 18px;margin-bottom:1rem;font-size:.84rem;font-weight:600;display:flex;align-items:center;gap:10px;}
.sa-alert.success{background:#d1fae5;border:1.5px solid #6ee7b7;color:#065f46;}
.sa-alert.error{background:#fee2e2;border:1.5px solid #fca5a5;color:#991b1b;}

/* ── Service type grid ── */
.stype-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:8px;}
.stype-card{border:1.5px solid #e2e8f0;border-radius:12px;padding:12px 10px;text-align:center;cursor:pointer;transition:all .15s;background:#f8fafc;}
.stype-card:hover{border-color:#7c3aed;background:#faf5ff;}
.stype-card.selected{border-color:#7c3aed;background:#faf5ff;box-shadow:0 0 0 3px rgba(124,58,237,.12);}
.stype-icon{font-size:1.4rem;margin-bottom:4px;}
.stype-name{font-size:.72rem;font-weight:700;color:#374151;}
</style>

<div class="container-fluid px-3 py-0">

  {{-- Wizard bar --}}
  <div class="sw-bar">
    <div class="sw-steps">
      @foreach([
        1 => ['bi-briefcase-fill','Basic Info'],
        2 => ['bi-currency-exchange','Pricing & Delivery'],
        3 => ['bi-patch-check-fill','Credentials & Media'],
      ] as $n => [$icon, $label])
      <div class="sw-step {{ $activeStep == $n ? 'active' : ($activeStep > $n ? 'done' : 'pending') }}"
           wire:click="goToStep({{ $n }})">
        <div class="sw-num">
          @if($activeStep > $n)<i class="bi bi-check-lg" style="font-size:.8rem;"></i>@else{{ $n }}@endif
        </div>
        <div class="sw-label"><i class="bi {{ $icon }} me-1"></i>{{ $label }}</div>
      </div>
      @endforeach
    </div>
  </div>

  @if(session('message'))
  <div class="sa-alert success mt-3"><i class="bi bi-check-circle-fill"></i> {{ session('message') }}</div>
  @endif
  @if(session('error'))
  <div class="sa-alert error mt-3"><i class="bi bi-x-circle-fill"></i> {{ session('error') }}</div>
  @endif

  <form wire:submit.prevent="submit">
  <div class="row g-3 mt-1">

    {{-- ══ LEFT ══ --}}
    <div class="col-lg-8">

      {{-- ── STEP 1 ── --}}
      @if($activeStep == 1)

      {{-- Service type picker --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <i class="bi bi-grid-3x3-gap-fill"></i> Service Type *
        </div>
        <div class="sa-body">
          <div class="sa-tip">💡 Select the type that best describes your service. This helps buyers find you faster.</div>
          <div class="stype-grid">
            @foreach([
              ['Manufacturing','bi-gear-wide-connected'],
              ['IT & Software','bi-laptop'],
              ['Consulting','bi-person-check'],
              ['Logistics & Shipping','bi-truck'],
              ['Quality Testing','bi-shield-check'],
              ['Design & Packaging','bi-palette'],
              ['Sourcing & Procurement','bi-search'],
              ['Marketing & SEO','bi-megaphone'],
              ['Legal & Compliance','bi-journal-text'],
              ['Finance & Accounting','bi-calculator'],
              ['Translation','bi-translate'],
              ['Training & Education','bi-mortarboard'],
              ['Photography','bi-camera'],
              ['Event Management','bi-calendar-event'],
              ['Other','bi-three-dots'],
            ] as [$type, $icon])
            <div class="stype-card {{ $service_type === $type ? 'selected' : '' }}"
                 wire:click="$set('service_type', '{{ $type }}')">
              <div class="stype-icon"><i class="bi {{ $icon }}"></i></div>
              <div class="stype-name">{{ $type }}</div>
            </div>
            @endforeach
          </div>
          @error('service_type')<div class="sa-err mt-2">{{ $message }}</div>@enderror
        </div>
      </div>

      {{-- Title & Description --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <i class="bi bi-file-text"></i> Service Details
        </div>
        <div class="sa-body">
          <div class="mb-3">
            <label class="sa-label">Service Title * <span class="sa-hint">(min 10 characters)</span></label>
            <input class="sa-input" wire:model.defer="title"
              placeholder="e.g. Custom PCB Manufacturing for IoT Devices with ISO Certification">
            <div class="sa-hint">Be specific. "PCB Manufacturing for IoT" gets more enquiries than just "PCB Manufacturing".</div>
            @error('title')<div class="sa-err">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="sa-label">Service Description * <span class="sa-hint">(min 30 characters)</span></label>
            <textarea class="sa-textarea" wire:model.defer="description" rows="7"
              placeholder="Describe what you do, your process, what makes you different, who your ideal clients are, what results clients can expect..."></textarea>
            @error('description')<div class="sa-err">{{ $message }}</div>@enderror
          </div>
          <div>
            <label class="sa-label">Search Keywords</label>
            <input class="sa-input" wire:model.defer="keywords"
              placeholder="e.g. PCB manufacturing, printed circuit board, IoT, prototype">
            <div class="sa-hint">Helps buyers find your service through search.</div>
          </div>
        </div>
      </div>

      {{-- Category --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#0891b2,#0e7490);">
          <i class="bi bi-diagram-3-fill"></i> Category
        </div>
        <div class="sa-body">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="sa-label">Main Category *</label>
              <select class="sa-select" wire:model.live="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                @endforeach
              </select>
              @error('category_id')<div class="sa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="sa-label">Sub Category</label>
              <select class="sa-select" wire:model.live="subcategory_id" {{ !$category_id ? 'disabled' : '' }}>
                <option value="">Select Sub Category</option>
                @foreach($subcategories as $sub)
                  <option value="{{ $sub->id }}">{{ $sub->sub_cat_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label class="sa-label">Sub-Sub Category</label>
              <select class="sa-select" wire:model.defer="sub_subcategory_id" {{ !$subcategory_id ? 'disabled' : '' }}>
                <option value="">Select</option>
                @foreach($sub_subcategories as $ss)
                  <option value="{{ $ss->id }}">{{ $ss->sub_subcat_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>

      @endif

      {{-- ── STEP 2 ── --}}
      @if($activeStep == 2)

      {{-- Pricing --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#059669,#0d9488);">
          <i class="bi bi-currency-rupee"></i> Pricing Model
        </div>
        <div class="sa-body">
          <div class="sa-tip">💰 B2B buyers prefer seeing a price range. "Get Quote" listings get fewer enquiries than those with visible pricing.</div>

          <div class="price-type-pills">
            @foreach([
              'fixed'      => '📦 Fixed Price',
              'hourly'     => '⏱ Per Hour',
              'negotiable' => '🤝 Negotiable',
              'quote_based'=> '📋 Get Quote',
            ] as $val => $label)
            <div class="pt-pill {{ $pricing_type === $val ? 'active' : '' }}"
                 wire:click="$set('pricing_type', '{{ $val }}')">
              {{ $label }}
            </div>
            @endforeach
          </div>

          @if(in_array($pricing_type, ['fixed','hourly','negotiable']))
          <div class="row g-3">
            <div class="col-md-4">
              <label class="sa-label">Min Price (₹)</label>
              <input class="sa-input" wire:model.defer="min_price" type="number" min="0" placeholder="e.g. 5000">
              @error('min_price')<div class="sa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="sa-label">Max Price (₹)</label>
              <input class="sa-input" wire:model.defer="max_price" type="number" min="0" placeholder="e.g. 50000">
              @error('max_price')<div class="sa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="sa-label">Price Unit</label>
              <select class="sa-select" wire:model.defer="price_unit">
                <option value="per project">Per Project</option>
                <option value="per hour">Per Hour</option>
                <option value="per day">Per Day</option>
                <option value="per month">Per Month</option>
                <option value="per unit">Per Unit</option>
                <option value="per kg">Per Kg</option>
                <option value="per sqft">Per Sq.Ft</option>
              </select>
            </div>
          </div>
          @endif

        </div>
      </div>

      {{-- Delivery --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#059669,#0d9488);">
          <i class="bi bi-geo-alt-fill"></i> Delivery & Availability
        </div>
        <div class="sa-body">
          <div class="row g-3">
            <div class="col-12">
              <label class="sa-label">Delivery Mode *</label>
              <div class="dm-pills">
                @foreach(['Onsite','Remote','Both'] as $mode)
                <div class="dm-pill {{ $delivery_mode === $mode ? 'active' : '' }}"
                     wire:click="$set('delivery_mode','{{ $mode }}')">
                  @if($mode === 'Onsite') 🏭 Onsite
                  @elseif($mode === 'Remote') 💻 Remote
                  @else 🌐 Both (Onsite + Remote)
                  @endif
                </div>
                @endforeach
              </div>
              @error('delivery_mode')<div class="sa-err mt-2">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="sa-label">Turnaround Time</label>
              <input class="sa-input" wire:model.defer="turnaround_time"
                placeholder="e.g. 3-5 Business Days, 2 Weeks">
            </div>
            <div class="col-md-6">
              <label class="sa-label">Service Area / Location</label>
              <input class="sa-input" wire:model.defer="service_area"
                placeholder="e.g. Pan India, Mumbai, Global, South Asia">
            </div>
            <div class="col-md-6">
              <label class="sa-label">Payment Terms</label>
              <input class="sa-input" wire:model.defer="payment_terms"
                placeholder="e.g. 50% advance, 50% on delivery">
            </div>
            <div class="col-md-6">
              <label class="sa-label">Free Consultation?</label>
              <select class="sa-select" wire:model.defer="sample_consultation">
                <option value="no">No Free Consultation</option>
                <option value="yes">Yes — First consultation is free</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      @endif

      {{-- ── STEP 3 ── --}}
      @if($activeStep == 3)

      {{-- Credentials --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#d97706,#f59e0b);">
          <i class="bi bi-award-fill"></i> Credentials & Experience
        </div>
        <div class="sa-body">
          <div class="sa-tip">🏅 Credibility fields increase enquiry rates by up to 60%. Fill as many as possible.</div>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="sa-label">Years of Experience</label>
              <input class="sa-input" wire:model.defer="experience_years" placeholder="e.g. 10+ Years">
            </div>
            <div class="col-md-4">
              <label class="sa-label">Projects Completed</label>
              <input class="sa-input" wire:model.defer="projects_completed" type="number" min="0" placeholder="e.g. 500">
            </div>
            <div class="col-md-4">
              <label class="sa-label">Languages Supported</label>
              <input class="sa-input" wire:model.defer="languages" placeholder="e.g. English, Hindi, Tamil">
            </div>
            <div class="col-12">
              <label class="sa-label">Certifications & Awards</label>
              <input class="sa-input" wire:model.defer="certifications"
                placeholder="e.g. ISO 9001:2015, MSME Certified, Star Export House">
            </div>
            <div class="col-md-6">
              <label class="sa-label">What's Included</label>
              <textarea class="sa-textarea" wire:model.defer="inclusions" rows="4"
                placeholder="e.g. - Initial consultation&#10;- Design files (AI, PDF)&#10;- 3 revision rounds&#10;- Final delivery in 5 days"></textarea>
              <div class="sa-hint">List what's included line by line</div>
            </div>
            <div class="col-md-6">
              <label class="sa-label">What's NOT Included</label>
              <textarea class="sa-textarea" wire:model.defer="exclusions" rows="4"
                placeholder="e.g. - Printing cost&#10;- Raw material procurement&#10;- Onsite installation"></textarea>
              <div class="sa-hint">Being upfront reduces disputes</div>
            </div>
          </div>
        </div>
      </div>

      {{-- Media --}}
      <div class="sa-card">
        <div class="sa-head" style="background:linear-gradient(135deg,#d97706,#f59e0b);">
          <i class="bi bi-images"></i> Portfolio & Media
        </div>
        <div class="sa-body">
          <div class="sa-tip">📸 Service listings with portfolio images and videos get <strong>4× more enquiries</strong>. Show your past work!</div>

          {{-- Cover image --}}
          <div class="mb-4">
            <label class="sa-label">Cover Image</label>
            @if($cover_image)
              <img src="{{ $cover_image->temporaryUrl() }}"
                style="width:100%;height:200px;object-fit:cover;border-radius:12px;margin-bottom:10px;">
              <label for="coverImg" style="font-size:.78rem;color:#7c3aed;font-weight:700;cursor:pointer;">
                <i class="bi bi-arrow-repeat me-1"></i> Change
              </label>
            @else
              <label for="coverImg" class="img-drop d-block">
                <i class="bi bi-cloud-upload fs-2 text-muted"></i>
                <div style="font-size:.82rem;font-weight:700;color:#374151;margin-top:6px;">Upload Cover Image</div>
                <div class="sa-hint">Service banner or representative image</div>
              </label>
            @endif
            <input type="file" id="coverImg" class="d-none" wire:model="cover_image" accept="image/*">
            @error('cover_image')<div class="sa-err">{{ $message }}</div>@enderror
          </div>

          {{-- Portfolio --}}
          <div class="mb-4">
            <label class="sa-label">Portfolio Images <span class="sa-hint">(Show past work — up to 10 images)</span></label>
            @if(!empty($portfolio_files))
            <div class="portfolio-grid mb-3">
              @foreach($portfolio_files as $pf)
              <div class="portfolio-thumb"><img src="{{ $pf->temporaryUrl() }}"></div>
              @endforeach
            </div>
            @endif
            <label for="portfolioImgs" class="img-drop d-block" style="padding:16px 20px;">
              <i class="bi bi-plus-circle fs-3 text-muted"></i>
              <div style="font-size:.8rem;font-weight:700;color:#374151;margin-top:6px;">Add Portfolio Images</div>
            </label>
            <input type="file" id="portfolioImgs" class="d-none" wire:model="new_portfolio_files" multiple accept="image/*">
          </div>

          {{-- Video --}}
          <div>
            <label class="sa-label">Video URL <span class="sa-hint">(YouTube / Vimeo)</span></label>
            <input class="sa-input" wire:model.defer="video_url" placeholder="https://youtube.com/watch?v=...">
            <div class="sa-hint">A walkthrough or demo video dramatically increases trust</div>
            @error('video_url')<div class="sa-err">{{ $message }}</div>@enderror
          </div>
        </div>
      </div>

      {{-- Summary --}}
      <div class="sa-card" style="border:2px solid #e9d5ff;">
        <div class="sa-head" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <i class="bi bi-check2-all"></i> Ready to Submit?
        </div>
        <div class="sa-body">
          <p style="font-size:.85rem;color:#374151;margin-bottom:12px;line-height:1.7;">
            Your service will be submitted for <strong>admin review</strong> and go live once approved.
          </p>
          <table style="width:100%;font-size:.8rem;border-collapse:collapse;">
            <tr style="border-bottom:1px solid #f0f2f8;"><td style="padding:6px 0;color:#64748b;width:40%;">Title</td><td style="font-weight:700;color:#0f172a;">{{ $title ?: '—' }}</td></tr>
            <tr style="border-bottom:1px solid #f0f2f8;"><td style="padding:6px 0;color:#64748b;">Service Type</td><td style="font-weight:700;color:#0f172a;">{{ $service_type ?: '—' }}</td></tr>
            <tr style="border-bottom:1px solid #f0f2f8;"><td style="padding:6px 0;color:#64748b;">Pricing</td><td style="font-weight:700;color:#7c3aed;">
              @if($pricing_type === 'quote_based') Get Quote
              @elseif($pricing_type === 'negotiable') Negotiable
              @else ₹{{ $min_price ?: '—' }} – ₹{{ $max_price ?: '—' }} / {{ $price_unit }}
              @endif
            </td></tr>
            <tr style="border-bottom:1px solid #f0f2f8;"><td style="padding:6px 0;color:#64748b;">Delivery Mode</td><td style="font-weight:700;color:#0f172a;">{{ $delivery_mode ?: '—' }}</td></tr>
            <tr><td style="padding:6px 0;color:#64748b;">Free Consultation</td><td style="font-weight:700;color:#0f172a;">{{ $sample_consultation === 'yes' ? 'Yes' : 'No' }}</td></tr>
          </table>
        </div>
      </div>

      @endif

      {{-- Nav buttons --}}
      <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0 2rem;">
        @if($activeStep > 1)
          <button type="button" class="btn-prev" wire:click="prevStep">← Previous</button>
        @else
          <div></div>
        @endif

        @if($activeStep < $totalSteps)
          <button type="button" class="btn-next" wire:click="nextStep" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="nextStep">Next Step →</span>
            <span wire:loading wire:target="nextStep"><i class="bi bi-arrow-repeat me-1"></i> Saving...</span>
          </button>
        @else
          <button type="submit" class="btn-submit" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submit">🚀 Submit Service for Review</span>
            <span wire:loading wire:target="submit"><i class="bi bi-arrow-repeat me-1"></i> Submitting...</span>
          </button>
        @endif
      </div>

    </div>

    {{-- ══ RIGHT — Live Preview ══ --}}
    <div class="col-lg-4">
      <div class="preview-card">
        @if($cover_image)
          <img src="{{ $cover_image->temporaryUrl() }}" style="width:100%;height:200px;object-fit:cover;">
        @else
          <div style="width:100%;height:180px;background:linear-gradient(135deg,#faf5ff,#eff6ff);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:8px;">
            <i class="bi bi-briefcase" style="font-size:2.5rem;color:#a78bfa;"></i>
            <span style="font-size:.75rem;color:#94a3b8;">Service cover image</span>
          </div>
        @endif
        <div style="padding:16px;">
          @if($service_type)
          <span style="font-size:.7rem;background:#ede9fe;color:#7c3aed;padding:2px 9px;border-radius:20px;font-weight:700;">{{ $service_type }}</span>
          @endif

          <div style="font-size:.95rem;font-weight:800;color:#0f172a;margin:10px 0 6px;line-height:1.3;">
            {{ $title ?: 'Service Title' }}
          </div>

          @if($pricing_type === 'quote_based')
            <div style="font-size:.9rem;font-weight:700;color:#7c3aed;">📋 Get Quote</div>
          @elseif($pricing_type === 'negotiable')
            <div style="font-size:.9rem;font-weight:700;color:#059669;">🤝 Negotiable</div>
          @elseif($min_price || $max_price)
            <div style="font-size:.95rem;font-weight:700;color:#059669;">₹{{ $min_price ?: '—' }} – ₹{{ $max_price ?: '—' }} <span style="font-size:.72rem;color:#64748b;">{{ $price_unit }}</span></div>
          @endif

          <div style="margin-top:8px;font-size:.75rem;color:#64748b;line-height:1.7;">
            @if($delivery_mode)<div>🌐 {{ $delivery_mode }}</div>@endif
            @if($turnaround_time)<div>⏱ {{ $turnaround_time }}</div>@endif
            @if($service_area)<div>📍 {{ $service_area }}</div>@endif
            @if($experience_years)<div>💼 {{ $experience_years }} experience</div>@endif
            @if($sample_consultation === 'yes')<div style="color:#059669;font-weight:700;">✅ Free first consultation</div>@endif
          </div>

          {{-- Completion --}}
          <div style="margin-top:14px;padding-top:14px;border-top:1px solid #f1f5f9;">
            <div style="font-size:.7rem;font-weight:700;color:#94a3b8;margin-bottom:8px;letter-spacing:1px;text-transform:uppercase;">Completion</div>
            @foreach([
              ['Service Type', !empty($service_type)],
              ['Title', !empty($title)],
              ['Description', !empty($description)],
              ['Category', !empty($category_id)],
              ['Pricing', $pricing_type !== ''],
              ['Delivery Mode', !empty($delivery_mode)],
            ] as [$lbl, $ok])
            <div style="display:flex;align-items:center;gap:6px;font-size:.73rem;margin-bottom:4px;color:{{ $ok ? '#059669' : '#94a3b8' }};">
              <i class="bi {{ $ok ? 'bi-check-circle-fill' : 'bi-circle' }}" style="font-size:.72rem;"></i>{{ $lbl }}
            </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- B2B tips --}}
      <div style="background:#0f172a;border-radius:14px;padding:18px;margin-top:14px;color:#e2e8f0;">
        <div style="font-size:.82rem;font-weight:800;color:#c084fc;margin-bottom:10px;">🌍 Service Listing Tips</div>
        <div style="font-size:.75rem;line-height:1.75;color:#94a3b8;">
          ✅ Add portfolio images of past work<br>
          ✅ Offer free first consultation<br>
          ✅ Be specific about turnaround time<br>
          ✅ List your certifications<br>
          ✅ Show number of projects completed<br>
          ✅ Add a video walkthrough/demo<br>
          ✅ Clearly state what's included & excluded
        </div>
      </div>
    </div>

  </div>
  </form>
</div>

<livewire:seller.layout.footer />
</div>