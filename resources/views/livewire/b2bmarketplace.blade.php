@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>B2B Marketplace in India for Import Export | Wholesale Trade - GlobPulse</title>

    <!-- Meta Description -->
    <meta name="description"
        content="GlobPulse is a leading B2B marketplace in India for import export & wholesale trade. Connect with verified manufacturers, suppliers, exporters & buyers worldwide." />

    <!-- Meta Keywords (Optional) -->
    <meta name="keywords"
        content="b2b marketplace india, import export b2b marketplace, b2b marketplace platform, b2b marketplace app, b2b portal india, import export business platform, global b2b trade marketplace, buy and sell wholesale products online, indian exporters suppliers marketplace." />

    <!-- Robots -->
    <meta name="robots" content="index, follow" />

    <!-- Canonical -->
    <link rel="canonical" href="https://www.globpulse.com/b2bmarketplace" />

    <!-- Open Graph Meta Tags (For Social Sharing) -->
    <meta property="og:title" content="B2B Marketplace in India for Import Export | Wholesale Trade - GlobPulse " />
    <meta property="og:description"
        content="GlobPulse is a leading B2B marketplace in India for import export & wholesale trade. Connect with verified manufacturers, suppliers, exporters & buyers worldwide." />

    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/globpluse.jpg" />
    <meta property="og:url" content="https://www.globpulse.com/b2bmarketplace" />
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Globpulse Mart" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content=" B2B Marketplace in India for Import Export | Wholesale Trade - GlobPulse  ">
    <meta name="twitter:description"
        content="GlobPulse is a leading B2B marketplace in India for import export & wholesale trade. Connect with verified manufacturers, suppliers, exporters & buyers worldwide.">

    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/Globpulse.png">
    <meta name="author" content="Globpulse">
@endpush

<div>
    <livewire:front.layout.header />

    <!-- HERO -->
    <!-- INTRO / HERO CONTENT -->
    <section class="b2b-intro">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 text-center">
                    {{-- <span class="badge bg-primary-subtle text-primary mb-3">India’s #1 B2B Platform</span> --}}
                    <h1 class="fw-bold mt-3 fs-6">
                        B2B Marketplace in India – Buy & Sell Wholesale Products Online
                    </h1>
                    <p class="mt-3 text-muted fs-8">
                        Globpulse is a powerful B2B marketplace in India designed to connect manufacturers,
                        wholesalers, distributors, and bulk buyers on one trusted platform.
                        Our B2B platform helps businesses discover verified suppliers, list products,
                        and grow wholesale trade efficiently through digital technology.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT + IMAGE -->
    <section class="b2b-content">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="content-box">
                        <h2>Globpulse – The Best B2B Marketplace Platform in India</h2>
                        <p>
                            Globpulse is recognized as one of the best B2B marketplaces in India,
                            enabling seamless buying and selling of wholesale products across multiple industries.
                            Whether you are a manufacturer looking to expand your reach or a buyer searching for trusted
                            suppliers, our wholesale B2B marketplace offers a reliable and scalable solution.
                        </p>

                        <h2 class="mt-4">India’s Trusted B2B Platform for Buyers &amp; Sellers</h2>
                        <p>
                            Globpulse supports manufacturers, exporters, wholesalers, distributors, and retailers
                            by providing a complete online B2B trading platform. Our system helps businesses generate
                            leads, increase visibility, and grow sales in the competitive Indian B2B market.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="https://illustrations.popsy.co/blue/online-shopping.svg" class="img-fluid b2b-img"
                        alt="B2B Marketplace India">
                </div>
            </div>
        </div>
    </section>
    <style>
        .b2b-intro {
            background: #ffffff;
            padding: 90px 0 60px;
        }

        .b2b-intro h1 {
            font-size: 2.4rem;
            line-height: 1.3;
        }

        .b2b-content {
            padding: 80px 0;
            background: #f8fafc;
        }

        .content-box {
            background: #fff;
            border-radius: 22px;
            padding: 45px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        }

        .content-box h2 {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .content-box p {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.7;
        }

        .b2b-img {
            max-width: 85%;
        }

        /* Mobile */
        @media(max-width:768px) {
            .b2b-intro h1 {
                font-size: 1.8rem;
            }

            .content-box {
                padding: 30px;
            }
        }
    </style>


    <section class="bg-primary text-center baner-img m-0">
        <div class="container py-5">
            <h3 class="text-light mb-2">
                Start Selling on India’s Leading B2B Marketplace Today
            </h3>
            <p>Join Globpulse – India’s trusted B2B marketplace and connect with verified buyers and suppliers
                today.</p>
            <div class="text-center pt-5">
                @if (!empty(session('id')))
                    <a href="{{ route('product_add') }}">
                        <button class="btn btn-primary rounded-2 text-white fs-8 px-4 py-2">
                            Product List Now
                        </button>
                    </a>
                @else
                    <a href="{{ route('signup') }}">
                        <button class="btn btn-primary rounded-2 text-white fs-8 px-4 py-2">
                            Sign up for free now
                        </button>
                    </a>
                @endif
            </div>
        </div>
    </section>
    <style>
        .baner-img {
            background-color: #1a1a4c;
            background-image: url(../../assets/img/Singup-home.png);
            background-size: cover;
            background-position: center;
            color: white;
        }
    </style>

    <section class="b2b-why-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose Our Wholesale B2B Marketplace?</h2>
                <p class="text-muted">Our B2B marketplace platform is built to simplify wholesale trade. Businesses can
                    showcase
                    products, receive bulk inquiries, negotiate pricing, and close deals faster. With verified profiles
                    and
                    secure communication, Globpulse ensures trust and transparency in every transaction.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="b2b-card border">
                        <div class="icon-box">🔗</div>
                        <h5>Direct Connection</h5>
                        <p>Connect manufacturers, wholesalers and distributors without middlemen.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="b2b-card border">
                        <div class="icon-box">🛡️</div>
                        <h5>Verified Suppliers</h5>
                        <p>Trade confidently with verified and trusted sellers.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="b2b-card border">
                        <div class="icon-box">📈</div>
                        <h5>Business Growth</h5>
                        <p>Expand reach, increase sales and grow nationwide.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .b2b-why-section {
            padding: 50px 0;
            background: #f8fafc;
        }

        .b2b-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            transition: all .35s ease;
            position: relative;
            overflow: hidden;
        }

        .b2b-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            opacity: 0;
            transition: .35s;
            z-index: 0;
        }

        .b2b-card:hover::before {
            opacity: 1;
        }

        .b2b-card * {
            position: relative;
            z-index: 1;
        }

        .b2b-card:hover {
            transform: translateY(-10px);
        }

        .b2b-card h5 {
            font-weight: 600;
            margin-bottom: 12px;
        }

        .b2b-card p {
            color: #6b7280;
            font-size: 15px;
        }

        .b2b-card:hover h5,
        .b2b-card:hover p {
            color: #fff;
        }

        .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 20px;
            transition: .35s;
        }

        .b2b-card:hover .icon-box {
            background: #fff;
        }
    </style>

    <section class="bg-white pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="growth-card text-center">
                        <h2>Start Growing Your Business with Globpulse</h2>
                        <p>
                            Whether you are a manufacturer, exporter, importer, wholesaler, or supplier, Globpulse
                            provides a reliable B2B marketplace platform to grow your business. Create your profile,
                            list your products, and start receiving quality business inquiries today

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .b2b-growth-section {
            padding: 90px 0;
            /* background: #f8fafc; */
        }

        .growth-card {
            background: #f8eeee;
            border-radius: 22px;
            padding: 50px 45px;
            /* box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08); */
        }

        .growth-card h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .growth-card p {
            color: #6b7280;
            font-size: 15.5px;
            line-height: 1.7;
        }

        /* Mobile */
        @media(max-width:768px) {
            .growth-card {
                padding: 30px 25px;
            }

            .growth-card h2 {
                font-size: 1.5rem;
            }
        }
    </style>


    <section>
        <style>
            .faq-title {
                /* text-align: center; */
                /* font-weight: 600; */
                font-size: 24px;
                /* margin-bottom: 30px; */
                position: relative;
            }


            .faq-item {
                border-bottom: 1px solid #7e7a7a;
                padding: 5px 0;
                cursor: pointer;
            }

            .faq-question {
                /* font-size: 17px; */
                /* font-weight: 500; */
                color: #333;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .faq-answer {
                font-size: 14px;
                color: #555;
                margin-top: 10px;
                display: none;
            }

            .faq-icon {
                font-size: 25px;
                color: #007bff;
                transition: transform 0.3s;
            }

            .faq-item.active .faq-icon {
                color: #ff4b5c;
                transform: rotate(180deg);
            }

            .faq-item.active .faq-answer {
                display: block;
            }
        </style>




        <div class="container-fluid ">
            <div class="faq-container">
                <div class="text-center mb-3">
                    <h4 class="fs-5  pb-3">Frequently Asked Questions About B2B Marketplace
                    </h4>
                </div>

                <!-- FIRST 5 FAQs VISIBLE -->
                <div class="faq-item bg-white px-4" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">What is a B2B marketplace?

                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A B2B marketplace is an online platform where businesses buy and sell products or
                                services in bulk with other
                                businesses, enabling direct business-to-business trade.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">How does a B2B marketplace work?
                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A B2B marketplace works by matching buyers’ purchase requirements with relevant sellers,
                                allowing direct communication,
                                negotiation, and transaction between businesses.</li>

                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">Why is a B2B marketplace important for
                            businesses?
                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A B2B marketplace is important because it improves lead quality, reduces sourcing time,
                                lowers marketing costs, and
                                helps businesses scale trade efficiently.
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">What is the difference between a B2B marketplace
                            and a B2B directory?
                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A B2B directory only lists company details, while a B2B marketplace actively connects
                                buyers and sellers and generates
                                real trade opportunities.
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">What are the main benefits of using a B2B
                            marketplace?</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>The main benefits of a B2B marketplace include higher-quality leads, better conversion
                                rates, improved trust through
                                verification, global business visibility, and scalable trade growth</li>

                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">How is Globpulse different from other B2B
                            marketplaces?</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>Globpulse emphasises verified business profiles, quality inquiries, and industry-focused
                                matchmaking, which helps reduce
                                fake leads and increases meaningful business connections.</li>

                        </ul>
                    </div>
                </div>
                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">Is joining Globpulse free?</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>Globpulse offers free registration with additional premium options for increased
                                visibility, advanced features, and
                                priority support.
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">What is a wholesale marketplace?
                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A wholesale marketplace is an online platform where manufacturers, wholesalers, and
                                distributors sell products in bulk
                                to retailers and business buyers at wholesale prices.</li>

                        </ul>
                    </div>
                </div>
                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">Who should use a wholesale marketplace?
                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>Manufacturers, wholesalers, distributors, retailers, exporters, importers, and resellers
                                should use a wholesale marketplace to source products and expand sales channels.
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">What are the benefits of using a wholesale
                            marketplace?

                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A wholesale marketplace offers benefits such as bulk buying, competitive pricing,
                                verified suppliers, consistent product
                                availability, and scalable business growth.
                            </li>

                        </ul>
                    </div>
                </div>


                <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <h4 style="font-weight: 600; font-size: 16px;">What is the difference between a wholesale
                            marketplace and retail marketplace?
                        </h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <ul class="custom-list mx-auto" style="list-style-type: disc;">
                            <li>A wholesale marketplace focuses on bulk business-to-business transactions, while a
                                retail marketplace targets individual
                                consumers purchasing single units for personal use.</li>

                        </ul>
                    </div>
                </div>

                <!-- REMAINING FAQS (INITIALLY HIDDEN) -->
                <div id="more-faqs" style="display: none;">
                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">Are B2B and wholesale marketplaces relevant
                                beyond 2026?</h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>Yes, Globpulse is B2B, and wholesale marketplaces will remain highly relevant beyond
                                    2026 as businesses increasingly

                                    rely on digital platforms for verified sourcing, bulk trade, and global expansion.
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">What is an import export B2B marketplace?
                            </h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>An import-export B2B marketplace is an online platform that connects exporters,
                                    importers, manufacturers, and suppliers
                                    with verified international buyers and sellers for cross-border business trade.
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">How do importers benefit from a B2B
                                marketplace?
                            </h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>Importers benefit from a B2B marketplace by discovering verified suppliers,
                                    comparing products, reducing sourcing risks,
                                    and building reliable long-term supply partnerships.
                                    .</li>

                            </ul>
                        </div>
                    </div>

                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">Why is a B2B marketplace important for import
                                export businesses?
                            </h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>A B2B marketplace is important for import export businesses because it provides
                                    global visibility, verified trade

                                    partners, quality inquiries, and faster access to international markets</li>

                            </ul>
                        </div>
                    </div>

                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">What products are commonly traded on import
                                export B2B marketplaces?
                            </h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>Commonly traded products include industrial goods, machinery, textiles, agricultural
                                    products, FMCG items, chemicals,
                                    electronics, and raw materials</li>

                            </ul>
                        </div>
                    </div>

                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">Are B2B import export marketplaces relevant
                                in 2026 and beyond?</h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>Yes. In 2026 and beyond, B2B import export marketplaces remain highly relevant as
                                    businesses increasingly rely on
                                    digital platforms for global trade, verified sourcing, and efficient international
                                    partnerships.</li>

                            </ul>
                        </div>
                    </div>

                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">Why are B2B marketplaces the future of
                                wholesale and global trade?</h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>B2B marketplaces are the future of wholesale and global trade because they enable
                                    verified sourcing, bulk transactions,
                                    faster buyer–seller matching, and digital-first trade operations. By reducing
                                    intermediaries and improving trust, B2B
                                    marketplaces help businesses scale efficiently in domestic and international markets
                                    beyond 2026.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">Why is trust and verification the most
                                important factor for Globpulse in a B2B marketplace in 2026?
                            </h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>For Globpulse, trust and verification are critical in 2026 because they ensure
                                    genuine buyers and sellers, reduce fake
                                    inquiries, and create a secure B2B marketplace where businesses can trade
                                    confidently and build long-term relationships.

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="faq-item bg-white px-4 mt-3" onclick="toggleFAQ(this)">
                        <div class="faq-question">
                            <h4 style="font-weight: 600; font-size: 16px;">Why is Globpulse one of the largest B2B
                                marketplaces in India?
                            </h4>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <ul class="custom-list mx-auto" style="list-style-type: disc;">
                                <li>Globpulse is considered one of the largest B2B marketplaces in India because it
                                    offers live buyers and wholesalers,
                                    suppliers, integrated ERP and CRM support, 24/7 global customer care, and real-time
                                    product pricing with multi-currency
                                    display for all countries. The platform hosts over 155,000+ active products,
                                    supports the largest category-based B2B
                                    listings with daily SEO-optimised additions, and offers flexible membership options
                                    for small businesses and large
                                    enterprises. Globpulse is easily accessible through its Globpulse B2B marketplace
                                    applications, available on Android and
                                    iOS, making it simple for startups and growing businesses to start and scale
                                    globally.

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- TOGGLE BUTTON -->
                <div class="text-center mt-4">
                    <button class="btn btn-primary" id="toggleMoreBtn" onclick="toggleMoreFaqs()">Read
                        More</button>
                </div>
            </div>
            <script>
                function toggleFAQ(el) {
                    const answer = el.querySelector('.faq-answer');
                    const icon = el.querySelector('.faq-icon');
                    const isOpen = answer.style.display === 'block';

                    document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
                    document.querySelectorAll('.faq-icon').forEach(i => i.innerText = '+');

                    if (!isOpen) {
                        answer.style.display = 'block';
                        icon.innerText = '-';
                    }
                }

                function toggleMoreFaqs() {
                    const moreFaqs = document.getElementById('more-faqs');
                    const btn = document.getElementById('toggleMoreBtn');

                    if (moreFaqs.style.display === 'none') {
                        moreFaqs.style.display = 'block';
                        btn.innerText = 'Show Less';
                    } else {
                        moreFaqs.style.display = 'none';
                        btn.innerText = 'Read More';
                        document.querySelector('.faq-container').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            </script>

        </div>
    </section>

    <livewire:front.layout.footer />




</div>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://www.globpulse.com/#organization",
      "name": "GlobPulse",
      "url": "https://www.globpulse.com",
      "logo": "https://www.globpulse.com/logo.png",
      "description": "GlobPulse is an India-based B2B marketplace for import export and wholesale trade, connecting manufacturers, suppliers, exporters and global buyers.",
      "sameAs": [
        "https://www.facebook.com/globpulse",
        "https://www.linkedin.com/company/globpulse"
      ]
    },
    {
      "@type": "WebSite",
      "@id": "https://www.globpulse.com/#website",
      "url": "https://www.globpulse.com",
      "name": "GlobPulse B2B Marketplace",
      "publisher": {
        "@id": "https://www.globpulse.com/#organization"
      },
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://www.globpulse.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "Service",
      "@id": "https://www.globpulse.com/b2bmarketplace#service",
      "name": "Import Export B2B Marketplace",
      "serviceType": "B2B Import Export Marketplace",
      "provider": {
        "@id": "https://www.globpulse.com/#organization"
      },
      "areaServed": {
        "@type": "Place",
        "name": "Worldwide"
      },
      "description": "GlobPulse provides a global B2B marketplace platform for import export businesses, wholesale trade, manufacturers, suppliers, exporters and buyers worldwide.",
      "url": "https://www.globpulse.com/b2bmarketplace"
    }
  ]
}
</script>