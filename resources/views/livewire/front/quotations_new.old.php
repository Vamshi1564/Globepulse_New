



<style>
    .quote-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 18px;
    /* 🔥 Thick shadow */
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    transition: 0.3s ease;
    border: 1px solid #f1f5f9;
}

.quote-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}

/* PRICE BOX */
.price-box {
    display: flex;
    justify-content: space-between;
    background: #f8fafc;
    padding: 12px 15px;
    border-radius: 10px;
}

.label {
    font-size: 12px;
    color: #64748b;
}

.price {
    font-size: 18px;
    font-weight: 700;
    color: #16a34a;
}

.total {
    font-size: 16px;
    font-weight: 600;
}

/* BADGES */
.badge-pending {
    background: #facc15;
    color: #000;
}

.badge-accepted {
    background: #22c55e;
}

.badge-rejected {
    background: #ef4444;
}

/* BEST DEAL */
.best-price-badge {
    margin-top: 10px;
    display: inline-block;
    background: #16a34a;
    color: #fff;
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 20px;
}

/* MESSAGE */
.quote-message {
    background: #f1f5f9;
    padding: 10px;
    border-radius: 8px;
    font-size: 14px;
}
.rfq-header-box {
    background: #eff6ff;
    padding: 12px 15px;
    border-radius: 10px;
    border-left: 4px solid #3b82f6;
}
.dashboard-sidebar {
    background:#ffffff;
    border-right:1px solid #e5e7eb;
    padding:22px;

    position: sticky;
    top: 0;
    height: 100vh;
}
.quote-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 12px 15px;
    background: #f8fafc;
    border-radius: 10px;
    transition: 0.2s;
}

.quote-summary:hover {
    background: #eef2ff;
}

.quote-details {
    display: none;
    padding-top: 15px;
}

.quote-card.active .quote-details {
    display: block;
}
</style>


<div>

<livewire:front.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

<div class="col-md-2 dashboard-sidebar">
    @include('livewire.front.layout.buyer-sidebar')
</div>

<div class="col-md-10 dashboard-content">

<div class="container py-4">
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<h3 class="fw-bold mb-4">💰 Quotations Received</h3>
<form method="GET" class="mb-3 d-flex gap-2 align-items-end justify-content-end">

    <input type="text" name="search" value="{{ request('search') }}"
        class="form-control w-25"
        placeholder="Search product, supplier, price, message...">

    <button class="btn btn-primary">Search</button>

    <a href="{{ route('buyer.quotations') }}" class="btn btn-secondary">
        Reset
    </a>

</form>
@php
    $grouped = $quotations->getCollection()->groupBy('rfq_id');
@endphp

@forelse($grouped as $rfqId => $quotes)

@php
    $rfq = $quotes->first()->rfq;
    $minPrice = $quotes->min('price');
@endphp

{{-- ================= RFQ SUMMARY ================= --}}



<div class="quote-card">
<div class="card mb-3 border-0 shadow-sm">
<div class="card-body">

<div class="rfq-header-box">
    <h5 class="fw-bold mb-1">📄 Your Requirement (RFQ #{{ $rfq->id }})</h5>
    <small class="text-muted">
        This is what you requested from suppliers
    </small>
</div>

<div class="row">

    <div class="col-md-3">
        <small class="text-muted">Product</small>
        <div>{{ $rfq->product->title }}</div>
    </div>

    <div class="col-md-3">
        <small class="text-muted">Quantity</small>
        <div>{{ $rfq->quantity }} {{ $rfq->product->unit }}</div>
    </div>

    <div class="col-md-3">
        <small class="text-muted">Target Price</small>
        <div>₹ {{ $rfq->target_price ?? '-' }}</div>
    </div>

</div>

<hr>
<h4 class="fw-bold mt-3 mb-5 text-success">
    💰 Supplier Quotation
</h4>
{{-- ================= QUOTES ================= --}}
@foreach($quotes as $quote)

@php
    $unit = $rfq->product->unit ?? 'unit';

    $qty  = (float) ($rfq->quantity ?? 0);
    $price = (float) ($quote->price ?? 0);

    $total = $price * $qty;
@endphp




    <!-- TOP -->
    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h6 class="fw-bold mb-1">
                💼 Offer from {{ $quote->supplier->legal_business_name ?? 'N/A' }}
            </h6>
            <small class="text-muted">
                🏭 {{ $quote->supplier->legal_business_name ?? 'N/A' }}
            </small>
        </div>

       <div>
    @if($quote->status == 0)
        <span class="badge bg-warning text-dark">
            ⏳ Waiting
        </span>

    @elseif($quote->status == 1)
        <span class="badge bg-success">
            🏆 Selected
        </span>

    @elseif($quote->status == 2)
        <span class="badge bg-secondary">
            ❌ Not Selected
        </span>
    @endif
</div>

    </div>

    <!-- PRICE SECTION -->
    <div class="price-box mt-3">

        <div>
            <span class="label">Unit Price</span>
            <div class="price">
                ₹ {{ number_format((float)$quote->price) }}
                <small>/ {{ $unit }}</small>
            </div>
        </div>

        <div>
            <span class="label">Total</span>
            <div class="total">
                ₹ {{ number_format($total) }}
            </div>
        </div>

    </div>

    @if($quote->price == $minPrice)
        <div class="best-price-badge">🔥 Best Deal</div>
    @endif

 <!-- DETAILS -->
<div class="row mt-3">

    <div class="col-md-6">
        <small class="text-muted d-block">🚚 Delivery Time</small>
        <div class="fw-semibold">
            {{ $quote->delivery_time ?? '-' }}
        </div>
    </div>

    <div class="col-md-6">
        <small class="text-muted d-block">💳 Payment Terms</small>
        <div class="fw-semibold">
            {{ $quote->payment_terms ?? '-' }}
        </div>
    </div>

</div>

    <!-- TARGET CHECK -->
    @if($rfq->target_price)
        <div class="mt-2">
            @if($quote->price <= $rfq->target_price)
                <span class="text-success">✔ Below target</span>
            @else
                <span class="text-danger">⚠ Above target</span>
            @endif
        </div>
    @endif

    <!-- MESSAGE -->
    <p class="quote-message mt-3">
        {{ $quote->message }}
    </p>

    <!-- ACTION -->
    @if($quote->status == 0)
   <div class="mt-3 d-flex gap-2">

    <!-- ACCEPT -->
    <form action="{{ route('quotation.accept', $quote->id) }}" method="POST">
        @csrf
        <button class="btn btn-success btn-sm px-3">
            ✅ Accept
        </button>
    </form>

    <!-- REJECT -->
    <form action="{{ route('quotation.reject', $quote->id) }}" method="POST">
        @csrf
        <button class="btn btn-outline-danger btn-sm px-3">
            ❌ Reject
        </button>
    </form>

    <form action="{{ route('quotation.delete', $quote->id) }}" method="POST"
      onsubmit="return confirm('Delete this quotation?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm px-3">
        🗑 Delete
    </button>
</form>

</div>
   @elseif($quote->status == 1)

    <!-- 🔥 ACCEPTED QUOTE ACTION -->
    <div class="mt-3">

        <form action="{{ route('quotation.cancel', $quote->id) }}" method="POST"
            onsubmit="return confirm('Cancel this deal?')">
            @csrf

            <button class="btn btn-warning btn-sm px-3">
                🔄 Cancel Deal
            </button>

        </form>

    </div>

@endif

</div>

</div>
</div>

@endforeach

@empty

<div class="text-center py-5">
    <h5>No quotations received yet</h5>
    <p class="text-muted">Suppliers will respond soon.</p>
</div>

@endforelse
<div class="d-flex justify-content-between align-items-center mt-4">

    <div class="text-muted small">
        Showing {{ $quotations->firstItem() ?? 0 }}
        to {{ $quotations->lastItem() ?? 0 }}
        of {{ $quotations->total() }} results
    </div>

    <div>
        {{ $quotations->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
</div>

</div>
</div>
</div>

<livewire:front.layout.footer />

</div>


