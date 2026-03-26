<div>

<livewire:front.layout.header />
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

<!-- ================= SIDEBAR ================= -->

<div>
<div class="gpc text-center">

<div class="av-wrap">

<span class="text-body-tertiary avatar avatar-xl" style="height:80px;width:80px;">

    <span class="d-flex align-items-center justify-content-center rounded-circle bg-white shadow border"
          style="height:80px;width:80px; font-weight:600; font-size:34px; color:#111827;">
        
        {{ strtoupper(substr($full_name ?? 'U', 0, 1)) }}
    
    </span>

</span>
</div>

<div class="sname">{{ $full_name }}</div>
<div class="semail">{{ $email }}</div>

<div class="sbadge ba">
<i class="fas fa-user"></i> Buyer Account
</div>

</div>
</div>


<!-- ================= MAIN ================= -->

<div>

<div class="gpc">

@if(session()->has('success'))
<div class="gp-ok">
<i class="fas fa-check-circle"></i>
{{ session('success') }}
</div>
@endif


<!-- STEP NAVIGATION -->

<div class="step-nav">

<button class="step-btn {{ $activeStep==1?'active':'' }}"
wire:click="goToStep(1)">

<span class="step-num">1</span>
Basic Info

</button>
<button class="step-btn {{ $activeStep==2?'active':'' }}" wire:click="goToStep(2)">
<span class="step-num">2</span>
Location
</button>

<button class="step-btn {{ $activeStep==3?'active':'' }}" wire:click="goToStep(3)">
<span class="step-num">3</span>
Preferences
</button>

</div>


{{-- STEP 1 --}}

@if($activeStep==1)

<div class="stitle">Basic Information</div>

<div class="row">

<div class="col-md-6 fg">
<label>Full Name</label>
<input class="form-control" wire:model="full_name">
@error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="col-md-6 fg">
<label>Email</label>
<input class="form-control" value="{{ $email }}" disabled>
</div>

<div class="col-md-6 fg">
<label>Phone</label>
<input class="form-control" wire:model="phone">
@error('phone') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="col-md-6 fg">
<label>Company</label>
<input class="form-control" wire:model="company_name">
@error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

</div>

<div class="sfooter">

<button class="btn-p" wire:click="saveStep1">
Continue
</button>

</div>

@endif


{{-- STEP 2 --}}

@if($activeStep==2)

<div class="stitle">Location Details</div>

<div class="row">

<div class="col-md-4 fg">
<label>City</label>
<input class="form-control" wire:model="city">
@error('city') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="col-md-4 fg">
<label>State</label>
<input class="form-control" wire:model="state">
</div>

<div class="col-md-4 fg">
<label>Country</label>
<input class="form-control" wire:model="country">
</div>

</div>

<div class="sfooter">

<button class="btn-o" wire:click="goToStep(1)">
Back
</button>

<button class="btn-p" wire:click="saveStep2">
Continue
</button>

</div>

@endif



{{-- STEP 3 --}}

@if($activeStep==3)

<div class="stitle">Buying Preferences</div>

<div class="row">

<div class="col-md-6 fg">
<label>Interested Products</label>
<input class="form-control" wire:model="interested_products">
</div>

<div class="col-md-6 fg">
<label>Import Volume</label>
<input class="form-control" wire:model="import_volume">
</div>

</div>

<div class="sfooter">

<button class="btn-o" wire:click="goToStep(2)">
Back
</button>

<button class="btn-p" wire:click="saveStep3">
Save Profile
</button>

</div>

@endif


</div>

</div>

</div>

</div>

<livewire:front.layout.footer />

</div>