{{-- FILE: resources/views/livewire/seller/product-add.blade.php
     Modern B2B Product Add — Original 2-col layout kept
     Left: form sections | Right: sticky live preview
     New: brand store, flexible pricing, document uploads, rich text editor --}}
<div>
<livewire:seller.layout.header />

<style>
/* ── Step bar ── */
.pa-stepbar{background:#fff;border-bottom:2px solid #e8ecf4;position:sticky;top:0;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,.04);}
.pa-steps{display:flex;overflow-x:auto;}
.pa-step{flex:1;min-width:110px;display:flex;align-items:center;justify-content:center;gap:8px;
  padding:14px 8px;cursor:pointer;border-bottom:3px solid transparent;transition:all .2s;white-space:nowrap;}
.pa-step.done {color:#059669;border-bottom-color:#10b981;}
.pa-step.active{color:#1d4ed8;border-bottom-color:#1d4ed8;background:#f0f4ff;}
.pa-step.pending{color:#94a3b8;}
.pa-step-num{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:800;flex-shrink:0;}
.pa-step.done   .pa-step-num{background:#d1fae5;color:#059669;}
.pa-step.active .pa-step-num{background:#1d4ed8;color:#fff;}
.pa-step.pending .pa-step-num{background:#f1f5f9;color:#94a3b8;}
.pa-step-lbl{font-size:.73rem;font-weight:700;}

/* ── Section card (original style) ── */
.pa-card{border:none;box-shadow:0 4px 20px rgba(0,0,0,.06);border-radius:14px;margin-bottom:1.25rem;overflow:hidden;}
.pa-card-head{padding:14px 20px;display:flex;align-items:center;gap:.5rem;color:#fff;}
.pa-card-head h5{font-size:.88rem;font-weight:800;margin:0;color:#fff;}
.pa-card-head small{font-size:.72rem;opacity:.8;display:block;margin-top:1px;}
.pa-card-body{padding:20px;background:#f8f9fb;}

/* ── Fields ── */
.pa-label{font-size:.78rem;font-weight:700;color:#374151;margin-bottom:5px;display:block;}
.pa-input,.pa-select,.pa-textarea{border:1.5px solid #e2e8f0;border-radius:10px;padding:.5rem .85rem;
  font-size:.85rem;width:100%;outline:none;transition:border .2s,box-shadow .2s;background:#fff;}
.pa-input:focus,.pa-select:focus,.pa-textarea:focus{border-color:#1d4ed8;box-shadow:0 0 0 3px rgba(29,78,216,.08);}
.pa-textarea{resize:vertical;min-height:100px;}
.pa-hint{font-size:.71rem;color:#94a3b8;margin-top:3px;}
.pa-err{font-size:.75rem;color:#dc2626;margin-top:3px;font-weight:600;}
.pa-tip{background:#eff6ff;border-left:3px solid #1d4ed8;border-radius:0 10px 10px 0;
  padding:9px 14px;font-size:.78rem;color:#1e40af;margin-bottom:14px;line-height:1.6;}

/* ── Rich text editor ── */
.editor-toolbar{display:flex;flex-wrap:wrap;gap:4px;padding:8px;background:#f1f5f9;border:1.5px solid #e2e8f0;border-radius:10px 10px 0 0;border-bottom:none;}
.editor-toolbar button,.editor-toolbar select{border:1px solid #e2e8f0;background:#fff;border-radius:6px;padding:3px 8px;font-size:.75rem;cursor:pointer;color:#374151;transition:all .15s;}
.editor-toolbar button:hover{background:#e8f0fe;border-color:#1d4ed8;color:#1d4ed8;}
.editor-content{border:1.5px solid #e2e8f0;border-radius:0 0 10px 10px;min-height:180px;padding:12px 14px;
  font-size:.88rem;background:#fff;outline:none;line-height:1.7;}
.editor-content:focus{border-color:#1d4ed8;box-shadow:0 0 0 3px rgba(29,78,216,.08);}

/* ── Image upload ── */
.img-drop-zone{border:2px dashed #d1d5db;border-radius:14px;padding:28px 20px;text-align:center;
  cursor:pointer;transition:all .2s;background:#fff;}
.img-drop-zone:hover{border-color:#1d4ed8;background:#f0f4ff;}
.img-preview-main{width:100%;max-height:300px;object-fit:contain;border-radius:12px;display:block;
  background:#f8fafc;padding:12px;box-shadow:0 4px 16px rgba(0,0,0,.08);}
.gallery-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(84px,1fr));gap:8px;margin-top:10px;}
.gallery-thumb{aspect-ratio:1;border-radius:10px;overflow:hidden;border:1.5px solid #e5e9f2;background:#f8fafc;}
.gallery-thumb img{width:100%;height:100%;object-fit:cover;}

/* ── Price type pills ── */
.price-pills{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:14px;}
.price-pill{padding:7px 16px;border-radius:20px;border:1.5px solid #e2e8f0;font-size:.78rem;
  font-weight:700;cursor:pointer;transition:all .15s;background:#fff;color:#374151;}
.price-pill:hover{border-color:#1d4ed8;color:#1d4ed8;}
.price-pill.active{background:#1d4ed8;color:#fff;border-color:#1d4ed8;box-shadow:0 3px 12px rgba(29,78,216,.25);}

/* ── Document upload ── */
.doc-item{display:flex;align-items:center;gap:10px;padding:10px 14px;background:#fff;border:1.5px solid #e2e8f0;
  border-radius:10px;margin-bottom:8px;}
.doc-icon{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;}
.doc-icon.pdf{background:#fee2e2;color:#dc2626;}
.doc-icon.doc{background:#dbeafe;color:#1d4ed8;}
.doc-icon.other{background:#f3f4f6;color:#6b7280;}
.btn-doc-add{border:1.5px dashed #1d4ed8;background:#f0f4ff;color:#1d4ed8;border-radius:10px;
  padding:10px;text-align:center;cursor:pointer;transition:all .15s;font-size:.82rem;font-weight:700;}
.btn-doc-add:hover{background:#dbeafe;}

/* ── Brand field highlight ── */
.brand-wrap{position:relative;}
.brand-badge{position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:.68rem;
  background:#fef3c7;color:#92400e;padding:2px 8px;border-radius:20px;font-weight:700;}

/* ── Nav buttons ── */
.btn-prev{background:#f1f5f9;color:#374151;border:none;border-radius:10px;padding:.55rem 1.4rem;
  font-size:.85rem;font-weight:700;cursor:pointer;transition:all .15s;}
.btn-prev:hover{background:#e2e8f0;}
.btn-next{background:linear-gradient(135deg,#676592,#8a88bf);color:#fff;border:none;border-radius:10px;
  padding:.55rem 1.4rem;font-size:.85rem;font-weight:700;cursor:pointer;
  box-shadow:0 4px 14px rgba(103,101,146,.35);transition:all .15s;}
.btn-next:hover{transform:translateY(-1px);}
.btn-publish{background:linear-gradient(135deg,#676592,#8a88bf);color:#fff;border:none;border-radius:10px;
  padding:.6rem 2rem;font-size:.9rem;font-weight:800;cursor:pointer;
  box-shadow:0 4px 18px rgba(103,101,146,.4);transition:all .2s;display:flex;align-items:center;gap:.5rem;}
.btn-publish:hover{transform:translateY(-1px);box-shadow:0 6px 22px rgba(103,101,146,.5);}

/* ── Live preview card ── */
.preview-card{background:#fff;border-radius:14px;border:1px solid #e8ecf4;
  box-shadow:0 4px 20px rgba(0,0,0,.06);position:sticky;top:70px;overflow:hidden;}
.preview-img-wrap{position:relative;background:#f8fafc;}
.preview-img-wrap img{width:100%;height:200px;object-fit:contain;background:#f8fafc;padding:8px;}
.preview-live-badge{position:absolute;top:10px;right:10px;background:#1d4ed8;color:#fff;
  font-size:.68rem;font-weight:800;padding:3px 10px;border-radius:20px;}
.preview-body{padding:14px;}
.preview-price{font-size:1.05rem;font-weight:800;color:#059669;}
.preview-meta{font-size:.74rem;color:#64748b;line-height:1.7;}
.preview-brand{font-size:.72rem;background:#fef3c7;color:#92400e;padding:2px 8px;
  border-radius:20px;font-weight:700;display:inline-block;margin-bottom:6px;}

/* ── Checklist ── */
.chk-item{display:flex;align-items:center;gap:6px;font-size:.73rem;margin-bottom:4px;}
.chk-item.done{color:#059669;}
.chk-item.todo{color:#94a3b8;}

/* ── Draft button ── */
.btn-save-draft{background:#fff;color:#374151;border:1.5px solid #e2e8f0;border-radius:10px;
  padding:.6rem 1.4rem;font-size:.85rem;font-weight:700;cursor:pointer;transition:all .2s;
  display:flex;align-items:center;gap:.4rem;}
.btn-save-draft:hover{background:#f8fafc;border-color:#94a3b8;color:#0f172a;
  box-shadow:0 2px 8px rgba(0,0,0,.08);}

/* ── Alert ── */
.pa-alert{border-radius:12px;padding:13px 18px;margin-bottom:1rem;font-size:.84rem;
  font-weight:600;display:flex;align-items:center;gap:8px;}
.pa-alert.success{background:#d1fae5;border:1.5px solid #6ee7b7;color:#065f46;}
.pa-alert.error{background:#fee2e2;border:1.5px solid #fca5a5;color:#991b1b;}
</style>

{{-- Step bar --}}
<div class="pa-stepbar">
  <div class="pa-steps" style="align-items:center;">
    @if($isEditMode)
    <div style="font-size:.78rem;font-weight:700;color:#059669;padding:.4rem 1.2rem;background:#d1fae5;border-radius:20px;white-space:nowrap;margin-right:1rem;display:flex;align-items:center;gap:.4rem;">
      <i class="bi bi-pencil-square"></i> Editing Product
    </div>
    @endif
    @foreach([
      1 => ['bi-tag-fill',     'Basic Info'],
      2 => ['bi-images',       'Photos & Media'],
      3 => ['bi-currency-exchange','Pricing & Trade'],
      4 => ['bi-patch-check',  'Specs & Docs'],
    ] as $n => [$icon, $lbl])
    <div class="pa-step {{ $activeStep==$n ? 'active' : ($activeStep>$n ? 'done' : 'pending') }}"
         wire:click.prevent="goToStep({{ $n }})" style="cursor:pointer;">
      <div class="pa-step-num">
        @if($activeStep > $n) <i class="bi bi-check-lg" style="font-size:.72rem;"></i>
        @else {{ $n }}
        @endif
      </div>
      <span class="pa-step-lbl"><i class="bi {{ $icon }} me-1"></i>{{ $lbl }}</span>
    </div>
    @endforeach
  </div>
</div>

<div class="container-fluid px-3 py-3">

  @if(session('message'))
  <div id="pa-toast-s" style="position:fixed;top:20px;right:20px;z-index:99999;background:#059669;color:#fff;padding:14px 20px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.15);display:flex;align-items:center;gap:10px;font-size:.88rem;font-weight:600;min-width:300px;max-width:420px;animation:slideIn .3s ease;">
    <i class="bi bi-check-circle-fill" style="font-size:1.1rem;"></i>
    <span>{{ session('message') }}</span>
    <button onclick="this.closest('#pa-toast-s').remove()" style="margin-left:auto;background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;">×</button>
  </div>
  <script>setTimeout(function(){var t=document.getElementById('pa-toast-s');if(t)t.remove();},5000);</script>
  @endif
  @if(session('error'))
  <div id="pa-toast-e" style="position:fixed;top:20px;right:20px;z-index:99999;background:#dc2626;color:#fff;padding:14px 20px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.15);display:flex;align-items:center;gap:10px;font-size:.88rem;font-weight:600;min-width:300px;max-width:420px;animation:slideIn .3s ease;">
    <i class="bi bi-x-circle-fill" style="font-size:1.1rem;"></i>
    <span>{{ session('error') }}</span>
    <button onclick="this.closest('#pa-toast-e').remove()" style="margin-left:auto;background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;">×</button>
  </div>
  <script>setTimeout(function(){var t=document.getElementById('pa-toast-e');if(t)t.remove();},6000);</script>
  @endif

  <form id="productForm" wire:submit.prevent="submit">
  <div class="row g-4">

    {{-- ══ LEFT: Form ══ --}}
    <div class="col-lg-8">

      {{-- ── STEP 1: Basic Info ── --}}
      @if($activeStep == 1)

      {{-- Product Details --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#676592,#8a88bf);">
          <i class="bi bi-box-seam fs-5"></i>
          <div><h5>Product Details</h5><small>Basic product information</small></div>
        </div>
        <div class="pa-card-body">

          <div class="mb-3">
            <label class="pa-label">Product Title *</label>
            <input class="pa-input"
              wire:model="title"
              placeholder="e.g. Stainless Steel Insulated Water Bottle 1L — BPA Free">
            <div class="pa-hint">Be specific. Include material, size, key feature.</div>
            @error('title')<div class="pa-err">{{ $message }}</div>@enderror
          </div>

          {{-- Brand Name --}}
          <div class="mb-3">
            <label class="pa-label">Brand Name
              <span style="font-size:.68rem;background:#fef3c7;color:#92400e;padding:1px 7px;border-radius:20px;margin-left:6px;font-weight:700;">Store Page</span>
            </label>
            <div class="brand-wrap">
              <input class="pa-input"
                wire:model="brand_name"
                placeholder="e.g. Fastrack, Milton, Bosch, or your company name">
            </div>
            <div class="pa-hint">Buyers can browse all products from this brand on one page — like Amazon stores.</div>
          </div>

          {{-- Rich text description --}}
          {{-- wire:ignore wraps ONLY the contenteditable area — NOT the hidden input --}}
          <div class="mb-3">
            <label class="pa-label">Product Description *</label>
            <div class="pa-tip">
              💡 Describe features, materials, applications, benefits. Buyers read this before sending enquiries.
            </div>

            {{-- wire:ignore prevents Livewire from wiping the contenteditable on re-render --}}
            <div wire:ignore>
              {{-- Toolbar --}}
              <div class="editor-toolbar">
                <button type="button" onclick="fmt('bold')" title="Bold"><i class="fas fa-bold"></i></button>
                <button type="button" onclick="fmt('italic')" title="Italic"><i class="fas fa-italic"></i></button>
                <button type="button" onclick="fmt('underline')" title="Underline"><i class="fas fa-underline"></i></button>
                <button type="button" onclick="fmt('insertUnorderedList')" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                <button type="button" onclick="fmt('insertOrderedList')" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                <select onchange="if(this.value){document.execCommand('formatBlock',false,this.value);paSync();this.value=''}"
                  style="max-width:90px;">
                  <option value="">Heading</option>
                  <option value="h3">H3</option>
                  <option value="h4">H4</option>
                  <option value="p">Paragraph</option>
                </select>
                <button type="button" onclick="fmt('justifyLeft')" title="Left"><i class="fas fa-align-left"></i></button>
                <button type="button" onclick="fmt('justifyCenter')" title="Center"><i class="fas fa-align-center"></i></button>
                <button type="button" id="toggleCodeBtn" onclick="toggleCode()" title="HTML" style="font-size:.7rem;font-weight:700;">
                  &lt;/&gt; HTML
                </button>
              </div>
              {{-- Editor — data-initial carries the existing description safely --}}
              <div id="pa-editor" class="editor-content" contenteditable="true"
                data-initial="{{ htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8') }}"
                placeholder="Start writing product description..."></div>
              {{-- HTML code view --}}
              <textarea id="pa-code" class="pa-textarea" style="display:none;border-radius:0 0 10px 10px;border-top:none;font-family:monospace;font-size:.78rem;"
                placeholder="Edit raw HTML..."></textarea>
            </div>

            {{-- Hidden input OUTSIDE wire:ignore so Livewire CAN read it --}}
            <input type="hidden" id="pa-desc-hidden" wire:model="description">
            @error('description')<div class="pa-err">{{ $message }}</div>@enderror
          </div>

          {{-- Keywords --}}
          <div>
            <label class="pa-label">Search Keywords / Tags</label>
            <input class="pa-input"
              wire:model="keywords"
              placeholder="e.g. stainless steel bottle, BPA free, insulated, 1 litre flask">
            <div class="pa-hint">Separate with commas. Helps buyers find your product via search.</div>
          </div>
        </div>
      </div>

      {{-- Category --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#0891b2,#0e7490);">
          <i class="bi bi-diagram-3-fill fs-5"></i>
          <div><h5>Category *</h5><small>Choose the right category hierarchy</small></div>
        </div>
        <div class="pa-card-body">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="pa-label">Main Category *</label>
              <select class="pa-select" wire:model.live="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                @endforeach
              </select>
              @error('category_id')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="pa-label">Sub Category *</label>
              <select class="pa-select" wire:model.live="subcategory_id" {{ !$category_id ? 'disabled' : '' }}>
                <option value="">Select Sub Category</option>
                @foreach($subcategories as $sub)
                  <option value="{{ $sub->id }}">{{ $sub->sub_cat_name }}</option>
                @endforeach
              </select>
              @error('subcategory_id')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="pa-label">Sub-Sub Category *</label>
              <select class="pa-select" wire:model.lazy="sub_subcategory_id" {{ !$subcategory_id ? 'disabled' : '' }}>
                <option value="">Select</option>
                @foreach($sub_subcategories as $ss)
                  <option value="{{ $ss->id }}">{{ $ss->sub_subcat_name }}</option>
                @endforeach
              </select>
              @error('sub_subcategory_id')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>

      @endif {{-- end step 1 --}}


      {{-- ── STEP 2: Photos & Media ── --}}
      @if($activeStep == 2)

      {{-- Main Image --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <i class="bi bi-camera-fill fs-5"></i>
          <div><h5>Main Product Image *</h5><small>The primary image shown to buyers</small></div>
        </div>
        <div class="pa-card-body">
          <div class="pa-tip">📸 White background, well-lit, sharp. Recommended: <strong>1080×1080px</strong>. JPG or WebP.</div>

          <div wire:loading wire:target="product_img"
            style="text-align:center;padding:12px;background:#f0f4ff;border-radius:10px;margin-bottom:10px;">
            <i class="bi bi-arrow-repeat me-2" style="color:#1d4ed8;"></i>
            <span style="font-size:.83rem;color:#1d4ed8;font-weight:700;">Uploading image...</span>
          </div>

          @if($product_img)
            {{-- New image just selected --}}
            <img src="{{ $product_img->temporaryUrl() }}"
              class="img-preview-main mb-2"
              style="max-height:300px;object-fit:contain;background:#f8fafc;padding:8px;border-radius:12px;display:block;">
            <label for="mainImg" style="font-size:.78rem;color:#7c3aed;font-weight:700;cursor:pointer;display:inline-block;">
              <i class="bi bi-arrow-repeat me-1"></i> Change Image
            </label>
          @elseif($isEditMode && $existingImagePath)
            {{-- Show saved image in edit mode --}}
            @php
              $existImg = str_starts_with($existingImagePath,'http')
                  ? $existingImagePath
                  : (config('app.pub_aws_url')
                      ? rtrim(config('app.pub_aws_url'),'/') . '/' . $existingImagePath
                      : asset('storage/' . $existingImagePath));
            @endphp
            <div style="margin-bottom:.75rem;">
              <img src="{{ $existImg }}"
                style="max-height:220px;object-fit:contain;border-radius:12px;border:1.5px solid #e5e9f2;padding:8px;background:#f8fafc;display:block;"
                onerror="this.style.display='none'">
              <div style="font-size:.76rem;color:#059669;font-weight:600;margin-top:.4rem;">
                <i class="bi bi-check-circle-fill me-1"></i> Current image — upload new one to replace
              </div>
            </div>
            <label for="mainImg" style="font-size:.78rem;color:#7c3aed;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:.3rem;padding:.4rem .85rem;border:1.5px solid #7c3aed;border-radius:8px;background:#faf5ff;">
              <i class="bi bi-arrow-repeat"></i> Replace Image
            </label>
          @else
            <label for="mainImg" class="img-drop-zone d-block">
              <i class="bi bi-cloud-upload" style="font-size:2.5rem;color:#d1d5db;"></i>
              <div style="font-size:.85rem;font-weight:700;color:#374151;margin-top:8px;">Click to upload main image</div>
              <div class="pa-hint mt-1">JPG, WebP, PNG · Max 4MB · Recommended 1080×1080px</div>
            </label>
          @endif
          <input type="file" id="mainImg" class="d-none" wire:model="product_img" accept="image/*">
          @error('product_img')<div class="pa-err">{{ $message }}</div>@enderror
        </div>
      </div>

      {{-- Gallery --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <i class="bi bi-images fs-5"></i>
          <div><h5>Gallery Images</h5><small>Multiple angles — up to 10 photos</small></div>
        </div>
        <div class="pa-card-body">
          <div class="pa-tip">🖼️ Front, back, side, in-use, packaging. Listings with 5+ images get <strong>3× more enquiries</strong>.</div>

          @if(!empty($gallery_images))
          <div class="gallery-grid mb-3">
            @foreach($gallery_images as $gi)
            <div class="gallery-thumb"><img src="{{ $gi->temporaryUrl() }}"></div>
            @endforeach
          </div>
          @endif

          <label for="galleryImgs" class="img-drop-zone d-block" style="padding:16px;">
            <i class="bi bi-plus-circle" style="font-size:1.8rem;color:#d1d5db;"></i>
            <div style="font-size:.82rem;font-weight:700;color:#374151;margin-top:6px;">Add gallery images</div>
            <div class="pa-hint">Select multiple files at once</div>
          </label>
          <input type="file" id="galleryImgs" class="d-none" wire:model="new_gallery_images" multiple accept="image/*">
        </div>
      </div>

      {{-- Video --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
          <i class="bi bi-play-circle-fill fs-5"></i>
          <div><h5>Product Video</h5><small>Optional — boosts buyer confidence</small></div>
        </div>
        <div class="pa-card-body">
          <label class="pa-label">YouTube or Vimeo URL</label>
          <input class="pa-input" wire:model.lazy="product_video_url"
            placeholder="https://youtube.com/watch?v=...">
          <div class="pa-hint">A factory/product demo video dramatically increases buyer trust.</div>
          @error('product_video_url')<div class="pa-err">{{ $message }}</div>@enderror
        </div>
      </div>

      @endif {{-- end step 2 --}}


      {{-- ── STEP 3: Pricing & Trade ── --}}
      @if($activeStep == 3)

      {{-- Pricing --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#059669,#0d9488);">
          <i class="bi bi-currency-exchange fs-5"></i>
          <div><h5>Pricing</h5><small>Set your pricing model</small></div>
        </div>
        <div class="pa-card-body">
          <div class="pa-tip">
            💡 <strong>International B2B tip:</strong> Use <em>Price Range</em> for volume-based pricing (common globally).
            Use <em>Fixed Price</em> for standard items. <em>Get Quote</em> for custom/bulk orders.
          </div>

          {{-- Price type selector --}}
          <label class="pa-label">Pricing Type *</label>
          <div class="price-pills mb-3">
            @foreach([
              'range'      => '📊 Price Range',
              'fixed'      => '🏷️ Fixed Price',
        
            ] as $val => $lbl)
            <div class="price-pill {{ $price_type === $val ? 'active' : '' }}"
                 wire:click="$set('price_type','{{ $val }}')">{{ $lbl }}</div>
            @endforeach
          </div>

          @if($price_type === 'range')
          <div class="row g-3 mb-3">
            <div class="col-md-5">
              <label class="pa-label">Min Price (₹) *</label>
              <input class="pa-input" wire:model.lazy="min_price" type="number" min="0" placeholder="e.g. 250">
              <div class="pa-hint">For small orders / samples</div>
              @error('min_price')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-center pt-3">
              <span style="font-size:1.2rem;color:#d1d5db;font-weight:700;">–</span>
            </div>
            <div class="col-md-5">
              <label class="pa-label">Max Price (₹) *</label>
              <input class="pa-input" wire:model.lazy="max_price" type="number" min="0" placeholder="e.g. 500">
              <div class="pa-hint">For bulk orders</div>
              @error('max_price')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
          </div>
          @elseif($price_type === 'fixed')
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="pa-label">Price (₹) *</label>
              <input class="pa-input" wire:model.lazy="fixed_price" type="number" min="0" placeholder="e.g. 350">
              @error('fixed_price')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
          </div>
          @elseif($price_type === 'negotiable')
          <div class="pa-tip" style="background:#f0fdf4;border-color:#10b981;color:#065f46;">
            ✅ Price will show as "Negotiable" to buyers. They will send an enquiry to discuss pricing.
          </div>
          @else
          <div class="pa-tip" style="background:#faf5ff;border-color:#7c3aed;color:#6d28d9;">
            📋 Price will show as "Get Quote". Best for custom/bulk orders requiring discussion.
          </div>
          @endif

        </div>
      </div>

      {{-- Order & Supply --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#059669,#0d9488);">
          <i class="bi bi-boxes fs-5"></i>
          <div><h5>Order & Supply Details</h5><small>MOQ, unit, lead time, supply capacity</small></div>
        </div>
        <div class="pa-card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="pa-label">Minimum Order Qty (MOQ) *</label>
              <input class="pa-input" wire:model.lazy="min_order" placeholder="e.g. 100">
              @error('min_order')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="pa-label">Unit *</label>
              <select class="pa-select" wire:model.lazy="unit">
                @foreach(['Piece','Box','Carton','Set','Dozen','Kg','Metric Ton','Litre','Meter','Square Meter','Pair','Pack','Roll','Other'] as $u)
                  <option value="{{ $u }}">{{ $u }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="pa-label">Supply Ability / Month</label>
              <input class="pa-input" wire:model.lazy="supply_ability" placeholder="e.g. 5,000 Pieces / Month">
            </div>
            <div class="col-md-6">
              <label class="pa-label">Delivery Lead Time</label>
              <select class="pa-select" wire:model.lazy="lead_time">
                <option value="">Select lead time</option>
                <option value="1-3 Business Days">1–3 Business Days</option>
                <option value="3-5 Business Days">3–5 Business Days</option>
                <option value="7 Business Days">7 Business Days</option>
                <option value="7-10 Business Days">7–10 Business Days</option>
                <option value="10-15 Business Days">10–15 Business Days</option>
                <option value="15-20 Business Days">15–20 Business Days</option>
                <option value="15-30 Business Days">15–30 Business Days</option>
                <option value="30 Business Days">30 Business Days</option>
                <option value="30-45 Business Days">30–45 Business Days</option>
                <option value="45-60 Business Days">45–60 Business Days</option>
                <option value="To be negotiated">To be negotiated</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="pa-label">Business Type *</label>
              <select class="pa-select" wire:model.lazy="business_type">
                <option value="">Select</option>
                @foreach(['Manufacturer','Exporter','Trader / Wholesaler','Distributor','Service Provider'] as $bt)
                  <option value="{{ $bt }}">{{ $bt }}</option>
                @endforeach
              </select>
              @error('business_type')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="pa-label">HSN / SAC Code *</label>
              <input class="pa-input" wire:model.lazy="HSN" placeholder="e.g. 7323">
              <div class="pa-hint">For customs / GST</div>
              @error('HSN')<div class="pa-err">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>

      @endif {{-- end step 3 --}}


      {{-- ── STEP 4: Specs, Docs & SEO ── --}}
      @if($activeStep == 4)

      {{-- Specifications --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#d97706,#f59e0b);">
          <i class="bi bi-file-earmark-text fs-5"></i>
          <div><h5>Product Specifications</h5><small>Technical details, certifications, packaging</small></div>
        </div>
        <div class="pa-card-body">
          <div class="row g-3">
            <div class="col-12">
              <label class="pa-label">Certifications</label>
              <input class="pa-input" wire:model.lazy="certifications"
                placeholder="e.g. ISO 9001, CE, BIS, FSSAI, RoHS, FDA">
              <div class="pa-hint">Certifications build buyer trust and are mandatory for some export markets.</div>
            </div>
            <div class="col-12">
              <label class="pa-label">Packaging Details</label>
              <textarea class="pa-textarea" wire:model.lazy="packaging_details" rows="3"
                placeholder="e.g. Each piece in individual poly bag. 12 pcs per carton. Carton: 40×30×25cm. Net weight 5kg."></textarea>
            </div>
            <div class="col-md-4">
              <label class="pa-label">Sample Available?</label>
              <select class="pa-select" wire:model.live="sample_available">
                <option value="no">No Samples</option>
                <option value="yes">Yes — Samples Available</option>
              </select>
            </div>
            @if($sample_available === 'yes')
            <div class="col-md-4">
              <label class="pa-label">Sample Price (₹)</label>
              <input class="pa-input" wire:model.lazy="sample_price" type="number" min="0" placeholder="0 = Free">
            </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Documents --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#d97706,#f59e0b);">
          <i class="bi bi-file-earmark-arrow-up fs-5"></i>
          <div><h5>Product Documents</h5><small>Brochure, spec sheet, test reports, catalogue</small></div>
        </div>
        <div class="pa-card-body">
          <div class="pa-tip">
            📄 Buyers download brochures and spec sheets before placing orders. Add as many as relevant.
          </div>

          {{-- Existing documents in list --}}
          @foreach($document_list as $i => $doc)
          <div class="doc-item">
            @php $ext = strtolower(pathinfo($doc['file']->getClientOriginalName(), PATHINFO_EXTENSION)); @endphp
            <div class="doc-icon {{ in_array($ext,['pdf']) ? 'pdf' : (in_array($ext,['doc','docx']) ? 'doc' : 'other') }}">
              <i class="bi {{ $ext==='pdf' ? 'bi-file-earmark-pdf' : ($ext==='doc'||$ext==='docx' ? 'bi-file-earmark-word' : 'bi-file-earmark') }}"></i>
            </div>
            <div style="flex:1;min-width:0;">
              <div style="font-size:.82rem;font-weight:700;color:#0f172a;">{{ $doc['label'] }}</div>
              <div style="font-size:.72rem;color:#94a3b8;">{{ $doc['file']->getClientOriginalName() }}</div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1"
                    wire:click="removeDocument({{ $i }})" style="font-size:.72rem;">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          @endforeach

          {{-- Add new document --}}
          <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;padding:14px;">
            <div class="row g-2 align-items-end">
              <div class="col-md-4">
                <label class="pa-label">Document Type</label>
                <select class="pa-select" wire:model.lazy="document_label">
                  <option value="">Select type</option>
                  @foreach(['Brochure','Product Catalogue','Spec Sheet','Test Report','Certificate','Safety Data Sheet','Installation Guide','User Manual','Other'] as $dl)
                    <option value="{{ $dl }}">{{ $dl }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-5">
                <label class="pa-label">Upload File <span class="pa-hint">(PDF, DOC, XLS — max 10MB)</span></label>
                <input type="file" class="pa-input" style="padding:.4rem;"
                  wire:model="new_document"
                  accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-primary w-100 rounded-3"
                  wire:click="addDocument"
                  style="background:linear-gradient(135deg,#676592,#8a88bf);border:none;font-size:.82rem;font-weight:700;padding:.52rem;">
                  <i class="bi bi-plus-lg me-1"></i> Add Doc
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      {{-- SEO --}}
      <div class="pa-card">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#374151,#4b5563);">
          <i class="bi bi-search fs-5"></i>
          <div><h5>SEO Settings</h5><small>Optional — helps with search engine visibility</small></div>
        </div>
        <div class="pa-card-body">
          <div class="row g-3">
            <div class="col-12">
              <label class="pa-label">SEO Title <span class="pa-hint">(leave blank to use product title)</span></label>
              <input class="pa-input" wire:model.lazy="seo_title" placeholder="Custom SEO title for search engines">
            </div>
            <div class="col-12">
              <label class="pa-label">SEO Description</label>
              <textarea class="pa-textarea" wire:model.lazy="seo_description" rows="2"
                placeholder="Brief description for Google search results (max 160 chars)"></textarea>
            </div>
          </div>
        </div>
      </div>

      {{-- Summary before publish --}}
      <div class="pa-card" style="border:2px solid #d1fae5;">
        <div class="pa-card-head" style="background:linear-gradient(135deg,#059669,#0d9488);">
          <i class="bi bi-check2-all fs-5"></i>
          <div><h5>Ready to Publish?</h5><small>Review before submitting for admin approval</small></div>
        </div>
        <div class="pa-card-body">
          <table style="width:100%;font-size:.8rem;border-collapse:collapse;">
            @foreach([
              ['Title', $title ?: '—'],
              ['Brand', $brand_name ?: '—'],
              ['Pricing', $price_type === 'range' ? '₹'.($min_price?:'—').' – ₹'.($max_price?:'—') : ucfirst($price_type)],
              ['MOQ', ($min_order?:'—').' '.$unit],
              ['Lead Time', $lead_time ?: '—'],
              ['Documents', count($document_list).' file(s)'],
              ['Sample', $sample_available === 'yes' ? 'Available' : 'Not available'],
            ] as [$k,$v])
            <tr style="border-bottom:1px solid #f0f2f8;">
              <td style="padding:7px 0;color:#64748b;width:40%;">{{ $k }}</td>
              <td style="font-weight:700;color:#0f172a;">{{ $v }}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>

      @endif {{-- end step 4 --}}


      {{-- ── Navigation buttons ── --}}
      <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0 2rem;">
        @if($activeStep > 1)
          <button type="button" class="btn-prev"
            wire:click="prevStep"
            onclick="paSync()">
            ← Previous
          </button>
        @else
          <div></div>
        @endif

        @if($activeStep < $totalSteps)
          <button type="button" class="btn-next"
            wire:loading.attr="disabled"
            wire:target="nextStep"
            wire:click="nextStep"
            onclick="paSync()">
            <span wire:loading.remove wire:target="nextStep">Continue → Step {{ $activeStep + 1 }}</span>
            <span wire:loading wire:target="nextStep">
              <i class="bi bi-arrow-repeat me-1"></i> Moving...
            </span>
          </button>
        @else
          {{-- Last step: Save Draft + Publish --}}
          <div style="display:flex;gap:.6rem;align-items:center;flex-wrap:wrap;">

            {{-- Save as Draft --}}
            <button type="button"
              class="btn-save-draft"
              wire:click.prevent="saveDraft"
              wire:loading.attr="disabled"
              title="Save now — publish later from My Listings">
              <span wire:loading.remove wire:target="saveDraft">
                <i class="bi bi-floppy"></i> Save Draft
              </span>
              <span wire:loading wire:target="saveDraft">
                <i class="bi bi-arrow-repeat me-1"></i> Saving...
              </span>
            </button>

            {{-- Publish / Save Changes --}}
            <button type="submit"
              class="btn-publish"
              wire:loading.attr="disabled"
              wire:target="submit"
              wire:click="generateSlug"
              onclick="paSync(); this.disabled=true; this.closest('form').requestSubmit();"
              title="{{ $isEditMode ? 'Save changes' : 'Submit for admin review' }}">
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
        @endif
      </div>

    </div>

    {{-- ══ RIGHT: Sticky Live Preview ══ --}}
    <div class="col-lg-4">

      {{-- Live preview card --}}
      <div class="preview-card">
        <div class="preview-img-wrap">
          @if($product_img)
            {{-- New image just uploaded --}}
            <img src="{{ $product_img->temporaryUrl() }}"
              style="width:100%;height:200px;object-fit:contain;background:#f8fafc;padding:8px;display:block;">
          @elseif($isEditMode && $existingImagePath)
            {{-- Existing saved image in edit mode --}}
            @php
              $prevImg = str_starts_with($existingImagePath,'http')
                  ? $existingImagePath
                  : (config('app.pub_aws_url')
                      ? rtrim(config('app.pub_aws_url'),'/') . '/' . $existingImagePath
                      : asset('storage/' . $existingImagePath));
            @endphp
            <img src="{{ $prevImg }}"
              style="width:100%;height:200px;object-fit:contain;background:#f8fafc;padding:8px;display:block;"
              onerror="this.style.display='none'">
          @else
            <div style="width:100%;height:200px;background:linear-gradient(135deg,#f8fafc,#f1f5f9);
              display:flex;align-items:center;justify-content:center;flex-direction:column;gap:8px;">
              <i class="bi bi-image" style="font-size:2.5rem;color:#e2e8f0;"></i>
              <span style="font-size:.75rem;color:#94a3b8;">Image preview</span>
            </div>
          @endif
          <span class="preview-live-badge">{{ $isEditMode ? 'EDITING' : 'PREVIEW' }}</span>
        </div>

        <div class="preview-body">
          {{-- Brand --}}
          @if($brand_name)
          <span class="preview-brand">🏷️ {{ $brand_name }}</span>
          @endif

          {{-- Title --}}
          <div style="font-size:.95rem;font-weight:800;color:#0f172a;margin-bottom:8px;line-height:1.3;">
            {{ $title ?: 'Product Title will appear here' }}
          </div>

          {{-- Price --}}
          @if($price_type === 'range' && ($min_price || $max_price))
            <div class="preview-price">₹{{ $min_price ?: '—' }} – ₹{{ $max_price ?: '—' }} / {{ $unit }}</div>
          @elseif($price_type === 'fixed' && $fixed_price)
            <div class="preview-price">₹{{ $fixed_price }} / {{ $unit }}</div>
          @elseif($price_type === 'negotiable')
            <div class="preview-price" style="color:#059669;">🤝 Negotiable</div>
          @elseif($price_type === 'quote')
            <div class="preview-price" style="color:#7c3aed;">📋 Get Quote</div>
          @endif

          {{-- Details --}}
          <div class="preview-meta mt-2">
            @if($min_order)<div>📦 MOQ: {{ $min_order }} {{ $unit }}</div>@endif
            @if($lead_time)<div>⏱ Lead time: {{ $lead_time }}</div>@endif
            @if($supply_ability)<div>🏭 Supply: {{ $supply_ability }}</div>@endif
            @if($country_of_origin)<div>🌍 Made in: {{ $country_of_origin }}</div>@endif
            @if($certifications)
              <div style="margin-top:6px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;padding:4px 8px;font-size:.72rem;color:#065f46;">
                🏅 {{ $certifications }}
              </div>
            @endif
            @if($sample_available === 'yes')
              <div style="margin-top:4px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:7px;padding:4px 8px;font-size:.72rem;color:#1e40af;">
                🧪 Samples available
              </div>
            @endif
          </div>

          {{-- Step indicator --}}
          <div style="margin-top:14px;padding-top:14px;border-top:1px solid #f1f5f9;
            font-size:.7rem;color:#94a3b8;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">
            Completion — Step {{ $activeStep }}/{{ $totalSteps }}
          </div>
          @foreach([
            ['Title', !empty($title)],
            ['Brand', !empty($brand_name)],
            ['Category', !empty($sub_subcategory_id)],
            ['Main Image', !empty($product_img)],
            ['Pricing', !empty($min_price) || !empty($fixed_price) || in_array($price_type,['negotiable','quote'])],
            ['MOQ & Unit', !empty($min_order)],
          ] as [$lbl, $ok])
          <div class="chk-item {{ $ok ? 'done' : 'todo' }}">
            <i class="bi {{ $ok ? 'bi-check-circle-fill' : 'bi-circle' }}" style="font-size:.72rem;"></i>
            {{ $lbl }}
          </div>
          @endforeach

        </div>
      </div>

      {{-- B2B tips --}}
      <div style="background:#0f172a;border-radius:14px;padding:18px;margin-top:14px;">
        <div style="font-size:.82rem;font-weight:800;color:#38bdf8;margin-bottom:10px;">
          🌍 B2B Listing Tips
        </div>
        <div style="font-size:.74rem;line-height:1.8;color:#94a3b8;">
          ✅ Use white background images<br>
          ✅ Add 5+ gallery photos<br>
          ✅ Set realistic MOQ &amp; lead time<br>
          ✅ Add certifications if available<br>
          ✅ Upload product brochure / spec sheet<br>
          ✅ Accept T/T and L/C for global buyers<br>
          ✅ Add brand name for your store page
        </div>
      </div>

    </div>

  </div>
  </form>
</div>

<livewire:seller.layout.footer />

@script
<script>
// paSync: syncs editor HTML → hidden input → Livewire wire:model
window.paSync = function() {
    var editor = document.getElementById('pa-editor');
    var hidden  = document.getElementById('pa-desc-hidden');
    if (editor && hidden) {
        hidden.value = editor.innerHTML;
        var ev = new Event('input'); ev.bubbles = true; hidden.dispatchEvent(ev);
    }
};

// initEditor: called after Livewire renders — safe to set innerHTML here
function initEditor() {
    const editor = document.getElementById('pa-editor');
    const code   = document.getElementById('pa-code');
    if (!editor) return;
    if (editor._paInited) return; // don't reinit if already done
    editor._paInited = true;

    // Read existing description from data-initial HTML attribute
    const initial = editor.getAttribute('data-initial') || '';
    editor.innerHTML = initial;

    editor.addEventListener('input', paSync);
    editor.addEventListener('blur',  paSync);

    window.fmt = function(cmd) {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand(cmd, false, null);
        editor.focus();
        paSync();
    };

    window.toggleCode = function() {
        if (!code) return;
        if (editor.style.display !== 'none') {
            code.value = editor.innerHTML;
            editor.style.display = 'none';
            code.style.display   = 'block';
        } else {
            editor.innerHTML     = code.value;
            editor.style.display = 'block';
            code.style.display   = 'none';
            paSync();
        }
    };

    if (code) {
        code.addEventListener('input', function() {
            editor.innerHTML = code.value;
            paSync();
        });
    }
}

// Run after Livewire finishes rendering (works for both initial load and re-renders)
document.addEventListener('livewire:navigated', initEditor);
document.addEventListener('livewire:initialized', initEditor);

// Fallback: also run on DOMContentLoaded (covers non-Livewire-navigate page loads)
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initEditor);
} else {
    initEditor();
}

// Sync before every Livewire network request
document.addEventListener('livewire:before-request', paSync);
</script>
@endscript
</div>