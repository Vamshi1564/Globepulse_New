<style>
    .dashboard-title {
    font-size: 22px;
    color: #1f2937;
}

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

                    <h3 class="dashboard-title mb-4 fw-bold">
                        📩 My RFQs
                    </h3>

                    @if($rfqs->isEmpty())
                        <div class="alert alert-info text-center p-4">
                            No RFQs found
                        </div>
                    @else

                    <!-- Card Container -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-0">

                            <div class="table-responsive">
                                <table class="table align-middle mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Target Price</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($rfqs as $rfq)
                                        <tr class="rfq-row">

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

                                            <td class="fw-semibold">
                                                {{ $rfq->quantity }} {{ $rfq->product->unit }}
                                            </td>

                                            <td class="text-primary fw-bold">
                                               {{ $rfq->target_price ? '₹ ' . $rfq->target_price : '-' }}/{{ isset($rfq->product->unit) ? Str::singular($rfq->product->unit) : '-' }}

                                            </td>
                                            

                                            <td>
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
                                            </td>

                                            <td>
                                                {{ $rfq->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                            <a href="{{ route('buyer.rfq.view', $rfq->id) }}" 
                                            class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

    <livewire:front.layout.footer />
</div>