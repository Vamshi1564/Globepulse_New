

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

<div class="container-fluid py-4">

<!-- TITLE + BACK -->
<div class="d-flex align-items-center gap-3 mb-4">

    <button onclick="history.back()" class="btn btn-outline-primary btn-sm px-3">
        <i class="fas fa-arrow-left me-1"></i> Back
    </button>

    <h3 class="dashboard-title fw-bold mb-0">
        📩 RFQs
    </h3>

</div>
<form method="GET" action="{{ route('seller.rfqs') }}" 
      class="mb-3 d-flex gap-2 align-items-end justify-content-end">

    <input type="text" 
           name="search" 
           value="{{ request('search') }}"
           placeholder="Search product, buyer, price..."
           class="form-control w-25">

    <button type="submit" class="btn btn-primary">
        Search
    </button>

    <a href="{{ route('seller.rfqs') }}" class="btn btn-secondary">
        Reset
    </a>

</form>
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
<tr class="text-left">
    <th>Product</th>
    <th>Buyer</th>
    <th>Quantity</th>
    <th>Target Price</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($rfqs as $rfq)
<tr class="rfq-row text-left">

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
<td>

    <div class="d-flex gap-2">

        {{-- VIEW --}}
        <a href="{{ route('seller.rfq.view', $rfq->id) }}"
           class="btn btn-sm btn-outline-primary">
            View
        </a>

        @php
        $alreadyQuoted = \App\Models\Quotation::where('rfq_id', $rfq->id)
            ->where('supplier_uuid', session('seller_id'))
            ->exists();

        $hasQuotes = \App\Models\Quotation::where('rfq_id', $rfq->id)->exists();
        @endphp

        {{-- STATUS / QUOTE --}}
        @if($rfq->status === 'rejected')

            <button class="btn btn-secondary btn-sm" disabled>
                ❌ Rejected
            </button>

        @elseif($alreadyQuoted)

            <button class="btn btn-secondary btn-sm" disabled>
                ✔ Quoted
            </button>

        @else

            <a href="{{ route('seller.rfq.quote', $rfq->id) }}"
               class="btn btn-success btn-sm">
                💰 Quote
            </a>

        @endif

        {{-- DELETE --}}
        @if(!$hasQuotes)

            <form action="{{ route('seller.rfq.delete', $rfq->id) }}" 
                  method="POST"
                  onsubmit="return confirm('Delete this RFQ?')"
                  class="d-inline">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">
                    🗑
                </button>
            </form>

        @else
<button class="btn btn-danger btn-sm" disabled title="Has Quotes">
   🗑
</button>

        @endif

    </div>

</td>

</tr>
@endforeach

</tbody>
</table>
<div class="d-flex justify-content-between align-items-center mt-4">

    <div class="text-muted small">
        Showing {{ $rfqs->firstItem() }} to {{ $rfqs->lastItem() }} 
        of {{ $rfqs->total() }} results
    </div>

    <div>
        {{ $rfqs->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
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