{{-- <div>
    <livewire:seller.layout.header />


    <style>
        body {
            background-color: #f4f6f9;
        }

        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
    <div class="container mt-5">
        <nav class="" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools') }}">Tools</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quotation-form</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid py-5">
        <div class="d-flex flex-wrap justify-content-center align-items-center">
            <div class="col-lg-11 bg-primary d-flex rounded-4 overflow-hidden shadow-lg align-items-center">

                <div class="col-md-4 bg-primary text-white p-4 ">
                    <div>
                        <h4 class="text-white">Quotation Summary</h4>
                        <p class="mt-3 small">Fill in the details to generate a complete quotation. You can print or
                            download it later.</p>
                    </div>
                    <div>
                        <i class="bi bi-file-earmark-text fs-1"></i>
                    </div>
                </div>

                <div class="col-md-8 bg-white p-4">
                    <h5 class="mb-3">Buyer Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Buyer Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="tel" class="form-control" placeholder="Phone">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" placeholder="Address" rows="2" required></textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Product Details</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Product Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Quantity" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" placeholder="Packing Details" rows="2" required></textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Delivery Terms" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Payment Terms" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Price/Metric Ton" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Freight Charges" required>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button class="btn btn-success">Generate Quotation</button>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <livewire:seller.layout.footer />

</div> --}}