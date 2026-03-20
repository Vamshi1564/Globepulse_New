<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <style>
        /* .verify-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .verify-modal {
            width: 380px;
            background: #fff;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
        } */
        .verify-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            display: flex;
            align-items: center;
            justify-content: center;

            /* ⭐ allow scroll on small screens */
            overflow-y: auto;
            padding: 15px;
            z-index: 9999;
            /* Firefox */
            -ms-overflow-style: none;
            /* hide scrollbar */
            scrollbar-width: none;
        }

        .verify-modal {
            width: 100%;
            max-width: 520px;
        }

        .verify-card {
            border-radius: 16px;
            overflow-y: auto;
            max-height: 95vh;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .35);
        }

        /* gradient header */
        .verify-header {
            padding: 18px;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
        }

        /* SCROLLBAR CLEAN */
        .verify-card::-webkit-scrollbar {
            display: none;
        }

        .verify-card::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }


        /* gradient buttons */
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            color: white;
            border: none;
        }

        .btn-gradient:hover {
            opacity: .9;
        }

        .input-group-text {
            border: none;
        }

        .form-control {
            border-radius: 10px;
        }

        @media (max-width: 576px) {
            .verify-card {
                border-radius: 12px;
            }
        }

        .mini-loader {
            width: 12px;
            height: 12px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.5s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
    @if ($showModal)

        {{-- <div class="verify-overlay">

            <div class="verify-modal">

                <h5 class="text-center fw-bold mb-4">
                    Verify Your Details
                </h5>

                @if (session('msg'))
                    <div class="alert alert-success small py-1">
                        {{ session('msg') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger small py-1">
                        {{ session('error') }}
                    </div>
                @endif


                <form wire:submit.prevent="veified">

                    <div class="mb-3">
                        <input type="text" wire:model.defer="name" class="form-control" placeholder="Full Name">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="mb-3">

                        <div class="d-flex gap-2">
                            <input type="text" wire:model.defer="phone" class="form-control" placeholder="Phone">

                            @if (!$phoneVerified)
                              

                                <button type="button" wire:click="sendPhoneOtp" wire:loading.attr="disabled"
                                    class="btn btn-primary btn-sm">

                                    <span wire:loading.remove wire:target="sendPhoneOtp">
                                        Send OTP
                                    </span>

                                    <span wire:loading wire:target="sendPhoneOtp">
                                        Loading...
                                    </span>

                                </button>
                            @endif
                        </div>

                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        @if ($phoneOtpSent && !$phoneVerified)
                            <div class="d-flex gap-2 mt-2">
                                <input type="text" wire:model.defer="phoneOtp" class="form-control"
                                    placeholder="Enter OTP">

                               
                                <button type="button" wire:click="verifyPhoneOtp" wire:loading.attr="disabled"
                                    class="btn btn-success btn-sm">

                                    <span wire:loading.remove wire:target="verifyPhoneOtp">
                                        Verify
                                    </span>

                                    <span wire:loading wire:target="verifyPhoneOtp">
                                        Loading...
                                    </span>

                                </button>

                            </div>
                            @error('phoneOtp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif

                        @if ($phoneVerified)
                            <small class="text-success">✓ Phone Verified</small>
                        @endif

                    </div>



                    <div class="mb-3">

                        <div class="d-flex gap-2">
                            <input type="email" wire:model.defer="email" class="form-control" placeholder="Email">

                            @if (!$emailVerified)
                        
                                <button type="button" wire:click="sendEmailOtp" wire:loading.attr="disabled"
                                    class="btn btn-primary btn-sm">

                                    <span wire:loading.remove wire:target="sendEmailOtp">
                                        Send OTP
                                    </span>

                                    <span wire:loading wire:target="sendEmailOtp">
                                        Loading...
                                    </span>

                                </button>
                            @endif
                        </div>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror


                        @if ($emailOtpSent && !$emailVerified)
                            <div class="d-flex gap-2 mt-2">
                                <input type="text" wire:model.defer="emailOtp" class="form-control"
                                    placeholder="Enter OTP">


                                
                                <button type="button" wire:click="verifyEmailOtp" wire:loading.attr="disabled"
                                    class="btn btn-success btn-sm">

                                    <span wire:loading.remove wire:target="verifyEmailOtp">
                                        Verify
                                    </span>

                                    <span wire:loading wire:target="verifyEmailOtp">
                                        Loading...
                                    </span>

                                </button>

                            </div>
                            @error('emailOtp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif
                        @if ($emailVerified)
                            <small class="text-success">✓ Email Verified</small>
                        @endif

                    </div>



                    <button type="submit" class="btn btn-dark w-100 mt-3" @disabled(!$phoneVerified || !$emailVerified)>

                        Continue to Payment
                    </button>

                </form>

            </div>

        </div> --}}

        {{-- ------------------------------ --}}

        {{-- <div class="verify-overlay">

            <div class="verify-modal">

                <div class="card verify-card border-0">

                    <div class="verify-header text-center text-white">
                        <h5 class="fw-semibold text-white mb-0">
                            Verify Your Details
                        </h5>
                        <small class="opacity-75">Secure verification required</small>
                    </div>


                    <div class="card-body p-4">

                        @if (session('msg'))
                            <div class="alert alert-success text-center small py-2">
                                {{ session('msg') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center small py-2">
                                {{ session('error') }}
                            </div>
                        @endif


                        <form wire:submit.prevent="verified">

                            <div class="form-floating mb-3">
                                <input type="text" wire:model.defer="name" class="form-control"
                                    placeholder="Full Name">
                                <label>Full Name</label>
                                @error('name')
                                    <small class="text-danger d-block my-2">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="mb-3">

                                <div class="row align-items-center g-2">
                                    <div class="col-12 col-md">
                                        <div class="input-group shadow-sm rounded">
                                            <span class="input-group-text bg-white">
                                                📱
                                            </span>

                                            <input type="number" wire:model.defer="phone" class="form-control"
                                                placeholder="Phone Number">
                                        </div>
                                    </div>
                                    @if (!$phoneVerified)
                                        <div class="col-12 col-md-auto">

                                            <button type="button" wire:click="sendPhoneOtp"
                                                wire:loading.attr="disabled" class="btn btn-gradient">

                                                <span wire:loading.remove wire:target="sendPhoneOtp">Send OTP</span>
                                                <span wire:loading wire:target="sendPhoneOtp">Sending...</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                @error('phone')
                                    <small class="text-danger d-block my-2">{{ $message }}</small>
                                @enderror
                                @if ($phoneVerified)
                                    <span class="badge rounded-pill bg-success mt-2">
                                        ✓ Verified
                                    </span>
                                @endif
                            </div>





                            @if ($phoneOtpSent && !$phoneVerified)
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md">
                                        <div class="input-group rounded">
                                            <input type="number" wire:model.defer="phoneOtp" class="form-control"
                                                placeholder="Enter Phone OTP">

                                        </div>
                                        @error('phoneOtp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-auto">

                                        <button type="button" wire:click="verifyPhoneOtp" wire:loading.attr="disabled"
                                            class="btn btn-success">

                                            <span wire:loading.remove wire:target="verifyPhoneOtp">Verify</span>
                                            <span wire:loading wire:target="verifyPhoneOtp">Loading...</span>
                                        </button>
                                    </div>
                                </div>
                            @endif



                            <div class="mb-3">

                                <div class="row align-items-center g-2">
                                    <div class="col-12 col-md">
                                        <div class="input-group shadow-sm rounded">
                                            <span class="input-group-text bg-white">
                                                ✉️
                                            </span>

                                            <input type="email" wire:model.defer="email" class="form-control"
                                                placeholder="Email Address">

                                        </div>
                                    </div>
                                    @if (!$emailVerified)
                                        <div class="col-12 col-md-auto">
                                            <button type="button" wire:click="sendEmailOtp"
                                                wire:loading.attr="disabled" class="btn btn-gradient">

                                                <span wire:loading.remove wire:target="sendEmailOtp">Send OTP</span>
                                                <span wire:loading wire:target="sendEmailOtp">Sending...</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                @error('email')
                                    <small class="text-danger d-block my-2">{{ $message }}</small>
                                @enderror
                                @if ($emailVerified)
                                    <span class="badge rounded-pill bg-success mt-2">
                                        ✓ Verified
                                    </span>
                                @endif
                            </div>




                            @if ($emailOtpSent && !$emailVerified)
                                <div class="row g-1 align-items-center">
                                    <div class="col-12 col-md">
                                        <div class="input-group shadow-sm rounded">
                                            <input type="text" wire:model.defer="emailOtp" class="form-control"
                                                placeholder="Enter Email OTP">
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <button type="button" wire:click="verifyEmailOtp" wire:loading.attr="disabled"
                                            class="btn btn-success">

                                            <span wire:loading.remove wire:target="verifyEmailOtp">Verify</span>
                                            <span wire:loading wire:target="verifyEmailOtp">Loading...</span>
                                        </button>
                                    </div>
                                </div>
                                @error('emailOtp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif




                            <button type="submit" wire:submit.prevent="verified" wire:loading.attr="disabled"
                                class="btn btn-dark w-100 py-2 fw-semibold mt-3 d-flex justify-content-center align-items-center gap-2"
                                @disabled(!$phoneVerified || !$emailVerified)>

                                <!-- Normal text -->
                                <span wire:loading.class="d-none" wire:target="verified">
                                    Continue to Payment →
                                </span>

                                <!-- Loading -->
                                <span wire:loading.class.remove="d-none" wire:target="verified"
                                    class="d-none d-flex align-items-center gap-2">
                                    <span class="mini-loader"></span>
                                    Processing...
                                </span>

                            </button>


                            <style>
                                .mini-loader {
                                    width: 12px;
                                    height: 12px;
                                    border: 2px solid rgba(255, 255, 255, 0.4);
                                    border-top-color: #fff;
                                    border-radius: 50%;
                                    animation: spin 0.5s linear infinite;
                                }

                                @keyframes spin {
                                    to {
                                        transform: rotate(360deg);
                                    }
                                }
                            </style>


                        </form>

                    </div>
                </div>
            </div>
        </div> --}}

        <div class="verify-overlay d-flex align-items-center justify-content-center">

            <div class="verify-modal w-100 px-3">

                <div class="card verify-card border-0 shadow-lg">

                    {{-- HEADER --}}
                    <div class="verify-header text-center text-white p-4">
                        <h4 class="fw-bold mb-1">Identity Verification Required</h4>
                        <small class="opacity-75">
                            {{-- Please verify your details to continue payment safely --}}
                            Verify your basic details before proceeding to secure payment
                        </small>
                    </div>


                    <div class="card-body p-4 p-md-5">

                        {{-- TRUST CONTENT --}}
                        <div class="alert alert-light border fw-semibold small text-center text-black mb-4">
                            {{-- 🔒 Your information is encrypted & secure.
                            Verification ensures safe and successful payment processing. --}}

                            🔒 For security reasons, we verify your Name, Phone Number and Email Address
                            before processing your payment. This protects you from fraud and ensures a safe transaction.
                        </div>


                        {{-- ALERTS --}}
                        @if (session('msg'))
                            <div class="alert alert-success text-center small py-2">
                                {{ session('msg') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center small py-2">
                                {{ session('error') }}
                            </div>
                        @endif


                        <form wire:submit.prevent="verified">

                            {{-- NAME --}}
                            <div class="form-floating mb-4">
                                <input type="text" wire:model.defer="name" class="form-control shadow-sm"
                                    placeholder="Full Name">
                                <label>👤 Full Name (as per records)</label>

                                @error('name')
                                    <small class="text-danger d-block mt-2">{{ $message }}</small>
                                @enderror
                            </div>



                            {{-- PHONE --}}
                            <div class="mb-3">

                                <div class="row g-2 align-items-center">

                                    <div class="col-12 col-md">
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white">📱</span>
                                            <input type="tel" inputmode="numeric" pattern="[0-9]*"
                                                wire:model.defer="phone" class="form-control"
                                                placeholder="Phone Number">
                                        </div>
                                    </div>

                                    @if (!$phoneVerified)
                                        <div class="col-12 col-md-auto d-grid">
                                            <button type="button" wire:click="sendPhoneOtp"
                                                wire:loading.attr="disabled" class="btn btn-gradient px-4">

                                                <span wire:loading.remove wire:target="sendPhoneOtp">Send OTP</span>
                                                <span wire:loading wire:target="sendPhoneOtp">Sending...</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                @error('phone')
                                    <small class="text-danger d-block mt-2">{{ $message }}</small>
                                @enderror

                                @if ($phoneVerified)
                                    <span class="badge bg-success mt-2">✓ Verified</span>
                                @endif
                            </div>




                            {{-- PHONE OTP --}}
                            @if ($phoneOtpSent && !$phoneVerified)
                                <div class="row g-2 mb-3">
                                    <div class="col-12 col-md">
                                        <input type="number" wire:model.defer="phoneOtp" class="form-control shadow-sm"
                                            placeholder="Enter Phone OTP">
                                    </div>

                                    <div class="col-12 col-md-auto d-grid">
                                        <button type="button" wire:click="verifyPhoneOtp" wire:loading.attr="disabled"
                                            class="btn btn-success">

                                            <span wire:loading.remove wire:target="verifyPhoneOtp">Verify</span>
                                            <span wire:loading wire:target="verifyPhoneOtp">Loading...</span>
                                        </button>
                                    </div>
                                    @error('phoneOtp')
                                        <small class="text-danger my-2">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif




                            {{-- EMAIL --}}
                            <div class="mb-3">

                                <div class="row g-2 align-items-center">

                                    <div class="col-12 col-md">
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white">✉️</span>
                                            <input type="email" wire:model.defer="email" class="form-control"
                                                placeholder="Email Address">
                                        </div>
                                    </div>

                                    @if (!$emailVerified)
                                        <div class="col-12 col-md-auto d-grid">
                                            <button type="button" wire:click="sendEmailOtp"
                                                wire:loading.attr="disabled" class="btn btn-gradient px-4">

                                                <span wire:loading.remove wire:target="sendEmailOtp">Send OTP</span>
                                                <span wire:loading wire:target="sendEmailOtp">Sending...</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                @error('email')
                                    <small class="text-danger d-block mt-2">{{ $message }}</small>
                                @enderror

                                @if ($emailVerified)
                                    <span class="badge bg-success mt-2">✓ Verified</span>
                                @endif
                            </div>




                            {{-- EMAIL OTP --}}
                            @if ($emailOtpSent && !$emailVerified)
                                <div class="row g-2 mb-4">
                                    <div class="col-12 col-md">
                                        <input type="number" wire:model.defer="emailOtp" class="form-control shadow-sm"
                                            placeholder="Enter Email OTP">
                                    </div>

                                    <div class="col-12 col-md-auto d-grid">
                                        <button type="button" wire:click="verifyEmailOtp" wire:loading.attr="disabled"
                                            class="btn btn-success">

                                            <span wire:loading.remove wire:target="verifyEmailOtp">Verify</span>
                                            <span wire:loading wire:target="verifyEmailOtp">Loading...</span>
                                        </button>
                                    </div>
                                    @error('emailOtp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif




                            {{-- SUBMIT --}}
                            <button type="submit" wire:submit.prevent="verified" wire:loading.attr="disabled"
                                class="btn btn-dark w-100 py-2 fw-semibold mt-3 d-flex justify-content-center align-items-center gap-2"
                                @disabled(!$emailVerified)>

                                <!-- Normal text -->
                                <span wire:loading.class="d-none" wire:target="verified">
                                    {{-- Continue to Payment → --}}
                                    Proceed to Payment
                                </span>

                                <!-- Loading -->
                                <span wire:loading.class.remove="d-none" wire:target="verified"
                                    class="d-none d-flex align-items-center gap-2">
                                    <span class="mini-loader"></span>
                                    Processing...
                                </span>

                            </button>


                            {{-- FOOTER TRUST NOTE --}}
                            <p class="text-muted small text-center mt-4 mb-0">
                                By continuing, you agree to our secure payment policy and verification terms.
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>



    @endif

    @if (session()->has('message'))
        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="alert">
            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="alert">
            <span class="fas fa-cross-circle text-black fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
