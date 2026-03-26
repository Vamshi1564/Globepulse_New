<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-navigation-type="dual"
    data-navbar-horizontal-shape="default">

<head>
    @stack('custom-meta')

    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->

    <link rel="icon" href="{{ asset('assets/img/icons/globpluse.jpg') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icons/globpluse.png') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/css/tom-select.min.css"
        integrity="sha512-fnaIKCc5zGOLlOvY3QDkgHHDiDdb4GyMqn99gIRfN6G6NrgPCvZ8tNLMCPYgfHM3i3WeAU6u4Taf8Cuo0Y0IyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
    @livewireStyles
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5B3H1ZR1R6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-5B3H1ZR1R6');
    </script>

    {{-- <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof grecaptcha === 'undefined') return;

            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                        action: 'submit'
                    })
                    .then(function(token) {
                        document.querySelectorAll('form').forEach(form => {
                            let input = form.querySelector('input[name="recaptcha_token"]');
                            if (!input) {
                                input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'recaptcha_token';
                                form.appendChild(input);
                            }
                            input.value = token;
                        });
                    });
            });
        });
    </script> --}}


</head>

<body>
<!-- <script>
window.isLoggedIn = @json(auth('customer')->check());
</script> -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="logo-container">
            <div class="main-logo">
                <span class="logo-char" style="animation-delay: 0.1s; color: #0d1e56;">G</span>
                <span class="logo-char" style="animation-delay: 0.2s; color: #0d1e56;">L</span>
                <span class="logo-char" style="animation-delay: 0.3s; color: #0d1e56;">O</span>
                <span class="logo-char" style="animation-delay: 0.4s; color: #0d1e56;">B</span>
                <span class="logo-char" style="animation-delay: 0.5s; color: #3a6e08;">P</span>
                <span class="logo-char" style="animation-delay: 0.6s; color: #3a6e08;">U</span>
                <span class="logo-char" style="animation-delay: 0.7s; color: #3a6e08;">L</span>
                <span class="logo-char" style="animation-delay: 0.8s; color: #3a6e08;">S</span>
                <span class="logo-char" style="animation-delay: 0.9s; color: #3a6e08;">E</span>
            </div>

            <span class="underline loading"></span>

            <div class="tagline">
                <span class="tagline-char" style="animation-delay: 1.1s;">THE</span>
                <span class="tagline-char" style="animation-delay: 1.4s;">PULSE</span>
                <span class="tagline-char" style="animation-delay: 1.7s;">OF</span>
                <span class="tagline-char" style="animation-delay: 2.0s;">GLOBAL</span>
                <span class="tagline-char" style="animation-delay: 2.4s;">TRADE</span>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&display=swap');

        body {
            opacity: 0;
            background-color: white;
            transition: opacity 0.3s ease;
        }

        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(232, 244, 236, 0.977);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
            transition: opacity 0.7s ease;
            overflow: hidden;
        }

        .logo-container {
            text-align: center;
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .main-logo {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: clamp(2.1rem, 8vw, 4.5rem);
            letter-spacing: -2px;
            line-height: 1;
            display: inline-block;
            overflow: hidden;
        }

        .logo-char {
            display: inline-block;
            transform: scale(1.8);
            opacity: 0;
            animation: charZoom 0.55s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes charZoom {
            0% {
                transform: scale(1.8);
                opacity: 0;
            }

            60% {
                transform: scale(0.9);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .underline {
            display: block;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #ff6600, #ff9933);
            margin: 8px auto 0;
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: center;
            animation: underlineExpand 0.8s ease 2.8s forwards;
        }

        @keyframes underlineExpand {
            from {
                transform: scaleX(0);
                opacity: 0;
            }

            to {
                transform: scaleX(1.2);
                opacity: 1;
            }
        }

        .underline.loading {
            animation: underlineLoading 2s ease-in-out infinite;
        }

        @keyframes underlineLoading {

            0%,
            100% {
                transform: scaleX(0);
                opacity: 0.6;
            }

            50% {
                transform: scaleX(1);
                opacity: 1;
            }
        }

        .tagline {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: clamp(0.4rem, 2.7vw, 1.2rem);
            letter-spacing: 3px;
            margin-top: 15px;
            text-transform: uppercase;
            overflow: hidden;
            display: inline-block;
        }

        .tagline-char {
            display: inline-block;
            opacity: 0;
            transform: translateY(10px);
            animation: taglineFade 0.5s ease forwards;
        }

        @keyframes taglineFade {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .main-logo {
                letter-spacing: -2px;
            }

            .logo-char {
                font-size: 28px;
            }
        }
    </style>


   <div id="page-content">
    {{ $slot }}
</div>

    {{-- {{ $slot }} --}}
    <div class="modal fade overflow-y-hidden" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title fs-md-3 fs-5 font-bold honey" id="exampleModalLabel">Enquiry Form</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('store') }}" method="post">
                        @csrf
                        <div class="row gy-1">
                            <div class="col-12">
                                <label for="fullname" class="form-label">Full Name <span
                                        class="text-danger">*</span></label>
                                <input required type="text" class="form-control" id="fullname" wire:model="name"
                                    name="name" value="">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                        </svg>
                                    </span>
                                    <input type="email" required class="form-control" id="email"
                                        wire:model="email" name="email" value="">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="phone" class="form-label">Phone Number <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                        </svg>
                                    </span>
                                    <input type="tel" required class="form-control" id="phone"
                                        wire:model="phone" name="phone" value="">
                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" wire:model="message" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <input type="submit" data-mdb-ripple-init type="button" value="Send Message"
                                        class="btn bg-success btn-success focus:outline-none hover:bg-indigo-600 btn-lg"></input>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Make loader visible instantly (0ms delay)
        document.addEventListener("DOMContentLoaded", function() {
            const overlay = document.getElementById("loading-overlay");
            if (overlay) overlay.style.display = "flex";
        });

        // When page fully loaded → fade in content + hide loader
        window.addEventListener("load", function() {
            const overlay = document.getElementById("loading-overlay");
            const pageContent = document.getElementById("page-content");

            setTimeout(() => {
                if (overlay) overlay.style.opacity = "0";

                setTimeout(() => {
                    if (overlay) overlay.style.display = "none";

                    // Show page smoothly
                    document.body.style.opacity = "1";

                    if (pageContent) {
                        pageContent.style.display = "block";
                        pageContent.style.opacity = "1";
                    }
                }, 500);
            }, 300);
        });
    </script>





    <div class="modal fade" id="v01" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="view show" id="v01-view">
                    <div class="modal-header border-0 bg-dark px-4">
                        <h4 class="modal-title text-light">Trusted reviews</h4>
                        <button class="btn-close btn-close-white" id="stop_youtube_video" type="button"
                            data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body px-4">

                        <iframe id="myiframe" width="100%" height="315" src=""
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>


            </div>
        </div>
    </div>

<!--   
    <script>
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
       if (btn) {
    btn.onclick = function() {
            modal.style.display = "block";
        }
}
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script> -->
    <script>
        function changeSrc(obj) {
            document.getElementById("myiframe").src = obj;
            return false;
        }
    </script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- <script>
       if (window.$) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}
    </script> -->
    <script src="{{ asset('../../../vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/echarts/echarts.min.js') }}"></script>
    <!-- <script src="{{ asset('../../../assets/js/crm-dashboard.js') }}"></script> -->
    <script src="{{ asset('../../../vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/fontawesome/all.min.js') }}"></script>
    
    <script src="{{ asset('../../../vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('../../../assets/js/phoenix.js') }}"></script>
    <script src="{{ asset('../../../vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('../../../vendors/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('../../../vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js') }}">
    </script>
    <script script src="{{ asset('../../../vendors/tinymce/tinymce.min.js') }}"></script>
    <script script src="{{ asset('../../../vendors/fullcalendar/index.global.min.js') }}"></script>
    <script script src="{{ asset('../../../assets/js/calendar.js') }}"></script>

    <script src="../../vendors/typed.js/typed.umd.js"></script>
    <script src="{{ asset('../../vendors/countup/countUp.umd.js') }}"></script>

    <script src="{{ asset('../../../vendors/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('../../../vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('../../../vendors/flatpickr/flatpickr.min.js') }}"></script>
    </script>
    <script src="{{ asset('../../../assets/js/ecommerce-dashboard.js') }}"></script>
    <script src="{{ asset('../../../assets/js/echarts-example.js') }}"></script>
    <script src="{{ asset('../../../vendors/glightbox/glightbox.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/js/tom-select.complete.min.js"
        integrity="sha512-zdXqksVc9s0d2eoJGdQ2cEhS4mb62qJueasTG4HjCT9J8f9x5gXCQGSdeilD+C7RqvUi1b4DdD5XaGjJZSlP9Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('../../vendors/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('../../vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('../../vendors/isotope-packery/packery-mode.pkgd.min.js') }}"></script>
    <script src="{{ asset('../../vendors/bigpicture/BigPicture.js') }}"></script>

 
    


    {{-- tooltips show name --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>



    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const el = document.querySelector("#country");
    if (el) {
        new TomSelect(el);
    }
});
    </script>
   
    <script>
      document.addEventListener("livewire:navigated", function () {
            const alert = document.getElementById('alert');
            const errorAlert = document.getElementById('error-alert');

            if (errorAlert) {
                setTimeout(() => {
                    $('#errorAlert').alert('close');
                }, 5000);
            } else {
                setTimeout(() => {
                    $('#alert').alert('close');
                    $('#errorAlert').alert('close');
                }, 5000);
            }
        });
    </script>

    <script>
        function scrollToTop() {
            window.scrollTo(0, 0);
        }
    </script>
    
   <div id="intentPopup" class="intent-popup">

<div class="intent-modal">

<button class="intent-close" onclick="closeIntentPopup()">✕</button>

<div class="intent-header">
<h2>Welcome to GlobPulse</h2>
<p>How would you like to use our global B2B marketplace?</p>
</div>

<div class="intent-options">

<!-- SELLER -->
<div class="intent-card seller" onclick="goSeller()">

<div class="intent-icon-wrap">
<i class="bi bi-shop"></i>
</div>

<h4>Become a Seller</h4>
<p>Showcase products and reach global buyers instantly.</p>

</div>

<!-- BUYER -->
<div class="intent-card buyer" onclick="goBuyer()">

<div class="intent-icon-wrap">
<i class="bi bi-cart"></i>
</div>

<h4>Become a Buyer</h4>
<p>Find trusted suppliers and request quotes easily.</p>

</div>

</div>

<div class="intent-footer">
<button onclick="closeIntentPopup()" class="browse-btn">
Continue Browsing
</button>
</div>

</div>
</div>



<script>

window.isLoggedIn =
{{ session()->has('buyer_id') || session()->has('seller_id') || auth('customer')->check() ? 'true' : 'false' }} === 'true';

/* SHOW POPUP */
function showPopup(){

    const popup = document.getElementById("intentPopup");
    if(!popup) return;

    popup.style.display = "flex";

    sessionStorage.setItem("intentPopupShown","true");

}

/* CLOSE POPUP */
function closeIntentPopup(){

    const popup = document.getElementById("intentPopup");
    if(!popup) return;

    popup.style.display = "none";

}

/* SELLER */
function goSeller(){

    localStorage.setItem("globpulseUserType","seller");

      window.location.href = "/start-selling";

}

/* BUYER */
function goBuyer(){

    localStorage.setItem("globpulseUserType","buyer");

    window.location.href = "{{ route('buyer.signup') }}";

}

/* CUSTOMER */
function goCustomer(){

    localStorage.setItem("globpulseUserType","customer");

    window.location.href = "{{ route('login') }}";

}

/* AUTO POPUP AFTER 12 SEC */
window.addEventListener("load", function(){

    setTimeout(function(){

        if(
            !window.isLoggedIn &&
            !localStorage.getItem("globpulseUserType") &&
            !sessionStorage.getItem("intentPopupShown")
        ){
            showPopup();
        }

    },12000);

});

/* INTERCEPT LINK CLICK */
document.addEventListener("click", function(e){

    let link = e.target.closest(".intent-trigger");

    if(!link) return;

    if(window.isLoggedIn || localStorage.getItem("globpulseUserType")) return;

    e.preventDefault();

    localStorage.setItem("redirectAfterIntent", link.href);

    showPopup();

});

</script>

<!-- <script>

window.isLoggedIn =
{{ session()->has('buyer_id') || session()->has('seller_id') || auth('customer')->check() ? 'true' : 'false' }} === 'true';

/* SHOW POPUP */
function showPopup(){

    const popup = document.getElementById("intentPopup");
    if(!popup) return;

    popup.style.display = "flex";

    // mark popup as shown permanently
    localStorage.setItem("intentPopupShown","true");

}

/* CLOSE POPUP */
function closeIntentPopup(){

    const popup = document.getElementById("intentPopup");
    if(!popup) return;

    popup.style.display = "none";

}

/* SELLER */
function goSeller(){

    localStorage.setItem("globpulseUserType","seller");
    window.location.href = "/start-selling";

}

/* BUYER */
function goBuyer(){

    localStorage.setItem("globpulseUserType","buyer");
    window.location.href = "{{ route('buyer.register') }}";

}

/* AUTO POPUP AFTER 5 SEC */
window.addEventListener("load", function(){

    setTimeout(function(){

        if(
            !window.isLoggedIn &&
            !localStorage.getItem("intentPopupShown")
        ){
            showPopup();
        }

    },5000);

});

</script> -->


<!-- <script>

/* SHOW POPUP */
function showPopup(){
    const popup = document.getElementById("intentPopup");
    if(popup){
        popup.style.display = "flex";
    }
}

/* CLOSE POPUP */
function closeIntentPopup(){
    const popup = document.getElementById("intentPopup");
    if(popup){
        popup.style.display = "none";
    }
}

/* SELLER */
function goSeller(){
    localStorage.setItem("globpulseUserType","seller");
    window.location.href = "/start-selling";
}

/* BUYER */
function goBuyer() {

    // Save user intent
    localStorage.setItem("globpulseUserType", "buyer");

    // Redirect to buyer registration
    window.location.href = "{{ route('buyer.register') }}";

}

/* SHOW POPUP AFTER PAGE VISIBLE */
window.addEventListener("load", function(){

    setTimeout(function(){

        // if(
        //     !localStorage.getItem("globpulseUserType") &&
        //     !window.isLoggedIn
        // )
        {
            showPopup();
        }

    },5000); // show after 5 seconds

});

</script>


<script>
document.addEventListener("click", function(e){

    let link = e.target.closest(".intent-trigger");

    if(!link) return;

    if(localStorage.getItem("globpulseUserType") || window.isLoggedIn) return;

    e.preventDefault();

    localStorage.setItem("redirectAfterIntent", link.href);

    showPopup();

});
</script> -->
 
  @livewireScripts
</body>

</html>
