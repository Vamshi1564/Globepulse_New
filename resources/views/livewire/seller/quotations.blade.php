<style>
/* ===== CARD ===== */
.quote-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 16px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.25s ease;
    height: 100%;
}

.quote-card:hover {
    transform: translateY(-6px) scale(1.02);
    border: 1px solid #3b82f6;
    box-shadow: 0 25px 50px rgba(59,130,246,0.15);
}


/* STATUS BORDERS */
.quote-card.pending {
    border: 2px solid transparent;
    background: linear-gradient(#fff, #fff) padding-box,
                linear-gradient(135deg, #f59e0b, #d97706) border-box;
}

.quote-card.accepted {
    border: 2px solid transparent;
    background: linear-gradient(#fff, #fff) padding-box,
                linear-gradient(135deg, #22c55e, #16a34a) border-box;
}

.quote-card.rejected {
    border: 2px solid transparent;
    background: linear-gradient(#fff, #fff) padding-box,
                linear-gradient(135deg, #ef4444, #dc2626) border-box;
}

/* TEXT */
small.text-muted {
    color: #6b7280 !important;
}

/* KPI */
.kpi-card {
    border-radius: 16px;
    padding: 18px 20px;
    color: #fff;
}

.kpi-primary { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.kpi-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
.kpi-success { background: linear-gradient(135deg, #22c55e, #16a34a); }
.kpi-danger  { background: linear-gradient(135deg, #ef4444, #dc2626); }

/* BADGE */
.badge {
    border-radius: 999px;
    font-weight: 500;
    font-size: 12px;
}

/* BUSINESS */
.business-card {
    background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
}

/* ICON */
.value-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

/* MOBILE */
@media(max-width:768px){
    .quote-card {
        padding: 12px;
    }
}
</style>

<div>

<livewire:seller.layout.header />

<div class="container-fluid dashboard-layout mt-5">

<!-- KPI -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="kpi-card kpi-primary">
            <small>Total Quotes</small>
            <h3>{{ $stats['total'] }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="kpi-card kpi-warning">
            <small>Pending</small>
            <h3>{{ $stats['pending'] }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="kpi-card kpi-success">
            <small>Accepted</small>
            <h3>{{ $stats['accepted'] }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="kpi-card kpi-danger">
            <small>Rejected</small>
            <h3>{{ $stats['rejected'] }}</h3>
        </div>
    </div>
</div>

<!-- BUSINESS -->
<div class="card border-0 rounded-4 mb-4 p-4 business-card">
    <div class="d-flex align-items-center gap-3">
        <div class="value-icon">
            <i class="bi bi-currency-rupee"></i>
        </div>
        <div>
            <small class="text-muted">Total Business Value</small>
            <h3 class="fw-bold text-success mb-0">
                ₹ {{ number_format($stats['value']) }}
            </h3>
        </div>
    </div>
</div>

<div class="container-fluid py-4">

<h3 class="fw-bold mb-4">📤 Sent Quotations</h3>

<!-- FILTER + SORT -->
<form method="GET" class="card border-0 shadow-sm rounded-4 mb-4">
<div class="card-body">
<div class="row g-3 justify-content-end">

<div class="col-md-3">
    <input type="text" name="search" value="{{ request('search') }}"
        class="form-control" placeholder="Search product or buyer">
</div>

<div class="col-md-2">
    <select name="statusFilter" class="form-select">
    <option value="">All Status</option>
    <option value="0" {{ request('statusFilter')=='0'?'selected':'' }}>Pending</option>
    <option value="1" {{ request('statusFilter')=='1'?'selected':'' }}>Accepted</option>
    <option value="2" {{ request('statusFilter')=='2'?'selected':'' }}>Rejected</option>
</select>
</div>

<div class="col-md-2">
    <select name="sort" class="form-select">
    <option value="">Sort By</option>
    <option value="latest" {{ request('sort')=='latest'?'selected':'' }}>Latest</option>
    <option value="price_low" {{ request('sort')=='price_low'?'selected':'' }}>Price Low</option>
    <option value="price_high" {{ request('sort')=='price_high'?'selected':'' }}>Price High</option>
</select>
</div>

<div class="col-md-1">
    <button class="btn btn-primary w-100">Apply</button>
</div>

<div class="col-md-1">
    <a href="{{ route('seller.quotations') }}" class="btn btn-light border w-100">Reset</a>
</div>

<div class="col-md-2">
    <a href="{{ route('seller.export.quotations') }}" class="btn btn-success w-100">
        Export
    </a>
</div>

</div>
</div>
</form>

<!-- GRID -->
<div class="row g-4">

@forelse($quotations as $quote)

@php
$diff = $quote->rfq->target_price ? $quote->price - $quote->rfq->target_price : null;
@endphp

<div class="col-xl-3 col-lg-4 col-md-6">

<div class="quote-card 
    {{ $quote->status == 0 ? 'pending' : '' }}
    {{ $quote->status == 1 ? 'accepted' : '' }}
    {{ $quote->status == 2 ? 'rejected' : '' }}">

<!-- HEADER -->
<div class="d-flex justify-content-between">

<div>
    <div class="fw-semibold">
        {{ $quote->rfq->product->title ?? 'Product' }}
    </div>

    <small class="text-muted">
        RFQ #{{ $quote->rfq->id }} <br>
        RFQ Created: {{ $quote->rfq->created_at->format('d M Y') }}
    </small>
</div>

<div>
@if($quote->status == 0)
    <span class="badge bg-warning px-3 py-2">⏳ Pending</span>
@elseif($quote->status == 1)
    <span class="badge bg-success px-3 py-2">🏆 Accepted</span>
@elseif($quote->status == 2)
    <span class="badge bg-secondary px-3 py-2">❌ Rejected</span>
@endif
</div>

</div>

<!-- PROGRESS BAR -->
<div class="progress mt-2" style="height:6px;">
    <div class="progress-bar 
        {{ $quote->status == 0 ? 'bg-warning' : ($quote->status == 1 ? 'bg-success' : 'bg-danger') }}"
        style="width: {{ $quote->status == 0 ? '50%' : '100%' }}">
    </div>
</div>

<div class="border-top my-3"></div>

<!-- BUYER -->
<div class="small mb-2">
    <small class="text-muted">Buyer</small>
    <div class="fw-semibold">{{ $quote->buyer->full_name ?? 'N/A' }}</div>
</div>

<!-- PRICE -->
<div class="bg-light p-2 rounded mb-2">
    <small class="text-muted">Your Price</small>
    <div class="fw-bold text-success fs-5">
        ₹ {{ number_format($quote->price) }}
    </div>
</div>

<!-- TARGET + DIFFERENCE -->
@if($quote->rfq->target_price)
<div class="small mb-2">
    <small class="text-muted">Target</small>
    <div>₹ {{ $quote->rfq->target_price }}</div>

    @if($diff !== null)
        <div class="mt-1">
            @if($diff <= 0)
                <span class="text-success">₹ {{ abs($diff) }} below target</span>
            @else
                <span class="text-danger">₹ {{ $diff }} above target</span>
            @endif
        </div>
    @endif
</div>
@endif

<!-- QUICK INFO -->
<div class="d-flex justify-content-between small text-muted mb-2">
    <span>Qty: {{ $quote->rfq->quantity }}</span>
    <span>Total: ₹ {{ number_format($quote->price * $quote->rfq->quantity) }}</span>
</div>

<!-- EXTRA -->
<div class="row g-2 small mb-2">
    <div class="col-6">
        <small class="text-muted">Delivery</small>
        <div>{{ $quote->delivery_time }}</div>
    </div>

    <div class="col-6">
        <small class="text-muted">Payment</small>
        <div>{{ $quote->payment_terms }}</div>
    </div>
</div>

<!-- TIME -->
<div class="small text-muted mb-2">
   <small class="text-muted">Sent on</small>
    <div>{{ $quote->created_at->format('d M Y') }}</div>
</div>

<!-- MESSAGE -->
@if($quote->message)
<div class="small bg-white border rounded p-2 mb-2">
    {{ Str::limit($quote->message, 80) }}
</div>
@endif

<!-- ACTIONS -->
<div class="d-flex gap-2 mt-3">

    <!-- VIEW -->
    <a href="{{ route('seller.rfq.view', $quote->rfq->id) }}" 
       class="btn btn-sm btn-outline-primary flex-fill">
       View RFQ
    </a>

    <!-- DELETE -->
    @if($quote->status != 1)
    <form action="{{ route('seller.quotation.delete', $quote->id) }}" 
          method="POST"
          onsubmit="return confirm('Delete this quotation?')"
          class="flex-fill">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm w-100">
            🗑 Delete
        </button>
    </form>
    @else
        <button class="btn btn-secondary btn-sm flex-fill" disabled>
            Accepted
        </button>
    @endif

</div>
</div>
</div>

@empty

<div class="text-center py-5">
    <h5>No quotations found</h5>
</div>

@endforelse
<div class="d-flex justify-content-between align-items-center mt-4">

    <div class="text-muted small">
        Showing {{ $quotations->firstItem() }} to {{ $quotations->lastItem() }} 
        of {{ $quotations->total() }} results
    </div>

    <div>
        {{ $quotations->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
</div>

</div>
</div>

<livewire:seller.layout.footer />

</div>
