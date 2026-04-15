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
            padding: 35px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.08);
        }

        .policy-title {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .policy-date {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .policy-section {
            margin-bottom: 25px;
        }

        .policy-section h5 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #222;
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

<livewire:front.layout.header />

<div class="container py-5">
    <div class="policy-container">
        <div class="policy-card">

            <h1 class="policy-title">Returns, Refunds & Cancellation Policy</h1>
            <p class="policy-date">Effective Date: 23 March 2026</p>

            <div class="policy-section">
                <h5>Platform Role</h5>
                <p>
                    Globpulse acts as a marketplace platform and does not directly handle 
                    returns or refunds between buyers and sellers.
                </p>
            </div>

            <div class="policy-section">
                <h5>Cancellation</h5>
                <p>
                    Order cancellation depends on the seller’s individual policy and 
                    the stage of order processing.
                </p>
            </div>

            <div class="policy-section">
                <h5>Returns</h5>
                <p>
                    Returns are accepted only in cases such as damaged goods or 
                    non-conforming products, subject to seller approval.
                </p>
            </div>

            <div class="policy-section">
                <h5>Refunds</h5>
                <ul>
                    <li>Refunds are handled directly by sellers</li>
                    <li>Processed within agreed timelines</li>
                    <li>May vary depending on seller policies</li>
                </ul>
            </div>

            <div class="policy-section">
                <h5>Disputes</h5>
                <p>
                    Any disputes related to refunds or returns must be resolved 
                    directly between the buyer and seller.
                </p>
            </div>

            <div class="policy-section">
                <h5>Contact</h5>
                <p>Email: support@globpulse.com</p>
            </div>

        </div>
    </div>
</div>

<livewire:front.layout.footer />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>