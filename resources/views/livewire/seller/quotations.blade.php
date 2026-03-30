<style>
/* ===== CARD ===== */
.quote-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 22px;
    border: 1px solid #eef1f6;
    box-shadow: 0 30px 30px rgba(0, 0, 0, 0.12);
    transition: all 0.25s ease;
}

.quote-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 45px rgba(0,0,0,0.08);
}

/* ===== HEADER ===== */
.quote-title {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
}

.quote-sub {
    font-size: 13px;
    color: #64748b;
}

/* ===== STATUS BADGES ===== */
.status-pill {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.status-waiting {
    background: #fff7ed;
    color: #ea580c;
}

.status-success {
    background: #ecfdf5;
    color: #16a34a;
}

.status-reject {
    background: #f1f5f9;
    color: #475569;
}

/* ===== INFO GRID ===== */
.info-box {
    background: #f8fafc;
    padding: 12px;
    border-radius: 12px;
    text-align: center;
}

.info-label {
    font-size: 12px;
    color: #94a3b8;
}

.info-value {
    font-weight: 600;
    font-size: 14px;
    color: #0f172a;
}

/* ===== PRICE BOX ===== */
.price-box {
    background: linear-gradient(135deg, #0ea5e9, #2563eb);
    color: white;
    border-radius: 14px;
    padding: 16px;
}

.price-box h4 {
    margin: 0;
    font-weight: 700;
}

/* ===== MESSAGE ===== */
.message-box {
    background: #f9fafb;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px;
    font-size: 13px;
}

/* ===== COMPARISON ===== */
.tag-good {
    color: #16a34a;
    font-weight: 600;
}

.tag-bad {
    color: #dc2626;
    font-weight: 600;
}
.kpi-card {
    border-radius: 16px;
    padding: 18px 20px;
    color: #fff;
    transition: 0.3s ease;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.kpi-card small {
    opacity: 0.9;
    font-size: 13px;
}

.kpi-card h3 {
    font-weight: 700;
    margin: 5px 0 0;
}

.kpi-icon {
    font-size: 28px;
    opacity: 0.7;
}

/* COLORS */
.kpi-primary {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.kpi-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.kpi-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.kpi-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

/* HOVER EFFECT */
.kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}
.business-card {
    background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: 0.3s ease;
}

.business-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
}

/* ICON */
.value-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
}
</style>

<div>

<livewire:seller.layout.header />

<div class="container-fluid dashboard-layout mt-5">
    <!-- ================= KPI CARDS ================= -->
<div class="row g-4 mb-4">

    <!-- TOTAL -->
    <div class="col-md-3">
        <div class="kpi-card kpi-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Quotes</small>
                    <h3>{{ $stats['total'] }}</h3>
                </div>
                <i class="bi bi-file-earmark-text kpi-icon"></i>
            </div>
        </div>
    </div>

    <!-- PENDING -->
    <div class="col-md-3">
        <div class="kpi-card kpi-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Pending</small>
                    <h3>{{ $stats['pending'] }}</h3>
                </div>
                <i class="bi bi-hourglass-split kpi-icon"></i>
            </div>
        </div>
    </div>

    <!-- ACCEPTED -->
    <div class="col-md-3">
        <div class="kpi-card kpi-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Accepted</small>
                    <h3>{{ $stats['accepted'] }}</h3>
                </div>
                <i class="bi bi-check-circle kpi-icon"></i>
            </div>
        </div>
    </div>

    <!-- REJECTED -->
    <div class="col-md-3">
        <div class="kpi-card kpi-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Rejected</small>
                    <h3>{{ $stats['rejected'] }}</h3>
                </div>
                <i class="bi bi-x-circle kpi-icon"></i>
            </div>
        </div>
    </div>
<div class="card border-0 rounded-4 mb-4 p-4 business-card">

    <div class="d-flex justify-content-between align-items-center">

        <!-- LEFT -->
        <div class="d-flex align-items-center gap-3">

            <!-- ICON -->
            <div class="value-icon">
                <i class="bi bi-currency-rupee"></i>
            </div>

            <!-- TEXT -->
            <div>
                <small class="text-muted d-block">Total Business Value</small>
                <h3 class="fw-bold text-success mb-0">
                    ₹ {{ number_format($stats['value']) }}
                </h3>
            </div>

        </div>

        

    </div>

</div>
</div>



<div class="row">

   

    <!-- Main -->
<div class="col-md-12 mx-auto dashboard-content">

        <div class="container-fluid py-4">

            <h3 class="fw-bold mb-4">📤 Sent Quotations</h3>
            <!-- ================= FILTER BAR ================= -->
            
            
<form method="GET" class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">

        <div class="row g-3 justify-content-end">

            <!-- SEARCH -->
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Search product or buyer">
                </div>
            </div>

            <!-- STATUS -->
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Accepted</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- APPLY -->
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
                    Apply
                </button>
            </div>

            <!-- RESET -->
            <div class="col-md-1">
                <a href="{{ route('seller.quotations') }}" class="btn btn-light border w-100">
                    Reset
                </a>
            </div>

            <!-- EXPORT -->
            <div class="col-md-2">
                <a href="{{ route('seller.export.quotations') }}" 
                   class="btn btn-success w-100">
                    <i class="bi bi-download me-2"></i> Export
                </a>
            </div>

        </div>

    </div>
</form>

           @forelse($quotations as $index => $quote)
 <div class=" quote-card ">
<div class="card mb-4 border-0 shadow-sm rounded-4">

    <div class="card-body p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start">

            <div>
                <h5 class="fw-bold mb-1 d-flex align-items-center gap-2">

    <!-- ICON -->
    <i class="bi bi-box-seam text-primary"></i>

    <!-- LABEL -->
    <span class="text-muted small">Product:</span>

    <!-- NAME -->
    <span>
        {{ $quote->rfq->product->title ?? 'Product' }}
    </span>

    <!-- QUOTE NUMBER -->
    <span class="ms-2 text-dark">
        (Quote {{ $loop->iteration }})
    </span>

</h5>

                <small class="text-muted">
                    RFQ #{{ $quote->rfq->id }} • 
                    Qty: {{ $quote->rfq->quantity }} {{ $quote->rfq->product->unit ?? '' }}
                </small>
            </div>

            <!-- STATUS -->
             
            <div>
    @if($quote->status == 0)
        <span class="badge bg-warning px-3 py-2">
            ⏳ Waiting for Buyer
        </span>

    @elseif($quote->status == 1)
        <span class="badge bg-success px-3 py-2">
            🏆 Your Quote Accepted
        </span>

    @elseif($quote->status == 2)
        <span class="badge bg-secondary px-3 py-2">
            ❌ Not Selected
        </span>
    @endif
</div>

        </div>

        <hr>

        <!-- RFQ DETAILS -->
        <div class="row g-3 mb-3">

            <div class="col-md-3">
                <small class="text-muted">Buyer</small>
                <div class="fw-semibold">
                    {{ $quote->buyer->full_name ?? 'N/A' }}
                </div>
            </div>

            <div class="col-md-3">
                <small class="text-muted">Target Price</small>
                <div class="text-primary fw-semibold">
                    ₹ {{ $quote->rfq->target_price ?? '-' }}
                </div>
            </div>

            <div class="col-md-3">
                <small class="text-muted">Delivery Needed</small>
                <div>
                    {{ $quote->rfq->delivery_time ?? '-' }}
                </div>
            </div>

            <div class="col-md-3">
                <small class="text-muted">Location</small>
                <div>
                    {{ $quote->rfq->destination_port ?? '-' }}
                </div>
            </div>

        </div>

        <!-- YOUR QUOTATION -->
        <div class="p-3 bg-light rounded-3">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>💰 Your Quotation</strong>

                <div class="fw-bold text-success fs-5">
                    ₹ {{ number_format($quote->price) }}
                    <small class="text-muted">/ {{ $quote->rfq->product->unit ?? 'unit' }}</small>
                </div>
            </div>

            <div class="row g-3">

                <div class="col-md-3">
                    <small class="text-muted">Total Value</small>
                    <div class="fw-bold">
                        ₹ {{ number_format($quote->price * $quote->rfq->quantity) }}
                    </div>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Delivery</small>
                    <div>{{ $quote->delivery_time }}</div>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Payment</small>
                    <div>{{ $quote->payment_terms }}</div>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Submitted</small>
                    <div>{{ $quote->created_at->format('d M Y') }}</div>
                </div>

            </div>

            <!-- MESSAGE -->
            @if($quote->message)
            <div class="mt-3">
                <small class="text-muted">Message</small>
                <div class="mt-1 p-2 bg-white rounded border">
                    {{ $quote->message }}
                </div>
            </div>
            @endif

        </div>

        <!-- PRICE COMPARISON -->
        @if($quote->rfq->target_price)
        <div class="mt-3">
            @if($quote->price <= $quote->rfq->target_price)
                <span class="text-success fw-semibold">
                    ✔ Competitive (Below Buyer Target)
                </span>
            @else
                <span class="text-danger fw-semibold">
                    ⚠ Above Buyer Target
                </span>
            @endif
        </div>
        @endif

    </div>

</div>
</div>
@empty

<div class="text-center py-5">
    @if(request()->has('search') || request()->has('status'))
    <h5>No results found</h5>
    <p class="text-muted">Try changing filters</p>
@else
    <h5>No quotations sent yet</h5>
    <p class="text-muted">Start responding to RFQs to see them here.</p>
@endif
</div>

@endforelse



<!-- Optional: Add loading indicator -->
<div wire:loading class="text-center mt-3">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

        </div>

    </div>
 
</div>
</div>

<livewire:seller.layout.footer />

</div>

