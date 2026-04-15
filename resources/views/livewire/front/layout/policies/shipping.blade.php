<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Globpulse, India B2B Marketplace for Wholesale, Import & Export</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Custom Policy Styles -->
    <style>
        body {
            background: #f8f9fa;
        }

        .policy-container {
            max-width: 1200px;
            margin: auto;
        }

        .policy-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .policy-title {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .policy-date {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .policy-section {
            margin-bottom: 25px;
        }

        .policy-section h5 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .policy-section p {
            color: #555;
            line-height: 1.7;
        }

        .policy-section ul {
            padding-left: 18px;
        }

        .policy-section li {
            margin-bottom: 6px;
            color: #555;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <livewire:front.layout.header />

    <!-- Content -->
    <div class="container py-5">
        <div class="policy-container">
            <div class="policy-card">

                <h1 class="policy-title">Shipping & Delivery Policy</h1>
                <p class="policy-date">Effective Date: 23 March 2026</p>

                <div class="policy-section">
                    <h5>Introduction</h5>
                    <p>
                        Globpulse is a B2B marketplace platform and does not handle shipping directly.
                        All logistics are managed between buyers, sellers, and third-party carriers.
                    </p>
                </div>

                <div class="policy-section">
                    <h5>Seller Responsibilities</h5>
                    <ul>
                        <li>Provide accurate shipping timelines</li>
                        <li>Share tracking details within 24 hours</li>
                        <li>Ensure proper packaging and documentation</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h5>Buyer Responsibilities</h5>
                    <ul>
                        <li>Provide correct delivery details</li>
                        <li>Handle import duties and compliance</li>
                        <li>Inspect goods upon delivery</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h5>Delivery Timelines</h5>
                    <p>Domestic shipments typically take 2–10 business days depending on location.</p>
                </div>

                <div class="policy-section">
                    <h5>International Shipping</h5>
                    <p>
                        International shipments are subject to customs clearance, duties, and regulations.
                        Delivery timelines may vary based on destination country and logistics provider.
                    </p>
                </div>

                <div class="policy-section">
                    <h5>Delays & Damages</h5>
                    <p>
                        Globpulse is not responsible for delays caused by logistics providers or customs.
                        Buyers should report damages immediately upon delivery.
                    </p>
                </div>

                <div class="policy-section">
                    <h5>Contact</h5>
                    <p>Email: support@globpulse.com</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <livewire:front.layout.footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>