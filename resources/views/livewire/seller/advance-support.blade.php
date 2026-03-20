<div>
    <livewire:seller.layout.header />

    <main class="main" id="top">
        <div class="container-fluid">
            <div class="py-5">
                <nav class="" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-5">
                        <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Advance-support</li>
                    </ol>
                </nav>

                {{-- <h2 class="mb-5 text-body-emphasis">Advance Support</h2> --}}

                <div class="d-flex align-items-center gap-3">

                    <div>
                        <h2 class="mb-0 text-dark">Advanced Support</h2>
                        {{-- <small class="text-muted">We’re here 24/7 for your assistance</small> --}}
                    </div>
                </div>

                <div class=" py-4">
                    <div class="row g-4 position-relative">
                        @foreach ($AdvanceSupport as $item)
                            <div class="col-12 col-md-6 col-lg-4 mt-5 pt-3">
                                <div class="infographic-box p-4 h-100 position-relative">
                                    <div style="background-color: #ffffff"
                                        class="infographic-icon position-absolute top-0 start-50 translate-middle text-white d-flex align-items-center justify-content-center">
                                        {{-- <i class="fa-solid fa-user fs-5"></i> --}}
                                        <img class="w-100" src="../../assets/img/support2.png" alt="">
                                    </div>

                                    <div class="pt-5 text-center">
                                        <h5 class="fw-bold mb-3">{{ $item->tital ?? 'Support' }}</h5>

                                        <div class="infographic-line-item mb-3">
                                            <i class="fa-brands fa-whatsapp me-2 text-success"></i>
                                            <a href="https://wa.me/{{ $item->whatsApp_no ?? '' }}"
                                                target="_blank">{{ $item->whatsApp_no ?? 'N/A' }}</a>
                                        </div>

                                        <div class="infographic-line-item mb-3">
                                            <i class="fas fa-phone me-2 text-primary"></i>
                                            <a href="tel:{{ $item->phone_no ?? '' }}">{{ $item->phone_no ?? 'N/A' }}</a>
                                        </div>

                                        <div class="infographic-line-item">
                                            <i class="fa-solid fa-envelope me-2 text-danger"></i>
                                            <a href="mailto:{{ $item->email ?? '' }}">{{ $item->email ?? 'N/A' }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <style>
                        .infographic-box {
                            background: linear-gradient(145deg, #ffffff, #ffffff);
                            border-radius: 20px;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                            padding-top: 60px;
                            transition: 0.3s;
                            text-align: center;
                            border-top: 4px solid #02008d;
                            border-bottom: 4px solid #02008d;
                            /* border: 1px #0d6efd solid; */
                            position: relative;
                        }

                        .infographic-box:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
                            border-top: none;
                        }

                        .infographic-icon {
                            width: 60px;
                            height: 60px;
                            border-radius: 50%;
                            box-shadow: 0 0 15px rgba(13, 110, 253, 0.4);
                            font-size: 22px;
                            z-index: 10;
                        }

                        .infographic-line-item {
                            font-size: 15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                        }

                        .infographic-line-item a {
                            text-decoration: none;
                            color: #212529;
                            font-weight: 500;
                        }
                    </style>
                </div>

            </div>
        </div>
    </main>
    <livewire:seller.layout.footer />

</div>