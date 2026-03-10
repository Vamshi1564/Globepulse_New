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
                <li class="breadcrumb-item active fs-sm text-dark fw-bold" aria-current="page">Opportunities</li>
            </ol>
        </nav>
        <div class="row gy-3 mb-4 justify-content-between">
            <div class="col-xxl-6">
                <h2 class="mb-5 text-body-emphasis">Opportunities</h2>
                <div class="row g-3 mb-3">
                    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex d-sm-block justify-content-between">
                                    <div class="border-translucent">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/LOis.png"
                                                alt="dashboard icon">
                                            <a href="{{route('lois', ['procatId' => $procatId7->id])}}"
                                                class="text-primary mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">My Letter of Intents</span></a>
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
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/POis.png"
                                                alt="dashboard icon">
                                            <a href="{{route('pos', ['procatId' => $procatId8->id])}}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">My Purchase Orders </span></a>
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
                                                src="../assets/img/seller-dashboard-icons/ImportantUpdates.png"
                                                alt="dashboard icon">
                                            <a href="{{route('seller-notification-list')}}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">Important Updates
                                                </span></a>
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
                                            <img class="w-100" src="../assets/img/seller-dashboard-icons/mydeal-1.png"
                                                alt="dashboard icon">
                                            <a href="{{route('byleads')}}"
                                                class="text-info mt-2 fs-6 fw-bold mb-0 mb-sm-4"><span
                                                    class="fs-8 text-body lh-lg">My Deals
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        </div>
    </div>
    <livewire:seller.layout.footer />
</div>