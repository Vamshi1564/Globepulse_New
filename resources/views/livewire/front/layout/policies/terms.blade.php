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

    <!-- Custom Styles -->
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

            <h1 class="policy-title">Terms & Conditions</h1>
            <p class="policy-date">Effective Date: 23 March 2026</p>

            <div class="policy-section">
                <h5>Acceptance</h5>
                <p>By using Globpulse, you agree to these terms.</p>
            </div>

            <div class="policy-section">
                <h5>Platform Nature</h5>
                <p>Globpulse is a B2B marketplace and does not directly participate in transactions.</p>
            </div>

            <div class="policy-section">
                <h5>User Responsibilities</h5>
                <ul>
                    <li>Provide accurate details</li>
                    <li>Follow applicable laws</li>
                    <li>Avoid misuse of the platform</li>
                </ul>
            </div>

            <div class="policy-section">
                <h5>Seller Obligations</h5>
                <ul>
                    <li>Provide correct product information</li>
                    <li>Ensure legal and regulatory compliance</li>
                </ul>
            </div>

            <div class="policy-section">
                <h5>Buyer Obligations</h5>
                <ul>
                    <li>Perform due diligence before transactions</li>
                    <li>Honor commitments made with sellers</li>
                </ul>
            </div>

            <div class="policy-section">
                <h5>Limitation of Liability</h5>
                <p>Globpulse is not responsible for disputes between buyers and sellers.</p>
            </div>

            <div class="policy-section">
                <h5>Governing Law</h5>
                <p>This agreement is governed by the laws of India.</p>
            </div>

        </div>
    </div>
</div>

<livewire:front.layout.footer />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>