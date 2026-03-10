<div>
    <livewire:seller.layout.header />

    <style>
        :root {
            --brand-primary: #0A66C2;
            --brand-dark: #1a1a1a;
            --soft-bg: #f8f9fa;
            --border-color: #e9ecef;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* Hero Section */
        .search-hero {
            background: #fff;
            padding: 2.5rem 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        /* Points Badge */
        .points-badge {
            background: #fff9db;
            color: #856404;
            padding: 8px 16px;
            border-radius: 50px;
            border: 1px solid #ffeeba;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
        }

        /* Modern Search Bar */
        .search-container {
            background: #fff;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-top: -50px;
            /* Overlap effect */
            border: 1px solid var(--border-color);
        }

        .form-select-custom,
        .form-input-custom {
            height: 48px;
            /* border-radius: 8px !important; */
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
        }

        .btn-search-custom {
            height: 48px;
            border-radius: 8px;
            font-weight: 600;
            background: var(--brand-dark);
            transition: all 0.3s ease;
        }

        .btn-search-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Analytics Card */
        .analytics-card {
            background: #fff;
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 1.5rem;
            background: transparent;
            border-bottom: 1px solid var(--border-color);
        }

        /* Table Styling */
        .trade-table thead th {
            background: #fdfdfd;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #6b7280;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .trade-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #374151;
            font-size: 0.95rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .trade-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .flag-img {
            width: 28px;
            height: 20px;
            object-fit: cover;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Progress Bar for Percentages */
        .percentage-track {
            height: 8px;
            background: #f3f4f6;
            border-radius: 10px;
            overflow: hidden;
            width: 100px;
            display: inline-block;
            margin-right: 10px;
        }

        .percentage-fill {
            height: 100%;
            background: var(--brand-primary);
        }

        /* Custom Scrollbar */
        .scrollbar-custom::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-custom::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
    </style>

    <!-- Hero Header -->
    <div class="search-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('seller') }}" class=" text-muted">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Shipments</li>
                        </ol>
                    </nav>
                    <h1 class="h2 fw-bold text-dark mb-1">Global Trade Explorer</h1>
                    <p class="text-muted mb-0">
                        <i class="bi bi-database-check me-1"></i>
                        Analyzing <span class="badge badge-phoenix badge-phoenix-success">
                            {{ number_format($shipmentCount) }} </span> verified shipment records
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="points-badge">
                        <span class="me-2">🪙</span>
                        <span>Points Balance: 100</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Search Bar Section -->
        <div class="search-container mb-5">
            <form wire:submit.prevent="searchHSN" class="row g-3">
                <div class="col-6 col-md-2">
                    <label class="form-label small fw-bold text-muted">Search By</label>
                    <select wire:model="searchBy" class="form-select form-select-custom shadow-sm">
                        <option value="hsncode">HSN Code</option>
                        <option value="product_description">Product Name</option>
                    </select>
                </div>

                <div class="col-12 col-md-5">
                    <label class="form-label small fw-bold text-muted">Search Query</label>
                    <div class="input-group shadow-sm rounded-8">
                        <span class="input-group-text bg-white border-end-0"><i
                                class="bi bi-search text-muted"></i></span>
                        <input type="text" wire:model.defer="search"
                            class="form-control form-input-custom border-start-0 ps-3"
                            placeholder="e.g. 84710223 or Laptop computers...">
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <label class="form-label small fw-bold text-muted">Destination</label>
                    <select wire:model="countryFilter" class="form-select form-select-custom shadow-sm">
                        <option value="All Global Markets">All Global Markets</option>
                        @foreach ($countryStats as $country)
                            <option value="{{ $country->country_of_discharge }}">{{ $country->country_of_discharge }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark btn-search-custom w-100 shadow-sm">
                        Find Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Display Section -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="analytics-card">
                    <div class="card-header-custom d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Market Distribution</h5>
                            <small class="text-muted">Top countries by shipment volume</small>
                        </div>
                        {{-- <button class="btn btn-outline-secondary btn-sm rounded-pill">
                            <i class="bi bi-download me-1"></i> Export
                        </button> --}}
                    </div>

                    <div class="table-responsive scrollbar-custom px-3" style="max-height: 500px;">
                        <table class="table mb-0 trade-table">
                            <thead>
                                <tr>
                                    <th>Global Market</th>
                                    <th class="text-end">Market Share</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countryStats as $country)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($country->flag_img)
                                                    <img src="{{ asset('assets/' . $country->flag_img) }}"
                                                        class="flag-img me-3" alt="">
                                                @else
                                                    <img src="https://flagcdn.com/w40/un.png" class="flag-img me-3"
                                                        alt="">
                                                @endif
                                                <span
                                                    class="fw-semibold text-dark">{{ $country->country_of_discharge }}</span>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="percentage-track d-none d-sm-inline-block">
                                                    <div class="percentage-fill"
                                                        style="width: {{ $country->percentage }}%"></div>
                                                </div>
                                                <span class="fw-bold">{{ $country->percentage }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-3 text-center">
                        <p class="small text-muted mb-0">Showing distribution based on current filters</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:seller.layout.footer />
</div>
