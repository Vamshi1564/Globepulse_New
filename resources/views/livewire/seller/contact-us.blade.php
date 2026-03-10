<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="">
                <div class="container my-4">
                    <div class=" bg-white p-5 rounded-4 shadow-lg ">
                        <h2 class="fw-bold text-primary mb-3">Contact Us</h2>
                        <form class="" wire:submit.prevent="submit" enctype="multipart/form-data">
                            <div class="row ">
                                <div class="col-md-6">
                                    <label class="form-label">Business Email</label>
                                    <input class="form-control" id="email" wire:model="business_email" type="email"
                                        placeholder="Enter your email" />
                                    <p class="text-danger fs-9">@error('business_email') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Business Phone</label>
                                    <input class="form-control" id="phone" wire:model="business_phone" type="text"
                                        placeholder="Enter your phone" />
                                    <p class="text-danger fs-9">@error('business_phone') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Business Whatsapp</label>
                                    <input class="form-control" id="whatsapp" wire:model="business_whatsapp" type="text"
                                        placeholder="Enter Whatsapp" />
                                    <p class="text-danger fs-9">@error('business_whatsapp') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company Name</label>
                                    <input class="form-control" id="companyname" wire:model="comany_name" type="text"
                                        placeholder="Enter company name" />
                                    <p class="text-danger fs-9">@error('comany_name') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" id="address" wire:model="address" type="text"
                                        placeholder="Enter address" />
                                    <p class="text-danger fs-9">@error('address') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Second Address (Optional)</label>
                                    <input class="form-control" id="address" wire:model="address" type="text"
                                        placeholder="Enter address" />
                                    <p class="text-danger fs-9">@error('address') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Zip Code</label>
                                    <input class="form-control" id="zipcode" wire:model="pin_code" type="text"
                                        placeholder="Enter zip code" />
                                    <p class="text-danger fs-9">@error('pin_code') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Inquiry Mail</label>
                                    <input class="form-control" id="inquiry" wire:model="inquiry_email" type="email"
                                        placeholder="Enter inquiry mail" />
                                    <p class="text-danger fs-9">@error('inquiry_email') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Map Link</label>
                                    <input class="form-control" id="map" wire:model="map_link" type="text"
                                        placeholder="Enter map link" />
                                    <p class="text-danger fs-9">@error('map_link') {{ $message }} @enderror</p>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-primary fs-8 mt-3 px-5 py-2 shadow-sm">Submit</button>
                            </div>
                        </form>

                        @if (session()->has('error'))
                            <div class="alert alert-subtle-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                                role="alert" id="alert">
                                <span class="fas fa-check-cross fs-7 me-3"></span>
                                <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
                                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                                role="alert" id="alert">
                                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>