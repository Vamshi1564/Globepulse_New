<div>
    <livewire:seller.layout.header />

    <main class="main" id="top">


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



        <div class="content pt-4">
            <nav class="mb-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item fw-bold fs-sm"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active fs-sm text-dark fw-bold" aria-current="page">My Dashboard</li>
                </ol>
            </nav>
            <!-- Dashboard Header with Background -->
            <!-- Dashboard Section -->
            <div class="dashboard-header p-4 rounded-4 shadow-sm mb-4">
                <div
                    class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">

                    <!-- Dashboard Title with Icon -->
                    <div class="d-flex align-items-center gap-2 text-white">
                        <i class="fas fa-chart-pie fs-5 text-dark"></i>
                        <h2 class="fw-bold mb-0 fs-6">My Dashboard</h2>
                    </div>

                    <!-- Search Box -->
                    <div class="position-relative">
                        <input id="leadCardsSearch" class="form-control search-box w-100 border" type="search"
                            placeholder="Search here..." aria-label="Search">
                        <i class="text-dark fas fa-search position-absolute top-50 end-0 translate-middle-y me-3 "></i>
                    </div>
                </div>
            </div>

            <!-- Custom CSS -->
            <style>
                .dashboard-header {
                    background: linear-gradient(135deg, #ffffff, #ffffff);
                }

                .dashboard-header h2,
                .dashboard-header i {
                    color: #000000;
                }

                .search-box {
                    background: rgba(255, 255, 255, 0.15);
                    border: none;
                    border-radius: 50px;
                    color: #000000;
                    backdrop-filter: blur(8px);
                }

                .search-box::placeholder {
                    color: rgba(0, 0, 0, 0.7);
                }

                .search-box:focus {
                    box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
                    outline: none;
                }
            </style>


            {{-- <div class="col-xxl-6"> --}}
            {{-- <div class="row g-3 my-3">
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/dire-inquiries.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('enquiries') }}"
                                                class=" text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Direct Inquiries</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/Distribution.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('distribution-inquiries') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Distribution
                                                    Inquiries</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/varify-buyer.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('verifybuyers-list') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span class="fs-8
                                                    text-body lh-lg admin-text">Verified
                                                    Buyers</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/Buy-inquiri.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('postreq-list') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Buy Inquiries
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/websiteinquiries.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('website-lead') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Website
                                                    Inquiries</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/realshipment.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('realshipment-data') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Real
                                                    ShipmentData</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/documentation.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('documents') }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Digi
                                                    Locker</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/deliverystatus.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('project') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Delivery
                                                    Status</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/receipt.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('invoice-list') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Receipts</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">

                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/course.png"
                                                alt="dashboard icon">
                                            <a href="https://lms.gfebusiness.org/home/lesson/export-import-training/8"
                                                target="_blank" class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My
                                                    Course</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/LOis.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('lois', ['procatId' => $procatId7->id]) }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My
                                                    Letter of Intents</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/POis.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('pos', ['procatId' => $procatId8->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My
                                                    Purchase Orders </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/ImportantUpdates.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('seller-notification-list') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Important Updates
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/mydeal-1.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('byleads') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Deals
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
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
                                                    class="fs-8 text-body lh-lg admin-text">Reference
                                                    Material</span></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/prod-report.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('product-reports', ['procatId' => $procatId2->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Product Reports
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/tradedoc.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('create-trade', ['procatId' => $procatId3->id]) }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Create
                                                    Trade Docs</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
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
                                                    class="fs-8 text-body lh-lg admin-text">Shipment
                                                    Checklist</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
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
                                                    class="fs-8 text-body lh-lg admin-text">Action
                                                    Plan </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
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
                                                    class="fs-8 text-body lh-lg admin-text">Email
                                                    Templates </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/contacts.png" alt="dashboard icon">

                                            <a href="{{ route('embassy-contacts-show') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Embassy
                                                    Contacts</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/network.png" alt="dashboard icon">

                                            <a href="{{ route('social-media-group-show') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 ">
                                                <span class="fs-8 text-body lh-lg admin-text">
                                                    Top Social Media Trade Groups
                                                </span>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/faq.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('faqs-show') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 ">
                                                <span class="fs-8 text-body lh-lg admin-text">
                                                    FAQs Model
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  ">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/folder.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('suppliersand-importers-informasion') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Suppliers and
                                                    Importers
                                                    information
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center ">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/ExportInformation.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('export-information') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Export
                                                    Information
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/BuyerInformasion.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('buyer-informasion') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Buyer information
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/supplier.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('suppliers-informasion') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Suppliers
                                                    information
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}

            {{-- //----------------------------aready commented-----------------------------------// --}}
            {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <!-- <div class="border-bottom-sm border-translucent mb-sm-4"> -->
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center gap-2">

                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/product.png"
                                                alt="dashboard icon">
                                            <a href="{{ route('my-products') }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Products</span></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
            {{--
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center ">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/My-packages.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('my-package') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Package</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center">

                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/success.png"
                                                alt="dashboard icon">
                                            <!-- <p class="text-body-tertiary fs-9 mb-0 ms-2 mt-3">Outgoing meeting</p> -->

                                            <a href="{{ route('opportunities') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Opportunities</span></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}



            {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center ">

                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/folders.png"
                                                alt="dashboard icon">
                                            <!-- <p class="text-body-tertiary fs-9 mb-0 ms-2 mt-3">Outgoing meeting</p> -->

                                            <a href="{{ route('my-resources') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">My Resources
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            {{--
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center ">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/ExportInformation.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('export-information') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Export Information
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100"
                                                src="../assets/img/seller-dashboard-icons/supply-chain-management.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('suppliersand-importers') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Suppliers & Importers
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            {{-- //----------------------------aready commented-----------------------------------// --}}


            {{-- @if ($PackageId == 3 || $PackageId == 4 || $PackageId == 5)
                        <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex d-sm-block justify-content-between">
                                        <div class="border-translucent ">
                                            <div class="d-flex align-items-center ">

                                                <img class="w-100"
                                                    src="../assets/img/seller-dashboard-icons/technical-support.png"
                                                    alt="dashboard icon">

                                                <a href="{{ route('advance-support') }}"
                                                    class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                        class="fs-8 text-body lh-lg admin-text">Advance Support</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center ">

                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/writing.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('latter-head-form') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Letter Head</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/Currency.png"
                                                alt="dashboard icon">
                                            <a href="https://www.xe.com/currencyconverter/" target="_blank"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Currency
                                                    Converter</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/Code.png"
                                                alt="dashboard icon">
                                            <a href="https://www.indiantradeportal.in/" target="_blank"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">HSN
                                                    Code</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/Calculator.png"
                                                alt="dashboard icon">
                                            <a href="https://www.searates.com/shipping/request?utm_source=google&utm_medium=cpc&utm_campaign=17499343658&utm_content=142980297292&utm_term=freight%20calculator&gad_source=1&gclid=CjwKCAjw5v2wBhBrEiwAXDDoJU_Pim9FfTNBF0az3bh9ZV8KRj1PosCr5fYmnDEyrt1ukw5-V0vNYBoCvT8QAvD_BwE"
                                                target="_blank"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Freight
                                                    Calculator</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/Packages.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('packages') }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Packages</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/dashboard1.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('seller-shipmentdata-list') }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Shipment
                                                    Analytics</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center  gap-2">
                                            <img class="w-100   "
                                                src="../assets/img/seller-dashboard-icons/tickets-65.png"
                                                alt="dashboard icon">

                                            <a href="{{ route('QueryTickets') }}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Query Tickets</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


            {{-- <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent ">
                                        <div class="d-flex align-items-center ">

                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/tools.png"
                                                alt="tools icon">

                                            <a href="{{ route('tools') }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg admin-text">Tools</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

            {{-- </div> --}}
            {{--
            </div> --}}
            {{--
        </div> --}}


            <div class="row g-3 my-3">
                @forelse ($dashboardItems as $item)
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100"
                                                src="{{ asset('assets/img/seller-dashboard-icons/' . $item->img_link) }}"
                                                alt="dashboard icon">
                                            {{-- <a href="{{ Str::startsWith($item->route, ['http://', 'https://']) ? $item->route : route($item->route) }}"
                                                target="{{ Str::startsWith($item->route, ['http://', 'https://']) ? '_blank' : '_self' }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4">
                                                <span
                                                    class="fs-8 text-body lh-lg admin-text">{{ $item->item_name }}</span>
                                            </a> --}}
                                            <a href="{{ $item->fullRoute }}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4">
                                                <span
                                                    class="fs-8 text-body lh-lg admin-text">{{ $item->item_name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted mt-4">
                            <h6>No dashboard items available for your package.</h6>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>


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
    </main>

    {{-- <script>
        function filterLeadCards() {
            const searchTerm = document.getElementById('leadCardsSearch').value.toLowerCase().trim();
            const cards = Array.from(document.querySelectorAll('.row.g-3.my-3 > div[class*="col-"]'));

            cards.forEach(card => {
                const label = card.querySelector('.admin-text')?.textContent?.toLowerCase() || '';
                const count = card.querySelector('p.fw-bold')?.textContent?.toLowerCase() || '';
                const match = label.includes(searchTerm) || count.includes(searchTerm);

                if (searchTerm === '') {
                    card.style.display = '';
                    card.style.order = '';
                } else if (match) {
                    card.style.display = '';
                    card.style.order = '-1';
                } else {
                    card.style.display = 'none';
                }
            });

            const firstMatch = document.querySelector('.row.g-3.my-3 > div[style*="order: -1"]');
            if (firstMatch) {
                firstMatch.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }

        document.getElementById('leadCardsSearch').addEventListener('input', filterLeadCards);
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('leadCardsSearch');
            const cardsContainer = document.querySelector('.row.g-3.my-3');
            const cards = Array.from(cardsContainer.querySelectorAll(
            '.col-sm-6, .col-md-4, .col-xl-3, .col-xxl-3'));

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                cards.forEach(card => {
                    const label = card.querySelector('.admin-text')?.textContent?.toLowerCase() ||
                        '';
                    const match = label.includes(searchTerm);

                    card.style.display = match || searchTerm === '' ? '' : 'none';
                });
            });
        });
    </script>



    <livewire:seller.layout.footer />

</div>
