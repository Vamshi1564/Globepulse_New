{{--
    FILE: resources/views/livewire/front/seller-register.blade.php
    Component: App\Livewire\Front\SellerRegister
    Route: GET /seller/register  →  name('seller.register')
    Split layout: dark left + form right. Like Naukri/Flipkart seller signup.
--}}
@push('custom-meta')
<title>Seller Registration – GlobPulse</title>
<style>
.sr-page{background:#f0f4ff;min-height:100vh;padding-top:80px;padding-bottom:60px}
.sr-wrap{display:grid;grid-template-columns:2fr 3fr;border-radius:20px;overflow:hidden;box-shadow:0 40px 80px rgba(15,23,42,.18);max-width:960px;margin:0 auto}
.sr-left{background:linear-gradient(145deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%);padding:48px 40px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
.sr-left::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(37,99,235,.25),transparent 70%);top:-120px;right:-120px;pointer-events:none}
.sr-left-body{margin-top:40px;position:relative;z-index:1}
.sr-left-body h2{font-size:28px;font-weight:900;color:#fff;line-height:1.25;letter-spacing:-.5px;margin-bottom:12px}
.sr-left-body h2 em{color:#f59e0b;font-style:normal}
.sr-left-body p{font-size:14px;color:rgba(255,255,255,.65);line-height:1.75;margin-bottom:28px}
.sr-steps{display:flex;flex-direction:column;gap:0}
.sr-step-item{display:flex;gap:12px;align-items:flex-start;padding-bottom:20px;position:relative}
.sr-step-item:not(:last-child)::after{content:'';position:absolute;left:14px;top:32px;bottom:0;width:2px;background:rgba(255,255,255,.1)}
.sr-step-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;flex-shrink:0}
.sr-step-dot.active{background:#2563eb;color:#fff;box-shadow:0 0 0 4px rgba(37,99,235,.25)}
.sr-step-dot.next{background:rgba(255,255,255,.1);color:rgba(255,255,255,.4);border:1px solid rgba(255,255,255,.15)}
.sr-step-text h5{font-size:13px;font-weight:700;color:#fff;margin:0 0 2px}
.sr-step-text p{font-size:11px;color:rgba(255,255,255,.5);margin:0}
.sr-left-foot{font-size:13px;color:rgba(255,255,255,.4);position:relative;z-index:1}
.sr-left-foot a{color:rgba(255,255,255,.7);text-decoration:none;font-weight:600}
/* Right */
.sr-right{background:#fff;padding:48px 44px;display:flex;flex-direction:column;justify-content:center}
.sr-top-nav{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px}
.sr-back-link{display:flex;align-items:center;gap:6px;font-size:13px;color:#64748b;font-weight:600;text-decoration:none}
.sr-back-link:hover{color:#2563eb}
.sr-fg{margin-bottom:16px}
.sr-fg .form-label{font-size:13px;font-weight:700;color:#374151;margin-bottom:6px}
.sr-fg .form-control,.sr-fg .form-select{height:46px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;background:#fafafa;transition:all .2s}
.sr-fg .form-control:focus,.sr-fg .form-select:focus{border-color:#2563eb;background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.btn-sr-submit{width:100%;height:50px;background:#2563eb;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .25s}
.btn-sr-submit:hover{background:#1d4ed8;box-shadow:0 10px 28px rgba(37,99,235,.35)}
.btn-sr-submit:disabled{opacity:.65;cursor:not-allowed}
@media(max-width:768px){.sr-wrap{grid-template-columns:1fr}.sr-left{display:none}.sr-right{padding:36px 24px;border-radius:20px}.sr-page{padding-top:90px}}
</style>
@endpush

<div>
    <livewire:front.layout.header />

    <div class="sr-page px-3">
        <div class="sr-wrap">

            <!-- LEFT PANEL -->
            <div class="sr-left">
                <div style="position:relative;z-index:1">
                    <img src="{{ asset('assets/img/icons/gfe.svg') }}" alt="GlobPulse" style="height:34px">
                </div>
                <div class="sr-left-body">
                    <h2>Join <em>50,000+</em> sellers growing globally</h2>
                    <p>Register in 2 minutes. Login credentials sent to your email instantly after verification.</p>
                    <div class="sr-steps">
                        <div class="sr-step-item">
                            <div class="sr-step-dot active">1</div>
                            <div class="sr-step-text"><h5>Fill your details</h5><p>Name, email, mobile, company</p></div>
                        </div>
                        <div class="sr-step-item">
                            <div class="sr-step-dot next">2</div>
                            <div class="sr-step-text"><h5>Verify email</h5><p>Enter OTP sent to your email</p></div>
                        </div>
                        <div class="sr-step-item">
                            <div class="sr-step-dot next">3</div>
                            <div class="sr-step-text"><h5>Get login credentials</h5><p>Email + temp password sent instantly</p></div>
                        </div>
                        <div class="sr-step-item">
                            <div class="sr-step-dot next">4</div>
                            <div class="sr-step-text"><h5>Complete profile &amp; go live</h5><p>Add business details after login</p></div>
                        </div>
                    </div>
                </div>
                <div class="sr-left-foot">
                    Already a seller?
                    {{-- Temporarily use # until seller.login route exists --}}
                    <a href="{{ route('seller.login') }}">Sign in →</a>
                </div>
            </div>

            <!-- RIGHT PANEL: FORM -->
            <div class="sr-right">
                <div class="sr-top-nav">
                    <a href="{{ route('start-selling') }}" class="sr-back-link">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back
                    </a>
                    <span style="font-size:13px;color:#64748b">
                        Have account? <a href="{{ route('seller.login') }}" style="color:#2563eb;font-weight:700;text-decoration:none">Sign in</a>
                    </span>
                </div>

                <div style="margin-bottom:24px">
                    <h2 style="font-size:22px;font-weight:900;color:#0f172a;letter-spacing:-.5px;margin-bottom:4px">
                        Create your seller account
                    </h2>
                    <p style="font-size:13px;color:#64748b;margin:0">
                        Takes 2 minutes · Free forever · No credit card required
                    </p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center p-2 mb-3">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form wire:submit.prevent="submit">
                    <div class="sr-fg">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            wire:model="name" placeholder="e.g. Rajesh Kumar" autocomplete="name">
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="sr-fg">
                        <label class="form-label">Business Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            wire:model="email" placeholder="you@company.com" autocomplete="email">
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="sr-fg">
                        <label class="form-label">Mobile Number *</label>
                        <input type="tel" class="form-control @error('phonenumber') is-invalid @enderror"
                            wire:model="phonenumber" placeholder="+91 98765 43210">
                        @error('phonenumber')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="sr-fg">
                                <label class="form-label">Company Name *</label>
                                <input type="text" class="form-control @error('company') is-invalid @enderror"
                                    wire:model="company" placeholder="Acme Exports Ltd.">
                                @error('company')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sr-fg">
                                <label class="form-label">Company Website</label>
                                <input type="url" class="form-control" wire:model="company_website" placeholder="https://acme.com">
                            </div>
                        </div>
                    </div>

                    <div class="sr-fg">
                        <div wire:ignore>
                            <label class="form-label">Country *</label>
                            <select class="form-select" wire:model="country" id="sr-country" style="width:100%">
                                <option value="">-- Select Country --</option>
                                @foreach($countries as $countr)
                                    <option value="{{ $countr->country_id }}"
                                        {{ $countr->country_id == $country ? 'selected' : '' }}>
                                        {{ $countr->short_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="sr-terms" required>
                        <label class="form-check-label small" for="sr-terms">
                            I accept the <a href="{{ route('term-conditions') }}" target="_blank" class="text-primary fw-semibold">Terms & Conditions</a>
                        </label>
                    </div>

                    <button type="submit" class="btn-sr-submit" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Register &amp; Get Verification Code
                        </span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-2"></span> Sending OTP...
                        </span>
                    </button>

                    <p style="font-size:11px;color:#94a3b8;text-align:center;margin-top:10px">
                        Your login credentials will be emailed after OTP verification
                    </p>
                </form>
            </div>

        </div>
    </div>

    <livewire:front.layout.footer />

    <script>
    $(document).ready(function() {
        $('#sr-country').select2();
        $('#sr-country').on('change', function() {
            @this.set('country', $(this).val());
        });
    });
    </script>
</div>