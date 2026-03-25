<div>

<livewire:front.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

<div class="col-md-2 dashboard-sidebar">
    @include('livewire.front.layout.buyer-sidebar')
</div>

<div class="col-md-10 dashboard-content">

<div class="container py-4">

<h3 class="fw-bold mb-4">💰 Quotations Received</h3>

@php
    $grouped = $quotations->groupBy('rfq_id');
@endphp

@forelse($grouped as $rfqId => $quotes)

@php
    $rfq = $quotes->first()->rfq;
    $minPrice = $quotes->min('price');
@endphp

{{-- ================= RFQ SUMMARY ================= --}}
<div class="card mb-3 border-0 shadow-sm">
<div class="card-body">

<h5 class="fw-bold mb-3">📄 RFQ #{{ $rfq->id }}</h5>

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

</div>
</div>

{{-- ================= QUOTES ================= --}}
@foreach($quotes as $quote)

@php
    $unit = $rfq->product->unit ?? 'unit';

    $qty  = (float) ($rfq->quantity ?? 0);
    $price = (float) ($quote->price ?? 0);

    $total = $price * $qty;
@endphp

<div class="card mb-3 shadow-sm border-0">
<div class="card-body">

<div class="d-flex justify-content-between">

    <div>
        <h6 class="fw-bold mb-1">
            {{ $rfq->product->title }}
        </h6>
        <small class="text-muted">
            Supplier: {{ $quote->supplier->company ?? 'N/A' }}
        </small>
    </div>

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
    <small class="text-muted">Unit Price</small>
    <div class="fw-bold text-success">
       ₹ {{ number_format((float)$quote->price) }} / {{ $unit }}
    </div>

    @if($quote->price == $minPrice)
        <span class="badge bg-success">Best Price</span>
    @endif
</div>

<div class="col-md-3">
    <small class="text-muted">Total</small>
    <div class="fw-bold">
        ₹ {{ number_format($total) }}
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

</div>

{{-- PRICE COMPARISON --}}
@if($rfq->target_price)
<div class="mt-2">
    @if($quote->price <= $rfq->target_price)
        <small class="text-success">✔ Below target price</small>
    @else
        <small class="text-danger">⚠ Above target price</small>
    @endif
</div>
@endif

<p class="mt-3 mb-1">
    {{ $quote->message }}
</p>

{{-- ACTION --}}
@if($quote->status == 0)
<div class="mt-3 d-flex gap-2">

<button wire:click="accept({{ $quote->id }})"
    class="btn btn-success btn-sm px-3">
    ✅ Accept Deal
</button>

<button wire:click="reject({{ $quote->id }})"
    class="btn btn-outline-danger btn-sm px-3">
    Reject
</button>

</div>
@endif

</div>
</div>

@endforeach

@empty

<div class="text-center py-5">
    <h5>No quotations received yet</h5>
    <p class="text-muted">Suppliers will respond soon.</p>
</div>

@endforelse

</div>

</div>
</div>
</div>

<livewire:front.layout.footer />

</div>