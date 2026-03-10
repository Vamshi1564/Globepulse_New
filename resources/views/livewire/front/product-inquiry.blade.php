<div>
    <livewire:front.layout.header />

    <div class="container-fluid">
        <div class="content pt-7">
            {{-- <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
                    <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
                    <li class="breadcrumb-item active">Default</li>
                </ol>
            </nav> --}}
            <form class="mb-9" wire:submit.prevent = "submit" enctype="multipart/form-data">
                <div class="text-center mb-5">
                    <div class="col-auto">
                        <h2 class="mb-2">Product Inquiry</h2>
                        {{-- <h5 class="text-body-tertiary fw-semibold">Orders placed across your store</h5> --}}
                    </div>
                    {{-- <div class="col-auto">
                        <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="button">Discard</button>
                        <button class="btn btn-phoenix-primary me-2 mb-2 mb-sm-0" type="button">Save draft</button>
                        <button class="btn btn-primary mb-2 mb-sm-0" wire:click="generateSlug" type="submit">Publish product</button>
                    </div> --}}
                </div>
                <div class="row g-5">
                    <div class="col-12 col-xl-8 mx-auto">
                        <h4 class="mb-3">Product Title</h4>
                        <input class="form-control mb-2" wire:model="product_name" type="text"
                            placeholder="Write title here..." />
                        <p class="text-danger fs-9">
                            @error('product_name')
                                {{ $message }}
                            @enderror
                        </p>
                        <div class="mb-6">
                            <h4 class="mb-3">Email</h4>
                            <input class="form-control mb-2" wire:model="email" type="email"
                                placeholder="Write Email here..." />
                            <p class="text-danger fs-9">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="mb-6">
                            <h4 class="mb-3">Mobile No.</h4>
                            <input class="form-control mb-2" wire:model="phonenumber" type="tel"
                                placeholder="Write Email here..." />
                            <p class="text-danger fs-9">
                                @error('phonenumber')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="mb-6">
                            <h4 class="mb-3">Company Name</h4>
                            <input class="form-control mb-2" wire:model="company_name" type="text"
                                placeholder="Write Company Name here..." />
                            <p class="text-danger fs-9">
                                @error('company_name')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                    </div>

                </div>

                <div class="text-center mb-3">
                    <button class="btn btn-primary" type="submit">Send
                        Inquiry</button>
                </div>

                {{-- <div class="col-12 col-sm-12 col-lg-12 col-xl-8 mx-auto"> --}}

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
            </form>

        </div>
    </div>
    <livewire:front.layout.footer />


</div>
