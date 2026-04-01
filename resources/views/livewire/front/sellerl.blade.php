{{--
    FILE: resources/views/livewire/front/seller.blade.php
    Component: App\Livewire\Front\Seller
    Route: GET /start-selling  →  name('start-selling')

    PURE LANDING PAGE — No form here.
    "Start Selling" button → goes to /seller/register (separate page)
    Uses YOUR existing header + footer. No layouts.app needed.
--}}

@push('custom-meta')
<title>Start Selling on GlobPulse – Reach Global B2B Buyers</title>
<meta name="description" content="Join GlobPulse as a seller. Reach verified B2B buyers from 180+ countries. Free to start.">
<style>
/* ─── HERO ─── */
.ss-hero{
    background:linear-gradient(135deg,#0a1628 0%,#1e3a8a 55%,#1d4ed8 100%);
    min-height:90vh;
    display:flex;align-items:center;
    position:relative;overflow:hidden;max-width: 100%;
    padding-top:80px;padding-bottom:60px;
}
.ss-hero::before{content:'';position:absolute;width:400px;max-width: 100%;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(37,99,235,.22),transparent 70%);top:-150px;right:-120px;pointer-events:none}
.ss-hero::after{content:'';position:absolute;width:250px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(245,158,11,.1),transparent 70%);bottom:-60px;left:50px;pointer-events:none}
.ss-grid-bg{position:absolute;inset:0;width:100%;overflow:hidden;background-image:linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px);background-size:48px 48px}

.ss-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);padding:6px 18px;border-radius:30px;font-size:12px;font-weight:700;color:rgba(255,255,255,.9);letter-spacing:.6px;text-transform:uppercase;margin-bottom:28px}
.ss-dot{width:7px;height:7px;border-radius:50%;background:#f59e0b;display:inline-block;animation:blink 2s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}

.ss-hero h1{font-size:52px;font-weight:900;color:#fff;line-height:1.1;letter-spacing:-2px;margin-bottom:20px}
.ss-hero h1 em{color:#f59e0b;font-style:normal}
.ss-hero .hero-lead{color:rgba(255,255,255,.72);font-size:18px;line-height:1.75;margin-bottom:40px;max-width:540px}

.btn-hero-main{display:inline-flex;align-items:center;gap:12px;background:#f59e0b;color:#000;border:none;border-radius:12px;padding:18px 40px;font-size:17px;font-weight:900;cursor:pointer;text-decoration:none;transition:all .25s;font-family:inherit}
.btn-hero-main:hover{background:#e08f00;color:#000;transform:translateY(-2px);box-shadow:0 16px 40px rgba(245,158,11,.4)}
.btn-hero-see{display:inline-flex;align-items:center;gap:8px;color:rgba(255,255,255,.75);font-size:14px;font-weight:600;text-decoration:none;padding:18px 24px;border:1.5px solid rgba(255,255,255,.2);border-radius:12px;transition:all .25s}
.btn-hero-see:hover{background:rgba(255,255,255,.08);color:#fff;border-color:rgba(255,255,255,.4)}

/* Stats bar */
.ss-stats{display:flex;border:1px solid rgba(255,255,255,.12);border-radius:16px;overflow:hidden;margin-top:48px;max-width:500px}
.ss-stat{flex:1;padding:20px 12px;text-align:center;border-right:1px solid rgba(255,255,255,.1)}
.ss-stat:last-child{border-right:none}
.ss-stat-n{font-size:28px;font-weight:900;color:#fff;line-height:1}
.ss-stat-l{font-size:11px;color:rgba(255,255,255,.5);margin-top:5px;letter-spacing:.3px}

/* Right visual box */
.ss-visual{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:24px;padding:32px;backdrop-filter:blur(10px)}
.ss-visual-title{font-size:15px;font-weight:700;color:rgba(255,255,255,.9);margin-bottom:20px}
.ss-perk{display:flex;align-items:flex-start;gap:14px;padding:14px 16px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.07);margin-bottom:10px;transition:all .2s}
.ss-perk:hover{background:rgba(255,255,255,.09)}
.ss-perk-icon{width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.ss-perk h5{font-size:13px;font-weight:700;color:#fff;margin:0 0 2px}
.ss-perk p{font-size:12px;color:rgba(255,255,255,.55);margin:0;line-height:1.5}
.ss-visual-footer{margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,.1);font-size:12px;color:rgba(255,255,255,.4);text-align:center}

/* ─── STEPS ─── */
.ss-step-num{width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:900;color:#fff;margin:0 auto 18px;border:3px solid #fff}

/* ─── DARK BENEFITS ─── */
.ss-benefits-bg{background:#0f172a}
.ss-bitem{display:flex;gap:14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:18px;margin-bottom:12px;transition:all .2s}
.ss-bitem:hover{background:rgba(37,99,235,.12);border-color:rgba(37,99,235,.3)}
.ss-bicon{width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}

/* ─── PLANS ─── */
.ss-plan{border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px;margin-bottom:14px;position:relative;transition:all .25s;cursor:pointer}
.ss-plan:hover,.ss-plan.hot{border-color:#2563eb;background:rgba(37,99,235,.15)}
.ss-plan-badge{position:absolute;top:-11px;left:16px;background:#f59e0b;color:#000;font-size:10px;font-weight:800;padding:3px 12px;border-radius:20px}
.ss-feat{font-size:11px;font-weight:600;background:rgba(255,255,255,.07);padding:3px 10px;border-radius:20px;color:rgba(255,255,255,.7);display:inline-block;margin:3px 3px 0 0}

/* ─── TESTIMONIALS ─── */
.ss-tc{border:1px solid #e2e8f0;border-radius:16px;padding:26px;transition:all .25s;height:100%}
.ss-tc:hover{border-color:#2563eb;box-shadow:0 8px 32px rgba(37,99,235,.1);transform:translateY(-3px)}

/* ─── BOTTOM CTA ─── */
.ss-cta-bg{background:linear-gradient(135deg,#1d4ed8 0%,#0f172a 100%);position:relative;overflow:hidden}
.ss-cta-bg::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(245,158,11,.1),transparent 60%)}

/* ─── ANIMATIONS ─── */
@keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}
.a1{animation:fadeUp .6s .1s ease both}
.a2{animation:fadeUp .6s .25s ease both}
.a3{animation:fadeUp .6s .4s ease both}
.a4{animation:fadeUp .6s .55s ease both}

/* ─── RESPONSIVE ─── */
@media(max-width:991px){
    .ss-hero h1{font-size:34px}
    .ss-hero{min-height:auto}
    .ss-stats{max-width:100%}
}
@media(max-width:576px){
    .ss-hero h1{font-size:26px}
}
@media(max-width:768px){
    .ss-hero::before,
    .ss-hero::after{
        display:none;
    }
}
.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
}

.container {
    max-width: 100%;
    
}
</style>
@endpush

<div>
    {{-- YOUR EXISTING HEADER — unchanged --}}
    <livewire:front.layout.header />


    {{-- ════════════════════════════════════
         HERO — No form here, just CTA button
    ════════════════════════════════════ --}}
    <section class="ss-hero">
        <div class="ss-grid-bg"></div>
        <div class="container position-relative" style="z-index:1">
            <div class="row align-items-center g-5">

                {{-- LEFT: Headline + Button --}}
                <div class="col-lg-6">
                    <div class="ss-badge a1">
                        <span class="ss-dot"></span>
                        B2B Marketplace &nbsp;·&nbsp; 180+ Countries
                    </div>

                    <h1 class="a2">
                        Sell to the<br>world's biggest<br><em>B2B buyers</em>
                    </h1>

                    <p class="hero-lead a3">
                        Join GlobPulse — the fastest-growing B2B marketplace for
                        manufacturers, wholesalers and exporters.
                        Register free and start receiving buyer inquiries from 180+ countries.
                    </p>

                    <div class="d-flex align-items-center gap-3 flex-wrap a4">
                        {{-- Main CTA → goes to seller register PAGE (not modal) --}}
                        <a href="{{ route('seller.register') }}" class="btn-hero-main">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Start Selling — It's Free
                        </a>
                        <a href="#how-it-works" class="btn-hero-see">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                            See how it works
                        </a>
                    </div>

                    <div class="ss-stats a4">
                        <div class="ss-stat"><div class="ss-stat-n">50K+</div><div class="ss-stat-l">Active Sellers</div></div>
                        <div class="ss-stat"><div class="ss-stat-n">180+</div><div class="ss-stat-l">Countries</div></div>
                        <div class="ss-stat"><div class="ss-stat-n">$2B+</div><div class="ss-stat-l">Trade Volume</div></div>
                        <div class="ss-stat"><div class="ss-stat-n">24hr</div><div class="ss-stat-l">Approval</div></div>
                    </div>
                </div>

                {{-- RIGHT: Feature cards --}}
                <div class="col-lg-6 a3">
                    <div class="ss-visual">
                        <div class="ss-visual-title">🚀 Why sellers choose GlobPulse</div>
                        <div class="ss-perk">
                            <div class="ss-perk-icon">⚡</div>
                            <div><h5>Live in under 24 hours</h5><p>Register, verify email, start receiving buyer inquiries today</p></div>
                        </div>
                        <div class="ss-perk">
                            <div class="ss-perk-icon">🎯</div>
                            <div><h5>AI-powered buyer matching</h5><p>Our algorithm connects you with buyers actively searching for your products</p></div>
                        </div>
                        <div class="ss-perk">
                            <div class="ss-perk-icon">🏅</div>
                            <div><h5>Verified seller badge</h5><p>KYC-verified badge builds buyer trust and boosts inquiries significantly</p></div>
                        </div>
                        <div class="ss-perk">
                            <div class="ss-perk-icon">🆓</div>
                            <div><h5>Free to start — always</h5><p>No credit card, no setup fee. Upgrade only when you're ready</p></div>
                        </div>
                        <div class="ss-visual-footer">
                            ✅ SSL Secured &nbsp;·&nbsp; ✅ Verified Buyers Only &nbsp;·&nbsp; ✅ No Commission on Free Plan
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ════════════════════════════════════
         HOW IT WORKS
    ════════════════════════════════════ --}}
    <section class="py-6 bg-light" id="how-it-works">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 rounded-pill mb-3">
                    Simple Process
                </span>
                <h2 class="fw-bold fs-2">Start selling in 4 easy steps</h2>
                <p class="text-muted mx-auto" style="max-width:500px">
                    From registration to first buyer inquiry — in less than 24 hours.
                </p>
            </div>

            <div class="row g-4 position-relative">
                {{-- connector line (desktop only) --}}
                <div class="d-none d-lg-block position-absolute w-100"
    style="top:30px;left:0;height:2px;
    background:linear-gradient(90deg,#2563eb,#f59e0b);
    z-index:0;">
</div>

                <div class="col-6 col-lg-3 text-center position-relative" style="z-index:1">
                    <div class="ss-step-num" style="background:#2563eb;box-shadow:0 6px 20px rgba(37,99,235,.3)">1</div>
                    <h5 class="fw-bold">Register Free</h5>
                    <p class="text-muted small">Enter name, email, mobile and company. Takes 2 minutes.</p>
                </div>
                <div class="col-6 col-lg-3 text-center position-relative" style="z-index:1">
                    <div class="ss-step-num" style="background:#0f172a;box-shadow:0 6px 20px rgba(15,23,42,.3)">2</div>
                    <h5 class="fw-bold">Verify Email</h5>
                    <p class="text-muted small">Enter OTP. Login credentials sent to your inbox instantly.</p>
                </div>
                <div class="col-6 col-lg-3 text-center position-relative" style="z-index:1">
                    <div class="ss-step-num" style="background:#f59e0b;color:#000;box-shadow:0 6px 20px rgba(245,158,11,.3)">3</div>
                    <h5 class="fw-bold">Complete Profile</h5>
                    <p class="text-muted small">Add business details, upload KYC docs, choose a plan.</p>
                </div>
                <div class="col-6 col-lg-3 text-center position-relative" style="z-index:1">
                    <div class="ss-step-num" style="background:#10b981;box-shadow:0 6px 20px rgba(16,185,129,.3)">4</div>
                    <h5 class="fw-bold">Start Getting Orders</h5>
                    <p class="text-muted small">Go live and connect with verified global buyers.</p>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('seller.register') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold" style="border-radius:10px">
                    Get Started Free →
                </a>
            </div>
        </div>
    </section>


    {{-- ════════════════════════════════════
         BENEFITS + PLANS (dark section)
    ════════════════════════════════════ --}}
    <section class="ss-benefits-bg py-6" id="benefits">
        <div class="container py-4">
            <div class="row g-5 align-items-start">

                <div class="col-lg-7">
                    <span class="badge fw-bold px-3 py-2 rounded-pill mb-3"
                        style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.85)">Why GlobPulse</span>
                    <h2 class="fw-bold text-white mb-2" style="font-size:36px">
                        Everything you need to grow your exports
                    </h2>
                    <p class="mb-4" style="color:rgba(255,255,255,.6)">
                        Built for manufacturers, wholesalers and exporters who want to reach international buyers at scale.
                    </p>
                    <div class="ss-bitem">
                        <div class="ss-bicon">🎯</div>
                        <div><h6 class="text-white fw-bold mb-1">AI Buyer Matching</h6><p class="mb-0 small" style="color:rgba(255,255,255,.55)">Connects you with buyers actively searching for your products.</p></div>
                    </div>
                    <div class="ss-bitem">
                        <div class="ss-bicon">📊</div>
                        <div><h6 class="text-white fw-bold mb-1">Real-Time Analytics</h6><p class="mb-0 small" style="color:rgba(255,255,255,.55)">Track views, inquiries and buyer engagement from your dashboard.</p></div>
                    </div>
                    <div class="ss-bitem">
                        <div class="ss-bicon">🏅</div>
                        <div><h6 class="text-white fw-bold mb-1">Verified Seller Badge</h6><p class="mb-0 small" style="color:rgba(255,255,255,.55)">KYC-verified badge builds buyer trust and boosts inquiry rates.</p></div>
                    </div>
                    <div class="ss-bitem">
                        <div class="ss-bicon">💬</div>
                        <div><h6 class="text-white fw-bold mb-1">Direct RFQ System</h6><p class="mb-0 small" style="color:rgba(255,255,255,.55)">Buyers send RFQs directly. No middleman, no commission.</p></div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <span class="badge fw-bold px-3 py-2 rounded-pill mb-3 d-inline-block"
                        style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.85)">Pricing Plans</span>

                    <div class="ss-plan">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-white fs-5">Free</span>
                            <span class="fw-bold text-white fs-4">$0 <small class="fw-normal" style="color:rgba(255,255,255,.5);font-size:13px">/forever</small></span>
                        </div>
                        <div><span class="ss-feat">10 Products</span><span class="ss-feat">Buyer Inquiries</span><span class="ss-feat">Basic Profile</span></div>
                    </div>

                    <div class="ss-plan hot">
                        <div class="ss-plan-badge">Most Popular</div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-white fs-5">Growth</span>
                            <span class="fw-bold text-white fs-4">$49 <small class="fw-normal" style="color:rgba(255,255,255,.5);font-size:13px">/mo</small></span>
                        </div>
                        <div><span class="ss-feat">100 Products</span><span class="ss-feat">Verified Badge</span><span class="ss-feat">RFQ Priority</span><span class="ss-feat">Analytics</span></div>
                    </div>

                    <div class="ss-plan">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-white fs-5">Global</span>
                            <span class="fw-bold text-white fs-4">$199 <small class="fw-normal" style="color:rgba(255,255,255,.5);font-size:13px">/mo</small></span>
                        </div>
                        <div><span class="ss-feat">Unlimited Products</span><span class="ss-feat">AI Matching</span><span class="ss-feat">Global Promo</span><span class="ss-feat">Premium Badge</span></div>
                    </div>

                    <a href="{{ route('seller.register') }}"
                        class="btn btn-warning w-100 py-3 fw-bold mt-2 text-dark" style="border-radius:10px;font-size:15px">
                        Start Free — Upgrade Anytime →
                    </a>
                </div>

            </div>
        </div>
    </section>


    {{-- ════════════════════════════════════
         TESTIMONIALS
    ════════════════════════════════════ --}}
    <section class="py-6 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 rounded-pill mb-3">Success Stories</span>
                <h2 class="fw-bold fs-2">Sellers love GlobPulse</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="ss-tc">
                        <div class="text-warning mb-3" style="letter-spacing:2px">★★★★★</div>
                        <p class="text-secondary fst-italic small mb-4">
                            "Within 3 months we had buyers from Germany, UAE and Australia. The verified badge made a huge difference in trust."
                        </p>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                style="width:40px;height:40px;background:#2563eb">RK</div>
                            <div>
                                <div class="fw-bold small">Rajesh Kumar</div>
                                <div class="text-muted" style="font-size:11px">Auto Parts Exporter, India</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ss-tc">
                        <div class="text-warning mb-3" style="letter-spacing:2px">★★★★★</div>
                        <p class="text-secondary fst-italic small mb-4">
                            "The RFQ system brings qualified inquiries daily. Export revenue grew 40% in the first year on GlobPulse."
                        </p>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                style="width:40px;height:40px;background:#059669">LC</div>
                            <div>
                                <div class="fw-bold small">Li Chen</div>
                                <div class="text-muted" style="font-size:11px">Electronics Manufacturer, China</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ss-tc">
                        <div class="text-warning mb-3" style="letter-spacing:2px">★★★★★</div>
                        <p class="text-secondary fst-italic small mb-4">
                            "Registration was incredibly smooth. Approved and live within 24 hours. The AI buyer matching is genuinely impressive."
                        </p>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                style="width:40px;height:40px;background:#b45309">AM</div>
                            <div>
                                <div class="fw-bold small">Ahmed Al-Mansouri</div>
                                <div class="text-muted" style="font-size:11px">Textile Wholesaler, UAE</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ════════════════════════════════════
         BOTTOM CTA
    ════════════════════════════════════ --}}
    <section class="ss-cta-bg py-6 text-center">
        <div class="container py-4 position-relative" style="z-index:1">
            <h2 class="fw-bold text-white mb-3" style="font-size:40px">Ready to go global?</h2>
            <p style="color:rgba(255,255,255,.72);font-size:17px;max-width:520px;margin:0 auto 32px">
                Join 50,000+ sellers already growing their business on GlobPulse. Free to start.
            </p>
            <a href="{{ route('seller.register') }}"
                class="btn btn-warning btn-lg px-5 py-3 fw-bold text-dark" style="font-size:16px;border-radius:10px">
                Become a Seller — It's Free →
            </a>
        </div>
    </section>


    {{-- YOUR EXISTING FOOTER — unchanged --}}
    <livewire:front.layout.footer />
</div>