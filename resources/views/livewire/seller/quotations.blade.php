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
</style>

<div>

<livewire:seller.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

   

    <!-- Main -->
<div class="col-md-10 mx-auto dashboard-content">

        <div class="container py-4">

            <h3 class="fw-bold mb-4">📤 Sent Quotations</h3>

           @forelse($quotations as $quote)
<div class="quote-card">
<div class="card mb-4 border-0 shadow-sm rounded-4">

    <div class="card-body p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start">

            <div>
                <h5 class="fw-bold mb-1">
                    {{ $quote->rfq->product->title ?? 'Product' }}
                </h5>

                <small class="text-muted">
                    RFQ #{{ $quote->rfq->id }} • 
                    Qty: {{ $quote->rfq->quantity }} {{ $quote->rfq->product->unit ?? '' }}
                </small>
            </div>

            <!-- STATUS -->
            <div>
                @if($quote->status == 0)
                    <span class="badge bg-warning px-3 py-2">Pending</span>
                @elseif($quote->status == 1)
                    <span class="badge bg-success px-3 py-2">Accepted</span>
                @else
                    <span class="badge bg-danger px-3 py-2">Rejected</span>
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
    <h5>No quotations sent yet</h5>
    <p class="text-muted">Start responding to RFQs to see them here.</p>
</div>

@endforelse

           

        </div>

    </div>
</div>
</div>

<livewire:seller.layout.footer />

</div>