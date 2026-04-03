

    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->

    <link rel="icon" href="{{ asset('assets/img/icons/globpluse.jpg') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icons/globpluse.png') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/css/tom-select.min.css"
        integrity="sha512-fnaIKCc5zGOLlOvY3QDkgHHDiDdb4GyMqn99gIRfN6G6NrgPCvZ8tNLMCPYgfHM3i3WeAU6u4Taf8Cuo0Y0IyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="shortcut icon" href="{{ asset('assets/img/icons/globpluse.jpg') }}" type="image/x-icon">




    {{--
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/logos/GFEPLUSE.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/logos/GFEPLUSE.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/logos/GFEPLUSE.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../assets/img/logos/GFEPLUSE.png">
    <link rel="manifest" href="../../../assets/img/logos/GFEPLUSE.png"> --}}
    {{--
    <meta name="msapplication-TileImage" content="../../../assets/img/favicons/mstile-150x150.png"> --}}
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('../../../vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('../../../assets/js/config.js') }}"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('../../../vendors/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/leaflet.markercluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/leaflet.markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('../../../vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{ asset('../../../assets/css/theme-rtl.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('../../../assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('../../../assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet"
        id="user-style-rtl">
    <link href="{{ asset('../../../assets/css/user.min.css?id=1') }}" type="text/css" rel="stylesheet"
        id="user-style-default">
    <link href="{{ asset('../../../vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/mapbox-gl/mapbox-gl.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../vendors/glightbox/glightbox.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">




    <!-- Header -->
    <livewire:front.layout.header />



    <style>
        .not-found-card h2 {
            font-size: 50px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #1f2937;
        }

        .not-found-card p {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.6;
        }



        .action-btns .btn {
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .action-btns .primary {
            background: #facc15;
            color: #000;
            font-weight: 500;
        }

        .action-btns .primary:hover {
            background: #eab308;
        }

        .action-btns .outline {
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .action-btns .outline:hover {
            background: #f3f4f6;
        }
        section {
    margin-top: 30px;
}
    </style>

    <section>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="icon-box text-center">
                        <img class="w-75 w-lg-75 " src="../assets/img/no-product.png" alt="Not Found">
                    </div>
                </div>

                <div class="col-md-6 not-found-card ">
                    <h2>Product Not Found</h2>
                    <p>
                        We couldn’t find what you were looking for.<br>
                        Try searching again or explore other products.
                    </p>

                    <div class="action-btns">
                        <a href="/" class="btn primary fw-bold">Go to Home</a>
                        <a href="/products" class="btn outline">Browse Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <livewire:front.layout.footer />
