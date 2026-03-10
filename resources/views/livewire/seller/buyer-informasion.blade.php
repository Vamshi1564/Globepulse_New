<div>
    <div>
        <livewire:seller.layout.header />

        <style>
            .custom-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .custom-table thead {
                background-color: #f0f4f9;
                font-weight: 600;
            }

            .custom-table th,
            .custom-table td {
                padding: 12px;
                text-align: center;
                vertical-align: middle;
                border: 1px solid #dee2e6;
            }

            .custom-table tbody tr:nth-child(even) {
                background-color: #f9fbfd;
            }

            .status-active {
                background-color: #28a745;
                color: white;
                padding: 3px 10px;
                font-weight: 600;
            }

            .status-panding {
                background-color: #dc3545;
                color: white;
                padding: 3px 10px;
                font-weight: 600;
            }

            .action-links a {
                text-decoration: none;
                margin: 0 5px;
                color: #007bff;
            }

            @media (max-width: 768px) {
                .custom-table thead {
                    display: none;
                }

                .custom-table,
                .custom-table tbody,
                .custom-table tr,
                .custom-table td {
                    display: block;
                    width: 100%;
                }

                .custom-table td {
                    text-align: right;
                    padding-left: 50%;
                    position: relative;
                }

                .custom-table td::before {
                    content: attr(data-label);
                    position: absolute;
                    left: 10px;
                    width: 45%;
                    padding-left: 10px;
                    font-weight: bold;
                    text-align: left;
                    color: #333;
                }
            }
        </style>

        <div class="content">
            <nav class="" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item "><a href="{{ route('suppliersand-importers') }}">Suppliers and
                            Importers</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Buyer information</li>
                </ol>
            </nav>
            <div class="container my-4">
                <!-- Search Form -->
                <div class="mb-4">
                    <form wire:submit.prevent="runSearch" class="d-flex flex-row align-items-stretch gap-2"
                        style="max-width: 400px;">
                        <input type="text" wire:model.defer="search" class="form-control"
                            placeholder="Search by Buyer, Contact or Product..." />
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Header Section -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 py-3 border-bottom">
                    <h3 class="mb-2 mb-md-0 fw-bold text-primary">
                        Buyer Information
                    </h3>
                    <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1" id="openPopupBtn">
                        <i class="fas fa-plus"></i> Add Detail
                    </button>
                </div>
            </div>

            <div class=" mt-5">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center fs-9">
                                <th>S.No</th>
                                <th>Date</th>
                                <th>Buyer Name</th>
                                <th>Contact Number</th>
                                <th>Buyer Address</th>
                                <th>Product Name</th>
                                <th>Sale Rate</th>
                                <th>Quantity</th>
                                <th>Total Sale</th>
                                <th>Payment Done Date</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            @forelse ($buyers as $item)
                                <tr class="text-center fs-9">
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d/m/Y') : '-' }}
                                    </td>

                                    <td>{{ $item->buyer_name ?? '-' }}</td>
                                    <td>{{ $item->contact_number ?? '-' }}</td>
                                    <td>{{ $item->buyer_address ?? '-' }}</td>
                                    <td>{{ $item->product_name ?? '-' }}</td>
                                    <td>{{ $item->sale_rate ?? '-' }}</td>
                                    <td>{{ $item->quantity ?? '-' }}</td>
                                    <td>{{ $item->total_sale ?? '-' }}</td>

                                    <td>
                                        {{ $item->payment_done_date ? \Carbon\Carbon::parse($item->payment_done_date)->format('d/m/Y') : '-' }}
                                    </td>

                                    {{-- <td class="text-center">
                                        @switch($item->status)
                                            @case(2)
                                                <span class="badge bg-success">Verified</span>
                                            @break

                                            @case(0)
                                                <span class="badge bg-danger">Rejected</span>
                                            @break

                                            @default
                                                <span class="badge bg-warning text-dark">Pending</span>
                                        @endswitch
                                    </td> --}}
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">No buyer records found.</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>

                        <div class="mt-3 text-center">
                            <button wire:click="prevBuyerPage" class="btn btn-sm btn-outline-primary"
                                {{ $buyerPage == 1 ? 'disabled' : '' }}>Previous</button>
                            <span class="mx-2">Page {{ $buyerPage }} of {{ $totalPages }}</span>
                            <button wire:click="nextBuyerPage" class="btn btn-sm btn-outline-primary"
                                {{ $buyerPage >= $totalPages ? 'disabled' : '' }}>Next</button>
                        </div>
                    </div>
                </div>

                <style>
                    /* Popup overlay styles */
                    .popup-overlay {
                        display: none;
                        position: fixed;
                        z-index: 1050;
                        top: 0;
                        left: 0;
                        height: 100%;
                        width: 100%;
                        background: rgba(0, 0, 0, 0.5);
                    }

                    .popup-form {
                        background: #fff;
                        padding: 30px;
                        max-width: 800px;
                        margin: 100px auto;
                        border-radius: 10px;
                        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
                        position: relative;
                    }

                    /* Optional fade animation */
                    .popup-overlay.show {
                        display: block;
                        animation: fadeIn 0.3s ease-in-out;
                    }

                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                        }

                        to {
                            opacity: 1;
                        }
                    }
                </style>



                <!-- Popup Form -->
                <div class="popup-overlay" id="popupForm">
                    <div class="popup-form">
                        <form id="detailForm" wire:submit.prevent="save">
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-8 text-center">
                                    <h3 class="fw-bold text-primary">Add Buyer Detail</h3>
                                    <hr class="mx-auto my-3" style="width: 100px; border-top: 2px solid #0d6efd;">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" wire:model="date">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Buyer Name</label>
                                    <input type="text" class="form-control" wire:model="buyer_name"
                                        placeholder="Enter Buyer Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" wire:model="contact_number"
                                        placeholder="Enter Contact Number">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Buyer Address</label>
                                    <input type="text" class="form-control" wire:model="buyer_address"
                                        placeholder="Enter Buyer Address">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" wire:model="product_name"
                                        placeholder="Enter Product Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sale Rate</label>
                                    <input type="number" class="form-control" wire:model="sale_rate"
                                        placeholder="Enter Sale Rate">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" wire:model="quantity"
                                        placeholder="Enter Quantity">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Total Sale</label>
                                    <input type="number" class="form-control" wire:model="total_sale"
                                        placeholder="Enter Total Sale">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Done Date</label>
                                    <input type="date" class="form-control" wire:model="payment_done_date">
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button class="btn btn-primary px-5 py-2 fw-semibold" type="submit">
                                    <i class="fas fa-save me-2"></i>Submit
                                </button>
                                <button type="button" class="btn btn-secondary" id="closePopupBtn">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- JS -->
                <script>
                    const popup = document.getElementById('popupForm');
                    const openBtn = document.getElementById('openPopupBtn');
                    const closeBtn = document.getElementById('closePopupBtn');

                    openBtn.addEventListener('click', () => {
                        popup.classList.add('show');
                    });

                    closeBtn.addEventListener('click', () => {
                        popup.classList.remove('show');
                    });

                    // Close popup if clicking outside the form
                    window.addEventListener('click', (e) => {
                        if (e.target === popup) {
                            popup.classList.remove('show');
                        }
                    });
                </script>
            </div>

            <livewire:seller.layout.footer />

        </div>
    </div>
