<div>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card-container {
            position: relative;
            width: 794px;
            /* A4 width at 96 DPI */
            height: 1120px;
            /* A4 height at 96 DPI */
            margin: 0 auto;
            background: url('{{ $imageSrc }}') no-repeat center center;
            background-size: cover;
            /* display: flex;
            flex-direction: column;
            justify-content: space-between; */
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .style1 .logo-container1 {
            position: absolute;
            top: 70px;
            left: 50px;
        }

        .style1 .header-text h2 {
            margin: 0;
            font-size: 24px;
            max-width: 400px;
            /* set width as you like */
            word-wrap: break-word;
            /* break long words */
            white-space: normal;
            line-height: 27px;
        }

        .style1 .header-text h3 {
            margin: 0;
            font-size: 16px;
            color: gray;
        }

        .style1 .address {
            position: absolute;
            top: 991px;
            left: 160px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style1 .email {
            position: absolute;
            top: 993px;
            left: 493px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style1 .phone_no {
            position: absolute;
            top: 1037px;
            left: 160px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style1 .web_link {
            position: absolute;
            top: 1037px;
            left: 493px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style2 .logo-container1 {
            position: absolute;
            top: 15px;
            right: 45px;
        }

        .style2 .header-text h2 {
            margin: 0;
            text-align: end;
            color: white;
            font-size: 22px;
            max-width: 330px;
            /* max-width: 400px; */
            /* set width as you like */
            word-wrap: break-word;
            /* break long words */
            white-space: normal;
            line-height: 27px;
        }

        .style2 .header-text h3 {
            margin: 0;
            font-size: 15px;
            color: rgb(219, 215, 215);
        }

        .style2 .address {
            position: absolute;
            top: 170px;
            right: 310px;
            color: white;
            /* font-size: 9.5px; */
        }

        .style2 .wid {
            text-align: end;
        }

        .style2 .email {
            position: absolute;
            top: 172px;
            right: 75px;
            color: white;
            /* font-size: 9.5px; */
        }

        .style2 .phone_no {
            position: absolute;
            top: 131px;
            right: 75px;
            color: white;
            /* font-size: 9.5px; */
        }

        .style2 .web_link {
            position: absolute;
            top: 130px;
            right: 310px;
            color: white;
            /* font-size: 9.5px; */
        }

        .style3 .logo-container1 {
            position: absolute;
            top: 35px;
            right: 40px;
        }

        .style3 .header-text h2 {
            margin: 0;
            /* text-align: end; */
            line-height: 25px;
            color: #2a7b0d;
            font-size: 20px;
            width: 270px;
            /* max-width: 330px; */
            /* max-width: 400px; */
            /* set width as you like */
            word-wrap: break-word;
            /* break long words */
            white-space: normal;
            line-height: 27px;
        }

        .style3 .header-text h3 {
            margin: 0;
            font-size: 14px;
            text-align: end;
            color: #2a7b0db0;
        }

        .style3 .address {
            position: absolute;
            top: 1055px;
            left: 135px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style3 .email {
            position: absolute;
            top: 1055px;
            left: 425px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style3 .phone_no {
            position: absolute;
            top: 1090px;
            left: 135px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style3 .web_link {
            position: absolute;
            top: 1090px;
            left: 425px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style4 .logo-container1 {
            position: absolute;
            top: 35px;
            left: 45px;
        }

        .style4 .header-text h2 {
            margin: 0;
            font-size: 20px;
            /* width: 230px; */
            max-width: 330px;
            word-wrap: break-word;
            white-space: normal;
            line-height: 27px;
        }

        .style4 .header-text h3 {
            margin: 0;
            font-size: 16px;
            color: gray;
        }

        .style4 .address {
            position: absolute;
            top: 1009px;
            left: 295px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style4 .email {
            position: absolute;
            top: 1009px;
            left: 590px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style4 .phone_no {
            position: absolute;
            top: 1060px;
            left: 295px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style4 .web_link {
            position: absolute;
            top: 1060px;
            left: 590px;
            /* color: white; */
            font-size: 9.5px;
        }

        .style5 .logo-container1 {
            position: absolute;
            top: 45px;
            left: 45px;
        }

        .style5 .header-text h2 {
            margin: 0;
            /* text-align: end; */
            color: white;
            font-size: 21px;
            /* width: 305px; */
            /* line-height: 27px; */

            max-width: 330px;
            /* max-width: 400px; */
            /* set width as you like */
            word-wrap: break-word;
            /* break long words */
            white-space: normal;
            line-height: 27px;
        }

        .style5 .header-text h3 {
            margin: 0;
            font-size: 15px;
            color: rgb(219, 215, 215);
        }

        .style5 .address {
            position: absolute;
            top: 991.5px;
            left: 105px;
            color: #104006;
            font-weight: 600;
            font-size: 12px;
        }

        .style5 .wid-style5 {
            width: 400px !important;
        }

        .style5 .email {
            position: absolute;
            top: 126px;
            left: 560px;
            color: #104006;
            font-weight: 600;
            font-size: 12px;
        }

        .style5 .phone_no {
            position: absolute;
            top: 99px;
            left: 560px;
            color: #104006;
            font-weight: 600;
            font-size: 12px;
        }

        .style5 .web_link {
            position: absolute;
            top: 155px;
            left: 560px;
            color: #104006;
            font-weight: 600;
            font-size: 12px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.3;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 11px;
        }

        .icon {
            width: 20px;
            height: 20px;
            fill: #333;
        }

        .footer-divider {
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #777;
        }

        .alert-warning {
            text-align: center;
            padding: 20px;
            color: red;
        }

        .fixed-download-button {
            position: absolute;
            top: 10px;
            right: 20px;
            z-index: 9999;
        }

        .download-card {
            width: 200px;
            padding: 15px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .download-card-child {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #f0f7ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    @php
        $logoPath = storage_path('app/public/' . $letterHeads->logo ?? '');
        $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
    @endphp

    @if ($letterHeads)
        <div class="no-print fixed-download-button">
            <div class="download-card" onclick="downloadPdf()">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div class="download-card-child">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 15V3M12 15L8 11M12 15L16 11M21 15V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V15"
                                stroke="#4a6cf7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #333;">Download</div>
                        <div style="font-size: 12px; color: #777;">PDF Format</div>
                    </div>
                </div>
            </div>

        </div>
        <div id="pdf-content" class="pdf-container">
            <div class="card-container {{ $type }}">

                {{-- Logo and Header --}}
                {{-- <div class="logo-container1 d-flex gap-2 align-items-center">
                    @if ($logoBase64)
                        <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo"
                            style="width: 70px; height: 70px;">
                    @endif
                    <div class="header-text">
                        <h2>{{ $letterHeads->company_name }}</h2>
                        <h3>Professional Solutions</h3>
                    </div>
                </div> --}}
                <div class="logo-container1 d-flex gap-2 align-items-center">
                    @if ($type === 'style2')
                        <div class="header-text">
                            <h2>{{ $letterHeads->company_name }}</h2>
                            {{-- <h3>Professional Solutions</h3> --}}
                        </div>
                        @if ($logoBase64)
                            <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo"
                                style="width: 70px; height: 70px;">
                        @endif
                    @else
                        @if ($logoBase64)
                            <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo"
                                style="width: 70px; height: 70px;">
                        @endif
                        <div class="header-text">
                            <h2>{{ $letterHeads->company_name }}</h2>
                            {{-- <h3>Professional Solutions</h3> --}}
                        </div>
                    @endif
                </div>


                {{-- Watermark --}}
                @if ($logoBase64)
                    <div class="watermark">
                        <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Watermark"
                            style="width: 200px; height: 200px;">
                    </div>
                @endif

                {{-- Footer --}}
                <div class="footer-section">
                    <div class="contact-grid">
                        <div class="contact-item address">
                            {{-- <img src="{{ trim($icons['location']) }}" alt="Location" width="18" height="18" /> --}}
                            <p class="mb-0 wid wid-style5"
                                style="width: 210px; overflow-wrap: break-word; word-wrap: break-word;">
                                {{ $letterHeads->company_address }}
                            </p>
                        </div>
                        <div class="contact-item email">
                            {{-- <img src="{{ trim($icons['email']) }}" alt="email" width="18" height="18" /> --}}
                            <p class="mb-0 wid" style="width: 190px;">{{ $letterHeads->company_email }}</p>
                        </div>
                        <div class="contact-item phone_no">
                            {{-- <img src="{{ trim($icons['phone']) }}" alt="phone" width="18" height="18" /> --}}
                            <p class="mb-0">{{ $letterHeads->phone_no }}</p>
                        </div>
                        <div class="contact-item web_link">
                            {{-- <img src="{{ trim($icons['world']) }}" alt="world" width="18" height="18" /> --}}
                            <p class="mb-0">{{ $letterHeads->web_link }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="alert-warning">
            <p>No letterhead found.</p>
        </div>
    @endif


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function downloadPdf() {
            const element = document.getElementById('pdf-content');
            document.querySelector('.no-print').style.display = 'none';

            const opt = {
                margin: [0, 0, 0, 0],
                filename: 'letterhead.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 3,
                    useCORS: true,
                    // windowWidth: 1335,
                    // windowWidth: element.scrollWidth
                    scrollX: 0,
                    scrollY: 0,
                    windowWidth: element.offsetWidth,
                    x: 0, // force start from left
                    y: 0 // force start from top
                },
                jsPDF: {
                    unit: 'pt',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: ['avoid-all', 'css']
                }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                document.querySelector('.no-print').style.display = 'block';
            });
        }
    </script>


    <script>
        document.querySelector('.download-card').addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.15)';
        });
        document.querySelector('.download-card').addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
        });
    </script>

</div>
