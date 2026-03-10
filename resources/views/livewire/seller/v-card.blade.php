{{-- <div>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card-container {
            width: 100%;
            min-width: 650px;
            height: 350px;
            background: var(--white);
            border-radius: 25px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            position: relative;
            border: 1px solid #eceef2;
            /* Light gray border */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .left {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            width: 40%;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .left::before {
            content: '';
            position: absolute;
            top: 0;
            right: -38px;
            width: 82px;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            transform: skewX(-12deg);
            z-index: -1;
        }

        .left h2 {
            font-size: 26px;
            margin: 0;
            font-weight: 600;
            line-height: 1.3;
            color: white;
        }

        .left .title {
            font-size: 16px;
            margin: 8px 0;
            opacity: 0.9;
            font-weight: 400;
            color: white;
        }

        .left .company {
            font-size: 18px;
            font-weight: 500;
            margin-top: 5px;
        }

        .right {
            width: 60%;
            padding: 70px 70px 70px 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            z-index: 1;
        }

        .right h3 {
            font-size: 22px;
            margin-bottom: 20px;
            color: var(--text-dark);
            position: relative;
            display: inline-block;
        }

        .right h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
        }

        .contact-icon {
            /* width: 30px;
            height: 30px; */
            /* background: rgba(59, 130, 246, 0.1); */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            color: var(--accent-color);
        }

        .contact-text {
            font-size: 14px;

            color: var(--text-dark);
        }

        .contact-text a {
            color: var(--text-dark);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-text a:hover {
            color: var(--accent-color);
        }

        .social {
            display: flex;
            margin-top: 25px;
            gap: 15px;
        }

        .social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* .social a:hover {
            background: var(--accent-color);
            color: var(--white);
            transform: translateY(-3px);
        } */

        .logo {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            object-fit: cover;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .qr-code {
            position: absolute;
            bottom: 30px;
            right: 30px;
            width: 80px;
            height: 80px;
            background: #f8fafc;
            border-radius: 10px;
            padding: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                height: auto;
                min-width: 360px;
            }

            .left,
            .right {
                width: 100%;
            }

            .left::before {
                display: none;
            }

            .left {
                padding: 30px;
            }

            .right {
                padding: 30px;
            }

            .qr-code {
                bottom: 20px;
                right: 20px;
                width: 60px;
                height: 60px;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <button id="downloadBtn"
        style="position: absolute; top: 20px; right: 20px; background: var(--accent-color); color: white; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer; z-index: 10;">
        Download PDF
    </button>

    <div class="card-container">
        <!-- Left Section -->
        <div class="left">
            @php
                $logoPath = storage_path('app/public/' . $lead->profile_image);
                $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
            @endphp

            @if ($logoBase64)
                <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo" class="logo">
            @endif
            <div>
                <h2>{{ $lead->name }}</h2>
                <p class="title">{{ $lead->designation }}</p>
                <p class="company">{{ $lead->company }}</p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right">
            <h3>Contact Info</h3>
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            fill="#3b82f6" class="contact-icon">
                            <!-- Phone -->
                            <path id="phone-alt"
                                d="M17.46 5c-.06.89-.21 1.76-.45 2.59l1.2 1.2c.41-1.2.67-2.47.76-3.79h-1.51zM7.6 17.02c-.85.24-1.72.39-2.6.45v1.49c1.32-.09 2.59-.35 3.8-.75l-1.2-1.19zM16.5 3H20c.55 0 1 .45 1 1 0 9.39-7.61 17-17 17-.55 0-1-.45-1-1v-3.49c0-.55.45-1 1-1 1.24 0 2.45-.2 3.57-.57.1-.04.21-.05.31-.05.26 0 .51.1.71.29l2.2 2.2c2.83-1.45 5.15-3.76 6.59-6.59l-2.2-2.2c-.28-.28-.36-.67-.25-1.02.37-1.12.57-2.32.57-3.57 0-.55.45-1 1-1z" />
                        </svg>
                    </div>
                    <p class="contact-text"><a href="tel:+919876543210">{{ $lead->phonenumber }}</a></p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            fill="#3b82f6" class="contact-icon">
                            <!-- Envelope -->
                            <path id="envelope"
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                    </div>
                    <p class="contact-text"><a href="mailto:rahul@dthub.com">{{ $lead->email }}</a></p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            fill="#3b82f6" class="contact-icon">
                            <!-- Globe -->
                            <path id="globe"
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                        </svg>
                    </div>
                    <p class="contact-text"><a href="https://www.dthub.com"
                            target="_blank">{{ $lead->web_url ?? $lead->website }}</a></p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            fill="#3b82f6" class="contact-icon">
                            <!-- Location -->
                            <path id="location"
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </div>
                    <p class="contact-text">{{ $lead->address }}, {{ $lead->city }}, {{ $lead->state }}</p>
                </div>
            </div>

            <div class="social">
                <a href="#" aria-label="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        width="24" height="24" fill="#3b82f6" class="social-icon">
                        <!-- LinkedIn -->
                        <path id="linkedin"
                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg></a>
                <a href="#" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        width="24" height="24" fill="#3b82f6" class="social-icon">
                        <!-- Facebook -->
                        <path id="facebook"
                            d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z" />
                    </svg></a>
                <a href="{{ $lead->instagram }}" aria-label="Instagram"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" width="24" height="24" fill="#3b82f6" class="social-icon">
                        <!-- Instagram -->
                        <path id="instagram"
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                    </svg>
                </a>
                <a href="{{ $lead->twitter }}" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" width="24" height="24" fill="#3b82f6" class="social-icon">
                        <!-- Twitter -->
                        <path id="twitter"
                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                    </svg></a>
            </div>
          
            <img src="data:image/png;base64,{{ $qrImage }}" alt="QR Code" class="qr-code">
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            // Select the element you want to convert to PDF
            const element = document.querySelector('.card-container');

            // Options for the PDF
            const opt = {
                margin: 10,
                filename: 'vcard_' + new Date().toISOString().split('T')[0] + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    backgroundColor: '#fefefe'
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Generate the PDF
            html2pdf().from(element).set(opt).save();
        });
    </script>

</div> --}}


<div>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .vcard-container {
            position: relative;
            width: 502px;
            height: 296px;
            margin: 0 auto;
            background: url('{{ $cardImage }}') no-repeat;
            background-size: cover;
        }

        .vcard-text {
            position: absolute;
            color: #000;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }


        .social-icons img {
            width: 24px;
            height: 24px;
            /* margin-right: 5px; */
        }

        .social-icons {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
        }

        .btn-social {
            text-decoration: none;
            outline: none;
        }

        .logo {
            width: 70px;
            height: 70px;
        }

        /* Defualt name */
        .name {
            font-size: 16px;
            font-weight: bold;
        }

        /* Style 1 */
        .style1 .name {
            top: 80px;
            left: 36px;
            color: black;
        }

        .style1 .phone {
            top: 128px;
            left: 75px;
            font-size: 13px;
            color: black;
        }

        .style1 .web {
            top: 165px;
            left: 75px;
            font-size: 13px;
            color: black;
        }

        .style1 .email {
            top: 202px;
            left: 75px;
            font-size: 13px;
            color: black;
        }

        .style1 .address {
            top: 240px;
            left: 75px;
            font-size: 13px;
            width: 175px;
            color: black;
        }

        .style1 .logo-pos {
            position: absolute;
            top: 95px;
            right: 63px;
        }

        .style1 .social-icons {
            position: absolute;
            top: 10px;
            left: 10px;
            gap: 8px;
        }

        /* Style 2 */
        .style2 .name {
            top: 88px;
            left: 272px;
            font-size: 16px;
            font-weight: bold;
            color: #eee;
        }

        .style2 .phone {
            top: 171px;
            left: 294px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style2 .web {
            top: 224px;
            left: 294px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style2 .email {
            top: 196px;
            left: 294px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style2 .address {
            top: 251px;
            left: 294px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style2 .logo-pos {
            position: absolute;
            top: 95px;
            left: 85px;
        }

        .style2 .social-icons {
            position: absolute;
            top: 10px;
            right: 10px;
            gap: 8px;
        }

        /* Style 3 */
        .style3 .name {
            top: 90px;
            left: 30px;
            font-size: 17px;
            color: #fff;
        }

        .style3 .phone {
            top: 160px;
            left: 62px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style3 .email {
            top: 188px;
            left: 62px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style3 .web {
            top: 216px;
            left: 62px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style3 .address {
            top: 249px;
            left: 62px;
            width: 245px;
            font-size: 12px;
            font-weight: 500;
            color: #eee;
        }

        .style3 .logo-pos {
            position: absolute;
            top: 95px;
            right: 55px;
        }

        .style3 .social-icons {
            position: absolute;
            top: 10px;
            right: 10px;
            gap: 8px;
        }

        /* Style 4 */
        .style4 .name {
            top: 66px;
            left: 245px;
            font-size: 17px;
            color: black;
        }

        .style4 .phone {
            top: 141px;
            left: 383px;
            font-size: 12px;
            font-weight: 500;
            color: black;
        }

        .style4 .email {
            top: 173px;
            left: 325px;
            font-size: 12px;
            font-weight: 500;
            color: black;
        }

        .style4 .web {
            top: 206px;
            left: 330px;
            font-size: 12px;
            font-weight: 500;
            color: black;
        }

        .style4 .address {
            top: 239px;
            left: 250px;
            font-size: 12px;
            font-weight: 500;
            width: 200px;
            color: black;
            text-align: end;
        }

        .style4 .logo-pos {
            position: absolute;
            top: 95px;
            left: 55px;
        }

        .style4 .social-icons {
            position: absolute;
            top: 10px;
            right: 10px;
            gap: 8px;
        }

        /* Style 5 */
        .style5 .name {
            top: 112px;
            left: 228px;
            font-size: 17px;
            color: black;
        }

        .style5 .phone {
            top: 204px;
            left: 307px;
            font-size: 12px;
            font-weight: 500;
            color: black;
        }

        .style5 .email {
            top: 176px;
            left: 76px;
            font-size: 12px;
            font-weight: 500;
            color: black;
        }

        .style5 .web {
            top: 175px;
            left: 307px;
            font-size: 12px;
            font-weight: 500;
            color: black;
        }

        .style5 .address {
            top: 204px;
            left: 76px;
            font-size: 12px;
            font-weight: 500;
            width: 178px;
            color: black;
        }

        .style5 .logo-pos {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .style5 .social-icons {
            position: absolute;
            top: 265px;
            left: 10px;
            gap: 8px;
        }
    </style>

    <div class="container" style="height: 100vh; align-content: center;">
        <div class="vcard-container {{ $type }}">
            {{-- @php
                $logoPath = storage_path('app/public/' . $lead->profile_image);
                $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
            @endphp

            @if ($logoBase64)
                <div class="vcard-text logo-pos"><img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo"
                        class="logo"></div>
            @endif --}}

            @php
                $logoBase64 = '';
                $showNoLogoMsg = false;

                if (!empty($lead->profile_image)) {
                    $logoPath = storage_path('app/public/' . $lead->profile_image);
                    if (is_file($logoPath) && file_exists($logoPath)) {
                        $logoBase64 = base64_encode(file_get_contents($logoPath));
                    }
                }

                // Default logo path
                $defaultLogoPath = public_path('assets/img/default.png');
                if (empty($logoBase64) && file_exists($defaultLogoPath)) {
                    $logoBase64 = base64_encode(file_get_contents($defaultLogoPath));
                    $showNoLogoMsg = true; // show message only if using default
                }
            @endphp

            <div class="vcard-text logo-pos text-center">
                <img src="data:image/png;base64,{{ $logoBase64 }}" alt="Company Logo" class="logo">
                @if ($showNoLogoMsg)
                    <p class="fw-semibold" style="color: red; font-size: 14px;">
                        No Logo Available
                    </p>
                @endif
            </div>

            <div class="vcard-text name">{{ $lead->name }}</div>
            <div class="vcard-text phone">{{ $lead->phonenumber }}</div>
            <div class="vcard-text web">{{ $lead->web_url }}</div>
            <div class="vcard-text email">{{ $lead->email }}</div>
            <div class="vcard-text address">{{ $lead->address }}</div>

            <div class="social-icons">
                @if ($lead->facebook && $icons['facebook'])
                    <a class="btn-social" href="{{ $lead->facebook }}">
                        <img src="{{ trim($icons['facebook']) }}" alt="Facebook" width="32" height="32" />
                    </a>
                @endif

                @if ($lead->instagram && $icons['instagram'])
                    <a class="btn-social" href="{{ $lead->instagram }}">
                        <img src="{{ trim($icons['instagram']) }}" alt="Instagram" width="32" height="32" />
                    </a>
                @endif
                @if ($lead->twitter && $icons['twitter'])
                    <a class="btn-social" href="{{ $lead->twitter }}">
                        <img src="{{ trim($icons['twitter']) }}" alt="Twitter" width="32" height="32" />
                    </a>
                @endif

                @if ($lead->linkedin && $icons['linkedin'])
                    <a class="btn-social" href="{{ $lead->linkedin }}">
                        <img src="{{ trim($icons['linkedin']) }}" alt="Linkedin" width="32" height="32" />
                    </a>
                @endif


            </div>
        </div>
    </div>
</div>
