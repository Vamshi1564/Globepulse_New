<style>
    .quote-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 18px;
    /* 🔥 Thick shadow */
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    transition: all 0.2s ease;
    border: 1px solid #f1f5f9;
    border-left: 4px solid transparent;
}

.quote-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}
.quote-card.active {
    border-left: 4px solid #22c55e;
}
.quotes-group {
    margin-bottom: 10px;
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
.view-btn {
    font-size: 12px;
    font-weight: 600;
    color: #2563eb;
    background: #eff6ff;
    padding: 5px 6px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
    border: 1px solid #bfdbfe;
    transition: all 0.2s ease;
}


/* 🔥 Active (expanded) state */
.quote-card.active .view-btn {
    background: #dcfce7;
    color: #16a34a;
    border-color: #86efac;
}

.arrow {
    font-size: 12px;
    transition: transform 0.3s ease;
}

/* rotate when open */
.quote-card.active .arrow {
    transform: rotate(180deg);
}

/* change text when active */
.quote-card.active .toggle-text::after {
    content: "Hide";
}

.toggle-text::after {
    content: "View";
}

/* hide original text */
.toggle-text {
    font-size: 12px;
    font-weight: 600;
    color: #2563eb;
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
    cursor: pointer;
    position: relative;
    transition: background 0.2s ease, box-shadow 0.2s ease;

}

.quote-summary:hover {
    background: #eef2ff;
    box-shadow: inset 0 0 0 1px #c7d2fe;
    
}
/* .quote-summary::after {
    content: "Click to view details";
    position: absolute;
    right: 10px;
    bottom: -18px;
    font-size: 11px;
    color: #94a3b8;
} */
.quote-details {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-5px);
    transition: 
        max-height 0.35s ease,
        opacity 0.25s ease,
        transform 0.25s ease;
}

/* expanded state */
.quote-card.active .quote-details {
    max-height: 500px; /* enough height */
    opacity: 1;
    transform: translateY(0);
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

<form method="GET" class="mb-3 d-flex gap-2 justify-content-end">
    <input type="text" name="search" value="{{ request('search') }}"
        class="form-control w-25"
        placeholder="Search...">

    <button class="btn btn-primary">Search</button>
    <a href="{{ route('buyer.quotations') }}" class="btn btn-secondary">Reset</a>
</form>

@php
$grouped = $quotations->getCollection()->groupBy('rfq_id');
@endphp

@forelse($grouped as $rfqId => $quotes)

@php
    $rfq = $quotes->first()->rfq;
    $minPrice = $quotes->min('price');
@endphp
<div class="bg-light pt-3 pb-2 px-3 rounded-3 mb-4">
    <div class="quotes-group">
<!-- 🔷 RFQ HEADER -->
<div class="rfq-header-box mb-4 p-3">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="fw-bold text-primary mb-0">
            📄 Your Requirement (RFQ #{{ $rfq->id }})
        </h5>

        <span class="badge bg-primary">
            Buyer RFQ
        </span>
    </div>

    <div class="row mt-2">

        <div class="col-md-4">
            <small class="text-muted">Product</small>
            <div class="fw-semibold">{{ $rfq->product->title }}</div>
        </div>

        <div class="col-md-4">
            <small class="text-muted">Quantity</small>
            <div>{{ $rfq->quantity }} {{ $rfq->product->unit }}</div>
        </div>

        <div class="col-md-4">
            <small class="text-muted">Target Price</small>
            <div class="text-primary fw-bold">
                ₹ {{ $rfq->target_price ?? '-' }}
            </div>
        </div>

    </div>

</div>
<div class="mb-2">
    <h6 class="fw-bold text-success">
        💰 Supplier Quotation
    </h6>
</div>
<!-- 🔁 QUOTES -->
@foreach($quotes as $quote)

@php
    $unit = $rfq->product->unit ?? 'unit';
    $qty  = (float) $rfq->quantity;
    $price = (float) $quote->price;
    $total = $price * $qty;
@endphp

<div class="quote-card">

    <!-- 🔹 HEADER -->
    <div class="quote-summary" onclick="toggleQuote(this.parentElement)">

    <div>
        <strong>💼 {{ $quote->supplier->legal_business_name ?? 'N/A' }}</strong>
        <br>
        <small class="text-muted">
            ₹ {{ number_format($price) }} / {{ $unit }}
        </small>
    </div>

    <div class="d-flex align-items-center gap-2">

        @if($price == $minPrice)
            <span class="badge bg-success">🔥 Best Deal</span>
        @endif

        @if($quote->status == 0)
            <span class="badge bg-warning text-dark">⏳ Pending</span>
        @elseif($quote->status == 1)
            <span class="badge bg-success">🏆 Selected</span>
        @else
            <span class="badge bg-secondary">❌ Rejected</span>
        @endif

        <!-- 🔥 CLEAR ACTION BUTTON -->
       <span class="view-btn">
    <span class="toggle-text"></span>
    <span class="arrow">▼</span>
</span>

    </div>

</div>

    <!-- 🔽 DETAILS -->
    <div class="quote-details">

        <!-- PRICE -->
        <div class="price-box mt-3">
            <div>
                <span class="label">Unit Price</span>
                <div class="price">₹ {{ number_format($price) }}</div>
            </div>

            <div>
                <span class="label">Total</span>
                <div class="total">₹ {{ number_format($total) }}</div>
            </div>
        </div>

        <!-- DELIVERY + PAYMENT -->
        <div class="row mt-3">
            <div class="col-md-6">
                <small>🚚 Delivery Time</small>
                <div>{{ $quote->delivery_time ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <small>💳 Payment Terms</small>
                <div>{{ $quote->payment_terms ?? '-' }}</div>
            </div>
        </div>

        <!-- TARGET CHECK -->
        @if($rfq->target_price)
        <div class="mt-2">
            @if($price <= $rfq->target_price)
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

        <!-- ACTIONS -->
        <div class="mt-3 d-flex gap-2 flex-wrap">

            @if($quote->status == 0)

                <form action="{{ route('quotation.accept', $quote->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm">✅ Accept</button>
                </form>

                <form action="{{ route('quotation.reject', $quote->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">❌ Reject</button>
                </form>

                <form action="{{ route('quotation.delete', $quote->id) }}" method="POST"
                      onsubmit="return confirm('Delete this quotation?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑 Delete</button>
                </form>

            @elseif($quote->status == 1)

                <form action="{{ route('quotation.cancel', $quote->id) }}" method="POST"
                      onsubmit="return confirm('Cancel this deal?')">
                    @csrf
                    <button class="btn btn-warning btn-sm">🔄 Cancel Deal</button>
                </form>

            @endif

        </div>

    </div>

</div>
</div>
</div>
@endforeach

@empty
<div class="text-center py-5">
    <h5>No quotations received yet</h5>
</div>


@endforelse

<!-- PAGINATION -->
<div class="d-flex justify-content-between mt-4">
    <div class="small text-muted">
        Showing {{ $quotations->firstItem() ?? 0 }} - {{ $quotations->lastItem() ?? 0 }}
        of {{ $quotations->total() }}
    </div>

    {{ $quotations->links('pagination::simple-bootstrap-5') }}
</div>

</div>
</div>
</div>
</div>

<livewire:front.layout.footer />

</div>

<!-- <script>
function toggleQuote(el) {

    let parent = el.closest('.quotes-group'); // RFQ container

    parent.querySelectorAll('.quote-card').forEach(c => {
        if (c !== el) c.classList.remove('active');
    });

    el.classList.toggle('active');
}
</script> -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let first = document.querySelector('.quote-card');
    if (first) first.classList.add('active');
});

function toggleQuote(card) {
    document.querySelectorAll('.quote-card').forEach(c => {
        if (c !== card) c.classList.remove('active');
    });

    card.classList.toggle('active');
}
</script>