<div>
    <livewire:seller.layout.header />
    <div class="content p-0 m-0">
        <div class="container-fluid">
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-products') }}">My
                            Products</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Website Lead</li>
                </ol>
            </nav>
        </div>
        <div class="bg-white pb-4">
            <div class="container-fluid">
                <div class="py-4">
                    <h2 class="fw-bold mb-0">Website Inquiries</h2>
                </div>
                <div class="d-flex flex-wrap ">
                    @foreach ($webleads as $index => $item)
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="card border-2 shadow m-2 rounded-4 overflow-hidden h-100">

                                <!-- Header -->
                                <div class="p-3 bg-light">
                                    <div class="d-flex -flex-wrap mb-2">
                                        <i class="fas fa-user me-2"></i>
                                        <h5 class="text-dark fw-bold mb-0">
                                            {{ $item['name'] }} </br>
                                        </h5>
                                    </div>
                                    <small class="text-dark bg-white px-2 py-1 rounded-4 fw-bolder">Enquiry
                                        #{{ $index + 1 }}</small>
                                </div>

                                <!-- Body -->
                                <div class="card-body mb-0 pb-0">
                                    <div class="mb-3">
                                        <i class="fas fa-phone-alt text-success me-2"></i>
                                        <strong>{{ $item['number'] }}</strong>
                                    </div>

                                    <div class="mb-3">
                                        <i class="fas fa-envelope text-warning me-2"></i>
                                        <span>{{ $item['email'] }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span>{{ Str::limit($item['address'], 50) }}</span>
                                    </div>

                                    <div class="">
                                        <i class="fas fa-comment text-info me-2"></i>
                                        <span>{{ Str::limit($item['msg'], 60) }}</span>
                                    </div>
                                </div>

                                <!-- Footer Actions -->
                                <div class="px-4  pb-3 border-top-0 text-center">
                                    <button class="btn bg-primary text-white btn-sm rounded w-100 px-3"
                                        onclick="openPopup({{ $index }})">
                                        <i class="fas fa-eye me-1"></i> Read Full
                                    </button>
                                </div>

                            </div>
                        </div>


                        <!-- Fullscreen Popup -->
                        <div class="custom-fullscreen-popup" id="popup-{{ $index }}">
                            <div class="popup-inner">
                                <span class="close-btn" onclick="closePopup({{ $index }})">&times;</span>

                                <h4 class="mb-2"><i class="fas fa-user text-primary me-2 "></i>{{ $item['name'] }}</h4>
                                <p><strong>📞 Phone:</strong> {{ $item['number'] }}</p>
                                <p><strong>📧 Email:</strong> {{ $item['email'] }}</p>
                                <p><strong>📍 Address:</strong> {{ $item['address'] }}</p>
                                <p><strong>💬 Message:</strong><br><span
                                        style="white-space: pre-line;">{{ $item['msg'] }}</span>
                                </p>
                            </div>
                        </div>

                    @endforeach

                    <style>
                        .custom-fullscreen-popup {
                            display: none;
                            position: fixed;
                            top: 0;
                            left: 0;
                            height: 100vh;
                            width: 100vw;
                            background-color: rgba(0, 0, 0, 0.6);
                            z-index: 9999;
                            overflow-y: auto;
                        }

                        .popup-inner {
                            background: #fff;
                            margin: 40px auto;
                            max-width: 800px;
                            width: 95%;
                            padding: 30px;
                            border-radius: 12px;
                            position: relative;
                            animation: fadeIn 0.3s ease-in-out;
                        }

                        .close-btn {
                            position: absolute;
                            top: 15px;
                            right: 20px;
                            font-size: 28px;
                            font-weight: bold;
                            color: #000;
                            cursor: pointer;
                            z-index: 10001;
                        }

                        @keyframes fadeIn {
                            from {
                                opacity: 0;
                                transform: translateY(-20px);
                            }

                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }

                        @media (max-width: 768px) {
                            .popup-inner {
                                margin: 20px 10px;
                                width: 95%;
                                padding: 20px;
                            }
                        }
                    </style>
                    <script>
                        function openPopup(index) {
                            document.getElementById(`popup-${index}`).style.display = 'block';
                            document.body.style.overflow = 'hidden'; // prevent background scroll
                        }

                        function closePopup(index) {
                            document.getElementById(`popup-${index}`).style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }

                        // optional: close when clicked outside
                        window.addEventListener('click', function (e) {
                            document.querySelectorAll('.custom-fullscreen-popup').forEach(popup => {
                                if (e.target === popup) {
                                    popup.style.display = 'none';
                                    document.body.style.overflow = 'auto';
                                }
                            });
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
    <livewire:seller.layout.footer />
</div>