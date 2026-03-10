<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">

        <div class="content p-0 m-0">
            <nav class="my-5" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Export-Information</li>
                </ol>
            </nav>
            <div class="row  mb-4 justify-content-between">
                <div class="col-xxl-6">
                    <div class="row g-3 mb-3">
                        <div>
                            <style>
                                .export-resources h2 {
                                    color: #2c3e50;
                                    border-bottom: 2px solid #3498db;
                                    font-size: 28px;
                                    margin-bottom: 30px;
                                    padding-bottom: 20px;
                                }

                                .resource-category {
                                    margin-bottom: 30px;
                                    overflow: hidden;
                                }

                                .category-title {
                                    background: #cecece;
                                    color: rgb(0, 0, 0);
                                    padding: 12px 20px;
                                    font-size: 18px;
                                    font-weight: 600;
                                }

                                .resource-item {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    border-radius: 8px;
                                    padding: 15px 20px;
                                    border-bottom: 1px solid #e0e0e0;
                                    transition: background 0.2s;
                                    background: #ffffff;

                                }

                                .resource-item:hover {
                                    background: #ffffff;
                                }

                                .resource-item:last-child {
                                    border-bottom: none;
                                }

                                .resource-name {
                                    font-size: 16px;
                                    color: #34495e;
                                    flex-grow: 1;
                                }

                                .resource-btn {
                                    padding: 8px 16px;
                                    text-decoration: none;
                                    color: white;
                                    border-radius: 4px;
                                    font-size: 14px;
                                    font-weight: 500;
                                    width: 33%;
                                    text-align: center;
                                    transition: transform 0.2s, box-shadow 0.2s;
                                }

                                .resource-btn:hover {
                                    transform: translateY(-2px);
                                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                                }

                                .btn-download {
                                    background-color: #27ae60;
                                }

                                .btn-download:hover {
                                    background-color: #219653;
                                }

                                .btn-click {
                                    background-color: #2980b9;
                                }

                                .btn-click:hover {
                                    background-color: #2472a4;
                                }

                                .sub-item {
                                    padding-left: 30px;
                                    background: #ffffff;
                                }

                                .sub-item .resource-name {
                                    font-size: 15px;
                                    color: #7f8c8d;
                                }

                                .resource-category img {
                                    width: 50px;
                                    height: 50px;
                                    margin: 0 10px;
                                }

                                @media (max-width: 768px) {
                                    .resource-item {
                                        flex-direction: column;
                                        align-items: center;
                                    }

                                    .resource-btn {
                                        margin-top: 10px;
                                        align-self: center;
                                        width: 70%;
                                    }
                                }

                                @media (max-width: 1024px) {
                                    .resource-item {
                                        flex-direction: column;
                                        align-items: center;
                                    }

                                    .resource-btn {
                                        margin-top: 10px;
                                        align-self: center;
                                        width: 70%;
                                    }
                                }
                            </style>

                            <div class="export-resources row justify-content-between align-items-center">

                                <h2>Export Information and Resources</h2>

                                <div class="resource-category col-12 col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/onlineregistration.png"
                                            alt="">
                                        <span class="resource-name">RCMC Registration & Renewal</span>
                                        <a href="https://www.dgft.gov.in/CP/?opt=e-rcmc" target="_blank"
                                            class="resource-btn btn-click">Access
                                            Portal</a>
                                    </div>
                                </div>


                                <div class="resource-category col-12 col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/barcode111.png" alt="">
                                        <span class="resource-name">Get the barcode for your products</span>
                                        <a href="https://yesbarcode.com/instant-barcodes" target="_blank"
                                            class="resource-btn btn-click">Access
                                            Portal</a>
                                    </div>
                                </div>



                                {{-- <div class="category-title">3. Exports by Courier</div> --}}
                                <div class="resource-category col-md-6 ">

                                    <div class="resource-item  ">
                                        <img src="../../assets/img/seller-dashboard-icons/mail.png" alt="">
                                        <span class="resource-name">India Post Booking</span>
                                        <a href="https://www.indiapost.gov.in/VAS/Pages/calculatePostage.aspx"
                                            class="resource-btn btn-click" target="_blank">Book Now</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6 ">
                                    <div class="resource-item  ">
                                        <img src="../../assets/img/seller-dashboard-icons/fedex.png" alt="">
                                        <span class="resource-name">FEDEX Booking</span>
                                        <a href="https://www.fedex.com/en-in/customer-support/contact.html"
                                            class="resource-btn btn-click" target="_blank">Book
                                            Now</a>
                                    </div>
                                </div>
                                <div class="resource-category col-md-6">
                                    <div class="resource-item  ">
                                        <img src="../../assets/img/seller-dashboard-icons/dhl.png" alt="">
                                        <span class="resource-name">DHL Booking</span>
                                        <a href="https://www.dhl.com/in-en/home/book-online.html"
                                            class="resource-btn btn-click" target="_blank">Book Now</a>
                                    </div>
                                </div>


                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/analytics.png" alt="">
                                        <span class="resource-name">India's Trade Statistics</span>
                                        <a href="https://www.commerce.gov.in/trade-statistics" target="_blank"
                                            class="resource-btn btn-click">View
                                            Statistics</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/trade-agreement.png" alt="">
                                        <span class="resource-name">India's Trade Agreements</span>
                                        <a href="https://www.commerce.gov.in/international-trade/trade-agreements"
                                            class="resource-btn btn-click" target="_blank">View Agreements</a>
                                    </div>
                                </div>

                                <div class="resource-category col-12 col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/loudspeaker.png" alt="">
                                        <span class="resource-name">List of Export Promotion Councils</span>
                                        <a href="../../assets/img/documents/Export promotion councils List.pdf"
                                            class="resource-btn btn-download" download>Download
                                            PDF</a>
                                    </div>
                                </div>

                                {{-- <div class="category-title">6. India's Export Performance</div> --}}
                                <div class="resource-category col-md-6">

                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/good-feedback.png" alt="">
                                        <span class="resource-name">Chapter-wise Export Performance</span>
                                        <a href="../../assets/img/documents/India Chapter wise exports.xlsx"
                                            class="resource-btn btn-download" download>Download Report</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/export (1).png" alt="">
                                        <span class="resource-name">All Commodity Export Performance</span>
                                        <a href="../../assets/img/documents/Export performance all products.xlsx"
                                            class="resource-btn btn-download" download>Download Report</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/countries.png" alt="">
                                        <span class="resource-name">Country-wise Export Performance</span>
                                        <a href="../../assets/img/documents/Country wise export performance.xlsx"
                                            download class="resource-btn btn-download">Download Report</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/pricing.png" alt="">
                                        <span class="resource-name">Costing and Price Calculation</span>
                                        <a href="../../assets/img/documents/Sample export Costing Sheet.pdf"
                                            class="resource-btn btn-download" download>Download Guide</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/forbidden.png" alt="">
                                        <span class="resource-name">Restricted and Prohibited Products</span>
                                        <a href="../../assets/img/documents/Restricted and Prohibited Items in Shipping.pdf"
                                            class="resource-btn btn-download" download>Download List</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/packaging.png" alt="">
                                        <span class="resource-name">SCOMET Items</span>
                                        <a href="../../assets/img/documents/SCOMET PRODUCTS.pdf"
                                            class="resource-btn btn-download" download>Download List</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/terms.png" alt="">
                                        <span class="resource-name">Incoterms</span>
                                        <a href="../../assets/img/documents/INCOTERMS guide.pdf"
                                            class="resource-btn btn-download" download>Download Guide</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/checklist.png" alt="">
                                        <span class="resource-name">Shipment Checklist</span>
                                        <a href="../../assets/img/documents/Export Shipment Check list.pdf"
                                            class="resource-btn btn-download" download>Download Checklist</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item">
                                        <img src="../../assets/img/seller-dashboard-icons/planning.png" alt="">
                                        <span class="resource-name">Action Plan for New Entrepreneur/Exporter</span>
                                        <a href="../../assets/img/documents/Action_Plan.pdf"
                                            class="resource-btn btn-small btn-download" download>Download Guide</a>
                                    </div>
                                </div>

                                {{-- <div class="category-title">Export Documents</div> --}}


                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/document.png" alt="">
                                        <span class="resource-name">Shipping Bill Copy</span>
                                        <a href="../../assets/img/documents/Shipping _Bill Copy.pdf"
                                            class="resource-btn btn-download" download>Download</a>
                                    </div>
                                </div>


                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/coo.png" alt="">
                                        <span class="resource-name">COO Copy</span>
                                        <a href="../../assets/img/documents/GSP Form Certificate of Origin.pdf"
                                            class="resource-btn btn-download" download>Download</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/apeda.png" alt="">
                                        <span class="resource-name">APEDA Copy</span>
                                        <a href="../../assets/img/documents/APEDA_Certificate.pdf"
                                            class="resource-btn btn-download" download>Download</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/coconut.png" alt="">
                                        <span class="resource-name">Coconut Board Copy</span>
                                        <a href="../../assets/img/documents/Coconu board.pdf"
                                            class="resource-btn btn-download" download>Download</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/cepta.png" alt="">
                                        <span class="resource-name">CEPTA Copy</span>
                                        <a href="../../assets/img/documents/SAPTA Certificate.pdf"
                                            class="resource-btn btn-download" download>Download</a>
                                    </div>
                                </div>

                                <div class="resource-category col-md-6">
                                    <div class="resource-item ">
                                        <img src="../../assets/img/seller-dashboard-icons/phytotherapy.png" alt="">
                                        <span class="resource-name">Phyto Copy</span>
                                        <a href="../../assets/img/documents/Phyto certificate.pdf"
                                            class="resource-btn btn-download" download>Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>

                        @if (session()->has('message'))
                            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                                role="alert" id="alert">
                                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:seller.layout.footer />

</div>