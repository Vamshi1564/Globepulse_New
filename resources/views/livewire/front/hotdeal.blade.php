@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hot Deals You Can't Miss - Save Big on Top Offers Today!</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Discover today’s hottest deals! Shop top products at amazing discounts and enjoy big savings before time runs out." />

    <!-- Meta Keywords (Optional) -->
    <meta name="keywords"
        content="hot deals, best deals, limited time offers, flash sales, discounts, special offers, bargain prices, today’s deals, online deals, exclusive offers, top discounts, save big, last-minute deals, sale alerts, must-have bargains" />

    <!-- Robots -->
    <meta name="robots" content="index, follow" />

    <!-- Canonical -->
    <link rel="canonical" href="https://www.globpulse.com/hotdeal" />

    <!-- Open Graph Meta Tags (For Social Sharing) -->
    <meta property="og:title" content="Hot Deals You Can't Miss - Save Big on Top Offers Today!" />
    <meta property="og:description"
        content="Discover today’s hottest deals! Shop top products at amazing discounts and enjoy big savings before time runs out." />

   <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/globpluse.jpg" />
    <meta property="og:url" content="https://www.globpulse.com" />
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Globpulse Mart" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Hot Deals You Can't Miss - Save Big on Top Offers Today!">
    <meta name="twitter:description"
        content="Discover today’s hottest deals! Shop top products at amazing discounts and enjoy big savings before time runs out.">
    {{--
    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/Globpulse.png"> --}}

    <!-- Schema.org Structured Data -->


    <!-- Author (For Blogs or Articles) -->
    <meta name="author" content="Globpulse">
@endpush




<div>
    <livewire:front.layout.header />

    <style>
        .deal-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .deal-img {
            padding: 10px 0;
            height: 180px;
            object-fit: cover;
        }

        .countdown {
            font-weight: 600;
            color: #dc3545;
        }
    </style>
    <header class="bg-gradient-primary text-white text-center py-5 mb-5 shadow-sm">
        <div class="container">
            <h1 class="display-5 fw-bold text-light">
                <i class="fa-solid fa-fire-flame-curved me-2"></i> Hot Deals Just for You!
            </h1>
            <p class="lead mb-0">Get the best business deals before time runs out! </p>
        </div>
    </header>

    <div class="container-fluid">
        <!-- Search Section -->
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-8 col-lg-6">
                <form wire:submit.prevent='searchHotDeals' class="input-group">
                    <input type="text" class="form-control py-2 border-2" placeholder="Search by product name..."
                        wire:model.defer="search">
                    <button class="btn btn-primary px-4" type="submit">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Deals Grid -->
        <div class="row g-2 mb-5">
            @forelse($hotDeals as $deal)




                <div class="col-6 col-md-4 col-lg-2 mb-4">
                    <div class="product-card rounded-4 h-100 shadow-sm  bg-white p-3">

                        <div class="product-image position-relative">
                            <img class="img-fluid transition rounded-3" loading="lazy"
                                src="{{ config('app.pub_aws_url') . $deal->product->product_img }}"
                                alt="{{ $product->title ?? 'Product Image' }}" />
                        </div>

                        <div class="card-body">
                            <h2 class="product-title fs-8 "
                                style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; word-break: break-word;">
                                {{ $deal->product->title ?? 'N/A' }}
                            </h2>
                            <p class="text-muted small p-0 m-0 mb-2">
                                {{ Str::limit($deal->description ?? 'No description', 70) }}
                            </p>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <img src="{{ asset('../../assets/img/logos/varify.gif') }}" alt="Verified"
                                    style="width: 45px; mix-blend-mode: multiply;">
                                <span class="badge bg-light text-dark">
                                    <i class="fa-solid fa-location-dot text-success me-1"></i>
                                    {{ $deal->product->country->short_name ?? 'N/A' }}
                                </span>
                            </div>
                            <a href="{{ route('product-inquiry', ['customer_id' => $deal->seller_id, 'product_id' => $deal->product_id]) }}"
                                class="btn btn-outline-primary fw-semibold w-100">
                                Grab Deal </a>
                        </div>
                        </a>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No hot deals available for product right now. Check back soon!</p>
                </div>

            @endforelse
        </div>

        <!-- Pagination -->
        @if ($hotdealTotalPages > 1)
            <div class="d-flex justify-content-center">
                @if ($hotdealPage > 1)
                    <button class="btn btn-outline-primary me-2" wire:click="setHotdealPage({{ $hotdealPage - 1 }})">
                        &laquo; Prev
                    </button>
                @endif

                @for ($i = max(1, $hotdealPage - 1); $i <= min($hotdealTotalPages, $hotdealPage + 1); $i++)
                    <button class="btn {{ $i == $hotdealPage ? 'btn-primary' : 'btn-outline-primary' }} me-2"
                        wire:click="setHotdealPage({{ $i }})">{{ $i }}</button>
                @endfor

                @if ($hotdealPage < $hotdealTotalPages)
                    <button class="btn btn-outline-primary" wire:click="setHotdealPage({{ $hotdealPage + 1 }})">
                        Next &raquo;
                    </button>
                @endif
            </div>
        @endif
    </div>
    <style>
        .card-img-top {
            border-bottom: 1px solid #e9ecef;
        }

        .deal-card:hover {
            transform: translateY(-5px);
            transition: 0.3s ease-in-out;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
        }

        .bg-gradient-primary {
            background: linear-gradient(to right, #007bff, #00c6ff);
        }
    </style>

    <script>
        function updateCountdowns() {
            const countdowns = document.querySelectorAll('.countdown');
            countdowns.forEach(countdown => {
                const endDate = new Date(countdown.getAttribute('data-enddate'));
                const now = new Date();
                const diff = endDate - now;

                const timeSpan = countdown.querySelector('.time');
                const card = countdown.closest('.deal-card');
                const column = card.closest('.col-12, .col-sm-6, .col-lg-3');

                if (diff <= 0) {
                    timeSpan.textContent = 'Deal Expired';
                    card.style.display = 'none';
                    column.style.display = 'none';
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((diff / (1000 * 60)) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                timeSpan.textContent =
                    `${days > 0 ? days + 'd ' : ''}${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            });
        }

        updateCountdowns();
        setInterval(updateCountdowns, 1000);
    </script>


    <livewire:front.layout.footer />
</div>