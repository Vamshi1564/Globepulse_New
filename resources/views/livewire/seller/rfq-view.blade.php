@php
$rfq = (object)[
    'id' => 1,
    'product' => (object)[
        'title' => 'Wheat Flour Premium'
    ],
    'quantity' => '100 kg',
    'target_price' => '₹50/kg',
    'shipping_terms' => 'FOB',
    'delivery_time' => '7 Days',
    'destination_port' => 'Mumbai Port',
    'payment_terms' => 'Advance 50%',
    'message' => 'Need high quality wheat flour for export purpose. Please quote best price.',
    'name' => 'Ravi Kumar',
    'email' => 'ravi@example.com',
    'phone' => '9876543210',
    'company_name' => 'Ravi Traders Pvt Ltd',
    'status' => 0,
    'created_at' => now(),

    'supplier' => (object)[
        'company' => 'GFE Global Pvt Ltd',
        'email' => 'seller@gfe.com',
        'phone' => '9123456789'
    ]
];
@endphp

<div>

<livewire:seller.layout.header />

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold mb-0">📄 RFQ Details</h3>

        <button onclick="history.back()" class="btn btn-outline-primary btn-sm px-3">
            <i class="fas fa-arrow-left me-1"></i> Back
        </button>
    </div>

    <div class="rfq-card">

        <!-- HEADER -->
        <div class="rfq-header">
            <div>
                <h4 class="fw-bold mb-1 text-white">
                    {{ $rfq->product->title ?? 'Product' }}
                </h4>
                <small class="text-light">RFQ ID: #{{ $rfq->id }}</small>
            </div>

            <!-- STATUS FIXED -->
            <div>
                @if($rfq->status == 0)
                    <span class="status-badge pending">Pending</span>
                @elseif($rfq->status == 1)
                    <span class="status-badge success">Quoted</span>
                @else
                    <span class="status-badge closed">Closed</span>
                @endif
            </div>
        </div>

        <!-- BODY -->
        <div class="rfq-body">

            <!-- INFO -->
            <div class="row g-4">

                <div class="col-md-3">
                    <div class="info-box highlight">
                        <span>Quantity</span>
                        <strong>{{ $rfq->quantity }}</strong>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box highlight-blue">
                        <span>Target Price</span>
                        <strong>{{ $rfq->target_price ?? '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span>Shipping</span>
                        <strong>{{ $rfq->shipping_terms ?? '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span>Delivery</span>
                        <strong>{{ $rfq->delivery_time ?? '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span>Destination</span>
                        <strong>{{ $rfq->destination_port ?? '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span>Payment</span>
                        <strong>{{ $rfq->payment_terms ?? '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span>Date</span>
                        <strong>{{ $rfq->created_at->format('d M Y') }}</strong>
                    </div>
                </div>

            </div>

            <!-- MESSAGE -->
            <div class="mt-4">
                <h6 class="section-title">Requirement Message</h6>
                <div class="rfq-message">
                    {{ $rfq->message }}
                </div>
            </div>

            <!-- BUYER -->
            <div class="mt-4">
                <h6 class="section-title">👤 Buyer Information</h6>

                <div class="buyer-card">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <span>Name</span>
                            <strong>{{ $rfq->name }}</strong>
                        </div>

                        <div class="col-md-6">
                            <span>Email</span>
                            <strong>{{ $rfq->email }}</strong>
                        </div>

                        <div class="col-md-6">
                            <span>Phone</span>
                            <strong>{{ $rfq->phone }}</strong>
                        </div>

                        <div class="col-md-6">
                            <span>Company</span>
                            <strong>{{ $rfq->company_name }}</strong>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SUPPLIER -->
            <div class="mt-4">
                <h6 class="section-title">🏭 Your Details</h6>

                <div class="buyer-card">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <span>Company</span>
                            <strong>{{ $rfq->supplier->company ?? '-' }}</strong>
                        </div>

                        <div class="col-md-6">
                            <span>Email</span>
                            <strong>{{ $rfq->supplier->email ?? '-' }}</strong>
                        </div>

                        <div class="col-md-6">
                            <span>Phone</span>
                            <strong>{{ $rfq->supplier->phone ?? '-' }}</strong>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ACTION BUTTON -->
            <div class="mt-4 text-end">
                <a href="{{ route('seller.rfq.quote', $rfq->id) }}"
                   class="btn btn-success px-4">
                    💰 Send Quotation
                </a>
            </div>

        </div>

    </div>

</div>

<livewire:seller.layout.footer />

</div>