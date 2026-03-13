<div>
    <livewire:seller.layout.header />
    <main class="main" id="top">
    <style>
          .doc-card{border:1.5px dashed var(--bdr);border-radius:12px;padding:1.1rem 1.2rem;background:#fafbfe;transition:border .2s,background .2s;}
            .doc-card.dc-ok{border-style:solid;border-color:var(--green);background:#f0fdf9;}
            .doc-card.dc-warn{border-style:solid;border-color:#f59e0b;background:#fffbeb;}
            .doc-card.dc-error{border-style:solid;border-color:#e02424;background:#fff5f5;}
            .doc-card-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:.4rem;}
            .doc-card-title{display:flex;align-items:center;gap:.6rem;font-size:.86rem;font-weight:700;color:#1a1f36;}
            .doc-guide{font-size:.74rem;background:#f0f4ff;border-radius:7px;padding:.35rem .65rem;color:#374151;margin-bottom:.7rem;line-height:1.5;}
            .doc-result{display:flex;align-items:flex-start;gap:.5rem;border-radius:8px;padding:.45rem .75rem;font-size:.78rem;line-height:1.5;margin-bottom:.5rem;font-weight:500;}
            .dr-ok{background:#d5f5ec;color:#065f46;}
            .dr-warn{background:#fef3c7;color:#92400e;}
            .dr-error{background:#fee2e2;color:#991b1b;}
            .ul-btn{display:inline-flex;align-items:center;gap:5px;background:var(--blt);color:var(--blue);border:none;border-radius:8px;padding:.38rem .85rem;font-size:.79rem;font-weight:600;cursor:pointer;transition:background .2s;}
            .ul-btn:hover{background:#c7d7fc;}
            .doc-uploading{display:none;font-size:.76rem;color:var(--mu);align-items:center;gap:4px;}

            /* File preview card */
            .file-preview{border:1.5px solid var(--bdr);border-radius:10px;overflow:hidden;margin-bottom:.7rem;}
            .file-preview-top{background:#f4f6fb;padding:1.2rem;display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:110px;}
            .file-preview-top img{max-height:90px;max-width:100%;border-radius:6px;object-fit:cover;box-shadow:0 2px 8px rgba(0,0,0,.1);}
            .file-preview-icon{font-size:2.8rem;margin-bottom:.3rem;}
            .file-preview-label{font-size:.72rem;color:var(--mu);font-weight:600;margin-top:.2rem;letter-spacing:.03em;}
            .file-preview-bottom{padding:.5rem .85rem;background:#fff;display:flex;align-items:center;justify-content:space-between;gap:.5rem;border-top:1px solid var(--bdr);}
            .file-preview-name{font-size:.76rem;color:#374151;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;display:flex;align-items:center;gap:5px;}
            .file-preview-meta{font-size:.71rem;color:#9ca3af;white-space:nowrap;}
            .new-sel-badge{background:var(--green);color:#fff;font-size:.65rem;font-weight:800;padding:3px 9px;border-radius:20px;letter-spacing:.04em;white-space:nowrap;}
           
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Sora:wght@600;700&display=swap');
        :root{--blue:#1a56db;--blt:#e8f0fe;--green:#0e9f6e;--glt:#d5f5ec;--red:#e02424;--warn:#f59e0b;--wlt:#fef3c7;--bg:#f4f6fb;--bdr:#e5e9f2;--tx:#1a1f36;--mu:#6b7280;--r:14px;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--tx);}
        .pw{max-width:1100px;margin:2rem auto;padding:0 1rem 4rem;}
        .pg{display:grid;grid-template-columns:270px 1fr;gap:1.5rem;align-items:start;}
        .gpc{background:#fff;border-radius:var(--r);border:1px solid var(--bdr);padding:1.5rem;}

        /* Sidebar */
        .av-wrap{position:relative;width:88px;height:88px;margin:0 auto 1rem;}
        .av-wrap svg{position:absolute;top:0;left:0;}
        .av-img{width:72px;height:72px;border-radius:50%;object-fit:cover;position:absolute;top:8px;left:8px;border:3px solid #fff;}
        .av-pct{position:absolute;bottom:-6px;left:50%;transform:translateX(-50%);background:var(--blue);color:#fff;font-size:.62rem;font-weight:700;padding:2px 8px;border-radius:20px;white-space:nowrap;}
        .sname{font-family:'Sora',sans-serif;font-size:1rem;font-weight:700;text-align:center;margin-bottom:.2rem;}
        .semail{font-size:.78rem;color:var(--mu);text-align:center;margin-bottom:.8rem;}
        .sbadge{display:flex;align-items:center;justify-content:center;gap:5px;font-size:.73rem;padding:5px 12px;border-radius:20px;font-weight:600;margin-bottom:1rem;}
        .bp{background:#fef3c7;color:#92400e;}.ba{background:var(--glt);color:#065f46;}.br{background:#fee2e2;color:#991b1b;}.bu{background:var(--blt);color:#1e40af;}
        .pbar-lbl{font-size:.78rem;color:var(--mu);display:flex;justify-content:space-between;margin-bottom:4px;}
        .pbar-track{height:7px;background:#e5e9f2;border-radius:99px;overflow:hidden;margin-bottom:.8rem;}
        .pbar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--blue),#0ea5e9);transition:width .6s;}
        .chklist{list-style:none;padding:0;margin:.8rem 0 0;}
        .chklist li{display:flex;align-items:center;gap:8px;font-size:.79rem;padding:5px 0;border-bottom:1px solid #f0f2f8;color:var(--mu);}
        .chklist li:last-child{border:none;}
        .chklist li.done{color:var(--tx);}
        .ck-ic{width:17px;height:17px;border-radius:50%;display:grid;place-items:center;font-size:.6rem;flex-shrink:0;}
        .ck-y{background:var(--green);color:#fff;}.ck-n{background:#e5e9f2;color:var(--mu);}

        /* Step nav */
        .step-nav{display:flex;border-bottom:2px solid var(--bdr);margin-bottom:1.5rem;overflow-x:auto;}
        .step-btn{flex:1;min-width:100px;padding:.6rem .4rem;font-size:.78rem;font-weight:600;border:none;background:none;cursor:pointer;color:var(--mu);border-bottom:3px solid transparent;margin-bottom:-2px;display:flex;flex-direction:column;align-items:center;gap:3px;transition:all .2s;}
        .step-btn.active{color:var(--blue);border-bottom-color:var(--blue);}
        .step-btn.sdone{color:var(--green);}
        .step-num{width:24px;height:24px;border-radius:50%;background:#e5e9f2;color:var(--mu);font-size:.7rem;font-weight:700;display:grid;place-items:center;transition:all .2s;margin-bottom:2px;}
        .step-btn.active .step-num{background:var(--blue);color:#fff;}
        .step-btn.sdone .step-num{background:var(--green);color:#fff;}
        .spct{font-size:.65rem;padding:1px 6px;border-radius:20px;font-weight:700;}
        .spct-full{background:var(--glt);color:#065f46;}.spct-part{background:#fef3c7;color:#92400e;}.spct-no{background:#fee2e2;color:#991b1b;}

        /* Form */
        .stitle{font-family:'Sora',sans-serif;font-size:1rem;font-weight:700;margin-bottom:.25rem;}
        .ssub{font-size:.82rem;color:var(--mu);margin-bottom:1.3rem;}
        .fg{margin-bottom:1.1rem;}
        .fg label{font-size:.8rem;font-weight:600;margin-bottom:4px;display:block;color:#374151;}
        .fg .form-control,.fg .form-select{border:1.5px solid var(--bdr);border-radius:10px;font-size:.87rem;padding:.5rem .85rem;transition:border .2s,box-shadow .2s;}
        .fg .form-control:focus,.fg .form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(26,86,219,.08);outline:none;}
        .fg .form-control:disabled{background:#f9fafb;color:var(--mu);}

        /* Buttons */
        .btn-p{background:linear-gradient(135deg,var(--blue),#0ea5e9);color:#fff;border:none;border-radius:10px;padding:.58rem 1.6rem;font-weight:700;font-size:.87rem;cursor:pointer;transition:transform .15s,box-shadow .15s;display:inline-flex;align-items:center;gap:6px;}
        .btn-p:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(26,86,219,.22);}
        .btn-o{background:#fff;color:var(--blue);border:1.5px solid var(--blue);border-radius:10px;padding:.53rem 1.3rem;font-weight:600;font-size:.87rem;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background .2s;}
        .btn-o:hover{background:var(--blt);}

        /* Doc upload zone */
        .duz{border:1.5px dashed var(--bdr);border-radius:12px;padding:1rem 1.2rem;transition:border .2s;background:#fafbfe;}
        .duz.up{border-style:solid;border-color:var(--green);background:#f0fdf9;}
        .duz.warn-zone{border-color:var(--warn);background:#fffbeb;}
        .duz-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:.3rem;}
        .duz-lbl{font-size:.84rem;font-weight:700;display:flex;align-items:center;gap:6px;}
        .duz-hint{font-size:.74rem;color:var(--mu);margin-bottom:.5rem;}
        .ul-btn{display:inline-flex;align-items:center;gap:5px;background:var(--blt);color:var(--blue);border:none;border-radius:8px;padding:.38rem .85rem;font-size:.79rem;font-weight:600;cursor:pointer;transition:background .2s;margin-top:.4rem;}
        .ul-btn:hover{background:#c7d7fc;}
        .ds{font-size:.71rem;padding:2px 8px;border-radius:20px;font-weight:600;}
        .ds-pending{background:#fef3c7;color:#92400e;}.ds-approved{background:var(--glt);color:#065f46;}.ds-rejected{background:#fee2e2;color:#991b1b;}
        /* File accepted indicator */
        .file-accepted{font-size:.76rem;color:var(--green);display:flex;align-items:center;gap:5px;margin-top:.4rem;font-weight:600;}
        /* Document warning */
        .doc-warn{background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:.5rem .8rem;font-size:.77rem;color:#92400e;display:flex;align-items:flex-start;gap:6px;margin-top:.5rem;line-height:1.5;}
        /* Doc type guide pill */
        .doc-guide{font-size:.71rem;background:#f0f2f8;color:var(--mu);border-radius:6px;padding:3px 8px;font-style:italic;}

        /* Plans */
        .plan-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem;}
        .plan-card{border:2px solid var(--bdr);border-radius:14px;padding:1.4rem 1rem;cursor:pointer;transition:all .2s;position:relative;text-align:center;}
        .plan-card:hover,.plan-card.sel{border-color:var(--blue);box-shadow:0 4px 20px rgba(26,86,219,.12);}
        .plan-card.sel{background:var(--blt);}
        .plan-card.sel::after{content:'✓ Selected';position:absolute;top:8px;right:8px;font-size:.65rem;background:var(--blue);color:#fff;padding:2px 8px;border-radius:20px;font-weight:700;}
        .pop-badge{position:absolute;top:-11px;left:50%;transform:translateX(-50%);background:var(--blue);color:#fff;font-size:.67rem;font-weight:700;padding:2px 12px;border-radius:20px;white-space:nowrap;}
        .pname{font-family:'Sora',sans-serif;font-size:.95rem;font-weight:700;margin-bottom:.3rem;}
        .pprice{font-size:1.7rem;font-weight:800;color:var(--blue);margin-bottom:.2rem;}
        .pprice span{font-size:.78rem;font-weight:400;color:var(--mu);}
        .pfeat{list-style:none;padding:0;margin:.8rem 0 0;text-align:left;}
        .pfeat li{font-size:.77rem;padding:3px 0;display:flex;align-items:center;gap:6px;color:#374151;}
        .pfeat li i{color:var(--green);font-size:.68rem;}

        .sfooter{display:flex;justify-content:space-between;align-items:center;padding-top:1.2rem;border-top:1px solid var(--bdr);margin-top:1rem;}
        .autosave{font-size:.74rem;color:var(--mu);display:flex;align-items:center;gap:5px;}
        .gp-ok{background:var(--glt);color:#065f46;border-radius:10px;padding:.6rem 1rem;font-size:.82rem;font-weight:500;margin-bottom:1rem;display:flex;align-items:center;gap:8px;}
        .gp-info{background:var(--blt);color:#1e40af;border-radius:10px;padding:.65rem 1rem;font-size:.81rem;margin-top:.8rem;display:flex;align-items:center;gap:8px;}

        @media(max-width:768px){
            .pg{grid-template-columns:1fr;}
            .plan-grid{grid-template-columns:1fr;}
            .step-btn{min-width:70px;font-size:.7rem;}
        }
    </style>

    <div class="pw">
      <div class="pg">

        {{-- ══ SIDEBAR ══ --}}
        <div>
          <div class="gpc text-center">
            <div class="av-wrap">
              <svg width="88" height="88" viewBox="0 0 88 88">
                <circle cx="44" cy="44" r="39" fill="none" stroke="#e5e9f2" stroke-width="5"/>
                <circle cx="44" cy="44" r="39" fill="none" stroke="#1a56db" stroke-width="5"
                  stroke-dasharray="{{ round($completion * 2.45) }} 245"
                  stroke-dashoffset="61" stroke-linecap="round"
                  transform="rotate(-90 44 44)"/>
              </svg>
              <img class="av-img" src="{{ asset('assets/img/team/72x72/57.webp') }}" alt="">
              <span class="av-pct">{{ $completion }}%</span>
            </div>
            <div class="sname">{{ $seller?->details?->legal_business_name ?? session('seller_name') }}</div>
            <div class="semail">{{ $seller?->email }}</div>
            @php $st = $seller?->status ?? 'pending'; @endphp
            <div class="sbadge {{ $st==='approved'?'ba':($st==='under_review'?'bu':($st==='rejected'?'br':'bp')) }}">
              <i class="fas fa-circle" style="font-size:.4rem"></i>
              {{ ucfirst(str_replace('_',' ',$st)) }}
            </div>
            @if($seller?->activeSubscription)
              <div style="margin-bottom:.8rem;">
                <span style="font-size:.72rem;background:#f0f2f8;padding:3px 10px;border-radius:20px;font-weight:600;">
                  <i class="fas fa-crown text-warning me-1"></i>{{ ucfirst($seller->activeSubscription->plan_name) }} Plan
                </span>
              </div>
            @endif
            <div class="pbar-lbl"><span>Profile Strength</span><span style="color:var(--blue);font-weight:700;">{{ $completion }}%</span></div>
            <div class="pbar-track"><div class="pbar-fill" style="width:{{ $completion }}%"></div></div>
            <ul class="chklist">
              @foreach([
                ['Phone number',        !empty($phone)],
                ['Country set',         !empty($country_id)],
                ['Business name',       !empty($legal_business_name)],
                ['Business type',       !empty($business_type)],
                ['Business address',    !empty($business_address)],
                ['Company description', !empty($company_description)],
                ['Main products',       !empty($main_products)],
                ['Plan selected',       !empty($selected_plan)],
                ['Business Reg. doc',   $documents->has('business_registration')],
                ['ID / Passport',       $documents->has('owner_id_passport')],
                ['Tax ID',              $documents->has('tax_id')],
              ] as [$lbl,$done])
                <li class="{{ $done?'done':'' }}">
                  <span class="ck-ic {{ $done?'ck-y':'ck-n' }}"><i class="fas {{ $done?'fa-check':'fa-plus' }}"></i></span>
                  {{ $lbl }}
                </li>
              @endforeach
            </ul>
          </div>
          <div class="gpc mt-3" style="background:var(--blt);border-color:#c7d7fc;">
            <div style="font-size:.77rem;font-weight:700;color:var(--blue);margin-bottom:.3rem;">
              <i class="fas fa-lightbulb me-1"></i> Pro Tip
            </div>
            <p style="font-size:.75rem;color:#1e40af;margin:0;line-height:1.5;">
              Sellers with complete profiles get <strong>3× more inquiries</strong>. Complete KYC to unlock the Verified badge.
            </p>
          </div>
        </div>

        {{-- ══ MAIN ══ --}}
        <div>
          <div class="gpc">

            @if($successMsg)
              <div class="gp-ok"><i class="fas fa-check-circle"></i> {{ $successMsg }}</div>
            @endif
            @if($errorMsg)
              <div style="background:#fee2e2;color:#991b1b;border-radius:10px;padding:.6rem 1rem;font-size:.82rem;margin-bottom:1rem;display:flex;align-items:center;gap:8px;">
                <i class="fas fa-exclamation-circle"></i> {{ $errorMsg }}
              </div>
            @endif

            {{-- Step navigation --}}
            <div class="step-nav">
              @foreach([[1,'Basic Info'],[2,'Business'],[3,'Company Profile'],[4,'Verification'],[5,'Plan']] as [$n,$lbl])
                @php $sc=$stepScore[$n]; $isActive=$activeStep===$n; $isDone=$sc===100; @endphp
                <button class="step-btn {{ $isActive?'active':'' }} {{ $isDone&&!$isActive?'sdone':'' }}"
                    wire:click="goToStep({{ $n }})">
                  <span class="step-num">
                    @if($isDone&&!$isActive)<i class="fas fa-check" style="font-size:.58rem"></i>@else{{ $n }}@endif
                  </span>
                  {{ $lbl }}
                  <span class="spct {{ $sc===100?'spct-full':($sc>0?'spct-part':'spct-no') }}">{{ $sc }}%</span>
                </button>
              @endforeach
            </div>

            {{-- ── STEP 1: BASIC ── --}}
            @if($activeStep===1)
              <div class="stitle">Basic Information</div>
              <div class="ssub">Your account details</div>
              <form wire:submit.prevent="saveStep1">
                <div class="row">
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Email Address</label>
                      <input class="form-control" value="{{ $email }}" disabled>
                      <small class="text-muted" style="font-size:.73rem;">Email cannot be changed</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Phone Number *</label>
                      <input type="text" class="form-control" wire:model.defer="phone" placeholder="+91 98765 43210">
                      @error('phone')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Country *</label>
                      <select class="form-select" wire:model.defer="country_id">
                        <option value="">Select Country</option>
                        @foreach($countries as $c)
                          <option value="{{ $c->country_id }}"
                            {{ (string)$c->country_id === (string)$country_id ? 'selected' : '' }}>
                            {{ $c->short_name }}
                          </option>
                        @endforeach
                      </select>
                      @error('country_id')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                </div>
                <div class="sfooter">
                  <span class="autosave"><i class="fas fa-save"></i> Auto-saved</span>
                  <button type="submit" class="btn-p" wire:loading.attr="disabled">
                    <span wire:loading wire:target="saveStep1" class="spinner-border spinner-border-sm me-1"></span>
                    Continue <i class="fas fa-arrow-right" wire:loading.remove wire:target="saveStep1"></i>
                  </button>
                </div>
              </form>

            {{-- ── STEP 2: BUSINESS ── --}}
            @elseif($activeStep===2)
              <div class="stitle">Business Information</div>
              <div class="ssub">Tell us about your company</div>
              <form wire:submit.prevent="saveStep2">
                <div class="row">
                  <div class="col-12">
                    <div class="fg">
                      <label>Legal Business Name *</label>
                      <input type="text" class="form-control" wire:model.defer="legal_business_name"
                        placeholder="e.g. Acme International Ltd.">
                      @error('legal_business_name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Business Type *</label>
                      <select class="form-select" wire:model.defer="business_type">
                        <option value="">Select</option>
                        <option value="sole_proprietor">Sole Proprietor</option>
                        <option value="partnership">Partnership</option>
                        <option value="llc">LLC / LLP</option>
                        <option value="corporation">Corporation / Pvt Ltd</option>
                        <option value="other">Other</option>
                      </select>
                      @error('business_type')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Year Established</label>
                      <input type="number" class="form-control" wire:model.defer="year_established"
                        placeholder="{{ date('Y') - 5 }}" min="1800" max="{{ date('Y') }}">
                      @error('year_established')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Company Website</label>
                      <div style="position:relative;">
                        <span style="position:absolute;left:.85rem;top:50%;transform:translateY(-50%);font-size:.78rem;color:var(--mu);">https://</span>
                        <input type="text" class="form-control" wire:model.defer="company_website"
                          style="padding-left:4.5rem;"
                          placeholder="www.example.com">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Number of Employees *</label>
                      <select class="form-select" wire:model.defer="num_employees">
                        <option value="">Select</option>
                        <option value="1-10">1–10</option>
                        <option value="11-50">11–50</option>
                        <option value="51-200">51–200</option>
                        <option value="201-500">201–500</option>
                        <option value="500+">500+</option>
                      </select>
                      @error('num_employees')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="fg">
                      <label>Country</label>
                      <select class="form-select" wire:model.defer="business_country_id">
                        <option value="">Select</option>
                        @foreach($countries as $c)
                          <option value="{{ $c->country_id }}"
                            {{ (string)$c->country_id===(string)$business_country_id?'selected':'' }}>
                            {{ $c->short_name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="fg">
                      <label>State / Province</label>
                      <input type="text" class="form-control" wire:model.defer="state_province" placeholder="e.g. Gujarat">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="fg">
                      <label>City *</label>
                      <input type="text" class="form-control" wire:model.defer="city" placeholder="e.g. Surat">
                      @error('city')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="fg">
                      <label>Business Address *</label>
                      <textarea class="form-control" wire:model.defer="business_address" rows="2"
                        placeholder="e.g. 123 Industrial Ave, Gajera, Surat - 395006"></textarea>
                      @error('business_address')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>

                  {{-- Business Registration Doc --}}
                  <div class="col-12">
                    <div class="fg">
                      <label>
                        Business Registration Document
                        <span class="doc-guide ms-1">GST Certificate / Incorporation / Trade License</span>
                      </label>
                      @php $brDoc = $documents->get('business_registration'); @endphp
                      <div class="duz {{ $brDoc?'up':'' }} {{ isset($docWarnings['business_registration'])?'warn-zone':'' }}">
                        <div class="duz-head">
                          <div class="duz-lbl">
                            <i class="fas fa-file-alt text-primary"></i>
                            Business Registration
                            @if($brDoc)
                              <span class="ds ds-{{ $brDoc->review_status }}">{{ ucfirst($brDoc->review_status) }}</span>
                            @endif
                          </div>
                          @if(!$brDoc)
                            <span style="font-size:.72rem;color:var(--mu);">PDF, JPG, PNG · max 5MB</span>
                          @endif
                        </div>
                        <div class="duz-hint">Upload your GST certificate, business incorporation, or trade license</div>
                        @if($brDoc)
                          <div class="file-accepted"><i class="fas fa-check-circle"></i>{{ $brDoc->file_name }} ({{ round($brDoc->file_size_bytes/1024) }} KB)</div>
                        @endif
                        @if(isset($docWarnings['business_registration']))
                          <div class="doc-warn"><i class="fas fa-exclamation-triangle mt-1"></i><span>{{ $docWarnings['business_registration'] }}</span></div>
                        @endif
                        <div>
                          <input type="file" wire:model="doc_business_registration" id="f_br"
                            style="display:none;" accept=".pdf,.jpg,.jpeg,.png"
                            x-on:change="$wire.checkDocFile('business_registration', $event.target.files[0]?.name ?? '')">
                          <label for="f_br" class="ul-btn">
                            <i class="fas fa-upload"></i> {{ $brDoc?'Re-upload':'Upload Document' }}
                          </label>
                          <span wire:loading wire:target="doc_business_registration" class="ms-2 text-muted" style="font-size:.76rem;">
                            <span class="spinner-border spinner-border-sm"></span> Uploading...
                          </span>
                        </div>
                      </div>
                      @error('doc_business_registration')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                  </div>
                </div>
                <div class="sfooter">
                  <button type="button" class="btn-o" wire:click="goToStep(1)">
                    <i class="fas fa-arrow-left"></i> Back
                  </button>
                  <div class="d-flex align-items-center gap-3">
                    <span class="autosave"><i class="fas fa-save"></i> Auto-saved</span>
                    <button type="submit" class="btn-p" wire:loading.attr="disabled">
                      <span wire:loading wire:target="saveStep2" class="spinner-border spinner-border-sm me-1"></span>
                      Continue <i class="fas fa-arrow-right" wire:loading.remove wire:target="saveStep2"></i>
                    </button>
                  </div>
                </div>
              </form>

            {{-- ── STEP 3: COMPANY PROFILE ── --}}
            @elseif($activeStep===3)
              <div class="stitle">Company Profile</div>
              <div class="ssub">This will be shown to buyers on your storefront</div>
              <form wire:submit.prevent="saveStep3">
                <div class="row">
                  <div class="col-12">
                    <div class="fg">
                      <label>Company Description</label>
                      <textarea class="form-control" wire:model.defer="company_description" rows="4"
                        placeholder="Tell buyers about your company, expertise, and what makes you unique..."></textarea>
                      <small class="text-muted" style="font-size:.72rem;">{{ strlen($company_description ?? '') }}/2000 chars</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg"><label>Main Products</label>
                      <input type="text" class="form-control" wire:model.defer="main_products"
                        placeholder="e.g. LED Lights, Solar Panels, Textile">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg"><label>Factory Size (sqm)</label>
                      <input type="number" class="form-control" wire:model.defer="factory_size_sqm" placeholder="e.g. 5000">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg"><label>Production Capacity</label>
                      <input type="text" class="form-control" wire:model.defer="production_capacity"
                        placeholder="e.g. 10,000 units/month">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg"><label>Export Markets</label>
                      <input type="text" class="form-control" wire:model.defer="export_markets"
                        placeholder="e.g. USA, Europe, Middle East">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="fg"><label>Certifications</label>
                      <input type="text" class="form-control" wire:model.defer="certifications"
                        placeholder="e.g. ISO 9001, CE, RoHS, BIS">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Company Logo <span class="doc-guide ms-1">PNG, SVG · max 2MB</span></label>
                      <div class="duz">
                        <div class="text-center py-1">
                          <i class="fas fa-image text-muted" style="font-size:1.2rem;"></i>
                          <div class="duz-hint mt-1">Your logo shown on storefront to buyers</div>
                        </div>
                        <input type="file" wire:model="logo_file" id="f_logo" style="display:none;" accept=".png,.svg,.jpg,.jpeg">
                        <label for="f_logo" class="ul-btn"><i class="fas fa-upload"></i> Upload Logo</label>
                        <span wire:loading wire:target="logo_file" class="ms-2 text-muted" style="font-size:.76rem;">
                          <span class="spinner-border spinner-border-sm"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="fg">
                      <label>Company Video <small class="text-muted">(optional · MP4, MOV · max 50MB)</small></label>
                      <div class="duz">
                        <div class="text-center py-1">
                          <i class="fas fa-video text-muted" style="font-size:1.2rem;"></i>
                          <div class="duz-hint mt-1">Showcase your factory / products to buyers</div>
                        </div>
                        <label class="ul-btn"><i class="fas fa-upload"></i> Upload Video</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sfooter">
                  <button type="button" class="btn-o" wire:click="goToStep(2)"><i class="fas fa-arrow-left"></i> Back</button>
                  <div class="d-flex align-items-center gap-3">
                    <span class="autosave"><i class="fas fa-save"></i> Auto-saved</span>
                    <button type="submit" class="btn-p" wire:loading.attr="disabled">
                      <span wire:loading wire:target="saveStep3" class="spinner-border spinner-border-sm me-1"></span>
                      Continue <i class="fas fa-arrow-right" wire:loading.remove wire:target="saveStep3"></i>
                    </button>
                  </div>
                </div>
              </form>

            {{-- ── STEP 4: VERIFICATION ── --}}
            @elseif($activeStep===4)
            <div class="stitle">Identity & Business Verification</div>
            <div class="ssub">Upload clear scans or photos · PDF, JPG, PNG · max 5MB each</div>

            @php
            $docDefs = [
                ['type'=>'owner_id_passport', 'icon'=>'fas fa-id-card',  'label'=>'Owner ID or Passport',
                'hint'=>'Government-issued personal photo ID',
                'guide'=>'Accepted: Aadhaar Card, Passport, Driving Licence, PAN Card, Voter ID',
                'accept'=>'.jpg,.jpeg,.png,.pdf', 'required'=>true],
                ['type'=>'business_license',  'icon'=>'fas fa-award',    'label'=>'Business License',
                'hint'=>'Trade licence or business permit',
                'guide'=>'Accepted: Shop & Establishment Cert., Trade Licence, Municipal Permit, FSSAI',
                'accept'=>'.jpg,.jpeg,.png,.pdf', 'required'=>false],
                ['type'=>'tax_id',            'icon'=>'fas fa-receipt',  'label'=>'Tax ID Document',
                'hint'=>'Tax identification certificate',
                'guide'=>'Accepted: GST Certificate, PAN Card (business), TIN, VAT Registration',
                'accept'=>'.jpg,.jpeg,.png,.pdf', 'required'=>true],
                ['type'=>'selfie',            'icon'=>'fas fa-camera',   'label'=>'Selfie with ID',
                'hint'=>'Photo of yourself holding your government ID',
                'guide'=>'Your face AND the ID must both be visible · JPG or PNG only (no PDF)',
                'accept'=>'.jpg,.jpeg,.png', 'required'=>false],
            ];
            @endphp

            <div class="row g-3">
                @foreach($docDefs as $def)
                @php
                    $type      = $def['type'];
                    $doc       = $documents->get($type);
                    $ver       = $docVerification[$type] ?? null;
                    $fid       = 'f_' . $type;
                    $spinnerId = 'sp_' . $type;
                    $prevId    = 'prev_' . $type;

                    // Determine card state
                    $cardClass = match($ver['status'] ?? ($doc ? 'ok' : '')) {
                    'ok'    => 'dc-ok',
                    'warn'  => 'dc-warn',
                    'error' => 'dc-error',
                    default => '',
                    };

                    // Figure out stored file type from mime
                    $isStoredImage = $doc && str_starts_with($doc->mime_type, 'image/');
                    $isStoredPdf   = $doc && $doc->mime_type === 'application/pdf';
                @endphp

                <div class="col-md-6 col-12">
                    <div class="doc-card {{ $cardClass }}">

                    {{-- Card header --}}
                    <div class="doc-card-head">
                        <div class="doc-card-title">
                        <i class="{{ $def['icon'] }}" style="color:var(--blue);font-size:1rem;"></i>
                        {{ $def['label'] }}
                        @if($def['required'])<span style="color:var(--red);">*</span>@endif
                        @if($doc)
                            <span class="ds ds-{{ $doc->review_status }}">{{ ucfirst($doc->review_status) }}</span>
                        @endif
                        </div>
                        <span style="font-size:.71rem;color:var(--mu);">{{ $def['hint'] }}</span>
                    </div>

                    {{-- Guide --}}
                    <div class="doc-guide">
                        <i class="fas fa-info-circle me-1" style="color:var(--blue);"></i>{{ $def['guide'] }}
                    </div>

                    {{-- ── FILE PREVIEW (shown after upload) ── --}}
                    @if($doc && (!$ver || $ver['status'] !== 'error'))
                        <div class="file-preview" id="{{ $prevId }}">

                        {{-- Top preview area --}}
                        <div class="file-preview-top">
                            @if($isStoredImage)
                            {{-- Show actual image thumbnail --}}
                            <img
                                src="{{ asset('storage/' . $doc->storage_url) }}"
                                alt="{{ $doc->file_name }}"
                                onerror="this.style.display='none';document.getElementById('icon_{{ $type }}').style.display='block';"
                            >
                            <div id="icon_{{ $type }}" style="display:none;text-align:center;">
                                <div class="file-preview-icon" style="color:#0ea5e9;">
                                <i class="fas fa-image"></i>
                                </div>
                                <div class="file-preview-label">IMAGE</div>
                            </div>
                            @elseif($isStoredPdf)
                            {{-- PDF icon --}}
                            <div class="file-preview-icon" style="color:#e02424;">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="file-preview-label">PDF DOCUMENT</div>
                            @else
                            {{-- Generic file --}}
                            <div class="file-preview-icon" style="color:#6b7280;">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="file-preview-label">DOCUMENT</div>
                            @endif
                        </div>

                        {{-- Bottom: filename + new selection badge --}}
                        <div class="file-preview-bottom">
                            <div class="file-preview-name">
                            <i class="fas fa-paperclip" style="color:var(--blue);flex-shrink:0;font-size:.7rem;"></i>
                            {{ $doc->file_name }}
                            </div>
                            <div style="display:flex;align-items:center;gap:.5rem;">
                            <span class="file-preview-meta">{{ round($doc->file_size_bytes / 1024) }} KB</span>
                            @if($ver && $ver['status'] === 'ok')
                                <span class="new-sel-badge">UPLOADED</span>
                            @endif
                            </div>
                        </div>

                        </div>{{-- end file-preview --}}
                    @endif

                    {{-- ── CLIENT-SIDE PREVIEW (shown immediately after user picks file, before Livewire uploads) ── --}}
                    {{-- This is shown by JS as soon as user selects a file --}}
                    <div id="local_prev_{{ $type }}" style="display:none;" class="file-preview">
                        <div class="file-preview-top" id="local_prev_top_{{ $type }}">
                        {{-- JS fills this in --}}
                        </div>
                        <div class="file-preview-bottom">
                        <div class="file-preview-name" id="local_prev_name_{{ $type }}">
                            <i class="fas fa-paperclip" style="color:var(--blue);flex-shrink:0;font-size:.7rem;"></i>
                            <span></span>
                        </div>
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span class="file-preview-meta" id="local_prev_size_{{ $type }}"></span>
                            <span class="new-sel-badge" style="background:var(--blue);">NEW SELECTION</span>
                        </div>
                        </div>
                    </div>

                    {{-- Spinner (JS controlled) --}}
                    <span id="{{ $spinnerId }}" class="doc-uploading" style="margin-bottom:.4rem;">
                        <span class="spinner-border spinner-border-sm"></span> Uploading...
                    </span>

                    {{-- Validation result --}}
                    @if($ver)
                        <div class="doc-result dr-{{ $ver['status'] }}">
                        <i class="fas fa-{{ $ver['status']==='ok' ? 'check-circle' : ($ver['status']==='warn' ? 'exclamation-triangle' : 'times-circle') }} mt-1" style="flex-shrink:0;"></i>
                        <span>{{ $ver['message'] }}</span>
                        </div>
                    @endif

                    {{-- Admin rejection note --}}
                    @if($doc && $doc->review_status === 'rejected' && $doc->rejection_reason)
                        <div class="doc-result dr-error">
                        <i class="fas fa-times-circle mt-1" style="flex-shrink:0;"></i>
                        <div><strong>Rejected:</strong> {{ $doc->rejection_reason }}</div>
                        </div>
                    @endif

                    {{-- Upload / Replace button --}}
                    <div style="display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;margin-top:.3rem;">
                        <input
                        type="file"
                        wire:model="doc_{{ $type }}"
                        id="{{ $fid }}"
                        style="display:none;"
                        accept="{{ $def['accept'] }}"
                        onchange="handleDocSelect(this, '{{ $type }}')"
                        >
                        <label for="{{ $fid }}" class="ul-btn">
                        <i class="fas fa-{{ $doc ? 'redo' : 'upload' }}"></i>
                        {{ $doc ? 'Change Document' : 'Upload Document' }}
                        </label>
                    </div>

                    @error('doc_'.$type)
                        <small class="text-danger d-block mt-2">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </small>
                    @enderror

                    </div>
                </div>
                @endforeach
            </div>

            {{-- JS: preview selected file immediately, then show spinner --}}
            <script>
                function handleDocSelect(input, type) {
                if (!input.files || !input.files[0]) return;
                var file = input.files[0];
                var ext  = file.name.split('.').pop().toLowerCase();

                // Show spinner
                var spinner = document.getElementById('sp_' + type);
                if (spinner) spinner.style.display = 'flex';

                // Hide server-rendered preview (will be replaced after Livewire re-render)
                var serverPrev = document.getElementById('prev_' + type);
                if (serverPrev) serverPrev.style.display = 'none';

                // Show local preview
                var localPrev = document.getElementById('local_prev_' + type);
                var localTop  = document.getElementById('local_prev_top_' + type);
                var localName = document.getElementById('local_prev_name_' + type);
                var localSize = document.getElementById('local_prev_size_' + type);

                if (!localPrev) return;

                // File name
                if (localName) localName.querySelector('span').textContent = file.name;

                // File size
                var sizeKb = (file.size / 1024).toFixed(0);
                if (localSize) localSize.textContent = sizeKb + ' KB';

                // Preview content based on type
                if (localTop) {
                    if (['jpg','jpeg','png','webp','gif'].includes(ext)) {
                    // Image: show actual thumbnail
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        localTop.innerHTML =
                        '<img src="' + e.target.result + '" style="max-height:90px;max-width:100%;border-radius:6px;object-fit:cover;box-shadow:0 2px 8px rgba(0,0,0,.1);">' ;
                    };
                    reader.readAsDataURL(file);
                    } else if (ext === 'pdf') {
                    localTop.innerHTML =
                        '<div class="file-preview-icon" style="color:#e02424;"><i class="fas fa-file-pdf"></i></div>' +
                        '<div class="file-preview-label">PDF DOCUMENT</div>';
                    } else if (['doc','docx'].includes(ext)) {
                    localTop.innerHTML =
                        '<div class="file-preview-icon" style="color:#1a56db;"><i class="fas fa-file-word"></i></div>' +
                        '<div class="file-preview-label">WORD DOCUMENT</div>';
                    } else {
                    localTop.innerHTML =
                        '<div class="file-preview-icon" style="color:#6b7280;"><i class="fas fa-file-alt"></i></div>' +
                        '<div class="file-preview-label">DOCUMENT</div>';
                    }
                }

                localPrev.style.display = 'block';

                // Safety: hide spinner after 30s if Livewire stalls
                setTimeout(function() {
                    if (spinner) spinner.style.display = 'none';
                }, 30000);
                }

                // Hide all spinners and local previews when Livewire re-renders
                // (server-side preview will now show instead)
                document.addEventListener('livewire:update', function() {
                document.querySelectorAll('.doc-uploading').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('[id^="local_prev_"]').forEach(function(el) {
                    // Only hide the top-level local preview divs, not sub-elements
                    if (el.id.split('_').length === 3) el.style.display = 'none';
                });
                });
            </script>

            <div style="background:var(--blt);border-radius:10px;padding:.65rem 1rem;font-size:.8rem;color:#1e40af;margin-top:.8rem;display:flex;align-items:center;gap:.6rem;">
                <i class="fas fa-shield-alt"></i>
                Documents stored securely on our servers · Reviewed by our team within 24–48 hours
            </div>

            <div class="sfooter">
                <button type="button" class="btn-o" wire:click="goToStep(3)">
                <i class="fas fa-arrow-left"></i> Back
                </button>
                <button type="button" class="btn-p" wire:click="saveStep4" wire:loading.attr="disabled">
                <span wire:loading wire:target="saveStep4" class="spinner-border spinner-border-sm me-1"></span>
                Continue <i class="fas fa-arrow-right" wire:loading.remove wire:target="saveStep4"></i>
                </button>
            </div>

            {{-- ── STEP 5: PLAN (LAST) ── --}}
            @elseif($activeStep===5)
              <div class="stitle">Choose your plan</div>
              <div class="ssub">You can upgrade or change anytime after registration</div>
              <div class="plan-grid">
                <div class="plan-card {{ $selected_plan==='free'?'sel':'' }}" wire:click="$set('selected_plan','free')">
                  <div class="pname">Free</div>
                  <div class="pprice">$0<span>/forever</span></div>
                  <ul class="pfeat">
                    <li><i class="fas fa-check-circle"></i> Up to 10 products</li>
                    <li><i class="fas fa-check-circle"></i> Receive buyer inquiries</li>
                    <li><i class="fas fa-check-circle"></i> Basic company profile</li>
                  </ul>
                </div>
                <div class="plan-card {{ $selected_plan==='growth'?'sel':'' }}" wire:click="$set('selected_plan','growth')">
                  <span class="pop-badge">Popular</span>
                  <div class="pname">Growth</div>
                  <div class="pprice">$49<span>/month</span></div>
                  <ul class="pfeat">
                    <li><i class="fas fa-check-circle"></i> Up to 100 products</li>
                    <li><i class="fas fa-check-circle"></i> Verified seller badge</li>
                    <li><i class="fas fa-check-circle"></i> RFQ priority</li>
                    <li><i class="fas fa-check-circle"></i> Analytics dashboard</li>
                  </ul>
                </div>
                <div class="plan-card {{ $selected_plan==='global'?'sel':'' }}" wire:click="$set('selected_plan','global')">
                  <div class="pname">Global</div>
                  <div class="pprice">$199<span>/month</span></div>
                  <ul class="pfeat">
                    <li><i class="fas fa-check-circle"></i> Unlimited products</li>
                    <li><i class="fas fa-check-circle"></i> Global promotion</li>
                    <li><i class="fas fa-check-circle"></i> AI buyer matching</li>
                    <li><i class="fas fa-check-circle"></i> Premium supplier badge</li>
                  </ul>
                </div>
              </div>

              @if($selected_plan && $selected_plan !== 'free')
                <div class="gp-info" style="background:#f0fdf9;color:#065f46;border-color:var(--green);">
                  <i class="fas fa-info-circle"></i>
                  <span>
                    <strong>{{ ucfirst($selected_plan) }} Plan selected.</strong>
                    Payment will be collected after your account is approved.
                    You can start listing products on the Free plan immediately.
                  </span>
                </div>
              @endif

              <div class="sfooter">
                <button type="button" class="btn-o" wire:click="goToStep(4)"><i class="fas fa-arrow-left"></i> Back</button>
                <button type="button" class="btn-p" wire:click="saveStep5" wire:loading.attr="disabled">
                  <span wire:loading wire:target="saveStep5" class="spinner-border spinner-border-sm me-1"></span>
                  <span wire:loading.remove wire:target="saveStep5">
                    <i class="fas fa-paper-plane me-1"></i> Submit for Review
                  </span>
                </button>
              </div>
            @endif

          </div>{{-- gpc --}}
        </div>{{-- right col --}}
      </div>{{-- grid --}}
    </div>
    </main>
    <livewire:seller.layout.footer />
</div>