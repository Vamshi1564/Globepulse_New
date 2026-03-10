<div>

    <style>
        .invoice-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 30px auto;
            max-width: 1200px;
        }

        .header-section {
            border-bottom: 2px solid #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }

        .info-block {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th,
        .products-table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            vertical-align: middle;
        }

        .products-table th {
            background-color: #2c3e50;
            color: white;
        }

        .input-cell input,
        .input-cell textarea {
            width: 100%;
            border: none;
            background: transparent;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f9fa !important;
        }

        .signature-box {
            text-align: center;
            margin-top: 50px;
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
        }
    </style>


    <div class="container invoice-container">
        <!-- Header Section -->

        <form wire:submit.prevent="saveInvoice" method="POST">
            @csrf
            <input type="hidden" name="type" wire:model="type">

            <div class="header-section">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-primary">COMMERCIAL INVOICE</h1>
                    <div>
                        <button type="submit" class="btn btn-success no-print me-2">
                            <i class="fas fa-save"></i> Save Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- Exporter/Buyer Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-block">
                        <h5>Exporter Information</h5>
                        <div class="mb-3">
                            <label class="form-label"><strong>Name:</strong></label>
                            <input type="text" class="form-control" wire:model="exporter"
                                placeholder="Enter exporter name">
                            @error('exporter') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Address:</strong></label>
                            <textarea class="form-control" wire:model="exporter_address" rows="2"
                                placeholder="Enter exporter address"></textarea>
                            @error('exporter_address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-block">
                        <h5>Buyer Information</h5>
                        <div class="mb-3">
                            <label class="form-label"><strong>Name:</strong></label>
                            <input type="text" class="form-control" wire:model="buyer_name"
                                placeholder="Enter buyer name">
                            @error('buyer_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Address:</strong></label>
                            <textarea class="form-control" wire:model="buyer_address" rows="2"
                                placeholder="Enter buyer address"></textarea>
                            @error('buyer_address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-block">
                        <div class="mb-3">
                            <label class="form-label"><strong>Invoice No:</strong></label>
                            <input type="text" class="form-control" wire:model="invoice_no"
                                placeholder="Enter invoice number">
                            @error('invoice_no') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Date:</strong></label>
                            <input type="date" class="form-control" wire:model="invoice_date">
                            @error('invoice_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Buyer's Order No:</strong></label>
                            <input type="text" class="form-control" wire:model="buyer_order_no"
                                placeholder="Enter order number">
                            @error('buyer_order_no') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Order Date:</strong></label>
                            <input type="date" class="form-control" wire:model="buyer_order_date">
                            @error('buyer_order_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-block">
                        <div class="mb-3">
                            <label class="form-label"><strong>Exporter Reference:</strong></label>
                            <input type="text" class="form-control" wire:model="exporter_reference"
                                placeholder="Enter reference">
                            @error('exporter_reference') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Container No:</strong></label>
                            <input type="text" class="form-control" wire:model="container_no"
                                placeholder="Enter container number">
                            @error('container_no') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Marks & No.:</strong></label>
                            <input type="text" class="form-control" wire:model="marks_no"
                                placeholder="Enter marks number">
                            @error('marks_no') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>No. & Kind of Pkgs:</strong></label>
                            <input type="text" class="form-control" wire:model="kind_pkg"
                                placeholder="Enter kind of pkgs number">
                            @error('kind_pkg') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-block">
                        <h5>Shipping Details</h5>
                        <div class="mb-3">
                            <label class="form-label"><strong>Vessel/Flight No:</strong></label>
                            <input type="text" class="form-control" wire:model="vessel_flight_no"
                                placeholder="Enter vessel/flight number">
                            @error('vessel_flight_no') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Port of Loading:</strong></label>
                            <input type="text" class="form-control" wire:model="port_loading"
                                placeholder="Enter port of loading">
                            @error('port_loading') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Port of Discharge:</strong></label>
                            <input type="text" class="form-control" wire:model="port_discharge"
                                placeholder="Enter port of discharge">
                            @error('port_discharge') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Final Destination:</strong></label>
                            <input type="text" class="form-control" wire:model="final_destination"
                                placeholder="Enter final destination">
                            @error('final_destination') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Currency:</strong></label>
                            <input type="text" name="currency" class="form-control" wire:model="currency"
                                placeholder="Enter currency">
                            @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-block">
                        <h5>Additional Information</h5>
                        <div class="mb-3">
                            <label class="form-label"><strong>Country of Origin:</strong></label>
                            <input type="text" class="form-control" wire:model="origin_country"
                                placeholder="Enter country of origin">
                            @error('origin_country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Country of Final Destination:</strong></label>
                            <input type="text" class="form-control" wire:model="destination_country"
                                placeholder="Enter country of final destination">
                            @error('destination_country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Payment Terms:</strong></label>
                            <input type="text" class="form-control" wire:model="terms"
                                placeholder="Enter payment terms">
                            @error('terms') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Description of Goods:</strong></label>
                            <input type="text" class="form-control" wire:model="description_goods"
                                placeholder="Enter description of Goods">
                            @error('description_goods') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Other Consignee:</strong></label>
                            <input name="other_consignee" type="text" wire:model="other_consignee"
                                class="form-control form-control-sm w-100" id="otherConsignee"
                                placeholder="Enter other consignee">
                            @error('other_consignee') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-block">
                        <h5>Shipping Terms</h5>
                        <div class="mb-3">
                            <label class="form-label"><strong>Consignee:</strong></label>
                            <input type="text" class="form-control" wire:model="consignee"
                                placeholder="Enter consignee name">
                            @error('consignee') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Notify Party:</strong></label>
                            <input type="text" class="form-control" wire:model="notify_party"
                                placeholder="Enter notify party">
                            @error('notify_party') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Pre-Carriage By:</strong></label>
                            <input type="text" class="form-control" wire:model="pre_carriage"
                                placeholder="Enter pre-carriage">
                            @error('pre_carriage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Receipt by Pre-Carrier:</strong></label>
                            <input type="text" class="form-control" wire:model="receipt_place"
                                placeholder="Enter receipt by pre-carrier">
                            @error('receipt_place') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="table-responsive">
                <table class="products-table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th style="width:15%; min-width: 180px;">PRODUCT DESCRIPTION</th>
                            <th style="width:12%; min-width: 140px;">HS CODE</th>
                            <th style="width:10%; min-width: 130px;">Packing</th>
                            <th >QUANTITY (PCS/kg/Line)</th>
                            <th style="width:10%; min-width: 130px;">QUANTITY (Box/Bags)</th>
                            <th style="width:10%; min-width: 130px;">Rate Per Unit (USD)</th>
                            <th style="width:10%; min-width: 130px;">FOB Amount (USD)</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @foreach($products as $index => $product)
                            <tr class="product-row">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <input type="text" class="form-control" wire:model="products.{{ $index }}.product_name"
                                        placeholder="Enter product description">

                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="products.{{ $index }}.hs_code"
                                        placeholder="Enter HS code">

                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="products.{{ $index }}.packing"
                                        placeholder="Enter packing type">

                                </td>
                                <td>
                                    <input type="number" class="form-control quantity-kg"
                                        wire:model="products.{{ $index }}.quantity_kg" placeholder="Enter quantity" min="0">

                                </td>
                                <td>
                                    <input type="number" class="form-control quantity-pkg"
                                        wire:model="products.{{ $index }}.quantity_box" placeholder="Enter package count"
                                        min="0">

                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model="products.{{ $index }}.rate_usd"
                                        placeholder="Enter rate" step="0.01" min="0">

                                </td>
                                <td>
                                    <input type="number" class="form-control amount"
                                        wire:model="products.{{ $index }}.fob_amount" placeholder="Enter amount" step="0.01"
                                        min="0">

                                </td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        wire:click="removeItem({{ $index }})">
                                        <i class="fas fa-trash"></i>
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
                            <td></td>
                            <td id="totalAmount"><strong>0.00</strong></td>
                            <td class="no-print"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Amount Chargeable (in Words):</strong></td>
                            <td colspan="4" id="amountInWords">USD Zero Only</td>
                            <td class="no-print"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Net Weight:</strong></td>
                            <td colspan="4" id="netWeight">0 kg</td>
                            <td class="no-print"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Gross Weight:</strong></td>
                            <td colspan="4" id="grossWeight">0 kg</td>
                            <td class="no-print"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons no-print mb-4">
                <button type="button" wire:click="addItem" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>

            <!-- Terms and Conditions -->
            <div class="terms-section mb-4">
                <h5>Terms & Conditions:</h5>
                <ol>
                    <li>Payment to be made as per agreed terms.</li>
                    <li>Goods are sold on FOB basis.</li>
                    <li>All disputes subject to Mumbai jurisdiction.</li>
                    <li>Certificate of Origin will be provided.</li>
                </ol>
            </div>

            <!-- Signature Section -->
            <div class="signature-section row">
                <div class="col-md-6">
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        <p>Authorized Signatory</p>
                        <p>For {{ $exporter }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        <p>Buyer's Signature</p>
                    </div>
                </div>
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
            // Format currency
            function formatCurrency(amount) {
                return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            // Number to words function (simplified)
            function numberToWords(num) {
                const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
                const teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                const tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

                if (num === 0) return 'Zero';
                if (num < 10) return units[num];
                if (num < 20) return teens[num - 10];
                if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? ' ' + units[num % 10] : '');
                return 'Large Amount';
            }

            // Update totals
            function updateTotals() {
                let totalKg = 0;
                let totalPkg = 0;
                let totalAmount = 0;

                document.querySelectorAll('.product-row').forEach(row => {
                    totalKg += parseFloat(row.querySelector('.quantity-kg').value) || 0;
                    totalPkg += parseFloat(row.querySelector('.quantity-pkg').value) || 0;
                    totalAmount += parseFloat(row.querySelector('.amount').value) || 0;
                });

                document.getElementById('totalQuantityKg').textContent = formatCurrency(totalKg);
                document.getElementById('totalQuantityPkg').textContent = formatCurrency(totalPkg);
                document.getElementById('totalAmount').innerHTML = '<strong>' + formatCurrency(totalAmount) + '</strong>';

                // Update amount in words
                const amountInWords = numberToWords(Math.floor(totalAmount)) + ' Only';
                document.getElementById('amountInWords').textContent = 'USD ' + amountInWords;
            }

            // Add event listeners to amount inputs
            document.addEventListener('input', function (e) {
                if (e.target.classList.contains('amount') ||
                    e.target.classList.contains('quantity-kg') ||
                    e.target.classList.contains('quantity-pkg')) {
                    updateTotals();
                }
            });

            // Add new product row
            document.getElementById('addProduct').addEventListener('click', function () {
                const tableBody = document.getElementById('productsTableBody');
                const rows = tableBody.querySelectorAll('.product-row');
                const newRow = document.createElement('tr');
                newRow.className = 'product-row';

                newRow.innerHTML = `
                    <td>${rows.length + 1}</td>
                    <td><input type="text" class="form-control product-desc" placeholder="Enter product description"></td>
                    <td><input type="text" class="form-control hs-code" placeholder="Enter HS code"></td>
                    <td><input type="text" class="form-control packing" placeholder="Enter packing type"></td>
                    <td><input type="number" class="form-control quantity-kg" placeholder="Enter quantity" min="0"></td>
                    <td><input type="number" class="form-control quantity-pkg" placeholder="Enter package count" min="0"></td>
                    <td><input type="number" class="form-control rate" placeholder="Enter rate" step="0.01" min="0"></td>
                    <td><input type="number" class="form-control amount" placeholder="Enter amount" step="0.01" min="0"></td>
                    <td class="no-print">
                        <button class="btn btn-danger btn-sm remove-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                tableBody.appendChild(newRow);

                // Add event listeners to new inputs
                newRow.querySelector('.amount').addEventListener('input', updateTotals);
                newRow.querySelector('.quantity-kg').addEventListener('input', updateTotals);
                newRow.querySelector('.quantity-pkg').addEventListener('input', updateTotals);

                // Add event listener to remove button
                newRow.querySelector('.remove-product').addEventListener('click', function () {
                    newRow.remove();
                    updateSerialNumbers();
                    updateTotals();
                });
            });

            // Remove product row
            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-product')) {
                    e.target.closest('.product-row').remove();
                    updateSerialNumbers();
                    updateTotals();
                }
            });

            // Update serial numbers
            function updateSerialNumbers() {
                document.querySelectorAll('#productsTableBody .product-row').forEach((row, index) => {
                    row.cells[0].textContent = index + 1;
                });
            }

            // Save invoice
            document.getElementById('saveInvoice').addEventListener('click', function () {
                // Collect all invoice data
                const invoiceData = {
                    exporter: {
                        name: document.getElementById('exporterName').value,
                        address: document.getElementById('exporterAddress').value
                    },
                    buyer: {
                        name: document.getElementById('buyerName').value,
                        address: document.getElementById('buyerAddress').value
                    },
                    invoiceNo: document.getElementById('invoiceNo').value,
                    date: document.getElementById('invoiceDate').value,
                    products: [],
                    totals: {
                        quantityKg: document.getElementById('totalQuantityKg').textContent,
                        quantityPkg: document.getElementById('totalQuantityPkg').textContent,
                        amount: document.getElementById('totalAmount').textContent
                    }
                };

                // Collect all products
                document.querySelectorAll('.product-row').forEach(row => {
                    invoiceData.products.push({
                        description: row.querySelector('.product-desc').value,
                        hsCode: row.querySelector('.hs-code').value,
                        packing: row.querySelector('.packing').value,
                        quantityKg: row.querySelector('.quantity-kg').value,
                        quantityPkg: row.querySelector('.quantity-pkg').value,
                        rate: row.querySelector('.rate').value,
                        amount: row.querySelector('.amount').value
                    });
                });

                // Here you would typically send the data to a server
                console.log('Invoice Data:', invoiceData);
                alert('Invoice data saved (check console for details)');
            });

            // Initialize calculations
            updateTotals();
        });
    </script>


</div>