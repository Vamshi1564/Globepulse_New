<div>
    <livewire:seller.layout.header />

    <div class="container mt-4">

        <nav class="mb-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                {{-- <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li> --}}
                <li class="breadcrumb-item"><a href="{{ route('my-resources') }}">My Resources</a></li>

                @if($type === 'proforma')
                    <li class="breadcrumb-item active" aria-current="page">Proforma List</a></li>
                @elseif($type === 'commercial')
                    <li class="breadcrumb-item active" aria-current="page">Commercial List</a></li>
                @elseif($type === 'packing_list')
                    <li class="breadcrumb-item active" aria-current="page">Packing List</a></li>
                @elseif($type === 'purchas_order')
                    <li class="breadcrumb-item active" aria-current="page">Purchase Order List</a></li>
                @endif

            </ol>
        </nav>

        <h5 class="text-center mb-4 text-primary">{{ strtoupper($type) }} LIST</h5>

        <div class="table-responsive rounded-3 shadow-sm">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center align-middle" style="width: 60px;">No.</th>
                        @if($type === 'purchas_order')
                            <th>PO Number</th>
                            <th>PO Date</th>
                            <th>Company Name</th>
                        @else
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Exporter</th>
                        @endif
                        <th class="text-center align-middle" style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoiceList as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            @if($type === 'purchas_order')
                                <td class="fw-semibold">{{ $item->po_number }}</td>
                                <td>{{ $item->po_date }}</td>
                                <td>{{ $item->company_name }}</td>
                            @else
                                <td>{{ $item->invoice_no }}</td>
                                <td>{{ $item->invoice_date }}</td>
                                <td>{{ $item->exporter }}</td>
                            @endif

                            <td class="text-center">
                                @if($type === 'proforma')
                                    <a href="{{ route('proforma-download', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-eye me-1"></i> View Invoice
                                    </a>
                                @elseif($type === 'commercial')
                                    <a href="{{ route('commercial-download', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-eye me-1"></i> View Invoice
                                    </a>
                                @elseif($type === 'packing_list')
                                    <a href="{{ route('packinglist-download', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-eye me-1"></i> View Invoice
                                    </a>
                                @else
                                    <a href="{{ route('purchaseorder-download', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-eye me-1"></i> View Invoice
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <livewire:seller.layout.footer />
</div>