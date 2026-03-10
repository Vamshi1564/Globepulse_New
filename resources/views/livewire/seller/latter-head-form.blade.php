{{-- <div>
    <livewire:seller.layout.header />

    <div class="container-fluid pt-4">
        <div class="content m-0 p-0">

            <nav class="mb-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Letter Head</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto d-flex align-items-center gap-2">
                    <h2 class="mb-0 fw-bold">Add LetterHead</h2>
                </div>

                
            </div>
            <style>
                .form-label {
                    font-weight: 600;
                    /* font-size: 0.95rem; */
                    color: #344767;
                }

                .form-control:focus {
                    box-shadow: 0 0 0 0.15rem rgba(63, 81, 181, 0.25);
                    border-color: #3f51b5;
                }

                .card-form:hover {
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                    transition: all 0.3s ease-in-out;
                }

                .upload-preview {
                    border-radius: 0.5rem;
                    border: 1px dashed #ccc;
                    padding: 10px;
                    background: #f9f9f9;
                }

                .btn-primary {
                    background-color: #3f51b5;
                    border-color: #3f51b5;
                }

                .btn-primary:hover {
                    background-color: #303f9f;
                }
            </style>

            <div class="card card-form border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <form wire:submit.prevent="addData" enctype="multipart/form-data">

                        <div class="text-center mb-5">
                            <h4 class="fw-bold mb-2 text-primary">Create Company Letterhead</h4>
                            <p class="text-muted small mb-0">Fill in your company details to generate a professional
                                letterhead</p>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="mb-5 text-center">
                                    @if ($logo)
                                        <div class="upload-preview mb-3">
                                            <img class="img-fluid" style="max-height: 120px;"
                                                src="{{ $logo->temporaryUrl() }}">
                                        </div>
                                    @endif
                                    <label for="logo" class="form-label">Upload Company Logo</label>
                                    <input type="file" id="logo" wire:model="logo" class="form-control w-auto mx-auto">
                                    @error('logo')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label for="company_name" class="form-label">Company Name</label>
                                        <input type="text" wire:model="company_name" class="form-control"
                                            id="company_name" placeholder="Ex: Impexperts Pvt. Ltd.">
                                        @error('company_name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="company_address" class="form-label">Company Address</label>
                                        <textarea wire:model="company_address" class="form-control" id="company_address"
                                            rows="3" placeholder="Ex: 123, Business Hub, Gujarat, India"></textarea>
                                        @error('company_address')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="web_link" class="form-label">Website URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text">https://</span>
                                            <input type="text" wire:model="web_link" class="form-control" id="web_link"
                                                placeholder="yourcompany.com">
                                        </div>
                                        @error('web_link')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="company_email" class="form-label">Company Email</label>
                                        <input type="email" wire:model="company_email" class="form-control"
                                            id="company_email" placeholder="info@yourcompany.com">
                                        @error('company_email')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone_no" class="form-label">Mobile Number</label>
                                        <input type="tel" wire:model="phone_no" class="form-control" id="phone_no"
                                            placeholder="+91 9876543210">
                                        @error('phone_no')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button class="btn btn-primary px-4 py-2 rounded-pill" type="submit">
                                        <i class="fas fa-save me-2"></i>Save Letterhead
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show position-fixed top-3 start-50 translate-middle-x shadow"
                    style="z-index: 1050; min-width: 300px;" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show position-fixed top-3 start-50 translate-middle-x shadow"
                    style="z-index: 1050; min-width: 300px;" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <livewire:seller.layout.footer />
</div> --}}

<div>
    <livewire:seller.layout.header />

    <div class="container-fluid pt-4">
        {{-- <div class="content"> --}}

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Letter Head</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Add LetterHead</h2>
        </div>

        <!-- Form Card -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body p-4 p-md-5">
                <form wire:submit.prevent="addData" enctype="multipart/form-data">

                    <!-- Form Header -->
                    <div class="text-center mb-5">
                        <h4 class="fw-bold text-primary mb-2">Create Company Letterhead</h4>
                        <p class="text-muted small mb-0">Fill in your company details to generate a professional
                            letterhead</p>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <!-- Logo Upload -->
                            <div class="mb-5 text-center">
                                @if ($logo)
                                    <div class="border border-dashed rounded p-3 mb-3 bg-light">
                                        <img src="{{ $logo->temporaryUrl() }}" class="img-fluid"
                                            style="max-height: 120px;">
                                    </div>
                                @endif
                                <label for="logo" class="form-label fw-semibold">Upload Company Logo</label>
                                <input type="file" id="logo" wire:model="logo"
                                    class="form-control mx-auto d-block w-auto">
                                @error('logo')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Form Fields -->
                            <div class="row g-4">

                                <div class="col-12">
                                    <label for="company_name" class="form-label fw-semibold">Company Name</label>
                                    <input type="text" wire:model="company_name" class="form-control"
                                        id="company_name" placeholder="Ex: Impexperts Pvt. Ltd.">
                                    @error('company_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="company_address" class="form-label fw-semibold">Company Address</label>
                                    <textarea wire:model="company_address" class="form-control" id="company_address" rows="3"
                                        placeholder="Ex: 123, Business Hub, Gujarat, India"></textarea>
                                    @error('company_address')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="web_link" class="form-label fw-semibold">Website URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text">https://</span>
                                        <input type="text" wire:model="web_link" class="form-control" id="web_link"
                                            placeholder="yourcompany.com">
                                    </div>
                                    @error('web_link')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="company_email" class="form-label fw-semibold">Company Email</label>
                                    <input type="email" wire:model="company_email" class="form-control"
                                        id="company_email" placeholder="info@yourcompany.com">
                                    @error('company_email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone_no" class="form-label fw-semibold">Mobile Number</label>
                                    <input type="tel" wire:model="phone_no" class="form-control" id="phone_no"
                                        placeholder="+91 9876543210">
                                    @error('phone_no')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                                    <i class="fas fa-save me-2"></i>Save Letterhead
                                </button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x shadow mt-3"
                style="z-index:1050; min-width:300px;" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x shadow mt-3"
                style="z-index:1050; min-width:300px;" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
    {{-- </div> --}}

    <livewire:seller.layout.footer />
</div>
