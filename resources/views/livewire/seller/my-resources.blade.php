<div>
    <livewire:seller.layout.header />

    <style>
        .card {
            border: 1px solid #e3e6ed;
            /* Light subtle border */
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            transition: all 0.4s ease-in-out;
            background: #fff;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            border-color: #c7d0e1;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body .d-flex {
            gap: 1rem;
            align-items: center;
        }

        .card-body img {
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
            padding: 10px;
            border-radius: 0.75rem;
            background-color: #f1f3f5;
            transition: transform 0.4s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* .card-body img:hover {
                transform: scale(1.1);
                box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
            } */

        .card-body a {
            font-size: 1.05rem;
            font-weight: 600;
            color: #34495e;
            text-decoration: none;
            transition: color 0.3s ease;
            display: inline-block;
        }

        .card-body a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }

        h1.text-body-emphasis {
            font-size: 2rem;
            font-weight: 700;
            color: #1c1e21;
            margin-bottom: 1rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            font-weight: 500;
        }

        .breadcrumb-item a {
            color: #0d6efd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: #084298;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        @media(max-width : 576px) {
            .card-body img {
                width: 70px;
                height: 70px;
                object-fit: contain;
                padding: 10px;
                border-radius: 0.75rem;
                background-color: #f1f3f5;
                transition: transform 0.4s ease-in-out, box-shadow 0.3s ease-in-out;
            }
        }
    </style>


    <div class="content">
        <nav class="mb-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item fw-bold fs-sm"><a href="{{ route('seller') }}">My Dashboard</a></li>
                <li class="breadcrumb-item active fs-sm text-dark fw-bold" aria-current="page">My Resources</li>
            </ol>
        </nav>
        <div class="row gy-3 mb-4 justify-content-between">
            <div class="col-xxl-6">
                <div class="d-flex align-items-center gap-2 mb-5">

                    <h2 class="mb-0 fw-bolder">My Resources</h2>
                </div>

                <div class="row g-3 mb-5 pb-4">

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/reference-data.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('reference-materials', ['procatId' => $procatId1->id]) }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Reference Material</span></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <!-- <div class="d-flex align-items-center icon-wrapper-sm shadow-info-100"
                                                    style="transform: rotate(-7.45deg);"><span
                                                        class="fa-solid fa-arrow-circle-down text-info fs-7 z-1 ms-2"></span>
                                                </div> -->
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/prod-report.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('product-reports', ['procatId' => $procatId2->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Product Reports </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent mb-sm-4">
                                        <div class="d-flex align-items-center mb-2 gap-2">
                                            <div class="d-flex align-items-center icon-wrapper-sm shadow-info-100"
                                                style="transform: rotate(-7.45deg);"><span
                                                    class="fa-solid fas fa-question-circle text-info fs-7 z-1 ms-2"></span>
                                            </div>
                                        </div>
                                        <a href="#!" class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                class="fs-8 text-body lh-lg">Tools - Links </span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/tradedoc.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('create-trade', ['procatId' => $procatId3->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Create Trade Docs</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/checklistdash.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('shipment-list', ['procatId' => $procatId4->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Shipment Checklist</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/actionplandash.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('action-plan', ['procatId' => $procatId5->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Action Plan </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent mb-sm-4">
                                        <div class="d-flex align-items-center mb-2 gap-2">
                                            <div class="d-flex align-items-center icon-wrapper-sm shadow-info-100"
                                                style="transform: rotate(-7.45deg);"><span
                                                    class="fa-solid fa-sheet-plastic text-info fs-7 z-1 ms-2"></span>
                                            </div>
                                        </div>
                                        <a href="#!" class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                class="fs-8 text-body lh-lg">Business Audit Report
                                            </span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/templatedash.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('templates', ['procatId' => $procatId6->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Email Templates </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/contacts.png" alt="dashboard icon">

                                            <a href="{{ route('embassy-contacts-show') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Embassy Contacts</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/network.png" alt="dashboard icon">

                                            <a href="{{ route('social-media-group-show') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 ">
                                                <p class="fs-8 text-body ">Top Social Media Trade Groups</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/faq.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('faqs-show') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 ">
                                                <p class="fs-8 text-body ">FAQs Model</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent mb-sm-4">
                                        <div class="d-flex align-items-center mb-2 gap-2">
                                            <img class="w-25"
                                                src="../assets/img/seller-dashboard-icons/supply-chain-management.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('suppliersand-importers') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 ">
                                                <p class="fs-8 text-body ">Suppliers & Impoters</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <livewire:seller.layout.footer />

                <div>

                    @if (session()->has('message'))
                        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                            role="alert" id="alert">
                            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </main>
    </div>