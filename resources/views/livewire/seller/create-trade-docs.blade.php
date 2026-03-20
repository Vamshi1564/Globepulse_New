<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content m-0 p-0">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-resources') }}">My
                            Resources</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Create Trade Docs</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Create Trade Docs</h2>
                </div>
            </div>

            <style>
                .hover-shadow {
                    transition: all 0.3s ease-in-out;
                }

                .hover-shadow:hover {
                    box-shadow: 0 0.75rem 1.25rem rgba(0, 0, 0, 0.15);
                    transform: translateY(-4px);
                }
            </style>

            <div class="row g-4 mb-5">
                @foreach($documents as $doc)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-1 rounded-4 h-100 hover-shadow">
                            <div class="card-body d-flex flex-column justify-content-between p-4">

                                <div class="mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary me-3 px-3 py-2">
                                            #{{ $loop->iteration }}
                                        </span>

                                        <h5 class="mb-0 fw-semibold text-dark">{{ $doc['name'] }}</h5>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    <a href="{{ route('invoice-lists', ['type' => $doc['type']]) }}"
                                        class="btn btn-sm btn-outline-success px-3" style="width: 45%">
                                        <i class="fa-solid fa-eye me-1"></i> View List
                                    </a>

                                    @if($doc['type'] === 'proforma')
                                        <a href="{{ route('ProformaInvoice') }}" class="btn btn-sm btn-primary px-3"
                                            style="width: 45%">
                                            <i class="fa-solid fa-plus me-1"></i> Create
                                        </a>
                                    @elseif($doc['type'] === 'commercial')
                                        <a href="{{ route('CommercialInvoice') }}" class="btn btn-sm btn-primary px-3"
                                            style="width: 45%">
                                            <i class="fa-solid fa-plus me-1"></i> Create
                                        </a>
                                    @elseif($doc['type'] === 'packing_list')
                                        <a href="{{ route('PackingListInvoice') }}" class="btn btn-sm btn-primary px-3"
                                            style="width: 45%">
                                            <i class="fa-solid fa-plus me-1"></i> Create
                                        </a>
                                    @elseif($doc['type'] === 'purchas_order')
                                        <a href="{{ route('PurchaseOrder') }}" class="btn btn-sm btn-primary px-3"
                                            style="width: 45%">
                                            <i class="fa-solid fa-plus me-1"></i> Create
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>
    </div>
    <livewire:seller.layout.footer />

</div>