<div>

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
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
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .header {
            border-bottom: 2px solid var(--primary-color);
            margin-bottom: 30px;
            padding-bottom: 20px;
        }

        .address-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .address-table td {
            vertical-align: top;
            padding: 10px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .items-table th {
            background-color: var(--primary-color);
            color: white;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .items-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .items-table tr:hover {
            background-color: #e9ecef;
        }

        .total-row {
            font-weight: bold;
            background-color: var(--light-color) !important;
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

        .reference {
            background-color: var(--light-color);
            padding: 10px;
            border-left: 4px solid var(--secondary-color);
            margin: 15px 0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .action-buttons {
            margin-top: 20px;
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
        <form wire:submit.prevent="savePurchaseOrder" method="POST">
            @csrf
            <div class="header">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-primary">PURCHASE ORDER</h1>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-success no-print">
                            <i class="fas fa-save"></i> Save Invoice
                        </button>
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Validation Errors -->

            <table class="address-table">
                <tr>
                    <td>
                        <div class="mb-3">
                            <label for="toName" class="form-label"><strong>To:</strong></label>
                            <input type="text" class="form-control" id="toName" name="company_name"
                                wire:model="company_name">
                            @error('company_name') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="toAddress" class="form-label"><strong>Address:</strong></label>
                            <textarea class="form-control" id="toAddress" rows="2" name="company_address"
                                wire:model="company_address"></textarea>
                            @error('company_address') <div class="alert fw-semibold text-danger p-2">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="toEmail" class="form-label"><strong>Email:</strong></label>
                                <input type="email" class="form-control" id="toEmail" name="company_email"
                                    wire:model="company_email">
                                @error('company_email') <div class="alert fw-semibold text-danger p-2">{{ $message }}
                                </div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="toContactPerson" class="form-label"><strong>Contact Person:</strong></label>
                                <input type="text" class="form-control" id="toContactPerson" name="contact_person"
                                    wire:model="contact_person">
                                @error('contact_person') <div class="alert fw-semibold text-danger p-2">{{ $message }}
                                </div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="toRegNo" class="form-label"><strong>Company Registration No.:</strong></label>
                            <input type="text" class="form-control" id="toRegNo" name="company_registration"
                                wire:model="company_registration">
                            @error('company_registration') <div class="alert fw-semibold text-danger p-2">{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <label for="poNumber" class="form-label"><strong>PO No.:</strong></label>
                            <input type="text" class="form-control" id="poNumber" name="po_number"
                                wire:model="po_number">
                            @error('po_number') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="invoiceDate" class="form-label"><strong>Date:</strong></label>
                            <input type="date" class="form-control" id="invoiceDate" name="po_date"
                                wire:model="po_date">
                            @error('po_date') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="poNumber" class="form-label"><strong>Currency:</strong></label>
                            <input type="text" class="form-control" id="currency" name="currency" wire:model="currency">
                            @error('currency') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                </tr>
            </table>

            <p>Dear Sir,</p>

            <div class="reference">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="refNumber" class="form-label"><strong>Ref:</strong></label>
                        <input type="text" class="form-control" id="refNumber" name="invoice_number"
                            wire:model="invoice_number">
                        @error('invoice_number') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="refDate" class="form-label"><strong>Dated:</strong></label>
                        <input type="date" class="form-control" id="refDate" name="invoice_date"
                            wire:model="invoice_date">
                        @error('invoice_date') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <p>We are pleased to place an order with your company for the supply of agricultural products as per the
                following details:</p>

            <table class="items-table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">Sr. No.</th>
                        <th width="20%">Commodity</th>
                        <th width="20%">Grade & Specification</th>
                        <th width="12%">Quantity</th>
                        <th width="12%">Rate</th>
                        <th width="12%">Amount</th>
                        <th width="15%">Payment Terms</th>
                        <th width="10%" class="no-print">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr class="item-row">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-control" wire:model="items.{{ $index }}.commodity">
                                @error('commodity') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control" wire:model="items.{{ $index }}.grade_specification">
                                @error('grade_specification') <div class="alert fw-semibold text-danger p-2">{{ $message }}
                                </div> @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control" wire:model="items.{{ $index }}.quantity">
                                @error('quantity') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control" wire:model="items.{{ $index }}.rate">
                                @error('rate') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control amount" wire:model="items.{{ $index }}.amount">
                                @error('amount') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control" wire:model="items.{{ $index }}.payment_terms">
                                @error('payment_terms') <div class="alert fw-semibold text-danger p-2">{{ $message }}</div>
                                @enderror
                            </td>
                            <td class="no-print text-center">
                                <button type="button" wire:click="removeItem({{ $index }})"
                                    class="btn btn-outline-danger btn-sm">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="4"></td>
                        <td><strong>Total</strong></td>
                        <td><strong id="totalAmount">$0.00</strong></td>
                        <td colspan="2" class="no-print"></td>
                    </tr>
                </tfoot>
            </table>

            <div class="action-buttons no-print">
                <button type="button" wire:click="addItem" class="btn btn-primary-custom text-white">
                    <i class="fas fa-plus"></i> Add Item
                </button>
            </div>

            <div class="terms mt-4">
                <h5>Terms & Conditions:</h5>
                <ol>
                    <li>Payment to be made within 15 days from the date of invoice.</li>
                    <li>Goods once sold will not be taken back.</li>
                    <li>Interest @18% p.a. will be charged on overdue payments.</li>
                    <li>Subject to Mumbai Jurisdiction only.</li>
                </ol>
            </div>

            <div class="signature mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Receiver's Signature</strong></p>
                        <p>_________________________</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p><strong>For ABC Enterprises</strong></p>
                        <p>_________________________</p>
                        <p>Authorized Signatory</p>
                    </div>
                </div>
            </div>
        </form>

    </div>


    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Format currency
            function formatCurrency(amount) {
                return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            // Function to calculate the total amount
            function updateTotal() {
                let totalAmount = 0;

                // Loop through all the 'amount' input fields
                document.querySelectorAll('.amount').forEach(function (input) {
                    // Add the value to the total amount (parse as float, default to 0 if NaN)
                    totalAmount += parseFloat(input.value) || 0;
                });

                // Update the total amount in the footer
                document.getElementById('totalAmount').textContent = formatCurrency(totalAmount);
            }

            // Attach event listeners for input fields to update the total when changed
            document.addEventListener('input', function (e) {
                if (e.target.classList.contains('amount')) {
                    updateTotal(); // Recalculate the total when any of these fields change
                }
            });
            updateTotal();

            // Add new row when the button is clicked
            document.getElementById('addItem').addEventListener('click', function () {
                const tableBody = document.querySelector('.items-table tbody');
                const rowCount = tableBody.querySelectorAll('.item-row').length;
                const newRow = document.createElement('tr');
                newRow.className = 'item-row';
                newRow.innerHTML = `
            <td>${rowCount + 1}</td>
            <td><input type="text" class="form-control" name="commodity[]"></td>
            <td><input type="text" class="form-control" name="grade_specification[]"></td>
            <td><input type="number" class="form-control quantity" name="quantity[]" min="1"></td>
            <td><input type="number" class="form-control rate" name="rate[]" min="0" step="0.01"></td>
            <td><input type="number" class="form-control amount" name="amount[]" placeholder="0.00" step="0.01"></td>
            <td><input type="text" class="form-control" name="payment_terms[]"></td>
            <td class="no-print text-center">
                <button type="button" class="btn btn-outline-danger btn-sm remove-item">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </td>
        `;
                tableBody.appendChild(newRow);
                updateInvoiceTotal();  // Update total after adding a row
            });

            // Remove row when the delete button is clicked
            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-item')) {
                    e.target.closest('.item-row').remove();
                    updateInvoiceTotal();  // Update total after removing a row
                    // Update row numbers
                    document.querySelectorAll('.items-table .item-row').forEach((row, index) => {
                        row.cells[0].textContent = index + 1;  // Update Sr. No.
                    });
                }
            });
        });

    </script>

</div>