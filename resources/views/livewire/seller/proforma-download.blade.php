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
        <div class="invoice-title">PROFORMA INVOICE</div>

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

        <table>
            <!-- Row 1 -->
            <tr>
                <td rowspan="4" colspan="5">
                    <strong>Exporter:</strong><br>
                    {{ $invoices->first()->exporter ?? '' }}<br>
                    {{ $invoices->first()->exporter_address ?? '' }}
                </td>
                <td colspan=""><strong>Proforma Invoice No.: </strong>{{ $invoices->first()->invoice_no ?? '' }}</td>
                <td rowspan="2" colspan="2"><strong>Exporter Reference :
                    </strong>{{ $invoices->first()->exporter_reference ?? '' }}</td>
            </tr>

            <!-- Row 2 -->
            <tr>
                <td colspan="2"><strong>Date: </strong>{{ $invoices->first()->invoice_date ?? '' }}</td>
            </tr>

            <!-- Row 3 -->
            <tr>
                <td rowspan="2" colspan="4">
                    <strong>Buyer's Order No:</strong> {{ $invoices->first()->buyer_order_no ?? '' }}<br>
                    <strong>Date:</strong> {{ $invoices->first()->buyer_order_date ?? '' }}
                </td>
            </tr>
            <tr></tr>

            <!-- Row 4 -->
            <tr>
                <td colspan="5">
                    <strong>Consignee:</strong><br>
                    {{ $invoices->first()->consignee ?? '' }}
                </td>
                <td colspan="3">
                    <strong>Buyer:</strong><br>
                    {{ $invoices->first()->buyer_name ?? '' }}<br>
                    {{ $invoices->first()->buyer_address ?? '' }}
                </td>
            </tr>

            <!-- Row 5 -->
            <tr>
                <td colspan="5">
                    <strong>Notify Party:</strong><br>
                    {{ $invoices->first()->notify_party ?? '' }}
                </td>
                <td colspan="1"><strong>Country of Origin of Goods:
                    </strong>{{ $invoices->first()->origin_country ?? 'INDIA' }}</td>
                <td colspan="2"><strong>Country of Final Destination:
                    </strong>{{ $invoices->first()->destination_country ?? '' }}</td>
            </tr>

            <!-- Row 7 -->
            <tr>
                <td><strong>Pre Carriage by: </strong> {{ $invoices->first()->pre_carriage ?? '' }}</td>
                <td colspan="4"><strong>Place of Receipt by Pre Carrier: </strong>
                    {{ $invoices->first()->receipt_place ?? '' }}</td>
                <td rowspan="3" colspan="4">
                    <strong>Terms:</strong><br>
                    {{ $invoices->first()->terms ?? '' }}
                </td>
            </tr>

            <!-- Row 8 -->
            <tr>
                <td><strong>Vessel / Flight No.: </strong>{{ $invoices->first()->vessel_flight_no ?? '' }}</td>
                <td colspan="4"><strong>Port of Loading: </strong>{{ $invoices->first()->port_loading ?? '' }}</td>
            </tr>

            <!-- Row 9 -->
            <tr>
                <td><strong>Port of Discharge: </strong>{{ $invoices->first()->port_discharge ?? '' }}</td>
                <td colspan="4"><strong>Final Destination: </strong>{{ $invoices->first()->final_destination ?? '' }}
                </td>
            </tr>

            <!-- Row 10 -->
            <tr>
                <td><strong>Marks & No.: </strong>{{ $invoices->first()->marks_no ?? '' }}</td>
                <td rowspan="2" colspan="4"><strong>No. & kind of Pkg: </strong>{{ $invoices->first()->kind_pkg ?? '' }}
                </td>
                <td rowspan="2" colspan="3"><strong>Description of Goods:
                    </strong>{{ $invoices->first()->description_goods ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4"><strong>Container No.: </strong>{{ $invoices->first()->container_no ?? '' }}</td>
            </tr>

            <!-- Product Header Row 1 -->
            <tr>
                <th rowspan="">PRODUCT DESCRIPTION</th>
                <th rowspan="" colspan="2">HS CODE</th>
                <th colspan="">Packing <br /> Box/ Bags/Draw/</th>
                <th rowspan="">QUANTITY IN PCS / kg / Line</th>
                <th rowspan="">QUANTITY Box/ Eggs/Draw/Loose</th>
                <th rowspan="">Rate Per pc / Packing IN {{ $invoices->first()->currency ?? 'USD' }}</th>
                <th rowspan="">DOS Amount IN {{ $invoices->first()->currency ?? 'USD' }}</th>
            </tr>

            <!-- Product Rows -->
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td colspan="2">{{ $product->hs_code }}</td>
                    <td>{{ $product->packing }}</td>
                    <td>{{ $product->quantity_kg }}</td>
                    <td>{{ $product->quantity_box }}</td>
                    <td>{{ $product->rate_usd }}</td>
                    <td>{{ $currencySymbol }} {{ number_format($product->dos_amount_usd, 2) }}</td>
                </tr>
            @endforeach

            <!-- Total Row -->
            <tr class="total-row">
                <td colspan="3" class="text-start"><strong>Total:</strong></td>
                <td colspan="2"></td>
                <td>{{ $products->sum('quantity_box') }}</td>
                <td></td>
                <td><strong>{{ $currencySymbol }} {{ number_format($products->sum('dos_amount_usd'), 2) }}</strong></td>
            </tr>

            <!-- Amount Chargeable Row -->
            <tr>
                <td colspan="5">Amount Chargeable (in Words)</td>
                <td colspan="4">{{ $invoices->first()->currency ?? 'USD' }} {{ $this->numberToWords($products->sum('dos_amount_usd')) }} Only</td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
        </table>

        <div class="double-line"></div>

        <div class="d-flex">
            <div>
                <div class="section-title">TERMS & CONDITIONS</div>
                <ol class="terms-list">
                    <li>The <u>Above</u> prices are includes:</li>
                    <li>The Category period:</li>
                    <li>Packing Details :</li>
                    <li>Validity:</li>
                    <li>The expected amount and Quantity:</li>
                    <li>Port Shipments:</li>
                    <li>Trans Shipment:</li>
                    <li>Negotiation :</li>
                    <li>Bank Details:</li>
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
                    We declare that this invoice shows the actual price of the goods described and that all particulars
                    are true and correct.
                </div>
            </div>
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
                filename: 'Proforma_Invoice.pdf',
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