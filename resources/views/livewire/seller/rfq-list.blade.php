@php
use Carbon\Carbon;

$rfqs = collect([
    (object)[
        'id' => 1,
        'product' => (object)['title' => 'Wheat Flour'],
        'name' => 'Ravi Traders',
        'quantity' => '100 kg',
        'target_price' => '₹50/kg',
        'status' => 0,
        'created_at' => Carbon::now()
    ],
    (object)[
        'id' => 2,
        'product' => (object)['title' => 'Rice Premium'],
        'name' => 'Global Foods Ltd',
        'quantity' => '500 kg',
        'target_price' => '₹60/kg',
        'status' => 1,
        'created_at' => Carbon::now()->subDays(2)
    ],
    (object)[
        'id' => 3,
        'product' => (object)['title' => 'Sugar'],
        'name' => 'ABC Exports',
        'quantity' => '200 kg',
        'target_price' => null,
        'status' => 2,
        'created_at' => Carbon::now()->subDays(5)
    ],
]);
@endphp

<style>
.rfq-row:hover {
    background: #f9fafb;
    transition: 0.2s ease;
}

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

    <div class="container">
        <div class="content">

            <!-- Header -->
            <div class="row gx-3 flex-between-end mb-4">
                <div class="col-auto">
                    <h2 class="mb-2">📩 RFQs</h2>
                </div>

                <div class="col-auto">
                    <button onclick="history.back()" class="btn btn-phoenix-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </button>
                </div>
            </div>

            @if($rfqs->isEmpty())

                <div class="alert alert-info text-center">
                    No RFQs found
                </div>

            @else

            <!-- Table -->
            <div class="table-responsive scrollbar">
                <table class="table fs-9 mb-0">

                    <thead>
                        <tr>
                            <th class="sort align-middle" style="min-width:220px;">PRODUCT</th>
                            <th class="sort align-middle">BUYER</th>
                            <th class="sort align-middle">QUANTITY</th>
                            <th class="sort align-middle">PRICE</th>
                            <th class="sort align-middle">STATUS</th>
                            <th class="sort text-end align-middle">DATE</th>
                            <th class="text-end"></th>
                        </tr>
                    </thead>

                    <tbody class="list">

                        @foreach($rfqs as $rfq)
                        <tr class="hover-actions-trigger position-static">

                            <!-- Product -->
                            <td class="align-middle product">
                                <a class="fw-semibold line-clamp-1"
                                   href="{{ route('seller.rfq.view', $rfq->id) }}">
                                    {{ $rfq->product->title ?? 'Product' }}
                                </a>
                            </td>

                            <!-- Buyer -->
                            <td class="align-middle">
                                {{ $rfq->name ?? '-' }}
                            </td>

                            <!-- Quantity -->
                            <td class="align-middle fw-semibold">
                                {{ $rfq->quantity }}
                            </td>

                            <!-- Price -->
                            <td class="align-middle">
                                {{ $rfq->target_price ?? '-' }}
                            </td>

                            <!-- Status -->
                            <td class="align-middle">
                                @if($rfq->status == 0)
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-warning">
                                        Pending
                                    </span>
                                @elseif($rfq->status == 1)
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                        Quoted
                                    </span>
                                @else
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-secondary">
                                        Closed
                                    </span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="align-middle text-end">
                                <p class="text-body-tertiary mb-0">
                                    {{ $rfq->created_at->format('d M Y') }}
                                </p>
                            </td>

                            <!-- Actions -->
                            <td class="align-middle text-end pe-0">

                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown">

                                        <span class="fas fa-ellipsis-h fs-10"></span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end py-2">

                                        <a class="dropdown-item"
                                           href="{{ route('seller.rfq.view', $rfq->id) }}">
                                            View
                                        </a>

                                        <a class="dropdown-item"
                                           href="{{ route('seller.rfq.quote', $rfq->id) }}">
                                            Send Quote
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item text-danger"
                                           href="#">
                                            Close RFQ
                                        </a>

                                    </div>
                                </div>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            @endif

        </div>
    </div>

    <livewire:seller.layout.footer />
</div>

 <!-- <a class="dropdown-item"
                                           href="{{ route('seller.rfq.view', $rfq->id) }}">
                                            View
                                        </a> -->