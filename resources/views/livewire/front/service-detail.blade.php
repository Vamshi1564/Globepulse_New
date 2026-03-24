@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $service->title ?? '' }} | GlobPulse</title>
    <meta name="description" content="{{ Str::limit(strip_tags($service->description ?? ''), 160) }}">
    <meta name="keywords" content="{{ $service->keywords ?? '' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $service->title ?? '' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($service->description ?? ''), 160) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">
    <meta name="robots" content="index, follow">
@endpush

<div>
<livewire:front.layout.header />

<style>
    .swiper-button-next,
    .swiper-button-prev {
        width: 30px; height: 30px;
        background: #333; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 8px rgba(0,0,0,.2);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .swiper-button-next::after,
    .swiper-button-prev::after { font-size: 16px; color: white; }
    .swiper-button-next:hover,
    .swiper-button-prev:hover { transform: scale(1.1); box-shadow: 0 6px 12px rgba(0,0,0,.3); }
    .image-container { height: 100%; }
    .zoom-img {
        width: 100%; height: 100%; object-fit: contain;
        transition: transform .3s ease-in-out; cursor: zoom-in;
    }
    .thumbnail-img {
        width: 100%; object-fit: cover;
        transition: opacity .3s ease-in-out, border .3s ease-in-out; cursor: pointer;
    }
    .thumbnail-img:hover { opacity: .7; }
    .product-thumbnail-slider .swiper-slide-thumb-active .thumbnail-img {
        border: 3px solid #007bff; opacity: 1;
    }
    .product-slider-container {
        position: relative; display: flex; flex-direction: row;
        width: 100%; height: 400px; overflow: hidden;
    }
    .product-thumbnail-slider {
        padding-top: 10px; height: 100%; width: 80px; overflow: hidden;
        display: flex; flex-direction: column; justify-content: flex-start;
    }
    .product-thumbnail-slider .swiper-wrapper {
        display: flex; flex-direction: column; align-items: center;
    }
    .product-thumbnail-slider::-webkit-scrollbar { display: none; }
    .product-thumbnail-slider { -ms-overflow-style: none; scrollbar-width: none; }
    @media only screen and (max-width: 450px) {
        .product-thumbnail-slider { display: none; }
    }
    .supplier-logo { width: 60px; height: 60px; border-radius: 8px; object-fit: cover; }
    .supplier-info-container { display: flex; align-items: center; gap: 15px; }
    .flag { width: 24px; }
    .details-table td { padding: 4px 8px; font-size: 14px; vertical-align: middle; }
    .btn-custom { border-radius: 6px; font-size: 14px; padding: 7px 14px; }
    .popup-overlay {
        display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,.5); z-index: 1050;
        align-items: center; justify-content: center;
    }
    .popup-box { max-width: 850px; animation: fadeInPop .3s ease-in-out; }
    @keyframes fadeInPop {
        from { opacity: 0; transform: translateY(-30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .button-close1:hover { background-color: #eaa4a4; color: white; }
    .rfq-overlay {
        display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,.6); z-index: 9999;
        align-items: center; justify-content: center;
    }
    .rfq-box {
        max-width: 700px; width: 95%; background: #fff; border-radius: 10px;
        padding: 25px; position: relative; animation: fadeInPop .3s ease-in-out;
    }
    /* Similar services slider */
    .b2b-slider-section { margin: 20px auto; overflow: hidden; }
    .b2b-slider-header { display: flex; justify-content: space-between; align-items: center; }
    .b2b-title h3 { font-size: 1.4rem; color: #333; }
    .swiper-container.b2b-product-slider { padding-bottom: 30px; }
    .swiper-container.b2b-product-slider .swiper-slide { width: 280px; }
    .product-card {
        background: #fff; cursor: pointer; border-radius: 8px; overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,.1); transition: transform .3s ease, box-shadow .3s ease;
    }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,.15); }
    .card-body { padding: 15px; }
    .product-title { font-size: 16px; margin-bottom: 10px; line-height: 1.2; }
    .price-range { font-size: 14px; font-weight: bold; color: #333; margin-bottom: 8px; }
    .order-info, .business-type { font-size: 12px; color: #777; margin-bottom: 5px; }
    .service-placeholder {
        width: 100%; height: 100%; background: #f1f5f9;
        display: flex; align-items: center; justify-content: center;
        font-size: 5rem; color: #cbd5e1; border-radius: 3px;
    }
    .service-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 700;
        background: #dbeafe; color: #1e40af; margin-bottom: 8px; margin-right: 4px;
    }
    .service-badge.green  { background: #d1fae5; color: #065f46; }
    .service-badge.purple { background: #ede9fe; color: #5b21b6; }
</style>

<main class="main" id="top">
<div class="pt-5 pb-2">
<section class="py-0">
<div class="container-fluid">
<div class="row">

    {{-- ── LEFT: Image Slider ── --}}
    <div class="col-lg-6 mb-3">
        <div class="product-slider-container">

            {{-- Thumbnail (left side) --}}
            <div class="swiper product-thumbnail-slider me-3" style="min-width:60px;height:100%;">
                <div class="swiper-wrapper">
                    @if($images)
                        @foreach($images as $img)
                        <div class="swiper-slide">
                            <img class="img-fluid rounded-2 thumbnail-img"
                                src="{{ $this->imgUrl($img) }}" alt="Thumbnail">
                        </div>
                        @endforeach
                    @else
                        {{-- placeholder thumb --}}
                        <div class="swiper-slide">
                            <div style="width:60px;height:60px;background:#f1f5f9;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🛠️</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Main slider --}}
            <div class="swiper product-main-slider" style="flex-grow:1;overflow:hidden;">
                <div class="swiper-wrapper">
                    @if($images)
                        @foreach($images as $img)
                        <div class="swiper-slide">
                            <div class="image-container text-center">
                                <img class="img-fluid rounded-3 zoom-img"
                                    src="{{ $this->imgUrl($img) }}" alt="{{ $service->title }}">
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="swiper-slide">
                            <div class="service-placeholder">🛠️</div>
                        </div>
                    @endif
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var thumbSlider = new Swiper(".product-thumbnail-slider", {
            direction: 'vertical', spaceBetween: 10,
            slidesPerView: 5, freeMode: true,
            watchSlidesProgress: true, grabCursor: true, resistanceRatio: 0,
        });
        var mainSlider = new Swiper(".product-main-slider", {
            spaceBetween: 10, loop: true,
            autoplay: { delay: 2500, pauseOnMouseEnter: true, disableOnInteraction: false },
            speed: 800,
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            thumbs: { swiper: thumbSlider },
        });
        document.querySelectorAll('.zoom-img').forEach(img => {
            img.addEventListener('mousemove', function (e) {
                let rect = this.getBoundingClientRect();
                let x = ((e.clientX - rect.left) / rect.width) * 100;
                let y = ((e.clientY - rect.top) / rect.height) * 100;
                this.style.transformOrigin = `${x}% ${y}%`;
                this.style.transform = 'scale(1.2)';
            });
            img.addEventListener('mouseleave', function () {
                this.style.transform = 'scale(1)';
                this.style.transformOrigin = 'center center';
            });
        });
    });
    </script>

    {{-- ── RIGHT: Service Info ── --}}
    <div class="col-lg-6">
        <div class="container-fluid">

            {{-- Seller info row --}}
            <div class="supplier-info-container mb-3">
                <img class="supplier-logo"
                    src="{{ $seller && !empty($seller->profile_image) ? $this->imgUrl($seller->profile_image) : asset('assets/img/team/72x72/57.webp') }}"
                    alt="{{ $seller->name ?? 'Service Provider' }}">

                <div class="supplier-details">
                    <span class="fw-semibold supplier-name" style="font-size:15px;">
                        {{ $seller->name ?? 'Service Provider' }}
                    </span>
                    @if(!empty($seller->company))
                    <div style="font-size:13px;color:#666;">{{ $seller->company }}</div>
                    @endif

                    <div class="d-flex flex-wrap align-items-center gap-2 mt-1">
                        <span><img style="width:55px;" src="{{ asset('assets/img/logos/varify.gif') }}" class="me-1 my-0 p-0" alt=""></span>
                        <span class="badge bg-success badge-custom">
                            <img style="width:13px;" src="{{ asset('assets/img/check-mark (2).png') }}" class="me-1 my-0 p-0" alt="">
                            Verified Supplier
                        </span>
                    </div>
                </div>
            </div>

            {{-- Service type badges --}}
            <div class="mb-2">
                @if($service->service_type)
                <span class="service-badge">🛠️ {{ $service->service_type }}</span>
                @endif
                @if($service->delivery_mode)
                <span class="service-badge green">📍 {{ $service->delivery_mode }}</span>
                @endif
                @if(!empty($inclusions['pricing_model']))
                <span class="service-badge purple">{{ $inclusions['pricing_model'] }}</span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="fw-bold" style="font-size:21px;">{{ $service->title ?? 'N/A' }}</h1>

            {{-- Price --}}
            @if($service->min_price)
            <span class="mt-2 fs-8 fw-bold" style="color:#0056b3;">
                ₹{{ number_format($service->min_price) }}
                @if($service->price_unit) / {{ $service->price_unit }} @endif
            </span>
            @else
            <span class="mt-2 fs-8 fw-bold" style="color:#0056b3;">Price on Request</span>
            @endif

            {{-- Details table — mirrors product detail style --}}
            <div class="mt-2">
                <table class="details-table">
                    <tbody>
                        <tr>
                            <td class="pe-3">Service Type</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $service->service_type ?? 'Contact Supplier' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3">Delivery Mode</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $service->delivery_mode ?? 'Contact Supplier' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3">Turnaround Time</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $service->turnaround_time ?? 'Contact Supplier' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3">Contract Duration</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $inclusions['contract_duration'] ?? 'Contact Supplier' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3">Service Area</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $service->service_area ?? 'Contact Supplier' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3">Experience</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">
                                    {{ $service->experience_years ? $service->experience_years . ' Years' : 'Contact Supplier' }}
                                </span>
                            </td>
                        </tr>
                        @if($service->certifications)
                        <tr>
                            <td class="pe-3">Certifications</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $service->certifications }}</span>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="pe-3">Free Consultation</td>
                            <td>
                                <img src="{{ asset('assets/img/right-arrow.png') }}" style="width:20px;" alt="">
                                <span class="fw-bolder">{{ $service->sample_consultation === 'yes' ? '✅ Available' : 'Contact Supplier' }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Action buttons — same style as product page --}}
            <div class="">
                {{-- Share --}}
                <button class="btn btn-outline-secondary btn-custom dropdown-toggle mt-2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-share-alt me-2"></i> Share
                </button>
                <div class="dropdown">
                    <ul class="dropdown-menu w-50 p-2 shadow-lg border-0 mt-1">
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fa-brands fa-whatsapp me-2 text-success"></i> WhatsApp
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fa-brands fa-facebook me-2 text-primary"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fa-brands fa-x-twitter me-2 text-dark"></i> Twitter
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fa-brands fa-linkedin me-2 text-info"></i> LinkedIn
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="copyServiceLink()">
                                <i class="fas fa-copy me-2 text-secondary"></i> Copy Link
                            </a>
                        </li>
                    </ul>
                </div>

                <script>
                function copyServiceLink() {
                    navigator.clipboard.writeText("{{ url()->current() }}");
                    alert('🔗 Link copied successfully!');
                }
                </script>

                {{-- Contact Supplier --}}
                <a href="mailto:{{ $seller->email ?? '' }}">
                    <button class="btn btn-outline-success btn-custom mt-2">
                        <i class="fas fa-comments me-2"></i> Contact Supplier
                    </button>
                </a>

                {{-- Request For Quote --}}
                <button onclick="openServiceRFQ()" class="btn btn-outline-success btn-custom mt-2">
                    <i class="fas fa-file-invoice me-2"></i> Request For Quote (RFQ)
                </button>

                {{-- Supplier Information --}}
                @if($seller)
                <a href="{{ route('portfolio', $seller->id) }}">
                    <button class="btn btn-outline-success btn-custom mt-2">
                        <span class="fas fa-shopping-cart me-2"></span> Supplier Information
                    </button>
                </a>
                @endif

                {{-- Download brochure if available --}}
                @if($brochurePdf)
                <a href="{{ $this->imgUrl($brochurePdf) }}" target="_blank">
                    <button class="btn btn-outline-danger btn-custom mt-2">
                        <i class="bi bi-download me-2"></i> Download Brochure
                    </button>
                </a>
                @endif

            </div>{{-- end buttons --}}
        </div>
    </div>{{-- end col-lg-6 right --}}

</div>{{-- end row --}}
</div>{{-- end container-fluid --}}
</section>

{{-- ── Service Description ── --}}
<section class="p-0 mt-4">
    <div class="container-fluid">
        <div><h2>Service Description</h2></div>
        <div>
            <span>
                <div style="all:revert;">
                    {!! $service->description !!}
                </div>
            </span>
        </div>
    </div>
</section>

{{-- ── Industries Served ── --}}
@if(!empty($inclusions['industries_served']))
<section class="p-0 mt-4">
    <div class="container-fluid">
        <h5 class="fw-bold mb-3">Industries Served</h5>
        <div class="d-flex flex-wrap gap-2">
            @foreach($inclusions['industries_served'] as $industry)
            <span class="badge bg-light text-dark border" style="font-size:13px;padding:6px 12px;">{{ $industry }}</span>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Similar Services ── --}}
@if(!empty($similarServices) && count($similarServices) > 0)
<div class="container-fluid">
    <div class="b2b-slider-section">
        <div class="b2b-slider-header mb-3">
            <div class="b2b-title">
                <h3 class="fw-bolder">Similar Services</h3>
            </div>
        </div>
        <div class="swiper-container b2b-product-slider">
            <div class="swiper-wrapper">
                @foreach($similarServices as $simService)
                <div class="swiper-slide">
                    <div class="product-card rounded-4">
                        <a href="{{ route('service-detail', $simService['slug']) }}" style="text-decoration:solid;">
                            <div class="product-image position-relative">
                                @if(!empty($simService['cover_image']))
                                <img class="img-fluid transition rounded-1" loading="lazy"
                                    src="{{ $this->imgUrl($simService['cover_image']) }}"
                                    alt="{{ $simService['title'] ?? 'Service Image' }}">
                                @else
                                <div style="width:100%;height:180px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:3rem;">🛠️</div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="product-title"
                                    style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;text-overflow:ellipsis;max-height:3em;line-height:1.5em;word-break:break-word;">
                                    {{ $simService['title'] ?? 'N/A' }}
                                </h3>
                                <div class="price-range">
                                    <span class="price">
                                        @if($simService['min_price'])
                                            ₹{{ number_format($simService['min_price']) }}
                                            @if($simService['price_unit']) / {{ $simService['price_unit'] }}@endif
                                        @else
                                            Price on Request
                                        @endif
                                    </span>
                                </div>
                                <div class="order-info">
                                    <span>Type: {{ $simService['service_type'] ?? 'N/A' }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <img style="width:55px;mix-blend-mode:multiply;"
                                        src="{{ asset('assets/img/logos/varify.gif') }}" alt="">
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
@endif

{{-- ── RFQ Popup ── --}}
<div id="serviceRfqPopup" class="rfq-overlay" onclick="closeServiceRFQOutside(event)">
    <div class="rfq-box">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" onclick="closeServiceRFQ()"></button>
        <h4 class="fw-bold mb-4 text-center">Request For Quotation (RFQ)</h4>
        <form class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold"><i class="fas fa-briefcase me-2"></i> Service</label>
                <input type="text" class="form-control" value="{{ $service->title }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Your Name</label>
                <input type="text" class="form-control" placeholder="Enter your name">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" placeholder="Enter your email">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Phone</label>
                <input type="tel" class="form-control" placeholder="Enter your phone">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Budget</label>
                <input type="text" class="form-control" placeholder="e.g. ₹50,000">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Requirement</label>
                <textarea class="form-control" rows="3" placeholder="Describe your requirement..."></textarea>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-paper-plane me-2"></i> Send RFQ
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openServiceRFQ()  { document.getElementById("serviceRfqPopup").style.display = "flex"; }
function closeServiceRFQ() { document.getElementById("serviceRfqPopup").style.display = "none"; }
function closeServiceRFQOutside(e) { if (e.target.id === "serviceRfqPopup") closeServiceRFQ(); }
</script>

{{-- Similar services slider init --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.b2b-product-slider', {
        loop: true, slidesPerView: 4, spaceBetween: 20,
        autoplay: { delay: 5000, disableOnInteraction: false },
        breakpoints: {
            320: { slidesPerView: 2 },
            576: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            992: { slidesPerView: 5 }
        }
    });
});
</script>

@if(session()->has('message'))
<div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
    role="alert" id="alert">
    <span class="fas fa-check-circle text-success fs-7 me-3"></span>
    <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
    <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<script>setTimeout(() => document.getElementById('alert')?.remove(), 3000);</script>
@endif

</div>{{-- end pt-5 --}}
</main>

<livewire:front.layout.footer />
</div>