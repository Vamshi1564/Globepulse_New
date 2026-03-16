{{-- 
FILE: resources/views/livewire/front/buyer-login.blade.php
Component: App\Livewire\Front\BuyerLogin
Route: GET /buyer/login → name('buyer.login')
--}}

@push('custom-meta')
<title>Buyer Login – GlobPulse</title>
<style>
.sl-page{background:#F0F4FF;min-height:100vh;padding-top:80px;padding-bottom:60px}
.sl-wrap{display:grid;grid-template-columns:2fr 3fr;border-radius:20px;overflow:hidden;box-shadow:0 40px 80px rgba(15,23,42,.18);max-width:900px;margin:0 auto}
.sl-left{background:linear-gradient(145deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%);padding:48px 36px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
.sl-left::before{content:'';position:absolute;width:350px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(37,99,235,.25),transparent 70%);top:-100px;right:-100px}
.sl-left-body{position:relative;z-index:1;margin-top:40px}
.sl-left-body h3{font-size:26px;font-weight:900;color:#fff;line-height:1.25;margin-bottom:12px}
.sl-left-body h3 em{color:#f59e0b;font-style:normal}
.sl-left-body p{font-size:14px;color:rgba(255,255,255,.65);line-height:1.75;margin-bottom:28px}
.sl-perk{display:flex;align-items:center;gap:12px;margin-bottom:12px}
.sl-perk-dot{width:28px;height:28px;border-radius:50%;background:rgba(16,185,129,.2);border:1px solid rgba(16,185,129,.4);display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.sl-perk span{font-size:13px;color:rgba(255,255,255,.8);font-weight:500}
.sl-left-foot{font-size:13px;color:rgba(255,255,255,.4);position:relative;z-index:1}
.sl-left-foot a{color:rgba(255,255,255,.75);text-decoration:none;font-weight:700}
.sl-right{background:#fff;padding:52px 44px;display:flex;flex-direction:column;justify-content:center}
.sl-head{margin-bottom:28px}
.sl-head h2{font-size:24px;font-weight:900;color:#0f172a;letter-spacing:-.5px;margin-bottom:4px}
.sl-head p{font-size:14px;color:#64748b;margin:0}
.sl-alert{border-radius:10px;padding:13px 16px;margin-bottom:20px;font-size:13px;font-weight:600;display:flex;align-items:flex-start;gap:10px;line-height:1.5}
.sl-alert.error{background:#FEF2F2;border:1px solid #FECACA;color:#991B1B}
.sl-alert.success{background:#F0FDF4;border:1px solid #BBF7D0;color:#166534}
.sl-fg{margin-bottom:18px}
.sl-fg label{font-size:13px;font-weight:700;color:#374151;margin-bottom:6px;display:block}
.sl-input{height:48px;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;background:#fafafa;transition:all .2s;padding:0 14px;width:100%;box-sizing:border-box;font-family:inherit;outline:none}
.sl-input:focus{border-color:#2563eb;background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.sl-pw-wrap{position:relative}
.sl-pw-wrap .sl-input{padding-right:48px}
.sl-pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex;align-items:center}
.sl-pw-toggle:hover{color:#2563eb}
.sl-forgot{text-align:right;margin-top:-10px;margin-bottom:18px}
.sl-forgot a{font-size:12px;font-weight:700;color:#2563eb;text-decoration:none}
.btn-sl-submit{width:100%;height:50px;background:#2563eb;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .25s;margin-bottom:16px}
.btn-sl-submit:hover{background:#1d4ed8;box-shadow:0 10px 28px rgba(37,99,235,.35);transform:translateY(-1px)}
.btn-sl-submit:disabled{opacity:.6;cursor:not-allowed;transform:none}
.sl-divider{display:flex;align-items:center;gap:10px;margin:20px 0}
.sl-divider::before,.sl-divider::after{content:'';flex:1;height:1px;background:#E2E8F0}
.sl-divider span{font-size:12px;color:#94a3b8;white-space:nowrap}
.btn-sl-register{display:block;text-align:center;padding:13px;border:1.5px solid #E2E8F0;border-radius:10px;font-size:14px;font-weight:700;color:#0f172a;text-decoration:none;transition:all .2s}
.btn-sl-register:hover{border-color:#2563eb;color:#2563eb;background:#EFF6FF}
@media(max-width:768px){.sl-wrap{grid-template-columns:1fr}.sl-left{display:none}.sl-right{padding:36px 24px;border-radius:20px}.sl-page{padding-top:90px}}
</style>
@endpush

<div>
<livewire:front.layout.header />

<div class="sl-page px-3">
<div class="sl-wrap">

{{-- LEFT --}}
<div class="sl-left">

<div style="position:relative;z-index:1" class="mt-3">
<img src="{{ asset('assets/img/logos/GFEPLUSE1.png') }}" style="height:58px">
</div>

<div class="sl-left-body">

<h3>Welcome back to<br><em>GlobPulse Buyer</em></h3>

<p>
Access your buyer dashboard to discover suppliers,
send inquiries and manage your sourcing requests.
</p>

<div class="sl-perk">
<div class="sl-perk-dot">🔍</div>
<span>Find verified global suppliers</span>
</div>

<div class="sl-perk">
<div class="sl-perk-dot">📩</div>
<span>Send RFQs and inquiries instantly</span>
</div>

<div class="sl-perk">
<div class="sl-perk-dot">🌍</div>
<span>Source products from 180+ countries</span>
</div>

<div class="sl-perk">
<div class="sl-perk-dot">🤝</div>
<span>Direct communication with manufacturers</span>
</div>

</div>

<div class="sl-left-foot">
New to GlobPulse?
<a href="{{ route('buyer.register') }}">Create free account →</a>
</div>

</div>


{{-- RIGHT --}}
<div class="sl-right">

@if(session('login_success'))
<div class="sl-alert success">
<span>✅</span>
<span>{{ session('login_success') }}</span>
</div>
@endif

<div class="sl-head">
<h2>Sign in to your account</h2>
<p>Enter your credentials to access your buyer dashboard</p>
</div>

<form wire:submit.prevent="login">

<div class="sl-fg">
<label>Email Address</label>

<input type="email"
class="sl-input"
wire:model="email"
placeholder="you@email.com"
autocomplete="email">

@error('email')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>


<div class="sl-fg">
<label>Password</label>

<div class="sl-pw-wrap">

<input
type="password"
class="sl-input"
wire:model="password"
placeholder="Enter your password"
id="sl-pw"
autocomplete="current-password">

<button type="button" class="sl-pw-toggle" onclick="slTogglePw()">

<svg id="sl-eye-show" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
<circle cx="12" cy="12" r="3"/>
</svg>

<svg id="sl-eye-hide" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
<line x1="1" y1="1" x2="23" y2="23"/>
</svg>

</button>

</div>

@error('password')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>


<div class="sl-forgot">
<a href="{{ route('buyer.forgot-password') }}">Forgot password?</a>
</div>


<div class="form-check mb-4">
<input class="form-check-input" type="checkbox" wire:model="remember" id="sl-remember">
<label class="form-check-label small" for="sl-remember">
Remember me on this device
</label>
</div>


<button type="submit" class="btn-sl-submit" wire:loading.attr="disabled">

<span wire:loading.remove wire:target="login">
Sign In
</span>

<span wire:loading wire:target="login">
<span class="spinner-border spinner-border-sm me-2"></span>
Signing in...
</span>

</button>

</form>


<div class="sl-divider">
<span>New to GlobPulse?</span>
</div>

<a href="{{ route('buyer.register') }}" class="btn-sl-register">
Create Free Buyer Account →
</a>

</div>
</div>
</div>

<livewire:front.layout.footer />


<script>
function slTogglePw() {

const pw   = document.getElementById('sl-pw');
const show = document.getElementById('sl-eye-show');
const hide = document.getElementById('sl-eye-hide');

if (pw.type === 'password') {
pw.type = 'text';
show.style.display='none';
hide.style.display='block';
} else {
pw.type = 'password';
show.style.display='block';
hide.style.display='none';
}

}
</script>

</div>