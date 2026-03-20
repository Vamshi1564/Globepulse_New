{{-- @push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Secure Login to Your Globpulse Account</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Access your Globpulse  account securely. Manage your profile, 
                                                                                                                                                                                                                                                                                                track activities, and explore exclusive features today!">

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="Login, account access, Globpulse Group login, secure login, member portal, 
                                                                                                                                                                                                                                                                                        user dashboard, sign in, manage account, online access, 
                                                                                                                                                                                                                                                                                        customer portal">

    <!-- Canonical Tag -->
    <link rel="canonical" href="https://www.globpulse.com/login">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="login for Globpulse - Start Your B2B Trade Journey Today">
    <meta property="og:description"
        content="Register with Globpulse to connect with suppliers and buyers globally. Join our platform to streamline your B2B trade process and expand your business.">
    <meta property="og:url" content="https://www.globpulse.com/login">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="login for Globpulse - Start Your B2B Trade Journey Today">
    <meta name="twitter:description"
        content="Create an account with Globpulse to access global B2B trade opportunities. Connect with verified suppliers and buyers to grow your business.">
    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">

    <!-- Robots -->
    <meta name="robots" content="index, follow">
@endpush --}}




<div>
    <livewire:front.layout.header />
    <main class="main" id="top">




        <div
            class=" d-flex flex-column justify-content-center align-items-center custom-auth-bg text-white position-relative overflow-hidden py-5 ">
            <!-- Diagonal split effect -->
            <div class="split-bg position-absolute top-0 start-0 w-100 h-100 z-n1 "></div>

            <div class="row my-5">
                <!-- LEFT: Info Section -->
                <div class="col-md-6 d-flex flex-column justify-content-center p-5">
                    <h1 class="fw-bold display-5 mb-3 text-light">B2B Authentication</h1>
                    <p class="lead text-white-50 mb-2">Experience a seamless and secure login process with our premium
                        B2B platform.</p>
                    <ul class="list-unstyled text-white-50">
                        <li><i class="fa-solid fa-right-to-bracket me-1"></i> Military-grade encryption</li>
                        <li><i class="fa-solid fa-right-to-bracket me-1"></i> Instant session sync</li>
                        <li><i class="fa-solid fa-right-to-bracket me-1"></i> Smart usage analytics</li>
                    </ul>
                </div>

                <!-- RIGHT: Form -->
                <div class="col-md-6 d-flex flex-column justify-content-end p-5">
                    <div class="glass-panel p-4 py-5 rounded-4 shadow-lg">
                        <h3 class="text-center mb-4">Email Verify</h3>

                        {{-- Step 1: Email + Country --}}
                        @if ($step == 1)
                            <form wire:submit.prevent="sendOtp">
                                <div class="form-group neon-input mb-4 position-relative">
                                    <div>
                                        <label for="country" class="text-black">Select Country</label>
                                        <select id="country" wire:model="country_id"
                                            class="form-control country-select">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->country_id }}">{{ $country->short_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group neon-input mb-4 position-relative">
                                    <input type="email" wire:model="email"
                                        class="form-control bg-white text-dark ps-5" placeholder="Enter email">
                                    <i
                                        class="fa fa-envelope position-absolute top-50 start-0 translate-middle-y mx-3 text-primary"></i>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-glow w-100 mt-2">
                                    <span wire:loading wire:target="sendOtp">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                    </span>
                                    Send OTP
                                </button>
                            </form>
                        @endif

                        {{-- Step 2: OTP Verification --}}
                        @if ($step == 2)
                            <form wire:submit.prevent="verifyOtp">
                                <div class="form-group neon-input mb-4 position-relative">
                                    <input type="text" wire:model.defer="otp"
                                        class="form-control bg-white text-dark ps-5" placeholder="Enter OTP" required>
                                    <i
                                        class="fa fa-key position-absolute top-50 start-0 translate-middle-y mx-3 text-primary"></i>
                                </div>

                                <button type="submit" class="btn btn-glow w-100 mt-2">
                                    <span wire:loading wire:target="verifyOtp">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                    </span>
                                    Verify OTP
                                </button>
                            </form>
                        @endif

                        {{-- <div class="text-center mt-3">
                            <small class="text-dark">Don't have an account?
                                <a href="{{ route('signup') }}" class="text-info fw-bold">Sign up</a>
                            </small>
                        </div> --}}
                        <div class="text-center mt-3">
                            <a wire:click="flushSession" class="fw-bold small">Already have an account? Sign
                                in</a>
                        </div>
                    </div>

                    {{-- Flash Messages --}}
                    @if (session()->has('error'))
                        <div class="alert alert-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                            role="alert">
                            <span class="fas fa-times-circle text-black fs-7 me-3"></span>
                            <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
                            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('message'))
                        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                            role="alert">
                            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <style>
            .split-bg {
                clip-path: polygon(0 0, 70% 0, 30% 100%, 0% 100%);
                background: linear-gradient(135deg, #1e40af, #0ea5e9);
                z-index: -1;
            }

            .glass-panel {
                background: rgba(255, 255, 255, 0.644);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .neon-input input {
                border: 1px solid rgb(25, 64, 206);
                border-radius: 10px;
                transition: 0.4s ease;
            }

            .neon-input input:focus {
                outline: none;
                border: 2px solid #38bdf8;
                box-shadow: 0 0 10px #1a1a1a;
            }

            .btn-glow {
                background: linear-gradient(135deg, #6366f1, #3b82f6);
                color: white;
                padding: 10px 20px;
                border: none;
                font-weight: bold;
                border-radius: 12px;
                box-shadow: 0 0 10px #3b82f6;
                transition: all 0.3s ease-in-out;
            }

            .btn-glow:hover {
                box-shadow: 0 0 20px #60a5fa;
                transform: translateY(-2px);
            }

            .animate-text {
                animation: fadeSlideIn 1s ease forwards;
                opacity: 0;
                transform: translateY(20px);
            }

            @keyframes fadeSlideIn {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Responsive Background Split */
            .split-bg {
                clip-path: polygon(0 0, 70% 0, 30% 100%, 0% 100%);
                background: linear-gradient(135deg, #1e40af, #0ea5e9);
                z-index: -1;
            }

            /* Adjust Split Background on Small Screens */
            @media (max-width: 768px) {
                .split-bg {
                    clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
                }
            }

            /* Responsive Padding */
            @media (max-width: 768px) {
                .glass-panel {
                    padding: 1.5rem !important;
                }
            }

            /* Other styles remain the same */
        </style>



        <script>
            document.addEventListener('livewire:load', function() {
                $('.country-select').select2();

                // Sync Select2 value with Livewire
                $('.country-select').on('change', function(e) {
                    @this.set('country_id', e.target.value);
                });

                // Reset Select2 when Livewire updates
                Livewire.hook('message.processed', () => {
                    $('.country-select').select2();
                });
            });
        </script>





    </main>
    <livewire:front.layout.footer />
</div>
