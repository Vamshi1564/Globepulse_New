@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $metaTitle ?? '' }}</title>

    <!-- Meta Description -->
    <meta name="description" content="{{ $metaDescription ?? '' }}">

    <!-- Meta Keywords -->
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ $sitemapUrl ?? url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="{{ $metaTitle ?? '' }}">
    <meta property="og:description" content="{{ $metaDescription ?? '' }}">
    <meta property="og:url" content="{{ $sitemapUrl ?? url()->current() }}">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?? '' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? '' }}">
    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">

    <!-- Robots -->
    <meta name="robots" content="index, follow">
@endpush

<div>
    <livewire:front.layout.header />

    <style>
        .swiper-button-next,
        .swiper-button-prev {
            width: 30px;
            height: 30px;
            background: #333;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px;
            color: white;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .image-container {
            height: 100%;
        }


        /* Main Image */
        .zoom-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease-in-out;
            cursor: zoom-in;
        }

        /* Thumbnail Images */
        .thumbnail-img {
            width: 100%;
            /* height: 80px; */
            object-fit: cover;
            transition: opacity 0.3s ease-in-out, border 0.3s ease-in-out;
            cursor: pointer;
        }

        .thumbnail-img:hover {
            opacity: 0.7;
        }

        .product-thumbnail-slider .swiper-slide-thumb-active .thumbnail-img {
            border: 3px solid #007bff;
            opacity: 1;
        }

        .product-slider-container {
            position: relative;
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #000;
            font-size: 2px;
        }

        .product-thumbnail-slider {
            padding-top: 10px;
            height: 100%;
            width: 80px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .product-thumbnail-slider .swiper-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Hide Scrollbar */
        .product-thumbnail-slider::-webkit-scrollbar {
            display: none;
        }

        .product-thumbnail-slider {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }


        @media only screen and (max-width: 450px) {
            .product-thumbnail-slider {
                display: none
            }
        }
    </style>
    <main class="main" id="top">
        <div class="pt-5 pb-2">
            <section class="py-0">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-6 mb-3">
                            <div class="product-slider-container ">
                                <!-- Thumbnail Navigation (Left Side) -->
                                <div class="swiper  product-thumbnail-slider me-3"
                                    style="min-width: 60px; height: 100%;">
                                    <div class=" swiper-wrapper ">
                                        @foreach ($images ?? [] as $image)
                                            <div class=" swiper-slide ">
                                                <img class=" img-fluid rounded-2 thumbnail-img "
                                                    src=" {{ config('app.pub_aws_url') . $image }}" alt="Thumbnail">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Main Image Slider -->
                                <div class="swiper product-main-slider" style="flex-grow: 1; overflow: hidden;">
                                    <div class="swiper-wrapper">
                                        @foreach ($images ?? [] as $image)
                                            <div class="swiper-slide">
                                                <div class="image-container text-center">
                                                    <img class="img-fluid rounded-3 zoom-img"
                                                        src="{{ config('app.pub_aws_url') . $image }}" alt="Product Image">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                // Initialize Thumbnail Slider (Vertical)
                                var thumbSlider = new Swiper(".product-thumbnail-slider", {
                                    direction: 'vertical',
                                    spaceBetween: 10,
                                    slidesPerView: 5,
                                    freeMode: true,
                                    watchSlidesProgress: true,
                                    grabCursor: true,
                                    resistanceRatio: 0,
                                });

                                // Initialize Main Image Slider
                                var mainSlider = new Swiper(".product-main-slider", {
                                    spaceBetween: 10,
                                    loop: true,
                                    autoplay: {
                                        delay: 2500,
                                        pauseOnMouseEnter: true,
                                        disableOnInteraction: false,
                                    },
                                    speed: 800,
                                    navigation: {
                                        nextEl: ".swiper-button-next",
                                        prevEl: ".swiper-button-prev",
                                    },
                                    thumbs: {
                                        swiper: thumbSlider,
                                    },
                                });

                                // Image Zoom Effect on Hover
                                document.querySelectorAll('.zoom-img').forEach(img => {
                                    img.addEventListener('mousemove', function(e) {
                                        let rect = this.getBoundingClientRect();
                                        let x = ((e.clientX - rect.left) / rect.width) * 100;
                                        let y = ((e.clientY - rect.top) / rect.height) * 100;
                                        this.style.transformOrigin = `${x}% ${y}%`;
                                        this.style.transform = 'scale(1.2)';
                                    });

                                    img.addEventListener('mouseleave', function() {
                                        this.style.transform = 'scale(1)';
                                        this.style.transformOrigin = 'center center';
                                    });
                                });
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="container-fluid">
                                <style>
                                    .supplier-logo {
                                        width: 60px;
                                        height: 60px;
                                        border-radius: 8px;
                                        object-fit: cover;
                                    }

                                    .supplier-info-container {
                                        display: flex;
                                        align-items: center;
                                        gap: 15px;
                                    }

                                    .flag {
                                        width: 24px;
                                    }
                                </style>

                                <div class="supplier-info-container mb-3">
                                    {{-- @if ($product->customer->profile_image ?? 'N/A')
                                        <img class=" supplier-logo"
                                            src="{{ config('app.pub_aws_url') . $product->customer->profile_image ?? "N/A" }}" alt="" />
                                    @else
                                        <img class="rounded-circle" src="../../../assets/img/team/72x72/57.webp" alt="" />
                                    @endif --}}
                                    @if (!empty($product->customer) && !empty($product->customer?->profile_image))
                                        <img class="supplier-logo"
                                            src="{{ config('app.pub_aws_url') . $product->customer->profile_image }}"
                                            alt="Supplier Logo">
                                    @else
                                        <img class="rounded-circle" src="{{ asset('assets/img/team/72x72/57.webp') }}"
                                            alt="Default Supplier">
                                    @endif

                                    <div class="supplier-details">
                                        {{-- <a class="fw-semibold supplier-name"
                                            href="{{ route('portfolio', $product->customer->id) }}">{{ $product->customer->company ?? '' }}</a> --}}
                                        @if (!empty($product->customer))
                                            <a class="fw-semibold supplier-name"
                                                href="{{ route('portfolio', $product->customer->id) }}">
                                                {{ $product->customer->company ?? 'Unknown Supplier' }}
                                            </a>
                                        @else
                                            <span class="fw-semibold text-muted">Unknown Supplier</span>
                                        @endif

                                        <span class="small fw-bold text-success ms-1">
                                            @if (
    !empty($product->country) &&
    !empty($product->country->flag_img) &&
    file_exists(public_path('assets/' . $product->country->flag_img))
)
                                                <img class="flag" loading="lazy"
                                                    src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                    alt="{{ $product->country->short_name ?? 'Product Image' }}" />
                                            @else
                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                    alt="No Image Available" />
                                            @endif
                                            {{ !empty($product->country) ? $product->country->iso2 : 'N/A' }}
                                        </span>
                                        <div class="d-flex flex-wrap align-items-center gap-2 ">
                                            <span class=""><img style="width: 55px;"
                                                    src="../../assets/img/logos/varify.gif" class="me-1 my-0 p-0 "
                                                    alt=""></span>
                                            <span class="badge bg-success badge-custom"><img style="width: 13px;"
                                                    src="../../assets/img/check-mark (2).png" class="me-1 my-0 p-0"
                                                    alt="">Verified Supplier</span>
                                            <span class="badge bg-primary badge-custom">Best Seller</span>
                                        </div>
                                    </div>
                                </div>

                                <h1 class=" fw-bold" style="font-size: 21px;">
                                    {{ !empty($product->title) ? $product->title : 'N/A' }}</h1>

                                <span class="mt-2 fs-8 fw-bold" style="color: #0056b3">
                                    {{ !empty($product->country) ? $product->country->currency_symbol : '' }}
                                    {{ $product->min_price ?? '' }} -
                                    {{ !empty($product->country) ? $product->country->currency_symbol : '' }}
                                    {{ $product->max_price ?? '' }}
                                    ({{ !empty($product->country) ? $product->country->currency : '' }})
                                </span>

                                <div class="mt-2 ">
                                    <table class="details-table">
                                        <tbody>
                                            <tr>
                                                <td class="pe-3">Minimum order quantity </td>
                                                <td data-label="Minimum order quantity ">
                                                    <img src="../assets/img/right-arrow.png" style="width:20px;"
                                                        alt="">
                                                    <span class=" fw-bolder">{{ $product->min_order ?? 'N/A' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">Port of dispatch </td>
                                                <td data-label="Port of dispatch"><img
                                                        src="../assets/img/right-arrow.png" style="width:20px;"
                                                        alt="">
                                                    <span class="fw-bolder">Contact
                                                        Supplier</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">Processing time </td>
                                                <td data-label="Processing time">
                                                    <img src="../assets/img/right-arrow.png" style="width:20px;"
                                                        alt="">
                                                    <span class=" fw-bolder">Contact
                                                        Supplier</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">Estimate pricing </td>
                                                <td data-label="Estimate pricing"><img
                                                        src="../assets/img/right-arrow.png" style="width:20px;"
                                                        alt="">
                                                    <span class=" fw-bolder">Contact
                                                        Supplier</span>
                                                        
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">Packaging </td>
                                                <td data-label="Packaging"><img src="../assets/img/right-arrow.png"
                                                        style="width:20px;" alt="">
                                                    <span class=" fw-bolder">Contact
                                                        Supplier</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">Availability </td>
                                                <td data-label="Availability"><img src="../assets/img/right-arrow.png"
                                                        style="width:20px;" alt="">
                                                    <span class=" fw-bolder">In
                                                        stock</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="">
                                    <button class="btn btn-outline-secondary btn-custom dropdown-toggle mt-2 "
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-share-alt me-2"></i> Share
                                    </button>
                                    {{-- <div class="dropdown">

                                        <ul class="dropdown-menu w-50 p-2 shadow-lg border-0 mt-1"
                                            aria-labelledby="shareDropdown">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://api.whatsapp.com/send?text={{ urlencode($product->slug ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-whatsapp me-2 text-success"></i> WhatsApp
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($product->slug ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-facebook me-2 text-primary"></i> Facebook
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://twitter.com/intent/tweet?url={{ urlencode($product->slug ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-x-twitter me-2 text-dark"></i> Twitter
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($product->slug ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-linkedin me-2 text-info"></i> LinkedIn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="javascript:void(0);" onclick="copyLink()">
                                                    <i class="fas fa-copy me-2 text-secondary"></i> Copy Link
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <script>
                                        function copyLink() {
                                            navigator.clipboard.writeText(
                                                "{{ $product->slug ? url('product-detail/' . $product->slug) : url()->current() }}");
                                        }
                                    </script> --}}

                                    <div class="dropdown">
                                        <ul class="dropdown-menu w-50 p-2 shadow-lg border-0 mt-1"
                                            aria-labelledby="shareDropdown">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://api.whatsapp.com/send?text={{ urlencode(!empty($product) && !empty($product->slug) ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-whatsapp me-2 text-success"></i> WhatsApp
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(!empty($product) && !empty($product->slug) ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-facebook me-2 text-primary"></i> Facebook
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://twitter.com/intent/tweet?url={{ urlencode(!empty($product) && !empty($product->slug) ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-x-twitter me-2 text-dark"></i> Twitter
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(!empty($product) && !empty($product->slug) ? url('product-detail/' . $product->slug) : url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-linkedin me-2 text-info"></i> LinkedIn
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="javascript:void(0);" onclick="copyLink()">
                                                    <i class="fas fa-copy me-2 text-secondary"></i> Copy Link
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <script>
                                        function copyLink() {
                                            navigator.clipboard.writeText(
                                                "{{ !empty($product) && !empty($product->slug) ? url('product-detail/' . $product->slug) : url()->current() }}"
                                            );
                                            alert('🔗 Link copied successfully!');
                                        }
                                    </script>


                                    {{-- @if (session('id') != $product->customer->id)
                                        <a
                                            href="{{ route('product-inquiry', ['customer_id' => $product->customer->id, 'product_id' => $product->id]) }}"><button
                                                class="btn btn-outline-success btn-custom mt-2 "><i
                                                    class="fas fa-comments me-2"></i>
                                                Contact
                                                Supplier</button></a>
                                                
                                    @endif

                                    
                                    <a href="{{ route('portfolio', $product->customer->id) }}"><button
                                            class="btn btn-outline-success btn-custom mt-2"><span
                                                class="fas fa-shopping-cart me-2"></span>Supplier
                                            Information</button></a>


                                    @if (session('id') != $product->customer->id)
                                        <a onclick="showPopup()"><button
                                                class="btn btn-outline-success btn-custom mt-2  "><span
                                                    class="fas fa-handshake me-2"></span>Become a
                                                Distributor</button></a>
                                    @endif --}}
                                    @if ($product->customer && session('id') != $product->customer->id)
                                        <a
                                            href="{{ route('product-inquiry', ['customer_id' => $product->customer->id, 'product_id' => $product->id]) }}">
                                            <button class="btn btn-outline-success btn-custom mt-2">
                                                <i class="fas fa-comments me-2"></i> Contact Supplier
                                            </button>
                                        </a>
<button onclick="openRFQ()" class="btn btn-outline-success btn-custom mt-2">
    <i class="fas fa-file-invoice me-2"></i> Request For Quote (RFQ)
</button>
                                    @endif

                                    @if ($product->customer)
                                        <a href="{{ route('portfolio', $product->customer->id) }}">
                                            <button class="btn btn-outline-success btn-custom mt-2">
                                                <span class="fas fa-shopping-cart me-2"></span> Supplier Information
                                            </button>
                                        </a>
                                    @endif

                                    @if ($product->customer && session('id') != $product->customer->id)
                                        <a onclick="showPopup()">
                                            <button class="btn btn-outline-success btn-custom mt-2">
                                                <span class="fas fa-handshake me-2"></span> Become a Distributor
                                            </button>
                                        </a>
                                    @endif

                                    <style>
                                        .glass-card1 {
                                            background-image: linear-gradient(rgba(0, 0, 0, 0.254), rgba(0, 0, 0, 0.331)), url(../../assets/img/dis.avif);
                                            background-size: cover;
                                            background-position: center;
                                            backdrop-filter: blur(12px);
                                            -webkit-backdrop-filter: blur(12px);
                                            border: 1px solid rgba(255, 255, 255, 0.94);
                                            transition: all 0.4s ease;
                                            min-height: 320px;
                                        }
                                    </style>



                                    <!-- Popup Form -->
                                    <div id="popupForm" class="popup-overlay">
                                        <div class="popup-box container-fluid">
                                            <div class="position-relative bg-white text-dark p-4 rounded shadow-lg">
                                                <button type="button"
                                                    class="btn-close button-close1 position-absolute top-0 end-0 m-3"
                                                    onclick="closePopup()" aria-label="Close"></button>
                                                <h4 class="fw-bold mb-4">Apply To Distribution Partner </h4>

                                                <form class="row g-3" wire:submit.prevent="addDistribution">
                                                    <div class="col-md-6">
                                                        <label class="form-label text-left">Full Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter your full name" wire:model="name"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter your email" wire:model="email"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Phone</label>
                                                        <input type="tel" class="form-control"
                                                            placeholder="Enter your phone number"
                                                            wire:model="phone_number" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">City</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter your city" wire:model="city" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Country</label>
                                                        <select class="form-select" wire:model="country" required>
                                                            <option value="">Select your country</option>
                                                            @foreach ($countries as $c)
                                                                <option value="{{ $c->country_id }}">
                                                                    {{ $c->short_name }}
                                                                </option>
                                                            @endforeach
                                                            <!-- Add more countries as needed -->
                                                        </select>
                                                    </div>


                                                    <div class="col-12">
                                                        <label class="form-label">Message</label>
                                                        <textarea class="form-control" placeholder="Tell us why you're interested…" wire:model="message" rows="4"
                                                            required></textarea>
                                                    </div>

                                                    <div class="col-12 text-end">
                                                        <button type="submit"
                                                            class="btn btn-primary px-4">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
<script>
function openRFQ() {
    document.getElementById("rfqPopup").style.display = "flex";
}

function closeRFQ() {
    document.getElementById("rfqPopup").style.display = "none";
}

// Close when clicking outside
function closeRFQOutside(e) {
    if (e.target.id === "rfqPopup") {
        closeRFQ();
    }
}
</script>
<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('closeRFQModal', () => {
        document.getElementById("rfqPopup").style.display = "none";
    });
});
document.addEventListener('livewire:init', () => {
    Livewire.on('openRFQModalDelayed', () => {
        setTimeout(() => {
            const el = document.getElementById("rfqPopup");
            if (el) el.style.display = "flex";
        }, 300);
    });
});
</script>
<style>
.rfq-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.rfq-box {
    max-width: 700px;
    width: 95%;
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
                                    <!-- RFQ POPUP -->
<!-- RFQ POPUP -->
<div wire:ignore.self id="rfqPopup" class="rfq-overlay" onclick="closeRFQOutside(event)">
    
    <div class="rfq-box" onclick="event.stopPropagation()">

        <!-- Close Button -->
        <button type="button"
            class="btn-close position-absolute top-0 end-0 m-3"
            onclick="closeRFQ()"></button>

        <h4 class="fw-bold mb-4 text-center">Request For Quotation (RFQ)</h4>

        <form wire:submit.prevent="submitRFQ" class="row g-3" novalidate>

            <!-- Product -->
            <div class="col-12">
                <label class="form-label fw-semibold text-start">
                    <i class="fas fa-box me-2"></i> Product
                </label>
                <input type="text"
                    class="form-control"
                    value="{{ $product->title }}"
                    readonly>
            </div>

            <!-- Quantity -->
            <div class="col-md-6">
                <label class="form-label fw-semibold text-start">Quantity</label>
                <div class="input-group">
    <input type="number"
        wire:model.live="rfq_quantity"
        
        class="form-control @error('rfq_quantity') is-invalid @enderror"
        placeholder="Enter quantity">

    <span class="input-group-text">
        {{ $product->unit ?? 'unit'  }}
    </span>
</div>

<small class="text-muted">
    MOQ: {{ $product->min_order }}
</small>
               @error('rfq_quantity')
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
            </div>

            <!-- Target Price -->
            <div class="col-md-6">
                <label class="form-label fw-semibold text-start">Target Price</label>
                <div class="input-group">
    <span class="input-group-text">₹</span>

    <input type="number"
        wire:model="rfq_target_price"
        class="form-control"
        placeholder="Target price">

    <span class="input-group-text">
        / {{ $product->unit ?? 'unit' }}
    </span>
</div>
            </div>

            <!-- Shipping -->
            <div class="col-md-6">
                <label class="form-label fw-semibold text-start">
                    <i class="fas fa-ship me-2"></i> Shipping Terms
                </label>

                <select wire:model="rfq_shipping_terms" class="form-select">
                    <option value="">Select Shipping Term</option>
                    <option value="FOB">FOB (Free On Board)</option>
                    <option value="CIF">CIF (Cost, Insurance & Freight)</option>
                    <option value="EXW">EXW (Ex Works)</option>
                </select>
                <small class="text-muted">
                Choose based on who handles shipping responsibility
            </small>
            </div>

                        <!-- Delivery -->
                       <div class="col-md-6">
    <label class="form-label fw-semibold text-start">Delivery Time</label>

    <select wire:model="rfq_delivery_time" class="form-control">
        <option value="">Select delivery time</option>
        <option value="1-3 days">1-3 days</option>
        <option value="3-5 days">3-5 days</option>
        <option value="7 days">7 days</option>
        <option value="10 days">10 days</option>
        <option value="14 days">14 days</option>
        <option value="21 days">21 days</option>
        <option value="30 days">30 days</option>
        <option value="45 days">45 days</option>
        <option value="60 days">60 days</option>
        <option value="90 days">90 days</option>
    </select>
</div>

                        <div class="col-md-6">
                <label class="form-label fw-semibold">
    Delivery Location
</label>

<input type="text"
    wire:model="rfq_destination_port"
    class="form-control"
    placeholder="Enter city, address or location (e.g. Hyderabad, India)">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Payment Terms</label>
                <select wire:model="rfq_payment_terms" class="form-select">
                    <option value="">Select Payment Terms</option>
                    <option value="Advance">Advance</option>
                    <option value="LC">Letter of Credit (LC)</option>
                    <option value="Net 30">Net 30</option>
                    <option value="Net 60">Net 60</option>
                </select>
            </div>

            <!-- <div class="col-12">
                <label class="form-label fw-semibold">Attachment (Optional)</label>
                <input type="file" wire:model="rfq_attachment" class="form-control">
            </div> -->

            <!-- Message -->
            <div class="col-12">
                <label class="form-label fw-semibold text-start">Requirement</label>
                <textarea wire:model.live="rfq_message"
                    class="form-control"
                    rows="3"
                    placeholder="Describe your requirement..."></textarea>
                    @error('rfq_message') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Submit -->
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary px-4" wire:loading.attr="disabled">
                    <i class="fas fa-paper-plane me-2"></i> <span wire:loading.remove>Send RFQ</span>
                     <span wire:loading>Sending...</span>
                </button>
            </div>

        </form>
    </div>
</div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>


            <section class="p-0  mt-4 ">
                <div class="container-fluid">
                    <div>
                        <h2>Products Description</h2>
                    </div>
                    <div>
                        <span>
                          <div style="all: revert;">
    {!! $product->description !!}
</div>
                        </span>
                    </div>
                </div>
            </section>
        </div>

        {{-- ///////////////////// Similar Products//////////////////////////// --}}

        <div class="container-fluid">
            <div class="b2b-slider-section">
                <div class="b2b-slider-header mb-3">
                    <div class="b2b-title">
                        <h3 class="fw-bolder">
                            Similar Products
                        </h3>
                    </div>
                </div>
                <div class="swiper-container b2b-product-slider">
                    <div class="swiper-wrapper">
                        @foreach ($similarProducts as $simProduct)
                            <div class="swiper-slide">
                                <div class="product-card rounded-4">
                                    <a style="text-decoration: solid" {{-- href="{{ $simProduct->slug ? route('product-detail', ['slug' => $simProduct->slug]) : '#' }}" --}}
                                        href="{{ !empty($simProduct) && !empty($simProduct->slug) ? route('product-detail', ['slug' => $simProduct->slug]) : '#' }}">
                                        <div class="product-image position-relative ">
                                            @if (!empty($simProduct->product_img))
                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                    src="{{ config('app.pub_aws_url') . $simProduct->product_img }}"
                                                    alt="{{ $simProduct->title ?? 'Product Image' }}" />
                                            @else
                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                    alt="No Image Available" />
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h3 class="product-title"
                                                style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                {{ $simProduct->title ?? 'N/A' }}
                                            </h3>
                                            <div class="price-range">
                                                <span class="price">
                                                    {{ !empty($simProduct->country) ? $simProduct->country->currency_symbol : '' }}
                                                    {{ $simProduct->min_price ?? 'N/A' }} </span> -
                                                <span
                                                    class="price">{{ !empty($simProduct->country) ? $simProduct->country->currency_symbol : '' }}
                                                    {{ $simProduct->max_price ?? 'N/A' }} </span>
                                            </div>
                                            <div class="order-info">
                                                <span>Min Order: {{ $simProduct->min_order ?? 'N/A' }}</span>
                                            </div>
                                            <div class="business-type">
                                                <span>business-type:
                                                    {{ $simProduct->business_type ?? 'N/A' }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <img style="width: 55px; mix-blend-mode: multiply;"
                                                    src="../assets/img/logos/varify.gif" alt="">
                                                <span class="small fw-bold text-success ms-1">
                                                    @if (
        !empty($simProduct->country) &&
        !empty($simProduct->country->flag_img) &&
        file_exists(public_path('assets/' . $simProduct->country->flag_img))
    )
                                                        <img class="flag" loading="lazy"
                                                            src="{{ asset('assets/' . $simProduct->country->flag_img) }}"
                                                            alt="{{ $simProduct->country->short_name ?? 'Product Image' }}" />
                                                    @else
                                                        <img class="img-fluid transition rounded-1" loading="lazy"
                                                            src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="No Image Available" />
                                                    @endif
                                                    {{ !empty($simProduct->country) ? $simProduct->country->iso2 : 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="swiper-container b2b-product-slider b2b-product-sliderr3 ">
                    <div class="swiper-wrapper">
                        @foreach ($similarProducts as $simProduct)
                            <div class="swiper-slide">
                                <div class="product-card rounded-4 ">
                                    <a style="text-decoration: solid" {{-- href="{{ $simProduct->slug ? route('product-detail', ['slug' => $simProduct->slug]) : '#' }}" --}}
                                        href="{{ !empty($simProduct) && !empty($simProduct->slug) ? route('product-detail', ['slug' => $simProduct->slug]) : '#' }}">
                                        <div class="product-image position-relative ">
                                            @if (!empty($simProduct->product_img))
                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                    src="{{ config('app.pub_aws_url') . $simProduct->product_img }}"
                                                    alt="{{ $simProduct->title ?? 'Product Image' }}" />
                                            @else
                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                    alt="No Image Available" />
                                            @endif
                                        </div>

                                        <div class="card-body ">
                                            <h3 class="product-title"
                                                style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;">
                                                {{ $simProduct->title ?? 'N/A' }}
                                            </h3>

                                            <div class="price-range">
                                                <span class="price">
                                                    {{ !empty($simProduct->country) ? $simProduct->country->currency_symbol : '' }}
                                                    {{ $simProduct->min_price ?? 'N/A' }}
                                                </span>
                                                -
                                                <span class="price">
                                                    {{ !empty($simProduct->country) ? $simProduct->country->currency_symbol : '' }}
                                                    {{ $simProduct->max_price ?? 'N/A' }}
                                                    ({{ !empty($simProduct->country) ? $simProduct->country->currency : 'N/A' }})
                                                </span>
                                            </div>

                                            <div class="order-info">
                                                <span>Min Order: {{ $simProduct->min_order ?? 'N/A' }}</span>
                                            </div>

                                            <div class="business-type">
                                                <span>Business Type:
                                                    {{ $simProduct->business_type ?? 'N/A' }}</span>
                                            </div>

                                            <div class="d-flex align-items-center gap-2">
                                                <div>
                                                    <img class="p-0 m-0"
                                                        style="width: 55px; mix-blend-mode: multiply;"
                                                        src="{{ asset('assets/img/logos/varify.gif') }}"
                                                        alt="Verified">
                                                </div>
                                                <span class="small fw-bold text-success">
                                                    @if (
        !empty($simProduct->country) &&
        !empty($simProduct->country->flag_img) &&
        file_exists(public_path('assets/' . $simProduct->country->flag_img))
    )
                                                        <img class="flag" loading="lazy"
                                                            src="{{ asset('assets/' . $simProduct->country->flag_img) }}"
                                                            alt="{{ $simProduct->country->short_name ?? 'Product Image' }}" />
                                                    @else
                                                        <img class="img-fluid transition rounded-1" loading="lazy"
                                                            src="{{ asset('assets/img/no-image.png') }}"
                                                            alt="No Image Available" />
                                                    @endif
                                                    {{ !empty($simProduct->country) ? $simProduct->country->iso2 : 'N/A' }}


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
                /* padding: 15px 20px; */
            }

            /* Animated Title Effect */
            .b2b-title h3 {
                font-size: 1.4rem;
                /* font-weight: bold; */
                color: #333;
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
            document.addEventListener('DOMContentLoaded', function() {
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


































        <style>
            .supplier-card {
                background-color: white;
                padding: 30px 20px;
            }

            .view-profile {
                font-size: 14px;
                padding: 5px;
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },

                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 3,
                            /* 3 slides for large screens */
                        },
                        768: {
                            slidesPerView: 2,
                            /* 2 slides for tablets */
                        },
                        480: {
                            slidesPerView: 1,
                            /* 1 slide for mobile */
                        },
                    },
                });
            });
        </script>



        @if (session()->has('message'))
            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                role="alert" id="alert">
                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>

            <script>
                setTimeout(() => document.getElementById('alert')?.remove(), 3000); // Auto-hide after 3 seconds
            </script>
        @endif


    </main>

    <livewire:front.layout.footer />

</div>
