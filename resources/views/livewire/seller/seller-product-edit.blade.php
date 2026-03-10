<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">

        <div class="content p-0 m-0">
            <form class="my-5 bg-white p-4 rounded-4 shadow-sm" wire:submit.prevent="update"
                enctype="multipart/form-data">

                <!-- Page Title -->
                <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Edit Product</h2>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-upload me-2"></i> Update Product
                    </button>
                </div>

                <div class="row g-4">

                    <!-- Left Section -->
                    <div class="col-lg-8">

                        <!-- Title & Description -->
                        <div class="card bg-light border-0 shadow-sm p-4 mb-4">
                            <h5 class="mb-3">Product Title</h5>
                            <input type="text" class="form-control mb-3" wire:model="title"
                                placeholder="Write title here...">
                            @error('title')<small class="text-danger">{{ $message }}</small>@enderror

                            <h5 class="mb-3">Product Description</h5>
                            <textarea class="form-control tinymce mb-3" wire:model="description" rows="6"
                                placeholder="Write description here..."></textarea>
                            @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <!-- Product Image -->
                        <div class="card bg-light border-0 shadow-sm p-4 mb-4">
                            <h5 class="mb-3">Product Image</h5>
                            <small class="text-danger d-block mb-2">Size 1080×1080px — Only jpg, webp</small>

                            @if (is_object($product_img))
                                <img src="{{ $product_img->temporaryUrl() }}" class="rounded border mb-2"
                                    style="width: 120px;">
                            @elseif ($existing_product_img)
                                <img src="{{ Storage::url($existing_product_img) }}" class="rounded border mb-2"
                                    style="width: 120px;">
                            @endif

                            <input type="file" class="form-control mt-2" wire:model="product_img">
                            @error('product_img')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <!-- Gallery Images -->
                        <div class="card bg-light border-0 shadow-sm p-4 mb-4">
                            <h5 class="mb-3">Gallery Images</h5>
                            <small class="text-danger d-block mb-2">Size 1080×1080px — Only jpg, webp</small>

                            <div class="d-flex flex-wrap mb-3">
                                @if (is_array($gallery_images))
                                    @foreach ($gallery_images as $key => $galleryImage)
                                        <div class="position-relative me-2 mb-2">
                                            <img src="{{ $galleryImage->temporaryUrl() }}" style="width: 80px;"
                                                class="rounded border">
                                            <button type="button" class="btn-close position-absolute top-0 end-0"
                                                wire:click="removeImage({{ $key }})"></button>
                                        </div>
                                    @endforeach
                                @elseif (!empty($gallery_images))
                                    @foreach ($gallery_images as $galleryImage)
                                        <div class="position-relative me-2 mb-2">
                                            <img src="{{ config('app.pub_aws_url') . $galleryImage->gallery_images }}"
                                                style="width: 80px;" class="rounded border">
                                            <button type="button" class="btn-close position-absolute top-0 end-0"
                                                wire:click="removeImageFromDB({{ $galleryImage->id }})"></button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <input type="file" class="form-control" wire:model="gallery_images" multiple>
                            @error('gallery_images.*')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                    </div>

                    <!-- Right Section -->
                    <div class="col-lg-4">

                        <div class="card bg-light border-0 shadow-sm p-4 mb-4">
                            <h5 class="mb-3">Product Details</h5>

                            <input type="text" class="form-control mb-3" wire:model="min_price"
                                placeholder="Min Price ₹">
                            @error('min_price')<small class="text-danger">{{ $message }}</small>@enderror

                            <input type="text" class="form-control mb-3" wire:model="max_price"
                                placeholder="Max Price ₹">
                            @error('max_price')<small class="text-danger">{{ $message }}</small>@enderror

                            <input type="text" class="form-control mb-3" wire:model="min_order"
                                placeholder="Min Order Qty">
                            @error('min_order')<small class="text-danger">{{ $message }}</small>@enderror

                            <input type="text" class="form-control mb-3" wire:model="business_type"
                                placeholder="Business Type">
                            @error('business_type')<small class="text-danger">{{ $message }}</small>@enderror

                            <input type="text" class="form-control" wire:model="HSN" placeholder="HSN Code">
                            @error('HSN')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                    </div>

                </div>

                <!-- Success Alert -->
                @if (session()->has('message'))
                    <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                        role="alert" id="alert">
                        <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                        <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                        <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif


            </form>


        </div>
    </div>


    <livewire:seller.layout.footer />
</div>