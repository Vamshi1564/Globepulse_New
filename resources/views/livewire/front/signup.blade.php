@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}

    <title>Join GlobPulse – The Best B2B Platform for Trusted Connections</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Create your free account today and connect with trusted global suppliers and buyers. Kickstart your wholesale business growth now.
            ">

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="best b2b platform, wholesale marketplace, global suppliers, trusted buyers, connect suppliers and buyers, b2b wholesale, grow wholesale business, verified suppliers, global b2b network, wholesale partnerships, business growth, free b2b platform, online b2b marketplace">

    <!-- Canonical Tag -->
    <link rel="canonical" href="https://www.globpulse.com/signup">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Sign Up for GFE Globpulse - Start Your B2B Trade Journey Today">
    <meta property="og:description"
        content="Register with GFE Globpulse to connect with suppliers and buyers globally. Join our platform to streamline your B2B trade process and expand your business.">
    <meta property="og:url" content="https://www.globpulse.com/signup">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Sign Up for GFE Globpulse - Start Your B2B Trade Journey Today">
    <meta name="twitter:description"
        content="Create an account with GFE Globpulse to access global B2B trade opportunities. Connect with verified suppliers and buyers to grow your business.">
    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">

    <!-- Robots -->
    <meta name="robots" content="index, follow">
@endpush

<div>

    <livewire:front.layout.header />


    {{-- <main class="main" id="top"> --}}
    <div class="container py-5">
        <div class="rounded">
            <div class="d-flex justify-content-center rounded">


                <div class="col-lg-5 d-none d-lg-flex align-items-center rounded"
                    style="background: linear-gradient(rgba(11, 11, 11, 0.249), rgba(7, 7, 7, 0.249)), url('../../../assets/img/signup-1.jpg') no-repeat center center; background-size: cover;">
                    <div class="p-5 text-white">

                        <h2 class="display-6 fw-bold mb-3 text-white">Join GlobPulse Today</h2>
                        <p class="lead">Connect with thousands of verified suppliers and buyers worldwide to
                            grow your B2B business.</p>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Verified business
                                partners</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Global trade network
                            </li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Secure transactions
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Right Section (Form) -->
                <div class="col-lg-6 p-5 bg-white">
                    <h2 class="text-center fw-bold mb-4">Create your account</h2>

                    <form wire:submit.prevent="submit">
                        <!-- Full Name -->
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" id="name" class="form-control" wire:model="name"
                                placeholder="Enter Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div class="mb-3">
                            <label class="form-label" for="company_name">Company Name</label>
                            <input type="text" id="company_name" class="form-control" wire:model="company"
                                placeholder="Enter Company Name">
                            @error('company')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" id="email" class="form-control" wire:model="email"
                                placeholder="Enter Email Id" disabled>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Country & Mobile -->
                        {{-- <div class="row mb-3">
                            <div class="col-md-5"> --}}
                        <div class="mb-3">
                            <div wire:ignore>
                                <label class="form-label" for="country">Country</label>
                                <select class="form-select country-select" wire:model="country" id="country"
                                    style="width: 100%;">
                                    <option value="">-- Select Country --</option>
                                    @foreach ($countries as $countr)
                                        <option value="{{ $countr->country_id }}"
                                            {{ $countr->country_id == $country ? 'selected' : '' }}>
                                            {{ $countr->short_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="mb-3">
                            {{-- <div class="col-md-7"> --}}
                            <label class="form-label" for="number">Mobile Number</label>
                            <input type="tel" id="number" class="form-control" wire:model="phonenumber"
                                placeholder="Enter phone number">
                            @error('phonenumber')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            {{-- </div> --}}
                        </div>

                        <!-- Trade Role -->
                        {{-- <div class="form-group role-selection">
                                <label>I am a:</label>
                                <div class="role-options">
                                    <label class="role-option">
                                        <input type="radio" wire:model="user_type" value="Buyer">
                                        <span class="role-card">
                                            <span class="role-icon">🛒</span>
                                            <span class="role-title">Buyer</span>
                                            <span class="role-desc">Looking to import goods</span>
                                        </span>
                                    </label>

                                    <label class="role-option">
                                        <input type="radio" wire:model="user_type" value="Seller">
                                        <span class="role-card">
                                            <span class="role-icon">📦</span>
                                            <span class="role-title">Seller</span>
                                            <span class="role-desc">Looking to export goods</span>
                                        </span>
                                    </label>

                                    <label class="role-option">
                                        <input type="radio" wire:model="user_type" value="Both">
                                        <span class="role-card">
                                            <span class="role-icon">🔄</span>
                                            <span class="role-title">Both</span>
                                            <span class="role-desc">Import and export</span>
                                        </span>
                                    </label>
                                </div>
                                @error('user_type')<span class="error-message">{{ $message }}</span>@enderror
                            </div> --}}

                        <!-- Terms & Conditions -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="termsService" required>
                            <label class="form-check-label fs-9" for="termsService">
                                I accept the <a href="{{ route('term-conditions') }}"
                                    class="text-decoration-underline">Terms &
                                    Conditions</a>
                            </label>
                            @error('user_type')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary w-100 py-2">Sign Up</button>

                        <!-- Sign In -->
                        {{-- <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="fw-bold small">Already have an account? Sign
                                    in</a>
                            </div> --}}
                    </form>
                </div>
            </div>

        </div>
    </div>
    {{--
</div> --}}

    @if (session()->has('error'))
        <div class="alert alert-danger position-fixed top-0 end-0 m-3 z-3 d-flex align-items-center p-2 text-light"
            role="alert" id="alert">
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close ms-auto text-light" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success position-fixed top-0 end-0 m-3 z-3 d-flex align-items-center p-2 text-light"
            role="alert" id="alert">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn-close ms-auto text-light" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif



    <script>
        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
            navbarTop.setAttribute('data-navbar-appearance', 'darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVertical && navbarVerticalStyle === 'darker') {
            navbarVertical.setAttribute('data-navbar-appearance', 'darker');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#country').select2();

            // Sync select2 selection with Livewire
            $('#country').on('change', function(e) {
                @this.set('country', $(this).val());
            });
        });
    </script>

    {{--
</main> --}}

    <livewire:front.layout.footer />

</div>
