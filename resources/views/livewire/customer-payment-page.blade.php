<div>
    {{-- Be like water. --}}


    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- 
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8fafc, #eef2ff);
            min-height: 100vh;
        }

        .payment-wrapper {
            max-width: 1000px;
            margin: auto;
        }

        .checkout-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, .08);
            overflow: hidden;
        }

        .secure-banner {
            background: #0f172a;
            color: #fff;
            text-align: center;
            padding: 12px;
            font-size: .75rem;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .client-summary {
            background: #f8fafc;
            border-radius: 16px;
            padding: 18px;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #fff;
            font-size: .9rem;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .75rem;
        }

        .value {
            font-weight: 700;
        }

        .price-box {
            text-align: center;
            padding: 35px 20px;
            background: linear-gradient(180deg, #ffffff, #f1f5f9);
            border-radius: 16px;
            margin: 20px 0;
        }

        .currency {
            font-size: 1.5rem;
            font-weight: 700;
            vertical-align: top;
        }

        .amount {
            font-size: 3.5rem;
            font-weight: 800;
        }

        .paybtn {
            width: 100%;
            padding: 16px;
            background: #10b981;
            border: none;
            color: #fff;
            font-size: 1.1rem;
            border-radius: 14px;
            font-weight: 700;
            transition: .3s;
        }

        .paybtn:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .security-footer {
            border-top: 1px solid #e2e8f0;
            margin-top: 20px;
            padding-top: 18px;
            font-size: .75rem;
            color: #64748b;
        }

        @media(max-width:768px) {
            .amount {
                font-size: 2.8rem;
            }
        }
    </style>

    <div class="container py-5 payment-wrapper">
        <div class="row justify-content-center justify-content-between">
            <!-- Product & Services -->
            <!-- LEFT COLUMN: Product & Services (The New UI) -->
            <div class="col-lg-4">
                <div class="service-manifest">
                    <span class="product-badge">Active Product</span>
                    <h2 class="product-title">{{ $draft->product->description ?? 'Premium Subscription' }}</h2>
                    
                    <p class="text-muted small fw-bold mb-3 text-uppercase">Included Services</p>
                    
                    <!-- Loop Services -->
                    @foreach ($services as $item)
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <div class="service-info">
                            <label>Service Plan</label>
                            <span>{{ $item->service->name ?? 'Service Name' }}</span>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- If no services -->
                    @if (count($services) == 0)
                    <div class="service-item">
                        <div class="service-icon" style="background: var(--slate-100); color: var(--slate-500);">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="service-info">
                            <label>Notice</label>
                            <span>Standard Package</span>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <div class="col-lg-6">

                <div class="checkout-card">

                    <!-- Secure Banner -->
                    <div class="secure-banner">
                        <i class="bi bi-shield-lock-fill text-success"></i>
                        AUTHORIZED & ENCRYPTED PAYMENT
                    </div>

                    <div class="p-4 p-md-5">

                        <h5 class="fw-bold mb-1">Payment Review</h5>
                        <p class="text-muted small mb-4">Secure service activation payment</p>

                        <!-- Client Details -->
                        <div class="client-summary mb-4">

                            <div class="data-row">
                                <span class="label">Client</span>
                                <span class="value">{{ $draft->customer->name }}</span>
                            </div>

                            <div class="data-row">
                                <span class="label">Email</span>
                                <span class="value">{{ $draft->customer->email }}</span>
                            </div>

                            <div class="data-row">
                                <span class="label">Phone</span>
                                <span class="value">{{ $draft->customer->phonenumber }}</span>
                            </div>

                        </div>

                        <!-- Amount -->
                        <div class="price-box">
                            <p class="fw-bold text-primary small mb-1">
                                PAYABLE AMOUNT
                            </p>

                            <span class="currency">₹</span>
                            <span class="amount">
                                {{ number_format($draft->payable_amount, 2) }}
                            </span>

                            <p class="text-muted small mt-2 mb-0">
                                Secure Service Activation Payment
                            </p>
                        </div>

                        <!-- Pay Button -->
                        <button id="payBtn" class="paybtn">
                            Pay Securely Now
                            <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                        </button>

                        <!-- Footer -->
                        <div class="security-footer text-center">
                            <i class="bi bi-shield-check text-success"></i>
                            Payments protected with 256-bit encryption
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <style>
        /* KEEPING YOUR EXISTING CSS */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8fafc, #eef2ff);
            min-height: 100vh;
        }

        .payment-wrapper {
            max-width: 1000px;
            margin: auto;
        }

        .checkout-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, .08);
            overflow: hidden;
        }

        .secure-banner {
            background: #0f172a;
            color: #fff;
            text-align: center;
            padding: 12px;
            font-size: .75rem;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .client-summary {
            background: #f8fafc;
            border-radius: 16px;
            padding: 18px;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #fff;
            font-size: .9rem;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .75rem;
        }

        .value {
            font-weight: 700;
        }

        .price-box {
            text-align: center;
            padding: 35px 20px;
            background: linear-gradient(180deg, #ffffff, #f1f5f9);
            border-radius: 16px;
            margin: 20px 0;
        }

        .currency {
            font-size: 1.5rem;
            font-weight: 700;
            vertical-align: top;
        }

        .amount {
            font-size: 3.5rem;
            font-weight: 800;
        }

        .paybtn {
            width: 100%;
            padding: 16px;
            background: #10b981;
            border: none;
            color: #fff;
            font-size: 1.1rem;
            border-radius: 14px;
            font-weight: 700;
            transition: .3s;
        }

        .paybtn:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .security-footer {
            border-top: 1px solid #e2e8f0;
            margin-top: 20px;
            padding-top: 18px;
            font-size: .75rem;
            color: #64748b;
        }

        /* NEW PROFICIENT UI STYLES FOR LEFT COLUMN */
        .service-sidebar {
            padding: 10px;
        }

        .product-label-badge {
            display: inline-block;
            padding: 6px 16px;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }

        .main-product-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1.2;
            margin-bottom: 2rem;
        }

        /* SERVICES GRID WITHOUT BOOTSTRAP GRID */
        .service-list-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* SMALLER SERVICE CARD */
        .service-card-modern {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;

            /* two cards per row */
            width: calc(50% - 5px);
        }

        /* smaller icon */
        /* .service-icon-wrapper {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            margin-right: 10px;
            font-size: 1rem;
        } */

        /* smaller text */
        /* .service-details label {
            font-size: 0.6rem;
        } */

        /* .service-details span {
            font-size: 0.85rem;
        } */


        .service-card-modern:hover {
            border-color: #cbd5e1;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .service-icon-wrapper {
            width: 42px;
            height: 42px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            color: #10b981;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .service-details label {
            display: block;
            font-size: 0.65rem;
            text-transform: uppercase;
            font-weight: 700;
            color: #94a3b8;
            margin-bottom: 2px;
            letter-spacing: 0.5px;
        }

        .service-details span {
            display: block;
            font-weight: 700;
            color: #334155;
            font-size: 0.95rem;
        }

        .empty-service-state {
            border: 2px dashed #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            color: #94a3b8;
        }

        @media(max-width:768px) {
            .amount {
                font-size: 2.8rem;
            }

            .main-product-title {
                font-size: 1.75rem;
            }

            .service-card-modern {
                width: 100%;
            }
        }

        .product-header-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #ffffff;
            border-radius: 16px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            margin-bottom: 18px;
        }

        .product-icon {
            width: 50px;
            height: 50px;
            background: #ecfdf5;
            color: #10b981;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .product-status {
            font-size: 0.7rem;
            font-weight: 700;
            color: #4338ca;
            background: #e0e7ff;
            padding: 4px 10px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 6px;
        }

        .product-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
        }

        /* ===== EXPIRED STATE ===== */
        /* ===== EXPIRED FULL PAGE STATE ===== */
        .expired-page {
            position: relative;
        }

        .expired-page .blur-content {
            filter: blur(3px);
            pointer-events: none;
            user-select: none;
            opacity: 0.6;
        }

        /* overlay */
        /* .expired-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
        } */
        .expired-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .expired-box {
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            text-align: center;
            max-width: 380px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .25);
        }
    </style>

    @if ($draft->customer->phone_verified == 0 || $draft->customer->email_verified == 0)
        <livewire:customer-verification-form :draftId="$draftId" />
    @endif

    <div class="page-content">
        <div class="container py-5 payment-wrapper {{ $isExpired ? 'expired-page' : '' }}">
            <div class="row justify-content-center justify-content-between align-items-start blur-content">
                @if (!$isInvoice)
                    <!-- LEFT COLUMN: NEW PROFICIENT UI -->
                    <div class="col-lg-5 mb-5 mb-lg-0">
                        <div class="service-sidebar">
                            {{-- <div class="product-label-badge">
                        <i class="bi bi-patch-check-fill me-1"></i> Active Product
                    </div>

                    <h1 class="main-product-title">
                        {{ $draft->product->description ?? 'Premium Subscription' }}
                    </h1> --}}
                            <div class="product-header-card">
                                <div class="product-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>

                                <div class="product-info">
                                    <span class="product-status">
                                        <i class="bi bi-patch-check-fill me-1"></i>
                                        Active Product
                                    </span>

                                    <h2 class="product-title">
                                        {{ $draft->product->description ?? 'Premium Subscription' }}
                                    </h2>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-uppercase fw-800 text-slate-500 mb-3"
                                    style="font-size: 0.75rem; letter-spacing: 1px; color: #64748b;">
                                    What's included in your plan:
                                </h6>

                                <div class="service-list-container">
                                    <!-- Loop Services -->
                                    @forelse ($services as $item)
                                        <div class="service-card-modern">
                                            <div class="service-icon-wrapper">
                                                <i class="bi bi-check2-circle"></i>
                                            </div>
                                            <div class="service-details">
                                                <label>Service Plan</label>
                                                <span>{{ $item->service->name ?? 'Service Name' }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <!-- If no services -->
                                        <div class="empty-service-state">
                                            <i class="bi bi-box-seam d-block mb-2" style="font-size: 1.5rem;"></i>
                                            <span class="small fw-bold">Standard Activation Package</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top d-none d-lg-block">
                                <p class="text-muted small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Access to all features will be granted immediately after successful payment.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- RIGHT COLUMN: UNCHANGED AS REQUESTED -->
                <div class="col-lg-6 mx-auto">
                    <div class="checkout-card">

                        <!-- Secure Banner -->
                        <div class="secure-banner">
                            <i class="bi bi-shield-lock-fill text-success"></i>
                            AUTHORIZED & ENCRYPTED PAYMENT
                        </div>

                        <div class="p-4 p-md-5">
                            <h5 class="fw-bold mb-1">Payment Review</h5>
                            <p class="text-muted small mb-4">Secure service activation payment</p>

                            <!-- Client Details -->
                            <div class="client-summary mb-4">
                                <div class="data-row flex-wrap">
                                    <span class="label">Client</span>
                                    <span class="value">{{ $draft->customer->name ?? 'N/A' }}</span>
                                </div>
                                <div class="data-row flex-wrap">
                                    <span class="label">Email</span>
                                    <span class="value">{{ $draft->customer->email ?? 'N/A' }}</span>
                                </div>
                                <div class="data-row flex-wrap">
                                    <span class="label">Phone</span>
                                    <span class="value">{{ $draft->customer->phonenumber ?? '0' }}</span>
                                </div>
                            </div>

                            <!-- Amount -->
                            <div class="price-box">
                                <p class="fw-bold text-primary small mb-1">PAYABLE AMOUNT</p>
                                <span class="currency">₹</span>
                                <span class="amount">
                                    {{ number_format($draft->payable_amount, 2) }}
                                </span>
                                <p class="text-muted small mt-2 mb-0">Secure Service Activation Payment</p>
                            </div>

                            <!-- Pay Button -->
                            <button id="payBtn" class="paybtn" @if ($isExpired) disabled @endif>
                                Pay Securely Now
                                <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                            </button>




                            <!-- Footer -->
                            <div class="security-footer text-center">
                                <i class="bi bi-shield-check text-success"></i>
                                Payments protected with 256-bit encryption
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if ($isExpired)
                <div class="expired-overlay">
                    <div class="expired-box">
                        <i class="bi bi-clock-history text-danger" style="font-size:2rem;"></i>
                        <h5>Payment Link Expired</h5>
                        <p>
                            This payment link is no longer valid.<br>
                            Please contact support to regenerate payment.
                        </p>
                    </div>
                </div>
            @endif --}}

            @if ($isExpired)
                <div class="expired-overlay">
                    <div class="bg-white p-4 text-center shadow-lg"
                        style="max-width:360px; width:92%; border-radius:18px;">

                        <!-- Icon circle -->
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width:58px;height:58px;border-radius:50%;background:#fee2e2;">
                            <i class="bi bi-clock-history text-danger" style="font-size:22px;"></i>
                        </div>

                        <!-- Title -->
                        <h5 class="fw-bold mb-2">
                            Payment Session Expired
                        </h5>

                        <!-- Description -->
                        <p class="text-muted fs-9 fw-semibold mb-3">
                            This payment session has expired.
                            Please request a Regenerate payment link.
                        </p>


                        <!-- Info box -->
                        <div class="alert alert-light border small fw-bold fs-8 text-black mb-0">
                            <i class="bi bi-info-circle me-1"></i>
                            For assistance, contact your support team.
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>




    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        const PAYMENT_TOKEN = "{{ request()->route('token') }}";
    </script>
    <script>
        document.getElementById('payBtn').onclick = function() {

            fetch("/razorpay/create-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        draft_id: "{{ $draft->id }}"
                    })
                })
                .then(res => res.json())
                .then(data => {

                    var options = {
                        "key": "{{ env('RZP_API_KEY') }}",
                        "amount": data.amount,
                        "currency": "INR",
                        "name": "GFE TEAM",
                        "description": "Service Payment",
                        "order_id": data.order_id,

                        // 🟡 ADD PREFILL (BEST UX)
                        "prefill": {
                            "name": "{{ $draft->customer->name ?? 'N/A' }}",
                            "email": "{{ $draft->customer->email ?? 'N/A' }}",
                            "contact": "{{ $draft->customer->phonenumber ?? 0 }}"
                        },


                        // "handler": function(response) {
                        //     alert("Payment successful. We are processing your order.");
                        // }

                        handler: function() {
                            // ✅ DIRECT REDIRECT
                            window.location.href = "/payment/success/{{ $draft->id }}/" + PAYMENT_TOKEN;
                        }
                    };

                    var rzp = new Razorpay(options);
                    rzp.open();
                });
        }
    </script>

    @if (session()->has('message'))
        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="alert">
            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3" role="alert"
            id="alert">
            <span class="fas fa-cross-circle text-black fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
