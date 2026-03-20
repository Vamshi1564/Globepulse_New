<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content pt-5">
            <div class="card  border-0 rounded-4 p-4">
                <div class="card-header bg-white border-0 mb-4">
                    <h3 class="mb-0 fw-bold text-center">Business Profile Details</h3>
                </div>

                <form class="needs-validation" wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        @if ($profile_image && is_object($profile_image))
                            <img class="rounded-circle" src="{{ $profile_image->temporaryUrl() }}" width="80"
                                height="80">
                        @else
                            <img class="rounded-circle shadow-sm" src="{{ config('app.pub_aws_url') . $profile_image }}"
                                width="80" height="80">
                        @endif
                        <div class="mt-3">
                            <input class="form-control d-inline-block w-auto p-1" id="file"
                                wire:model="profile_image" type="file" />
                            @error('profile_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control rounded-3" wire:model="company"
                                placeholder="Company Name">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control rounded-3" wire:model="name"
                                placeholder="Your Name">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control rounded-3" wire:model="email"
                                placeholder="example@mail.com">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Mobile Number</label>
                            <input type="number" class="form-control rounded-3" wire:model="phonenumber"
                                placeholder="Mobile Number">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Alternative Mobile</label>
                            <input type="number" class="form-control rounded-3" wire:model="alternative_mobile"
                                placeholder="Alternative">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Address</label>
                            <textarea class="form-control rounded-3" wire:model="address" rows="2" placeholder="Full Address"></textarea>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Pin Code</label>
                            <input type="text" class="form-control rounded-3" wire:model="pin_code"
                                placeholder="Pin Code">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control rounded-3" wire:model="city" placeholder="City">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control rounded-3" wire:model="country"
                                placeholder="Country">
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">GST No.</label>
                            <input type="text" class="form-control rounded-3" wire:model="gstno"
                                placeholder="GST No.">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Employee Count</label>
                            <input type="number" class="form-control rounded-3" wire:model="employeecount"
                                placeholder="Total Employees">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Annual Turnover</label>
                            <input type="text" class="form-control rounded-3" wire:model="annualturnover"
                                placeholder="Annual Turnover">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Establishment Date</label>
                            <input type="date" class="form-control rounded-3" wire:model="establishment">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Working Days</label>
                            <input type="text" class="form-control rounded-3" wire:model="workingday"
                                placeholder="Monday to Saturday">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Payment Modes</label>
                            <input type="text" class="form-control rounded-3" wire:model="paymentmode"
                                placeholder="Online/Offline">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Website URL</label>
                            <input type="text" class="form-control rounded-3" wire:model="web_url"
                                placeholder="https://">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Facebook</label>
                            <input type="text" class="form-control rounded-3" wire:model="facebook"
                                placeholder="Facebook URL">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control rounded-3" wire:model="instagram"
                                placeholder="Instagram URL">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Twitter</label>
                            <input type="text" class="form-control rounded-3" wire:model="twitter"
                                placeholder="Twitter URL">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">LinkedIn</label>
                            <input type="text" class="form-control rounded-3" wire:model="linkedin"
                                placeholder="LinkedIn URL">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <style>
            .card {
                border-radius: 1rem;
            }

            .form-label {
                font-weight: 600;
                color: #333;
            }

            .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
            }
        </style>

        {{-- @if (session()->has('message'))
            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                role="alert" id="alert">
                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif --}}

        <div class="mt-3 col-12 col-xl-8 mx-auto">
            <div>
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


    <livewire:seller.layout.footer />

</div>
