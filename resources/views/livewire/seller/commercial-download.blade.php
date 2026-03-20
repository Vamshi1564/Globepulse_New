<div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 14px;
        }

        .invoice-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px 8px;
            text-align: left;
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        .terms-list {
            margin-left: 5px;
            padding-left: 20px;
        }

        .terms-list li {
            margin-bottom: 3px;
        }

        .declaration {
            margin-top: 15px;
            font-style: italic;
        }

        .total-row {
            font-weight: bold;
        }

        .double-line {
            border-top: 3px double black;
            margin: 10px 0;
        }

        .text-right {
            text-align: right;
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

    <div>

        <div class="invoice-title">COMMERCIAL INVOICE</div>

        <div class="text-end">
            <button class="btn btn-success btn-sm mb-3 " type="button" id="downloadPdfBtn">
                <i class="fa-solid fa-download me-2"></i>Download
            </button>
        </div>
        <!-- Loading spinner (hidden by default) -->
        <div id="loadingSpinner" class="d-none text-center my-3">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted mt-2">Generating PDF...</p>
        </div>

        @php
            $invoice = $invoices->first(); // Get only the first invoice
        @endphp

        <table border="1">
            <tr>
                <td rowspan="4" colspan="5"><strong>Exporter:</strong> <br /> {{ $invoice->exporter }} <br />
                    {{ $invoice->exporter_address }} </td>
                <td colspan="2"><strong>Proforma Invoice No.:</strong> {{ $invoice->invoice_no }}</td>
                <td rowspan="2" colspan="3"><strong>Exporter Reference:</strong> {{ $invoice->exporter_reference }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Date:</strong> {{ $invoice->invoice_date }}</td>
            </tr>
            <tr>
                <td rowspan="" colspan="4"><strong>Buyer's Order No.:</strong> {{ $invoice->buyer_order_no }}
                </td>
            </tr>
            <tr>
                <td colspan="4"><strong>Buyer's Order Date:</strong>{{ $invoice->buyer_order_date }} </td>
            </tr>

            <tr>
                <td colspan="5"><strong>Consignee:</strong> {{ $invoice->consignee }}</td>
                <td colspan="4"><strong>Buyer other than consignee:</strong> {{ $invoice->other_consignee }}</td>
            </tr>
            <tr>
                <td colspan="5"><strong>Notify Party:</strong> {{ $invoice->notify_party }}</td>
                <td colspan="2"><strong>Country of Origin:</strong> {{ $invoice->origin_country }}</td>
                <td colspan="2"><strong>Country of Final Destination:</strong> {{ $invoice->destination_country }}</td>
            </tr>

            <tr>
                <td colspan="3"><strong>Pre Carriage by:</strong> {{ $invoice->pre_carriage }}</td>
                <td colspan="2"><strong>Place of Receipt:</strong> {{ $invoice->receipt_place }}</td>
                <td rowspan="3" colspan="4"><strong>Terms of Delivery & Payment:</strong> {{ $invoice->terms }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Vessel / Flight No.:</strong> {{ $invoice->vessel_flight_no }}</td>
                <td colspan="2"><strong>Port of Loading:</strong> {{ $invoice->port_loading }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Port of Discharge:</strong> {{ $invoice->port_discharge }}</td>
                <td colspan="2"><strong>Final Destination:</strong> {{ $invoice->final_destination }}</td>
            </tr>

            <tr>
                <td colspan="3"><strong>Marks & No.:</strong> {{ $invoice->marks_no }}</td>
                <td rowspan="2" colspan="2"><strong>No. & kind of Pkgs:</strong> {{ $invoice->kind_pkg }}</td>
                <td rowspan="2" colspan="3"><strong>Description of Goods:</strong> {{ $invoice->description_goods }}
                </td>
            </tr>
            <tr>
                <td colspan="4"><strong>Container No.:</strong> {{ $invoice->container_no }}</td>
            </tr>

            <!-- Product Header Row -->
            <tr>
                <th>PRODUCT DESCRIPTION</th>
                <th colspan="2">HS CODE</th>
                <th>Packing</th>
                <th>QUANTITY (kg)</th>
                <th>QUANTITY (Box)</th>
                <th>Rate Per Unit ({{ $invoices->first()->currency ?? 'USD' }})</th>
                <th>FOB Amount ({{ $invoices->first()->currency ?? 'USD' }})</th>
            </tr>

            <!-- Loop through products -->
            @php
                $totalAmount = 0;
                $totalWeight = 0;
            @endphp

            @foreach($products->where('invoice_id', $invoice->id) as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td colspan="2">{{ $product->hs_code }}</td>
                            <td>{{ $product->packing }}</td>
                            <td>{{ $product->quantity_kg }}</td>
                            <td>{{ $product->quantity_box }}</td>
                            <td>{{ $product->rate_usd }}</td>
                            <td>{{ $currencySymbol }} {{ number_format($product->fob_amount, 2) }}</td>
                        </tr>
                        @php
                            $totalAmount += $product->fob_amount;
                            $totalWeight += $product->quantity_kg;
                        @endphp
            @endforeach

            <!-- Total Row -->
            <tr class="total-row">
                <td colspan="3"><strong>Total:</strong></td>
                <td colspan="2"></td>
                <td>{{ $totalWeight }} kg</td>
                <td></td>
                <td><strong>{{ $currencySymbol }} {{ number_format($totalAmount, 2) }}</strong></td>
            </tr>

            <!-- Amount Chargeable Row -->
            <tr>
                <td colspan="3"><strong>Amount Chargeable (in Words):</strong></td>
                <td colspan="5">{{ $invoices->first()->currency ?? 'USD' }} {{ $this->numberToWords($totalAmount) }} Only</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="5"><strong>Net Weight:</strong> {{ $totalWeight }} kg <br> <strong>Gross Weight:</strong>
                    {{ $invoice->gross_weight }} kg</td>
            </tr>
        </table>


        <div class="double-line"></div>

        <div class="section-title">Bank Details</div>
        <ol class="terms-list">
            <li>Bank Name:</li>
            <li>Bank Branch:</li>
            <li>Company Name:</li>
            <li>Account No:</li>
            <li>IFSC Code:</li>
            <li>Account Type:</li>
            <li>Swift Code:</li>
        </ol>

        <div class="section-title">Declaration :</div>
        <div class="declaration">
            We declare that this invoice shows the actual price of the goods described and that all particulars are true
            and correct.
        </div>
    </div>


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
                filename: 'Commercial_Invoice.pdf',
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