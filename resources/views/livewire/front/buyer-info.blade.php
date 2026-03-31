@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>{{ $buyer->company_name ?: $buyer->full_name }} | Buyer Profile</title>
    <meta name="description" content="Buyer contact details for {{ $buyer->company_name ?: $buyer->full_name }}.">
    <meta name="robots" content="index, follow">
@endpush

<div>
    <livewire:front.layout.header />

    <section class="pt-5 pb-9">
        <div class="container-fluid">
            <div class="row">

                {{-- LEFT SIDEBAR --}}
                <div class="col-lg-2 col-xxl-2 ps-2 ps-xxl-3">
                    <div class="phoenix-offcanvas-filter scrollbar phoenix-offcanvas phoenix-offcanvas-fixed rounded-3"
                         id="buyerInfoColumn"
                         style="top: 92px; background: #f8f9fa; padding: 20px;">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold text-dark">Buyer Info</h4>
                        </div>

                        {{-- Avatar --}}
                        <div class="text-center mb-3">
                            <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-2"
                                 style="width:72px;height:72px;font-size:26px;font-weight:700;color:#fff;">
                                {{ strtoupper(substr($buyer->company_name ?: $buyer->full_name, 0, 1)) }}
                            </div>
                            <h6 class="fw-bold text-dark mb-1">{{ $buyer->company_name ?: $buyer->full_name }}</h6>
                            @if($buyer->company_name && $buyer->full_name)
                                <p class="text-muted small mb-1">{{ $buyer->full_name }}</p>
                            @endif
                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                @if($buyer->is_active)
                                    <span class="badge bg-success">Active</span>
                                @endif
                                @if($buyer->email_verified)
                                    <span class="badge bg-primary">Verified</span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Location Quick View --}}
                        <div class="accordion" id="buyerSideAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-white shadow-none p-3 fs-9 fw-semibold"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseLocation" aria-expanded="true">
                                        Location
                                    </button>
                                </h2>
                                <div id="collapseLocation" class="accordion-collapse collapse show">
                                    <div class="accordion-body pt-0 pb-2">
                                        @if($buyer->city)
                                            <p class="small mb-1 text-muted">
                                                <i class="uil uil-map-marker text-primary me-1"></i>{{ $buyer->city }}
                                            </p>
                                        @endif
                                        @if($buyer->state)
                                            <p class="small mb-1 text-muted">
                                                <i class="uil uil-map text-primary me-1"></i>{{ $buyer->state }}
                                            </p>
                                        @endif
                                        @if($buyer->country)
                                            <p class="small mb-0 text-muted">
                                                <i class="uil uil-globe text-primary me-1"></i>{{ $buyer->country }}
                                            </p>
                                        @endif
                                        @if(!$buyer->city && !$buyer->state && !$buyer->country)
                                            <p class="small text-muted mb-0">Not specified</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-white shadow-none p-3 fs-9 fw-semibold collapsed"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseMember" aria-expanded="false">
                                        Member Since
                                    </button>
                                </h2>
                                <div id="collapseMember" class="accordion-collapse collapse">
                                    <div class="accordion-body pt-0 pb-2">
                                        <p class="small mb-0 text-muted">
                                            <i class="uil uil-calendar-alt text-primary me-1"></i>
                                            {{ \Carbon\Carbon::parse($buyer->created_at)->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="phoenix-offcanvas-backdrop d-lg-none" data-phoenix-backdrop style="top: 92px"></div>
                </div>

                {{-- MAIN CONTENT --}}
                <div class="col-lg-10 col-xxl-10">

                    <style>
                        .info-card {
                            background: #fff;
                            border-radius: 12px;
                            box-shadow: 0 2px 12px rgba(0,0,0,.06);
                            padding: 24px;
                            margin-bottom: 20px;
                        }
                        .info-card h5 {
                            font-size: 15px;
                            font-weight: 700;
                            color: #0d1a94;
                            border-bottom: 2px solid #f0f0f0;
                            padding-bottom: 10px;
                            margin-bottom: 18px;
                        }
                        .info-row {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 20px;
                        }
                        .info-item {
                            flex: 1 1 200px;
                        }
                        .info-item .label {
                            font-size: 11px;
                            text-transform: uppercase;
                            letter-spacing: .8px;
                            color: #aaa;
                            font-weight: 600;
                            margin-bottom: 4px;
                        }
                        .info-item .value {
                            font-size: 14px;
                            font-weight: 500;
                            color: #222;
                        }
                        .info-item .value a {
                            color: #0d1a94;
                            text-decoration: none;
                        }
                        .info-item .value a:hover {
                            text-decoration: underline;
                        }
                    </style>

                    {{-- HERO BANNER --}}
                    <div class="mb-4 rounded-3 p-4"
                         style="background: linear-gradient(135deg, #0d1a94 0%, #1a2fb5 100%); color: #fff;">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:70px;height:70px;font-size:26px;font-weight:700;color:#0d1a94;">
                                {{ strtoupper(substr($buyer->company_name ?: $buyer->full_name, 0, 1)) }}
                            </div>
                            <div>
                                <h2 class="mb-1 fw-bold" style="color:#fff;font-size:22px;">
                                    {{ $buyer->company_name ?: $buyer->full_name }}
                                </h2>
                                @if($buyer->company_name && $buyer->full_name)
                                    <p class="mb-1" style="opacity:.85;font-size:14px;">
                                        Contact: {{ $buyer->full_name }}
                                    </p>
                                @endif
                                <div class="d-flex gap-2 flex-wrap align-items-center">
                                    @if($buyer->country)
                                        <span style="background:rgba(255,255,255,.15);padding:3px 10px;border-radius:20px;font-size:12px;">
                                            🌍 {{ $buyer->country }}
                                        </span>
                                    @endif
                                    @if($buyer->is_active)
                                        <span style="background:#22c55e;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                                            ✓ Active Buyer
                                        </span>
                                    @endif
                                    @if($buyer->email_verified)
                                        <span style="background:rgba(255,255,255,.15);padding:3px 10px;border-radius:20px;font-size:12px;">
                                            ✉️ Email Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CONTACT DETAILS --}}
                    <div class="info-card">
                        <h5><i class="uil uil-phone me-2"></i>Contact Details</h5>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="label">Full Name</div>
                                <div class="value">{{ $buyer->full_name ?: '—' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">Company Name</div>
                                <div class="value">{{ $buyer->company_name ?: '—' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">Email Address</div>
                                <div class="value">
                                    @if($buyer->email)
                                        <a href="mailto:{{ $buyer->email }}">{{ $buyer->email }}</a>
                                    @else —
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Phone</div>
                                <div class="value">
                                    @if($buyer->phone)
                                        <a href="tel:{{ $buyer->country_code }}{{ $buyer->phone }}">
                                            {{ $buyer->country_code }} {{ $buyer->phone }}
                                        </a>
                                    @else —
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LOCATION --}}
                    <div class="info-card">
                        <h5><i class="uil uil-map-marker me-2"></i>Location</h5>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="label">City</div>
                                <div class="value">{{ $buyer->city ?: '—' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">State</div>
                                <div class="value">{{ $buyer->state ?: '—' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">Country</div>
                                <div class="value">{{ $buyer->country ?: '—' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- BUYING PREFERENCES --}}
                    <div class="info-card">
                        <h5><i class="uil uil-shopping-cart me-2"></i>Buying Preferences</h5>
                        <div class="info-row">
                            <div class="info-item" style="flex: 1 1 100%;">
                                <div class="label">Interested Products</div>
                                <div class="value mt-1">
                                    @if($buyer->interested_products)
                                        @foreach(explode(',', $buyer->interested_products) as $tag)
                                            <span class="badge bg-light text-dark border me-1 mb-1"
                                                  style="font-size:12px;font-weight:500;padding:5px 10px;">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    @else
                                        —
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Import Volume</div>
                                <div class="value">{{ $buyer->import_volume ?: '—' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">Member Since</div>
                                <div class="value">
                                    {{ \Carbon\Carbon::parse($buyer->created_at)->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Last Active</div>
                                <div class="value">
                                    {{ $buyer->last_login_at
                                        ? \Carbon\Carbon::parse($buyer->last_login_at)->format('M d, Y')
                                        : '—' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ACCOUNT STATUS --}}
                    <div class="info-card">
                        <h5><i class="uil uil-shield-check me-2"></i>Account Status</h5>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="label">Account Status</div>
                                <div class="value">
                                    @if($buyer->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Email Verified</div>
                                <div class="value">
                                    @if($buyer->email_verified)
                                        <span class="badge bg-primary">Verified</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Not Verified</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Registered On</div>
                                <div class="value">
                                    {{ \Carbon\Carbon::parse($buyer->created_at)->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- END MAIN CONTENT --}}

            </div>
        </div>
    </section>

    <livewire:front.layout.footer />
</div>