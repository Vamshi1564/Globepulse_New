<div>
    <livewire:seller.layout.header />
    <div class="content p-0">
        <div class="container-fluid">
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-products') }}">My
                            Products</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Product Enquiry</li>
                </ol>
            </nav>
        </div>
        <div class="bg-white py-5">
            <div class="container-fluid">
                <h2 class="fw-bold mb-4 ">Product Enquiries</h2>

                @if ($productInquiry->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($productInquiry as $item)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card p-3 rounded-4 shadow-sm border enquiry-card h-100">
                                    <div class="card-body px-3 py-2">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted">Customer Name:</span>
                                            <span class="fw-bold text-dark text-end">
                                                <i class="fas fa-user text-secondary me-1"></i>
                                                {{ $item->customer->name ?? 'Customer Not Found' }}
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted">Mobile:</span>
                                            <span>
                                                <i class="fas fa-phone-alt text-success me-1"></i>
                                                <a href="tel:{{ $item->phonenumber }}" class="text-dark text-decoration-none">
                                                    {{ $item->phonenumber }}
                                                </a>
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted">Email:</span>
                                            <span>
                                                <i class="fas fa-envelope text-warning me-1"></i>
                                                <a href="mailto:{{ $item->email }}" class="text-dark text-decoration-none">
                                                    {{ $item->email }}
                                                </a>
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <span class="fw-semibold text-muted">Product:</span>
                                            <span class="text-end">
                                                <i class="fas fa-box text-primary me-1"></i>
                                                <a href="{{ $item->slug ? route('product-detail', ['slug' => $item->slug]) : '#' }}"
                                                    class="fw-semibold text-decoration-none text-primary text-end">
                                                    {{ $item->product_name }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{ $productInquiry->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <h5 class="text-danger text-center mt-5">🚫 No Product Enquiries Found</h5>
                @endif
            </div>
            <style>
                .enquiry-card {
                    transition: all 0.3s ease-in-out;
                    border: 1px solid #dee2e6;
                    background-color: #f1ececdf;
                }

                .enquiry-card:hover {
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                    transform: translateY(-3px);
                }

                .enquiry-card .card-body>div {
                    border-bottom: 1px dashed #8dcdf2f4;
                    padding-bottom: 6px;
                }

                .enquiry-card .card-body>div:last-child {
                    border-bottom: none;
                }
            </style>


        </div>
    </div>
    <livewire:seller.layout.footer />
</div>



</div>