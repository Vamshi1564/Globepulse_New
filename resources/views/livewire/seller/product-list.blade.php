<div>
    <livewire:seller.layout.header />

    <style>
        .product-card {
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-color: #e0e0e0;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-img {
            transition: transform 0.4s ease;
        }
    </style>

    <div class="container-fluid py-5">
        <h2 class="fw-bold mb-4 fs-5 text-gradient">
            <i class="fas fa-store text-primary me-2"></i> Product Listings
        </h2>

        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-md-6 col-xl-4">
                    <div class="card product-card shadow-sm border rounded-4 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge 
                                                                 @if ($product->status == 1) bg-success-subtle text-success
                                                                 @elseif ($product->status == 0) bg-danger-subtle text-danger
                                                                     @else bg-warning-subtle text-warning
                                                                 @endif 
                                                                 px-3 py-2 rounded-pill text-capitalize fw-medium">
                                    @if ($product->status == 1) Approved
                                    @elseif ($product->status == 0) Rejected
                                        @else Pending
                                    @endif
                                </span>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('product-detail', $product->slug) }}"
                                        class="btn btn-sm btn-outline-secondary " title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('seller-product-edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-primary " title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                        class="btn btn-sm btn-outline-danger rounded" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                    class="rounded-3 shadow-sm me-3 product-img border"
                                    style="width: 64px; height: 64px; object-fit: cover;" alt="{{ $product->title }}">
                                <div>
                                    <a href="{{ route('product-detail', $product->slug) }}"
                                        class="text-decoration-none text-dark fw-semibold d-block">
                                        {{ Str::limit($product->title, 50) }}
                                    </a>
                                    <small class="text-muted d-block">
                                        {{ $product->country->currency_symbol ?? '' }}{{ $product->min_price }} -
                                        {{ $product->country->currency_symbol ?? '' }}{{ $product->max_price }}
                                        ({{ $product->country->currency ?? '' }})
                                    </small>
                                </div>
                            </div>

                            <div class="text-muted small">Product #{{ $loop->iteration }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 text-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <livewire:seller.layout.footer />


</div>