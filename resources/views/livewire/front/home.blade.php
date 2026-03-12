@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Globpulse, India B2B Marketplace for Wholesale, Import & Export</title>

    <!-- Meta Description -->
    <meta name="description"
        content=" Join Globpulse — India’s trusted B2B marketplace for suppliers, manufacturers, and exporters. Explore import-export opportunities and grow your wholesale business online." />

    <!-- Meta Keywords (Optional) -->
    <meta name="keywords"
        content=" globpulse, india b2b marketplace, b2b portals, import export websites, wholesale business, b2b websites in india, wholesale buy, b2b wholesale app, online wholesale market, exporters in india, retailers in india, manufacturers in india, b2b wholesale suppliers, india import export, global wholesale trade, wholesale suppliers marketplace, bulk products india, b2b trade platform" />

    <!-- Robots -->
    <meta name="robots" content="index, follow" />

    <!-- Canonical -->
    <link rel="canonical" href="https://www.globpulse.com" />

    <!-- Open Graph Meta Tags (For Social Sharing) -->
    <meta property="og:title" content=" Globpulse, India B2B Marketplace for Wholesale, Import & Export  " />
    <meta property="og:description"
        content="Join Globpulse — India’s trusted B2B marketplace for suppliers, manufacturers, and exporters. Explore import-export opportunities and grow your wholesale business online." />

    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/globpluse.jpg" />
    <meta property="og:url" content="https://www.globpulse.com" />
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Globpulse Mart" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content=" Globpulse, India B2B Marketplace for Wholesale, Import & Export  ">
    <meta name="twitter:description"
        content="Join Globpulse — India’s trusted B2B marketplace for suppliers, manufacturers, and exporters. Explore import-export opportunities and grow your wholesale business online.">

    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/Globpulse.png">
    <meta name="author" content="Globpulse">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
@endpush

<div>
    <main class="main bg-white mt-0 pt-0" id="top">
        <section class="mobi-scree  p-0 m-0">
            <livewire:front.layout.header2 />


            <div class="container ">
                <div class="py-5" style="background: none">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-7">
                            <div class="banner-text text-start text-md-start" data-bs-theme="light">

                                <h1 class="fw-bolder mb-3" style="font-size: 2.2rem; line-height:1.3; color: #ffffff;">
                                    India’s <span class="b2b-title">#1 B2B Marketplace</span>

                                    <span class="gradient-text d-block" style="font-size: 2rem;">
                                        for Export - Import & Wholesale Trade <br>
                                        Connect Exporters
                                    </span>
                                </h1>

                                <h4 class="text-white mb-4 d-flex gap-3 flex-wrap" style="font-size: 1rem;">
                                    <span><span class="check">•</span> Manufacturers</span>
                                    <span><span class="check">•</span> Global Buyers</span>
                                    <span><span class="check">•</span> Importers</span>
                                </h4>


                                <h4 class="text-white">Explore Business Opportunities</h4>

                                <div class="hero-cta-clean mt-4">

                                    <a href="https://gfebusiness.org/" target="_blank" class="clean-btn">
                                        <i class="fas fa-ship"></i>
                                        Start Your Import & Export Business
                                    </a>

                                    <a href="https://www.gfebusiness.org/ecommerce-business-setup/" target="_blank"
                                        class="clean-btn">
                                        <i class="fas fa-shopping-cart"></i>
                                        Start Your E-Commerce Business
                                    </a>

                                    <a href="https://www.gfeworld.org/" target="_blank" class="clean-btn">
                                        <i class="fas fa-passport"></i>
                                        Apply For Any Country Visa
                                    </a>

                                    {{-- <a href="javascript:void(0)" class="clean-btn" data-bs-toggle="modal"
                                        data-bs-target="#chaModal">
                                        <i class="fas fa-file-signature"></i>
                                        Apply For CHA Services
                                    </a> --}}


                                </div>
                            </div>
                        </div>


                        <div class="col-md-5 mt-5 mt-md-0">
                            <div class="row g-4 align-items-stretch">

                                <!-- CARD 1 -->
                                <div class="col-12">
                                    <div class="card-box d-flex flex-column text-white rounded-4 p-5 h-100" style="
                min-height: 190px;
                background-image:
                linear-gradient(rgba(20, 19, 19, 0.45), rgba(30, 29, 29, 0.45)),
                url(../../assets/img/c-10000.png);
                background-size: cover;
                background-position: top;
            ">
                                        <div class="mb-5">
                                            <h3 class="fw-bold text-white">Looking for Products?</h3>
                                            <p>Get verified suppliers and competitive <br> quotes instantly.</p>
                                        </div>

                                        <a href="{{ session()->has('id') ? route('postbyrequirement') : route('login') }}"
                                            class="btn bg-light text-dark rounded-4 px-4 py-2 mt-auto align-self-start">
                                            Post Buy Requirements
                                        </a>
                                    </div>
                                </div>

                                <!-- CARD 2 -->
                                <div class="col-12">
                                    <div class="card-box d-flex flex-column text-white rounded-4 p-5 h-100" style="
                min-height: 190px;
                background-image:
                linear-gradient(rgba(23, 23, 23, 0.45), rgba(26, 25, 25, 0.45)),
                url(../../assets/img/c-20000.png);
                background-size: cover;
                background-position: center;
            ">
                                        <div class="mb-5">
                                            <h3 class="fw-bold text-white">Boost Your Sales</h3>
                                            <p>Showcase your products and scale your <br> business globally.</p>
                                        </div>

                                        <a href="{{ session()->has('id') ? route('product_add') : route('signup') }}"
                                            class="btn bg-light text-dark rounded-4 px-4 py-2 mt-auto align-self-start">
                                            Sell on Globpulse
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


        <style>
            .hero-cta-clean {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
            }

            /* BASE BUTTON */
            .clean-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                font-size: 14.5px;
                font-weight: 600;
                color: #ffffff;
                text-decoration: none;

                background: rgba(155, 152, 198, 0.46);
                backdrop-filter: blur(6px);
                -webkit-backdrop-filter: blur(6px);

                border: 1px solid rgba(255, 255, 255, 0.4);
                border-radius: 12px;

                transition:
                    background .3s ease,
                    /* box-shadow .3s ease, */
                    transform .3s ease;
            }

            /* ICON */
            .clean-btn i {
                color: #0ea5e9;
                font-size: 15px;
            }

            /* HOVER */
            .clean-btn:hover {
                background: rgba(255, 255, 255, 0.4);
                transform: translateY(-2px);
                /* box-shadow:0 8px 20px rgba(0,0,0,0.12); */
            }

            /* ACTIVE */
            .clean-btn:active {
                transform: translateY(0);
            }

            /* MOBILE */
            @media(max-width:600px) {
                .clean-btn {
                    font-size: 14px;
                    padding: 9px 12px;
                }
            }

            .cha-modal {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .55);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 999999;
            }

            /* BOX */
            .cha-box {
                background: #fff;
                width: 92%;
                max-width: 520px;
                max-height: 85vh;
                /* 👈 mobile height control */
                padding: 22px;
                border-radius: 14px;
                position: relative;
                overflow-y: auto;
                /* 👈 only form scroll */
                animation: fadeUp .25s ease;
            }

            @keyframes fadeUp {
                from {
                    transform: translateY(20px);
                    opacity: 0
                }

                to {
                    transform: translateY(0);
                    opacity: 1
                }
            }

            /* CLOSE */
            .cha-close {
                position: sticky;
                top: 0;
                float: right;
                font-size: 20px;
                cursor: pointer;
                background: #fff;
            }

            /* TITLE */
            .cha-box h3 {
                font-size: 16.5px;
                margin-bottom: 2px;
                font-weight: 700;
            }

            .cha-sub {
                font-size: 12px;
                color: #666;
                margin-bottom: 14px;
            }

            /* GRID */
            .cha-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            /* INPUT */
            .cha-grid input,
            .cha-grid select {
                padding: 9px 10px;
                border-radius: 8px;
                border: 1px solid #ddd;
                font-size: 13px;
            }

            /* MOBILE */
            @media(max-width:600px) {
                .cha-grid {
                    grid-template-columns: 1fr;
                }
            }

            /* BTN */
            .cha-btn {
                margin-top: 14px;
                width: 100%;
                padding: 11px;
                background: #0d6efd;
                border: none;
                border-radius: 9px;
                color: #fff;
                font-size: 14px;
                font-weight: 600;
            }
        </style>

        <style>
            .mobi-scree {
                background: linear-gradient(rgba(0, 0, 0, 0.53), rgba(0, 0, 0, 0.571)), url(../../../assets/img/b-1100.png);
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            @media(max-width:576px) {
                .mobi-scree {
                    background: linear-gradient(rgba(0, 0, 0, 0.291), rgba(0, 0, 0, 0.209)), url(../../../assets/img/b-1100.png);
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            }
        </style>

        <div class="container-fluid">
            <div class=" ">


                <!-- --------Categories----------- -->

                <style>
                    .cat-size {
                        width: 140px;
                        margin: 0 auto;
                        margin-bottom: 10px;
                    }
                </style>
                <!-- Category Section -->



                <!-- Gulfood Notification Popup -->
                <div id="gulfoodPopup" class="gulfood-popup">
                    <button class="close-btn bg-white p-1 rounded" onclick="closeGulfoodPopup()"><i
                            class="fa-solid fa-xmark"></i></button>

                    <a href="https://wa.me/917041791779?text=Hello%20I’m%20interested%20in%20joining%20Canton%20Fair.%20Could%20you%20please%20share%20the%20further%20details"
                        target="_blank">
                        <img src="assets/img/cantonfair.png" alt="Canton-Fair 2026">
                    </a>


                    <p>
                        Join GFE at the 139th Canton Fair – China 2026
                        Connect with global suppliers, explore sourcing opportunities, and grow your import-export
                        business with expert support.
                    </p>
                </div>
                <style>
                    .gulfood-popup {
                        position: fixed;
                        bottom: 20px;
                        right: 20px;
                        width: 320px;
                        background: #ffffff;
                        border-radius: 14px;
                        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
                        padding: 15px;
                        z-index: 9999;
                        display: none;
                        animation: slideUp 0.6s ease;
                    }

                    .gulfood-popup img {
                        width: 100%;
                        border-radius: 10px;
                        margin-bottom: 10px;
                    }

                    .gulfood-popup p {
                        font-size: 14px;
                        color: #333;
                        line-height: 1.5;
                        margin: 0;
                    }

                    .gulfood-popup .close-btn {
                        position: absolute;
                        top: 2px;
                        right: 6px;
                        border: none;
                        background: none;
                        font-size: 18px;
                        cursor: pointer;
                        color: #000;
                    }

                    @keyframes slideUp {
                        from {
                            transform: translateY(30px);
                            opacity: 0;
                        }

                        to {
                            transform: translateY(0);
                            opacity: 1;
                        }
                    }
                </style>

                <script>
                    window.addEventListener("load", function () {
                        setTimeout(function () {
                            document.getElementById("gulfoodPopup").style.display = "block";
                        }, 10000); // 10 seconds
                    });

                    function closeGulfoodPopup() {
                        document.getElementById("gulfoodPopup").style.display = "none";
                    }
                </script>






                <section class="category-section m-0 p-0 pb-5 bg-white rounded-2">
                    <div class="container-fluid">
                        <div class="pt-5 text-start section-title1">
                            <h3>Wide Range of Product Categories</h3>
                        </div>

                        <style>
                            .section-title1 h3 {
                                font-size: 32px;
                                font-weight: 700;
                                position: relative;
                                display: inline-block;
                                /* padding-bottom: 12px; */
                            }
                        </style>



                        <div class="row justify-content-between pt-4 " id="categoryList">
                            @foreach ($category as $index => $item)
                                @if ($index < 7)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                        <a href="{{ route('products-category', ['categorySlug' => $item->slug]) }}"
                                            class="intent-trigger b2b-category-card">

                                            <div class="b2b-icon">
                                                @if ($item->main_cat_img)
                                                    <img src="{{ rtrim(env('PUB_SHOW_AWS_URL'), '/') . '/' . ltrim($item->main_cat_img, '/') }}"
                                                        alt="{{ $item->cat_name }}">
                                                @else
                                                    <i class="{{ $item->icon_class }}"></i>
                                                @endif
                                            </div>

                                            <h5 class="b2b-title1">
                                                {{ $item->cat_name }}
                                                <i class="fa-solid fa-arrow-right"></i>


                                            </h5>

                                            <p class="b2b-desc">
                                                {{ Str::limit($item->description ?? 'Explore verified suppliers and products', 70) }}
                                            </p>

                                        </a>
                                    </div>
                                @elseif ($index == 28)
                                    {{-- <div class="category-card ">
                                        <div class="image-container bg-white">
                                            <i class="fas fa-ellipsis-h text-primary fs-4"></i>
                                        </div>
                                        <p class="category-name">More</p>
                                    </div> --}}





                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                        <a href="javascript:void(0);" onclick="showAllCategories()"
                                            class="category-link b2b-category-card">


                                            <div class="b2b-icon">
                                                @if ($item->main_cat_img)
                                                    <h4 class="m-0">+28</h4>
                                                @else
                                                    <i class="{{ $item->icon_class }}"></i>
                                                @endif
                                            </div>

                                            <h5 class="b2b-title1">
                                                More
                                                <i class="fa-solid fa-arrow-right"></i>

                                            </h5>

                                            <p class="b2b-desc">
                                                {{ Str::limit($item->description ?? 'Explore verified suppliers and products', 70) }}
                                            </p>

                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Modal -->
                <div id="categoryModal" class="category-modal">
                    <div class="category-modal-content">
                        <span class="category-modal-close" onclick="closeCategoryModal()">&times;</span>
                        <h5 class="mb-3">All Categories</h5>
                        <div class="row g-3">
                            @foreach ($category as $item)
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                                    <a href="{{ route('products-category', ['categorySlug' => $item->slug]) }}"
                                        class="category-link">
                                        <div class="category-card">
                                            <div class="image-container">
                                                @if ($item->main_cat_img)
                                                    <img src="{{ config('app.pub_aws_url') . $item->main_cat_img }}" {{-- {{
                                                        config('app.pub_aws_url') . $item->main_cat_img }} --}}
                                                    alt="{{ $item->cat_name }}">
                                                @else
                                                    <span class="icon {{ $item->icon_class }} fs-3 text-primary"></span>
                                                @endif
                                            </div>
                                            <p class="category-name">{{ $item->cat_name }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- CSS -->
                <style>
                    .b2b-category-card {
                        display: block;
                        background: #ECFAE5;
                        border: 1px solid #e6eaf2;
                        border-radius: 14px;
                        padding: 18px;
                        height: 100%;
                        text-decoration: none;
                        transition: all 0.25s ease;
                    }

                    .b2b-category-card:hover {
                        border-color: #1a73e8;
                        box-shadow: 0 10px 28px rgba(26, 115, 232, 0.12);
                        transform: translateY(-4px);
                        text-decoration: none;
                    }

                    /* ICON */
                    .b2b-icon {
                        width: 48px;
                        height: 48px;
                        border-radius: 10px;
                        background: #ffffff;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-bottom: 14px;
                    }

                    .b2b-icon img {
                        width: 48px;
                        height: 48px;
                        border-radius: 10px;
                        object-fit: contain;
                    }

                    .b2b-icon i {
                        font-size: 20px;
                        color: #111827;
                    }

                    /* TITLE */
                    .b2b-title1 {
                        font-size: 16px;
                        font-weight: 600;
                        color: #111827;
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        margin-bottom: 8px;
                    }

                    .b2b-title1 span {
                        font-size: 14px;
                        transition: transform 0.3s ease;
                    }

                    .b2b-category-card:hover .b2b-title1 span {
                        transform: translateX(4px);
                    }

                    /* DESCRIPTION */
                    .b2b-desc {
                        font-size: 13px;
                        color: #6b7280;
                        line-height: 1.5;
                        margin: 0;
                    }


                    .image-container {
                        border: solid 2px rgb(29, 140, 244);
                    }

                    .category-link {
                        text-decoration: none;
                    }

                    .image-container {
                        width: 70px;
                        height: 70px;
                        background-color: #fff;
                        border-radius: 10px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin: auto auto 10px auto;
                        overflow: hidden;
                        /* border: 1px solid #ddd; */
                    }

                    .image-container img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .more-bg {
                        background-color: #eef5fc;
                    }

                    .category-name {
                        font-size: 13px;
                        font-weight: 500;
                        color: #222;
                        margin-bottom: 0;
                    }

                    /* Modal */
                    .category-modal {
                        display: none;
                        position: fixed;
                        z-index: 9999;
                        top: 0;
                        left: 0;
                        height: 100%;
                        width: 100%;
                        background-color: rgba(0, 0, 0, 0.6);
                        justify-content: center;
                        align-items: center;
                        padding: 15px;
                    }

                    .category-modal-content {
                        background-color: #fff;
                        width: 100%;
                        max-width: 1100px;
                        max-height: 90vh;
                        overflow-y: auto;
                        border-radius: 12px;
                        padding: 20px;
                        position: relative;
                    }

                    .category-modal-close {
                        position: absolute;
                        top: 10px;
                        right: 20px;
                        font-size: 28px;
                        font-weight: bold;
                        color: #444;
                        cursor: pointer;
                    }

                    /* Responsive Enhancements */
                    @media (max-width: 768px) {
                        .cat-size {
                            width: 120px;
                            margin: 0 auto;
                            margin-bottom: 10px;
                        }

                    }

                    @media (max-width: 576px) {
                        .category-card {
                            padding: 12px 6px;
                        }

                        .cat-size {
                            width: 120px;
                            margin: 0 auto;
                            margin-bottom: 10px;
                        }

                        .image-container {
                            width: 60px;
                            height: 60px;
                        }

                        .category-name {
                            font-size: 12px;
                        }
                    }

                    @media (max-width: 389px) {
                        .cat-size {
                            width: 90px;
                            margin: 0 auto;
                            margin-bottom: 10px;
                        }

                    }
                </style>

                <!-- JS -->
                <script>
                    function showAllCategories() {
                        document.getElementById('categoryModal').style.display = 'flex';
                    }

                    function closeCategoryModal() {
                        document.getElementById('categoryModal').style.display = 'none';
                    }

                    // Optional: close modal on outside click
                    window.onclick = function (e) {
                        const modal = document.getElementById('categoryModal');
                        if (e.target === modal) {
                            modal.style.display = 'none';
                        }
                    }
                </script>
                <!-- ------------Top Deals Today------------- -->



                <!-- Success Story Section -->
                <!-- Success Stories Section -->
                <section
                    style="background-image: url(../assets/img/bg/37.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row align-items-center">

                            <!-- LEFT CONTENT -->
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <h2 class="fw-bold"> Our Trade <br>Success Story</h2>

                                <p class="text-muted mt-3">
                                    Explore our trade success story built on real experience, verified exports, global
                                    partnerships, and trusted import export expertise worldwide.
                                </p>

                                {{-- <a href="#" class="btn btn-gradient px-4 py-2 mt-2">View More</a> --}}
                            </div>

                            <!-- RIGHT TESTIMONIALS -->
                            <div class="col-12 col-lg-7">

                                <div class="swiper testimonialSwiper">
                                    <div class="swiper-wrapper">

                                        @foreach ($successStories as $index => $story)
                                            <div class="swiper-slide">
                                                <div class="testimonial-card {{ $index % 2 == 0 ? 'ms-lg-5' : '' }}">
                                                    @php
    $name = $story->client_name ?? '';
    $words = explode(' ', trim($name));
    $initials = strtoupper(
        (isset($words[0]) ? substr($words[0], 0, 1) : '') .
        (isset($words[1]) ? substr($words[1], 0, 1) : ''),
    );
                                                    @endphp

                                                    <div class="d-flex align-items-start">

                                                        <div class="rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0 avatar" style="background:#5783e1eb;">
                                                         {{ $initials ?: '?' }}
                                                        </div>

                                                        <div>
                                                            <h6 class="mb-1 fw-semibold">
                                                                {{ $story->client_name }}
                                                            </h6>

                                                            <small class="text-muted d-block mb-1">
                                                                {{ $story->company_name }}
                                                                · {{ $story->city }}
                                                                {{ $story->state ? ', ' . $story->state : '' }}
                                                                {{ $story->country ? ', ' . $story->country : '' }}
                                                            </small>

                                                            <p class="mb-0 text-muted small">
                                                                {{ Str::limit($story->description, 100) }}
                                                            </p>
                                                        </div>

                                                        <span
                                                            class="quote-icon ms-auto {{ $index % 3 == 0 ? 'text-primary' : 'text-secondary' }}">
                                                            ❝
                                                        </span>

                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </section>

                <style>
                    .testimonial-card {
                        /* background: #fff; */
                        /* border-radius: 14px; */
                        /* padding: 18px 20px; */

                        /* box-shadow: 0 10px 30px rgba(0,0,0,0.08); */
                    }

                    .avatar {
                        width: 50px;
                        height: 50px;
                        min-width: 45px;
                        /* 🔥 mobile shrink fix */
                        min-height: 45px;
                        object-fit: cover;
                        font-size: 14px;
                    }


                    .quote-icon {
                        font-size: 22px;
                        opacity: 0.4;
                    }

                    .testimonialSwiper {
                        /* height: 320px; */
                        /* slider height */
                    }

                    .testimonial-card {
                        background: #fff;
                        border-radius: 14px;
                        padding: 18px 20px;
                        height: 100%;
                        border: 0.8px solid #f2e7e7;
                        /* box-shadow: 0 10px 30px rgba(0,0,0,0.08); */
                        position: relative;
                        border-left: #0056b3 3px solid;
                    }

                    .quote-icon {
                        font-size: 22px;
                        opacity: 0.4;
                    }

                    .btn-gradient {
                        background: linear-gradient(135deg, #ff7a18, #ffb347);
                        color: #fff;
                        border: none;
                    }

                    .btn-gradient:hover {
                        opacity: 0.9;
                    }

                    @media (max-width: 769px) {
                        .swiper {
                            display: flex !important;
                        }

                        .swiper {
                            height: 420px !important;
                        }

                        .testimonial-card {
                            min-height: 130px;
                        }
                    }
                </style>
                <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>


                <script>
                    var swiper = new Swiper(".testimonialSwiper", {
                        direction: "vertical",
                        slidesPerView: 3,
                        spaceBetween: 20,
                        loop: true,
                        autoplay: {
                            delay: 2500,
                            disableOnInteraction: false,
                        },
                        mousewheel: true,
                    });
                </script>







                <section class="py-0 ">

                    <div class=" ">
                        <div class="b2b-slider-section">

                            <div class="section-title bg-white p-2">
                                <div class="d-flex flex-between-center ">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-fire text-danger " style="color: orange"></i>
                                        <span class="fs-7 fw-bold ms-2 m-0">Trending Products</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('product') }}" class="btn-explore1">
                                            <span>Explore More</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .btn-explore1 {
                                    display: inline-flex;
                                    align-items: center;
                                    /* gap: 8px; */
                                    padding: 12px 20px;
                                    font-size: 12px;
                                    font-weight: 600;
                                    color: #ffffff;
                                    background-color: rgb(32, 84, 215);
                                    border-radius: 8px;
                                    text-decoration: none;
                                    position: relative;
                                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                                    animation: floatEffect 2s infinite ease-in-out;
                                }

                                @keyframes floatEffect {
                                    0% {
                                        transform: translateY(0);
                                    }

                                    50% {
                                        transform: translateY(-5px);
                                    }

                                    100% {
                                        transform: translateY(0);
                                    }
                                }

                                .btn-explore i {
                                    display: inline-block;
                                    animation: bounceArrow 1.5s infinite alternate ease-in-out;
                                }

                                @keyframes bounceArrow {
                                    0% {
                                        transform: translateX(0);
                                    }

                                    100% {
                                        transform: translateX(5px);
                                    }
                                }
                            </style>


                            <!-- Swiper Container -->
                            <div class="swiper-container b2b-product-slider ">
                                <div class="swiper-wrapper">
                                    @foreach ($products as $product)
                                        <div class="swiper-slide">
                                            {{-- <div class="product-card rounded-3 border">
                                                <a style="text-decoration: solid"
                                                    href="{{ $product->slug ? route('product-detail', ['slug' => $product->slug]) : '#' }}">
                                                    <div class="product-image position-relative">
                                                        @if (!empty($product->product_img))
                                                        <img class="img-fluid transition " loading="lazy"
                                                            src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                            alt="{{ $product->title ?? 'Product Image' }}" />
                                                        @else
                                                        <img class="img-fluid transition " loading="lazy"
                                                            src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="No Image Available" />
                                                        @endif
                                                    </div>

                                                    <div class="card-body border-top mt-1">
                                                        <h3 class="product-title"
                                                            style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                            {{ $product->title ?? 'N/A' }}
                                                        </h3>

                                                        <div class="price-range">
                                                            <span class="price">
                                                                {{ $product->country->currency_symbol ?? '' }}
                                                                {{ $product->min_price ?? 'N/A' }}
                                                            </span>
                                                            -
                                                            <span class="price">
                                                                {{ $product->country->currency_symbol ?? '' }}
                                                                {{ $product->max_price ?? 'N/A' }}
                                                                ({{ $product->country->currency ?? 'N/A' }})
                                                            </span>
                                                        </div>

                                                        <div class="order-info">
                                                            <span>Min Order: {{ $product->min_order ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="business-type">
                                                            <span>Business Type:
                                                                {{ $product->business_type ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <img class="p-0 m-0"
                                                                    style="width: 55px; mix-blend-mode: multiply;"
                                                                    src="{{ asset('assets/img/logos/varify.gif') }}"
                                                                    alt="Verified">
                                                            </div>
                                                            <span class="small fw-bold text-success">
                                                                @if (!empty($product->country->flag_img) &&
                                                                file_exists(public_path('assets/' .
                                                                $product->country->flag_img)))
                                                                <img class="flag" loading="lazy"
                                                                    src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                    alt="{{ $product->country->short_name ?? 'Product Image' }}" />
                                                                @else
                                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                                    alt="No Image Available" />
                                                                @endif
                                                                {{ $product->country->iso2 ?? 'N/A' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div> --}}


                                            <div class="card b2b-product-card h-100 shadow-sm border hover-lift">
                                                <div class="position-relative">
                                                    <a href="{{ $product->slug ? route('product-detail', ['slug' => $product->slug]) : '#' }}"
                                                        class="text-decoration-none">
                                                        <div
                                                            class="product-image-container position-relative overflow-hidden bg-light">
                                                            {{-- @if (!empty($product->product_img))
                                                            <img class=" product-img transition" loading="lazy"
                                                                src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                                alt="{{ $product->title ?? 'Product Image' }}" />
                                                            @else
                                                            <img class="product-img transition" loading="lazy"
                                                                src="{{ asset('assets/img/no-image.png') }}"
                                                                alt="No Image Available" />
                                                            @endif --}}

                                                            @if (!empty($product->product_img))
                                                                <img class="product-img transition" loading="lazy"
                                                                    src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                                    alt="{{ $product->title ?? 'Product Image' }}">
                                                            @else
                                                                <img class="product-img transition" loading="lazy"
                                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                                    alt="No Image Available">
                                                            @endif

                                                            <!-- Status Badge -->
                                                            @if ($product->featured)
                                                                <div class="position-absolute top-0 start-0 m-2">
                                                                    <span class="badge bg-danger">Featured</span>
                                                                </div>
                                                            @endif

                                                            <!-- Quick View Overlay -->
                                                            <div
                                                                class="quick-view-overlay d-flex align-items-center justify-content-center">
                                                                <span class="text-white fw-semibold">View
                                                                    Details</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="card-body p-2">
                                                    <!-- Product Title -->
                                                    {{-- <h3 class="product-title"
                                                        style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                        {{ $product->title ?? 'N/A' }}
                                                    </h3> --}}
                                                    <style>
                                                        .one-line-title {
                                                            white-space: nowrap;
                                                            overflow: hidden;
                                                            text-overflow: ellipsis;
                                                        }
                                                    </style>
                                                    <h3 class="product-title one-line-title"
                                                        style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                        {{ $product->title ?? 'N/A' }}
                                                    </h3>

                                                    <!-- Price Range -->
                                                    <div class="price-range mb-2">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="text-primary fw-bold fs-9">
                                                                {{ $product->country->currency_symbol ?? '' }}{{ $product->min_price ?? 'N/A' }}
                                                            </span>
                                                            @if ($product->min_price != $product->max_price)
                                                                <span class="text-muted">-</span>
                                                                <span class="text-primary fw-bold fs-9">
                                                                    {{ $product->country->currency_symbol ?? '' }}{{ $product->max_price ?? 'N/A' }}
                                                                </span>
                                                            @endif
                                                            <small class="text-muted ms-1">
                                                                ({{ $product->country->currency ?? 'N/A' }})
                                                            </small>
                                                        </div>
                                                        @if ($product->price_unit)
                                                            <small class="text-muted">/{{ $product->price_unit }}</small>
                                                        @endif
                                                    </div>

                                                    <!-- Key Information Grid -->
                                                    <div class=" mb-2">
                                                        <div class="d-flex justify-content-between mb-2">
                                                            <div class="d-flex align-items-center gap-1">
                                                                <i class="bi bi-box-seam text-muted small"></i>
                                                                <span class="text-muted small">Min Order:</span>
                                                            </div>
                                                            <span
                                                                class="fw-medium small">{{ $product->min_order ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="d-flex justify-content-between mb-2">
                                                            <div class="d-flex align-items-center gap-1">
                                                                <i class="bi bi-building text-muted small"></i>
                                                                <span class="text-muted small">Business Type:</span>
                                                            </div>
                                                            <span
                                                                class="fw-medium small">{{ $product->business_type ?? 'N/A' }}</span>
                                                        </div>

                                                        @if ($product->supply_ability)
                                                            <div class="d-flex justify-content-between">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <i class="bi bi-truck text-muted small"></i>
                                                                    <span class="text-muted small">Supply
                                                                        Ability:</span>
                                                                </div>
                                                                <span class="fw-medium">{{ $product->supply_ability }}</span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Supplier & Country Info -->
                                                    <div class="border-top pt-2">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between gap-2">
                                                                <!-- Verification Badge -->
                                                                <div class="">
                                                                    <img style="width: 55px; mix-blend-mode: multiply;"
                                                                        src="{{ asset('assets/img/logos/varify.gif') }}"
                                                                        alt=" Verified">
                                                                </div>

                                                                <!-- Country Flag -->
                                                                @if (!empty($product->country->flag_img) && file_exists(public_path('assets/' . $product->country->flag_img)))
                                                                    <img class="flag-img rounded-1" loading="lazy" width="24"
                                                                        height="16"
                                                                        src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                        alt="{{ $product->country->short_name ?? 'Country Flag' }}"
                                                                        title="{{ $product->country->name ?? 'N/A' }}" />
                                                                @else
                                                                    <img class="flag-img rounded-1" loading="lazy" width="24"
                                                                        height="16" src="{{ asset('assets/img/no-image.png') }}"
                                                                        alt="No Flag Available" />
                                                                @endif
                                                                <span
                                                                    class="small text-muted">{{ $product->country->iso2 ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>












                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="swiper-container b2b-product-slider b2b-product-sliderr3 ">
                                <div class="swiper-wrapper">
                                    @foreach ($products as $product)
                                        <div class="swiper-slide">
                                            <div class="card b2b-product-card h-100 border hover-lift">
                                                <div class="position-relative">
                                                    <a href="{{ $product->slug ? route('product-detail', ['slug' => $product->slug]) : '#' }}"
                                                        class="text-decoration-none">

                                                        <div
                                                            class="product-image-container position-relative overflow-hidden bg-light">
                                                            {{-- @if (!empty($product->product_img))
                                                            <img class="product-img transition"
                                                                src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                                alt="{{ $product->title ?? 'Product Image' }}">
                                                            @else
                                                            <img class="product-img transition"
                                                                src="{{ asset('assets/img/no-image.png') }}" alt="No Image">
                                                            @endif --}}

                                                            @if (!empty($product->product_img))
                                                                <img class="product-img transition" loading="lazy"
                                                                    src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                                    alt="{{ $product->title ?? 'Product Image' }}">
                                                            @else
                                                                <img class="product-img transition" loading="lazy"
                                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                                    alt="No Image Available">
                                                            @endif

                                                            <!-- Hover Overlay -->
                                                            <div
                                                                class="quick-view-overlay d-flex align-items-center justify-content-center">
                                                                <span class="fw-semibold text-white">View
                                                                    Details</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="card-body p-2">
                                                    <!-- Title -->
                                                    <h3 class="product-title text-truncate-2">
                                                        {{ $product->title ?? 'N/A' }}
                                                    </h3>

                                                    <!-- Price -->
                                                    <div class="price-range mb-1">
                                                        <span class="text-primary fw-bold">
                                                            {{ $product->country->currency_symbol ?? '' }}{{ $product->min_price ?? 'N/A' }}
                                                        </span>
                                                        -
                                                        <span class="text-primary fw-bold">
                                                            {{ $product->country->currency_symbol ?? '' }}{{ $product->max_price ?? 'N/A' }}
                                                        </span>
                                                        <small class="text-muted">
                                                            ({{ $product->country->currency ?? 'N/A' }})
                                                        </small>
                                                    </div>

                                                    <!-- Info -->
                                                    <div class="mb-2">
                                                        <div class="d-flex justify-content-between small">
                                                            <span class="text-muted">Min Order</span>
                                                            <span
                                                                class="fw-medium">{{ $product->min_order ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="d-flex justify-content-between small">
                                                            <span class="text-muted">Business</span>
                                                            <span
                                                                class="fw-medium">{{ $product->business_type ?? 'N/A' }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Verified + Country -->
                                                    <div class="border-top pt-2 d-flex align-items-center gap-2">
                                                        <img src="{{ asset('assets/img/logos/varify.gif') }}"
                                                            style="width:55px;mix-blend-mode:multiply" alt="Verified">

                                                        @if (!empty($product->country->flag_img))
                                                            <img class="flag-img"
                                                                src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                width="24" height="16">
                                                        @endif

                                                        <span class="small text-muted">
                                                            {{ $product->country->iso2 ?? 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>


                    <style>
                        /* Container for the entire slider section */
                        .b2b-slider-section {
                            margin: 20px auto;
                            overflow: hidden;
                        }

                        /* Header container */
                        .b2b-slider-header {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 15px 20px;
                        }

                        /* Animated Title Effect */
                        .b2b-title h3 {
                            font-size: 1.5rem;
                            font-weight: bold;
                            color: #333;
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            position: relative;
                            overflow: hidden;
                            transition: color 0.3s ease-in-out;
                        }

                        /* Title Hover Effect */
                        .b2b-title h3:hover {
                            color: #007bff;
                        }

                        /* Underline Animation */
                        .b2b-title h3::after {
                            content: "";
                            display: block;
                            width: 0;
                            height: 3px;
                            background: #007bff;
                            position: absolute;
                            bottom: -5px;
                            left: 0;
                            transition: width 0.4s ease-in-out;
                        }

                        .b2b-title h3:hover::after {
                            width: 100%;
                        }

                        /* Icon Animation */
                        .b2b-title i {
                            font-size: 1.2rem;
                            color: #007bff;
                            transform: scale(1);
                            transition: transform 0.3s ease-in-out;
                        }

                        .b2b-title h3:hover i {
                            transform: rotate(10deg) scale(1.1);
                        }

                        /* Button Styling */
                        .btn-explore {
                            display: flex;
                            align-items: center;
                            background: #007bff;
                            color: #fff;
                            padding: 10px 18px;
                            border-radius: 8px;
                            font-weight: 500;
                            text-decoration: none;
                            overflow: hidden;
                            position: relative;
                            transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
                        }

                        /* Button Hover Animation */
                        .btn-explore:hover {
                            background: #0056b3;
                            transform: scale(1.05);
                        }

                        /* Hover effect for icon */
                        .btn-explore i {
                            margin-left: 8px;
                            transition: transform 0.3s ease-in-out;
                        }

                        .btn-explore:hover i {
                            transform: translateX(4px);
                        }


                        /* Swiper slide sizing */
                        .swiper-container.b2b-product-slider {
                            padding-bottom: 30px;
                        }

                        .swiper-container.b2b-product-slider .swiper-slide {
                            width: 280px;
                        }

                        /* Product Card */
                        .product-card {
                            background: #fff;
                            cursor: pointer;
                            /* padding: 10px; */
                            border-radius: 8px;
                            overflow: hidden;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        }

                        .product-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
                        }

                        .card-image img {
                            width: 100%;
                            height: 50px;
                            object-fit: cover;
                            padding: 5px;
                        }

                        .card-body {
                            padding: 15px;
                        }

                        .card-body a {
                            text-decoration: none;
                            color: #333;
                        }

                        .product-title {
                            font-size: 16px;
                            /* margin-bottom: 10px; */
                            line-height: 1.2;
                        }


                        .price-range {
                            font-size: 14px;
                            font-weight: bold;
                            color: #333;
                            margin-bottom: 8px;
                        }

                        .order-info,
                        .business-type,
                        .location {
                            font-size: 12px;
                            color: #777;
                            margin-bottom: 5px;
                        }

                        .location i {
                            margin-right: 5px;
                            color: #007bff;
                        }

                        .b2b-nav {
                            color: #007bff;
                            background: #fff;
                            border-radius: 50%;
                            padding: 10px;
                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                            transition: background 0.3s ease, color 0.3s ease;
                        }

                        .b2b-nav:hover {
                            background: #007bff;
                            color: #fff;
                        }

                        .b2b-product-sliderr3 {
                            display: none;
                        }

                        @media(max-width:480px) {
                            .b2b-product-slider {
                                display: none;
                            }

                            .card-body {
                                padding: 5px 8px;
                            }

                            .product-card {
                                height: 350px;
                                /* or any suitable fixed height */
                                display: flex;
                                flex-direction: column;
                                overflow: hidden;
                            }

                            .product-card .card-body {
                                overflow-y: auto;
                                flex-grow: 1;
                            }




                            .b2b-product-sliderr3 {
                                display: block;
                            }

                            .card-image img {
                                width: 90%;
                                height: 90px;
                                margin: 0 auto;
                                object-fit: contain;
                                padding: 5px;
                            }

                            .price-range {
                                font-size: 12px;
                                /* font-weight: bold; */
                                color: #333;
                                margin-bottom: 2px;
                            }

                            .product-title {
                                font-size: 16px;
                                margin-bottom: 3px;
                                line-height: 1.2;
                            }

                            .order-info,
                            .business-type,
                            .location {
                                font-size: 12px;
                                color: #777;
                                margin-bottom: 2px;
                            }

                            .location i {
                                margin-right: 5px;
                                color: #007bff;
                            }
                        }

                        @media(max-width:450px) {
                            .b2b-product-slider {
                                display: none;
                            }

                            .card-body {
                                padding: 5px 8px;
                            }

                            .product-card {
                                height: 330px;
                                /* or any suitable fixed height */
                                display: flex;
                                flex-direction: column;
                                overflow: hidden;
                            }

                            .product-card .card-body {
                                overflow-y: auto;
                                flex-grow: 1;
                            }




                            .b2b-product-sliderr3 {
                                display: block;
                            }

                            .card-image img {
                                width: 90%;
                                height: 90px;
                                margin: 0 auto;
                                object-fit: contain;
                                padding: 5px;
                            }

                            .price-range {
                                font-size: 12px;
                                /* font-weight: bold; */
                                color: #333;
                                margin-bottom: 2px;
                            }

                            .product-title {
                                font-size: 16px;
                                margin-bottom: 3px;
                                line-height: 1.2;
                            }

                            .order-info,
                            .business-type,
                            .location {
                                font-size: 12px;
                                color: #777;
                                margin-bottom: 2px;
                            }

                            .location i {
                                margin-right: 5px;
                                color: #007bff;
                            }
                        }

                        @media(max-width:380px) {
                            .b2b-product-slider {
                                display: none;
                            }

                            .card-body {
                                padding: 5px 8px;
                            }

                            .product-card {
                                height: 310px;
                                /* or any suitable fixed height */
                                display: flex;
                                flex-direction: column;
                                overflow: hidden;
                            }

                            .product-card .card-body {
                                overflow-y: auto;
                                flex-grow: 1;
                            }

                            .b2b-product-sliderr3 {
                                display: block;
                            }

                            .card-image img {
                                width: 90%;
                                height: 90px;
                                margin: 0 auto;
                                object-fit: contain;
                                padding: 5px;
                            }

                            .price-range {
                                font-size: 12px;
                                /* font-weight: bold; */
                                color: #333;
                                margin-bottom: 2px;
                            }

                            .product-title {
                                font-size: 16px;
                                margin-bottom: 3px;
                                line-height: 1.2;
                            }

                            .order-info,
                            .business-type,
                            .location {
                                font-size: 12px;
                                color: #777;
                                margin-bottom: 2px;
                            }

                            .location i {
                                margin-right: 5px;
                                color: #007bff;
                            }
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var swiper = new Swiper('.b2b-product-slider', {
                                loop: true,
                                slidesPerView: 4,
                                spaceBetween: 20,
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false,
                                },
                                breakpoints: {
                                    320: {
                                        slidesPerView: 2
                                    },
                                    576: {
                                        slidesPerView: 2
                                    },
                                    768: {
                                        slidesPerView: 3
                                    },
                                    992: {
                                        slidesPerView: 5
                                    }
                                }
                            });
                        });
                    </script>
                </section>



                {{-- <section class="p-0 m-0">
                    <div class="  ">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-5 text-white rounded-4  d-flex flex-column justify-content-center h-100"
                                    style="background-image:linear-gradient( rgba(0, 0, 0, 0.448), rgba(0, 0, 0, 0.415)), url(../../assets/img/bg555.jpg); background-size:cover; background-position: center;">

                                    <h3 class="fw-bold text-white" style="padding-top: 100px;">Looking for Products?
                                    </h3>
                                    <p>Get verified suppliers and competitive quotes instantly.</p>
                                    <a href="{{ session()->has('id') ? route('postbyrequirement') : route('login') }}"
                                        class="btn  text-dark bg-light rounded-4 px-4 py-2 w-50">Post Buy
                                        Requirements</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-5 text-white rounded-4 d-flex flex-column justify-content-center h-100"
                                    style="background-image:linear-gradient( rgba(0, 0, 0, 0.405), rgba(0, 0, 0, 0.446)),url(../../assets/img/bg22222.jpg); background-size:cover;background-position: center;">

                                    <h3 class="fw-bold text-white" style="padding-top: 100px;">Boost Your Sales</h3>
                                    <p>Showcase your products and scale your business globally.</p>
                                    <a href="{{ session()->has('id') ? route('product_add') : route('signup') }}"
                                        class="btn  text-dark bg-light rounded-4 px-4 py-2 w-50">Sell on
                                        Globpulse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}

                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
                    rel="stylesheet">



                <section class="py-0 ">
                    @foreach ($categories as $category)
                        <div class="py-4" style="overflow: hidden">


                            <style>
                                .section-title {
                                    font-size: 22px;
                                    font-weight: bold;
                                    margin-bottom: 20px;
                                    border-bottom: 2px solid #2e6fbb;
                                    padding-bottom: 5px;
                                }

                                .card {
                                    background: white;
                                    border-radius: 10px;
                                    overflow: hidden;
                                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
                                    transition: all 0.3s ease;
                                    height: 100%;
                                }

                                .card:hover {
                                    transform: translateY(-5px);
                                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                                }

                                .view-all-card {
                                    background: linear-gradient(135deg, #2e6fbb, #3ac0ff);
                                    color: white;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: center;
                                    text-align: center;
                                    padding: 20px;
                                    height: 100%;
                                }

                                .view-btn {
                                    background: white;
                                    color: #2e6fbb;
                                    padding: 8px 15px;
                                    border-radius: 5px;
                                    font-weight: bold;
                                    text-decoration: none;
                                    display: inline-block;
                                    transition: 0.3s;
                                }

                                .view-btn:hover {
                                    background: #f1f1f1;
                                }
                            </style>

                            <div class="">
                                <div class="section-title bg-white p-2">
                                    <div class="d-flex flex-between-center ">
                                        <div class="d-flex align-items-center">
                                            <i class="fs-7 {{ $category->icon_class }}"></i>
                                            <span class="fs-7 fw-bold ms-2 m-0">{{ $category->cat_name }}</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('products-category', ['categorySlug' => $category->slug]) }}"
                                                class="btn-explore1">
                                                <span>Explore More</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- @php
                                $bgImage = !empty($category->maincat_bgimg)
                                ? asset('storage/' . $category->maincat_bgimg)
                                : asset('assets/img/background-img-cat.jpg');
                                @endphp --}}
                                @php
    $bgImage = !empty($category->maincat_bgimg)
        ? rtrim(config('app.pub_show_aws_url'), '/') .
        '/' .
        ltrim($category->maincat_bgimg, '/')
        : asset('assets/img/background-img-cat.jpg');
                                @endphp

                                <div class="row g-3 custom-width-row">
                                    <!-- View All big card -->
                                    <div class="col-lg-3 col-md-6 col-12 category-width">
                                        <div class="text-white border-0 h-100 "
                                            style="@if (!empty($bgImage)) background: linear-gradient(rgba(0,0,0,.4), rgba(0,0,0,.8)), url('{{ $bgImage }}');
                                                   background-size: cover; background-position: center;
                                               @else 
                                                background-color:#c7c3c3 ; @endif min-height:200px; display:flex; flex-direction:column; justify-content:end; padding:10px; padding-top:100px; border-radius:10px;  ">

                                            @if (isset($subcategory) && !isset($subSubcategory))
                                                <p style="padding-top: 100px; ">{{ $subcategory->subcat_des ?? '' }}
                                                </p>
                                            @elseif(isset($category) && !isset($subcategory))
                                                <p style="padding-top: 100px; ">
                                                    {{ \Illuminate\Support\Str::limit($category->cat_des ?? '', 170) }}
                                                </p>
                                            @endif

                                            <a href="@if (isset($subSubcategory)) {{ route('products-category', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug, 'subSubcategorySlug' => $subSubcategory->slug]) }}
                                             @elseif(isset($subcategory))
                                                     {{ route('products-categ                        ory', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug]) }}
                                                 @else                        
                                                     {{ route('products-category', ['categorySlug' => $category->slug]) }} @endif"
                                                class="btn btn-light view-btn fw-semibold align-self-start mb-5">
                                                View All
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Product Cards -->
                                    @foreach ($category->products as $product)
                                        @if ($product->status == 1)
                                            <div class="col-xl-3 col-lg-3 col-md-6 col-6 product-width">
                                                <div class="card b2b-product-card h-100 shadow-sm border hover-lift">
                                                    <div class="position-relative">
                                                        <a href="{{ $product->slug ? route('product-detail', ['slug' => $product->slug]) : '#' }}"
                                                            class="text-decoration-none">
                                                            <div
                                                                class="product-image-container position-relative overflow-hidden bg-light">
                                                                @if (!empty($product->product_img))
                                                                    <img class="product-img transition" loading="lazy"
                                                                        src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                                        alt="{{ $product->title ?? 'Product Image' }}">
                                                                @else
                                                                    <img class="product-img transition" loading="lazy"
                                                                        src="{{ asset('assets/img/no-image.png') }}"
                                                                        alt="No Image Available">
                                                                @endif

                                                                <!-- Status Badge -->
                                                                @if ($product->featured)
                                                                    <div class="position-absolute top-0 start-0 m-2">
                                                                        <span class="badge bg-danger">Featured</span>
                                                                    </div>
                                                                @endif

                                                                <!-- Quick View Overlay -->
                                                                <div
                                                                    class="quick-view-overlay d-flex align-items-center justify-content-center">
                                                                    <span class="text-white fw-semibold">View
                                                                        Details</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="card-body p-2">
                                                        <!-- Product Title -->
                                                        <h3 class="product-title"
                                                            style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                            {{ $product->title ?? 'N/A' }}
                                                        </h3>

                                                        <!-- Price Range -->
                                                        <div class="price-range mb-2">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <span class="text-primary fw-bold fs-9">
                                                                    {{ $product->country->currency_symbol ?? '' }}{{ $product->min_price ?? 'N/A' }}
                                                                </span>
                                                                @if ($product->min_price != $product->max_price)
                                                                    <span class="text-muted">-</span>
                                                                    <span class="text-primary fw-bold fs-9">
                                                                        {{ $product->country->currency_symbol ?? '' }}{{ $product->max_price ?? 'N/A' }}
                                                                    </span>
                                                                @endif
                                                                <small class="text-muted ms-1">
                                                                    ({{ $product->country->currency ?? 'N/A' }})
                                                                </small>
                                                            </div>
                                                            @if ($product->price_unit)
                                                                <small class="text-muted">/{{ $product->price_unit }}</small>
                                                            @endif
                                                        </div>

                                                        <!-- Key Information Grid -->
                                                        <div class=" mb-2">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <i class="bi bi-box-seam text-muted small"></i>
                                                                    <span class="text-muted small">Min Order:</span>
                                                                </div>
                                                                <span
                                                                    class="fw-medium small">{{ $product->min_order ?? 'N/A' }}</span>
                                                            </div>

                                                            <div class="d-flex justify-content-between mb-2">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <i class="bi bi-building text-muted small"></i>
                                                                    <span class="text-muted small">Business
                                                                        Type:</span>
                                                                </div>
                                                                <span
                                                                    class="fw-medium small">{{ $product->business_type ?? 'N/A' }}</span>
                                                            </div>

                                                            @if ($product->supply_ability)
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center gap-1">
                                                                        <i class="bi bi-truck text-muted small"></i>
                                                                        <span class="text-muted small">Supply
                                                                            Ability:</span>
                                                                    </div>
                                                                    <span class="fw-medium">{{ $product->supply_ability }}</span>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Supplier & Country Info -->
                                                        <div class="border-top pt-2">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between gap-2">
                                                                    <!-- Verification Badge -->
                                                                    <div class="">
                                                                        <img style="width: 55px; mix-blend-mode: multiply;"
                                                                            src="{{ asset('assets/img/logos/varify.gif') }}"
                                                                            alt=" Verified">
                                                                    </div>

                                                                    <!-- Country Flag -->
                                                                    @if (!empty($product->country->flag_img) && file_exists(public_path('assets/' . $product->country->flag_img)))
                                                                        <img class="flag-img rounded-1" loading="lazy" width="24"
                                                                            height="16"
                                                                            src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                            alt="{{ $product->country->short_name ?? 'Country Flag' }}"
                                                                            title="{{ $product->country->name ?? 'N/A' }}" />
                                                                    @else
                                                                        <img class="flag-img rounded-1" loading="lazy" width="24"
                                                                            height="16" src="{{ asset('assets/img/no-image.png') }}"
                                                                            alt="No Flag Available" />
                                                                    @endif
                                                                    <span
                                                                        class="small text-muted">{{ $product->country->iso2 ?? 'N/A' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <style>
                                    .quick-view-overlay {
                                        position: absolute;
                                        inset: 0;
                                        background: rgba(0, 0, 0, 0.271);
                                        backdrop-filter: blur(4px);
                                        opacity: 0;
                                        transition: all .35s ease;
                                    }

                                    .b2b-product-card:hover .quick-view-overlay {
                                        opacity: 1;
                                    }

                                    /* Desktop */
                                    .custom-width-row {
                                        display: flex;
                                        flex-wrap: wrap;
                                    }

                                    .custom-width-row>div {
                                        flex-shrink: 0;
                                    }

                                    /* Product card = 1 unit */
                                    .product-width {
                                        flex: 0 0 20% !important;
                                        max-width: 20% !important;
                                    }

                                    /* Category card = 2 unit */
                                    .category-width {
                                        flex: 0 0 40% !important;
                                        max-width: 40% !important;
                                    }

                                    /* Tablet */
                                    @media (max-width: 992px) {
                                        .product-width {
                                            flex: 0 0 50% !important;
                                            max-width: 50% !important;
                                        }

                                        .category-width {
                                            flex: 0 0 100% !important;
                                            max-width: 100% !important;
                                        }
                                    }

                                    .b2b-product-card {
                                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                                        border-radius: 12px;
                                        overflow: hidden;
                                    }

                                    .b2b-product-card:hover {
                                        transform: translateY(-4px);
                                        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
                                    }

                                    .product-image-container {
                                        width: 100%;
                                        height: 220px;
                                        /* tamne jetli height joiye aetli set kari sakay */
                                        overflow: hidden;
                                        /* border-radius: 8px; */
                                    }

                                    .product-image-container .product-img {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                        /* full width + auto crop */
                                        display: block;
                                    }


                                    .b2b-product-card:hover .product-img {
                                        transform: scale(1.05);
                                    }

                                    .quick-view-overlay {
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        bottom: 0;
                                        background: rgba(0, 0, 0, 0.7);
                                        opacity: 0;
                                        transition: opacity 0.3s ease;
                                        pointer-events: none;
                                    }

                                    .b2b-product-card:hover .quick-view-overlay {
                                        opacity: 1;
                                    }

                                    .text-truncate-2 {
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        overflow: hidden;
                                        /* min-height: 3em; */
                                    }

                                    .product-info-grid {
                                        background: #f8f9fa;
                                        border-radius: 8px;
                                        padding: 12px;
                                    }

                                    .verified-badge {
                                        display: flex;
                                        align-items: center;
                                        padding: 2px 8px;
                                        background: rgba(13, 110, 253, 0.1);
                                        border-radius: 12px;
                                        font-size: 0.75rem;
                                    }

                                    .flag-img {
                                        border: 1px solid #dee2e6;
                                        object-fit: cover;
                                    }

                                    .btn-sm {
                                        width: 32px;
                                        height: 32px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    }

                                    /* Responsive adjustments */
                                    @media (max-width: 768px) {
                                        .product-image-container {
                                            height: 160px;
                                        }

                                        .b2b-product-card .card-body {
                                            padding: 1rem !important;
                                        }
                                    }

                                    @media (max-width: 576px) {
                                        .product-image-container {
                                            height: 140px;
                                        }

                                        .text-truncate-2 {
                                            -webkit-line-clamp: 2;
                                            min-height: 1.2em;
                                        }
                                    }
                                </style>

                            </div>
                            {{-- <div class="swiper-container b2b-product-slider b2b-product-sliderr3">
                                <div class="swiper-wrapper rounded-4">
                                    @foreach ($category->products as $product)
                                    @if ($product->status == 1)
                                    <div class="swiper-slide">
                                        <div class="product-card">
                                            <a style="text-decoration: solid"
                                                href="{{ $product->slug ? route('product-detail', ['slug' => $product->slug]) : '#' }}">

                                                <div class=" product-image position-relative">
                                                    @if (!empty($product->product_img))
                                                    <img class="img-fluid transition rounded-1" loading="lazy"
                                                        src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                        alt=" {{ $product->title ?? 'Product Image' }}" />
                                                    @else <img class="img-fluid transition rounded-1" loading="lazy"
                                                        src="{{ asset('assets/img/no-image.png') }}"
                                                        alt=" No Image Available" />
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="product-title"
                                                        style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                        {{ $product->title ?? 'N/A' }}
                                                    </h3>
                                                    <div class="price-range">
                                                        <span class="price">
                                                            {{ $product->country->currency_symbol ?? '' }}
                                                            {{ $product->min_price ?? 'N/A' }}
                                                        </span> - <span class="price">
                                                            {{ $product->country->currency_symbol ?? '' }}
                                                            {{ $product->max_price ?? 'N/A' }}
                                                            ({{ $product->country->currency ?? 'N/A' }})
                                                        </span>
                                                    </div>

                                                    <div class="order-info">
                                                        <span>Min Order:
                                                            {{ $product->min_order ?? 'N/A' }}</span>
                                                    </div>

                                                    <div class="business-type">
                                                        <span>Business Type:
                                                            {{ $product->business_type ?? 'N/A' }}</span>
                                                    </div>

                                                    <div class="d-flex align-items-center gap-2">
                                                        <img style="width: 55px; mix-blend-mode: multiply;"
                                                            src="{{ asset('assets/img/logos/varify.gif') }}"
                                                            alt=" Verified">
                                                        <span class="small fw-bold text-success">
                                                            @if (!empty($product->country->flag_img) &&
                                                            file_exists(public_path('assets/' .
                                                            $product->country->flag_img)))
                                                            <img class="flag" loading="lazy"
                                                                src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                alt=" {{ $product->country->short_name ?? 'Product Image' }}" />
                                                            @else <img class="img-fluid transition rounded-1" loading="lazy"
                                                                src="{{ asset('assets/img/no-image.png') }}"
                                                                alt=" No Image Available" />
                                                            @endif
                                                            {{ $product->country->iso2 ?? 'N/A' }}

                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div> --}}
                        </div>
                    @endforeach

                    <style>
                        .product-card {
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        }

                        .product-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
                        }

                        .product-image img {
                            transition: transform 0.3s ease;
                        }

                        .line-clamp-2 {
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                        }
                    </style>

                </section>

                {{-- LATEST BUY LEADS --}}
                <style>
                    .swiper {
                        height: 350px;
                    }

                    .swiper-slide {
                        display: flex;
                        flex-direction: column;
                        justify-content: start;
                    }

                    .lead-card {
                        display: flex;
                        background: #ffffff;
                        align-items: center;
                        /* gap: 10px; */
                        border-radius: 8px;
                        padding: 10px;
                        margin-bottom: 10px;
                        border: rgb(170, 170, 192) 1px solid;
                    }

                    .lead-info {
                        font-size: 14px;
                        font-weight: 600;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    .lead-date {
                        font-size: 12px;
                        color: gray;
                    }

                    .flag {
                        width: 24px;
                        /* height: 16px; */
                    }

                    @media (max-width: 768.98px) {
                        .mySwiper {
                            display: none !important;
                        }
                    }
                </style>

                <div class="bg-white rounded-3">
                    <div class="d-flex justify-content-between ">
                        <div class="col-12">
                            <div class="">
                                <div class="section-title bg-white p-2">
                                    <div class="d-flex flex-between-center ">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-handshake"></i>
                                            <span class="fs-7 fw-bold ms-2 m-0">Latest Buy Leads</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('byleads') }}" class="btn-explore1">
                                                <span>Explore More</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper ">
                                        @foreach ($postrequirments->chunk(3) as $chunk)
                                            <div class="swiper-slide">
                                                <div class="row">
                                                    @foreach ($chunk as $item)
                                                        <div class="col-md-4 ">
                                                            <div class="lead-card mx-2">
                                                                @if (!empty($item->country->flag_img) && file_exists(public_path('assets/' . $item->country->flag_img)))
                                                                    <img class="flag" loading="lazy"
                                                                        src="{{ asset('assets/' . $item->country->flag_img) }}"
                                                                        alt="{{ $item->country->short_name ?? 'Product Image' }}" />
                                                                @else
                                                                    <img class="img-fluid  transition rounded-1" loading="lazy"
                                                                        src="{{ asset('assets/img/no-image.png') }}"
                                                                        style="width: 24px;" alt="flag" />
                                                                @endif
                                                                <div class="ms-2">
                                                                    <div class="lead-info fw-bold">
                                                                        {{ \Illuminate\Support\Str::limit($item->product_name, 20) }}
                                                                        |
                                                                        {{ $item->location }}
                                                                    </div>
                                                                    <div class="lead-date text-muted small">
                                                                        {{ $item->created_at->format('d-M-Y') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
                <script>
                    new Swiper(".mySwiper", {
                        direction: "vertical",
                        slidesPerView: 4, // Show 4 at a time
                        // spaceBetween: 10,
                        loop: true,
                        autoplay: {
                            delay: 500,
                            disableOnInteraction: false,
                        },
                        speed: 1000,
                    });
                </script>



                <style>
                    .swiper-mobile {
                        display: none;
                    }

                    @media (max-width: 576px) {
                        .title-lead {
                            font-size: 5px;
                        }

                    }

                    @media (max-width: 768.98px) {
                        .swiper-mobile {
                            height: 350px;
                            display: block;
                            overflow: hidden;

                        }

                        .swiper-slide {
                            display: flex;
                            justify-content: start;
                        }

                        .lead-card {
                            display: flex;
                            align-items: center;
                            background: #ffffff;
                            border-radius: 8px;
                            padding: 10px;
                            width: 100%;

                        }

                        .lead-info {
                            font-size: 14px;
                            font-weight: 600;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        .lead-date {
                            font-size: 10px;
                            color: gray;
                        }

                        .flag {
                            width: 24px;
                        }

                        .title-lead {
                            font-size: 12px;
                        }
                    }
                </style>




                <div class="swiper1 swiper-mobile mySwiperMobile">
                    <div class="swiper-wrapper">
                        @foreach ($postrequirments as $item)
                            <div class="swiper-slide">
                                <div class="lead-card">
                                    @if (!empty($item->country->flag_img) && file_exists(public_path('assets/' . $item->country->flag_img)))
                                        <img class="flag" loading="lazy" src="{{ asset('assets/' . $item->country->flag_img) }}"
                                            alt="{{ $item->country->iso2 ?? 'Flag' }}" />
                                    @else
                                        <img class="img-fluid transition rounded-1" loading="lazy" style="width: 24px;"
                                            src="{{ asset('assets/img/no-image.png') }}" alt="No Image Available" />
                                    @endif
                                    <div class="ms-2">
                                        <div class="lead-info">{{ $item->product_name }} | {{ $item->location }}
                                        </div>
                                        <div class="lead-date">{{ $item->created_at->format('d-M-Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    new Swiper(".mySwiperMobile", {
                        direction: "vertical",
                        slidesPerView: 5,
                        loop: true,
                        autoplay: {
                            delay: 800,
                            disableOnInteraction: false,
                        },
                        speed: 1000,
                    });
                </script>



                <section class="stats-dashboard mt-3">

                    <!-- Import Card - Line Graph -->
                    <div class="stat-card">
                        <div class="card-top">
                            {{-- <span>Imports</span> --}}
                        </div>

                        <h2>15.5M</h2>
                        <p>Total import growth</p>

                        <div class="graph-container">
                            <svg class="graph-svg" viewBox="0 0 200 60" preserveAspectRatio="none">
                                <polyline points="0,50 30,35 60,45 90,20 120,30 150,15 180,25 200,10" stroke="#f97316"
                                    stroke-width="2.5" fill="none" />
                                <polygon points="0,50 30,35 60,45 90,20 120,30 150,15 180,25 200,10 200,60 0,60"
                                    fill="url(#grad1)" opacity="0.2" />
                                <defs>
                                    <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#f97316" stop-opacity="0.4" />
                                        <stop offset="100%" stop-color="#f97316" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>

                    <!-- Export Card - Bar Graph -->
                    <div class="stat-card">
                        <div class="card-top">
                            {{-- <span>Exports</span> --}}
                        </div>

                        <h2>45.7M</h2>
                        <p>Export performance</p>

                        <div class="graph-container">
                            <svg class="graph-svg" viewBox="0 0 200 60" preserveAspectRatio="none">
                                <rect x="15" y="30" width="20" height="30" fill="#3b82f6" opacity="0.7" rx="4" />
                                <rect x="55" y="20" width="20" height="40" fill="#3b82f6" opacity="0.8" rx="4" />
                                <rect x="95" y="10" width="20" height="50" fill="#3b82f6" opacity="0.9" rx="4" />
                                <rect x="135" y="25" width="20" height="35" fill="#3b82f6" opacity="0.75" rx="4" />
                                <rect x="175" y="15" width="20" height="45" fill="#3b82f6" opacity="0.85" rx="4" />
                            </svg>
                        </div>
                    </div>

                    <!-- Customers Card - Area Graph -->
                    <div class="stat-card">
                        <div class="card-top">
                            {{-- <span>Customers</span> --}}
                        </div>

                        <h2>200.1K</h2>
                        <p>Active customers</p>

                        <div class="graph-container">
                            <svg class="graph-svg" viewBox="0 0 200 60" preserveAspectRatio="none">
                                <path d="M0,40 Q20,20 40,35 T80,25 T120, 15 T160,12 T200,10 L200,60 L0,60 Z"
                                    fill="#ede9fe" opacity="0.3" />
                                <path d="M0,40 Q20,20 40,35 T80,25 T120, 15 T160,12 T200,10" stroke="#f97316"
                                    stroke-width="2.5" fill="none" />
                            </svg>
                        </div>
                    </div>

                    <!-- Products Card - Pie/Donut Graph -->
                    <div class="stat-card">
                        <div class="card-top">
                            {{-- <span>Products</span> --}}
                        </div>

                        <h2>155.0K</h2>
                        <p>Total products</p>

                        <div class="graph-container donut-container">
                            <svg viewBox="0 0 100 100" class="donut-svg">
                                <circle cx="50" cy="50" r="40" fill="none" stroke="#e2e8f0" stroke-width="12" />
                                <circle cx="50" cy="50" r="40" fill="none" stroke="#10b981" stroke-width="12"
                                    stroke-dasharray="251.2" stroke-dashoffset="62.8" transform="rotate(-90 50 50)" />
                                <circle cx="50" cy="50" r="40" fill="none" stroke="#f59e0b" stroke-width="12"
                                    stroke-dasharray="251.2" stroke-dashoffset="188.4" transform="rotate(-90 50 50)" />
                                <text x="50" y="55" text-anchor="middle" fill="#1e293b" font-size="14"
                                    font-weight="bold">80%</text>
                            </svg>
                        </div>
                    </div>

                </section>

                <style>
                    .stats-dashboard {
                        display: flex;
                        gap: 24px;
                        padding: 50px;
                        justify-content: center;
                        flex-wrap: wrap;
                        font-family: 'Inter', sans-serif;
                        background: #f8fafc;
                    }

                    .stat-card {
                        width: 260px;
                        background: #fff;
                        border-radius: 18px;
                        padding: 22px;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
                        transition: all 0.35s ease;
                    }

                    .stat-card:hover {
                        transform: translateY(-6px);
                        /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); */
                    }

                    .card-top {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        color: #444;
                        font-size: 14px;
                        font-weight: 500;
                    }

                    .stat-card h2 {
                        font-size: 34px;
                        margin: 18px 0 5px;
                        color: #000;
                        font-weight: 600;
                    }

                    .stat-card p {
                        font-size: 13px;
                        color: #6b7280;
                        margin-bottom: 15px;
                    }

                    /* Graph Container */
                    .graph-container {
                        margin-top: 15px;
                        height: 80px;
                        width: 100%;
                        border-radius: 12px;
                        overflow: hidden;
                    }

                    .graph-svg {
                        width: 100%;
                        height: 100%;
                    }

                    /* Donut specific */
                    .donut-container {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: transparent;
                    }

                    .donut-svg {
                        width: 80px;
                        height: 80px;
                    }

                    /* Hover effects */
                    .stat-card:hover .graph-svg polyline,
                    .stat-card:hover .graph-svg path {
                        stroke-width: 3;
                    }

                    .stat-card:hover rect {
                        opacity: 1 !important;
                    }
                </style>

                <script>
                    const cards = document.querySelectorAll('.stat-card h2');

                    cards.forEach(el => {
                        const value = el.innerText;
                        const number = parseFloat(value);
                        const suffix = value.replace(/[0-9.]/g, '');

                        let count = 0;
                        const step = number / 60;

                        const animate = () => {
                            count += step;
                            if (count >= number) {
                                el.innerText = value;
                            } else {
                                el.innerText = count.toFixed(1) + suffix;
                                requestAnimationFrame(animate);
                            }
                        };
                        animate();
                    });
                </script>

                <div class="pt-3">
                    <div class="row text-start text-center my-2 w-100 ">
                        <h3 class="fw-bolder fs-7 fs-md-6">Why Choose Globpulse for Your Wholesale & Export Business?
                        </h3>
                        <p class="text-center w-75 mx-auto">Globpulse provides trusted partnerships, quality assurance
                            and
                            transparent trade support. From verified sellers to
                            global buyers, our platform ensures safe wholesale transactions, reliable exports and long
                            term B2B growth opportunities
                            across industries.

                        </p>
                    </div>
                    <div class=" ">
                        <div class="row g-4">
                            <!-- Left Section (Main Goal) -->
                            <div class="col-12 col-md-6">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                    <div class="position-relative">
                                        <img src="../../../assets/img/logos/our-goal.webp" alt="Our Goal"
                                            class="img-fluid w-100">
                                        <div class="position-absolute bottom-0 start-0 end-0 p-3"
                                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);">
                                            <span class="text-white mb-2 fw-bold">Our Goal</span>
                                            <p class="text-white mb-0 small">
                                                GlobPulse is a B2B marketplace platform intended to help
                                                wholesale
                                                traders find new buyers or suppliers on the global market.
                                                We aim to
                                                make international trade simpler and more efficient.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section (Text Boxes) -->
                            <div class="col-12 col-md-6">
                                <div class="row g-4">
                                    <!-- Box 1 -->
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="position-relative">
                                                <img src="../../../assets/img/logos/we-work-global.webp"
                                                    alt="We Work Global" class="img-fluid w-100">
                                                <div class="position-absolute bottom-0 start-0 end-0 p-3"
                                                    style="background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);">
                                                    <span class="text-white mb-2 fw-bold">We Work Global</span>
                                                    <p class="text-white mb-0 small">
                                                        GlobPulse is an online B2B marketplace platform
                                                        accessible to
                                                        everyone. We cover all the countries and industries.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Box 2 -->
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="position-relative">
                                                <img src="../../../assets/img/logos/business.webp"
                                                    alt="Business Support" class="img-fluid w-100">
                                                <div class="position-absolute bottom-0 start-0 end-0 p-3"
                                                    style="background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);">
                                                    <span class="text-white mb-2 fw-bold">Helping You Enhance Your
                                                        Business</span>
                                                    <p class="text-white mb-0 small">
                                                        Become a supplier on our platform to provide your
                                                        company with
                                                        higher visibility on the internet, bring in more
                                                        customers, and
                                                        boost sales.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="bg-primary text-center baner-img my-5">
            <div class="container py-5">
                <h3 class="text-light mb-4">
                    Join Globpulse – Start Wholesale Buying & Selling Online
                </h3>

                <div class="row justify-content-center text-start text-light mb-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                        <ul class="list-unstyled">
                            <li class="mb-3 fs-8 text-center md-text-start fw-bold">
                                <i class="fas fa-shield-alt me-2"></i> Trade with confidence
                            </li>
                            <li class="fs-8 text-center md-text-start fw-bold">
                                <i class="fas fa-globe me-2"></i> Global network
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                        <ul class="list-unstyled">
                            <li class="mb-3 fs-8 text-center md-text-start fw-bold">
                                <i class="fas fa-check-circle me-2"></i> Verified buyers
                            </li>
                            <li class="fs-8 text-center md-text-start fw-bold">
                                <i class="fas fa-headset me-2"></i> 24 / 7 help center
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="text-center">
                    @if (!empty(session('id')))
                        <a href="{{ route('product_add') }}">
                            <button class="btn btn-primary rounded-2 text-white fs-8 px-4 py-2">
                                Product List Now
                            </button>
                        </a>
                    @else
                        <a href="{{ route('signup') }}">
                            <button class="btn btn-primary rounded-2 text-white fs-8 px-4 py-2">
                                Sign up for free now
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </section>
        <div class="container app-section my-5">
            <div class="bg-light rounded-4 py-5 my-5 px-3 border">
                <div class="row align-items-center jus tify-content-center py-5 ">
                    <div class="col-lg-6 text-center mb-4 mb-lg-0 ">
                        <img src="../../../assets/img/mobile-img-4.png" alt="Globpulse App" class="app-image w-100">
                    </div>
                    <div class="col-lg-6  ">
                        <divclass=" ">
                        <div class=" mb-4">
                            <span class="fw-bold text-dark mb-2 fs-6">Your Business. Your Pocket.</span>
                            <p class="lead text-secondary">Download the <span class="text-primary">Globpulse
                                    App</span> and
                                connect with
                                verified sellers anytime, anywhere.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="col-3" style="border: solid 5px black ; border-radius: 5px;">
                            <img class="w-100" src="../../../assets/img/qr1.png" alt="">
                        </div>
                        <div class="col-8">
                            <div class=" row align-items-center justify-content-center gap-3">
                                <div class="col-9">
                                    <a class="" href="https://apps.apple.com/app/globpulse/id6742694568"
                                        target="_blank">
                                        <img src="../../../assets/img/app-store.png" alt="App Store"
                                            class="rounded-3 shadow-sm mx-auto" style="height: 40px;">
                                    </a>
                                </div>
                                <div class="col-9">
                                    <a class="" href="https://play.google.com/store/apps/details?id=crm.ani.com"
                                        target="_blank">
                                        <img src="../../../assets/img/google-play.png" alt="Google Play"
                                            class="rounded-3 shadow-sm mx-auto" style="height: 40px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3>Why Download the GlobPulse App?</h3>
                        <p>Once you download the GlobPulse app, you'll enjoy these benefits:</p>

                        <li class="d-flex align-items-center"><i class="fa-solid fa-circle text-dark me-2"
                                style="font-size:6px;"></i>
                            Global Reach - Connect with buyers and suppliers worldwide.
                        </li>
                        <li class="d-flex align-items-center"> <i class="fa-solid fa-circle text-dark  me-2"
                                style="font-size:6px;"></i> Verified Network -
                            Trade only with trusted and genuine businesses.</li>
                        <li class="d-flex align-items-center"> <i class="fa-solid fa-circle text-dark  me-2"
                                style="font-size:6px;"></i> Faster Deals -
                            Send inquiries and get quick responses.</li>
                        <li class="d-flex align-items-center"> <i class="fa-solid fa-circle text-dark  me-2"
                                style="font-size:6px;"></i> Smart Search -
                            Easily find products and partners with advanced filters.</li>
                        <li class="d-flex align-items-center"> <i class="fa-solid fa-circle text-dark  me-2"
                                style="font-size:6px;"></i> Business Growth -
                            Expand your reach and grow globally with ease.</li>
                    </div>
                </div>
            </div>

        </div>
</div>
<script>
    function sendAppLink() {
        const phone = document.getElementById('phoneInput').value.trim();
        if (phone) {
            document.getElementById('confirmationMessage').style.display = 'block';
        } else {
            alert("Please enter a valid mobile number.");
        }
    }
</script>

<style>
    .baner-img {
        background-color: #1a1a4c;
        background-image: url(../../assets/img/Singup-home.png);
        background-size: cover;
        background-position: center;
        color: white;
    }
</style>




{{-- Testimonials --}}
{{--
<section class="py-5 ">
    <div class="container">
        <h2 class="text-center fw-bold mb-2">What Our Clients Say About Sourcing with Globpulse</h2>
        <p class="text-center p-0 m-0 w-75 mx-auto">We take pride in connecting businesses with
            trusted
            wholesale
            suppliers. Here's what our
            clients have to say about their
            experience using to grow, source, and succeed in global trade.</p>

        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center mb-4" id="testimonialTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="buyers-tab" data-bs-toggle="tab" data-bs-target="#buyers"
                    type="button" role="tab">Buyers</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="suppliers-tab" data-bs-toggle="tab" data-bs-target="#suppliers"
                    type="button" role="tab">Suppliers</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="testimonialTabsContent">
            <!-- Buyers -->
            <div class="tab-pane fade show active" id="buyers" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="buyer1.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Emily Chen</strong><br>
                                    <small class="text-muted">Procurement Manager, Retail
                                        World</small>
                                </div>
                            </div>
                            <p>"Super easy platform to navigate. We cut sourcing time in half.
                                Highly
                                recommend!"</p>
                            <div class="text-warning">★★★★★</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="buyer2.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Ravi Mehta</strong><br>
                                    <small class="text-muted">COO, TechPlus</small>
                                </div>
                            </div>
                            <p class="">"Trusted vendors, easy payments, and fast delivery.
                                Game-changer
                                for
                                B2B!"</p>
                            <div class="text-warning">★★★★☆</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="buyer3.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Linda Perez</strong><br>
                                    <small class="text-muted">Buyer, MedicalLink Inc.</small>
                                </div>
                            </div>
                            <p>"We rely on this portal for verified, high-quality suppliers.
                                Excellent service."
                            </p>
                            <div class="text-warning">★★★★★</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="buyer3.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Linda Perez</strong><br>
                                    <small class="text-muted">Buyer, MedicalLink Inc.</small>
                                </div>
                            </div>
                            <p>"We rely on this portal for verified, high-quality suppliers.
                                Excellent service."
                            </p>
                            <div class="text-warning">★★★★★</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="buyer3.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Linda Perez</strong><br>
                                    <small class="text-muted">Buyer, MedicalLink Inc.</small>
                                </div>
                            </div>
                            <p>"We rely on this portal for verified, high-quality suppliers.
                                Excellent service."
                            </p>
                            <div class="text-warning">★★★★★</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suppliers -->
            <div class="tab-pane fade" id="suppliers" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="supplier1.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Ahmed Raza</strong><br>
                                    <small class="text-muted">Export Manager, Textile Hub</small>
                                </div>
                            </div>
                            <p>"We received global inquiries within weeks. The reach and quality are
                                unmatched."
                            </p>
                            <div class="text-warning">★★★★★</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="supplier2.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Chloe Smith</strong><br>
                                    <small class="text-muted">Founder, EcoCraft Supplies</small>
                                </div>
                            </div>
                            <p>"We’ve grown our revenue 3x with international orders through this
                                platform."</p>
                            <div class="text-warning">★★★★★</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border shadow p-4 h-100 rounded-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="supplier3.jpg" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <strong>Sunil Kumar</strong><br>
                                    <small class="text-muted">Sales Director, Steel Forge
                                        Ltd.</small>
                                </div>
                            </div>
                            <p>"Easy onboarding, buyer trust, and secured payments. Highly
                                reliable!"</p>
                            <div class="text-warning">★★★★☆</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .card:hover {
        transform: translateY(-8px);
        transition: 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        background-color: #f8f9fa;
        border-color: #dee2e6 #dee2e6 #fff;
        font-weight: bold;
    }
</style> --}}





<section class="py-5 ">
    <div class="container-fluid ">
        <div class="text-center">
            <h3 class="text-start text-md-center fw-bold mb-2">Start Your Business - Become a
                Distributor or
                Franchise Partner
            </h3>
            <p class="mb-5 text-start text-md-center">Start your own business by becoming a
                distributor or
                franchise partner. Get expert
                support and tap into a trusted
                network to grow successfully.</p>
        </div>

        <div class="d-flex flex-wrap justify-content-between g-4">
            <div class="col-12 col-md-6 ">
                <div class="glass-card1  position-relative overflow-hidden p-4  text-center rounded-4 mx-3">
                    <div class="icon-circle mx-auto mb-3">
                        <img src="../assets/img/distribution.png" alt="Distribution Partner"
                            style="width: 50px; height: 50px;">
                    </div>
                    <h4 class="fw-bold text-white mb-2 fs-7 fs-md-5">Distribution Partner</h4>
                    <p class="text-white fs-8 px-3">
                        Take charge of a region & become a key player in our growth network.
                    </p>
                    <div class="mt-4">
                        <a onclick="showPopup()" class="btn btn-light rounded-pill px-4 py-2 fw-semibold shadow-sm">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
            <style>
                .glass-card1 {
                    background-color: #0f3e71b6;
                }
            </style>



            <!-- Popup Form -->
            <div id="popupForm" class="popup-overlay">
                <div class="popup-box container-fluid">
                    <div class="position-relative bg-white text-dark p-4 rounded shadow-lg">
                        <button type="button" class="btn-close button-close1 position-absolute top-0 end-0 m-3"
                            onclick="closePopup()" aria-label="Close"></button>
                        <h4 class="fw-bold mb-4">Apply to Distribution </h4>

                        <form class="row g-3" wire:submit.prevent="addDistribution">
                            <div class="col-md-6">
                                <label class="form-label text-left">Full Name</label>
                                <input type="text" class="form-control" placeholder="Enter your full name"
                                    wire:model="name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter your email"
                                    wire:model="email" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" placeholder="Enter your phone number"
                                    wire:model="phone_number" wire:ignore.self autocomplete="off" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" placeholder="Enter your city" wire:model="city"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <select class="form-select" wire:model="country" required>
                                    <option value="">Select your country</option>
                                    @foreach ($countries as $c)
                                        <option value="{{ $c->country_id }}">
                                            {{ $c->short_name }}
                                        </option>
                                    @endforeach <!-- Add more countries as needed -->
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" placeholder="Tell us why you're interested…"
                                    wire:model="message" rows="4" required></textarea>
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Styles -->
            <style>
                .popup-overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 1050;
                    align-items: center;
                    justify-content: center;
                }

                .popup-box {
                    max-width: 850px;
                    animation: fadeIn 0.3s ease-in-out;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(-30px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .button-close1:hover {
                    background-color: #eaa4a4;
                    color: white;
                }
            </style>

            <!-- JavaScript -->
            <script>
                function showPopup() {
                    document.getElementById("popupForm").style.display = "flex";
                }

                function closePopup() {
                    document.getElementById("popupForm").style.display = "none";
                }
            </script>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <div
                    class="glass-card position-relative overflow-hidden p-4 text-center rounded-4 shadow-lg h-100 mx-3">
                    <div class="icon-circle mx-auto mb-3">
                        <img src="../assets/img/franchise (1).png" alt="Master Franchise"
                            style="width: 50px; height: 50px;">
                    </div>
                    <h4 class="fw-bold text-white mb-2  fs-7 fs-md-5">Master Franchise</h4>
                    <p class="text-white fs-8 px-3">
                        Join a trusted network & become our Franchise Partner in your region.
                    </p>
                    <div class="mt-4">
                        <a onclick="showPopups1()" class="btn btn-light rounded-pill px-4 py-2 fw-semibold shadow-sm">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>


            <style>
                .glass-card {
                    background-color: #0f3e71b6;
                }



                .icon-circle {
                    width: 80px;
                    height: 80px;
                    background: rgba(255, 255, 255, 0.923);
                    backdrop-filter: blur(8px);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.1);
                }
            </style>

            <div id="popupForm1" class="popup-overlay">
                <div class="popup-box container-fluid">
                    <div class="position-relative bg-white text-dark p-4 rounded shadow-lg">
                        <button type="button" class="btn-close button-close1 position-absolute top-0 end-0 m-3"
                            onclick="closePopups1()" aria-label="Close"></button>
                        <h4 class="fw-bold mb-4">Apply to Franchise </h4>

                        <form class="row g-3" wire:submit.prevent="addFranchise">
                            <div class="col-md-6">
                                <label class="form-label text-left">Full Name</label>
                                <input type="text" class="form-control" placeholder="Enter your full name"
                                    wire:model="name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter your email"
                                    wire:model="email" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" placeholder="Enter your phone number"
                                    wire:model="phone_number" wire:ignore.self autocomplete="off" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" placeholder="Enter your city" wire:model="city"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Region</label>
                                <input type="text" class="form-control" placeholder="Enter your region"
                                    wire:model="country" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" placeholder="Tell us why you're interested…"
                                    wire:model="message" rows="4" required></textarea>
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function showPopups1() {
                    document.getElementById("popupForm1").style.display = "flex";
                }

                function closePopups1() {
                    document.getElementById("popupForm1").style.display = "none";
                }
            </script>
        </div>
    </div>
</section>

<style>
    .faq-title {
        /* text-align: center; */
        /* font-weight: 600; */
        font-size: 24px;
        /* margin-bottom: 30px; */
        position: relative;
    }


    .faq-item {
        border-bottom: 1px solid #7e7a7a;
        padding: 5px 0;
        cursor: pointer;
    }

    .faq-question {
        /* font-size: 17px; */
        /* font-weight: 500; */
        color: #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .faq-answer {
        font-size: 14px;
        color: #555;
        margin-top: 10px;
        display: none;
    }

    .faq-icon {
        font-size: 25px;
        color: #007bff;
        transition: transform 0.3s;
    }

    .faq-item.active .faq-icon {
        color: #ff4b5c;
        transform: rotate(180deg);
    }

    .faq-item.active .faq-answer {
        display: block;
    }
</style>




<div class="container-fluid my-5">
    <div class="faq-container">
        <div class="text-center mb-3">
            <h4 class="fs-7 fw-bolder pb-3">FREQUENTLY ASKED QUESTIONS</h4>
        </div>

        <!-- FIRST 5 FAQs VISIBLE -->
        <div class="faq-item bg-white px-4" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <h4 style="font-weight: 600; font-size: 16px;">What steps are required to sign up on
                    GlobPulse?
                </h4>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <ul class="custom-list mx-auto" style="list-style-type: disc;">
                    <li>Click the “Signup” button on the homepage and complete the registration form
                        with
                        personal and company details.</li>
                    <li>Accept the Terms & Conditions, verify your email or mobile via OTP, and gain
                        access to
                        your new account.</li>
                </ul>
            </div>
        </div>

        <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <h4 style="font-weight: 600; font-size: 16px;">What are the benefits of subscribing
                    to a
                    GlobPulse Membership Plan?</h4>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <ul class="custom-list mx-auto" style="list-style-type: disc;">
                    <li>Members get priority listing, trust badges, and advanced analytics to boost
                        visibility
                        and credibility.</li>
                    <li>Plans include access to premium support, exclusive trade tools, and verified
                        global
                        buyer-seller connections.</li>
                </ul>
            </div>
        </div>

        <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <h4 style="font-weight: 600; font-size: 16px;">How can I buy leads and post buy
                    requirements on
                    GlobPulse?</h4>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <ul class="custom-list mx-auto" style="list-style-type: disc;">
                    <li>Log in to access tools for submitting detailed purchase needs or buying
                        verified leads
                        instantly.</li>
                    <li>Posted buy requirements are authenticated and matched with relevant
                        suppliers for faster
                        responses.</li>
                </ul>
            </div>
        </div>

        <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <h4 style="font-weight: 600; font-size: 16px;">How do I become a verified supplier
                    on
                    GlobPulse?
                </h4>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <ul class="custom-list mx-auto" style="list-style-type: disc;">
                    <li>Submit business credentials and documents for verification to earn the
                        verified supplier
                        badge.</li>
                    <li>Verified status boosts exposure, trust, and gives access to catalog tools
                        and
                        performance insights.</li>
                </ul>
            </div>
        </div>

        <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
            <div class="faq-question">
                <h4 style="font-weight: 600; font-size: 16px;">What trade finance options are
                    available through
                    GlobPulse?</h4>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <ul class="custom-list mx-auto" style="list-style-type: disc;">
                    <li>GlobPulse facilitates Documentary Letters of Credit (DLC) through trusted
                        financial
                        partners.</li>
                    <li>Offers expert guidance on application, approval, and secure international
                        payment
                        processes.</li>
                </ul>
            </div>
        </div>

        <!-- REMAINING FAQS (INITIALLY HIDDEN) -->
        <div id="more-faqs" style="display: none;">
            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">What is the GFE Chamber and how
                        does it
                        support members?</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>The GFE Chamber connects members to global trade events, networking
                            forums, and
                            expert resources.</li>
                        <li>It offers compliance guidance and links businesses with government and
                            international
                            trade bodies.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">What advantages does GlobPulse
                        offer over
                        other B2B platforms?</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>It ensures reliability through verified suppliers, quality checks, and
                            secure
                            transactions.</li>
                        <li>Offers personalized sourcing assistance and regularly updated listings
                            across
                            diverse industries.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">How can businesses register and
                        start
                        selling
                        on GlobPulse?</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>Sellers fill out a registration form with business details, which are
                            then verified
                            by GlobPulse.</li>
                        <li>Once approved, they can upload product catalogs and connect with buyers
                            globally.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">What makes GlobPulse a trusted
                        platform for
                        B2B buyers?</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>All suppliers and listings are strictly verified for authenticity and
                            quality.</li>
                        <li>The platform offers transparent communication, secure transactions, and
                            responsive
                            support.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">Which industries and product
                        categories are
                        available on GlobPulse?</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>Includes sectors like Machinery, Electronics, Health & Beauty,
                            Construction, Energy,
                            and Packaging.</li>
                        <li>Features detailed subcategories for precise sourcing and ongoing updates
                            based on
                            market needs.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">How does GlobPulse support
                        international
                        trade and global business growth?</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>It enables global exposure with multilingual support and cross-border
                            communication
                            tools.</li>
                        <li>Offers market insights and secure platforms for managing international
                            buyer-supplier relationships.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <h4 style="font-weight: 600; font-size: 16px;">How can I buy products on
                        GlobPulse</h4>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <ul class="custom-list mx-auto" style="list-style-type: disc;">
                        <li>To purchase products on GlobPulse, sign up or log in, browse the product
                            categories,
                            select a product, and click "Contact Supplier" to connect directly with
                            the seller.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- TOGGLE BUTTON -->
        <div class="text-center mt-4">
            <button class="btn btn-primary" id="toggleMoreBtn" onclick="toggleMoreFaqs()">Read
                More</button>
        </div>
    </div>
    <script>
        function toggleFAQ(el) {
            const answer = el.querySelector('.faq-answer');
            const icon = el.querySelector('.faq-icon');
            const isOpen = answer.style.display === 'block';

            document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
            document.querySelectorAll('.faq-icon').forEach(i => i.innerText = '+');

            if (!isOpen) {
                answer.style.display = 'block';
                icon.innerText = '-';
            }
        }

        function toggleMoreFaqs() {
            const moreFaqs = document.getElementById('more-faqs');
            const btn = document.getElementById('toggleMoreBtn');

            if (moreFaqs.style.display === 'none') {
                moreFaqs.style.display = 'block';
                btn.innerText = 'Show Less';
            } else {
                moreFaqs.style.display = 'none';
                btn.innerText = 'Read More';
                document.querySelector('.faq-container').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    </script>

</div>

{{--
<script>
    function toggleFAQ(currentItem) {
        const items = document.querySelectorAll('.faq-item');
        items.forEach(item => {
            if (item !== currentItem) {
                item.classList.remove('active');
                item.querySelector('.faq-icon').textContent = '+';
            }
        });

        currentItem.classList.toggle('active');
        const icon = currentItem.querySelector('.faq-icon');
        icon.textContent = currentItem.classList.contains('active') ? '-' : '+';
    }
</script> --}}



<livewire:front.layout.footer />
</main>
@if (session()->has('message'))
    <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3" role="alert"
        id="alert">
        <span class="fas fa-check-circle text-success fs-7 me-3"></span>
        <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
        <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss=" alert" aria-label="Close"></button>
    </div>
@endif</div>