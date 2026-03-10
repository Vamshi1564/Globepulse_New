<div>

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border: #dee2e6;
            --success: #4cc9f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
        }

        .invoice-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .invoice-title {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .invoice-subtitle {
            font-weight: 400;
            opacity: 0.9;
        }

        .section-card {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .section-title {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            font-size: 1.25rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin: 1.5rem 0;
        }

        .product-table thead th {
            background-color: var(--primary);
            color: white;
            padding: 1rem;
            font-weight: 500;
            text-align: center;
            position: sticky;
            top: 0;
        }

        .product-table th:first-child {
            border-top-left-radius: 8px;
        }

        .product-table th:last-child {
            border-top-right-radius: 8px;
        }

        .product-table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }

        .product-table input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            transition: all 0.2s ease;
        }

        .product-table input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(67, 97, 238, 0.1);
        }

        .total-row {
            font-weight: 600;
            background-color: rgba(248, 249, 250, 0.7);
        }

        .total-row td {
            padding: 1rem;
        }

        .btn {
            font-weight: 500;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--secondary);
            border-color: var(--secondary);
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-danger:hover {
            background-color: #e5177e;
            border-color: #e5177e;
        }

        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }

        .btn-success:hover {
            background-color: #3aa8d8;
            border-color: #3aa8d8;
            transform: translateY(-2px);
        }

        .action-buttons {
            display: flex;
            justify-content: end;
            padding: 1.5rem;
            background-color: white;
            border-top: 1px solid var(--border);
        }

        /* Declaration Section Styles */
        .declaration-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .declaration-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .declaration-column {
            flex: 1;
            min-width: 250px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .declaration-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }

        .declaration-row:last-child {
            border-bottom: none;
        }

        .signature-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .signature-box {
            width: 100%;
            height: 80px;
            border: 1px dashed #6c757d;
            border-radius: 4px;
            background-color: white;
        }

        .declaration-text {
            border-top: 1px solid #dee2e6;
            padding-top: 1.5rem;
        }

        .declaration-text p {
            margin-bottom: 0.5rem;
        }

        .authorised-signatory {
            margin-top: 1.5rem;
            text-align: right;
        }


        @media (max-width: 768px) {
            .invoice-container {
                margin: 0;
                border-radius: 0;
            }

            .product-table {
                display: block;
                overflow-x: auto;
            }

            .declaration-container {
                flex-direction: column;
                gap: 1.5rem;
            }

            .declaration-column {
                min-width: 100%;
            }
        }
    </style>


    <div class="invoice-container">
        <div class="invoice-header">
            <h1 class="invoice-title text-white">PACKING LIST</h1>
            <p class="invoice-subtitle">Detailed shipment information</p>
        </div>

        <form wire:submit.prevent="saveInvoice" method="POST">
            @csrf
            <input type="hidden" name="type" wire:model="type">

            <!-- Exporter/Buyer Section -->
            <div class="section-card">
                <h3 class="section-title">
                    <i class="fas fa-building"></i>
                    Exporter & Buyer Information
                </h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="exporter" class="form-label">Exporter</label>
                        <input type="text" class="form-control" id="exporter" wire:model="exporter"
                            placeholder="XYZ International Pvt. Ltd." required>
                    </div>
                    <div class="col-md-6">
                        <label for="consignee" class="form-label">Consignee</label>
                        <input type="text" class="form-control" id="consignee" wire:model="consignee"
                            placeholder="ABC Importers Ltd., New York, USA" required>
                    </div>
                    <div class="col-md-6">
                        <label for="buyer" class="form-label">Buyer (if different from consignee)</label>
                        <input type="text" class="form-control" id="buyer" wire:model="buyer_name"
                            placeholder="DEF Trading Co., Los Angeles, USA">
                    </div>
                    <div class="col-md-6">
                        <label for="notifyParty" class="form-label">Notify Party</label>
                        <input type="text" class="form-control" id="notifyParty" wire:model="notify_party"
                            placeholder="GHI Logistics Inc.">
                    </div>
                    <div class="col-md-12">
                        <label for="exporterAddress" class="form-label">Exporter Address</label>
                        <textarea class="form-control" id="exporterAddress" wire:model="exporter_address" rows="2"
                            required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="buyerAddress" class="form-label">Buyer Address</label>
                        <textarea class="form-control" id="buyerAddress" wire:model="buyer_address" rows="2"
                            required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="otherConsignee" class="form-label">Other Consignee</label>
                        <input type="text" class="form-control" id="otherConsignee" wire:model="other_consignee"
                            placeholder="Additional consignee information">
                    </div>
                </div>
            </div>

            <!-- Invoice/Order Section -->
            <div class="section-card">
                <h3 class="section-title">
                    <i class="fas fa-file-invoice"></i>
                    Invoice & Order Details
                </h3>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="invoiceNo" class="form-label">Proforma Invoice No.</label>
                        <input type="text" class="form-control" id="invoiceNo" wire:model="invoice_no"
                            placeholder="PI-2025-001" required>
                    </div>
                    <div class="col-md-4">
                        <label for="invoiceDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="invoiceDate" wire:model="invoice_date" required>
                    </div>
                    <div class="col-md-4">
                        <label for="exporterRef" class="form-label">Exporter Reference</label>
                        <input type="text" class="form-control" id="exporterRef" wire:model="exporter_reference"
                            placeholder="REF-789654">
                    </div>
                    <div class="col-md-6">
                        <label for="buyerOrderNo" class="form-label">Buyer's Order No.</label>
                        <input type="text" class="form-control" id="buyerOrderNo" wire:model="buyer_order_no"
                            placeholder="BO-12345">
                    </div>
                    <div class="col-md-6">
                        <label for="buyerOrderDate" class="form-label">Buyer's Order Date</label>
                        <input type="date" class="form-control" id="buyerOrderDate" wire:model="buyer_order_date">
                    </div>
                </div>
            </div>

            <!-- Shipping Section -->
            <div class="section-card">
                <h3 class="section-title">
                    <i class="fas fa-shipping-fast"></i>
                    Shipping Details
                </h3>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="originCountry" class="form-label">Country of Origin</label>
                        <input type="text" class="form-control" id="originCountry" wire:model="origin_country"
                            placeholder="INDIA" required>
                    </div>
                    <div class="col-md-4">
                        <label for="destinationCountry" class="form-label">Country of Final Destination</label>
                        <input type="text" class="form-control" id="destinationCountry" wire:model="destination_country"
                            placeholder="USA" required>
                    </div>
                    <div class="col-md-4">
                        <label for="preCarriage" class="form-label">Pre Carriage by</label>
                        <input type="text" class="form-control" id="preCarriage" wire:model="pre_carriage"
                            placeholder="Road Transport">
                    </div>
                    <div class="col-md-4">
                        <label for="placeOfReceipt" class="form-label">Place of Receipt by Pre-Carrier</label>
                        <input type="text" class="form-control" id="placeOfReceipt" wire:model="receipt_place"
                            placeholder="Mumbai, India">
                    </div>
                    <div class="col-md-4">
                        <label for="vesselNo" class="form-label">Vessel/Flight No.</label>
                        <input type="text" class="form-control" id="vesselNo" wire:model="vessel_flight_no"
                            placeholder="EK-501">
                    </div>
                    <div class="col-md-4">
                        <label for="portOfLoading" class="form-label">Port of Loading</label>
                        <input type="text" class="form-control" id="portOfLoading" wire:model="port_loading"
                            placeholder="Nhava Sheva, India">
                    </div>
                    <div class="col-md-4">
                        <label for="portOfDischarge" class="form-label">Port of Discharge</label>
                        <input type="text" class="form-control" id="portOfDischarge" wire:model="port_discharge"
                            placeholder="New York Port, USA">
                    </div>
                    <div class="col-md-4">
                        <label for="finalDestination" class="form-label">Final Destination</label>
                        <input type="text" class="form-control" id="finalDestination" wire:model="final_destination"
                            placeholder="Los Angeles, USA">
                    </div>
                    <div class="col-md-4">
                        <label for="marksNo" class="form-label">Marks & No.</label>
                        <input type="text" class="form-control" id="marksNo" wire:model="marks_no"
                            placeholder="ABC-789">
                    </div>
                    <div class="col-md-4">
                        <label for="containerNo" class="form-label">Container No.</label>
                        <input type="text" class="form-control" id="containerNo" wire:model="container_no"
                            placeholder="CTN-456123">
                    </div>
                    <div class="col-md-4">
                        <label for="packageNo" class="form-label">No. & kind of Packages</label>
                        <input type="text" class="form-control" id="packageNo" wire:model="kind_pkg"
                            placeholder="50 Cartons">
                    </div>
                    <div class="col-md-4">
                        <label for="packageNo" class="form-label">Currency</label>
                        <input type="text" class="form-control" id="currency" wire:model="currency"
                            placeholder="Enter currency">
                    </div>
                    <div class="col-md-8">
                        <label for="goodsDescription" class="form-label">Description of Goods</label>
                        <input type="text" class="form-control" id="goodsDescription" wire:model="description_goods"
                            placeholder="Organic Green Peas">
                    </div>
                    <div class="col-md-6">
                        <label for="paymentTerms" class="form-label">Payment Terms</label>
                        <input type="text" class="form-control" id="paymentTerms" wire:model="terms"
                            placeholder="50% Advance Payment">
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="section-card">
                <h3 class="section-title">
                    <i class="fas fa-boxes"></i>
                    Product Items
                </h3>

                <div class="table-responsive">
                    <table class="table product-table table-bordered" id="productTable">
                        <thead>
                            <tr>
                                <th>PRODUCT DESCRIPTION</th>
                                <th>HS CODE</th>
                                <th>Model/Style/Grade</th>
                                <th>Box/Bundle/Bag/Dunn-No</th>
                                <th>Pieces</th>
                                <th>Net Weight (kg)</th>
                                <th>Gross Weight (kg)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            @foreach($products as $index => $product)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model="products.{{ $index }}.product_name" placeholder="Organic Green Peas"
                                            required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" wire:model="products.{{ $index }}.hs_code"
                                            placeholder="07131010" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model="products.{{ $index }}.quantity_box" placeholder="Premium Grade">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control packageNo"
                                            wire:model="products.{{ $index }}.quantity_kg" placeholder="Box-001">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control pieces"
                                            wire:model="products.{{ $index }}.pieces" placeholder="500" min="0" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control net-weight"
                                            wire:model="products.{{ $index }}.net_weight" placeholder="2500.00" min="0"
                                            step="0.01" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control gross-weight"
                                            wire:model="products.{{ $index }}.gross_weight" placeholder="2700.00" min="0"
                                            step="0.01" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" wire:click="removeItem({{ $index }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="4" class="text-end"><strong>Total</strong></td>
                                <td id="totalPieces">0</td>
                                <td id="totalNetWeight">0.00</td>
                                <td id="totalGrossWeight">0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <button type="button" class="btn btn-primary" wire:click="addItem">
                    <i class="fas fa-plus-circle"></i> Add Product
                </button>
            </div>

            <!-- Declaration Section -->
            <div class="section-card declaration-section">
                <div class="declaration-container">
                    <!-- Left Column -->
                    <div class="declaration-column">
                        <div class="declaration-row">
                            <strong>Net Weight:</strong>
                            <span id="declarationNetWeight">0.00 kg</span>
                        </div>
                        <div class="declaration-row">
                            <strong>Gross Weight:</strong>
                            <span id="declarationGrossWeight">0.00 kg</span>
                        </div>
                        <div class="declaration-row">
                            <strong>No. of Boxes/Bundles/Easy/Drums:</strong>
                            <span id="declarationPackageCount">0</span>
                        </div>
                        <div class="declaration-row">
                            <strong>CBM</strong>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="declaration-column">
                        <div class="declaration-row signature-row">
                            <strong>Signature & Date</strong>
                            <div class="signature-box"></div>
                        </div>
                        <div class="declaration-row">
                            <strong>For (Company Name)</strong>
                        </div>
                    </div>
                </div>

                <div class="declaration-text">
                    <h6><strong>Declaration:</strong></h6>
                    <p>We intend to claim Rewards under RoofTP Scheme</p>
                    <p>We declare that this invoice shows the actual price of the goods described and that all
                        particulars are true and correct.</p>
                    <p class="authorised-signatory"><strong>Authorised Signatory</strong></p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                {{-- <button type="button" class="btn btn-outline-secondary">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button> --}}
                {{-- <div> --}}
                    {{-- <button type="reset" class="btn btn-outline-danger me-2">
                        <i class="fas fa-trash-alt"></i> Reset
                    </button> --}}
                    <button type="submit" class="btn btn-outline-success">
                        <i class="fas fa-save"></i> Save Invoice
                    </button>
                    {{--
                </div> --}}
            </div>
        </form>

    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set today's date as default for invoice date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('invoiceDate').value = today;

            // Add product row
            document.getElementById('addProductBtn').addEventListener('click', addProductRow);

            // Initialize with one empty product row
            addProductRow();

            // Form submission
            document.getElementById('invoiceForm').addEventListener('submit', function (e) {
                e.preventDefault();

                // Show success state
                const saveBtn = document.querySelector('.btn-success');
                const originalHtml = saveBtn.innerHTML;
                saveBtn.innerHTML = '<i class="fas fa-check"></i> Saved!';
                saveBtn.classList.add('disabled');

                // Reset button after 2 seconds
                setTimeout(() => {
                    saveBtn.innerHTML = originalHtml;
                    saveBtn.classList.remove('disabled');
                }, 2000);

                // Here you would typically send the data to a server
                console.log('Invoice data:', collectFormData());
            });

            // Calculate totals when any input changes in the product table
            document.getElementById('productTableBody').addEventListener('input', calculateTotals);
        });

        function addProductRow() {
            const tbody = document.getElementById('productTableBody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" class="form-control" placeholder="Organic Green Peas" required></td>
                <td><input type="text" class="form-control" placeholder="07131010" required></td>
                <td><input type="text" class="form-control" placeholder="Premium Grade"></td>
                <td><input type="text" class="form-control" placeholder="Box-001"></td>
                <td><input type="number" class="form-control pieces" placeholder="500" min="0" required></td>
                <td><input type="number" class="form-control net-weight" placeholder="2500.00" min="0" step="0.01" required></td>
                <td><input type="number" class="form-control gross-weight" placeholder="2700.00" min="0" step="0.01" required></td>
                <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-times"></i></button></td>
            `;
            tbody.appendChild(row);

            // Add event listener to the remove button
            row.querySelector('.remove-row').addEventListener('click', function () {
                if (confirm('Are you sure you want to remove this product?')) {
                    row.remove();
                    calculateTotals();
                }
            });

            // Add event listeners to the new inputs for calculating totals
            row.querySelectorAll('.pieces, .net-weight, .gross-weight').forEach(input => {
                input.addEventListener('input', calculateTotals);
            });

            // Scroll to the new row
            row.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function calculateTotals() {
            let totalPieces = 0;
            let totalNetWeight = 0;
            let totalGrossWeight = 0;
            let totalPackages = 0;

            document.querySelectorAll('#productTableBody tr').forEach(row => {
                const pieces = parseFloat(row.querySelector('.pieces').value) || 0;
                const netWeight = parseFloat(row.querySelector('.net-weight').value) || 0;
                const grossWeight = parseFloat(row.querySelector('.gross-weight').value) || 0;
                const packageNo = row.querySelector('.packageNo').value;

                totalPieces += pieces;
                totalNetWeight += netWeight;
                totalGrossWeight += grossWeight;

                // Count non-empty package numbers
                if (packageNo && packageNo.trim() !== '') {
                    totalPackages++;
                }
            });

            document.getElementById('totalPieces').textContent = totalPieces;
            document.getElementById('totalNetWeight').textContent = totalNetWeight.toFixed(2);
            document.getElementById('totalGrossWeight').textContent = totalGrossWeight.toFixed(2);

            // Update declaration section
            document.getElementById('declarationNetWeight').textContent = totalNetWeight.toFixed(2) + ' kg';
            document.getElementById('declarationGrossWeight').textContent = totalGrossWeight.toFixed(2) + ' kg';
            document.getElementById('declarationPackageCount').textContent = totalPackages;
        }

        // Add event listeners to recalculate when inputs change
        document.addEventListener('DOMContentLoaded', function () {
            // Calculate initial totals
            calculateTotals();

            // Listen for changes in the product table
            document.getElementById('productTableBody').addEventListener('input', function (e) {
                if (e.target.classList.contains('pieces') ||
                    e.target.classList.contains('net-weight') ||
                    e.target.classList.contains('gross-weight') ||
                    e.target.classList.contains('packageNo')) {
                    calculateTotals();
                }
            });
        });

        function collectFormData() {
            const formData = {
                exporter: document.getElementById('exporter').value,
                consignee: document.getElementById('consignee').value,
                buyer: document.getElementById('buyer').value,
                notifyParty: document.getElementById('notifyParty').value,
                invoiceNo: document.getElementById('invoiceNo').value,
                invoiceDate: document.getElementById('invoiceDate').value,
                exporterRef: document.getElementById('exporterRef').value,
                buyerOrderNo: document.getElementById('buyerOrderNo').value,
                buyerOrderDate: document.getElementById('buyerOrderDate').value,
                originCountry: document.getElementById('originCountry').value,
                destinationCountry: document.getElementById('destinationCountry').value,
                preCarriage: document.getElementById('preCarriage').value,
                placeOfReceipt: document.getElementById('placeOfReceipt').value,
                vesselNo: document.getElementById('vesselNo').value,
                portOfLoading: document.getElementById('portOfLoading').value,
                portOfDischarge: document.getElementById('portOfDischarge').value,
                finalDestination: document.getElementById('finalDestination').value,
                marksNo: document.getElementById('marksNo').value,
                containerNo: document.getElementById('containerNo').value,
                packageNo: document.getElementById('packageNo').value,
                goodsDescription: document.getElementById('goodsDescription').value,
                deliveryTerms: document.getElementById('deliveryTerms').value,
                paymentTerms: document.getElementById('paymentTerms').value,
                products: []
            };

            document.querySelectorAll('#productTableBody tr').forEach(row => {
                formData.products.push({
                    description: row.querySelector('td:nth-child(1) input').value,
                    hsCode: row.querySelector('td:nth-child(2) input').value,
                    grade: row.querySelector('td:nth-child(3) input').value,
                    packageNo: row.querySelector('td:nth-child(4) input').value,
                    pieces: row.querySelector('td:nth-child(5) input').value,
                    netWeight: row.querySelector('td:nth-child(6) input').value,
                    grossWeight: row.querySelector('td:nth-child(7) input').value
                });
            });

            return formData;
        }
    </script>


</div>