<div>
    <style>
        :root {
            --paytm-blue: #00baf2;
            --paytm-navy: #002b5c;
            --success-green: #21cc7a;
            --soft-bg: #f5f9ff;
        }

        .payment-card {
            background: #ffffff;
            border-radius: 30px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 43, 92, 0.15);
            overflow: hidden;
        }

        /* Header */
        .success-header {
            background: linear-gradient(180deg, #f0faff 0%, #ffffff 100%);
            padding: 40px 20px 20px;
            text-align: center;
        }

        .main-checkmark {
            width: 80px;
            height: 80px;
            background: var(--success-green);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 45px;
            box-shadow: 0 10px 20px rgba(33, 204, 122, 0.3);
        }

        .amount-display {
            font-size: 3rem;
            font-weight: 800;
            color: var(--paytm-navy);
            margin-top: 10px;
        }

        /* Receipt */
        .receipt-info {
            background: var(--soft-bg);
            border-radius: 20px;
            padding: 20px;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 0.95rem;
        }

        .receipt-row:not(:last-child) {
            border-bottom: 1px dashed rgba(0, 43, 92, 0.1);
        }

        .label {
            color: #64748b;
            font-weight: 500;
        }

        .val {
            color: var(--paytm-navy);
            font-weight: 700;
        }

        /* Button */
        .btn-done {
            background: var(--paytm-blue);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-weight: 700;
            width: 100%;
        }

        .btn-done:hover {
            background: var(--paytm-navy);
            color: #fff;
        }

        /* wrapper */
        /* Animation Keyframes */
        @keyframes scalePop {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes pulseInfinite {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }

            100% {
                transform: scale(1.8);
                opacity: 0;
            }
        }

        /* Wrapper to center everything */
        .success-ring-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        /* The Green Circle */
        .main-checkmark {
            width: 80px;
            height: 80px;
            background: var(--success-green);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
            position: relative;
            z-index: 2;
            /* Sits above the pulse */
            box-shadow: 0 10px 20px rgba(33, 204, 122, 0.3);
            animation: scalePop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* The Pulsing Ring */
        .success-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--success-green);
            border-radius: 50%;
            opacity: 0.3;
            z-index: 1;
            animation: pulseInfinite 2s infinite;
        }
    </style>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">

                <div class="card border-0 payment-card">

                    <div class="success-header">
                        <div class="success-ring-wrapper">
                            <div class="success-ring"></div>

                            <div class="main-checkmark mb-1">
                                <i class="bi bi-check-lg"></i>
                            </div>
                        </div>

                        <h4 class="fw-bold mt-3 mb-0">
                            Payment Successful
                        </h4>

                        @if ($paymentid)
                            <p class="text-muted mt-2 small">
                                Transaction ID: GFE-TXN-{{ $paymentid }}
                            </p>
                        @endif

                        <div class="amount-display">
                            ₹{{ number_format($amount, 2) }}
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="receipt-info mb-3">
                            <div class="receipt-row">
                                <span class="label">Paid To</span>
                                <span class="val">GFE Business Group</span>
                            </div>

                            <div class="receipt-row">
                                <span class="label">Customer</span>
                                <span class="val">{{ $lead->name ?? 'Premium Member' }}</span>
                            </div>

                            <div class="receipt-row">
                                <span class="label">Phone</span>
                                <span class="val">{{ $lead->phonenumber }}</span>
                            </div>
                            <div class="receipt-row">
                                <span class="label">Date & Time</span>
                                <span class="val">
                                    {{ $paid_at ? \Carbon\Carbon::parse($paid_at)->format('d M Y, h:i A') : 'N/A' }}
                                </span>
                            </div>

                        </div>

                        <a href="https://erp.gfebusiness.org/app_qr.html" class="btn btn-done">
                            Download application →
                        </a>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
