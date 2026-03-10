<div>
    <livewire:seller.layout.header />
    <div class="content p-0 m-0">
        <div class="container-fluid">
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-products') }}">My
                            Products</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Postrequirement-list</li>
                </ol>
            </nav>
        </div>
        <div class="py-5 bg-white">
            <div class="container-fluid">
                <h2 class="fw-bold mb-4">Postrequirement-list</h2>

                @if ($postrequirement->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($postrequirement as $Data)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card p-3 rounded-4 shadow-sm border enquiry-card h-100">
                                    <div class="card-body px-3 py-2">

                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted"><strong> Status :</strong></span>
                                            <span class="fw-bold">
                                                @if ($Data->status == 1)
                                                    <span class="badge bg-success-subtle text-success">Approved</span>
                                                @elseif ($Data->status == 0)
                                                    <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning-subtle text-warning">Pending</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted"><strong><i
                                                        class="fas fa-box text-primary me-1"></i> Product :</strong></span>
                                            <span class="fw-bold text-dark">

                                                {{ $Data->product_name }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted"><strong><i
                                                        class="fas fa-sort-numeric-up text-info me-1"></i> Quantity
                                                    :</strong></span>
                                            <span>

                                                {{ $Data->quantity }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold text-muted"><strong><i
                                                        class="fas fa-comments text-primary me-1"></i> Total Inquiries
                                                    :</strong></span>
                                            <span>

                                                <a href="{{ route('buyleadenquiries', $Data->id) }}"
                                                    class="text-decoration-none fw-semibold text-primary">
                                                    {{ $Data->lead_count }}
                                                </a>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-semibold text-muted"><strong><i
                                                        class="fas fa-map-marker-alt text-danger me-1"></i> Location
                                                    :</strong></span>
                                            <span class="text-dark">

                                                {{ $Data->location }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $postrequirement->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <h5 class="text-danger text-center mt-5">🚫 No Postrequirement Found</h5>
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
                    transform: translateY(-4px);
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