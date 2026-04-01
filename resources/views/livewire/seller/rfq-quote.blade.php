<div>

<livewire:seller.layout.header />

<div class="container py-4">

<h3 class="fw-bold mb-4">💰 Send Quotation</h3>

<div class="row g-4">

    {{-- LEFT SIDE --}}
    <div class="col-lg-8">

        {{-- RFQ SUMMARY --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <h5 class="fw-bold mb-3">📄 RFQ Details</h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <small class="text-muted">Product</small>
                        <div class="fw-semibold fs-6">
                            {{ $rfq->product->title ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Quantity</small>
                        <div class="fw-semibold fs-6">
                            {{ $rfq->quantity }} {{ $rfq->product->unit ?? '' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Target Price</small>
                        <div class="fw-semibold text-primary">
                            ₹ {{ $rfq->target_price ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Delivery</small>
                        <div class="fw-semibold">
                            {{ $rfq->delivery_time ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <small class="text-muted">Requirement</small>
                        <div class="p-3 bg-light rounded mt-1 small">
                            {{ $rfq->message }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- QUOTATION FORM --}}
        <form wire:submit.prevent="submitQuote">

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">💼 Your Quotation</h5>

                <div class="row g-4">

                    {{-- PRICE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Price *</label>

                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number"
                                   wire:model.live="price"
                                   class="form-control"
                                   placeholder="Enter price">
                        </div>
                    </div>

                    {{-- DELIVERY --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Delivery Time *</label>

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
                        <label class="form-label fw-semibold">Payment Terms</label>

                        <select wire:model="payment_terms" class="form-select">
                            <option value="">Select</option>
                            <option>Advance</option>
                            <option>50% Advance</option>
                            <option>Net 30</option>
                        </select>
                    </div>

                    {{-- MESSAGE --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Notes</label>

                        <textarea wire:model="message"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Add details..."></textarea>
                    </div>

                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <button type="button"
                            onclick="history.back()"
                            class="btn btn-light border">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-success px-4"
                            wire:loading.attr="disabled">

                        <span wire:loading.remove>
                            🚀 Send Quote
                        </span>

                        <span wire:loading>
                            Sending...
                        </span>
                    </button>

                </div>

            </div>
        </div>

        </form>

    </div>


    {{-- RIGHT SIDE (STICKY SUMMARY) --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 20px;">
            <div class="card-body">

                <h6 class="fw-bold mb-3">📊 Deal Summary</h6>

                <div class="d-flex justify-content-between mb-2">
                    <span>Unit Price</span>
                    <strong>₹ {{ $this->priceVal ?? 0 }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Total</span>
                    <strong class="fs-5 text-success">
                        ₹ {{ $this->priceVal ? number_format($this->total) : 0 }}
                    </strong>
                </div>

                <hr>

                @if($rfq->target_price && $this->priceVal)
                    @if($this->priceVal <= $rfq->target_price)
                        <div class="alert alert-success py-2 small mb-0">
                            ✔ Competitive pricing
                        </div>
                    @else
                        <div class="alert alert-danger py-2 small mb-0">
                            ⚠ Above buyer expectation
                        </div>
                    @endif
                @endif

                @if(!$this->priceVal)
                    <small class="text-muted">
                        Enter price to preview total
                    </small>
                @endif

            </div>
        </div>

    </div>

</div>

</div>

<livewire:seller.layout.footer />

</div>