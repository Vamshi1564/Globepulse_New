<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content px-0 pt-7">
            <h2 class="mb-2 text-white d-inline-flex align-items-center">
                <span class="bg-primary-subtle text-primary shadow-sm rounded p-2 me-2 d-inline-flex">
                    <i class="bi bi-truck"></i>
                </span>
                <span class="text-muted">Shipments Data List</span>
            </h2>

            {{-- //start pagination --}}
            <div class="row align-items-center my-3">
                @php
                    $start = ($currentPage - 1) * $perPage + 1;
                    $end = min($start + $perPage - 1, $totalShipments);

                    $pages = [];

                    if ($totalPages <= 5) {
                        $pages = range(1, $totalPages);
                    } else {
                        if ($currentPage <= 3) {
                            $pages = [1, 2, 3, '...', $totalPages];
                        } elseif ($currentPage >= $totalPages - 2) {
                            $pages = [1, '...', $totalPages - 2, $totalPages - 1, $totalPages];
                        } else {
                            $pages = [1, '...', $currentPage - 1, $currentPage, $currentPage + 1, '...', $totalPages];
                        }
                    }
                @endphp

                <div class="d-flex flex-wrap align-items-center justify-content-between text-center">
                    {{-- Showing count --}}
                    <p class="text-sm text-black-50 fw-bold fs-9  mb-0">
                        Showing <strong>{{ $start }}</strong> – <strong>{{ $end }}</strong> of
                        <strong>{{ $totalShipments }}</strong> records
                    </p>

                    {{-- Pagination --}}
                    <div>

                        <p class="mt-3 fs-9 text-sm text-black-50 fw-bold">Page {{ $currentPage }} of
                            {{ $totalPages }}
                        </p>

                        <div class="flex flex-wrap justify-center items-center gap-1">
                            {{-- Previous --}}
                            <button wire:click="previousPage"
                                class="px-3 py-1 fs-9 rounded text-sm border shadow-sm transition 
            {{ $currentPage == 1
                ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                : 'bg-white text-gray-700 hover:bg-blue-500 hover:text-white border-gray-300' }}"
                                {{ $currentPage == 1 ? 'disabled' : '' }}>
                                ⬅
                            </button>

                            {{-- Page Numbers --}}
                            @foreach ($pages as $index => $page)
                                @if ($page === '...')
                                    <span class="px-3 py-1.5 text-sm text-gray-400 font-medium">…</span>
                                @else
                                    <button wire:click="goToPage({{ $page }})"
                                        wire:key="page-{{ $page }}-{{ $currentPage }}"
                                        class="px-3 py-1 fs-9 rounded text-sm border font-medium shadow-sm transition-all duration-200
                    {{ $currentPage === $page
                        ? 'bg-primary text-white border-primary'
                        : 'bg-white text-gray-700 border-gray-300 hover:bg-blue-500 hover:text-white hover:border-blue-500' }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            <button wire:click="nextPage"
                                class="px-3 py-1 fs-9 rounded text-sm border shadow-sm transition 
            {{ $currentPage == $totalPages
                ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                : 'bg-white text-gray-700 hover:bg-blue-500 hover:text-white border-gray-300' }}"
                                {{ $currentPage == $totalPages ? 'disabled' : '' }}>
                                ➡
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- End pagination --}}

            {{-- <div class="table-responsive scrollbar mx-n1 px-1 rounded-3 shadow-sm">
                <table class="table table-hover table-bordered align-middle text-center bg-white">
                    <thead class="fs-9 table-primary text-uppercase">
                        <tr>
                            <th class="sort white-space-nowrap align-middle border-end border-translucent"
                                scope="col" style="width:70px;">
                                No.
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Exporter_Name
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Exporter_Address
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Port_Of_Discharge
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Importer_Buyer_Name
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Importer_Buyer_Address
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Port_Of_Loading
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Country_Of_Discharge
                            </th>
               
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                HSNCode
                            </th>
                            <th class="sort align-middle border-end border-translucent" scope="col"
                                style="width:150px;">
                                Product_Description
                            </th>
                        </tr>

                    </thead>
                    <tbody class="list" id="products-table-body">
                        @forelse ($shipmentData as $item)
                            <tr class="position-static">
                                <td
                                    class="price align-middle white-space-nowrap ps-2 fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $loop->iteration }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    <a href="{{ route('expoter-company-details', ['id' => $item->id]) }}"
                                        class="text-decoration-none text-primary">
                                        {{ $item->exporter_name }}
                                    </a>
                                </td>

                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->exporter_address }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->port_of_discharge }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->importer_buyer_name }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->importer_buyer_address }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->port_of_loading }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    @if ($item->flag_img)
                                                <img src="{{ asset('assets/' . $item->flag_img) }}" class="flag me-2"
                                                    alt="{{ $item->country_of_discharge }}" width="24">
                                            @else
                                                <img src="https://flagcdn.com/w40/un.png" class="flag me-2"
                                                    alt="{{ $item->country_of_discharge }}" width="24">
                                            @endif
                                            {{ $item->country_of_discharge }}
                                    {{ $item->country_of_discharge }}
                                </td>
                        
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->hsncode }}
                                </td>
                                <td
                                    class="price align-middle white-space-nowrap fs-9 fw-semibold text-body-tertiary border-end border-translucent">
                                    {{ $item->product_description }}
                                </td>
                            
                            </tr>
                        @empty
                            <tr>
                                <td colspan="20" class="text-center text-danger fw-semibold py-3">
                                    <i class="bi bi-box-seam me-2"></i> No shipment data found.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div> --}}

            <div class="row">
                @forelse ($shipmentData as $item)
                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4 shipment-item">
                        <div class="card h-100 shadow-sm border-0 shipment-card rounded-3">
                            <!-- Card Header -->
                            <div class="card-header-custom text-white position-relative">
                                <span class="position-absolute top-0 start-0 badge iteration-badge m-2 py-2 px-2">
                                    #{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}
                                </span>
                                <div class="text-center pt-3 pb-1">
                                    <h6 class="card-title mb-1 fw-semibold">
                                        <a href="{{ route('expoter-company-details', ['id' => $item->id]) }}"
                                            class="text-white text-decoration-none stretched-link">
                                            {{ Str::limit($item->exporter_name, 35) }}
                                        </a>
                                    </h6>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <i class="bi bi-geo-alt-fill me-1 small"></i>
                                        <small class="opacity-90">{{ Str::limit($item->exporter_address, 30) }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-3">
                                <div class="row g-2">
                                    <!-- Exporter Address -->
                                    <div class="col-12">
                                        <div class="info-item highlight-bg">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-building"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Exporter Address</div>
                                                    <div class="detail-value">{{ $item->exporter_address }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Port of Loading -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-box-arrow-up"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Port of Loading</div>
                                                    <div class="detail-value">{{ $item->port_of_loading }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Importer/Buyer -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-person-badge"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Importer/Buyer</div>
                                                    <div class="detail-value">{{ $item->importer_buyer_name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buyer Address -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Buyer Address</div>
                                                    <div class="detail-value">
                                                        {{ Str::limit($item->importer_buyer_address, 25) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Port of Discharge -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-box-arrow-down"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Port of Discharge</div>
                                                    <div class="detail-value">{{ $item->port_of_discharge }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Destination Country -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-flag"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Destination Country</div>
                                                    <div class="d-flex align-items-center mt-1">
                                                        <img src="{{ $item->flag_img ? asset('assets/' . $item->flag_img) : 'https://flagcdn.com/w40/un.png' }}"
                                                            class="me-2 flag-img"
                                                            alt="{{ $item->country_of_discharge }}" width="20"
                                                            height="14">
                                                        <span
                                                            class="detail-value">{{ $item->country_of_discharge }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- HSN Code -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-upc-scan"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">HSN Code</div>
                                                    <div class="detail-value">{{ $item->hsncode }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="col-12">
                                        <div class="info-item highlight-bg">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-wrapper me-2">
                                                    <i class="bi bi-box-seam"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="detail-label">Product Description</div>
                                                    <div class="detail-value">
                                                        {{ Str::limit($item->product_description, 70) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                                <a href="{{ route('expoter-company-details', ['id' => $item->id]) }}"
                                    class="btn btn-sm view-details-btn w-100 py-2 text-white">
                                    <i class="bi bi-eye me-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="py-5 px-3 text-center">
                            <div class="position-relative d-inline-block mb-4">
                                <!-- Background Decoration -->
                                <div class="position-absolute top-50 start-50 translate-middle"
                                    style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(13, 110, 253, 0.05) 0%, rgba(255,255,255,0) 70%); z-index: 0;">
                                </div>

                                <!-- Main Icon -->
                                <div class="position-relative" style="z-index: 1;">
                                    <i class="bi bi-layers-half text-primary opacity-25" style="font-size: 4rem;"></i>
                                    <i class="bi bi-slash-circle text-danger position-absolute bottom-0 end-0"
                                        style="font-size: 1.5rem;"></i>
                                </div>
                            </div>

                            <h5 class="text-dark fw-bold">Data currently unavailable</h5>
                            <p class="text-muted small mb-0">Try searching with a broader keyword or check back later
                                for updates.</p>

                            <div class="mt-4 d-flex justify-content-center gap-2">
                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2 fw-normal">Check
                                    HSN Code</span>
                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2 fw-normal">Verify
                                    Country</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>


            <style>
                :root {
                    --primary: #2c3e50;
                    --secondary: #34495e;
                    --accent: #3498db;
                    --light-bg: #f8f9fa;
                    --text-dark: #2c3e50;
                    --text-light: #7f8c8d;
                    --success: #27ae60;
                    --warning: #f39c12;
                    --card-shadow: 0 8px 20px rgba(44, 62, 80, 0.1);
                    --card-hover-shadow: 0 12px 30px rgba(44, 62, 80, 0.15);
                }

                body {
                    background-color: #f5f7f9;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                .shipment-card {
                    border: none;
                    transition: all 0.3s ease;
                    overflow: hidden;
                    background: linear-gradient(to bottom, #ffffff, #f8f9fa);
                }

                .shipment-card:hover {
                    transform: translateY(-5px);
                    box-shadow: var(--card-hover-shadow);
                }

                .card-header-custom {
                    background: linear-gradient(135deg, var(--primary), var(--secondary));
                    border-bottom: none;
                    position: relative;
                    padding: 1.2rem 1rem;
                }

                .card-header-custom::after {
                    content: '';
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    height: 3px;
                    background: linear-gradient(90deg, var(--accent), #1abc9c);
                }

                .iteration-badge {
                    background: rgba(0, 0, 0, 0.3);
                    backdrop-filter: blur(4px);
                    font-weight: 600;
                    z-index: 1;
                }

                .info-item {
                    padding: 0.6rem;
                    border-radius: 8px;
                    margin-bottom: 0.5rem;
                    transition: background-color 0.2s;
                }

                .info-item:hover {
                    background-color: rgba(52, 152, 219, 0.05);
                }

                .icon-wrapper {
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    background: rgba(52, 152, 219, 0.1);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                }

                .icon-wrapper i {
                    color: var(--accent);
                }

                .detail-label {
                    font-size: 0.75rem;
                    font-weight: 600;
                    color: var(--text-light);
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .detail-value {
                    font-size: 0.9rem;
                    color: var(--text-dark);
                    font-weight: 500;
                }

                .view-details-btn {
                    background: linear-gradient(to right, var(--primary), var(--secondary));
                    border: none;
                    border-radius: 6px;
                    font-weight: 600;
                    transition: all 0.3s;
                }

                .view-details-btn:hover {
                    background: linear-gradient(to right, var(--secondary), var(--primary));
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .empty-icon {
                    color: #bdc3c7;
                }

                .flag-img {
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    border: 1px solid #eee;
                }

                .shipment-item {
                    animation: fadeIn 0.5s ease-in-out;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .highlight-bg {
                    background-color: rgba(236, 240, 241, 0.5);
                    border-radius: 8px;
                }
            </style>


        </div>
    </div>

    <livewire:seller.layout.footer />
</div>
