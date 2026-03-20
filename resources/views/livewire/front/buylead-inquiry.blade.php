@push('custom-meta')

    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}

    <title>Buy Leads Inquiry - Connect with Verified Suppliers & Start B2B Trade | GFE Worldwide</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Submit your buy leads inquiry and connect with verified suppliers globally. Simplify your B2B procurement process and grow your business with GFE Worldwide’s trusted trade platform.">

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="buy leads inquiry, submit buy leads, verified suppliers, B2B procurement, supplier inquiry form, global trade leads, GFE Worldwide, B2B trade platform, business leads inquiry, import-export business">

    <!-- Canonical Tag -->
    <link rel="canonical" href="https://www.gfeworldwide.com/buylead-inquiry">

    <!-- Open Graph / Facebook -->
    <meta property="og:title"
        content="Buy Leads Inquiry - Connect with Verified Suppliers & Start B2B Trade | GFE Worldwide">
    <meta property="og:description"
        content="Submit your buy leads inquiry and access a network of verified suppliers. Streamline your B2B procurement with GFE Worldwide’s trusted platform.">
    <meta property="og:url" content="https://www.gfeworldwide.com/buylead-inquiry">
    <meta property="og:image" content="https://www.gfeworldwide.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="Buy Leads Inquiry - Connect with Verified Suppliers & Start B2B Trade | GFE Worldwide">
    <meta name="twitter:description"
        content="Submit your buy leads inquiry and connect with verified suppliers globally. Grow your business with GFE Worldwide’s trusted B2B platform.">
    <meta name="twitter:image" content="https://www.gfeworldwide.com/assets/img/icons/gfe.svg">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

@endpush


<div>
    <livewire:front.layout.header />

    <div class="container py-5">

        <form class="p-4 rounded-4  bg-white bg-opacity-75 backdrop-blur-md" wire:submit.prevent="submit"
            enctype="multipart/form-data">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">📩 BuyLead Inquiry</h2>
                <p class="text-muted">Please fill out the form below to send your inquiry.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-lg-8">

                    <!-- Product Name -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="productName" placeholder="Product Name"
                            wire:model="product_name">
                        <label for="productName">Product Name</label>
                        @error('product_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Email" wire:model="email">
                        <label for="email">Email address</label>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-floating mb-4">
                        <input type="tel" class="form-control" id="phonenumber" placeholder="Mobile Number"
                            wire:model="phonenumber">
                        <label for="phonenumber">Mobile Number</label>
                        @error('phonenumber')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="companyName" placeholder="Company Name"
                            wire:model="company_name">
                        <label for="companyName">Company Name</label>
                        @error('company_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-lg btn-primary px-5 rounded-pill">
                            <i class="fa fa-paper-plane me-2"></i> Send Inquiry
                        </button>
                    </div>
                </div>
            </div>

            <!-- Success Alert -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 z-3 shadow"
                    role="alert" style="min-width: 300px;">
                    <i class="fa-solid fa-circle-check me-2 text-success"></i>
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </form>
    </div>

    <livewire:front.layout.footer />


</div>