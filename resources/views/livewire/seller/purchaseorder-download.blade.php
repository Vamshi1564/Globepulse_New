<div>

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }

        .address-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .address-table td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .address-table td:first-child {
            width: 40%;
        }

        .reference {
            margin: 15px 0;
            /* font-weight: bold; */
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .details {
            margin: 20px 0;
        }

        .details div {
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 30px;
            font-style: italic;
        }

        .signature {
            margin-top: 50px;
        }
    </style>


    <!-- Success message (hidden by default) -->
    <div id="successMessage"
        class="d-none alert w-25 ms-auto alert-success alert-dismissible fade show mt-3 position-relative px-3 py-2"
        role="alert">
        <i class="fas fa-check-circle me-2"></i>
        PDF downloaded successfully!
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}

        <!-- Progress Bar -->
        <div class="progress mt-2">
            <div id="progressBar" class="progress-bar bg-success" role="progressbar"
                style="width: 100%; transition: width 2s linear;"></div>
        </div>
    </div>

    <div class="container">
        @if($purchaseOrder)
            <div class="header invoice-title">
                <h1>PURCHASE ORDER</h1>
            </div>

            <div class="text-end">
                <button class="btn btn-success btn-sm mb-3 " type="button" id="downloadPdfBtn">
                    <i class="fa-solid fa-download me-2"></i>Download
                </button>
            </div>

            <table class="address-table">
                <tr>
                    <td>
                        <p><strong>To:</strong> {{ $purchaseOrder->company_name ?? 'XYZ International Pvt. Ltd.' }}<br></p>
                        <p><strong>Address:</strong>
                            {{ $purchaseOrder->company_address ?? '123 Business Street, Mumbai, India' }}<br></p>
                        <p><strong>Email:</strong> {{ $purchaseOrder->company_email ?? 'contact@xyzintl.com' }}</p>
                        <p><strong>Contact Person / Designation:</strong>
                            {{ $purchaseOrder->contact_person ?? 'Mr. John Doe / Sales Manager' }}</p>
                        <p><strong>Company Registration No.:</strong>
                            {{ $purchaseOrder->company_registration ?? 'XYZ123456789' }}</p>
                    </td>
                    <td>
                        <p><strong>PO No.:</strong> {{ $purchaseOrder->po_number }}<br></p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($purchaseOrder->po_date)->format('d-M-Y') }}</p>
                    </td>
                </tr>
            </table>

            <p>Dear Sir,</p>

            @if($purchaseOrder->invoice_number)
                <div class="reference">
                    <strong>Ref:</strong> Your Proforma Invoice No. {{ $purchaseOrder->invoice_number }}<br>
                    <strong>Dated:</strong> {{ \Carbon\Carbon::parse($purchaseOrder->invoice_date)->format('d-M-Y') }}
                </div>
            @endif

            <p>We are pleased to place an order with your company for the supply of agricultural products as per
                the following details:</p>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Commodity</th>
                        <th>Grade & Specification</th>
                        <th>Quantity</th>
                        <th>Rate<span style="font-size: 13px">({{ $purchaseOrder->currency ?? 'USD' }})</span></th>
                        <th>Amount<span style="font-size: 13px">({{ $purchaseOrder->currency ?? 'USD' }})</span></th>
                        <th>Payment Terms</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $purchaseOrder->sr_no ?? 1 }}</td>
                        <td>{{ $purchaseOrder->commodity }}</td>
                        <td>{{ $purchaseOrder->grade_specification }}</td>
                        <td>{{ $purchaseOrder->quantity }} kg</td>
                        <td>{{ $currencySymbol }} {{ number_format($purchaseOrder->rate, 2) }}/kg</td>
                        <td>{{ $currencySymbol }} {{ number_format($purchaseOrder->amount, 2) }}</td>
                        <td>{{ $purchaseOrder->payment_terms }}</td>
                    </tr>
                    <tr>
                        <td colspan="5"><strong>Total</strong></td>
                        <td><strong>{{ $currencySymbol }} {{ number_format($purchaseOrder->amount, 2) }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="details">
                <div><strong>Delivery Address:</strong>
                    {{ $purchaseOrder->delivery_address ?? 'ABC Importers Ltd., 789 Trade Ave, New York, USA' }}</div>
                <div><strong>Billing Address:</strong>
                    {{ $purchaseOrder->billing_address ?? 'DEF Trading Co., 456 Commerce St, Los Angeles, USA' }}</div>
                @if($purchaseOrder->gst_number)
                    <div><strong>GST No.:</strong> {{ $purchaseOrder->gst_number }}</div>
                @endif
                <div><strong>Packing Details:</strong> {{ $purchaseOrder->packing_details ?? '50 Cartons, Vacuum-Sealed' }}
                </div>
                <div><strong>Labeling Instructions:</strong>
                    {{ $purchaseOrder->labeling_instructions ?? 'Product Name, Batch No., Expiry Date' }}</div>
                <div><strong>Payment Terms:</strong>
                    {{ $purchaseOrder->payment_terms ?? 'FOB (Free on Board), 50% Advance Payment' }}</div>
                <div><strong>Inspection:</strong>
                    {{ $purchaseOrder->inspection_requirements ?? 'SGS Certification Required' }}</div>
                <div><strong>Test Reports:</strong>
                    {{ $purchaseOrder->test_report_requirements ?? 'Quality and Pesticide Test Reports Mandatory' }}</div>
                <div><strong>Delivery Time:</strong> {{ $purchaseOrder->delivery_timeframe ?? '15 Days from PO Date' }}
                </div>
            </div>

            <div class="footer">
                <p>We look forward to a successful business relationship and the timely delivery of the ordered products.
                </p>
                <p>Thank you for your prompt attention to this matter.</p>
            </div>

            <div class="signature">
                <p>Thanking you,</p>
                <p><strong>GFE-Portal</strong></p>
                <p>Signature: _________________________</p>
            </div>
        @else
            <div class="alert alert-warning">
                No purchase order found for this customer.
            </div>
        @endif
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <script>
            document.getElementById('downloadPdfBtn').addEventListener('click', function () {
                // Get the invoice element
                const invoiceElement = document.querySelector('.invoice-title').parentElement;
                const downloadBtn = document.getElementById('downloadPdfBtn');
                const spinner = document.getElementById("loadingSpinner");
                const successMsg = document.getElementById("successMessage");
                const progressBar = document.getElementById("progressBar");

                // Hide unnecessary elements before generating PDF
                downloadBtn.style.display = 'none';
                spinner.style.display = 'none';
                successMsg.style.display = 'none';
                progressBar.style.display = 'none';

                // Configuration options for PDF generation
                const opt = {
                    margin: 10,
                    filename: 'PurchaseOrder_Invoice.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                // Generate PDF
                html2pdf().set(opt).from(invoiceElement).save().then(() => {
                    // Show button & other UI elements after PDF generation
                    downloadBtn.style.display = 'block';
                    spinner.style.display = 'block';
                    successMsg.style.display = 'block';
                    progressBar.style.display = 'block';
                });

                // Show loading state
                spinner.classList.remove("d-none");
                this.setAttribute("disabled", "true"); // Disable button while processing

                // Simulate PDF generation (replace this with actual PDF logic)
                setTimeout(() => {
                    // Hide loading spinner
                    spinner.classList.add("d-none");
                    this.removeAttribute("disabled"); // Enable button again

                    // Show success message
                    successMsg.classList.remove("d-none");

                    // Reset and start the progress bar animation
                    progressBar.style.width = "100%";
                    setTimeout(() => {
                        progressBar.style.width = "0%"; // Shrinks progress bar over 3 seconds
                    }, 10);

                    // Auto-hide success message after 3 seconds
                    setTimeout(() => {
                        successMsg.classList.add("d-none");
                    }, 2000);
                }, 1500);
            });

        </script>
    </div>


</div>