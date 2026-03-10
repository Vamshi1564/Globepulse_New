{{-- FILE: resources/views/livewire/front/seller-set-password.blade.php --}}

@push('custom-meta')
<title>Set New Password – GlobPulse Seller</title>
<style>
.sp-page{background:#F0F4FF;min-height:100vh;padding-top:80px;padding-bottom:60px;display:flex;align-items:center}
.sp-card{background:#fff;border-radius:20px;box-shadow:0 40px 80px rgba(15,23,42,.15);max-width:520px;width:100%;margin:0 auto;overflow:hidden}
.sp-header{background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 55%,#2563eb 100%);padding:36px 40px;text-align:center}
.sp-header h2{font-size:22px;font-weight:900;color:#fff;margin:12px 0 4px}
.sp-header p{font-size:13px;color:rgba(255,255,255,.65);margin:0}
.sp-icon{width:56px;height:56px;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.25);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;margin:0 auto 12px}
.sp-body{padding:36px 40px}
.sp-alert{border-radius:10px;padding:13px 16px;margin-bottom:20px;font-size:13px;font-weight:600;display:flex;align-items:flex-start;gap:10px;line-height:1.5}
.sp-alert.error{background:#FEF2F2;border:1px solid #FECACA;color:#991B1B}
.sp-alert.info{background:#EFF6FF;border:1px solid #BFDBFE;color:#1e40af}
.sp-fg{margin-bottom:18px}
.sp-fg label{font-size:13px;font-weight:700;color:#374151;margin-bottom:6px;display:block}
.sp-input{height:48px;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;background:#fafafa;padding:0 44px 0 14px;width:100%;box-sizing:border-box;font-family:inherit;outline:none;transition:all .2s}
.sp-input:focus{border-color:#2563eb;background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.sp-pw-wrap{position:relative}
.sp-pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex}
.sp-pw-toggle:hover{color:#2563eb}
.sp-strength{margin-top:8px}
.sp-strength-bar{height:4px;border-radius:4px;background:#E2E8F0;overflow:hidden;margin-bottom:5px}
.sp-strength-fill{height:100%;border-radius:4px;transition:all .4s;width:0}
.sp-strength-text{font-size:11px;font-weight:700}
.sp-rules{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-top:10px}
.sp-rule{font-size:12px;display:flex;align-items:center;gap:6px;color:#94a3b8;transition:color .2s}
.sp-rule.pass{color:#059669}
.sp-rule .dot{width:6px;height:6px;border-radius:50%;background:#E2E8F0;transition:background .2s;flex-shrink:0}
.sp-rule.pass .dot{background:#059669}
.btn-sp{width:100%;height:50px;background:#2563eb;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .25s;margin-top:8px}
.btn-sp:hover{background:#1d4ed8;box-shadow:0 10px 28px rgba(37,99,235,.3);transform:translateY(-1px)}
.btn-sp:disabled{opacity:.5;cursor:not-allowed;transform:none}
</style>
@endpush

<div>
    <livewire:front.layout.header />

    <div class="sp-page px-3">
        <div class="sp-card">
            <div class="sp-header">
                <div class="sp-icon">🔐</div>
                <h2>Set Your New Password</h2>
                <p>Hi {{ $sellerName }}! Choose a strong password to secure your account</p>
            </div>
            <div class="sp-body">
                <div class="sp-alert info">
                    <span>ℹ️</span>
                    <span>You must set a new password before accessing your dashboard. Your temporary password will no longer work after this.</span>
                </div>

                @if($errorMsg)
                    <div class="sp-alert error"><span>❌</span> <span>{{ $errorMsg }}</span></div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="sp-fg">
                        <label>New Password</label>
                        <div class="sp-pw-wrap">
                            <input type="password" class="sp-input" id="sp-pw1"
                                wire:model.live="password"
                                placeholder="Min 8 chars, uppercase, number, symbol"
                                oninput="spCheck(this.value)">
                            <button type="button" class="sp-pw-toggle" onclick="spToggle('sp-pw1','sp-e1a','sp-e1b')">
                                <svg id="sp-e1a" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="sp-e1b" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        <div class="sp-strength">
                            <div class="sp-strength-bar"><div class="sp-strength-fill" id="sp-sfill"></div></div>
                            <span class="sp-strength-text" id="sp-stext" style="color:#94a3b8">Enter a password</span>
                        </div>
                        <div class="sp-rules">
                            <div class="sp-rule" id="sp-r-len"><div class="dot"></div> Min 8 characters</div>
                            <div class="sp-rule" id="sp-r-up"><div class="dot"></div> Uppercase letter</div>
                            <div class="sp-rule" id="sp-r-num"><div class="dot"></div> Number (0–9)</div>
                            <div class="sp-rule" id="sp-r-sym"><div class="dot"></div> Symbol (@$!%*#?&)</div>
                        </div>
                        @error('password')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div class="sp-fg">
                        <label>Confirm New Password</label>
                        <div class="sp-pw-wrap">
                            <input type="password" class="sp-input" id="sp-pw2"
                                wire:model="password_confirm"
                                placeholder="Re-enter your new password">
                            <button type="button" class="sp-pw-toggle" onclick="spToggle('sp-pw2','sp-e2a','sp-e2b')">
                                <svg id="sp-e2a" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="sp-e2b" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        @error('password_confirm')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <button type="submit" class="btn-sp" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">🔒 Set Password & Go to Dashboard</span>
                        <span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-2"></span> Saving...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <livewire:front.layout.footer />

    <script>
    function spToggle(id,a,b){const i=document.getElementById(id),ea=document.getElementById(a),eb=document.getElementById(b);if(i.type==='password'){i.type='text';ea.style.display='none';eb.style.display='block';}else{i.type='password';ea.style.display='block';eb.style.display='none';}}
    function spCheck(v){
        const fill=document.getElementById('sp-sfill'),st=document.getElementById('sp-stext');
        const rules={len:v.length>=8,up:/[A-Z]/.test(v),num:/[0-9]/.test(v),sym:/[@$!%*#?&]/.test(v)};
        ['len','up','num','sym'].forEach(k=>{const el=document.getElementById('sp-r-'+k);el.className='sp-rule'+(rules[k]?' pass':'');});
        const score=[rules.len,rules.up,rules.num,rules.sym].filter(Boolean).length;
        const lvl=v.length===0?{w:'0%',c:'#E2E8F0',l:'Enter a password',lc:'#94a3b8'}:
            [{w:'25%',c:'#EF4444',l:'Weak',lc:'#EF4444'},{w:'50%',c:'#F59E0B',l:'Fair',lc:'#F59E0B'},
             {w:'75%',c:'#3B82F6',l:'Good',lc:'#3B82F6'},{w:'100%',c:'#10B981',l:'Strong ✓',lc:'#10B981'}][score-1]||{w:'0%',c:'#E2E8F0',l:'',lc:'#94a3b8'};
        fill.style.width=lvl.w;fill.style.background=lvl.c;st.textContent=lvl.l;st.style.color=lvl.lc;
    }
    </script>
</div>