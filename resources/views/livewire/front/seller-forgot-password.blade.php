{{-- FILE: resources/views/livewire/front/seller-forgot-password.blade.php --}}

@push('custom-meta')
<title>Reset Password – GlobPulse Seller</title>
<style>
.fp-page{background:#F0F4FF;min-height:100vh;padding-top:80px;padding-bottom:60px;display:flex;align-items:center}
.fp-card{background:#fff;border-radius:20px;box-shadow:0 40px 80px rgba(15,23,42,.15);max-width:480px;width:100%;margin:0 auto;overflow:hidden}
.fp-header{background:linear-gradient(135deg,#0f172a 0%,#7c3aed 55%,#a855f7 100%);padding:36px 40px;text-align:center}
.fp-icon{width:56px;height:56px;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.25);border-radius:50%;font-size:26px;line-height:56px;text-align:center;margin:0 auto 12px}
.fp-header h2{font-size:22px;font-weight:900;color:#fff;margin:0 0 4px}
.fp-header p{font-size:13px;color:rgba(255,255,255,.65);margin:0}
.fp-body{padding:36px 40px}
.fp-alert{border-radius:10px;padding:13px 16px;margin-bottom:20px;font-size:13px;font-weight:600;display:flex;align-items:flex-start;gap:10px;line-height:1.5}
.fp-alert.error{background:#FEF2F2;border:1px solid #FECACA;color:#991B1B}
.fp-alert.success{background:#F0FDF4;border:1px solid #BBF7D0;color:#166534}
.fp-fg{margin-bottom:18px}
.fp-fg label{font-size:13px;font-weight:700;color:#374151;margin-bottom:6px;display:block}
.fp-input{height:48px;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;background:#fafafa;padding:0 44px 0 14px;width:100%;box-sizing:border-box;font-family:inherit;outline:none;transition:all .2s}
.fp-input:focus{border-color:#7c3aed;background:#fff;box-shadow:0 0 0 3px rgba(124,58,237,.1)}
.fp-pw-wrap{position:relative}
.fp-pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex}

/* OTP boxes */
.fp-otp-row{display:flex;gap:8px;justify-content:center;margin-bottom:6px}
.fp-otp-box{width:50px;height:60px;border:2px solid #E2E8F0;border-radius:12px;font-size:26px;font-weight:900;text-align:center;color:#1D4ED8;background:#EFF6FF;font-family:'Courier New',monospace;outline:none;transition:border .2s}
.fp-otp-box:focus{border-color:#7c3aed;box-shadow:0 0 0 3px rgba(124,58,237,.15)}

/* Strength */
.fp-strength{margin-top:8px}
.fp-strength-bar{height:4px;border-radius:4px;background:#E2E8F0;overflow:hidden;margin-bottom:5px}
.fp-strength-fill{height:100%;border-radius:4px;transition:all .4s;width:0}
.fp-rules{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-top:8px}
.fp-rule{font-size:12px;display:flex;align-items:center;gap:6px;color:#94a3b8}
.fp-rule.pass{color:#059669}
.fp-rule .dot{width:6px;height:6px;border-radius:50%;background:#E2E8F0;flex-shrink:0}
.fp-rule.pass .dot{background:#059669}

.btn-fp{width:100%;height:50px;background:#7c3aed;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .25s;margin-bottom:14px}
.btn-fp:hover{background:#6d28d9;box-shadow:0 10px 28px rgba(124,58,237,.3);transform:translateY(-1px)}
.btn-fp:disabled{opacity:.5;cursor:not-allowed;transform:none}
.btn-fp-back{width:100%;height:44px;background:transparent;color:#64748b;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;font-weight:700;font-family:inherit;cursor:pointer;transition:all .2s}
.btn-fp-back:hover{border-color:#7c3aed;color:#7c3aed}
.fp-resend{text-align:center;margin-top:8px}
.fp-resend button{background:none;border:none;font-size:13px;font-weight:700;color:#7c3aed;cursor:pointer;padding:0}
.fp-steps{display:flex;justify-content:center;gap:8px;margin-bottom:24px}
.fp-step{height:4px;width:60px;border-radius:4px;background:#E2E8F0;transition:background .3s}
.fp-step.active{background:#7c3aed}
.fp-bottom{text-align:center;margin-top:20px;font-size:13px;color:#94a3b8}
.fp-bottom a{color:#7c3aed;font-weight:700;text-decoration:none}
</style>
@endpush

<div>
    <livewire:front.layout.header />

    <div class="fp-page px-3">
        <div class="fp-card">

            <div class="fp-header">
                <div class="fp-icon">{{ $step === 1 ? '🔑' : '🔒' }}</div>
                <h2>{{ $step === 1 ? 'Forgot Password' : 'Reset Your Password' }}</h2>
                <p>{{ $step === 1 ? 'Enter your registered email to receive a reset code' : 'Enter the code sent to your email and set a new password' }}</p>
            </div>

            <div class="fp-body">

                {{-- Step indicator --}}
                <div class="fp-steps">
                    <div class="fp-step {{ $step >= 1 ? 'active' : '' }}"></div>
                    <div class="fp-step {{ $step >= 2 ? 'active' : '' }}"></div>
                </div>

                @if($errorMsg)
                    <div class="fp-alert error"><span>❌</span> <span>{{ $errorMsg }}</span></div>
                @endif
                @if($successMsg)
                    <div class="fp-alert success"><span>✅</span> <span>{{ $successMsg }}</span></div>
                @endif

                {{-- ════ STEP 1: Enter Email ════ --}}
                @if($step === 1)
                <form wire:submit.prevent="sendResetOtp">
                    <div class="fp-fg">
                        <label>Registered Email Address</label>
                        <input type="email" class="fp-input" wire:model="email"
                            placeholder="you@company.com" autocomplete="email" style="padding-right:14px">
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <button type="submit" class="btn-fp" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="sendResetOtp">📧 Send Reset Code</span>
                        <span wire:loading wire:target="sendResetOtp"><span class="spinner-border spinner-border-sm me-2"></span> Sending...</span>
                    </button>
                </form>
                @endif

                {{-- ════ STEP 2: OTP + New Password ════ --}}
                @if($step === 2)
                <form wire:submit.prevent="resetPassword">

                    {{-- OTP Boxes --}}
                    <div class="fp-fg">
                        <label style="text-align:center;display:block">Enter 6-digit reset code</label>
                        <div class="fp-otp-row">
                            <input type="text" maxlength="1" class="fp-otp-box" wire:model="d1" id="fp-d1" oninput="fpNext(this,'fp-d2')" onkeydown="fpBack(event,this,null)">
                            <input type="text" maxlength="1" class="fp-otp-box" wire:model="d2" id="fp-d2" oninput="fpNext(this,'fp-d3')" onkeydown="fpBack(event,this,'fp-d1')">
                            <input type="text" maxlength="1" class="fp-otp-box" wire:model="d3" id="fp-d3" oninput="fpNext(this,'fp-d4')" onkeydown="fpBack(event,this,'fp-d2')">
                            <input type="text" maxlength="1" class="fp-otp-box" wire:model="d4" id="fp-d4" oninput="fpNext(this,'fp-d5')" onkeydown="fpBack(event,this,'fp-d3')">
                            <input type="text" maxlength="1" class="fp-otp-box" wire:model="d5" id="fp-d5" oninput="fpNext(this,'fp-d6')" onkeydown="fpBack(event,this,'fp-d4')">
                            <input type="text" maxlength="1" class="fp-otp-box" wire:model="d6" id="fp-d6" oninput="fpNext(this,null)"    onkeydown="fpBack(event,this,'fp-d5')">
                        </div>
                        <div class="fp-resend">
                            <button type="button" wire:click="resendResetOtp">Resend code</button>
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div class="fp-fg">
                        <label>New Password</label>
                        <div class="fp-pw-wrap">
                            <input type="password" class="fp-input" id="fp-pw1"
                                wire:model.live="password"
                                placeholder="Min 8 chars, uppercase, number, symbol"
                                oninput="fpCheck(this.value)">
                            <button type="button" class="fp-pw-toggle" onclick="fpToggle('fp-pw1','fp-ea','fp-eb')">
                                <svg id="fp-ea" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="fp-eb" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        <div class="fp-strength">
                            <div class="fp-strength-bar"><div class="fp-strength-fill" id="fp-sfill"></div></div>
                            <div class="fp-rules">
                                <div class="fp-rule" id="fp-r-len"><div class="dot"></div> 8+ characters</div>
                                <div class="fp-rule" id="fp-r-up"><div class="dot"></div> Uppercase</div>
                                <div class="fp-rule" id="fp-r-num"><div class="dot"></div> Number</div>
                                <div class="fp-rule" id="fp-r-sym"><div class="dot"></div> Symbol</div>
                            </div>
                        </div>
                        @error('password')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="fp-fg">
                        <label>Confirm New Password</label>
                        <div class="fp-pw-wrap">
                            <input type="password" class="fp-input" id="fp-pw2"
                                wire:model="password_confirm"
                                placeholder="Re-enter new password">
                            <button type="button" class="fp-pw-toggle" onclick="fpToggle('fp-pw2','fp-ec','fp-ed')">
                                <svg id="fp-ec" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="fp-ed" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        @error('password_confirm')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <button type="submit" class="btn-fp" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="resetPassword">🔒 Reset Password</span>
                        <span wire:loading wire:target="resetPassword"><span class="spinner-border spinner-border-sm me-2"></span> Resetting...</span>
                    </button>

                    <button type="button" class="btn-fp-back" wire:click="goBack">← Back</button>
                </form>
                @endif

                <div class="fp-bottom">
                    Remember your password? <a href="{{ route('seller.login') }}">Sign In →</a>
                </div>
            </div>
        </div>
    </div>

    <livewire:front.layout.footer />

    <script>
    function fpNext(el, nextId) {
        el.value = el.value.replace(/[^0-9]/g,'');
        if (el.value && nextId) document.getElementById(nextId).focus();
    }
    function fpBack(e, el, prevId) {
        if (e.key === 'Backspace' && !el.value && prevId) document.getElementById(prevId).focus();
    }
    function fpToggle(id,a,b){
        const i=document.getElementById(id),ea=document.getElementById(a),eb=document.getElementById(b);
        if(i.type==='password'){i.type='text';ea.style.display='none';eb.style.display='block';}
        else{i.type='password';ea.style.display='block';eb.style.display='none';}
    }
    function fpCheck(v){
        const fill=document.getElementById('fp-sfill');
        if(!fill)return;
        const r={len:v.length>=8,up:/[A-Z]/.test(v),num:/[0-9]/.test(v),sym:/[@$!%*#?&]/.test(v)};
        ['len','up','num','sym'].forEach(k=>{const el=document.getElementById('fp-r-'+k);if(el)el.className='fp-rule'+(r[k]?' pass':'');});
        const s=[r.len,r.up,r.num,r.sym].filter(Boolean).length;
        const c=['#EF4444','#F59E0B','#3B82F6','#10B981'][s-1]||'#E2E8F0';
        fill.style.width=(s*25)+'%';fill.style.background=c;
    }
    </script>
</div>