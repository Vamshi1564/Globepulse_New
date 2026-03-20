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
            margin: 25px;
            padding-left: 20px;
        }

        .terms-list li {
            margin: 10px;
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

        .d-flex {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
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
        <div class="invoice-title">PACKING LIST</div>

        <div class="text-end">
            <button class="btn btn-success btn-sm mb-3 " type="button" id="downloadPdfBtn">
                <i class="fa-solid fa-download me-2"></i>Download
            </button>
        </div>
        <!-- Loading spinner (hidden by default) -->
        {{-- <div id="loadingSpinner" class="d-none text-center my-3">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted mt-2">Generating PDF...</p>
        </div> --}}

        <table border="1">
            <tr>
                <td rowspan="4" colspan="5"><strong>Exporter:</strong> {{ $invoices->first()->exporter ?? 'N/A' }}</td>
                <td colspan="2"><strong>Proforma Invoice No.:</strong> {{ $invoices->first()->invoice_no ?? 'N/A' }}
                </td>
                <td rowspan="2" colspan="3"><strong>Exporter Reference:</strong>
                    {{ $invoices->first()->exporter_reference ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Date:</strong> {{ $invoices->first()->invoice_date ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td rowspan="2" colspan="4"><strong>Buyer's Order No. & Date:</strong>
                    {{ $invoices->first()->buyer_order_no ?? 'N/A' }} /
                    {{ $invoices->first()->buyer_order_date ?? 'N/A' }}
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td colspan="5"><strong>Consignee:</strong> {{ $invoices->first()->consignee ?? 'N/A' }}</td>
                <td colspan="4"><strong>Buyer other than consignee:</strong>
                    {{ $invoices->first()->other_consignee ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td colspan="5"><strong>Notify Party:</strong> {{ $invoices->first()->notify_party ?? 'N/A' }}</td>
                <td colspan="2"><strong>Country of Origin of Goods:</strong>
                    {{ $invoices->first()->origin_country ?? 'N/A' }}</td>
                <td colspan="2"><strong>Country of Final Destination:</strong>
                    {{ $invoices->first()->destination_country ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Pre Carriage by:</strong> {{ $invoices->first()->pre_carriage ?? 'N/A' }}</td>
                <td colspan="2"><strong>Place of Receipt by Pre-Carrier:</strong>
                    {{ $invoices->first()->receipt_place ?? 'N/A' }}</td>
                <td rowspan="3" colspan="4"><strong>Terms of Delivery & Payment:</strong>
                    {{ $invoices->first()->terms ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Vessel / Flight No.:</strong>
                    {{ $invoices->first()->vessel_flight_no ?? 'N/A' }}</td>
                <td colspan="3"><strong>Port of Loading:</strong> {{ $invoices->first()->port_loading ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Port of Discharge:</strong> {{ $invoices->first()->port_discharge ?? 'N/A' }}
                </td>
                <td colspan="2"><strong>Final Destination:</strong> {{ $invoices->first()->final_destination ?? 'N/A' }}
                </td>
            </tr>
            <tr>
                <td colspan="3"><strong>Marks & No.:</strong> {{ $invoices->first()->marks_no ?? 'N/A' }}</td>
                <td rowspan="2" colspan="2"><strong>No. & kind of Pkgs:</strong>
                    {{ $invoices->first()->kind_pkg ?? 'N/A' }}</td>
                <td rowspan="2" colspan="3"><strong>Description of Goods:</strong>
                    {{ $invoices->first()->description_goods ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td colspan="4"><strong>Container No.:</strong> {{ $invoices->first()->container_no ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>PRODUCT DESCRIPTION</th>
                <th colspan="2">HS CODE</th>
                <th>Model / Style / Grade</th>
                <th>Box/Bundle/Bag/Dunn-No</th>
                <th>Pieces</th>
                <th>Net weight({{ $invoices->first()->currency ?? 'USD' }})</th>
                <th>Gross Weight({{ $invoices->first()->currency ?? 'USD' }})</th>
            </tr>

            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td colspan="2">{{ $product->hs_code }}</td>
                    <td>{{ $product->grade_specification }}</td>
                    <td>{{ $product->packing }}</td>
                    <td>{{ $product->pieces }}</td>
                    <td>{{ $currencySymbol }} {{ $product->net_weight }}</td>
                    <td>{{ $currencySymbol }} {{ $product->gross_weight }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No Products Found</td>
                </tr>
            @endforelse

            <tr class="total-row">
                <td class="text-start"><strong>Total</strong></td>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td><strong>{{ $products->sum('pieces') }}</strong></td>
                <td><strong>{{ $currencySymbol }} {{ $products->sum('net_weight') }}</strong></td>
                <td><strong>{{ $currencySymbol }} {{ $products->sum('gross_weight') }}</strong></td>
            </tr>
        </table>

        <div class="double-line"></div>


        <div>
            <ul class="terms-list">
                <li><strong> Net Weight: </strong></li>
                <li><strong> Gross Weight: </strong></li>
                <li><strong> No.of Boxes/Bundles/ Bags/ Drums: </strong></li>
                <li><strong> CBM: </strong></li>
            </ul>
            <div class="d-flex">
                <div>
                    <div class="section-title">Declaration :</div>
                    <div style="margin-top: 0;" class="section-title">We Intended claim Rewards under RodTEP Scheme
                    </div>
                    <div class="declaration">
                        We declare that this invoice shows the actual price of the goods <br /> described and that all
                        particulars are
                        true and correct.
                    </div>
                </div>

                <div>
                    <table>
                        <tr>
                            <th style="padding: 10px 100px;">Signature & Date</th>
                        </tr>
                        <tr>
                            <th style="padding: 10px 100px;">For (Company name)</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px 100px;" class="signatory">Authorised Signitory</td>
                        </tr>
                    </table>
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
                filename: 'PackingList_Invoice.pdf',
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