{{-- FILE: resources/views/livewire/front/seller-set-first-password.blade.php --}}
{{-- For old sellers imported from tblleads — they have no password yet         --}}
{{-- Flow: Step 1 Enter email → Step 2 OTP → Step 3 Set password → Login        --}}

@push('custom-meta')
<title>Set Your Password – GlobPulse Seller</title>
<style>
.sfp-page{background:#F0F4FF;min-height:100vh;padding-top:80px;padding-bottom:60px;display:flex;align-items:center}
.sfp-card{background:#fff;border-radius:20px;box-shadow:0 40px 80px rgba(15,23,42,.15);max-width:500px;width:100%;margin:0 auto;overflow:hidden}
.sfp-header{background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 55%,#2563eb 100%);padding:36px 40px;text-align:center}
.sfp-icon{width:56px;height:56px;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.25);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;margin:0 auto 12px}
.sfp-header h2{font-size:22px;font-weight:900;color:#fff;margin:0 0 4px}
.sfp-header p{font-size:13px;color:rgba(255,255,255,.65);margin:0}
.sfp-body{padding:36px 40px}
/* Step indicators */
.sfp-steps{display:flex;justify-content:center;gap:8px;margin-bottom:24px}
.sfp-step{height:4px;width:80px;border-radius:4px;background:#E2E8F0;transition:background .3s}
.sfp-step.active{background:#2563eb}
/* Alerts */
.sfp-alert{border-radius:10px;padding:13px 16px;margin-bottom:20px;font-size:13px;font-weight:600;display:flex;align-items:flex-start;gap:10px;line-height:1.5}
.sfp-alert.error{background:#FEF2F2;border:1px solid #FECACA;color:#991B1B}
.sfp-alert.success{background:#F0FDF4;border:1px solid #BBF7D0;color:#166534}
.sfp-alert.info{background:#EFF6FF;border:1px solid #BFDBFE;color:#1e40af}
/* Form */
.sfp-fg{margin-bottom:18px}
.sfp-fg label{font-size:13px;font-weight:700;color:#374151;margin-bottom:6px;display:block}
.sfp-input{height:48px;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;background:#fafafa;padding:0 44px 0 14px;width:100%;box-sizing:border-box;font-family:inherit;outline:none;transition:all .2s}
.sfp-input:focus{border-color:#2563eb;background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
/* OTP boxes */
.sfp-otp-row{display:flex;gap:10px;justify-content:center;margin-bottom:6px}
.sfp-otp-box{width:58px;height:64px;border:2px solid #E2E8F0;border-radius:12px;font-size:28px;font-weight:900;text-align:center;color:#1D4ED8;background:#EFF6FF;font-family:'Courier New',monospace;outline:none;transition:border .2s}
.sfp-otp-box:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.15)}
.sfp-resend{text-align:center;margin-top:8px}
.sfp-resend button{background:none;border:none;font-size:13px;font-weight:700;color:#2563eb;cursor:pointer;padding:0}
/* Password field */
.sfp-pw-wrap{position:relative}
.sfp-pw-wrap .sfp-input{padding-right:44px}
.sfp-pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex}
/* Strength bar */
.sfp-strength-bar{height:4px;border-radius:4px;background:#E2E8F0;overflow:hidden;margin:8px 0 5px}
.sfp-strength-fill{height:100%;border-radius:4px;transition:all .4s;width:0}
.sfp-rules{display:grid;grid-template-columns:1fr 1fr;gap:6px}
.sfp-rule{font-size:12px;display:flex;align-items:center;gap:6px;color:#94a3b8}
.sfp-rule.pass{color:#059669}
.sfp-rule .dot{width:6px;height:6px;border-radius:50%;background:#E2E8F0;flex-shrink:0}
.sfp-rule.pass .dot{background:#059669}
/* Buttons */
.btn-sfp{width:100%;height:50px;background:#2563eb;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .25s;margin-bottom:14px}
.btn-sfp:hover{background:#1d4ed8;box-shadow:0 10px 28px rgba(37,99,235,.3);transform:translateY(-1px)}
.btn-sfp:disabled{opacity:.5;cursor:not-allowed;transform:none}
.btn-sfp-back{width:100%;height:44px;background:transparent;color:#64748b;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;font-weight:700;font-family:inherit;cursor:pointer;transition:all .2s}
.btn-sfp-back:hover{border-color:#2563eb;color:#2563eb}
.sfp-bottom{text-align:center;margin-top:16px;font-size:13px;color:#94a3b8}
.sfp-bottom a{color:#2563eb;font-weight:700;text-decoration:none}
</style>
@endpush

<div>
<livewire:front.layout.header />

<div class="sfp-page px-3">
<div class="sfp-card">

    {{-- Header --}}
    <div class="sfp-header">
        <div class="sfp-icon">
            @if($step === 1) 📧 @elseif($step === 2) 🔑 @else 🔐 @endif
        </div>
        <h2>
            @if($step === 1) First Time Login? Set Your Password
            @elseif($step === 2) Verify Your Email
            @else Create Your Password
            @endif
        </h2>
        <p>
            @if($step === 1) Enter your registered email — we'll send a one-time code to verify it's you
            @elseif($step === 2) Enter the 4-digit code sent to <strong style="color:#fff;">{{ $email }}</strong>
            @else Choose a strong password. You'll use this every time you login.
            @endif
        </p>
    </div>

    <div class="sfp-body">

        {{-- Step indicators --}}
        <div class="sfp-steps">
            <div class="sfp-step {{ $step >= 1 ? 'active' : '' }}"></div>
            <div class="sfp-step {{ $step >= 2 ? 'active' : '' }}"></div>
            <div class="sfp-step {{ $step >= 3 ? 'active' : '' }}"></div>
        </div>

        {{-- Alerts --}}
        @if($errorMsg)
        <div class="sfp-alert error"><span>❌</span> <span>{{ $errorMsg }}</span></div>
        @endif
        @if($successMsg)
        <div class="sfp-alert success"><span>✅</span> <span>{{ $successMsg }}</span></div>
        @elseif(session('info'))
        <div class="sfp-alert info"><span>ℹ️</span> <span>{{ session('info') }}</span></div>
        @endif

        {{-- ══ STEP 1: Enter Email ══ --}}
        @if($step === 1)
        <div class="sfp-alert info" style="margin-bottom:16px;">
            <span>ℹ️</span>
            <span>This is for sellers who were registered on our previous platform and don't have a password yet. If you're a new seller, <a href="{{ route('seller.register') }}" style="color:#1e40af;font-weight:700;">register here</a>.</span>
        </div>
        <form wire:submit.prevent="sendOtp">
            <div class="sfp-fg">
                <label>Your Registered Email Address</label>
                <input type="email" class="sfp-input" wire:model="email"
                    placeholder="you@company.com" autocomplete="email"
                    style="padding-right:14px;">
                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <button type="submit" class="btn-sfp" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="sendOtp">
                    📧 Send Verification Code
                </span>
                <span wire:loading wire:target="sendOtp">
                    <span class="spinner-border spinner-border-sm me-2"></span> Sending...
                </span>
            </button>
        </form>
        @endif

        {{-- ══ STEP 2: Enter OTP ══ --}}
        @if($step === 2)
        <form wire:submit.prevent="verifyOtp">
            <div class="sfp-fg">
                <label style="text-align:center;display:block;">Enter 4-digit verification code</label>
                <div class="sfp-otp-row">
                    <input type="text" maxlength="1" class="sfp-otp-box" wire:model="d1"
                        id="sfp-d1" oninput="sfpNext(this,'sfp-d2')" onkeydown="sfpBack(event,this,null)" autofocus>
                    <input type="text" maxlength="1" class="sfp-otp-box" wire:model="d2"
                        id="sfp-d2" oninput="sfpNext(this,'sfp-d3')" onkeydown="sfpBack(event,this,'sfp-d1')">
                    <input type="text" maxlength="1" class="sfp-otp-box" wire:model="d3"
                        id="sfp-d3" oninput="sfpNext(this,'sfp-d4')" onkeydown="sfpBack(event,this,'sfp-d2')">
                    <input type="text" maxlength="1" class="sfp-otp-box" wire:model="d4"
                        id="sfp-d4" oninput="sfpNext(this,null)" onkeydown="sfpBack(event,this,'sfp-d3')">
                </div>
                <div class="sfp-resend">
                    <button type="button" wire:click="resendOtp">Resend code</button>
                </div>
            </div>
            <button type="submit" class="btn-sfp" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="verifyOtp">✅ Verify Code</span>
                <span wire:loading wire:target="verifyOtp">
                    <span class="spinner-border spinner-border-sm me-2"></span> Verifying...
                </span>
            </button>
            <button type="button" class="btn-sfp-back" wire:click="$set('step', 1)">← Back</button>
        </form>
        @endif

        {{-- ══ STEP 3: Set Password ══ --}}
        @if($step === 3)
        <form wire:submit.prevent="setPassword">
            <div class="sfp-fg">
                <label>New Password</label>
                <div class="sfp-pw-wrap">
                    <input type="password" class="sfp-input" id="sfp-pw1"
                        wire:model.live="password"
                        placeholder="Min 8 chars, uppercase, number, symbol"
                        oninput="sfpCheck(this.value)">
                    <button type="button" class="sfp-pw-toggle" onclick="sfpToggle('sfp-pw1','sfp-e1a','sfp-e1b')">
                        <svg id="sfp-e1a" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg id="sfp-e1b" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                <div class="sfp-strength-bar"><div class="sfp-strength-fill" id="sfp-sfill"></div></div>
                <div class="sfp-rules">
                    <div class="sfp-rule" id="sfp-r-len"><div class="dot"></div> 8+ characters</div>
                    <div class="sfp-rule" id="sfp-r-up"><div class="dot"></div> Uppercase</div>
                    <div class="sfp-rule" id="sfp-r-num"><div class="dot"></div> Number</div>
                    <div class="sfp-rule" id="sfp-r-sym"><div class="dot"></div> Symbol</div>
                </div>
                @error('password')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
            </div>

            <div class="sfp-fg">
                <label>Confirm Password</label>
                <div class="sfp-pw-wrap">
                    <input type="password" class="sfp-input" id="sfp-pw2"
                        wire:model="password_confirm"
                        placeholder="Re-enter your password">
                    <button type="button" class="sfp-pw-toggle" onclick="sfpToggle('sfp-pw2','sfp-e2a','sfp-e2b')">
                        <svg id="sfp-e2a" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg id="sfp-e2b" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                @error('password_confirm')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn-sfp" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="setPassword">🔒 Set Password & Login</span>
                <span wire:loading wire:target="setPassword">
                    <span class="spinner-border spinner-border-sm me-2"></span> Saving...
                </span>
            </button>
        </form>
        @endif

        <div class="sfp-bottom">
            Remember your password? <a href="{{ route('seller.login') }}">Sign In →</a>
        </div>
    </div>
</div>
</div>

<livewire:front.layout.footer />

<script>
function sfpNext(el, nextId) {
    el.value = el.value.replace(/[^0-9]/g, '');
    if (el.value && nextId) document.getElementById(nextId)?.focus();
}
function sfpBack(e, el, prevId) {
    if (e.key === 'Backspace' && !el.value && prevId) document.getElementById(prevId)?.focus();
}
function sfpToggle(id, a, b) {
    const i = document.getElementById(id);
    const ea = document.getElementById(a), eb = document.getElementById(b);
    if (i.type === 'password') { i.type = 'text'; ea.style.display = 'none'; eb.style.display = 'block'; }
    else { i.type = 'password'; ea.style.display = 'block'; eb.style.display = 'none'; }
}
function sfpCheck(v) {
    const fill = document.getElementById('sfp-sfill');
    if (!fill) return;
    const r = { len: v.length >= 8, up: /[A-Z]/.test(v), num: /[0-9]/.test(v), sym: /[@$!%*#?&]/.test(v) };
    ['len','up','num','sym'].forEach(k => {
        const el = document.getElementById('sfp-r-' + k);
        if (el) el.className = 'sfp-rule' + (r[k] ? ' pass' : '');
    });
    const s = [r.len, r.up, r.num, r.sym].filter(Boolean).length;
    const c = ['#EF4444','#F59E0B','#3B82F6','#10B981'][s - 1] || '#E2E8F0';
    fill.style.width = (s * 25) + '%';
    fill.style.background = c;
}
</script>
</div>