@push('custom-meta')
    <title>GFE Business Membership Plans - Choose Your Plan for Global Trade Success</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="canonical" href="https://www.gfeworldwide.com/packages" />

    <meta name="author" content="GFE Business">

    <meta name="description"
        content="Explore GFE Business Membership Plans offering flexible options for Import Export, International Trade, and Global Business. Choose from Global Free, Combo, GSP, GSP Pro, and GBO plans to elevate your business with expert support, global trade resources, and exclusive benefits.">

    <meta name="keywords"
        content="GFE Membership Plans, Import Export Membership, International Trade Membership, Global Business Plans, GSP Pro, GBO, Global Free Plan, Combo Plan, GFE Business Membership, Export Import Networking, Global Trade Resources, Business Support Plans">

    <meta property="og:title" content="GFE Business Membership Plans - Choose Your Plan for Global Trade Success">
    <meta property="og:description"
        content="Get access to exclusive benefits with GFE Business Membership Plans. Whether you choose Global Free, Combo, GSP, GSP Pro, or GBO, each plan offers tailored services to help you succeed in import-export, international trade, and global business.">
    <meta property="og:url" content="https://www.gfeworldwide.com/packages">
    <meta property="og:image" content="https://www.gfeworldwide.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="GFE Business Membership Plans - Choose Your Plan for Global Trade Success">
    <meta name="twitter:site" content="@gfebusiness">
    <meta name="twitter:description"
        content="Access the best membership plans from GFE Business to boost your import-export and international trade operations. Choose from Global Free, Combo, GSP, GSP Pro, or GBO for exclusive resources and expert support.">
    <meta name="twitter:image" content="https://www.gfeworldwide.com/assets/img/icons/gfe.svg">
    <meta name="twitter:image:alt" content="GFE Business">

    <link rel="dns-prefetch" href="https://www.gfeworldwide.com/">
@endpush


<div>
    <livewire:seller.layout.header />

    {{-- ----------- START Table View Packages -------- --}}

    <div class="container ">

        <div class="my-5 ">
            <div class="table-responsive scrollbar rounded-2 ">
                <!-- FULLY NEW DIFFERENT PREMIUM UI WITH ANIMATED BACKGROUND -->
                @if ($package)
                    <style>
                        /* Animated gradient background */
                        .animated-bg {
                            background: linear-gradient(135deg, #ffb74d, #ff9f43, #ffcc80);
                            background-size: 400% 400%;
                            animation: gradientMove 10s ease infinite;
                        }

                        @keyframes gradientMove {
                            0% {
                                background-position: 0% 50%;
                            }

                            50% {
                                background-position: 100% 50%;
                            }

                            100% {
                                background-position: 0% 50%;
                            }
                        }

                        /* Floating shapes */
                        .float-shape {
                            position: absolute;
                            width: 80px;
                            height: 80px;
                            background: rgba(255, 255, 255, 0.25);
                            border-radius: 20px;
                            animation: float 6s ease-in-out infinite;
                        }

                        @keyframes float {
                            0% {
                                transform: translateY(0px);
                            }

                            50% {
                                transform: translateY(-18px);
                            }

                            100% {
                                transform: translateY(0px);
                            }
                        }
                    </style>

                    <div class="  animated-bg rounded-4 shadow-lg p-2 p-md-4 position-relative" style="overflow:hidden;">

                        <!-- Floating Decorations -->
                        <div class="float-shape" style="top:20px; left:-25px;"></div>
                        <div class="float-shape"
                            style="bottom:20px; right:-25px; width:60px; height:60px; border-radius:15px;"></div>

                        <!-- HEADER CARD -->
                        <div class="text-center bg-white shadow rounded-4 p-4 mb-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="col-12 col-md-8">
                                    <h2 class="fw-bold text-dark mb-1 text-start">{{ $package->package_title }}</h2>
                                    <p class="text-muted mb-2 text-start">{{ $package->subtitle }}</p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div
                                        class=" bg-dark text-white px-2 py-2 w-lg-50 mx-auto rounded-pill fw-bold fs-9 fs-md-8 shadow-sm">
                                        @if ($package->rate > 0)
                                            ₹ {{ number_format($package->rate, 2) }}
                                        @else
                                            FREE
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- FEATURES SECTION -->
                        <div class="bg-white shadow-sm rounded-4 p-2 p-md-4">
                            @php $groupedPoints = $package->points->groupBy('category'); @endphp

                            @forelse($groupedPoints as $category => $points)

                                <div class="p-3 p-md-3 mb-4 rounded-4 border" style="background:#f8f9fc;">
                                    <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                        <i class="fas fa-bolt text-warning me-2"></i>
                                        {{ ucfirst($category) }}
                                    </h6>

                                    @foreach ($points as $p)
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="me-2 text-success fs-7">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <span class="fw-semibold text-dark ">{{ $p->point }}</span>
                                        </div>
                                    @endforeach
                                </div>

                            @empty
                                <div class="text-center py-4">No features found.</div>
                            @endforelse
                        </div>
                    </div>

                @else
                    <div class="alert alert-warning text-center">No active package found.</div>
                @endif


            </div>
        </div>
    </div>




    <livewire:seller.layout.footer />

</div>