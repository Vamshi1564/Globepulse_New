{{-- 
FILE: resources/views/livewire/front/buyer-verify-otp.blade.php
Component: App\Livewire\Front\BuyerVerifyOtp
Route: GET /buyer/verify-email → name('buyer.verify.otp')
--}}

@push('custom-meta')
<title>Verify Your Email – GlobPulse Buyer</title>
<style>
.otp-page { background:#F0F4FF; min-height:100vh; padding-top:80px; padding-bottom:60px; }

.otp-wrap {
    display:grid; grid-template-columns:2fr 3fr;
    border-radius:20px; overflow:hidden;
    box-shadow:0 40px 80px rgba(15,23,42,.18);
    max-width:860px; margin:0 auto;
}

/* LEFT */
.otp-left {
    background:linear-gradient(145deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%);
    padding:48px 36px;
    display:flex; flex-direction:column; justify-content:center;
    position:relative; overflow:hidden;
}
.otp-left::before { content:''; position:absolute; width:350px; height:350px; border-radius:50%; background:radial-gradient(circle,rgba(37,99,235,.25),transparent 70%); top:-100px; right:-100px; }
.otp-left-body { position:relative; z-index:1; }
.otp-left-body h3 { font-size:24px; font-weight:900; color:#fff; margin-bottom:12px; line-height:1.3; }
.otp-left-body h3 em { color:#f59e0b; font-style:normal; }
.otp-left-body p { font-size:14px; color:rgba(255,255,255,.65); line-height:1.75; margin-bottom:28px; }
.otp-step { display:flex; gap:12px; align-items:center; padding:12px 16px; border-radius:12px; margin-bottom:10px; }
.otp-step.done  { background:rgba(16,185,129,.15); border:1px solid rgba(16,185,129,.3); }
.otp-step.active{ background:rgba(37,99,235,.2);   border:1px solid rgba(37,99,235,.4); }
.otp-step.next  { background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); }
.otp-step-icon { width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:800; flex-shrink:0; }
.otp-step.done   .otp-step-icon { background:#10b981; color:#fff; }
.otp-step.active .otp-step-icon { background:#2563eb; color:#fff; }
.otp-step.next   .otp-step-icon { background:rgba(255,255,255,.1); color:rgba(255,255,255,.4); }
.otp-step-text h5 { font-size:13px; font-weight:700; color:#fff; margin:0 0 1px; }
.otp-step-text p  { font-size:11px; color:rgba(255,255,255,.5); margin:0; }

/* RIGHT */
.otp-right { background:#fff; padding:52px 44px; display:flex; flex-direction:column; justify-content:center; }

.otp-email-chip {
    display:inline-flex; align-items:center; gap:8px;
    background:#EFF6FF; border:1px solid #BFDBFE;
    border-radius:20px; padding:6px 14px;
    font-size:13px; font-weight:600; color:#1D4ED8;
    margin-bottom:28px;
}

/* 6 OTP input boxes */
.otp-boxes { display:flex; gap:10px; justify-content:center; margin:28px 0 10px; }
.otp-box {
    width:52px; height:60px;
    border:2px solid #E2E8F0;
    border-radius:12px;
    font-size:26px; font-weight:900; color:#0f172a;
    text-align:center; line-height:60px;
    background:#fafafa;
    transition:all .2s;
    caret-color:#2563eb;
    outline:none;
    -moz-appearance:textfield;
}
.otp-box::-webkit-outer-spin-button,
.otp-box::-webkit-inner-spin-button { -webkit-appearance:none; }
.otp-box:focus { border-color:#2563eb; background:#EFF6FF; box-shadow:0 0 0 3px rgba(37,99,235,.12); }
.otp-box.filled { border-color:#2563eb; background:#EFF6FF; }
.otp-box.error  { border-color:#EF4444; background:#FEF2F2; animation:shake .4s; }
@keyframes shake { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-6px)} 75%{transform:translateX(6px)} }

/* Timer */
.otp-timer { text-align:center; font-size:13px; color:#94A3B8; margin-bottom:28px; }
.otp-timer strong { color:#EF4444; }

/* Alerts */
.otp-alert { border-radius:10px; padding:12px 16px; margin-bottom:20px; font-size:13px; font-weight:600; display:flex; align-items:flex-start; gap:10px; }
.otp-alert.error   { background:#FEF2F2; border:1px solid #FECACA; color:#991B1B; }
.otp-alert.success { background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; }

/* Submit button */
.btn-otp-verify {
    width:100%; height:50px; background:#2563eb; color:#fff;
    border:none; border-radius:10px; font-size:15px; font-weight:800;
    font-family:inherit; cursor:pointer;
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:all .25s; margin-bottom:16px;
}
.btn-otp-verify:hover:not(:disabled) { background:#1d4ed8; box-shadow:0 10px 28px rgba(37,99,235,.35); }
.btn-otp-verify:disabled { opacity:.55; cursor:not-allowed; }

.btn-otp-resend {
    width:100%; height:42px; background:transparent; color:#64748b;
    border:1.5px solid #E2E8F0; border-radius:10px;
    font-size:13px; font-weight:700; font-family:inherit;
    cursor:pointer; transition:all .2s;
}
.btn-otp-resend:hover:not(:disabled) { border-color:#2563eb; color:#2563eb; background:#EFF6FF; }
.btn-otp-resend:disabled { opacity:.5; cursor:not-allowed; }

@media(max-width:768px) {
    .otp-wrap { grid-template-columns:1fr; }
    .otp-left { display:none; }
    .otp-right { padding:36px 24px; border-radius:20px; }
    .otp-page { padding-top:90px; }
    .otp-box { width:44px; height:52px; font-size:22px; }
}
</style>
@endpush

<div>
    <livewire:front.layout.header />

    <div class="otp-page px-3">
        <div class="otp-wrap">

            {{-- ══ LEFT PANEL ══ --}}
            <div class="otp-left">
                <div style="position:relative;z-index:1;margin-bottom:32px">
                    <img src="{{ asset('assets/img/icons/gfe.svg') }}" alt="GlobPulse" style="height:32px">
                </div>
                <div class="otp-left-body">
                    <h3>Almost there!<br>Verify your <em>email</em></h3>
                    <p>A 4-digit code was sent to your inbox. This code expires in 10 minutes.</p>

                    <div class="otp-step done">
                        <div class="otp-step-icon">✓</div>
                        <div class="otp-step-text"><h5>Account Created</h5><p>Details saved successfully</p></div>
                    </div>
                    <div class="otp-step active">
                        <div class="otp-step-icon">2</div>
                        <div class="otp-step-text"><h5>Verify Email</h5><p>Enter the OTP from your inbox</p></div>
                    </div>
                    <div class="otp-step next">
                        <div class="otp-step-icon">3</div>
                        <div class="otp-step-text"><h5>Get Credentials</h5><p>Login details emailed instantly</p></div>
                    </div>
                    <div class="otp-step next">
                        <div class="otp-step-icon">4</div>
                        <div class="otp-step-text"><h5>Complete Profile</h5><p>Add business details &amp; go live</p></div>
                    </div>
                </div>
            </div>

            {{-- ══ RIGHT PANEL ══ --}}
            <div class="otp-right">

                {{-- Email chip --}}
                <div>
                    <h2 style="font-size:22px;font-weight:900;color:#0f172a;margin:0 0 6px">Check your inbox</h2>
                    <p style="font-size:14px;color:#64748b;margin:0 0 16px">We sent a 4-digit code to:</p>
                    <div class="otp-email-chip">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        {{ $email }}
                    </div>
                </div>

                {{-- Alerts --}}
                @if($errorMsg)
                    <div class="otp-alert error">
                        <span>❌</span> <span>{{ $errorMsg }}</span>
                    </div>
                @endif
                @if($successMsg)
                    <div class="otp-alert success">
                        <span>✅</span> <span>{{ $successMsg }}</span>
                    </div>
                @endif

                {{-- OTP boxes --}}
                <form wire:submit.prevent="verifyOtp">
                    <p style="font-size:12px;font-weight:700;color:#94a3b8;text-align:center;letter-spacing:1px;text-transform:uppercase;margin:0">Enter verification code</p>

                    <!-- <div class="otp-boxes">
                        <input type="number" class="otp-box" wire:model="d1" maxlength="1" min="0" max="9"
                            id="otp1" oninput="otpMove(this,'otp2')" onkeydown="otpBack(event,this,'')">
                        <input type="number" class="otp-box" wire:model="d2" maxlength="1" min="0" max="9"
                            id="otp2" oninput="otpMove(this,'otp3')" onkeydown="otpBack(event,this,'otp1')">
                        <input type="number" class="otp-box" wire:model="d3" maxlength="1" min="0" max="9"
                            id="otp3" oninput="otpMove(this,'otp4')" onkeydown="otpBack(event,this,'otp2')">
                        <input type="number" class="otp-box" wire:model="d4" maxlength="1" min="0" max="9"
                            id="otp4" oninput="otpMove(this,'otp5')" onkeydown="otpBack(event,this,'otp3')">
                        <input type="number" class="otp-box" wire:model="d5" maxlength="1" min="0" max="9"
                            id="otp5" oninput="otpMove(this,'otp6')" onkeydown="otpBack(event,this,'otp4')">
                        <input type="number" class="otp-box" wire:model="d6" maxlength="1" min="0" max="9"
                            id="otp6" oninput="otpMove(this,'')"    onkeydown="otpBack(event,this,'otp5')">
                    </div> -->

                    <div class="otp-boxes">
    <input type="number" class="otp-box" wire:model="d1" id="otp1" oninput="otpMove(this,'otp2')" onkeydown="otpBack(event,this,'')">
    <input type="number" class="otp-box" wire:model="d2" id="otp2" oninput="otpMove(this,'otp3')" onkeydown="otpBack(event,this,'otp1')">
    <input type="number" class="otp-box" wire:model="d3" id="otp3" oninput="otpMove(this,'otp4')" onkeydown="otpBack(event,this,'otp2')">
    <input type="number" class="otp-box" wire:model="d4" id="otp4" oninput="otpMove(this,'')"    onkeydown="otpBack(event,this,'otp3')">
</div>

                    {{-- Countdown timer --}}
                    <div class="otp-timer">
                        <span id="timerText">Code expires in <strong id="timerCount">10:00</strong></span>
                        <span id="timerExpired" style="display:none;color:#EF4444;font-weight:700">⏰ Code expired — please resend</span>
                    </div>

                    <button type="submit" class="btn-otp-verify" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="verifyOtp">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Verify &amp; Continue
                        </span>
                        <span wire:loading wire:target="verifyOtp">
                            <span class="spinner-border spinner-border-sm me-2"></span> Verifying...
                        </span>
                    </button>
                </form>

                {{-- Resend --}}
                <button class="btn-otp-resend" id="resendBtn" disabled
                    wire:click="resendOtp" wire:loading.attr="disabled">
                    <span id="resendLabel">Resend Code (wait <span id="resendTimer">60</span>s)</span>
                    <span id="resendReady" style="display:none">↺ Resend Code</span>
                </button>

                <p style="font-size:12px;color:#94a3b8;text-align:center;margin-top:14px">
                    Wrong email?
                    <a href="{{ route('buyer.register') }}" style="color:#2563eb;font-weight:700;text-decoration:none">Go back and re-register</a>
                </p>
            </div>

        </div>
    </div>

    <livewire:front.layout.footer />

    <script>
    // ── Auto-advance & backspace between OTP boxes ──────────────────────────
    function otpMove(el, nextId) {
        // Keep only 1 digit
        if (el.value.length > 1) el.value = el.value.slice(-1);
        el.classList.toggle('filled', el.value !== '');
        if (el.value && nextId) {
            document.getElementById(nextId)?.focus();
        }
    }
    function otpBack(e, el, prevId) {
        if (e.key === 'Backspace' && !el.value && prevId) {
            document.getElementById(prevId)?.focus();
        }
    }

    // ── Paste support: paste "123456" → fills all 6 boxes ──────────────────
    document.querySelector('.otp-boxes').addEventListener('paste', function(e) {
        e.preventDefault();
        // const digits = e.clipboardData.getData('text').replace(/\D/g,'').slice(0,6);
        const digits = e.clipboardData.getData('text').replace(/\D/g,'').slice(0,4);
        const boxes  = document.querySelectorAll('.otp-box');
        digits.split('').forEach((d, i) => {
            if (boxes[i]) {
                boxes[i].value = d;
                boxes[i].classList.add('filled');
                // Sync to Livewire
                boxes[i].dispatchEvent(new Event('input'));
            }
        });
        // if (digits.length === 6) boxes[5].focus();
        if (digits.length === 4) boxes[4].focus();
    });

    // ── 10 minute countdown timer ───────────────────────────────────────────
    let totalSeconds = 600; // 10 minutes
    const timerCount   = document.getElementById('timerCount');
    const timerText    = document.getElementById('timerText');
    const timerExpired = document.getElementById('timerExpired');

    const countdownInterval = setInterval(() => {
        totalSeconds--;
        if (totalSeconds <= 0) {
            clearInterval(countdownInterval);
            timerText.style.display    = 'none';
            timerExpired.style.display = 'inline';
            document.querySelector('.btn-otp-verify').disabled = true;
            return;
        }
        const m = Math.floor(totalSeconds / 60).toString().padStart(2,'0');
        const s = (totalSeconds % 60).toString().padStart(2,'0');
        timerCount.textContent = m + ':' + s;
    }, 1000);

    // ── 60 second resend cooldown ───────────────────────────────────────────
    let resendSeconds = 60;
    const resendBtn   = document.getElementById('resendBtn');
    const resendTimer = document.getElementById('resendTimer');
    const resendLabel = document.getElementById('resendLabel');
    const resendReady = document.getElementById('resendReady');

    const resendInterval = setInterval(() => {
        resendSeconds--;
        resendTimer.textContent = resendSeconds;
        if (resendSeconds <= 0) {
            clearInterval(resendInterval);
            resendBtn.disabled          = false;
            resendLabel.style.display   = 'none';
            resendReady.style.display   = 'inline';
        }
    }, 1000);

    // After Livewire resend, restart resend cooldown
    document.addEventListener('livewire:update', () => {
        resendSeconds = 60;
        resendBtn.disabled          = true;
        resendLabel.style.display   = 'inline';
        resendReady.style.display   = 'none';
    });

    // Focus first box on load
    document.getElementById('otp1')?.focus();
    </script>
</div>