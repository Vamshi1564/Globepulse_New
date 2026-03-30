

<style>
    html, body {
    height: 100%;
}
.rfq-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}
.page-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.page-content {
    flex: 1;
}
.dashboard-title {
    font-size: 22px;
    color: #1f2937;
}

/* Hover */
.rfq-row:hover {
    background: #f9fafb;
    transition: 0.2s ease;
}

/* Icon */
.rfq-icon {
    width: 42px;
    height: 42px;
    background: #eef2ff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 18px;
}
</style>

<div>

<livewire:seller.layout.header />

<div class="container-fluid dashboard-layout">
<div class="row">

<!-- OPTIONAL SIDEBAR -->
<div class="col-md-2">
    {{-- Seller sidebar if exists --}}
</div>

<!-- MAIN -->
<div class="col-md-12">

<div class="container py-4">

<!-- TITLE + BACK -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="dashboard-title fw-bold mb-0">
        📩 RFQs
    </h3>

    <button onclick="history.back()" class="btn btn-outline-primary btn-sm px-3">
        <i class="fas fa-arrow-left me-1"></i> Back
    </button>

</div>

@if($rfqs->isEmpty())

    <div class="alert alert-info text-center p-4">
        No RFQs found
    </div>

@else

<!-- CARD TABLE -->
 <div class="rfq-card">
<div class="card shadow-sm border-0 rounded-4" style="margin-bottom: 120px;">
<div class="card-body p-0">

<div class="table-responsive">
<table class="table align-middle mb-0">

<thead class="table-light">
<tr>
    <th>Product</th>
    <th>Buyer</th>
    <th>Quantity</th>
    <th>Target Price</th>
    <th>Status</th>
    <th>Date</th>
    <th class="text-end">Action</th>
</tr>
</thead>

<tbody>

@foreach($rfqs as $rfq)
<tr class="rfq-row">

<!-- PRODUCT -->
<td>
    <div class="d-flex align-items-center gap-3">

        <div class="rfq-icon">
            📦
        </div>

        <div>
            <div class="fw-semibold">
                {{ $rfq->product->title ?? 'Product' }}
            </div>

            <small class="text-muted">
                RFQ #{{ $rfq->id }}
            </small>
        </div>

    </div>
</td>

<!-- BUYER -->
<td class="fw-medium">
    {{ $rfq->buyer->full_name ?? 'N/A' }}
</td>

<!-- QUANTITY -->
<td class="fw-semibold">
    {{ $rfq->quantity }} {{ $rfq->product->unit }}
</td>
 
<!-- PRICE -->
                                        <td class="text-primary fw-bold">
                                               {{ $rfq->target_price ? '₹ ' . $rfq->target_price : '-' }}/{{ isset($rfq->product->unit) ? Str::singular($rfq->product->unit) : '-' }}

                                            </td>
<!-- STATUS -->
<td>
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

</td>

<!-- DATE -->
<td>
    {{ $rfq->created_at->format('d M Y') }}
</td>

<!-- ACTION -->
<td class="text-end">

    {{-- VIEW --}}
    <a href="{{ route('seller.rfq.view', $rfq->id) }}"
       class="btn btn-sm btn-outline-primary me-2">
        View
    </a>

    @php
    $alreadyQuoted = \App\Models\Quotation::where('rfq_id', $rfq->id)
        ->where('supplier_uuid', session('seller_id'))
        ->exists();
    @endphp

    {{-- STATUS BASED ACTION --}}
    @if($rfq->status === 'rejected')

        <button class="btn btn-secondary btn-sm" disabled>
            ❌ Rejected
        </button>

    @elseif($alreadyQuoted)

        <button class="btn btn-secondary btn-sm" disabled>
            ✔ Already Quoted
        </button>

    @else

        <a href="{{ route('seller.rfq.quote', $rfq->id) }}"
           class="btn btn-success btn-sm">
            💰 Quote
        </a>

    @endif

</td>

</tr>
@endforeach

</tbody>
</table>
</div>

</div>
</div>
</div>
@endif

</div>
</div>
</div>

</div>

<livewire:seller.layout.footer />

</div>