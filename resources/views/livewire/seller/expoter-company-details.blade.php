<div>
    <livewire:seller.layout.header />

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f72585;
            --dark-color: #212529;
            --light-color: #f8f9fa;
        }

        body {
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            background-color: #f5f7fa;
        }

        .company-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2.5rem 0;
            box-shadow: 0 4px 20px rgba(67, 97, 238, 0.15);
            position: relative;
            overflow: hidden;
        }

        .company-header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .company-header::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card .icon {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .trade-card {
            background: white;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .trade-card:hover {
            transform: translateY(-3px);
        }

        .trade-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            padding: 1rem 1.5rem;
            color: white;
        }

        .trade-body {
            padding: 1.5rem;
        }

        .badge-custom {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .value-highlight {
            color: var(--primary-color);
            font-weight: bold;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(67, 97, 238, 0.03);
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            border-radius: 8px 8px 0 0;
            margin-right: 0.5rem;
        }

        .nav-tabs .nav-link.active {
            background: white;
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.03);
        }

        .nav-tabs .nav-link:hover:not(.active) {
            color: var(--primary-color);
            background: rgba(67, 97, 238, 0.05);
        }

        .export-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary-color);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0.2rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background: var(--primary-color);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        .timeline-date {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .search-box {
            position: relative;
        }

        .search-box .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .search-box input {
            padding-left: 2.5rem;
        }

        .country-flag {
            width: 24px;
            height: 16px;
            border-radius: 2px;
            margin-right: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .quick-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .quick-stat-item {
            text-align: center;
            padding: 0.5rem;
            flex: 1;
        }

        .quick-stat-item .value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .quick-stat-item .label {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .activity-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .activity-badge.shipment {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }

        .activity-badge.payment {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .activity-badge.alert {
            background-color: rgba(248, 150, 30, 0.1);
            color: var(--warning-color);
        }

        .sidebar-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .sidebar-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
            display: flex;
            align-items: center;
        }

        .sidebar-title i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contact-item i {
            width: 2rem;
            height: 2rem;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .document-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .document-item:last-child {
            border-bottom: none;
        }

        .document-item i {
            color: var(--primary-color);
            margin-right: 0.75rem;
        }

        .document-name {
            flex: 1;
        }

        .document-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .recent-activity-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .recent-activity-item:last-child {
            border-bottom: none;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .activity-description {
            font-size: 0.9rem;
        }

        .map-container {
            height: 200px;
            background: #eee;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .map-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
            color: white;
            padding: 1rem;
        }

        .map-overlay h6 {
            margin-bottom: 0;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 1rem;
        }

        @media (max-width: 768px) {
            .company-header {
                padding: 1.5rem 0;
            }

            .company-header h1 {
                font-size: 1.5rem;
            }

            .nav-tabs .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>

    {{-- //for buyer style --}}
    <style>
        /* Enhanced Shipment Cards Styling */
        .shipment-card {
            transition: all 0.3s ease;
            border-radius: 16px;
        }

        .shipment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .avatar-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .flag-container {
            position: relative;
        }

        .country-flag {
            width: 45px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid #fff;
        }

        /* .stat-card {
            transition: all 0.2s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            background-color: #f8f9ff !important;
            border-color: #667eea;
        } */

        .stat-icon i {
            font-size: 1.25rem;
        }

        .stat-number {
            color: #2d3748;
        }

        .value-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .status-badge .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .country-name {
            color: #2d3748;
            font-size: 1rem;
        }

        .country-address {
            line-height: 1.4;
        }

        .value-section .value-card {
            min-height: 80px;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .card-header {
            border-top-left-radius: 16px !important;
            border-top-right-radius: 16px !important;
            padding: 1.25rem 1.5rem 2rem;
        }

        .card-footer {
            border-bottom-left-radius: 16px !important;
            border-bottom-right-radius: 16px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stats-grid .col-6 {
                margin-bottom: 0.5rem;
            }

            .stat-card {
                padding: 0.75rem !important;
            }

            .avatar-circle {
                width: 40px;
                height: 40px;
            }

            .country-flag {
                width: 35px;
                height: 25px;
            }
        }

        /* Loading skeleton animation */
        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }

            100% {
                background-position: 468px 0;
            }
        }

        .text-white-50 {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .bg-opacity-20 {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        .border-opacity-30 {
            border-color: rgba(34, 197, 94, 0.3) !important;
        }
    </style>

    <!-- Company Header -->
    <div class="company-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <div
                                style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-building fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h1 class="mb-1 text-white">{{ $exporter->exporter_name }}</h1>
                            <div class="d-flex flex-wrap align-items-center">
                                <p class="mb-0 me-3"><i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $exporter->exporter_address }}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-flex justify-content-md-end">
                        {{-- <button class="btn btn-light me-2">
                            <i class="fas fa-share-alt me-1"></i> Share
                        </button>
                        <button class="export-btn">
                            <i class="fas fa-download me-1"></i> Export Data
                        </button> --}}
                        <span class="badge bg-white text-primary fs-8 me-2">Verified <i
                                class="bi bi-patch-check-fill ms-1"></i></span>
                        <span class="badge bg-white text-primary fs-8">Active <i class="fas fa-bolt ms-1"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-4">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card bg-white p-3 rounded-3 shadow-sm ">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex flex-column">
                                    <div class="icon bg-primary bg-opacity-10 p-2 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-ship text-primary fs-6"></i>
                                    </div>
                                    <p class="mb-0 mt-2 text-muted fs-9 fw-bold">Total Shipments</p>
                                </div>
                                <h3 class="text-primary mb-0">{{ $shipmentCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-white p-3 rounded-3 shadow-sm ">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex flex-column">
                                    <div class="icon bg-success bg-opacity-10 p-2 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-currency-rupee text-success fs-6"></i>
                                    </div>
                                    <p class="mb-0 mt-2 text-muted fs-9 fw-bold">Total Value</p>
                                </div>
                                <h3 class="text-success mb-0">{{ $totalFobValueFormatted }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-white p-3 rounded-3 shadow-sm ">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex flex-column">
                                    <div class="icon bg-warning bg-opacity-10 p-2 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-globe-americas text-warning fs-6"></i>
                                    </div>
                                    <p class="mb-0 mt-2 text-muted fs-9 fw-bold">Countries</p>
                                </div>
                                <h3 class="text-warning mb-0">{{ $countryCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-white p-3 rounded-3 shadow-sm ">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex flex-column">
                                    <div class="icon bg-info bg-opacity-10 p-2 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-boxes text-info fs-6"></i>
                                    </div>
                                    <p class="mb-0 mt-2 text-muted fs-9 fw-bold">Products</p>
                                </div>
                                <h3 class="text-info mb-0">{{ $productCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->

                <div x-data="{ tab: '{{ request('tab', 'overview') }}' }" x-init="$watch('tab', value => {
                    const url = new URL(window.location.href);
                    url.searchParams.set('tab', value);
                    history.replaceState(null, '', url);
                })">

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': tab === 'overview' }" href="#"
                                @click.prevent="tab = 'overview'">
                                <i class="fas fa-chart-pie me-1"></i> Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': tab === 'shipments' }" href="#"
                                @click.prevent="tab = 'shipments'">
                                <i class="fas fa-ship me-1"></i> Shipments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': tab === 'products' }" href="#"
                                @click.prevent="tab = 'products'">
                                <i class="fas fa-box me-1"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': tab === 'buyers' }" href="#"
                                @click.prevent="tab = 'buyers'">
                                <i class="fas fa-users me-1"></i> Buyers
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': tab === 'documents' }" href="#"
                                @click.prevent="tab = 'documents'">
                                <i class="fas fa-file-alt me-1"></i> Documents
                            </a>
                        </li> --}}
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-4" id="myTabContent">
                        <!-- Overview Tab -->
                        {{-- <div class="tab-pane fade show active" id="overview" role="tabpanel"> --}}
                        <div x-show="tab === 'overview'" class="tab-pane fade show active">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="chart-container">
                                        <h5 class="mb-3"><i class="fas fa-globe me-2"></i>Export Destinations</h5>
                                        <canvas id="countriesChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="chart-container">
                                        <h5 class="mb-3"><i class="fas fa-boxes me-2"></i>Top Products</h5>
                                        <canvas id="productsChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="chart-container">
                                        <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Monthly Export Value
                                            (2024-2025)</h5>
                                        <canvas id="monthlyChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="chart-container">
                                        <h5 class="mb-3"><i class="fas fa-exchange-alt me-2"></i>Shipment Mode
                                            Distribution</h5>
                                        <canvas id="shipmentModeChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipments Tab -->
                        {{-- <div class="tab-pane fade" id="shipments" role="tabpanel"> --}}
                        <div x-show="tab === 'shipments'" class="tab-pane fade show active">
                            <div class="filter-section">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">

                                    <h4>
                                        <span class="bg-primary-subtle text-primary p-2 rounded me-2 d-inline-block">
                                            <i class="fas fa-truck"></i>
                                        </span>
                                        Shipment Data
                                    </h4>

                                    <form wire:submit.prevent="applySearch">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <div class="input-group flex-grow-1">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                                <input type="text" class="form-control"
                                                    placeholder="Search shipments..." wire:model.defer="searchInput">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-filter"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="card px-2">
                                <div class="table-responsive scrollbar mx-n1 px-1">
                                    <table class="table fs-9 mb-0 leads-table border-top border-translucent">
                                        <thead>
                                            <tr>
                                                <th class="sort white-space-nowrap text-center align-middle text-uppercase border-end border-translucent"
                                                    scope="col" data-sort="name"
                                                    style="width:8%; min-width:70px;">
                                                    ID
                                                </th>
                                                <th class="sort align-middle ps-4 pe-5 text-uppercase border-end border-translucent"
                                                    scope="col" data-sort="email"
                                                    style="width:20%; min-width:170px;">
                                                    <div class="d-inline-flex flex-center">
                                                        <div
                                                            class="d-flex align-items-center px-1 py-1 bg-success-subtle rounded me-2">
                                                            <span
                                                                class="text-success-dark bi bi-pin-map-fill fs-8"></span>
                                                        </div>
                                                        <span>Port of Discharge</span>
                                                    </div>
                                                </th>
                                                <th class="sort white-space-nowrap align-middle text-uppercase border-end border-translucent"
                                                    scope="col" data-sort="name"
                                                    style="width:20%; min-width:180px;">
                                                    <div class="d-inline-flex flex-center">
                                                        <div
                                                            class="d-flex align-items-center px-1 py-1 bg-info-subtle rounded me-2">
                                                            <span class=" uil uil-users-alt  fs-8"></span>
                                                        </div>
                                                        <span>Importer/Buyer</span>
                                                    </div>
                                                </th>
                                                <th class="sort align-middle ps-2 pe-2 text-uppercase border-end border-translucent"
                                                    scope="col" data-sort="date"
                                                    style="width:15%; min-width:150px;">
                                                    <div class="d-inline-flex flex-center">
                                                        <div
                                                            class="d-flex align-items-center px-1 py-1 bg-success-subtle rounded me-2">
                                                            <span
                                                                class="text-success-dark uil uil-calendar-alt fs-8"></span>
                                                        </div>
                                                        <span>Date</span>
                                                    </div>
                                                </th>
                                                <th class="sort align-middle ps-4 pe-5 text-uppercase border-end border-translucent"
                                                    scope="col" data-sort="contact"
                                                    style="width:15%; min-width: 150px;">
                                                    <div class="d-inline-flex flex-center">
                                                        <div
                                                            class="d-flex align-items-center px-1 py-1 bg-info-subtle rounded me-2">
                                                            <span
                                                                class="text-info-dark bi bi-currency-rupee fs-8"></span>
                                                        </div>
                                                        <span>Value</span>
                                                    </div>
                                                </th>
                                                {{-- <th>Status</th>
                                        <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($shipments as $shipment)
                                                <tr>
                                                    <td class="text-muted ps-4 border-end border-translucent">
                                                        #SH-{{ $loop->iteration }}</td>

                                                    <td
                                                        class="contact align-middle white-space-nowrap ps-4 border-end border-translucent fw-semibold text-body-highlight">
                                                        {{ $shipment->country_of_discharge }}
                                                    </td>

                                                    <td
                                                        class="contact align-middle white-space-nowrap ps-4 border-end border-translucent fw-semibold text-body-highlight">
                                                        {{ $shipment->importer_buyer_name }}</td>

                                                    @php
                                                        $monthNumber = \Carbon\Carbon::parse("1 $shipment->month")
                                                            ->month;
                                                    @endphp

                                                    <td
                                                        class="date align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4 text-body-tertiary border-end border-translucent fs-9 fw-semibold">
                                                        {{ \Carbon\Carbon::createFromDate($shipment->year, $monthNumber, 1)->format('M Y') }}
                                                    </td>


                                                    <td
                                                        class="date align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4 text-body-tertiary  fs-9 fw-semibold">
                                                        <i class="bi bi-currency-rupee"></i>
                                                        {{ number_format($shipment->total_fob_value) }}
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No shipments found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination Controls -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button class="btn btn-sm btn-outline-primary" wire:click="prevPage"
                                        @if ($currentPage == 1) disabled @endif>Previous</button>

                                    <span>Page {{ $currentPage }} of {{ $totalPages }}</span>

                                    <button class="btn btn-sm btn-outline-primary" wire:click="nextPage"
                                        @if ($currentPage == $totalPages) disabled @endif>Next</button>
                                </div>

                            </div>
                        </div>

                        <!-- Products Tab -->
                        {{-- <div class="tab-pane fade" id="products" role="tabpanel"> --}}
                        <div x-show="tab === 'products'" class="tab-pane fade show active">
                            <div class="filter-section">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">

                                    <h4>
                                        <span class="bg-primary-subtle text-primary p-2 rounded me-2 d-inline-block">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        Products
                                    </h4>


                                    <form wire:submit.prevent="applyProductSearch">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <div class="input-group flex-grow-1">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </span>

                                                <!-- 🔗 Bind input to Livewire variable -->
                                                <input type="text" class="form-control"
                                                    placeholder="Search products..." wire:model.defer="productSearch">

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>

                            {{-- <div class="row">
                                @foreach ($shipments as $shipment)
                                    <div class="col-md-6 mb-3">
                                        <div class="trade-card mb-4">
                                            <div class="trade-header">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center">
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 text-white fw-semibold">
                                                            {{ $shipment->product_description }}</h6>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="badge-custom text-center">
                                                            Chapter-{{ $shipment->chapter }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <small class="text-white-50 fw-bold">HS Code:
                                                    {{ $shipment->hsncode }}</small>
                                            </div>
                                            <div class="trade-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80"
                                                        class="product-image" alt="Product Image">
                                                    <div class="ms-3">
                                                        <p class="mb-1"><strong>Quantity:</strong>
                                                            {{ $shipment->quantity }} {{ $shipment->uqc }}</p>
                                                        <p class="mb-1"><strong>Unit Rate:</strong>
                                                            {{ $shipment->unit_rate_currency }}{{ number_format($shipment->unit_rate, 2) }}
                                                        </p>
                                                        <p class="mb-1"><strong>Month:</strong>
                                                            {{ $shipment->month }} {{ $shipment->year }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="mb-0"><strong>Total Value:</strong>
                                                            <span
                                                                class="value-highlight">{{ $shipment->fob_value_currency }}{{ number_format($shipment->total_fob_value, 2) }}</span>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div> --}}

                            <div class="row g-4">
                                @foreach ($shipments as $shipment)
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <!-- Card Header -->
                                            <div
                                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <h6 class="text-white fw-bold mb-2 lh-sm">
                                                        {{ $shipment->product_description }}
                                                    </h6>
                                                    <div class="d-flex align-items-center text-white-50">
                                                        <span
                                                            class="bg-light text-dark p-1 rounded me-2 d-inline-flex align-items-center justify-content-center"
                                                            style="width: 24px; height: 24px;">
                                                            <i class="fas fa-barcode"></i>
                                                        </span>
                                                        <small class="fw-bold">{{ $shipment->hsncode }}</small>
                                                    </div>

                                                </div>
                                                <span
                                                    class="badge bg-white text-primary">Chapter-{{ $shipment->chapter }}</span>
                                            </div>

                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="row g-3">
                                                    <!-- Product Image -->
                                                    <div class="col-md-4">
                                                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80"
                                                            class="img-fluid rounded border" alt="Product Image">
                                                    </div>

                                                    <!-- Product Details -->
                                                    <div class="col-md-8">
                                                        <div class="list-group list-group-flush">
                                                            <div
                                                                class="list-group-item border-0 px-0 py-1 d-flex justify-content-between">
                                                                <span class="text-muted">Quantity:</span>
                                                                <strong>{{ $shipment->quantity }}
                                                                    {{ $shipment->uqc }}</strong>
                                                            </div>
                                                            <div
                                                                class="list-group-item border-0 px-0 py-1 d-flex justify-content-between">
                                                                <span class="text-muted">Unit Rate:</span>
                                                                <strong>{{ $shipment->unit_rate_currency }}{{ number_format($shipment->unit_rate, 2) }}</strong>
                                                            </div>
                                                            <div
                                                                class="list-group-item border-0 px-0 py-1 d-flex justify-content-between">
                                                                <span class="text-muted">Month:</span>
                                                                <strong>{{ $shipment->month }}
                                                                    {{ $shipment->year }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                $value = $shipment->total_fob_value;
                                                $formatted = $value;

                                                if ($value >= 1000000000) {
                                                    $formatted = number_format($value / 1000000000, 2) . 'B';
                                                } elseif ($value >= 1000000) {
                                                    $formatted = number_format($value / 1000000, 2) . 'M';
                                                } elseif ($value >= 1000) {
                                                    $formatted = number_format($value / 1000, 2) . 'K';
                                                } else {
                                                    $formatted = number_format($value, 2);
                                                }
                                            @endphp

                                            <!-- Card Footer -->
                                            <div
                                                class="card-footer bg-light d-flex justify-content-between align-items-center">
                                                <div class="text-muted d-block">Total Value :</div>
                                                <h5 class="mb-0 text-success">
                                                    {{-- {{ $shipment->fob_value_currency }}{{ number_format($shipment->total_fob_value, 2) }} --}}
                                                    {{ $shipment->fob_value_currency }}{{ $formatted }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination Controls -->
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-sm btn-outline-primary" wire:click="prevPage"
                                        @if ($currentPage == 1) disabled @endif>Previous</button>

                                    <span>Page {{ $currentPage }} of {{ $totalPages }}</span>

                                    <button class="btn btn-sm btn-outline-primary" wire:click="nextPage"
                                        @if ($currentPage == $totalPages) disabled @endif>Next</button>
                                </div>
                            </div>
                        </div>

                        <!-- Buyers Tab -->
                        {{-- <div class="tab-pane fade" id="buyers" role="tabpanel"> --}}
                        <div x-show="tab === 'buyers'" class="tab-pane fade show active">
                            <div class="filter-section">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">

                                    <h4>
                                        <span class="bg-primary-subtle text-primary p-2 rounded me-2 d-inline-block">
                                            <i class="fas fa-handshake"></i>
                                        </span>
                                        Buyers
                                    </h4>


                                    <form wire:submit.prevent="applyBuyerSearch">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <div class="input-group flex-grow-1">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </span>

                                                <!-- 🔗 Bind input to Livewire variable -->
                                                <input type="text" class="form-control"
                                                    placeholder="Search by terms..." wire:model.defer="buyerSearch">

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- //group by show data  --}}
                            <div class="row">

                                @foreach ($shipments as $shipment)
                                    <div class="col-lg-6 col-xl-4 mb-4">
                                        <div class="card shipment-card h-100 shadow-sm border-0">
                                            <!-- Card Header with Gradient -->
                                            <div class="card-header border-0 position-relative overflow-hidden"
                                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                <div
                                                    class="d-flex justify-content-between align-items-center position-relative">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="avatar-circle bg-white bg-opacity-20 backdrop-blur me-3">
                                                            <i class="fas fa-building text-white"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-white fw-semibold">
                                                                {{ Str::limit($shipment->importer_buyer_name ?? 'N/A', 25) }}
                                                            </h6>
                                                            <small class="text-white-50">Importer</small>
                                                        </div>
                                                    </div>
                                                    <div class="status-badge">
                                                        <span
                                                            class="badge bg-success-subtle bg-opacity-25 text-success border border-success border-opacity-30 fs-10 fw-bold">
                                                            <i class="fas fa-circle me-1"
                                                                style="font-size: 6px;"></i>Active
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- Decorative Wave -->
                                                <div class="position-absolute bottom-0 start-0 w-100"
                                                    style="height: 20px; overflow: hidden;">
                                                    <svg viewBox="0 0 1200 120" preserveAspectRatio="none"
                                                        style="height: 100%; width: 100%;">
                                                        <path d="M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z"
                                                            fill="white"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Card Body -->
                                            <div class="card-body p-4">
                                                <!-- Country Section -->
                                                <div class="country-section mb-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flag-container me-3">
                                                            <img src="https://flagcdn.com/w80/{{ strtolower(substr($shipment->country_of_discharge, 0, 2)) }}.png"
                                                                class="img-thumbnail  border-2 border-white country-flag shadow-sm">
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="country-name mb-1 fw-semibold text-dark">
                                                                {{ $shipment->country_of_discharge ?? 'Unknown Country' }}
                                                            </h6>
                                                            <p class="country-address mb-0 text-muted small">
                                                                <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                                                {{ Str::limit($shipment->importer_buyer_address ?? 'Address not available', 35) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Stats Grid -->
                                                <div class="stats-grid mb-4">
                                                    <div class="row g-3">
                                                        <!-- Shipments Count -->
                                                        <div class="col-6">
                                                            <div
                                                                class="stat-card bg-light rounded-3 cursor-default p-3 text-center">
                                                                <div class="stat-icon mb-2">
                                                                    <i class="fas fa-ship text-primary"></i>
                                                                </div>
                                                                <div class="stat-number h5 mb-1 fw-bold text-dark">
                                                                    {{ number_format($shipment->shipments_count) }}
                                                                </div>
                                                                <div class="stat-label small text-muted">
                                                                    Shipments
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Last Shipment -->
                                                        <div class="col-6">
                                                            <div
                                                                class="stat-card bg-light rounded-3 cursor-default p-3 text-center">
                                                                <div class="stat-icon mb-2">
                                                                    <i class="fas fa-calendar-alt text-warning"></i>
                                                                </div>
                                                                <div class="stat-number h6 mb-1 fw-bold text-dark">
                                                                    {{ \Carbon\Carbon::parse($shipment->month)->format('M') }}
                                                                    {{ $shipment->year }}
                                                                </div>
                                                                <div class="stat-label small text-muted">
                                                                    Last Shipment
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Total Value Section -->
                                                <div class="value-section">
                                                    <div
                                                        class="value-card bg-gradient-primary rounded-3 p-3 text-white position-relative overflow-hidden">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center position-relative">
                                                            <div>
                                                                <div class="value-label small text-white-50 mb-1">
                                                                    <i class="fas fa-rupee-sign me-1"></i>Total FOB
                                                                    Value
                                                                </div>
                                                                <div
                                                                    class="value-amount text-success-subtle h4 mb-0 fw-bold">
                                                                    @php
                                                                        $value = $shipment->total_fob_value;
                                                                        $formatted = $value;

                                                                        if ($value >= 1000000000) {
                                                                            $formatted =
                                                                                number_format($value / 1000000000, 2) .
                                                                                'B';
                                                                        } elseif ($value >= 1000000) {
                                                                            $formatted =
                                                                                number_format($value / 1000000, 2) .
                                                                                'M';
                                                                        } elseif ($value >= 1000) {
                                                                            $formatted =
                                                                                number_format($value / 1000, 2) . 'K';
                                                                        } else {
                                                                            $formatted = number_format($value, 2);
                                                                        }
                                                                    @endphp

                                                                    ₹
                                                                    {{-- {{ number_format($shipment->total_fob_value, 2) }} --}}
                                                                    {{ $formatted }}
                                                                </div>
                                                            </div>
                                                            <div class="value-icon">
                                                                <i class="fas fa-chart-line fa-2x text-white-50"></i>
                                                            </div>
                                                        </div>
                                                        <!-- Background Pattern -->
                                                        <div class="position-absolute top-0 end-0 opacity-10">
                                                            <i class="fas fa-coins" style="font-size: 4rem;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card Footer -->
                                            {{-- <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-4">
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-outline-primary btn-sm flex-fill"
                                                        type="button">
                                                        <i class="fas fa-eye me-2"></i>View Details
                                                    </button>
                                                    <button class="btn btn-primary btn-sm flex-fill" type="button">
                                                        <i class="fas fa-download me-2"></i>Export
                                                    </button>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <!-- Pagination Controls -->
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-sm btn-outline-primary" wire:click="prevPage"
                                        @if ($currentPage == 1) disabled @endif>Previous</button>

                                    <span>Page {{ $currentPage }} of {{ $totalPages }}</span>

                                    <button class="btn btn-sm btn-outline-primary" wire:click="nextPage"
                                        @if ($currentPage == $totalPages) disabled @endif>Next</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-3">

                <div class="sidebar-card">
                    <h5 class="sidebar-title"><i class="fas fa-map-marker-alt me-2"></i>Location</h5>
                    <div class="map-container">
                        <div class="map-overlay">
                            <h6>Melbourne, Australia</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        // Countries Chart

        const exporterName = @json($exporter->exporter_name);
        const GLOB_URL = "{{ config('api.glob_url') }}";

        console.log("GLOB_URL: ", "{{ config('api.glob_url') }}");


        async function loadCountriesChart(exporterName) {
            try {
                const encodedExporter = encodeURIComponent(exporterName);
                const response = await fetch(`${GLOB_URL}getShipmentDataCount/${encodedExporter}`);
                const result = await response.json();

                if (!result.success) {
                    console.error('Error loading data:', result.message);
                    return;
                }

                const labels = result.country_data.map(item => item.country_of_discharge);
                const percentages = result.country_data.map(item => item.percentage);

                // const backgroundColors = [
                //     '#4361ee', '#4cc9f0', '#f72585', '#b5179e', '#7209b7',
                //     '#3a0ca3', '#4361ee', '#4895ef', '#4cc9f0', '#bde0fe'
                // ];
                const backgroundColors = [
                    '#4361ee', '#4cc9f0', '#f72585', '#b5179e', '#7209b7',
                    '#3a0ca3', '#4895ef', '#bde0fe', '#ffbe0b', '#fb5607',
                    '#ff006e', '#8338ec', '#3a86ff', '#06d6a0', '#ef476f',
                    '#ffd166', '#118ab2', '#073b4c', '#8ecae6', '#219ebc',
                    '#023047', '#ffb703', '#fb8500', '#9b5de5', '#f15bb5',
                    '#fee440', '#00bbf9', '#00f5d4', '#aacc00', '#ffa69e',
                    '#ff7e6b', '#70d6ff', '#ff70a6', '#caffbf', '#9bf6ff'
                ];


                const ctx = document.getElementById('countriesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: percentages,
                            backgroundColor: backgroundColors.slice(0, labels.length),
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                }
                            }
                        },
                        cutout: '70%'
                    }
                });

            } catch (error) {
                console.error('Failed to load countries chart:', error);
            }
        }

        // Call function with dynamic exporter name
        loadCountriesChart(exporterName);

        async function loadProductsChart(exporterName) {
            try {
                const encodedExporter = encodeURIComponent(exporterName);
                const response = await fetch(`${GLOB_URL}getTopProducts/${encodedExporter}`);
                const result = await response.json();

                if (!result.Data || result.Data.length === 0) {
                    console.error('No product data found.');
                    return;
                }

                // Raw values and trimmed labels
                const fullLabels = result.Data.map(item => item.product_description);
                const labels = fullLabels.map(label =>
                    label.length > 25 ? label.slice(0, 25) + '...' : label
                );
                const values = result.Data.map(item => item.total_value);

                const productsCtx = document.getElementById('productsChart').getContext('2d');
                new Chart(productsCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Export Value (USD)',
                            data: values,
                            backgroundColor: '#4361ee',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    title: function(context) {
                                        const index = context[0].dataIndex;
                                        return fullLabels[index];
                                    },
                                    label: function(context) {
                                        return '$' + formatNumber(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + formatNumber(value);
                                    }
                                }
                            },
                            x: {
                                ticks: {
                                    display: false
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

            } catch (error) {
                console.error('Error loading products chart:', error);
            }
        }

        // Call the function with exporter name
        // const exporterName = @json($exporter->exporter_name);
        loadProductsChart(exporterName);


        function formatNumber(value) {
            if (value >= 1_000_000_000) return (value / 1_000_000_000).toFixed(2) + 'B';
            if (value >= 1_000_000) return (value / 1_000_000).toFixed(2) + 'M';
            if (value >= 1_000) return (value / 1_000).toFixed(0) + 'K';
            return value;
        }

        // Monthly Chart

        async function loadMonthlyExportChart(exporterName) {
            const apiUrl = `${GLOB_URL}getMonthlyExportValue/${encodeURIComponent(exporterName)}`;

            try {
                const response = await fetch(apiUrl);
                const result = await response.json();

                if (!result.success) {
                    console.error("API Error:", result.message);
                    return;
                }

                const data = result.data;

                // Month labels used in the chart
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];

                // Map full lowercase month name to short format
                const monthMap = {
                    jan: 'Jan',
                    january: 'Jan',
                    feb: 'Feb',
                    february: 'Feb',
                    mar: 'Mar',
                    march: 'Mar',
                    apr: 'Apr',
                    april: 'Apr',
                    may: 'May',
                    jun: 'Jun',
                    june: 'Jun',
                    jul: 'Jul',
                    july: 'Jul',
                    aug: 'Aug',
                    august: 'Aug',
                    sep: 'Sep',
                    sept: 'Sep',
                    september: 'Sep',
                    oct: 'Oct',
                    october: 'Oct',
                    nov: 'Nov',
                    november: 'Nov',
                    dec: 'Dec',
                    december: 'Dec'
                };


                // Organize data by year
                const yearData = {};

                data.forEach(item => {
                    const year = item.year;
                    const rawMonth = item.month.trim().toLowerCase(); // normalize input
                    const month = monthMap[rawMonth]; // map to short month

                    if (!month) return; // skip invalid or unrecognized months

                    const value = parseFloat(item.total_value);

                    if (!yearData[year]) {
                        yearData[year] = {};
                    }

                    yearData[year][month] = value;
                });

                // Dataset colors
                const colors = [{
                        border: '#4361ee',
                        background: 'rgba(67, 97, 238, 0.1)'
                    },
                    {
                        border: '#4cc9f0',
                        background: 'rgba(76, 201, 240, 0.1)'
                    },
                    {
                        border: '#f72585',
                        background: 'rgba(247, 37, 133, 0.1)'
                    }
                ];

                // Generate datasets for Chart.js
                const datasets = Object.keys(yearData).map((year, index) => {
                    const monthValues = months.map(m => yearData[year][m] ?? null);
                    return {
                        label: year,
                        data: monthValues,
                        borderColor: colors[index % colors.length].border,
                        backgroundColor: colors[index % colors.length].background,
                        pointBackgroundColor: colors[index % colors.length].border,
                        fill: true,
                        tension: 0.4,
                        spanGaps: true,
                        borderDash: [5, 5],
                        borderWidth: 2
                    };
                });

                // Destroy previous chart if exists
                if (window.monthlyChartInstance) {
                    window.monthlyChartInstance.destroy();
                }

                const ctx = document.getElementById('monthlyChart').getContext('2d');
                window.monthlyChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const val = context.raw ?? 0;
                                        return `${context.dataset.label}: ₹${val.toLocaleString()}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '₹' + (value / 1000) + 'K';
                                    }
                                },
                                grid: {
                                    color: '#eee'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

            } catch (error) {
                console.error("Chart Load Error:", error);
            }
        }

        // Initial Load
        loadMonthlyExportChart(exporterName);

        // Shipment Mode Chart

        async function loadShipmentModeChart(exporterName) {
            const apiUrl = `${GLOB_URL}getShipmentMode/${encodeURIComponent(exporterName)}`;

            try {
                const response = await fetch(apiUrl);
                const result = await response.json();

                if (!result.success) {
                    console.error("API error:", result.message);
                    return;
                }

                const data = result.data;

                const labels = data.map(item => {
                    // You can convert "Sea" to "Sea Freight", etc. here
                    if (item.mode_shipment === 'Sea') return 'Sea Freight';
                    else if (item.mode_shipment === 'Air') return 'Air Freight';
                    else return item.mode_shipment;
                });

                const percentages = data.map(item => item.percentage);

                const colors = ['#4361ee', '#4cc9f0', '#f72585', '#b5179e', '#7209b7']; // Extend if needed

                // Destroy previous chart if exists
                if (window.shipmentModeChartInstance) {
                    window.shipmentModeChartInstance.destroy();
                }

                const ctx = document.getElementById('shipmentModeChart').getContext('2d');
                window.shipmentModeChartInstance = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: percentages,
                            backgroundColor: colors.slice(0, labels.length),
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                }
                            }
                        }
                    }
                });

            } catch (error) {
                console.error("Chart Load Error:", error);
            }
        }

        // Call the chart with exporter name
        loadShipmentModeChart(exporterName);
    </script>

    <livewire:seller.layout.footer />

</div>
