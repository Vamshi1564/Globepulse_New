{{-- FILE: resources/views/livewire/seller/service-add.blade.php --}}
<div>
<livewire:seller.layout.header />
<style>
/* ── Reuse product-add's pa- prefix for consistency ── */
.pa-wrap{max-width:1200px;margin:0 auto;padding:1.5rem;}
.pa-stepbar{background:#fff;border-radius:14px;padding:1.25rem 1.5rem;margin-bottom:1.5rem;border:1px solid #e5e9f2;box-shadow:0 1px 6px rgba(0,0,0,.04);}
.pa-steps{display:flex;align-items:center;gap:0;}
.pa-step{flex:1;display:flex;flex-direction:column;align-items:center;gap:.35rem;position:relative;}
.pa-step::after{content:'';position:absolute;top:18px;left:50%;width:100%;height:2px;background:#e2e8f0;z-index:0;}
.pa-step:last-child::after{display:none;}
.pa-step-num{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:800;z-index:1;border:2px solid #e2e8f0;background:#fff;color:#94a3b8;transition:all .2s;}
.pa-step.active .pa-step-num{background:#1d4ed8;border-color:#1d4ed8;color:#fff;}
.pa-step.done .pa-step-num{background:#059669;border-color:#059669;color:#fff;}
.pa-step-lbl{font-size:.72rem;font-weight:600;color:#94a3b8;text-align:center;white-space:nowrap;}
.pa-step.active .pa-step-lbl{color:#1d4ed8;font-weight:700;}
.pa-step.done .pa-step-lbl{color:#059669;}

.pa-body{display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;}
@media(max-width:900px){.pa-body{grid-template-columns:1fr;}}

.pa-card{background:#fff;border-radius:14px;border:1px solid #e5e9f2;box-shadow:0 1px 6px rgba(0,0,0,.04);overflow:hidden;}
.pa-card-hd{padding:1rem 1.25rem;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:.6rem;}
.pa-card-hd-icon{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;}
.pa-card-hd h3{font-size:.95rem;font-weight:800;color:#1e293b;margin:0;}
.pa-card-hd p{font-size:.74rem;color:#94a3b8;margin:0;}
.pa-card-body{padding:1.25rem;}

.pa-label{display:block;font-size:.75rem;font-weight:700;color:#374151;margin-bottom:.3rem;text-transform:uppercase;letter-spacing:.03em;}
.pa-input,.pa-select,.pa-textarea{width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:.5rem .85rem;font-size:.88rem;color:#1e293b;background:#fff;outline:none;transition:border .2s,box-shadow .2s;}
.pa-input:focus,.pa-select:focus,.pa-textarea:focus{border-color:#1d4ed8;box-shadow:0 0 0 3px rgba(29,78,216,.08);}
.pa-hint{font-size:.72rem;color:#94a3b8;margin-top:.25rem;}
.pa-err{font-size:.75rem;color:#dc2626;margin-top:.25rem;}
.pa-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
@media(max-width:600px){.pa-row{grid-template-columns:1fr;}}

/* Editor */
.editor-toolbar{display:flex;flex-wrap:wrap;gap:4px;padding:8px;background:#f1f5f9;border:1.5px solid #e2e8f0;border-radius:10px 10px 0 0;border-bottom:none;}
.editor-toolbar button,.editor-toolbar select{border:1px solid #e2e8f0;background:#fff;border-radius:6px;padding:3px 8px;font-size:.75rem;cursor:pointer;color:#374151;}
.editor-toolbar button:hover{background:#e8f0fe;border-color:#1d4ed8;color:#1d4ed8;}
.editor-content{border:1.5px solid #e2e8f0;border-radius:0 0 10px 10px;min-height:160px;padding:12px 14px;font-size:.88rem;outline:none;color:#1e293b;}
.editor-content:focus{border-color:#1d4ed8;}

/* Media uploads */
.photo-grid{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:.5rem;}
.photo-slot{width:80px;height:80px;border:2px dashed #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer;background:#f8fafc;font-size:1.2rem;transition:all .15s;position:relative;}
.photo-slot:hover{border-color:#1d4ed8;background:#e8f0fe;}
.photo-slot img{width:100%;height:100%;object-fit:cover;border-radius:8px;}
.photo-slot .remove-btn{position:absolute;top:-6px;right:-6px;width:18px;height:18px;background:#ef4444;border-radius:50%;color:#fff;font-size:.65rem;display:flex;align-items:center;justify-content:center;cursor:pointer;border:none;}
.upload-hint{font-size:.72rem;color:#94a3b8;margin-top:.25rem;}

/* Spec radio/checkbox */
.spec-grid{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.4rem;}
.spec-chip{padding:.35rem .85rem;border-radius:20px;border:1.5px solid #e2e8f0;font-size:.78rem;font-weight:600;cursor:pointer;transition:all .15s;background:#f8fafc;color:#475569;}
.spec-chip:hover{border-color:#1d4ed8;color:#1d4ed8;background:#e8f0fe;}
.spec-chip.sel{background:#1d4ed8;color:#fff;border-color:#1d4ed8;}
.spec-chip.sel-green{background:#059669;color:#fff;border-color:#059669;}

/* Bottom actions */
.pa-actions{display:flex;gap:.75rem;align-items:center;padding-top:1.25rem;border-top:1px solid #f1f5f9;margin-top:1.25rem;flex-wrap:wrap;}
.btn-next{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.5rem;border-radius:10px;font-size:.88rem;font-weight:700;background:#1d4ed8;color:#fff;border:none;cursor:pointer;transition:background .15s;}
.btn-next:hover{background:#1e40af;}
.btn-back{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.88rem;font-weight:700;background:#f1f5f9;color:#374151;border:1px solid #e2e8f0;cursor:pointer;}
.btn-back:hover{background:#e2e8f0;}
.btn-draft{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.88rem;font-weight:700;background:#fff;color:#64748b;border:1.5px solid #e2e8f0;cursor:pointer;transition:all .15s;}
.btn-draft:hover{border-color:#64748b;color:#1e293b;}
.btn-publish{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.5rem;border-radius:10px;font-size:.88rem;font-weight:700;background:linear-gradient(135deg,#059669,#0d9488);color:#fff;border:none;cursor:pointer;}
.btn-publish:hover{opacity:.9;}
.btn-publish:disabled{opacity:.6;cursor:not-allowed;}

/* Preview panel */
.pa-preview{background:#fff;border-radius:14px;border:1px solid #e5e9f2;padding:1.25rem;position:sticky;top:80px;}
.preview-img{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:2rem;color:#cbd5e1;}
.preview-title{font-size:1.05rem;font-weight:800;color:#1e293b;margin:.85rem 0 .3rem;}
.preview-price{font-size:1.1rem;font-weight:800;color:#059669;}
.preview-badge{display:inline-flex;align-items:center;gap:.3rem;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:700;background:#dbeafe;color:#1e40af;margin-bottom:.5rem;}
.preview-meta{font-size:.78rem;color:#64748b;margin-top:.3rem;}

/* Toast */
.pa-toast{position:fixed;top:20px;right:20px;z-index:99999;min-width:300px;max-width:420px;padding:14px 20px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.15);display:flex;align-items:center;gap:10px;font-size:.88rem;font-weight:600;animation:slideIn .3s ease;}
.pa-toast.success{background:#059669;color:#fff;}
.pa-toast.error{background:#dc2626;color:#fff;}
@keyframes slideIn{from{opacity:0;transform:translateX(40px)}to{opacity:1;transform:translateX(0)}}
</style>

{{-- Toast --}}
@if($alertMessage)
<div class="pa-toast {{ $alertType }}" id="sa-toast">
    <i class="bi bi-{{ $alertType === 'success' ? 'check-circle-fill' : 'x-circle-fill' }}" style="font-size:1.1rem;flex-shrink:0;"></i>
    <span>{{ $alertMessage }}</span>
    <button onclick="document.getElementById('sa-toast').remove()" style="margin-left:auto;background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;">×</button>
</div>
<script>setTimeout(function(){var t=document.getElementById('sa-toast');if(t)t.remove();},5000);</script>
@endif

@if(session('message'))
<div class="pa-toast success" id="sa-flash">
    <i class="bi bi-check-circle-fill" style="font-size:1.1rem;"></i>
    <span>{{ session('message') }}</span>
    <button onclick="document.getElementById('sa-flash').remove()" style="margin-left:auto;background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;">×</button>
</div>
<script>setTimeout(function(){var t=document.getElementById('sa-flash');if(t)t.remove();},5000);</script>
@endif

<div class="pa-wrap">

    {{-- Page header --}}
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;flex-wrap:wrap;gap:.75rem;">
        <div>
            <h1 style="font-size:1.35rem;font-weight:800;color:#1e293b;margin:0;">
                {{ $isEditMode ? 'Edit Service' : 'Add New Service' }}
            </h1>
            <p style="font-size:.82rem;color:#94a3b8;margin:.2rem 0 0;">
                {{ $isEditMode ? 'Update your service details below' : 'List your service — approved services are visible to buyers worldwide' }}
            </p>
        </div>
        <a href="{{ route('my-listings') }}" style="font-size:.82rem;color:#64748b;text-decoration:none;display:flex;align-items:center;gap:.3rem;padding:.4rem .9rem;border:1.5px solid #e2e8f0;border-radius:9px;background:#f8fafc;font-weight:600;">
            <i class="bi bi-arrow-left-short"></i> My Listings
        </a>
    </div>

    {{-- Step bar --}}
    <div class="pa-stepbar">
        <div class="pa-steps" style="align-items:center;">
            @if($isEditMode)
            <div style="font-size:.75rem;font-weight:700;color:#059669;padding:.35rem 1rem;background:#d1fae5;border-radius:20px;white-space:nowrap;margin-right:.75rem;display:flex;align-items:center;gap:.35rem;flex-shrink:0;">
                <i class="bi bi-pencil-square"></i> Editing Service
            </div>
            @endif
            @foreach([1=>['bi-tag-fill','Basic Info'],2=>['bi-images','Media'],3=>['bi-currency-exchange','Pricing'],4=>['bi-patch-check','Specs']] as $n=>[$icon,$lbl])
            <div class="pa-step {{ $activeStep==$n ? 'active' : ($activeStep>$n ? 'done' : 'pending') }}"
                 wire:click.prevent="goToStep({{ $n }})" style="cursor:pointer;">
                <div class="pa-step-num">
                    @if($activeStep > $n)<i class="bi bi-check-lg" style="font-size:.72rem;"></i>
                    @else {{ $n }} @endif
                </div>
                <span class="pa-step-lbl"><i class="bi {{ $icon }}" style="font-size:.7rem;"></i> {{ $lbl }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Body --}}
    <div class="pa-body">

        {{-- ── LEFT: Form ──────────────────────────────────── --}}
        <div>

        {{-- ════ STEP 1: Basic Info ════ --}}
        @if($activeStep == 1)
        <div class="pa-card">
            <div class="pa-card-hd">
                <div class="pa-card-hd-icon" style="background:#ede9fe;"><i class="bi bi-tag-fill" style="color:#7c3aed;"></i></div>
                <div><h3>Basic Information</h3><p>Service name, description and keywords</p></div>
            </div>
            <div class="pa-card-body">
                <div style="margin-bottom:1rem;">
                    <label class="pa-label">Service Name *</label>
                    <input class="pa-input" wire:model="title" placeholder="e.g. Digital Marketing, Web Development, SEO Services">
                    @error('title')<div class="pa-err">{{ $message }}</div>@enderror
                    <div class="pa-hint">Be specific — buyers search by service name</div>
                </div>

                <div style="margin-bottom:1rem;">
                    <label class="pa-label">Description</label>
                    {{-- wire:ignore prevents Livewire wiping contenteditable on re-render --}}
                    <div wire:ignore>
                        <div class="editor-toolbar">
                            <button type="button" onclick="sfmt('bold')" title="Bold"><b>B</b></button>
                            <button type="button" onclick="sfmt('italic')" title="Italic"><i>I</i></button>
                            <button type="button" onclick="sfmt('underline')" title="Underline"><u>U</u></button>
                            <button type="button" onclick="sfmt('insertUnorderedList')" title="List">• List</button>
                            <select onchange="if(this.value){document.execCommand('formatBlock',false,this.value);this.value=''}"
                                style="font-size:.75rem;">
                                <option value="">Format</option>
                                <option value="h3">Heading</option>
                                <option value="p">Paragraph</option>
                            </select>
                        </div>
                        <div id="sa-editor" class="editor-content" contenteditable="true"
                            data-initial="{{ htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8') }}"
                            placeholder="Describe your service in detail..."></div>
                    </div>
                    {{-- Hidden input OUTSIDE wire:ignore so Livewire CAN read it --}}
                    <input type="hidden" id="sa-desc-hidden" wire:model="description">
                    @error('description')<div class="pa-err">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="pa-label">Keywords</label>
                    <input class="pa-input" wire:model="keywords" placeholder="SEO, digital marketing, social media (comma separated)">
                    <div class="pa-hint">Helps buyers find your service</div>
                </div>

                <div class="pa-actions">
                    <!-- <button class="btn-draft" type="button" wire:click="saveDraft">
                        <i class="bi bi-floppy"></i> Save Draft
                    </button> -->
                    <button class="btn-next" type="button" wire:loading.attr="disabled" wire:target="nextStep"
                        wire:click="nextStep"
                        onclick="saSync()">
                        Next: Media <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        {{-- ════ STEP 2: Media ════ --}}
        @if($activeStep == 2)
        <div class="pa-card">
            <div class="pa-card-hd">
                <div class="pa-card-hd-icon" style="background:#fce7f3;"><i class="bi bi-images" style="color:#be185d;"></i></div>
                <div><h3>Photos, Video & Documents</h3><p>Cover image · Gallery (max 9) · Video URL · PDF Brochure</p></div>
            </div>
            <div class="pa-card-body">

                {{-- Cover image --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="pa-label">Cover Image</label>
                    <div class="photo-grid">
                        @if($cover_image)
                        {{-- Newly selected file --}}
                        <label for="coverImg" class="photo-slot" style="width:120px;height:90px;border-style:solid;border-color:#059669;">
                            <img src="{{ $cover_image->temporaryUrl() }}" style="border-radius:8px;width:100%;height:100%;object-fit:cover;">
                        </label>
                        @elseif($isEditMode && !empty($existingCoverImage))
                        {{-- Saved cover image in edit mode --}}
                        @php
                            $covUrl = str_starts_with($existingCoverImage,'http')
                                ? $existingCoverImage
                                : (config('app.pub_aws_url')
                                    ? rtrim(config('app.pub_aws_url'),'/') . '/' . $existingCoverImage
                                    : asset('storage/' . $existingCoverImage));
                        @endphp
                        <div style="position:relative;">
                            <label for="coverImg" class="photo-slot" style="width:120px;height:90px;border-style:solid;border-color:#059669;">
                                <img src="{{ $covUrl }}" style="border-radius:8px;width:100%;height:100%;object-fit:cover;"
                                    onerror="this.parentElement.innerHTML='<div style=\'text-align:center;color:#94a3b8;\'><i class=\'bi bi-image\' style=\'font-size:1.4rem;display:block;\'></i><span style=\'font-size:.68rem;\'>Cover</span></div>'">
                            </label>
                            <div style="font-size:.65rem;color:#059669;font-weight:700;margin-top:.25rem;text-align:center;">Saved ✓</div>
                        </div>
                        @else
                        <label for="coverImg" class="photo-slot" style="width:120px;height:90px;">
                            <div style="text-align:center;color:#94a3b8;">
                                <i class="bi bi-cloud-upload" style="font-size:1.4rem;display:block;"></i>
                                <span style="font-size:.68rem;">Cover</span>
                            </div>
                        </label>
                        @endif
                    </div>
                    <input type="file" id="coverImg" class="d-none" wire:model="cover_image" accept="image/jpg,image/jpeg,image/png,image/webp">
                    <div class="upload-hint">JPG, PNG, WebP · Max 4MB
                        @if($isEditMode && $existingCoverImage) · Upload new to replace @endif
                    </div>
                    @error('cover_image')<div class="pa-err">{{ $message }}</div>@enderror
                </div>

                {{-- Gallery --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="pa-label">Portfolio / Gallery Images <span style="color:#94a3b8;">(up to 9)</span></label>
                    <div class="photo-grid">
                        @foreach($gallery_images as $idx => $gi)
                        <div class="photo-slot" style="width:80px;height:80px;">
                            @if(is_string($gi))
                                {{-- Saved path in edit mode --}}
                                @php
                                    $giUrl = str_starts_with($gi,'http') ? $gi
                                        : (config('app.pub_aws_url')
                                            ? rtrim(config('app.pub_aws_url'),'/') . '/' . $gi
                                            : asset('storage/' . $gi));
                                @endphp
                                <img src="{{ $giUrl }}" style="border-radius:8px;width:100%;height:100%;object-fit:cover;">
                            @else
                                {{-- New upload --}}
                                <img src="{{ $gi->temporaryUrl() }}" style="border-radius:8px;width:100%;height:100%;object-fit:cover;">
                            @endif
                            <button class="remove-btn" type="button" wire:click="removeGalleryImage({{ $idx }})">×</button>
                        </div>
                        @endforeach
                        @if(count($gallery_images) < 9)
                        <label for="galleryImgs" class="photo-slot" style="width:80px;height:80px;">
                            <div style="text-align:center;color:#94a3b8;">
                                <i class="bi bi-plus-lg" style="font-size:1.4rem;display:block;"></i>
                                <span style="font-size:.68rem;">Add</span>
                            </div>
                        </label>
                        @endif
                    </div>
                    <input type="file" id="galleryImgs" class="d-none" wire:model="new_gallery_images" multiple accept="image/jpg,image/jpeg,image/png,image/webp">
                    <div class="upload-hint">JPG, PNG, WebP · Max 4MB each · Up to 9 images</div>
                    <div wire:loading wire:target="new_gallery_images" style="font-size:.78rem;color:#1d4ed8;">
                        <i class="bi bi-arrow-repeat"></i> Uploading images...
                    </div>
                </div>

                {{-- Video URL --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="pa-label">Service / Demo Video URL</label>
                    <input class="pa-input" wire:model.lazy="video_url" placeholder="https://youtube.com/watch?v=...  or  https://vimeo.com/...">
                    @error('video_url')<div class="pa-err">{{ $message }}</div>@enderror
                    @if($video_url)
                    <div style="margin-top:.5rem;font-size:.78rem;color:#059669;">
                        <i class="bi bi-check-circle"></i> Video URL added
                        <a href="{{ $video_url }}" target="_blank" style="margin-left:.5rem;color:#1d4ed8;">Preview ↗</a>
                    </div>
                    @endif
                    <div class="pa-hint">YouTube or Vimeo link — shows buyers a demo of your work</div>
                </div>

                {{-- PDF Brochure --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="pa-label">Service Brochure / Portfolio PDF</label>
                    <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;">
                        <label for="pdfUpload" style="display:inline-flex;align-items:center;gap:.4rem;padding:.45rem 1rem;border-radius:9px;border:1.5px solid #e2e8f0;background:#f8fafc;font-size:.82rem;font-weight:600;cursor:pointer;color:#475569;transition:all .15s;"
                            onmouseover="this.style.borderColor='#1d4ed8';this.style.color='#1d4ed8'"
                            onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569'">
                            <i class="bi bi-file-earmark-pdf" style="color:#ef4444;"></i>
                            {{ $brochure_pdf ? 'Replace PDF' : ($isEditMode && $existingBrochurePath ? 'Replace PDF' : 'Upload PDF') }}
                        </label>

                        @if($brochure_pdf)
                        {{-- Newly selected PDF --}}
                        <span style="font-size:.78rem;color:#059669;display:flex;align-items:center;gap:.3rem;">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ $brochure_pdf->getClientOriginalName() }}
                            <span style="color:#94a3b8;">({{ round($brochure_pdf->getSize() / 1024) }} KB)</span>
                        </span>
                        @elseif($isEditMode && !empty($existingBrochurePath))
                        {{-- Saved PDF in edit mode --}}
                        @php
                            $pdfUrl = str_starts_with($existingBrochurePath,'http')
                                ? $existingBrochurePath
                                : (config('app.pub_aws_url')
                                    ? rtrim(config('app.pub_aws_url'),'/') . '/' . $existingBrochurePath
                                    : asset('storage/' . $existingBrochurePath));
                        @endphp
                        <span style="font-size:.78rem;color:#059669;display:flex;align-items:center;gap:.3rem;">
                            <i class="bi bi-file-earmark-pdf-fill" style="color:#ef4444;"></i>
                            PDF uploaded
                            <a href="{{ $pdfUrl }}" target="_blank" style="color:#1d4ed8;font-weight:700;">View ↗</a>
                        </span>
                        @endif
                    </div>
                    <input type="file" id="pdfUpload" class="d-none" wire:model="brochure_pdf" accept=".pdf,application/pdf">
                    <div class="upload-hint">PDF only · Max 10MB</div>
                    <div wire:loading wire:target="brochure_pdf" style="font-size:.78rem;color:#1d4ed8;margin-top:.3rem;">
                        <i class="bi bi-arrow-repeat"></i> Uploading PDF...
                    </div>
                    @error('brochure_pdf')<div class="pa-err">{{ $message }}</div>@enderror
                </div>

                <div class="pa-actions">
                    <button class="btn-back" type="button" wire:click="prevStep" onclick="saSync()">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                    <!-- <button class="btn-draft" type="button" wire:click="saveDraft">
                        <i class="bi bi-floppy"></i> Save Draft
                    </button> -->
                    <button class="btn-next" type="button" wire:loading.attr="disabled" wire:target="nextStep"
                        wire:click="nextStep"
                        onclick="saSync()">
                        Next: Pricing <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        {{-- ════ STEP 3: Pricing ════ --}}
        @if($activeStep == 3)
        <div class="pa-card">
            <div class="pa-card-hd">
                <div class="pa-card-hd-icon" style="background:#fef3c7;"><i class="bi bi-currency-exchange" style="color:#d97706;"></i></div>
                <div><h3>Pricing & Delivery</h3><p>Price, delivery mode and turnaround time</p></div>
            </div>
            <div class="pa-card-body">

                <div class="pa-row" style="margin-bottom:1rem;">
                    <div>
                        <label class="pa-label">Starting Price (₹)</label>
                        <input class="pa-input" wire:model.lazy="price" type="number" min="0" placeholder="e.g. 5000">
                        @error('price')<div class="pa-err">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="pa-label">Price Unit</label>
                        <select class="pa-select" wire:model.lazy="price_unit">
                            <option value="per project">Per Project</option>
                            <option value="per hour">Per Hour</option>
                            <option value="per month">Per Month</option>
                            <option value="per day">Per Day</option>
                            <option value="custom">Custom / Negotiable</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:1rem;">
                    <label class="pa-label">Pricing Model</label>
                    <div class="spec-grid">
                        @foreach(['Monthly Retainer','Project Based','Hourly','Performance Based','Quote Based','Other'] as $opt)
                        <button type="button"
                            class="spec-chip {{ $pricing_model === $opt ? 'sel' : '' }}"
                            wire:click="$set('pricing_model','{{ $opt }}')">{{ $opt }}</button>
                        @endforeach
                    </div>
                </div>

                <div style="margin-bottom:1rem;">
                    <label class="pa-label">Delivery Mode</label>
                    <div class="spec-grid">
                        @foreach(['Remote','Onsite','Both'] as $opt)
                        <button type="button"
                            class="spec-chip {{ $delivery_mode === $opt ? 'sel-green' : '' }}"
                            wire:click="$set('delivery_mode','{{ $opt }}')">{{ $opt }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="pa-row" style="margin-bottom:1rem;">
                    <div>
                        <label class="pa-label">Turnaround Time</label>
                        <select class="pa-select" wire:model.lazy="turnaround_time">
                            <option value="">Select</option>
                            <option value="1-3 days">1–3 Days</option>
                            <option value="3-7 days">3–7 Days</option>
                            <option value="1-2 weeks">1–2 Weeks</option>
                            <option value="2-4 weeks">2–4 Weeks</option>
                            <option value="1-2 months">1–2 Months</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Custom">Custom</option>
                        </select>
                    </div>
                    <div>
                        <label class="pa-label">Contract Duration</label>
                        <select class="pa-select" wire:model.lazy="contract_duration">
                            <option value="">Select</option>
                            <option value="1 Month">1 Month</option>
                            <option value="3 Months">3 Months</option>
                            <option value="6 Months">6 Months</option>
                            <option value="12 Months">12 Months</option>
                            <option value="Above 12 Months">Above 12 Months</option>
                            <option value="One-time">One-time</option>
                        </select>
                    </div>
                </div>

                <div class="pa-row" style="margin-bottom:1rem;">
                    <div>
                        <label class="pa-label">Service Area</label>
                        <input class="pa-input" wire:model.lazy="service_area" placeholder="e.g. Pan India, Global, Mumbai">
                    </div>
                    <div>
                        <label class="pa-label">Free Consultation</label>
                        <select class="pa-select" wire:model.lazy="sample_consultation">
                            <option value="no">No</option>
                            <option value="yes">Yes — Free 30 min call</option>
                        </select>
                    </div>
                </div>

                <div class="pa-actions">
                    <button class="btn-back" type="button" wire:click="prevStep" onclick="saSync()">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                    <!-- <button class="btn-draft" type="button" wire:click="saveDraft">
                        <i class="bi bi-floppy"></i> Save Draft
                    </button> -->
                    <button class="btn-next" type="button" wire:loading.attr="disabled" wire:target="nextStep"
                        wire:click="nextStep"
                        onclick="saSync()">
                        Next: Specs <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        {{-- ════ STEP 4: Specs & Category ════ --}}
        @if($activeStep == 4)
        <form wire:submit.prevent="submit">
        <div class="pa-card">
            <div class="pa-card-hd">
                <div class="pa-card-hd-icon" style="background:#d1fae5;"><i class="bi bi-patch-check-fill" style="color:#059669;"></i></div>
                <div><h3>Specifications & Category</h3><p>Service type, target clients, category</p></div>
            </div>
            <div class="pa-card-body">

                {{-- Category --}}
                <div style="margin-bottom:1rem;display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;">
                    <label class="pa-label" style="margin:0;white-space:nowrap;">Category</label>
                    <select class="pa-select" wire:model.live="category_id" style="max-width:200px;">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                        @endforeach
                    </select>
                    @if($category_id)
                    <select class="pa-select" wire:model.live="subcategory_id" style="max-width:200px;">
                        <option value="">Sub Category</option>
                        @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->sub_cat_name }}</option>
                        @endforeach
                    </select>
                    @endif
                </div>

                {{-- Service Type --}}
                <div style="margin-bottom:1rem;">
                    <label class="pa-label">Service Type</label>
                    <div class="spec-grid">
                        @foreach(['Full Service','Consulting Only','Implementation','Managed Service','On-Demand','Subscription','One-Time Project','Retainer','Other'] as $opt)
                        <button type="button" class="spec-chip {{ $service_type === $opt ? 'sel' : '' }}"
                            wire:click="$set('service_type','{{ $opt }}')">{{ $opt }}</button>
                        @endforeach
                    </div>
                </div>

                {{-- Target Clients --}}
                <div style="margin-bottom:1rem;">
                    <label class="pa-label">Target Client Type</label>
                    <div class="spec-grid">
                        @foreach(['Startup','SME','Large Enterprise','Agency','D2C Brand','Government','Other'] as $opt)
                        <button type="button" class="spec-chip {{ $business_type_target === $opt ? 'sel' : '' }}"
                            wire:click="$set('business_type_target','{{ $opt }}')">{{ $opt }}</button>
                        @endforeach
                    </div>
                </div>

                {{-- Experience & Certifications --}}
                <div class="pa-row" style="margin-bottom:1rem;">
                    <div>
                        <label class="pa-label">Experience (years)</label>
                        <input class="pa-input" wire:model.lazy="experience_years" type="number" min="0" placeholder="e.g. 5">
                    </div>
                    <div>
                        <label class="pa-label">Certifications</label>
                        <input class="pa-input" wire:model.lazy="certifications" placeholder="e.g. Google Certified, ISO">
                    </div>
                </div>

                <div class="pa-actions">
                    <button class="btn-back" type="button" wire:click="prevStep" onclick="saSync()">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                    <button class="btn-draft" type="button"
                        wire:click="saveDraft"
                        onclick="saSync()">
                        <i class="bi bi-floppy"></i> Save Draft
                    </button>
                    <button type="submit" class="btn-publish"
                        wire:loading.attr="disabled" wire:target="submit"
                        onclick="saSync(); this.disabled=true; this.closest('form').requestSubmit();">
                        <span wire:loading.remove wire:target="submit">
                            @if($isEditMode)
                                <i class="bi bi-check-circle-fill"></i> Save Changes
                            @else
                                <i class="bi bi-send-fill"></i> Submit for Review
                            @endif
                        </span>
                        <span wire:loading wire:target="submit">
                            <i class="bi bi-arrow-repeat me-1"></i> {{ $isEditMode ? 'Saving...' : 'Submitting...' }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
        </form>
        @endif

        </div>{{-- end left --}}

        {{-- ── RIGHT: Preview panel ────────────────────────── --}}
        <div class="pa-preview">
            <div style="font-size:.72rem;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;margin-bottom:.75rem;">
                {{ $isEditMode ? '✏️ Editing' : 'Live Preview' }}
            </div>

            {{-- Cover image: new upload > saved image > placeholder --}}
            @if($cover_image)
                <img src="{{ $cover_image->temporaryUrl() }}" class="preview-img" style="display:block;object-fit:cover;">
            @elseif($isEditMode && !empty($existingCoverImage))
                @php
                    $prevCov = str_starts_with($existingCoverImage,'http')
                        ? $existingCoverImage
                        : (config('app.pub_aws_url')
                            ? rtrim(config('app.pub_aws_url'),'/') . '/' . $existingCoverImage
                            : asset('storage/' . $existingCoverImage));
                @endphp
                <img src="{{ $prevCov }}" class="preview-img" style="display:block;object-fit:cover;"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="preview-img" style="display:none;">🛠️</div>
            @else
                <div class="preview-img" style="display:flex;">🛠️</div>
            @endif

            @if($service_type)
            <div style="margin-top:.75rem;">
                <span class="preview-badge">🛠️ {{ $service_type }}</span>
            </div>
            @endif

            <div class="preview-title">{{ $title ?: 'Your Service Name' }}</div>

            @if($price)
            <div class="preview-price">
                ₹{{ number_format((float)$price) }}
                @if($price_unit) / {{ $price_unit }}@endif
            </div>
            @endif

            @if($delivery_mode)
            <div class="preview-meta"><i class="bi bi-geo-alt"></i> {{ $delivery_mode }}</div>
            @endif
            @if($turnaround_time)
            <div class="preview-meta"><i class="bi bi-clock"></i> {{ $turnaround_time }}</div>
            @endif
            @if($experience_years)
            <div class="preview-meta"><i class="bi bi-award"></i> {{ $experience_years }} years experience</div>
            @endif

            {{-- Gallery thumbnails --}}
            @if(!empty($gallery_images))
            <div style="display:flex;gap:.35rem;flex-wrap:wrap;margin-top:.75rem;">
                @foreach($gallery_images as $gi)
                @if(is_string($gi))
                    @php
                        $giPrev = str_starts_with($gi,'http') ? $gi
                            : (config('app.pub_aws_url')
                                ? rtrim(config('app.pub_aws_url'),'/') . '/' . $gi
                                : asset('storage/' . $gi));
                    @endphp
                    <img src="{{ $giPrev }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                @else
                    <img src="{{ $gi->temporaryUrl() }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                @endif
                @endforeach
            </div>
            @endif

            {{-- Video indicator --}}
            @if($video_url)
            <div style="margin-top:.75rem;font-size:.78rem;color:#1d4ed8;display:flex;align-items:center;gap:.35rem;">
                <i class="bi bi-play-circle-fill"></i> Video demo added
            </div>
            @endif

            {{-- PDF indicator --}}
            @if($brochure_pdf)
            <div style="margin-top:.4rem;font-size:.78rem;color:#ef4444;display:flex;align-items:center;gap:.35rem;">
                <i class="bi bi-file-earmark-pdf-fill"></i> PDF brochure attached
            </div>
            @endif
        </div>

    </div>{{-- end pa-body --}}
</div>{{-- end pa-wrap --}}

<livewire:seller.layout.footer />

@script
<script>
// saSync: syncs editor HTML → hidden input → Livewire wire:model
window.saSync = function() {
    var editor = document.getElementById('sa-editor');
    var hidden  = document.getElementById('sa-desc-hidden');
    if (editor && hidden) {
        hidden.value = editor.innerHTML;
        var ev = new Event('input'); ev.bubbles = true; hidden.dispatchEvent(ev);
    }
};

function saInitEditor() {
    const editor = document.getElementById('sa-editor');
    if (!editor) return;
    if (editor._saInited) return; // prevent double init
    editor._saInited = true;

    // Read from data-initial HTML attribute
    const initial = editor.getAttribute('data-initial') || '';
    editor.innerHTML = initial;

    editor.addEventListener('input', saSync);
    editor.addEventListener('blur',  saSync);
}

// Use livewire:initialized (fires after Livewire hydrates on page load)
document.addEventListener('livewire:navigated',   saInitEditor);
document.addEventListener('livewire:initialized', saInitEditor);

// Fallback for non-SPA page loads
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', saInitEditor);
} else {
    // DOM already ready (script deferred) — init directly
    setTimeout(saInitEditor, 0);
}

// Always sync before Livewire network request
document.addEventListener('livewire:before-request', saSync);

window.sfmt = function(cmd) {
    document.execCommand('styleWithCSS', false, true);
    document.execCommand(cmd, false, null);
    const editor = document.getElementById('sa-editor');
    if (editor) { editor.focus(); saSync(); }
};
</script>
@endscript
</div>