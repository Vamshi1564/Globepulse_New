<div>

<livewire:seller.layout.header />

<div class="container py-4">

<h3 class="fw-bold mb-4">💰 Send Quotation</h3>

<div class="card shadow-sm border-0 rounded-4">
<div class="card-body">

{{-- ================= RFQ SUMMARY ================= --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">

        <h5 class="fw-bold mb-3">📄 RFQ Summary</h5>

        <div class="row g-3">

            <div class="col-md-4">
                <small class="text-muted">Product</small>
                <div class="fw-semibold">
                    {{ $rfq->product->title ?? 'N/A' }}
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Quantity</small>
                <div class="fw-semibold">
                    {{ $rfq->quantity }} {{ $rfq->product->unit ?? '' }}
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Target Price</small>
                <div class="fw-semibold text-primary">
                    @if($rfq->target_price)
                        ₹ {{ $rfq->target_price }} / {{ $rfq->product->unit }}
                    @else
                        -
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Delivery</small>
                <div class="fw-semibold">
                    {{ $rfq->delivery_time ?? '-' }}
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Shipping</small>
                <div class="fw-semibold">
                    {{ $rfq->shipping_terms ?? '-' }}
                </div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Payment</small>
                <div class="fw-semibold">
                    {{ $rfq->payment_terms ?? '-' }}
                </div>
            </div>

            <div class="col-md-12">
                <small class="text-muted">Requirement</small>
                <div class="p-2 bg-light rounded mt-1">
                    {{ $rfq->message }}
                </div>
            </div>

        </div>

    </div>
</div>

{{-- ================= QUOTATION FORM ================= --}}
<form wire:submit.prevent="submitQuote" class="rfq-quote-form">

<div class="card border-0 shadow-sm rounded-4">
<div class="card-body p-4">

{{-- HEADER --}}
<div class="mb-4">
    <h5 class="fw-bold mb-1">💰 Create Quotation</h5>
    <small class="text-muted">
        Quoting for 
        <strong>{{ $rfq->quantity }} {{ $rfq->product->unit ?? 'units' }}</strong>
    </small>
</div>

<div class="row g-4">

{{-- PRICE --}}
<div class="col-md-6">
    <label class="form-label fw-semibold">
        Price per {{ $rfq->product->unit ?? 'unit' }}
        <span class="text-danger">*</span>
    </label>

    <div class="input-group">
        <span class="input-group-text">₹</span>

        <input type="number"
               wire:model.live="price"
               class="form-control"
               placeholder="Enter price">

        <span class="input-group-text">
            / {{ $rfq->product->unit ?? 'unit' }}
        </span>
    </div>

    @if($rfq->target_price)
        <small class="text-muted">
            Buyer target: ₹{{ $rfq->target_price }} / {{ $rfq->product->unit }}
        </small>
    @endif
</div>

{{-- DELIVERY --}}
<div class="col-md-6">
    <label class="form-label fw-semibold">
        Delivery Time <span class="text-danger">*</span>
    </label>

    <select wire:model="delivery_time" class="form-select">
        <option value="">Select delivery time</option>
        <option>1-3 days</option>
        <option>3-5 days</option>
        <option>7 days</option>
        <option>10 days</option>
        <option>14 days</option>
        <option>21 days</option>
        <option>30 days</option>
        <option>45 days</option>
        <option>60 days</option>
        <option>90 days</option>
    </select>
</div>

{{-- PAYMENT --}}
<div class="col-md-6">
    <label class="form-label fw-semibold">
        Payment Terms
    </label>

    <select wire:model="payment_terms" class="form-select">
        <option value="">Select payment terms</option>
        <option>Advance</option>
        <option>50% Advance</option>
        <option>LC</option>
        <option>Net 30</option>
        <option>Net 60</option>
    </select>
</div>

{{-- MESSAGE --}}
<div class="col-12">
    <label class="form-label fw-semibold">
        Message / Notes
    </label>

    <textarea wire:model="message"
              rows="4"
              class="form-control"
              placeholder="Add offer details, negotiation terms..."></textarea>
</div>

</div>



<div class="mt-4 p-3 border rounded bg-light">

    <h6 class="fw-bold mb-2">📊 Deal Summary</h6>

    <div class="d-flex justify-content-between">
        <span>Total Value:</span>
        <strong>
            ₹ {{ $this->priceVal ? number_format($this->total) : '0' }}
        </strong>
    </div>

    @if($rfq->target_price && $this->priceVal)
        <div class="mt-2">
            @if($this->priceVal <= $rfq->target_price)
                <span class="text-success">✔ Competitive price</span>
            @else
                <span class="text-danger">⚠ Higher than buyer expectation</span>
            @endif
        </div>
    @endif

    @if(!$this->priceVal)
        <small class="text-muted d-block mt-2">
            Enter price to see calculation
        </small>
    @endif

</div>


{{-- FOOTER --}}
<div class="d-flex justify-content-between align-items-center mt-4">

    <small class="text-muted">
        ⚡ Tip: Competitive pricing increases acceptance chances
    </small>

@if($rfq->status === 'quoted')
    <button class="btn btn-secondary px-4 fw-semibold" disabled>
        ✔ Already Quoted
    </button>
@else

    <div class="d-flex gap-2">

    <button type="submit"
            class="btn btn-success px-4 fw-semibold"
            wire:loading.attr="disabled">

        <span wire:loading.remove>
            🚀 Send Quotation
        </span>

        <span wire:loading>
            <span class="spinner-border spinner-border-sm me-1"></span>
            Sending...
        </span>
    </button>

    <!-- Cancel Button -->
    <button type="button"
            onclick="history.back()"
            class="btn btn-outline-secondary px-4 fw-semibold">
        ❌ Cancel
    </button>

</div>

@endif

</div>

</div>
</div>

</form>

</div>
</div>

</div>

<livewire:seller.layout.footer />

</div>