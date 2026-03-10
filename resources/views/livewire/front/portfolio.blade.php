@push('custom-meta')
    <meta name="robots" content="index, follow" />
@endpush
<div>

    <livewire:front.layout.header />

    <style>
        .profile-container {
            width: 100%;
            background: #f4f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .banner-wrapper {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .banner-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(70%);
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 20px;
            gap: 10px;
            margin-top: -70px;
            /* max-width: 1320px; */
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 10;
        }

        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .company-name h2 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #2b2b2b;
        }

        .company-name p {
            margin: 0;
            width: 90%;
            color: #777;
        }

        .contact {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact button {
            background: #007bff;
            border: none;
            color: white;
            font-weight: 600;
            /* padding: 10px 20px; */
            /* border-radius: 8px; */
            transition: 0.3s;
        }


        /*
        .contact button:hover {
            background: #0056b3;
        }

        .contact a {
            text-decoration: none;
            color: white;
        } */

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
                margin-top: -130px;
                /* width: 95%; */
                margin-x: auto;
            }

            /* .info {
                margin-top: 10px;
            } */

            .contact {
                align-items: center;
            }

            .banner-wrapper img {
                width: 100%;
                height: 70%;
                object-fit: initial;
                filter: brightness(70%);
            }

            .logo {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                border: 4px solid #fff;
                object-fit: cover;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            }

            .company-name p {
                margin: 0 auto;
                width: 94%;
                color: #777;
            }
        }

        @media (max-width: 1024px) {
            .profile-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
                margin-top: -130px;
                /* width: 95%; */
                margin-x: auto;
            }

            .company-name p {
                margin: 0 auto;
                width: 90%;
                color: #777;
            }
        }
    </style>

    <div class="profile-container">
        {{-- @foreach ($slider_images as $index => $item)
        @if ($index === 0)
        <div class="banner-wrapper">
            <img src="{{ config('app.pub_aws_url') . $item->slider_img }}" alt="Banner">
        </div>
        @endif

        @endforeach --}}

        @if (count($slider_images) > 0)
            @foreach ($slider_images as $item)
                <div class="banner-wrapper">
                    <img src="{{ config('app.pub_aws_url') . $item->slider_img }}" alt="Banner" />
                </div>
            @endforeach
        @else
            <div class="banner-wrapper">
                <img src="{{ asset('assets/img/background-img-cat.jpg') }}" alt="Default Banner" />
            </div>
        @endif



        <div class="container-fluid">
            <div class="profile-card ">
                <div>
                    @if ($customer->profile_image ?? "N/A")
                        <img class="logo" src="{{ config('app.pub_aws_url') . $customer->profile_image ?? "N/A" }}" alt="Logo" />
                    @else
                        <img class="logo" src="../../../assets/img/team/72x72/57.webp" alt="Logo" />
                    @endif
                </div>

                <div class="info ms-2">
                    <div class="company-name">
                        <h2>{{ $customer->company }}</h2>
                        <p><i class="fas fa-map-marker-alt me-1"></i> {{ $customer->address }}</p>
                    </div>
                </div>

                <div class=" d-flex flex-wrap justify-content-between">
                    <button id="toggleNumber" class="btn btn-sm bg-primary text-white me-2">
                        <i class="fas fa-phone me-1"></i> <a class="text-white"
                            href="tellto:{{ $customer->phonenumber }}">View Number</a>
                    </button>
                    <button class="btn btn-sm bg-primary text-white ms-2">
                        <i class="fas fa-envelope me-1"></i>
                        <a class="text-white" href="mailto:{{ $customer->email }}">Email Seller</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--
    <script>
        document.getElementById("toggleNumber").addEventListener("click", function () {
            let span = this.querySelector("span");
            if (span.innerText === "View Number") {
                span.innerText = "{{ $customer->phonenumber }}";
            } else {
                span.innerText = "View Number";
            }
        });
    </script> --}}


    <section class="py-5  rounded">
        <div class="container-fluid">
            <h3 class="text-uppercase fw-bold mb-4">About Our Company</h3>
            <p class="mb-5 fs-6 text-dark">
                <!-- Description content if needed -->
            </p>

            <div class="row text-start gy-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-building text-danger fs-6 me-3"></i>
                        <p class="mb-0 fs-9"><strong class="fs-8">Business Type:</strong> <br>
                            {{ optional($customer->products->first())->business_type ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-building text-danger fs-6 me-3"></i>
                        <p class="mb-0 fs-9"><strong class="fs-8">GST No:</strong><br>
                            {{ $customer->gst_no ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-users text-danger fs-6 me-3"></i>

                        <p class="mb-0 fs-9"><strong class="fs-8">Employee Count:</strong><br>
                            {{ $customer->employee_count ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-calendar-alt text-danger fs-6 me-3"></i>
                        <p class="mb-0 fs-9"><strong class="fs-8">Establishment:</strong><br>
                            {{ $customer->company_establish_date ? \Carbon\Carbon::parse($customer->company_establish_date)->format('d M Y') : 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-coins text-danger fs-6 me-3"></i>
                        <p class="mb-0 fs-9"><strong class="fs-8">Annual Turnover:</strong><br>
                            {{ $customer->annual_turnoer ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-calendar-check text-danger fs-6 me-3"></i>
                        <p class="mb-0 fs-9"><strong class="fs-8">Working Days:</strong>
                            <br>{{ $customer->working_day ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center bg-white shadow-sm p-2 px-3 rounded h-100">
                        <i class="fas fa-credit-card text-danger fs-6 me-3"></i>
                        <p class="mb-0 fs-9"><strong class="fs-8">Payment Mode:</strong><br>
                            {{ $customer->payment_mode ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <style>
        /* Container for the entire slider section */


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
            height: 180px;
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
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .rating {
            margin-bottom: 10px;
            font-size: 12px
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

        /* Navigation Buttons */
        .b2b-nav {
            color: #007bff;
            background: #fff;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease, color 0.3s ease;
        }

        .flag {
            width: 24px;
        }

        .b2b-nav:hover {
            background: #007bff;
            color: #fff;
        }
    </style>



    <section class="p-0 m-0">
        <div class="container-fluid">
            <div>
                <!-- Header -->
                <div class="b2b-slider-header">
                    <div class="b2b-title bold">
                        <h2>
                            Products
                        </h2>
                    </div>
                </div>

                <div class="row">

                    <div class="d-flex flex-wrap gx-3  mb-3">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4 col-lg-2 mb-4">
                                <div class="product-card rounded-4 h-100 shadow-sm mx-2">
                                    <a href="{{ $product->slug ? route('product-detail', ['slug' => $product->slug]) : '#' }}"
                                        class="text-decoration-none">
                                        <div class="product-image position-relative">
                                            @if (!empty($product->product_img))
                                                <img class="img-fluid transition rounded-3" loading="lazy"
                                                    src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                    alt="{{ $product->title ?? 'Product Image' }}" />
                                            @else
                                                <img class="img-fluid transition rounded-3" loading="lazy"
                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                    alt="No Image Available" />
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <h3 class="product-title "
                                                style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                {{ $product->title ?? 'N/A' }}
                                            </h3>

                                            <div class="price-range text-muted mb-1">
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

                                            <div class="order-info small text-secondary">
                                                Min Order: {{ $product->min_order ?? 'N/A' }}
                                            </div>

                                            <div class="business-type small text-secondary">
                                                Business Type: {{ $product->business_type ?? 'N/A' }}
                                            </div>

                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                <img style="width: 55px; mix-blend-mode: multiply;"
                                                    src="{{ asset('assets/img/logos/varify.gif') }}" alt="Verified">

                                                <span
                                                    class="small fw-bold text-success d-flex align-items-center gap-1">
                                                    @if (!empty($product->country->flag_img) && file_exists(public_path('assets/' . $product->country->flag_img)))
                                                        <img class="flag" style="width: 20px;" loading="lazy"
                                                            src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                            alt="{{ $product->country->short_name ?? 'Flag' }}" />
                                                    @else
                                                        <img class="flag" style="width: 20px;" loading="lazy"
                                                            src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="No Flag" />
                                                    @endif
                                                    {{ $product->country->iso2 ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>

        </div>

        @if ($products->hasMorePages())
            <div class="text-center my-2">
                <button wire:click="loadMore" wire:loading.remove class="btn btn-primary mb-3">
                    View More
                </button>
                <div wire:loading class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- begin Contact Us ============================-->

    <section class="p-0 m-0 bg-white mt-5">
        <div class="container">

            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class=" mb-3">
                        <h2 class="fw-bold text-gradient">Let's Connect</h2>
                        <p class="text-muted fs-7">Have questions? We're here to help!</p>
                    </div>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-3">
                            <i class="uil uil-phone contact-icon"></i>
                            <div class="flex-1 ms-3">Contact No. :-<a class="link-900"
                                    href="tel:{{ $customer->phonenumber }}">View Contact</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="uil uil-envelope contact-icon"></i>
                            <div class="flex-1 ms-3">Email :-<a class="fw-semibold "
                                    href="mailto:{{ $customer->email }}">View Email</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="uil uil-map-marker contact-icon"></i>
                            <span class="ms-3">{{ $customer->address }}</span>
                        </li>
                    </ul>

                    <ul class="example-2 flex-wrap d-flex justify-content-start mt-3 ps-0">
                        <li class="icon-content">
                            <a href="#" target="_blank" aria-label="facebook" data-social="facebook">
                                <div class="filled"></div>
                                <svg viewBox="0 0 16 16" fill="currentColor" class="bi bi-facebook" height="20"
                                    width="20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951">
                                    </path>

                                </svg>
                            </a>
                            <div class="tooltip">Facebook</div>
                        </li>

                        <li class="icon-content">
                            <a href="#" target="_blank" aria-label="twitter" data-social="twitter">
                                <div class="filled"></div>
                                <svg viewBox="0 0 16 16" fill="currentColor" class="bi bi-twitter" height="20"
                                    width="20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15">
                                    </path>

                                </svg>
                            </a>
                            <div class="tooltip">Twitter</div>
                        </li>

                        <li class="icon-content">
                            <a href="https://www.instagram.com/gfe.business/" target="_blank" aria-label="Instagram"
                                data-social="instagram">
                                <div class="filled"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16"
                                    xml:space="preserve">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <div class="tooltip">Instagram</div>
                        </li>

                        <li class="icon-content">
                            <a href="#" target="_blank" aria-label="LinkedIn" data-social="linkedin">
                                <div class="filled"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"
                                    xml:space="preserve">
                                    <path
                                        d=" M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526
                                                                                    1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943
                                                                                    12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554
                                                                                    1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327
                                                                                    1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0
                                                                                    1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274
                                                                                    0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <div class="tooltip">LinkedIn</div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form p-5 ">
                        <h4 class="fw-bolder fs-6 mb-4">Drop Us a Message</h4>
                        <form>
                            <div class="mb-4">
                                <input type="text" class="form-control stylish-input border" name="name"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control stylish-input border" name="email"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="mb-4">
                                <textarea class="form-control stylish-input border" rows="5" name="message" placeholder="Your Message"
                                    required></textarea>
                            </div>
                            <button class="btn btn-primary border w-100" type="submit">Send
                                Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-section {
            background: linear-gradient(135deg, #ffffff, #ffffff);
        }

        .contact-card,
        .contact-form {
            backdrop-filter: blur(10px);
            border-radius: 16px;
            /* box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); */
        }

        .contact-icon {
            font-size: 24px;
            color: #007bff;
        }

        .social-icons a {
            font-size: 20px;
            color: #007bff;
            transition: transform 0.3s ease-in-out;
        }

        .social-hover:hover {
            transform: scale(1.2);
        }

        .stylish-input {
            padding: 14px;
            border-radius: 10px;
            border: 2px solid transparent;
            /* background: rgba(255, 255, 255, 0.8); */
            transition: border-color 0.3s;
        }

        .stylish-input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-gradient {
            padding: 14px;
            border-radius: 10px;
            /* background: linear-gradient(45deg, #007bff, #00bcd4); */
            border: none;
            color: white;
            font-weight: bold;
        }

        .btn-gradient:hover {
            /* background: linear-gradient(45deg, #0056b3, #0097a7); */
        }
    </style>


    <!-- close Contact us ============================-->


    <livewire:front.layout.footer />

</div>
