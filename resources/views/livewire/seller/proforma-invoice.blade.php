<div>

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .invoice-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 30px auto;
            max-width: 1200px;
        }

        .header-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .company-logo {
            max-width: 180px;
            height: auto;
        }

        .invoice-title {
            color: var(--secondary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 900;
        }

        .invoice-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-block {
            flex: 1;
            min-width: 250px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 15px;
        }

        .info-block h5 {
            color: var(--primary-color);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            font-size: 14px;
            font-weight: 600;
            min-width: 120px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .products-table th,
        .products-table td {
            border: 1px solid var(--border-color);
            padding: 12px;
            text-align: left;
        }

        .products-table th {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            font-size: 14px;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .products-table td {
            vertical-align: middle;
        }

        .input-cell input {
            width: 100%;
            /* border: none; */
            background: transparent;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f9fa !important;
        }

        .amount-in-words {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin: 15px 0;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary-custom {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary-custom:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-danger-custom {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-danger-custom:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin: 20px 0 5px;
            padding-top: 10px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background-color: white;
            }

            .invoice-container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>


    <div class="container invoice-container">
        <form wire:submit.prevent="saveInvoice" method="POST">
            @csrf

            <input type="hidden" name="type" wire:model="type">
            <!-- Header Section -->
            <div class="header-section">
                <div>
                    <h2 class="invoice-title">PROFORMA INVOICE</h2>
                    <div class="info-row">
                        <span class="info-label">Exporter:</span>
                        <div class="d-flex flex-wrap">
                            <input name="exporter" wire:model="exporter" type="text"
                                class="form-control form-control-sm w-100" id="exporter"
                                placeholder="Enter exporter name">
                            @error('exporter') <span class="fw-semibold text-danger"
                            style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Address:</span>
                        <div class="d-flex flex-wrap">
                            <input name="exporter_address" wire:model="exporter_address" type="text"
                                class="form-control form-control-sm w-100" id="exporterAddress"
                                placeholder="Enter exporter address">
                            @error('exporter_address') <span class="fw-semibold text-danger"
                            style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <div class="info-row">
                        <span class="info-label">Invoice No:</span>
                        <div class="d-flex flex-wrap">
                            <input name="invoice_no" wire:model="invoice_no" type="text"
                                class="form-control form-control-sm w-100" id="invoiceNo"
                                placeholder="Enter invoice number">
                            @error('invoice_no') <span class="fw-semibold text-danger"
                            style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date:</span>
                        <div class="d-flex flex-wrap w-100">
                            <input name="invoice_date" wire:model="invoice_date" type="date"
                                class="form-control form-control-sm w-100" id="invoiceDate">
                            @error('invoice_date') <span class="fw-semibold text-danger"
                            style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Exporter Ref:</span>
                        <div class="d-flex flex-wrap">
                            <input name="exporter_reference" wire:model="exporter_reference" type="text"
                                class="form-control form-control-sm w-100" id="exporterRef"
                                placeholder="Enter exporter reference">
                            @error('exporter_reference') <span class="fw-semibold text-danger"
                            style="font-size: 13px">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Blocks -->
            <div class="row g-3 mb-4">
                <!-- Buyer Information -->
                <div class="col-md-4">
                    <div class="card h-100 border-primary">
                        <div class="card-header bg-primary text-white py-2">
                            <h5 class="mb-0">Buyer Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Order No:</label>
                                <input name="buyer_order_no" wire:model="buyer_order_no" type="text"
                                    class="form-control form-control-sm" placeholder="Order number">
                                @error('buyer_order_no') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Order Date:</label>
                                <input name="buyer_order_date" wire:model="buyer_order_date" type="date"
                                    class="form-control form-control-sm">
                                @error('buyer_order_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Buyer:</label>
                                <input name="buyer_name" type="text" wire:model="buyer_name"
                                    class="form-control form-control-sm" placeholder="Buyer name">
                                @error('buyer_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Address:</label>
                                <textarea name="buyer_address" wire:model="buyer_address"
                                    class="form-control form-control-sm" rows="2"
                                    placeholder="Buyer address"></textarea>
                                @error('buyer_address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Container No:</label>
                                <input name="container_no" type="text" wire:model="container_no"
                                    class="form-control form-control-sm" placeholder="Container number">
                                @error('container_no') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Marks & No:</label>
                                <input name="marks_no" type="text" wire:model="marks_no"
                                    class="form-control form-control-sm" placeholder="Marks number">
                                @error('marks_no') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Currency:</label>
                                <input name="currency" type="text" wire:model="currency"
                                    class="form-control form-control-sm" placeholder="Currency">
                                @error('currency') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="col-md-4">
                    <div class="card h-100 border-success">
                        <div class="card-header bg-success text-white py-2">
                            <h5 class="mb-0">Shipping Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Consignee:</label>
                                <input name="consignee" type="text" wire:model="consignee"
                                    class="form-control form-control-sm" placeholder="Consignee name">
                                @error('consignee') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Other Consignee:</label>
                                <input name="other_consignee" type="text" wire:model="other_consignee"
                                    class="form-control form-control-sm" placeholder="Other consignee">
                                @error('other_consignee') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Notify Party:</label>
                                <input name="notify_party" type="text" wire:model="notify_party"
                                    class="form-control form-control-sm" placeholder="Notify party">
                                @error('notify_party') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Country Origin Country:</label>
                                <input name="origin_country" type="text" wire:model="origin_country"
                                    class="form-control form-control-sm" placeholder="Origin country">
                                @error('origin_country') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Country Final Destination:</label>
                                <input name="destination_country" wire:model="destination_country" type="text"
                                    class="form-control form-control-sm" placeholder="Destination country">
                                @error('destination_country') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Description of Goods:</label>
                                <input name="description_goods" type="text" wire:model="description_goods"
                                    class="form-control form-control-sm" placeholder="Description of goods">
                                @error('description_goods') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">No & Pkgs:</label>
                                <input name="kind_pkg" type="text" wire:model="kind_pkg"
                                    class="form-control form-control-sm" placeholder="Kind of packages">
                                @error('kind_pkg') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Terms -->
                <div class="col-md-4">
                    <div class="card h-100 border-info">
                        <div class="card-header bg-info text-white py-2">
                            <h5 class="mb-0">Shipping Terms</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Pre Carriage:</label>
                                <input name="pre_carriage" type="text" wire:model="pre_carriage"
                                    class="form-control form-control-sm" placeholder="Pre-carriage method">
                                @error('pre_carriage') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Receipt by Pre-Carrier:</label>
                                <input name="receipt_place" type="text" wire:model="receipt_place"
                                    class="form-control form-control-sm" placeholder="Receipt place">
                                @error('receipt_place') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Vessel/Flight:</label>
                                <input name="vessel_flight_no" type="text" wire:model="vessel_flight_no"
                                    class="form-control form-control-sm" placeholder="Vessel/flight number">
                                @error('vessel_flight_no') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Port of Loading:</label>
                                <input name="port_loading" type="text" wire:model="port_loading"
                                    class="form-control form-control-sm" placeholder="Loading port">
                                @error('port_loading') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Port of Discharge:</label>
                                <input name="port_discharge" type="text" wire:model="port_discharge"
                                    class="form-control form-control-sm" placeholder="Discharge port">
                                @error('port_discharge') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Final Destination:</label>
                                <input name="final_destination" type="text" wire:model="final_destination"
                                    class="form-control form-control-sm" placeholder="Final destination">
                                @error('final_destination') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold mb-1">Payment Terms:</label>
                                <input name="terms" type="text" wire:model="terms" class="form-control form-control-sm"
                                    placeholder="Payment terms">
                                @error('terms') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="" width="5%">Sr. No.</th>
                            <th class="" style="width:15%; min-width: 150px;">PRODUCT DESCRIPTION</th>
                            <th style="width:12%; min-width: 150px;">HS CODE</th>
                            <th class="">Packing<br />Box/Bags/Draw</th>
                            <th width="12%">QUANTITY<br />IN PCS/kg/Line</th>
                            <th width="10%">QUANTITY<br />Box/Eggs/Draw/Loose</th>
                            <th class="">Rate Per pc/Packing<br />IN USD</th>
                            <th style="width:10%; min-width: 110px;">DOS Amount<br />IN USD</th>
                            <th style="width:5%; min-width: 70px;" class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        <!-- Initial row -->
                        @foreach($products as $index => $product)
                            <tr class="product-row">
                                <td class="text-center">1</td>
                                <td class="input-cell"><input name="product_name"
                                        wire:model="products.{{ $index }}.product_name" type="text"
                                        class="form-control product-desc" placeholder="Enter product description"></td>
                                <td class="input-cell"><input name="hs_code" type="text"
                                        wire:model="products.{{ $index }}.hs_code" class="form-control hs-code"
                                        placeholder="Enter HS code"></td>
                                <td class="input-cell"><input name="packing" type="text"
                                        wire:model="products.{{ $index }}.packing" class="form-control packing"
                                        placeholder="Enter packing type"></td>
                                <td class="input-cell"><input name="quantity_kg" type="number"
                                        wire:model="products.{{ $index }}.quantity_kg" class="form-control quantity-kg"
                                        placeholder="Enter quantity"></td>
                                <td class="input-cell"><input name="quantity_box"
                                        wire:model="products.{{ $index }}.quantity_box" type="number"
                                        class="form-control quantity-pkg" placeholder="Enter package count"></td>
                                <td class="input-cell"><input name="rate_usd" wire:model="products.{{ $index }}.rate_usd"
                                        type="number" class="form-control rate" placeholder="rate" step="0.01"></td>
                                <td class="input-cell"><input name="dos_amount_usd"
                                        wire:model="products.{{ $index }}.dos_amount_usd" type="number"
                                        class="form-control amount" placeholder="amount"></td>
                                <td class="no-print">
                                    <button type="button" wire:click="removeItem({{ $index }})"
                                        class="btn btn-outline-danger rounded-3 border-dark-subtle shadow-sm btn-sm remove-product">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td id="totalQuantityKg">0</td>
                            <td id="totalQuantityPkg">0</td>
                            <td class="no-print"></td>
                            <td id="totalAmount"><strong>0.00</strong></td>
                            <td class="no-print"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Amount in Words -->
            <div class="amount-in-words">
                <div class="info-row">
                    <span class="info-label">Amount Chargeable (in Words):</span>
                    <span id="amountInWords">USD Zero Only</span>
                </div>
            </div>

            <div>
                <a class="btn btn-primary-custom text-white" wire:click="addItem">
                    <i class="fas fa-plus"></i> Add item
                </a>
            </div>

            <!-- Terms and Conditions -->
            <div class="terms-section mt-4">
                <h5>Terms & Conditions:</h5>
                <ol>
                    <li>Payment to be made by T/T within 15 days from the date of invoice.</li>
                    <li>Goods are sold on FOB basis.</li>
                    <li>All disputes subject to Mumbai jurisdiction.</li>
                    <li>Certificate of Origin and Phytosanitary Certificate will be provided.</li>
                </ol>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <p>Authorized Signatory</p>
                    <p>For ABC Exporters Pvt. Ltd.</p>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <p>Buyer's Signature</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons no-print">
                <button type="submit" class="btn btn-success" id="saveInvoice">
                    <i class="fas fa-save"></i> Save Invoice
                </button>

            </div>
        </form>
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


    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Number to words function
            function numberToWords(num) {
                const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
                const teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                const tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

                function convertLessThanOneThousand(num) {
                    if (num === 0) return '';
                    if (num < 10) return units[num];
                    if (num < 20) return teens[num - 10];
                    if (num < 100) {
                        return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? ' ' + units[num % 10] : '');
                    }
                    return units[Math.floor(num / 100)] + ' Hundred' + (num % 100 !== 0 ? ' and ' + convertLessThanOneThousand(num % 100) : '');
                }

                if (num === 0) return 'Zero';
                let result = '';
                const billion = Math.floor(num / 1000000000);
                num %= 1000000000;
                const million = Math.floor(num / 1000000);
                num %= 1000000;
                const thousand = Math.floor(num / 1000);
                num %= 1000;

                if (billion) result += convertLessThanOneThousand(billion) + ' Billion ';
                if (million) result += convertLessThanOneThousand(million) + ' Million ';
                if (thousand) result += convertLessThanOneThousand(thousand) + ' Thousand ';
                if (num) result += convertLessThanOneThousand(num);

                return result.trim();
            }


            // Format currency

            function formatCurrency(amount) {
                return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            // Update totals based only on manually entered amounts
            function updateTotals() {
                let totalKg = 0;
                let totalPkg = 0;
                let totalAmount = 0;

                document.querySelectorAll('.product-row').forEach(row => {
                    // Only sum the quantities (no rate calculation)
                    totalKg += parseFloat(row.querySelector('.quantity-kg').value) || 0;
                    totalPkg += parseFloat(row.querySelector('.quantity-pkg').value) || 0;

                    // Get amount directly from amount input field
                    const amountInput = row.querySelector('.amount');
                    totalAmount += parseFloat(amountInput.value) || 0;
                });

                document.getElementById('totalQuantityKg').textContent = formatCurrency(totalKg);
                document.getElementById('totalQuantityPkg').textContent = formatCurrency(totalPkg);
                document.getElementById('totalAmount').innerHTML = '<strong>' + formatCurrency(totalAmount) + '</strong>';

                // Update amount in words if needed
                if (typeof numberToWords === 'function') {
                    const amountInWords = numberToWords(Math.floor(totalAmount)) + ' Only';
                    document.getElementById('amountInWords').textContent = 'USD ' + amountInWords;
                }
            }

            // Only listen to quantity and amount inputs (not rate)
            document.addEventListener('input', function (e) {
                if (e.target.classList.contains('quantity-kg') ||
                    e.target.classList.contains('quantity-pkg') ||
                    e.target.classList.contains('amount')) {
                    updateTotals();
                }
            });

            // Add new product row
            // Add new product row with dynamic serial number
            document.getElementById('addProduct').addEventListener('click', function () {
                const tableBody = document.getElementById('productsTableBody');
                const rows = tableBody.querySelectorAll('.product-row');
                const newRow = document.createElement('tr');
                newRow.className = 'product-row';

                // Create new row with dynamic serial number
                newRow.innerHTML = `
        <td>${rows.length + 1}</td>
        <td class="input-cell"><input aria-label="abc" type="text" class="form-control product-desc" placeholder="Enter product description"></td>
        <td class="input-cell"><input aria-label="abc" type="text" class="form-control hs-code" placeholder="Enter HS code"></td>
        <td class="input-cell"><input aria-label="abc" type="text" class="form-control packing" placeholder="Enter packing type"></td>
        <td class="input-cell"><input aria-label="abc" type="number" class="form-control quantity-kg" placeholder="Enter quantity"></td>
        <td class="input-cell"><input aria-label="abc" type="number" class="form-control quantity-pkg" placeholder="Enter package count"></td>
        <td class="input-cell"><input aria-label="abc" type="number" class="form-control rate" placeholder="rate" step="0.01"></td>
        <td class="input-cell"><input aria-label="abc" type="number" class="form-control amount" placeholder="amount"></td>
        <td class="no-print">
            <button class="btn btn-outline-danger rounded-3 border-dark-subtle shadow-sm btn-sm remove-product">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </td>
    `;

                tableBody.appendChild(newRow);

                // Add event listeners to new inputs
                newRow.querySelector('.quantity-kg').addEventListener('input', updateTotals);
                newRow.querySelector('.quantity-pkg').addEventListener('input', updateTotals);
                newRow.querySelector('.amount').addEventListener('input', updateTotals);

                // Add event listener to remove button
                newRow.querySelector('.remove-product').addEventListener('click', function () {
                    newRow.remove();
                    updateSerialNumbers(); // Update serial numbers after removal
                    updateTotals();
                });
            });

            // Function to update serial numbers
            function updateSerialNumbers() {
                const rows = document.querySelectorAll('#productsTableBody .product-row');
                rows.forEach((row, index) => {
                    row.cells[0].textContent = index + 1;
                });
            }

            // Update remove button event listeners to include serial number update
            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-product')) {
                    e.target.closest('.product-row').remove();
                    updateSerialNumbers();
                    updateTotals();
                }
            });

            // Save invoice
            document.getElementById('saveInvoice').addEventListener('click', function () {
                // Collect all invoice data
                const invoiceData = {
                    header: {
                        invoiceNo: document.getElementById('invoiceNo').value,
                        date: document.getElementById('invoiceDate').value,
                        exporterRef: document.getElementById('exporterRef').value,
                        exporter: document.getElementById('exporter').value,
                        exporterAddress: document.getElementById('exporterAddress').value,
                    },
                    buyer: {
                        orderNo: document.getElementById('buyerOrderNo').value,
                        orderDate: document.getElementById('buyerOrderDate').value,
                        name: document.getElementById('buyerName').value,
                        address: document.getElementById('buyerAddress').value
                    },
                    shipping: {
                        consignee: document.getElementById('consignee').value,
                        notifyParty: document.getElementById('notifyParty').value,
                        originCountry: document.getElementById('originCountry').value,
                        destinationCountry: document.getElementById('destinationCountry').value,
                        preCarriage: document.getElementById('preCarriage').value,
                        vesselNo: document.getElementById('vesselNo').value,
                        portLoading: document.getElementById('portLoading').value,
                        portDischarge: document.getElementById('portDischarge').value
                    },
                    products: [],
                    totals: {
                        quantityKg: document.getElementById('totalQuantityKg').textContent,
                        quantityPkg: document.getElementById('totalQuantityPkg').textContent,
                        amount: document.getElementById('totalAmount').textContent,
                        amountInWords: document.getElementById('amountInWords').textContent
                    },
                    terms: [
                        'Payment to be made by T/T within 15 days from the date of invoice.',
                        'Goods are sold on FOB basis.',
                        'All disputes subject to Mumbai jurisdiction.',
                        'Certificate of Origin and Phytosanitary Certificate will be provided.'
                    ]
                };

                // Collect all products
                document.querySelectorAll('.product-row').forEach(row => {
                    invoiceData.products.push({
                        description: row.querySelector('.product-desc').value,
                        hsCode: row.querySelector('.hs-code').value,
                        hsDescription: row.querySelector('.hs-desc').value,
                        packing: row.querySelector('.packing').value,
                        quantityKg: row.querySelector('.quantity-kg').value,
                        quantityPkg: row.querySelector('.quantity-pkg').value,
                        rate: row.querySelector('.rate').value,
                        amount: row.querySelector('.amount').textContent
                    });
                });

                // Here you would typically send the data to a server
                // For this example, we'll just show it in console and alert
                console.log('Invoice Data:', invoiceData);

                // Convert to JSON and download as file
                const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(invoiceData, null, 2));
                const downloadAnchor = document.createElement('a');
                downloadAnchor.setAttribute("href", dataStr);
                downloadAnchor.setAttribute("download", "proforma_invoice_" + invoiceData.header.invoiceNo + ".json");
                document.body.appendChild(downloadAnchor);
                downloadAnchor.click();
                document.body.removeChild(downloadAnchor);

                alert('Invoice saved successfully! A JSON file has been downloaded.');
            });

            // Initialize calculations
            updateTotals();
        });
    </script>
</div>