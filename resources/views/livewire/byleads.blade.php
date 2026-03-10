@push('custom-meta')
    <title>Buy High-Quality Leads & Grow Your Business</title>

    <meta name="title" content="Buy High-Quality Leads & Grow Your Business">

    <meta name="description"
        content="Get targeted, verified leads to boost sales and maximize conversions. Buy leads that drive real business growth today!">

    <meta name="keywords"
        content="Globpulse,globpulse,Buy leads, targeted leads, business leads, lead generation, quality leads, sales leads, B2B leads, verified leads, customer acquisition,grow business">

    <meta property="og:title" content="Buy B2B Leads | Globpulse - Premium Lead Generation Services for Business Growth">
    <meta property="og:description"
        content="Discover and buy high-quality, verified B2B leads for your business with Globpulse. Our lead generation services connect you with targeted prospects to help boost your sales and expand your market reach.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.globpulse.com/byleads">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/Globpulse.png">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Buy B2B Leads | Globpulse - Premium Lead Generation Services for Business Growth">
    <meta name="twitter:description"
        content="Discover and buy high-quality, verified B2B leads for your business with Globpulse. Our lead generation services connect you with targeted prospects to help boost your sales and expand your market reach.">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

    <!-- Canonical -->
    <link rel="canonical" href="https://www.globpulse.com/byleads" />
@endpush


<div>

    <livewire:front.layout.header />

    <!-- <section> begin ============================-->
    <section class="py-5">
        <div class="container-fluid">
            <!-- Mobile Filter Button -->
            {{-- <div class="mb-4 d-lg-none text-end">
                <button class="btn btn-outline-primary btn-sm shadow-sm" data-phoenix-toggle="offcanvas"
                    data-phoenix-target="#productFilterColumn">
                    <i class="fa-solid fa-filter me-2"></i>Filter
                </button>
            </div> --}}

            <!-- Section Title -->
            <div class="gp-hero-unique text-center mb-5">
                <div class="gp-glow-bg"></div>

                <h1 class="gp-unique-title">
                    Connect with Global Suppliers & Discover
                    <span>Verified B2B Buy Leads</span>
                    {{-- <strong>GlobPulse</strong> --}}
                </h1>

                <p class="gp-unique-subtext mx-auto">
                    Explore verified B2B buy leads and connect with global wholesale suppliers on GlobPulse.
                    Post buy requirements and grow your business faster with trusted trade connections.
                </p>
            </div>
            <style>
                /* Unique Background Floating Light */
                .gp-hero-unique {
                    position: relative;
                    padding: 40px 20px;
                    overflow: hidden;
                }

                .gp-glow-bg {
                    position: absolute;
                    top: -80px;
                    left: 50%;
                    width: 500px;
                    height: 500px;
                    /* background: radial-gradient(circle, rgba(0, 123, 255, 0.35), transparent 70%); */
                    transform: translateX(-50%);
                    animation: floatGlow 6s ease-in-out infinite alternate;
                    filter: blur(50px);
                    z-index: -1;
                }

                @keyframes floatGlow {
                    0% {
                        transform: translateX(-50%) translateY(0);
                    }

                    100% {
                        transform: translateX(-50%) translateY(40px);
                    }
                }

                /* Title Styling */
                .gp-unique-title {
                    font-size: 42px;
                    font-weight: 800;
                    line-height: 1.3;
                    color: #111;
                    animation: fadeUp 1.2s ease-out forwards;
                    opacity: 0;
                }

                .gp-unique-title span {
                    display: block;
                    font-weight: 700;
                    color: #0066ff;
                }

                .gp-unique-title strong {
                    display: block;
                    font-size: 48px;
                    color: #ff6a00;
                }

                /* Neon Gradient Underline */
                .gp-unique-title::after {
                    content: "";
                    width: 110px;
                    height: 5px;
                    margin: 15px auto 0;
                    display: block;
                    border-radius: 5px;
                    background: linear-gradient(90deg, #0066ff, #ff6a00);
                    filter: drop-shadow(0 0 8px rgba(255, 102, 0, 0.8));
                    animation: glowLine 2s ease-in-out infinite alternate;
                }

                @keyframes glowLine {
                    from {
                        filter: drop-shadow(0 0 4px rgba(255, 102, 0, 0.3));
                    }

                    to {
                        filter: drop-shadow(0 0 14px rgba(255, 102, 0, 0.9));
                    }
                }

                /* Subtext */
                .gp-unique-subtext {
                    max-width: 850px;
                    margin-top: 22px;
                    font-size: 18px;
                    color: #555;
                    opacity: 0;
                    animation: fadeUp 1.6s ease-out forwards;
                }

                /* Fade-Up Animation */
                @keyframes fadeUp {
                    from {
                        opacity: 0;
                        transform: translateY(25px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style>

            <!-- Buy Leads List -->
            <div class="row g-3">

                @if ($postrequirments->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="text-muted">No buy leads found matching your search.</h5>
                    </div>
                @else
                    @foreach ($postrequirments as $item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                            <div class="card h-100 border-2 shadow-lg rounded-4 overflow-hidden bg-white position-relative transition-all"
                                style="transition: transform 0.3s;">
                                <div class="card-body p-4 d-flex flex-column justify-content-between  position-relative">

                                    <!-- Product Title -->
                                    <div class="mb-2">
                                        <h3 class="fw-bold fs-8 text-primary mb-1">
                                            <i class="fa-solid fa-box-open me-1"></i>
                                            Looking for {{ $item->product_name }}
                                        </h3>
                                    </div>
                                    <!-- Location & Date -->
                                    <div
                                        class="d-flex justify-content-between align-items-center small text-secondary mb-3 pb-2 border-bottom border-dashed">
                                        <span>
                                            <i class="fa-solid fa-location-dot me-1 text-danger"></i>
                                            {{ $item->location }}
                                        </span>
                                        <span>
                                            <i class="fa-regular fa-clock me-1 text-warning"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <!-- Buyer Info -->
                                    <div class="mb-3">
                                        <ul class="list-unstyled small">
                                            <li class="mb-1">
                                                <strong class="text-dark">Buyer:</strong>
                                                {{ substr($item->customer?->company, 0, 2) . '**' . substr($item->customer?->company, -1) }}
                                            </li>
                                            <li class="mb-1">
                                                <strong class="text-dark">Phone:</strong>
                                                {{ substr($item->mobile, 0, 3) . '*****' . substr($item->mobile, -2) }}
                                            </li>
                                            <li class="mb-1">
                                                <strong class="text-dark">Qty:</strong> {{ $item->quantity }}
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Contact Button -->
                                    <div class="mt-auto">
                                        @if ($item->customer)
                                            <a href="{{ route('buylead-inquiry', ['customer_id' => $item->customer->id, 'postbyrequirement_id' => $item->id]) }}"
                                                class="btn btn-sm btn-primary w-100 rounded-pill shadow-sm">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Contact Buyer
                                            </a>
                                        @else
                                            <div class="text-danger text-center small">Customer Not Found</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <style>
                            .card:hover {
                                transform: translateY(-6px);
                                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                            }
                        </style>

                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            @if ($showPagination)
                <div class="d-flex justify-content-center align-items-center mt-5">
                    @if ($page > 1)
                        <button class="btn btn-outline-primary btn-sm me-2"
                            wire:click="$set('page', {{ $page - 1 }})">&laquo;</button>
                    @endif

                    <div class="d-flex gap-2 flex-wrap">
                        @php
                            $startPage = max(1, $page - 1);
                            $endPage = min($totalPages, $page + 1);
                        @endphp

                        @if ($page > 2)
                            <button class="btn btn-sm btn-outline-secondary"
                                wire:click="$set('page', {{ $page - 1 }})">{{ $page - 1 }}</button>
                        @endif

                        <button class="btn btn-sm btn-primary">{{ $page }}</button>

                        @if ($page < $totalPages - 1)
                            <button class="btn btn-sm btn-outline-secondary"
                                wire:click="$set('page', {{ $page + 1 }})">{{ $page + 1 }}</button>
                        @endif
                    </div>

                    @if ($page < $totalPages)
                        <button class="btn btn-outline-primary btn-sm ms-2"
                            wire:click="$set('page', {{ $page + 1 }})">&raquo;</button>
                    @endif
                </div>
            @endif
        </div>
    </section>
    <style>
        .hover-effect {
            transition: all 0.3s ease;
        }

        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
    </style>

    <!-- <section> close ============================-->

    @if (session()->has('message'))
        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="alert">
            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <livewire:front.layout.footer />

</div>