<div>

    @php
        $logoUrl    = $seller?->details?->logo_url;
        $bname      = $seller?->details?->legal_business_name ?? session('seller_name') ?? 'S';
        $initials   = strtoupper(implode('', array_map(
            fn($w) => $w[0],
            array_slice(explode(' ', trim($bname)), 0, 2)
        )));
        // ── Seller account status check ───────────────────────────────────────
        $sellerStatus = $sellerStatus ?? $seller?->status ?? 'pending';
        $isRejected   = $sellerStatus === 'rejected';
        $isLocked     = $isLocked ?? ($sellerStatus !== 'approved');
    @endphp

    {{-- ═══════════════════════════════════════════════════════
         ACCOUNT STATUS BANNER — shown for any non-approved status
    ═══════════════════════════════════════════════════════ --}}
    @if($sellerStatus === 'rejected')
    <div style="background:#991b1b;color:#fff;text-align:center;padding:10px 20px;font-size:.84rem;
                font-weight:700;letter-spacing:.01em;display:flex;align-items:center;
                justify-content:center;gap:10px;z-index:9999;position:relative;">
        <i class="bi bi-slash-circle-fill" style="font-size:1rem;"></i>
        Your seller account has been <u>rejected</u>. All features are locked.
        Please update your Business Profile and contact support.
        <a href="{{ route('primary_details') }}"
           style="color:#fca5a5;text-decoration:underline;margin-left:6px;">Edit Profile →</a>
    </div>

    @elseif($sellerStatus === 'suspended')
    <div style="background:#4b5563;color:#fff;text-align:center;padding:10px 20px;font-size:.84rem;
                font-weight:700;letter-spacing:.01em;display:flex;align-items:center;
                justify-content:center;gap:10px;z-index:9999;position:relative;">
        <i class="bi bi-slash-circle" style="font-size:1rem;"></i>
        Your seller account has been <u>suspended</u>. All features are locked. Please contact support.
    </div>

    @elseif($sellerStatus === 'under_review')
    <div style="background:#1e40af;color:#fff;text-align:center;padding:10px 20px;font-size:.84rem;
                font-weight:700;letter-spacing:.01em;display:flex;align-items:center;
                justify-content:center;gap:10px;z-index:9999;position:relative;">
        <i class="bi bi-hourglass-split" style="font-size:1rem;"></i>
        Your account is <u>under review</u>. Products, services &amp; dashboard are locked until admin approves.
        Review takes 24–48 hrs. You may still edit your
        <a href="{{ route('primary_details') }}"
           style="color:#bfdbfe;text-decoration:underline;margin-left:4px;">Business Profile →</a>
    </div>

    @elseif($sellerStatus === 'pending')
    <div style="background:#b45309;color:#fff;text-align:center;padding:10px 20px;font-size:.84rem;
                font-weight:700;letter-spacing:.01em;display:flex;align-items:center;
                justify-content:center;gap:10px;z-index:9999;position:relative;">
        <i class="bi bi-exclamation-triangle-fill" style="font-size:1rem;"></i>
        Your account is <u>pending</u> — please complete your profile and submit for review.
        Products, services &amp; dashboard are locked until approval.
        <a href="{{ route('primary_details') }}"
           style="color:#fde68a;text-decoration:underline;margin-left:6px;">Complete Profile →</a>
    </div>
    @endif

    <nav class="navbar navbar-top navbar-expand-lg" id="dualNav">
        <div class="w-100">
            <div class="d-flex flex-between-center align-items-center dual-nav-first-layer">
                <div class="navbar-logo">
                    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
                        aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="{{ route('home') }}">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <img class="w-100 w-sm-75" src="../../../assets/img/logos/GFEPLUSE.png" alt="GFEPLUSE" />
                            </div>
                        </div>
                    </a>
                </div>

                <ul class="navbar-nav navbar-nav-icons flex-row">

                    {{-- Notification bell — disabled when rejected --}}
                    <li class="nav-item dropdown me-2">
                        @if($isLocked)
                            <span style="width:43px;height:43px;border-radius:50%;background:#f1f5f9;
                                         display:flex;align-items:center;justify-content:center;
                                         opacity:.35;cursor:not-allowed;"
                                  title="Account rejected — notifications disabled">
                                <i class="fa-regular fa-bell text-muted" style="font-size:23px;"></i>
                            </span>
                        @else
                            <a class="nav-link position-relative d-flex align-items-center justify-content-center"
                                href="{{ route('seller-notification-list') }}"
                                style="width:43px;height:43px;border-radius:50%;background-color:#ffffff;">
                                <i class="fa-regular fa-bell text-dark" style="font-size:23px;"></i>
                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-circle"
                                        style="font-size:10px;min-width:18px;height:18px;padding:4px;">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    </li>

                    {{-- Support icon — always visible --}}
                    <li class="nav-item dropdown align-content-center">
                        <a class="nav-link d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                            id="navbarDropdownHelp" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Support & Help"
                            style="width:46px;height:46px;background-color:#ffffff;">
                            <img class="w-100" src="../../../assets/img/seller-dashboard-icons/supo-2.png" alt="help-desk" />
                        </a>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-nine-dots"
                            aria-labelledby="navbarDropdownNindeDots">
                            <div class="position-relative border-0">
                                <div class="card-body py-2 px-2">
                                    <div class="row text-center align-items-center gx-2 gy-2">
                                        <div class="col-4">
                                            <div class="bg-body-secondary-hover p-2 rounded-3 cursor-pointer text-center border"
                                                data-bs-toggle="modal" data-bs-target="#whatsappSupportModal" title="WhatsApp Support">
                                                <div class="rounded-circle p-2">
                                                    <i class="fab fa-whatsapp text-success fs-6"></i>
                                                </div>
                                                <div class="small">WhatsApp</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="bg-body-secondary-hover p-2 rounded-3 cursor-pointer bg-white text-center border"
                                                data-bs-toggle="modal" data-bs-target="#callSupportModal" title="Call Support">
                                                <div class="rounded-circle p-2 border-0">
                                                    <i class="fas fa-phone-square text-primary fs-6"></i>
                                                </div>
                                                <div class="small">Call</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="bg-body-secondary-hover p-2 rounded-3 cursor-pointer bg-white text-center border"
                                                data-bs-toggle="modal" data-bs-target="#emailSupportModal" title="Email Support">
                                                <div class="rounded-circle p-2 border-0">
                                                    <i class="fas fa-envelope text-danger fs-6"></i>
                                                </div>
                                                <div class="small">Email</div>
                                            </div>
                                        </div>
                                        @if(false)
                                            <div class="col-4">
                                                <div class="bg-body-secondary-hover p-2 rounded-3 cursor-pointer text-center bg-white border"
                                                    data-bs-toggle="modal" data-bs-target="#ticketSupportModal" title="Ticket Support">
                                                    <div class="rounded-circle p-2 border-0">
                                                        <i class="fas fa-ticket text-warning fs-6"></i>
                                                    </div>
                                                    <div class="small">Ticket</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- ══ AVATAR DROPDOWN ══ --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!"
                            role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-l">
                                @if($logoUrl)
                                    <img class="rounded-circle w-100"
                                        src="{{ asset('storage/' . $logoUrl) }}"
                                        alt="Logo"
                                        style="object-fit:contain;background:#fff;padding:2px;">
                                @else
                                    <div style="width:100%;height:100%;border-radius:50%;
                                        background:linear-gradient(135deg,#1a56db,#0e9f6e);
                                        display:flex;align-items:center;justify-content:center;
                                        color:#fff;font-size:.85rem;font-weight:800;letter-spacing:1px;">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border"
                            aria-labelledby="navbarDropdownUser">
                            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                                <div class="card-body p-4 text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="avatar avatar-xl rounded-circle border border-2 border-primary overflow-hidden">
                                            @if($logoUrl)
                                                <img class="w-100 h-100"
                                                    src="{{ asset('storage/' . $logoUrl) }}"
                                                    alt="Logo"
                                                    style="object-fit:contain;background:#fff;padding:4px;">
                                            @else
                                                <div style="width:100%;height:100%;
                                                    background:linear-gradient(135deg,#1a56db,#0e9f6e);
                                                    display:flex;align-items:center;justify-content:center;
                                                    color:#fff;font-size:1.4rem;font-weight:800;letter-spacing:1px;">
                                                    {{ $initials }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="mt-3 fw-semibold text-dark">
                                        {{ $seller?->details?->legal_business_name ?? session('seller_name') }}
                                    </h6>
                                    @if($isLocked)
                                        @php
                                            $badgeMap = [
                                                'pending'      => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => '⏳', 'label' => 'Pending Submission'],
                                                'under_review' => ['bg' => '#dbeafe', 'color' => '#1e40af', 'icon' => '🔍', 'label' => 'Under Review'],
                                                'rejected'     => ['bg' => '#fee2e2', 'color' => '#991b1b', 'icon' => '❌', 'label' => 'Account Rejected'],
                                                'suspended'    => ['bg' => '#f1f5f9', 'color' => '#4b5563', 'icon' => '🚫', 'label' => 'Account Suspended'],
                                            ];
                                            $badge = $badgeMap[$sellerStatus] ?? $badgeMap['pending'];
                                        @endphp
                                        <span style="font-size:.7rem;font-weight:700;background:{{ $badge['bg'] }};color:{{ $badge['color'] }};
                                                     padding:2px 10px;border-radius:20px;display:inline-block;margin-top:4px;">
                                            {{ $badge['icon'] }} {{ $badge['label'] }}
                                        </span>
                                    @endif
                                </div>
                                <div class="overflow-auto px-3" style="max-height:6rem;">
                                    <ul class="nav flex-column gap-2">
                                        {{-- Profile — always allowed --}}
                                        <li class="nav-item">
                                            <a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
                                                href="{{ route('seller.profile') }}">
                                                <i class="fas fa-user me-2"></i> Profile
                                            </a>
                                        </li>
                                        {{-- Dashboard — disabled when rejected --}}
                                        <li class="nav-item">
                                            @if($isLocked)
                                                <span class="nav-link py-2 px-3 rounded bg-light text-muted d-flex align-items-center gap-2"
                                                      style="opacity:.4;cursor:not-allowed;pointer-events:none;"
                                                      title="Account not yet approved — complete your profile and await admin approval">
                                                    <i class="fas fa-chart-line me-2"></i> Dashboard
                                                </span>
                                            @else
                                                <a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
                                                    href="{{ route('seller.dashboard') }}">
                                                    <i class="fas fa-chart-line me-2"></i> Dashboard
                                                </a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer border-0 bg-white p-4 text-center">
                                    <button class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2"
                                        wire:click="logout">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-light"></i> Sign out
                                    </button>
                                    <div class="mt-3 text-muted small d-flex justify-content-center gap-2 align-items-center">
                                        <span>&bull;</span>
                                        <a href="{{ route('term-conditions') }}" class="text-decoration-none text-secondary">Privacy Policy</a>
                                        <span>&bull;</span>
                                        <a href="{{ route('term-conditions') }}" class="text-decoration-none text-secondary">Terms</a>
                                        <span>&bull;</span>
                                        <a href="#!" class="text-decoration-none text-secondary">Cookies</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

            {{-- ══════════════════════════════════════════════════
                 MAIN NAV — collapsed section
            ══════════════════════════════════════════════════ --}}
            <div class="collapse navbar-collapse navbar-top-collapse justify-content-end" id="navbarTopCollapse">
                <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">

                    {{-- Home --}}
                    <li class="nav-item" data-nav-item="data-nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>

                    {{-- Dashboard — disabled when rejected --}}
                    <li class="nav-item" data-nav-item="data-nav-item">
                        @if($isLocked)
                            <span class="nav-link text-muted"
                                  style="opacity:.4;cursor:not-allowed;pointer-events:none;"
                                  title="Account not yet approved — complete your profile and await admin approval">
                                Dashboard
                            </span>
                        @else
                            <a class="nav-link active" href="{{ route('seller.dashboard') }}">Dashboard</a>
                        @endif
                    </li>

                    {{-- RFQs — disabled when rejected --}}
                    <li class="nav-item dropdown">
                        @if($isLocked)
                            <span class="nav-link text-muted"
                                  style="opacity:.4;cursor:not-allowed;pointer-events:none;"
                                  title="Account not yet approved — complete your profile and await admin approval">
                                📩 RFQs
                            </span>
                        @else
                            <a class="nav-link dropdown-toggle position-relative" href="#!" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                📩 RFQs
                                @if($rfqCount > 0)
                                    <span class="badge bg-primary ms-1" style="font-size:10px;">
                                        {{ $rfqCount > 10 ? '10+' : $rfqCount }}
                                    </span>
                                @endif
                                <i class="fa-solid fa-angle-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu navbar-dropdown-caret p-2" style="min-width:300px;">
                                <li class="px-2 py-1 fw-bold text-dark">Recent RFQs</li>
                                @forelse($recentRfqs as $rfq)
                                    <li>
                                        <a class="dropdown-item small py-2 border-bottom"
                                           href="{{ route('seller.rfq.view', $rfq->id) }}">
                                            <div class="fw-semibold">{{ $rfq->product->title ?? 'Product' }}</div>
                                            <div class="text-muted small">Qty: {{ $rfq->quantity }}</div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-center text-muted small py-3">No RFQs found</li>
                                @endforelse
                                <li class="mt-2 px-2">
                                    <a href="{{ route('seller.rfqs') }}" class="btn btn-sm btn-outline-primary w-100">
                                        View All RFQs
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>

                    {{-- Quotations — disabled when rejected --}}
                    <li class="nav-item dropdown">
                        @if($isLocked)
                            <span class="nav-link text-muted"
                                  style="opacity:.4;cursor:not-allowed;pointer-events:none;"
                                  title="Account not yet approved — complete your profile and await admin approval">
                                💰 Quotations
                            </span>
                        @else
                            <a class="nav-link dropdown-toggle position-relative" href="#!" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                💰 Quotations
                                @if($quotationCount > 0)
                                    <span class="badge bg-success ms-1" style="font-size:10px;">
                                        {{ $quotationCount > 10 ? '10+' : $quotationCount }}
                                    </span>
                                @endif
                                <i class="fa-solid fa-angle-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu navbar-dropdown-caret p-2" style="min-width:300px;">
                                <li class="px-2 py-1 fw-bold text-dark">Recent Quotations</li>
                                @forelse($recentQuotations as $quote)
                                    <li>
                                        <a class="dropdown-item small py-2 border-bottom"
                                           href="{{ route('seller.quotations') }}">
                                            <div class="fw-semibold">{{ $quote->rfq->product->title ?? 'Product' }}</div>
                                            <div class="text-muted small">₹ {{ number_format($quote->price) }}</div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-center text-muted small py-3">No quotations found</li>
                                @endforelse
                                <li class="mt-2 px-2">
                                    <a href="{{ route('seller.quotations') }}" class="btn btn-sm btn-outline-success w-100">
                                        View All Quotations
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>

                    {{-- Post Buy Requirements — disabled when rejected --}}
                    <li class="nav-item" data-nav-item="data-nav-item">
                        @if($isLocked)
                            <span class="nav-link text-muted"
                                  style="opacity:.4;cursor:not-allowed;pointer-events:none;"
                                  title="Account not yet approved — complete your profile and await admin approval">
                                Post Buy Requirements
                            </span>
                        @else
                            <a class="nav-link active" href="{{ route('postbyrequirement') }}">Post Buy Requirements</a>
                        @endif
                    </li>

                    {{-- Products — disabled when rejected --}}
                    <li class="nav-item dropdown">
                        @if($isLocked)
                            <span class="nav-link text-muted"
                                  style="opacity:.4;cursor:not-allowed;pointer-events:none;"
                                  title="Account not yet approved — complete your profile and await admin approval">
                                Products <i class="fa-solid fa-angle-down ms-2"></i>
                            </span>
                        @else
                            <a class="nav-link dropdown-toggle" href="#!" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                aria-haspopup="true" aria-expanded="false">
                                Products <i class="fa-solid fa-angle-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu navbar-dropdown-caret">
                                <li><a class="dropdown-item" href="{{ route('product_add') }}">
                                    <div class="dropdown-item-wrapper">Product Add</div></a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('service_add') }}">
                                    <div class="dropdown-item-wrapper">Service Add</div></a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('hotdealproductform') }}">
                                    <div class="dropdown-item-wrapper">Hot Deal Add</div></a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('my-listings') }}">
                                    <div class="dropdown-item-wrapper">My Products List</div></a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('slider-image') }}">
                                    <div class="dropdown-item-wrapper">Add Portfolio Banner</div></a>
                                </li>
                            </ul>
                        @endif
                    </li>

                    {{-- Business Profile — ALWAYS active (so seller can fix & resubmit) --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $isRejected ? 'fw-bold text-danger' : ($isLocked ? 'fw-bold text-warning' : '') }}"
                            href="#!" role="button" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"
                            title="{{ $isLocked ? 'Complete your profile to unlock seller features' : '' }}">
                            Business Profile
                            @if($isRejected)
                                <span class="badge bg-danger ms-1" style="font-size:9px;">Action Needed</span>
                            @elseif($sellerStatus === 'pending')
                                <span class="badge bg-warning text-dark ms-1" style="font-size:9px;">Incomplete</span>
                            @elseif($sellerStatus === 'under_review')
                                <span class="badge bg-primary ms-1" style="font-size:9px;">Under Review</span>
                            @elseif($sellerStatus === 'suspended')
                                <span class="badge bg-secondary ms-1" style="font-size:9px;">Suspended</span>
                            @endif
                            <i class="fa-solid fa-angle-down ms-2"></i>
                        </a>
                        <ul class="dropdown-menu navbar-dropdown-caret">
                            <li><a class="dropdown-item" href="{{ route('primary_details') }}">
                                <div class="dropdown-item-wrapper">
                                    Primary Details
                                    @if($isRejected)
                                        <span class="badge bg-danger ms-1" style="font-size:9px;">Update Required</span>
                                    @elseif($sellerStatus === 'pending')
                                        <span class="badge bg-warning text-dark ms-1" style="font-size:9px;">Complete</span>
                                    @endif
                                </div></a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('seller_active_package') }}">
                                <div class="dropdown-item-wrapper">Active Package</div></a>
                            </li>
                        </ul>
                    </li>

                    {{-- Website — only for approved sellers with project tasks --}}
                    @if($hasProjectTask && !$isLocked)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                aria-haspopup="true" aria-expanded="false">
                                Website <i class="fa-solid fa-angle-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu navbar-dropdown-caret">
                                <li><a class="dropdown-item" href="{{ route('logo') }}">
                                    <div class="dropdown-item-wrapper">Create Website</div></a>
                                </li>
                                <li><a class="dropdown-item" href="{{ config('api.web_base_url') }}/{{ $username }}" target="_blank">
                                    <div class="dropdown-item-wrapper">Go To Website</div></a>
                                </li>
                                <li><a class="dropdown-item" href="https://vcard.digiexpertpro.com/{{ $username }}" target="_blank">
                                    <div class="dropdown-item-wrapper">Brochure</div></a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>

                <!-- WhatsApp Modal -->
                <div class="modal fade" id="whatsappSupportModal" tabindex="-1"
                    aria-labelledby="whatsappSupportModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-3">
                            <div class="modal-header bg-success-dark text-white">
                                <h5 class="modal-title text-white d-flex align-items-center" id="whatsappSupportModalLabel">
                                    <i class="fab fa-whatsapp me-2 fs-5"></i> <span class="fs-8">WhatsApp Support</span>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-light">
                                <p class="fs-7 fw-semibold text-success-dark mb-1">{{ $whatsappNumber }}</p>
                                <small class="text-muted">Click "Chat on WhatsApp" to connect instantly</small>
                            </div>
                            <div class="modal-footer bg-light">
                                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="btn btn-success px-4 shadow-sm">
                                    <i class="fab fa-whatsapp me-2"></i> Chat on WhatsApp
                                </a>
                                <button class="btn btn-outline-secondary px-4" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call Modal -->
                <div class="modal fade" id="callSupportModal" tabindex="-1"
                    aria-labelledby="callSupportModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header text-white" style="background: linear-gradient(135deg, #007BFF, #0056b3);">
                                <h5 class="modal-title text-white d-flex align-items-center" id="callSupportModalLabel">
                                    <i class="fas fa-phone-alt me-2 fs-5"></i> Call Support
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-light">
                                <p class="fs-7 fw-semibold text-primary mb-1">{{ $contactNumber }}</p>
                                <small class="text-muted">Click "Call Now" to dial directly</small>
                            </div>
                            <div class="modal-footer bg-light">
                                <a href="tel:{{ $contactNumber }}" class="btn btn-primary px-4">
                                    <i class="fas fa-phone-alt me-2"></i> Call Now
                                </a>
                                <button class="btn btn-outline-secondary px-4" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Modal -->
                <div class="modal fade" id="emailSupportModal" tabindex="-1"
                    aria-labelledby="emailSupportModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header text-white" style="background: linear-gradient(135deg, #FF7F50, #FF4500);">
                                <h5 class="modal-title text-white d-flex align-items-center" id="emailSupportModalLabel">
                                    <i class="fas fa-envelope me-2 fs-5"></i> Email Support
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-light">
                                <p class="fs-7 fw-semibold text-dark mb-1">{{ $emailAddress }}</p>
                                <small class="text-muted">Click "Send Email" to compose an email</small>
                            </div>
                            <div class="modal-footer bg-light">
                                <a href="mailto:{{ $emailAddress }}" class="btn btn-warning px-4">
                                    <i class="fas fa-envelope me-2"></i> Send Email
                                </a>
                                <button class="btn btn-outline-secondary px-4" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ticket Modal -->
                <div class="modal fade" id="ticketSupportModal" tabindex="-1"
                    aria-labelledby="ticketSupportModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title text-white" id="ticketSupportModalLabel">
                                    Add Ticket
                                    @if($project_name)
                                        <span class="badge bg-light text-dark ms-2">{{ $project_name }}</span>
                                    @endif
                                </h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="ticketSave">
                                    <div class="mb-3">
                                        <label class="form-label">Select Project</label>
                                        <select class="form-select" wire:model.live="project_id">
                                            <option value="">-- Select Project --</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Task Title</label>
                                        <select class="form-select" wire:model="selectedTaskTitle">
                                            <option value="">-- Select Task --</option>
                                            @foreach($tasklist as $task)
                                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ticket Description</label>
                                        <textarea rows="3" class="form-control" placeholder="Add Question" wire:model="description"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-warning" data-bs-dismiss="modal" type="submit">Save Ticket</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    @if(session()->has('message'))
        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="alert">
            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

</div>