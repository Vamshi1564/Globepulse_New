<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content pt-5">
            <div class="row g-5">
                <div class="col-12 col-xl-10 border p-lg-5 p-3 border-translucent mx-auto">
                    <div class="col-auto">
                        <h2 class="mb-4">Add Product Gallery</h2>
                    </div>
                    <form wire:submit.prevent = "saveDetail" enctype="multipart/form-data">
                        <h5 class="mb-2">Gallery images</h5>
                        <span class="text-danger fs-9">Image Upload Size 1080px x 1080px</span>
                        <span class="text-danger fs-9">And Only jpg or webp images are allowed.</span>
                        <div class="border p-2 mb-3" id="my-awesome-dropzone" data-dropzone="data-dropzone">
                            @if ($gallery_images)
                                <div class="gallery-preview position-relative">
                                    @foreach ($gallery_images as $key => $galleryImage)
                                        <img src="{{ $galleryImage->temporaryUrl() }}" alt="Gallery Image"
                                            style="max-width: 100px; margin: 10px;">
                                    @endforeach
                                </div>
                            @endif

                            <div class="pt-2">
                                <input type="file" wire:model="gallery_images" class="w-100" multiple>
                            </div>
                            <p class="text-danger">
                                @error('gallery_images')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="mb-4">
                            <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Publish
                                product</button>
                        </div>
                    </form>
                    {{-- <div class="col-12"> --}}

                        @if (session()->has('message'))
                            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                                role="alert" id="alert">
                                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        <livewire:seller.layout.footer />
    </div>

</div>
