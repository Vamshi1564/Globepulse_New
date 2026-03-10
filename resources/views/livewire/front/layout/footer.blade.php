<div>
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <div>
        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <footer class="footer-section text-white position-relative">
            <div class="footer-bg-overlay"></div>
            <div class="container-fluid py-5 position-relative" style="z-index: 2;">
                <div class="row gy-5">

                    <!-- Company Info -->
                    <div class="col-lg-4">
                        <img src="../../../assets/img/logos/GFEPLUSE1.png" alt="Globpulse" style="max-width: 250px;"
                            class="mb-3">
                        <p class="text-white-50">Choose Globpulse, an ISO 9001:2015 certified platform, to find Indian
                            businesses and verified trade partners. Our
                            marketplace helps exporters, wholesalers, and manufacturers to go global with secure tools,
                            quality leads and
                            transparent import–export opportunities.</p>
                    </div>

                    <!-- Grow with Us -->
                    <div class="col-md-6 col-lg-2">
                        <h5 class="fw-bold mb-3 text-uppercase text-white">Grow With Us</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('product_add') }}" class="footer-link">Sell with Confidence</a></li>
                            <li><a href="{{ route('postbyrequirement') }}" class="footer-link">Post Buy Requirement</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="col-md-6 col-lg-2">
                        <h5 class="fw-bold mb-3 text-uppercase text-white">Categories</h5>
                        <ul class="list-unstyled">
                            @foreach ($categories as $category)
                                <li><a href="{{ route('products-category', ['categorySlug' => $category->slug]) }}"
                                        class="footer-link">{{ $category->cat_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-6 col-lg-2">
                        <h5 class="fw-bold mb-3 text-uppercase text-white">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                            <li><a href="{{ route('packages') }}" class="footer-link">Membership Plans</a></li>
                            <li><a href="{{ route('byleads') }}" class="footer-link">Buy Leads</a></li>
                            <li><a href="{{ route('trade-finance-solutions') }}" class="footer-link">Trade Finance</a>
                            <li><a href="{{ route('company-registration') }}" class="footer-link">Company
                                    Registration</a>
                            <li><a href="{{ route('blogpage') }}" class=" footer-link" target="_blank">Blog</a>
                            </li>

                        </ul>
                    </div>

                    <!-- Get to Know Us -->
                    <div class="col-md-6 col-lg-2">
                        <h5 class="fw-bold mb-3 text-uppercase text-white">About</h5>
                        <ul class="list-unstyled">
                            <li><a href="https://gfecci.org/about.html" target="_blank" class="footer-link">About
                                    Globpulse</a></li>
                            <li><a href="{{ route('b2bmarketplace') }}" class="footer-link">B2B marketplace</a></li>
                            <li><a href="{{ route('awards') }}" class="footer-link">Achievements</a></li>
                            <li><a href="{{ route('career') }}" class="footer-link">Careers</a></li>
                            <li><a href="{{ route('contact') }}" class="footer-link">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <hr class="border-light my-4">

                <!-- Newsletter & Socials -->
                <div class="d-flex flex-wrap align-items-center">

                    <div class="col-md-6 justify-content-start">
                        <ul class="example-2  ps-0">
                            <li class="icon-content">
                                <a href="https://www.linkedin.com/company/13249941/admin/feed/posts/" target="_blank"
                                    aria-label="LinkedIn" data-social="linkedin">
                                    <div class="filled"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-linkedin" viewBox="0 0 16 16" xml:space="preserve">
                                        <path
                                            d=" M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526
                                                        1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943
                                                        12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554
                                                        1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327
                                                        1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0
                                                        1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274
                                                        0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                                <div class="tooltip">LinkedIn</div>
                            </li>

                            <li class="icon-content">
                                <a href="https://in.pinterest.com/gfebusiness/" target="_blank" aria-label="Pinterest"
                                    data-social="pinterest">
                                    <div class="filled"></div>
                                    <svg version="1.1" viewBox="0 0 100 100" xml:space="preserve">
                                        <path
                                            d="M83,17.8C74.5,8.9,63.4,4.3,50,4.1C37.7,4.2,26.8,8.6,17.9,17.3C8.9,26,4.3,37,4.1,50c0,0,0,0,0,0c0,9.1,2.5,17.4,7.4,24.9  c4.9,7.4,11.6,13.2,20.1,17.1c0.3,0.1,0.7,0.1,1-0.1c0.3-0.2,0.5-0.5,0.5-0.8l0-4.9c0.1-2.1,0.7-5.3,1.7-9.5c1-4,1.7-6.7,1.9-7.6  c0.7-3,1.7-7.2,3-12.6c0.1-0.2,0-0.5-0.1-0.7c-0.4-0.8-1-2.6-1.5-6.6c0.1-2.7,0.8-5.2,2.1-7.3c1.2-2,3.1-3.1,5.7-3.5  c2,0.1,4.7,0.8,5.1,5.9c-0.1,1.8-0.8,4.5-1.9,8.1c-1.2,3.8-1.9,6.3-2.1,7.6c-0.7,2.5-0.2,4.8,1.5,6.8c1.6,1.9,3.8,2.9,6.5,3.1  c4.3-0.1,8.1-2.6,11.2-7.5c1.7-3,2.9-6.3,3.5-9.7c0.7-3.4,0.7-7.1,0-10.8c-0.7-3.8-2.2-7.1-4.5-9.8c0,0-0.1-0.1-0.1-0.1  c-4.3-3.7-9.5-5.3-15.6-5c-6,0.4-11.3,2.6-15.9,6.6c-2.9,3.2-4.8,7.1-5.7,11.6c-0.9,4.6,0,9.1,2.6,13.3c0.3,0.5,0.5,0.8,0.6,1  c0,0.3,0,1-0.5,2.8c-0.5,1.8-0.9,2.2-0.9,2.2c0,0-0.1,0-0.1,0.1c0,0-0.2,0-0.4-0.1c-2.2-1-3.9-2.4-5.2-4.2c-1.3-1.9-2.1-4-2.5-6.3  c-0.3-2.5-0.4-5-0.3-7.5c0.2-2.5,0.7-5.1,1.4-7.7c3-6.9,8.5-11.9,16.3-14.8c7.8-2.9,16-3.2,24.3-0.8c6.5,2.8,11,7.4,13.6,13.7  c2.5,6.4,2.8,13.4,0.8,20.8c-2.2,7.1-6.4,12.4-12.1,15.7c-5.6,2.8-10.8,3-15.7,0.7c-1.8-1.1-3.1-2.3-3.9-3.5c-0.2-0.3-0.6-0.5-1-0.5  c-0.4,0.1-0.7,0.3-0.8,0.7c-0.7,2.7-1.3,4.7-1.6,6.2c-1.4,5.4-2.6,9.2-3.4,11c-0.8,1.6-1.6,3.1-2.4,4.3c-0.2,0.3-0.2,0.6-0.1,0.9  s0.3,0.5,0.6,0.6c4.3,1.3,8.7,2,13,2c12.4-0.1,23.2-4.6,32.1-13.4C91.1,73.9,95.8,62.9,96,50C95.9,37.5,91.5,26.7,83,17.8z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                                <div class="tooltip">Pinterest</div>

                            </li>
                            <li class="icon-content">
                                <a href="https://www.instagram.com/gfe.business/" target="_blank" aria-label="Instagram"
                                    data-social="instagram">
                                    <div class="filled"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-instagram" viewBox="0 0 16 16" xml:space="preserve">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                                <div class="tooltip">Instagram</div>
                            </li>
                            <li class="icon-content">
                                <a href="https://www.youtube.com/@gfebusiness" target="_blank" aria-label="Youtube"
                                    data-social="youtube">
                                    <div class="filled"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-youtube" viewBox="0 0 16 16" xml:space="preserve">
                                        <path
                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                                <div class="tooltip">Youtube</div>
                            </li>
                            <li class="icon-content">
                                <a href="https://twitter.com/gfebusiness" target="_blank" aria-label="twitter"
                                    data-social="twitter">
                                    <div class="filled"></div>
                                    <svg viewBox="0 0 16 16" fill="currentColor" class="bi bi-twitter" height="20"
                                        width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor"
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15">
                                        </path>

                                    </svg>
                                </a>
                                <div class="tooltip">Twitter</div>
                            </li>
                            <li class="icon-content">
                                <a href="https://www.facebook.com/GFEbusiness" target="_blank" aria-label="facebook"
                                    data-social="facebook">
                                    <div class="filled"></div>
                                    <svg viewBox="0 0 16 16" fill="currentColor" class="bi bi-facebook" height="20"
                                        width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor"
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951">
                                        </path>

                                    </svg>
                                </a>
                                <div class="tooltip">Facebook</div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end m-0 p-0 mt-3 mt-md-0">
                        <a href="https://apps.apple.com/app/globpulse/id6742694568" target="_blank"><img
                                style="width:130px;" class="me-3" src="../../../assets/img/Appstore.webp" alt=""></a>
                        <a href="https://play.google.com/store/apps/details?id=crm.ani.com" target="_blank"><img
                                style="width:130px;" class="" src="../../../assets/img/GooglePlay.webp" alt=""></a>
                    </div>

                </div>

                <div class="text-center mt-4 text-white-70 small">
                    &copy; {{ date('Y') }} Globpulse. All rights reserved.
                </div>
            </div>
        </footer>

        <!-- Background + Style -->
        <style>
            .footer-section {
                background: url('../../../assets/img/logos/we-work-global.webp') center/cover no-repeat;
                position: relative;
                overflow: hidden;
            }

            .footer-bg-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.578);
                z-index: 1;
            }

            .footer-link {
                color: #ccc;
                display: block;
                margin-bottom: 0.5rem;
                transition: 0.3s ease;
                text-decoration: none;
            }

            .footer-link:hover {
                color: #fff;
                padding-left: 5px;
            }

            .social-icon {
                color: #ccc;
                font-size: 1.5rem;
                margin-left: 15px;
                transition: color 0.3s ease;
            }

            .social-icon:hover {
                color: #fff;
            }
        </style>

        <!-- Bootstrap Icons (Required) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



        <!-- <section> close ============================-->
        <!-- ============================================-->


        <!-- <footer class="footer position-relative">
        <div class=p"row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 mt-2 mt-sm-0 text-body">Thank you for creating with Phoenix<span
                        class="d-none d-sm-inline-block"></span><span n class="d-none d-sm-inline-block mx-1">|</span><br
                        class="d-sm-none" />2024 &copy;<a class="mx-1"href="https://themewagon.com">Themewagon</a>
                </p>
            </div>
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-body-tertiary text-opacity-85">v1.19.0</p>
            </div>
        </div>
    </footer> -->
    </div>
    <style>
        ul {
            list-style: none;
            margin: 0 0;
        }

        .example-2 {
            display: flex;
            justify-content: start;
            align-items: center;
            flex-wrap: wrap;
        }

        .example-2 .icon-content {
            margin: 0 7px;
            position: relative;
        }

        .example-2 .icon-content .tooltip {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            /* padding: 5px 8px; */
            border-radius: 5px;
            opacity: 0;
            visibility: hidden;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .example-2 .icon-content:hover .tooltip {
            opacity: 1;
            visibility: visible;
            top: -50px;
        }

        .example-2 .icon-content a {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #4d4d4d;
            background-color: #eae7e7;
            transition: all 0.3s ease-in-out;
        }

        .example-2 .icon-content a:hover {
            box-shadow: 3px 2px 45px 0px rgb(0 0 0 / 12%);
        }

        .example-2 .icon-content a svg {
            position: relative;
            z-index: 1;
            width: 20px;
            height: 20px;
        }

        .example-2 .icon-content a:hover {
            color: white;
        }

        .example-2 .icon-content a .filled {
            position: absolute;
            top: auto;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background-color: #000;
            transition: all 0.3s ease-in-out;
        }

        .example-2 .icon-content a:hover .filled {
            height: 100%;
        }

        .example-2 .icon-content a[data-social="linkedin"] .filled,
        .example-2 .icon-content a[data-social="linkedin"]~.tooltip {
            background-color: #0274b3;
        }

        .example-2 .icon-content a[data-social="pinterest"] .filled,
        .example-2 .icon-content a[data-social="pinterest"]~.tooltip {
            background-color: #bd081c;
        }

        .example-2 .icon-content a[data-social="twitter"] .filled,
        .example-2 .icon-content a[data-social="twitter"]~.tooltip {
            background-color: #37bcf9;
        }

        .example-2 .icon-content a[data-social="facebook"] .filled,
        .example-2 .icon-content a[data-social="facebook"]~.tooltip {
            background-color: #0462df;
        }

        .example-2 .icon-content a[data-social="instagram"] .filled,
        .example-2 .icon-content a[data-social="instagram"]~.tooltip {
            /* background: linear-gradient(45deg,
                    #405de6,
                    #5b51db,
                    #b33ab4,
                    #c135b4,
                    #e1306c,
                    #fd1f1f); */
            /* background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); */
            /* background: linear-gradient(45deg,
                    #833ab4, #fd1d1d, #fcb045); */
            /* background: linear-gradient(45deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5); */
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }

        .example-2 .icon-content a[data-social="youtube"] .filled,
        .example-2 .icon-content a[data-social="youtube"]~.tooltip {
            background-color: #ff0000;
        }


        @media(max-width:768px) {
            .example-2 {
                display: flex;
                justify-content: center !important;
                align-items: center;
                flex-wrap: wrap;
            }
        }
    </style>

    <!-- <section> close ============================-->
    <!-- ============================================-->


    <!-- <footer class="footer position-relative">
        <div class=p"row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 mt-2 mt-sm-0 text-body">Thank you for creating with Phoenix<span
                        class="d-none d-sm-inline-block"></span><span n class="d-none d-sm-inline-block mx-1">|</span><br
                        class="d-sm-none" />2024 &copy;<a class="mx-1"href="https://themewagon.com">Themewagon</a>
                </p>
            </div>
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-body-tertiary text-opacity-85">v1.19.0</p>
            </div>
        </div>
    </footer> -->
</div>