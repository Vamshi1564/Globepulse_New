<style>
.rfq-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #f1f5f9;
}

/* HEADER */
.rfq-header {
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* BODY */
.rfq-body {
    padding: 25px;
}

/* INFO BOX */
.info-box {
    background: #f8fafc;
    padding: 18px;
    border-radius: 12px;
    text-align: center;
    transition: 0.3s;
}

.info-box span {
    display: block;
    font-size: 12px;
    color: #64748b;
}

.info-box strong {
    font-size: 16px;
    color: #0f172a;
}

/* HIGHLIGHTS */
.highlight {
    background: #ecfdf5;
}
.highlight strong {
    color: #059669;
}

.highlight-blue {
    background: #eff6ff;
}
.highlight-blue strong {
    color: #2563eb;
}

/* MESSAGE */
.rfq-message {
    background: #f1f5f9;
    padding: 16px;
    border-radius: 10px;
    line-height: 1.6;
}

/* BUYER CARD */
.buyer-card {
    background: #f9fafb;
    padding: 20px;
    border-radius: 12px;
}

.buyer-card span {
    font-size: 12px;
    color: #64748b;
}

.buyer-card strong {
    font-size: 14px;
}

/* SECTION */
.section-title {
    font-weight: 700;
    margin-bottom: 10px;
    color: #111827;
}

/* BUTTON */
.btn-outline-primary {
    border-radius: 8px;
    font-weight: 500;
}
.btn-outline-primary:hover {
    background: #1e3a8a;
    color: #fff;
    border-color: #1e3a8a;
}
.summary-box {
    background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}
</style>

<div>

<livewire:seller.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

<!-- OPTIONAL SIDEBAR (if seller has one) -->
<div class="col-md-2">
    {{-- Include seller sidebar if available --}}
</div>

<!-- MAIN CONTENT -->
<div class="col-md-12">

<div class="container py-4">

<!-- TOP BAR -->
<div class="d-flex align-items-center justify-content-between mb-4">

    <div class="d-flex align-items-center gap-3">

        <button onclick="history.back()" class="btn btn-outline-primary btn-sm px-3">
            <i class="fas fa-arrow-left me-1"></i> Back
        </button>

        <h3 class="fw-bold mb-0">📄 RFQ Details</h3>

    </div>

</div>

<!-- CARD -->
<div class="rfq-card">

<!-- HEADER -->
<div class="rfq-header">
    <div>
        <h4 class="fw-bold mb-1 text-white">
            {{ $rfq->product->title ?? 'Product' }}
        </h4>
        <small class="text-light">RFQ ID: #{{ $rfq->id }}</small>
    </div>

    <div>
        @php
$myQuote = \App\Models\Quotation::where('rfq_id', $rfq->id)
    ->where('supplier_uuid', session('seller_id'))
    ->first();
@endphp

@if($rfq->status === 'rejected')
    <span class="badge bg-danger">❌ Rejected</span>

@elseif($myQuote)
    <span class="badge bg-success">✔ Quotation Sent</span>

@else
    <span class="badge bg-warning text-dark">⏳ Pending</span>
@endif
    </div>
</div>

<!-- BODY -->
<div class="rfq-body">

<!-- INFO GRID -->
<div class="row g-4">

    <div class="col-md-3">
        <div class="info-box highlight">
            <span>Quantity</span>
            <strong>{{ $rfq->quantity }} {{ $rfq->product->unit }}</strong>
        </div>
    </div>

 @php
    use Illuminate\Support\Str;
@endphp

<div class="col-md-3">
    <div class="info-box highlight-blue">
        <span class="info-label">Target Price (₹)</span>

        <strong class="info-value">
            {{ $rfq->target_price ? '₹ ' . number_format($rfq->target_price) : '-' }}/{{ isset($rfq->product->unit) ? Str::singular($rfq->product->unit) : '-' }}

           
                
            
        </strong>
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
                <strong> {{ $rfq->buyer->full_name ?? 'N/A' }}</strong>
            </div>

            <div class="col-md-6">
                <span>Email</span>
                <strong>{{ $rfq->buyer->email }}</strong>
            </div>

            <div class="col-md-6">
                <span>Phone</span>
                <strong>{{ $rfq->buyer->phone }}</strong>
            </div>

            <div class="col-md-6">
                <span>Company</span>
                <strong>{{ $rfq->buyer->company_name }}</strong>
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
               <strong>{{ $rfq->supplier->legal_business_name ?? '-' }}</strong>
            </div>

            <div class="col-md-6">
                <span>Email</span>
                <strong>{{ $rfq->sellerAccount->email ?? '-' }}</strong>
            </div>

            <div class="col-md-6">
                <span>Phone</span>
                <strong>{{ $rfq->sellerAccount->phone ?? '-' }}</strong>
            </div>

        </div>
    </div>
</div>

<!-- ACTION -->
<div class="mt-4 d-flex justify-content-between align-items-center">

    {{-- LEFT SIDE --}}
    @if($rfq->status === 'rejected')
        <button class="btn btn-danger px-4" disabled>
            ❌ Rejected
        </button>

    @else
        <button onclick="updateRFQStatus('rejected')" 
                class="btn btn-outline-danger px-4">
            ❌ Reject
        </button>
    @endif


    {{-- RIGHT SIDE --}}
    @php
    $alreadyQuoted = \App\Models\Quotation::where('rfq_id', $rfq->id)
        ->where('supplier_uuid', session('seller_id'))
        ->exists();
    @endphp

    @if($rfq->status === 'rejected')
        <button class="btn btn-secondary px-4" disabled>
            🚫 RFQ Closed
        </button>

    @elseif($alreadyQuoted)
        <button class="btn btn-secondary px-4 fw-semibold" disabled>
            ✔ Already Quoted
        </button>

    @else
        <a href="{{ route('seller.rfq.quote', $rfq->id) }}"
           class="btn btn-success px-4 fw-semibold">
            💰 Send Quotation
        </a>
    @endif

</div>

<script>
function updateRFQStatus(status) {
    if (!confirm('Are you sure?')) return;

    document.body.style.cursor = 'wait';

    @this.call('updateStatusAndRedirect', status) // ✅ FIXED
        .then(() => {
            document.body.style.cursor = 'default';
        });
}
</script>

    

</div>
</div>

</div>
</div>
</div>

<livewire:seller.layout.footer />

</div>