<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content p-0 m-0">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-package') }}">My
                            Package</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Invoice List</li>
                </ol>
            </nav>
            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Invoice List</h2>
                </div>
            </div>

            <div class="row g-3 mb-5">
                @forelse ($invoices as $invoice)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-1 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-center mb-3 bg-light p-2 rounded-2">
                                    <h5 class="fw-bolder text-darl ">
                                        {{ $invoice->description ?? 'N/A' }}
                                    </h5>

                                    <span
                                        class="badge py-2
                                                                        {{ $invoice->pendingAmount <= 0 ? 'bg-success' : 'bg-warning text-light' }}">
                                        {{ $invoice->pendingAmount <= 0 ? 'Payment Done' : 'Pending' }}
                                    </span>
                                </div>

                                {{-- <h5 class="fw-semibold text-primary mb-2">
                                    <i class="fas fa-box me-2 text-secondary"></i>
                                    {{ $invoice->description ?? 'N/A' }}
                                </h5> --}}

                                <ul class="list-unstyled fs-9 p-2 text-muted mb-3">
                                    <li><strong>Total Amount:</strong> ₹{{ number_format($invoice->total, 2) }}</li>
                                    <li><strong>Pending Amount:</strong> ₹{{ number_format($invoice->pendingAmount, 2) }}
                                    </li>
                                    <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->date)->format('d-M-Y') }}
                                    </li>
                                </ul>

                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">Invoice
                                        #{{ $loop->iteration }}</span>

                                    @if ($invoice->links && count($invoice->links))
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($invoice->links as $link)
                                                <a href="{{ $link }}" target="_blank"
                                                    class="btn btn-sm bg-primary text-light rounded-pill">
                                                    <i class="fas fa-file-invoice me-1"></i> Invoice
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class=" alert-warning text-center rounded-3">
                            No invoices found.
                        </div>
                    </div>
                @endforelse
            </div>
            <style>
                <style>.card:hover {
                    transform: translateY(-2px);
                    transition: all 0.3s ease-in-out;
                    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
                }
            </style>

            </style>

        </div>
    </div>

    <livewire:seller.layout.footer />
</div>