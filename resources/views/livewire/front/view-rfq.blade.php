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

/* STATUS */
.status-badge {
    font-size: 12px;
    padding: 6px 14px;
    border-radius: 20px;
}

.status-badge.pending {
    background: #f59e0b;
    color: #fff;
}

.status-badge.success {
    background: #22c55e;
    color: #fff;
}

.status-badge.closed {
    background: #64748b;
    color: #fff;
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
    transition: all 0.3s ease;
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
    display: block;
    font-size: 12px;
    color: #64748b;
}

.buyer-card strong {
    font-size: 14px;
}

/* SECTION TITLE */
.section-title {
    font-weight: 700;
    margin-bottom: 10px;
    color: #111827;
}
.btn-outline-primary {
    border-radius: 8px;
    font-weight: 500;
}

.btn-outline-primary:hover {
    background: #1e3a8a;
    color: #fff;
    border-color: #1e3a8a;
}
</style>

<div>

<livewire:front.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

<!-- Sidebar -->
<div class="col-md-2 dashboard-sidebar">
@include('livewire.front.layout.buyer-sidebar')
</div>

<!-- Main -->
<div class="col-md-10 dashboard-content">

<div class="container py-4">

<div class="d-flex align-items-center justify-content-between mb-4">

    <div class="d-flex align-items-center gap-3">

        <button onclick="history.back()" class="btn btn-outline-primary btn-sm px-3">
            <i class="fas fa-arrow-left me-1"></i> Back
        </button>

        <h3 class="fw-bold mb-0">
            📄 RFQ Details
        </h3>

    </div>

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

        <div>
           @if($rfq->status == 'pending')
    <span class="badge bg-warning text-dark">Pending</span>

@elseif($rfq->status == 'quoted')
    <span class="badge bg-success">Quoted</span>

@elseif($rfq->status == 'accepted')
    <span class="badge bg-primary">Accepted</span>

@elseif($rfq->status == 'rejected')
    <span class="badge bg-danger">Rejected</span>

@elseif($rfq->status == 'closed')
    <span class="badge bg-secondary">Closed</span>
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

        <div class="mt-4">
    <h6 class="section-title">🏭 Supplier Information</h6>

    <div class="buyer-card">
        <div class="row g-3">

            <div class="col-md-6">
                <span>Company</span>
                <strong>{{ $rfq->supplier->company ?? 'N/A' }}</strong>
            </div>

            <div class="col-md-6">
                <span>Email</span>
                <strong>{{ $rfq->supplier->email ?? 'N/A' }}</strong>
            </div>

            <div class="col-md-6">
                <span>Phone</span>
                <strong>{{ $rfq->supplier->phone ?? 'N/A' }}</strong>
            </div>

            <div class="col-md-6">
                <span>Location</span>
                <div class="d-flex align-items-center gap-2">
    <img src="{{ asset('assets/'.$rfq->supplier->country['flag_img']) }}" width="22">
    <span class="fw-semibold">
        {{ $rfq->supplier->country['short_name'] }}
    </span>
</div>
            </div>

        </div>
    </div>
</div>

        <!-- ATTACHMENT -->
        @if($rfq->attachment)
        <div class="mt-4">
            <h6 class="section-title">Attachment</h6>
            <a href="{{ asset('storage/'.$rfq->attachment) }}" target="_blank"
               class="btn btn-primary btn-sm px-3">
                📎 Download File
            </a>
        </div>
        @endif

    </div>

</div>

</div>
</div>

</div>
</div>

<livewire:front.layout.footer />

</div>