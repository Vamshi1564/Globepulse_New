<div>

<livewire:seller.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

   

    <!-- Main -->
    <div class="col-md-10 dashboard-content">

        <div class="container py-4">

            <h3 class="fw-bold mb-4">📤 Sent Quotations</h3>

            @forelse($quotations as $quote)

            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <h6 class="fw-bold mb-1">
                                {{ $quote->rfq->product->title ?? 'Product' }}
                            </h6>

                            <small class="text-muted">
                                RFQ #{{ $quote->rfq->id }}
                            </small>
                        </div>

                        <!-- STATUS -->
                        <div>
                            @if($quote->status == 0)
                                <span class="badge bg-warning">Pending</span>
                            @elseif($quote->status == 1)
                                <span class="badge bg-success">Accepted</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-3">
                            <small class="text-muted">Price</small>
                            <div class="fw-bold text-success">
                                ₹ {{ $quote->price }}
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
                            <small class="text-muted">Buyer</small>
                            <div>{{ $quote->buyer->full_name ?? 'N/A' }}</div>
                        </div>

                    </div>

                    <p class="mt-3 mb-1">
                        {{ $quote->message }}
                    </p>

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