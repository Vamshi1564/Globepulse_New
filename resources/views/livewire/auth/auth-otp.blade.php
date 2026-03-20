<div>

    {{--
  <livewire:front.layout.header /> --}}

    <div>

        <main class="main" id="top">

            <div
                class=" d-flex flex-column justify-content-center align-items-center custom-auth-bg text-white position-relative overflow-hidden ">
                <!-- Diagonal split effect -->
                <div class="split-bg position-absolute top-0 start-0 w-100 h-100 z-n1 "></div>

                <div class="container min-vh-100 d-flex align-items-center justify-content-center  px-3">
                    <div class="card shadow rounded-4 p-4" style="max-width: 480px;  width: 100%;">
                        <div class="text-center mb-4">
                            <img src="../../../assets/img/icons/gfe.svg" width="70" class="mb-3" alt="GFE Logo">
                            <h4 class="fw-bold">Enter OTP</h4>
                            <p class="text-muted small mb-1">Code sent to:</p>
                            <p class="fw-semibold">
                                @if (session('login_input_type') === 'email')
                                    {{ session('check_email') }}
                                @elseif (session('login_input_type') === 'phonenumber')
                                    {{ session('check_phonenumber') }}
                                @endif
                            </p>
                        </div>
                        <style>
                            .ahjsa {
                                background-image: linear-gradient(black), url()
                            }
                        </style>
                        <form wire:submit.prevent="login_otp" id="otpForm">
                            <div class="d-flex justify-content-between gap-2 mb-4" id="otpInputs">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                        class="form-control text-center otp-box fs-8"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,1);" />
                                @endfor
                            </div>

                            <input type="hidden" id="otp" name="otp" wire:model="otp">

                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Verify</button>

                            <div class="text-center mt-3">
                                <a href="#" class="text-muted small">Didn’t receive the code?</a>
                            </div>

                            @if (session()->has('error'))
                                <div class="alert alert-danger mt-3 text-center">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
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

                    .otp-box {
                        width: 50px;
                        height: 60px;
                        border-radius: 10px;
                        border: 1px solid #ced4da;
                        font-weight: bold;
                        font-size: 1.5rem;
                    }

                    .otp-box:focus {
                        border-color: #0d6efd;
                        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.2);
                        outline: none;
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

                    @media(max-width: 430px) {
                        .otp-box {
                            width: 30px;
                            height: 40px;
                            border-radius: 10px;
                            border: 1px solid #ced4da;
                            font-weight: bold;
                            font-size: 1.2rem;
                        }

                        .form-control {
                            padding: 5px;
                        }
                    }

                    /* Adjust Split Background on Small Screens */
                    @media (max-width: 768px) {
                        .split-bg {
                            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
                        }
                    }

                    @media (max-width: 768px) {
                        .glass-panel {
                            padding: 1.5rem !important;
                        }
                    }
                </style>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const boxes = document.querySelectorAll(".otp-box");
                        const hidden = document.getElementById("otp");

                        boxes.forEach((box, i) => {
                            box.addEventListener("input", (e) => {
                                if (e.inputType === "insertText" && box.value && i < boxes.length - 1) {
                                    boxes[i + 1].focus();
                                }
                                updateHiddenInput();
                            });

                            box.addEventListener("keydown", (e) => {
                                if (e.key === "Backspace" && !box.value && i > 0) {
                                    boxes[i - 1].focus();
                                }
                            });

                            box.addEventListener("paste", (e) => {
                                const pasted = (e.clipboardData || window.clipboardData).getData("text");
                                if (pasted.length === boxes.length) {
                                    boxes.forEach((b, i) => (b.value = pasted[i]));
                                    updateHiddenInput();
                                    boxes[boxes.length - 1].focus();
                                    e.preventDefault();
                                }
                            });
                        });

                        function updateHiddenInput() {
                            hidden.value = Array.from(boxes).map(b => b.value).join("");
                            hidden.dispatchEvent(new Event('input')); // For Livewire sync
                        }
                    });
                </script>

            </div>

        </main>
    </div>

    <livewire:front.layout.footer  />

</div>