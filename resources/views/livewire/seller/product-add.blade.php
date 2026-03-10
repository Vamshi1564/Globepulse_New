<div>
    <livewire:seller.layout.header />

    <style>
        .upload-animate {
            animation: pulse 1.2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.03);
                opacity: 0.85;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <div class="container-fluid">


        <!-- HEADER -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center flex-wrap p-4 rounded-4">

            <!-- ✅ Title -->
            <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                <div class="icon-circle text-white d-flex align-items-center justify-content-center px-1">
                    <i class="bi bi-cart-plus-fill fs-5 text-primary"></i>
                </div>
                <h3 class="fw-bold mb-0 text-dark">Add New Product</h3>
            </div>

            <!-- ✅ Publish Button -->
            <button class="btn rounded-pill d-flex align-items-center gap-2 px-4 py-2" wire:click="generateSlug"
                type="submit" form="productForm" style="background: linear-gradient(135deg,#676592e3, #8a88bfef );">
                <i class="fas fa-cloud-upload-alt fs-7 text-light"></i>
                <span class="fw-semibold text-light ">Publish Product</span>
            </button>

        </div>


        <form id="productForm" class="bg-white p-4 rounded-4 pt-0 mb-5" wire:submit.prevent="submit"
            enctype="multipart/form-data">

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    <!-- PRODUCT DETAILS -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">

                        <!-- ✅ Gradient Header -->
                        <div class="p-3 px-4 text-white"
                            style="background: linear-gradient(135deg,#676592e3, #8a88bfef );">
                            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2 text-light">
                                <i class="bi bi-box-seam fs-5"></i> Product Details
                            </h5>
                            <small class="opacity-75">Basic product information</small>
                        </div>

                        <!-- ✅ Body -->
                        <div class="card-body p-4 bg-light">

                            <!-- ✅ Floating Input -->
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control shadow-sm" id="productTitle" wire:model="title"
                                    placeholder="Product Title">
                                <label for="productTitle">
                                    <i class="bi bi-tag me-1"></i> Product Title
                                </label>
                                @error('title')
                                    <small class="text-danger fw-semibold">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- ✅ Floating Textarea -->
                            <div class="form-floating mb-4">
                                {{-- <textarea class="form-control shadow-sm" id="productDescription"
                                    wire:model="description" rows="5" style="height: 140px"
                                    placeholder="Product Description"></textarea>
                                <label for="productDescription">
                                    <i class="bi bi-card-text me-1"></i> Product Description
                                </label>
                                @error('description')
                                    <small class="text-danger fw-semibold">{{ $message }}</small>
                                @enderror --}}

                                <div class="mb-3 p-3 border rounded-3 bg-white shadow-sm d-flex flex-wrap align-items-center gap-2" wire:ignore>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="bold" title="Bold"><i
                                            class="fas fa-bold"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="italic"
                                        title="Italic"><i class="fas fa-italic"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="underline"
                                        title="Underline"><i class="fas fa-underline"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="insertUnorderedList"
                                        title="Bullet List"><i class="fas fa-list-ul"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="insertOrderedList"
                                        title="Numbered List"><i class="fas fa-list-ol"></i></button>
                                
                                    <select id="styleDropdown" class="form-select form-select-sm me-2 toolbar-button" style="width: auto;">
                                        <option value="">Style</option>
                                        <option value="h1">H1</option>
                                        <option value="h2">H2</option>
                                        <option value="h3">H3</option>
                                        <option value="h4">H4</option>
                                        <option value="p">Paragraph</option>
                                    </select>
                                
                                    <select id="fontDropdown" class="form-select form-select-sm me-2 toolbar-button" style="width: auto;">
                                        <option value="">Font</option>
                                        <option value="Arial">Arial</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Courier New">Courier New</option>
                                    </select>
                                
                                    <select id="fontSizeDropdown" class="form-select form-select-sm me-2 toolbar-button" style="width: auto;">
                                        <option value="">Size</option>
                                        <option value="1">XS</option>
                                        <option value="2">Small</option>
                                        <option value="3">Normal</option>
                                        <option value="4">Large</option>
                                        <option value="5">X-Large</option>
                                    </select>
                                
                                    <input type="color" id="colorPicker" class="form-control form-control-color me-2" title="Text Color" />
                                    <button type="button" id="insertLinkBtn" class="btn btn-sm btn-outline-secondary toolbar-button"
                                        title="Insert Link"><i class="fas fa-link"></i></button>
                                    <button type="button" id="insertImageBtn" class="btn btn-sm btn-outline-secondary toolbar-button"
                                        title="Insert Image"><i class="fas fa-image"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="insertHorizontalRule"
                                        title="Horizontal Line"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="justifyLeft"
                                        title="Align Left"><i class="fas fa-align-left"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="justifyCenter"
                                        title="Align Center"><i class="fas fa-align-center"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary toolbar-button" data-command="justifyRight"
                                        title="Align Right"><i class="fas fa-align-right"></i></button>
                                    <button type="button" id="insertTableBtn" class="btn btn-sm btn-outline-secondary toolbar-button"
                                        title="Insert Table"><i class="fas fa-table"></i></button>
                                    <button type="button" id="toggleCodeBtn" class="btn btn-sm btn-outline-primary toolbar-button"
                                        title="Toggle HTML"><i class="fas fa-code"></i> Code</button>
                                </div>

                                <div wire:ignore>
                                        <div id="editor" contenteditable="true"
                                            class="form-control shadow-sm border border-1 border-secondary-subtle rounded-3"
                                            style="min-height: 220px; font-size: 0.95rem;"
                                            placeholder="Start writing your blog content here..."></div>
                                    </div>

                                    <!-- Code Editor -->
                                    <div class="mt-3" id="codeEditorContainer" style="display: none;">
                                        <label for="codeEditor" class="fw-semibold mb-2">Edit HTML
                                            Code</label>
                                        <textarea id="codeEditor" class="form-control shadow-sm rounded-3" style="min-height: 200px; font-size: 0.95rem;"
                                            placeholder="Edit raw HTML of your content here..."></textarea>
                                    </div>

                                    <input type="hidden" id="postContent" wire:model="description" />
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editor = document.getElementById('editor');
        const postContent = document.getElementById('postContent');
        const codeEditorContainer = document.getElementById('codeEditorContainer');
        const codeEditor = document.getElementById('codeEditor');

        // ✅ Load content from Livewire (DESCRIPTION)
        editor.innerHTML = @json($description ?? '');

        // ✅ Sync editor content to Livewire DESCRIPTION
        editor.addEventListener('input', () => {
            @this.set('description', editor.innerHTML);
        });

        // ✅ Toolbar formatting buttons
        document.querySelectorAll('.toolbar-button[data-command]').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const command = e.currentTarget.getAttribute('data-command');
                document.execCommand('styleWithCSS', false, true);
                document.execCommand(command, false, null);
                editor.dispatchEvent(new Event('input'));
            });
        });

        // ✅ Style dropdown (H1, H2, P...)
        document.getElementById('styleDropdown').addEventListener('change', e => {
            if (e.target.value) {
                document.execCommand('formatBlock', false, e.target.value);
                editor.dispatchEvent(new Event('input'));
            }
        });

        // ✅ Font family
        document.getElementById('fontDropdown').addEventListener('change', e => {
            if (e.target.value) {
                document.execCommand('fontName', false, e.target.value);
                editor.dispatchEvent(new Event('input'));
            }
        });

        // ✅ Font size
        document.getElementById('fontSizeDropdown').addEventListener('change', e => {
            if (e.target.value) {
                document.execCommand('fontSize', false, e.target.value);
                editor.dispatchEvent(new Event('input'));
            }
        });

        // ✅ Text color
        document.getElementById('colorPicker').addEventListener('input', function () {
            document.execCommand('foreColor', false, this.value);
            editor.dispatchEvent(new Event('input'));
        });

        // ✅ Insert link
        document.getElementById('insertLinkBtn').addEventListener('click', e => {
            e.preventDefault();
            const url = prompt("Enter link URL:");
            if (url) {
                document.execCommand('createLink', false, url);
                editor.dispatchEvent(new Event('input'));
            }
        });

        // ✅ Insert image
        document.getElementById('insertImageBtn').addEventListener('click', e => {
            e.preventDefault();
            const url = prompt("Enter image URL:");
            if (url) {
                document.execCommand('insertImage', false, url);
                editor.dispatchEvent(new Event('input'));
            }
        });

        // ✅ Insert table
        document.getElementById('insertTableBtn').addEventListener('click', e => {
            e.preventDefault();
            const rows = parseInt(prompt("Rows:"), 10);
            const cols = parseInt(prompt("Columns:"), 10);
            if (!rows || !cols) return;

            const table = document.createElement('table');
            table.style.borderCollapse = 'collapse';
            table.style.width = '100%';

            for (let i = 0; i < rows; i++) {
                const tr = document.createElement('tr');
                for (let j = 0; j < cols; j++) {
                    const td = document.createElement('td');
                    td.innerHTML = '&nbsp;';
                    td.style.border = '1px solid #ccc';
                    td.style.padding = '6px';
                    tr.appendChild(td);
                }
                table.appendChild(tr);
            }

            editor.appendChild(table);
            editor.dispatchEvent(new Event('input'));
        });

        // ✅ Toggle HTML code view
        let isCodeView = false;
        document.getElementById('toggleCodeBtn').addEventListener('click', e => {
            e.preventDefault();

            if (!isCodeView) {
                codeEditor.value = editor.innerHTML;
                codeEditorContainer.style.display = 'block';
                editor.style.display = 'none';
            } else {
                editor.innerHTML = codeEditor.value;
                codeEditorContainer.style.display = 'none';
                editor.style.display = 'block';
                editor.dispatchEvent(new Event('input'));
            }

            isCodeView = !isCodeView;
        });
    });

    // ✅ Sidebar toggle (unchanged)
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("menu-toggle");
        if (toggle) {
            toggle.addEventListener("click", function () {
                document.getElementById("sidebar-wrapper").classList.toggle("d-none");
            });
        }
    });
</script>
                    <!-- IMAGE UPLOAD -->
                    <style>
                        .upload-preview-main {
                            width: 220px;
                            height: 220px;
                            object-fit: cover;
                            border-radius: 20px;
                            border: 3px solid #fff;
                        }

                        .upload-placeholder-main {
                            width: 220px;
                            height: 220px;
                            border: 2px dashed #ddd;
                            border-radius: 20px;
                            background: #f8f9fa;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-direction: column;
                            margin: auto;
                        }

                        .gallery-thumb {
                            width: 90px;
                            height: 90px;
                            border-radius: 12px;
                            overflow: hidden;
                            transition: 0.3s;
                        }

                        .gallery-thumb img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }

                        .gallery-thumb:hover {
                            transform: scale(1.05);
                        }

                        .upload-animate {
                            animation: pulse 1.5s infinite;
                        }

                        @keyframes pulse {
                            0% {
                                opacity: .6;
                            }

                            50% {
                                opacity: 1;
                            }

                            100% {
                                opacity: .6;
                            }
                        }
                    </style>


                    <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">

                        <!-- ✅ Gradient Header -->
                        <div class="p-3 px-4 text-white"
                            style="background: linear-gradient(135deg,#676592e3, #8a88bfef );">
                            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2 text-light">
                                <i class="bi bi-image-fill fs-5"></i> Product Images
                            </h5>
                            <small class="opacity-75">Upload main & gallery images</small>
                        </div>

                        <!-- ✅ Body -->
                        <div class="card-body p-4 bg-light">

                            <!-- ✅ MAIN IMAGE -->
                            <div class="mb-4 position-relative text-center">

                                <!-- ✅ Loader -->
                                <div wire:loading wire:target="product_img"
                                    class="position-absolute top-50 start-50 translate-middle bg-white px-4 py-2 rounded-pill shadow upload-animate">
                                    <i class="fas fa-spinner fa-spin me-2 text-danger"></i> Uploading...
                                </div>

                                <!-- ✅ Preview -->
                                @if ($product_img)
                                    <img src="{{ $product_img->temporaryUrl() }}"
                                        class="d-block mx-auto mb-3 shadow rounded-4 upload-preview-main">
                                @else
                                    <div class="upload-placeholder-main mb-3">
                                        <i class="bi bi-cloud-upload fs-1 text-muted"></i>
                                        <p class="mb-0 text-muted small">No main image selected</p>
                                    </div>
                                @endif

                                <!-- ✅ Upload Box -->
                                <div class="file-upload-ui text-center">
                                    <input type="file" class="form-control d-none" id="mainImage"
                                        wire:model="product_img" accept="image/*">
                                    <label for="mainImage" class="btn btn-outline-danger rounded-pill px-4 shadow-sm">
                                        <i class="bi bi-upload me-1"></i> Upload Main Image
                                    </label>
                                    <p class="small text-muted mt-2">Recommended size: 1080×1080</p>
                                </div>

                                @error('product_img')
                                    <small class="text-danger fw-semibold">{{ $message }}</small>
                                @enderror
                            </div>

                            <hr>

                            <!-- ✅ GALLERY IMAGES -->
                            <div>
                                <label class="form-label fw-bold mb-2">
                                    <i class="bi bi-images me-1"></i> Product Gallery
                                </label>

                                @if (!empty($gallery_images))
                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                        @foreach ($gallery_images as $galleryImage)
                                            <div class="gallery-thumb shadow-sm">
                                                <img src="{{ $galleryImage->temporaryUrl() }}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- ✅ Upload Button -->
                                <div class="file-upload-ui">
                                    <input type="file" class="form-control d-none" id="galleryImages"
                                        wire:model="new_gallery_images" multiple accept="image/*">
                                    <label for="galleryImages"
                                        class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                                        <i class="bi bi-images me-1"></i> Upload Gallery Images
                                    </label>
                                </div>

                                @error('gallery_images.*')
                                    <small class="text-danger fw-semibold">{{ $message }}</small>
                                @enderror

                                <!-- ✅ Gallery Loader -->
                                <div wire:loading wire:target="gallery_images"
                                    class=" mt-3 text-primary small fw-semibold">
                                    <i class="fas fa-spinner fa-spin me-1"></i> Uploading gallery images...
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                <!-- RIGHT SIDE -->
                <div class="col-lg-4">

                    <!-- ✅ LIVE PREVIEW -->
                    <div class="card border shadow-lg rounded-3 mb-4 overflow-hidden">
                        <div class="position-relative">

                            @if ($product_img)
                                <img src="{{ $product_img->temporaryUrl() }}" class="w-100"
                                    style="height:220px; object-fit:cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light"
                                    style="height:220px;">
                                    <span class="text-muted">Image Preview</span>
                                </div>
                            @endif

                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">LIVE</span>
                        </div>

                        <div class="p-3">
                            <h6 class="fw-bold mb-1">{{ $title ?: 'Product Title Preview' }}</h6>

                            <p class="small text-muted mb-2" style="min-height:40px;">
                                {{ $description ?: 'Product description live preview will appear here...' }}
                            </p>

                            <div class="d-flex justify-content-between small fw-semibold">
                                <span>min_price ₹ {{ $min_price ?: '---' }}</span>
                                <span>max_price ₹ {{ $max_price ?: '---' }}</span>
                            </div>


                            <div class="d-flex justify-content-between small fw-semibold mt-2">
                                <span>Min Order: {{ $min_order ?: '--' }}</span>
                                <span>Type: {{ $business_type ?: '--' }}</span>
                            </div>
                            {{-- <div class="mt-2 small text-secondary">
                                Min Order: {{ $min_order ?: '--' }} | Type: {{ $business_type ?: '--' }}
                            </div> --}}
                        </div>
                    </div>

                    <!-- PRICING -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">

                        <!-- ✅ Gradient Header -->
                        <div class="p-3 px-4 text-white"
                            style="background: linear-gradient(135deg,#676592e3, #8a88bfef );">
                            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2 text-light">
                                <i class="bi bi-currency-rupee fs-5"></i> Pricing & Business Info
                            </h5>
                            <small class="opacity-75">Set product pricing & order details</small>
                        </div>

                        <!-- ✅ Body -->
                        <div class="card-body p-4 bg-light">

                            <div class="row g-4">

                                <!-- ✅ Min Price -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-sm" wire:model="min_price"
                                            id="minPrice" placeholder="Min Price">
                                        <label for="minPrice">
                                            <i class="bi bi-arrow-down-circle me-1"></i> Minimum Price (₹)
                                        </label>
                                    </div>
                                </div>

                                <!-- ✅ Max Price -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-sm" wire:model="max_price"
                                            id="maxPrice" placeholder="Max Price">
                                        <label for="maxPrice">
                                            <i class="bi bi-arrow-up-circle me-1"></i> Maximum Price (₹)
                                        </label>
                                    </div>
                                </div>

                                <!-- ✅ Min Order -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-sm" wire:model="min_order"
                                            id="minOrder" placeholder="Min Order">
                                        <label for="minOrder">
                                            <i class="bi bi-cart-check me-1"></i> Minimum Order Qty
                                        </label>
                                    </div>
                                </div>

                                <!-- ✅ Business Type -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-sm" wire:model="business_type"
                                            id="businessType" placeholder="Business Type">
                                        <label for="businessType">
                                            <i class="bi bi-building me-1"></i> Business Type
                                        </label>
                                    </div>
                                </div>

                                <!-- ✅ HSN Code -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-sm" wire:model="HSN" id="hsnCode"
                                            placeholder="HSN Code">
                                        <label for="hsnCode">
                                            <i class="bi bi-upc-scan me-1"></i> HSN / SAC Code
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                    <!-- CATEGORY -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">

                        <!-- ✅ Gradient Header -->
                        <div class="p-3 px-4 text-white"
                            style="background: linear-gradient(135deg,#676592e3, #8a88bfef );">
                            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2 text-light">
                                <i class="bi bi-diagram-3-fill fs-5"></i> Category Selection
                            </h5>
                            <small class="opacity-75">Choose product category hierarchy</small>
                        </div>

                        <!-- ✅ Body -->
                        <div class="card-body p-4 bg-light">

                            <div class="row g-4">

                                <!-- ✅ Main Category -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select shadow-sm" wire:model.live="category_id"
                                            id="mainCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="mainCategory"> <i class="bi bi-folder-fill me-1"></i> Main Category
                                        </label>
                                    </div>
                                </div>

                                <!-- ✅ Sub Category -->
                                <div class=" col-12">
                                    <div class="form-floating">
                                        <select class="form-select shadow-sm" wire:model.live="subcategory_id"
                                            id="subCategory" {{ !$category_id ? 'disabled' : '' }}>
                                            <option value="">Select Sub Category</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->sub_cat_name }}
                                                </option>
                                            @endforeach
                                        </select> <label for="subCategory">
                                            <i class=" bi bi-folder2-open me-1"></i> Sub Category
                                        </label>
                                    </div>
                                </div>

                                <!-- ✅ Sub Sub Category -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select shadow-sm" wire:model="sub_subcategory_id"
                                            id="subSubCategory" {{ !$subcategory_id ? 'disabled' : '' }}>
                                            <option value="">Select Sub Sub Category</option>
                                            @foreach ($sub_subcategories as $subsubcategory)
                                                <option value="{{ $subsubcategory->id }}">
                                                    {{ $subsubcategory->sub_subcat_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="subSubCategory">
                                            <i class=" bi bi-collection-fill me-1"></i> Sub Sub Category
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>

            <!-- ✅ PREMIUM ALERTS -->
            @if (session()->has('message'))
                <div class="custom-alert success show">
                    <span class="icon">✅</span>
                    <div class="text">
                        <strong>Success!</strong>
                        <p>{{ session('message') }}</p>
                    </div>
                    <span class="close-btn" onclick="this.parentElement.remove()">×</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="custom-alert error show">
                    {{-- <span class="icon">❌</span> --}}
                    <div class="text">
                        <strong>Error!</strong>
                        <p>{{ session('error') }}</p>
                    </div>
                    <span class="close-btn" onclick="this.parentElement.remove()">×</span>
                </div>
            @endif
            <style>
                .custom-alert {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    min-width: 320px;
                    max-width: 380px;
                    padding: 15px 18px;
                    border-radius: 14px;
                    display: flex;
                    align-items: flex-start;
                    gap: 12px;
                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
                    backdrop-filter: blur(10px);
                    animation: slideIn 0.5s ease;
                    z-index: 9999;
                }

                .custom-alert.success {
                    background: linear-gradient(135deg, #28a745, #20c997);
                    color: #fff;
                }

                .custom-alert.error {
                    background: linear-gradient(135deg, #dc3545, #ff6b6b);
                    color: #fff;
                }

                .custom-alert .icon {
                    font-size: 20px;
                    line-height: 1;
                }

                .custom-alert .text {
                    flex: 1;
                }

                .custom-alert .text strong {
                    font-size: 16px;
                    display: block;
                    margin-bottom: 2px;
                }

                .custom-alert .text p {
                    font-size: 14px;
                    margin: 0;
                    opacity: 0.9;
                }

                .custom-alert .close-btn {
                    font-size: 20px;
                    cursor: pointer;
                    line-height: 1;
                    opacity: 0.7;
                }

                .custom-alert .close-btn:hover {
                    opacity: 1;
                }

                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }

                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
            </style>



        </form>

    </div>


    <livewire:seller.layout.footer />
</div>