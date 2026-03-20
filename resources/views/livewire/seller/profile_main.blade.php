<div>

    <main class="main" id="top">

        <livewire:seller.layout.header />

        <div class="container-fluid">

            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="pt-5 pb-9">

                <div class="">

                    <div class="row align-items-center justify-content-between g-3 mb-4">
                        <div class="col-auto">
                            <h2 class="mb-0">My Profile</h2>
                        </div>
                        <div class="col-auto">
                            <div class="row g-2 g-sm-3">
                                <div class="col-auto">
                                    <a href="{{route('primary_details')}}"><button class="btn btn-primary"><span
                                                class="far fa-edit me-2"></span>Edit
                                            Profile</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-6">
                        <div class="col-12 col-lg-8">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="border-bottom border-dashed pb-4">
                                        <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                            <div class="col-12 col-sm-auto">
                                                <input class="d-none" id="avatarFile" type="file" />
                                                <label class="cursor-pointer avatar avatar-5xl" for="avatarFile"><img
                                                        class="rounded-circle"
                                                        src="{{asset('storage/' . $customer->profile_image)}}"
                                                        alt="" /></label>
                                            </div>
                                            <div class="col-12 col-sm-auto flex-1">
                                                <h3>{{ $customer->company }}</h3>
                                                <div
                                                    class="d-flex flex-wrap align-items-center mb-2 justify-content-center justify-content-md-start">

                                                    <i class="fas fa-external-link-alt me-2"></i>


                                                    <a target="_blanck"
                                                        href="{{ $customer->web_url }}">{{ $customer->web_url }}</a>
                                                </div>


                                                {{-- <span class="small fw-bold text-success ms-1">
                                                    @if (!empty($country->flag_img) && file_exists(public_path('assets/'
                                                    . $country->flag_img)))
                                                    <img class="flag" loading="lazy"
                                                        src="{{ asset('assets/' . $country->flag_img) }}"
                                                        alt="{{ $country->country ?? 'Product Image' }}" />
                                                    @else
                                                    <img class="img-fluid transition rounded-1" loading="lazy"
                                                        src="{{ asset('assets/img/no-image.png') }}"
                                                        alt="No Image Available" />
                                                    @endif
                                                    {{ $country->iso2 ?? 'N/A' }}
                                                </span> --}}

                                                <style>
                                                    .social-icons a {
                                                        display: inline-flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        width: 40px;
                                                        height: 40px;
                                                        margin-right: 10px;
                                                        border-radius: 50%;
                                                        background-color: #f0f0f0;
                                                        color: #555;
                                                        transition: all 0.3s ease;
                                                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                                                    }

                                                    .social-icons a:hover {
                                                        background-color: #0d6efd;
                                                        color: #fff;
                                                        transform: scale(1.1);
                                                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                                                    }

                                                    .social-icons a .fab {
                                                        font-size: 22px;
                                                    }
                                                </style>

                                                <div
                                                    class="social-icons d-flex mt-2 justify-content-center justify-content-md-start">
                                                    <a href="{{ $customer->instagram }}" target="_blank"
                                                        aria-label="Instagram">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                    <a href="{{ $customer->twitter }}" target="_blank"
                                                        aria-label="Twitter">
                                                        <span class="fab fa-twitter"></span>
                                                    </a>
                                                    <a href="{{ $customer->facebook }}" target="_blank"
                                                        aria-label="Facebook">
                                                        <span class="fab fa-facebook"></span>
                                                    </a>
                                                    <a href="{{ $customer->linkedin }}" target="_blank"
                                                        aria-label="LinkedIn">
                                                        <span class="fab fa-linkedin"></span>
                                                    </a>
                                                </div>




                                            </div>
                                        </div>
                                    </div>

                                    <div class="row text-start gy-4 mt-2 ">
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-building text-danger fs-6 me-3"></i>
                                                <p class="mb-0 fs-9"><strong class="fs-8">Business Type:</strong> <br>
                                                    {{ optional($customer->products->first())->business_type ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-building text-danger fs-6 me-3"></i>
                                                <p class="mb-0 fs-9"><strong class="fs-8">GST No:</strong><br>
                                                    {{ $customer->gst_no ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-users text-danger fs-6 me-3"></i>

                                                <p class="mb-0 fs-9"><strong class="fs-8">Employee Count:</strong><br>
                                                    {{ $customer->employee_count ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-calendar-alt text-danger fs-6 me-3"></i>
                                                <p class="mb-0 fs-9"><strong class="fs-8">Establishment:</strong><br>
                                                    {{ $customer->company_establish_date ? \Carbon\Carbon::parse($customer->company_establish_date)->format('d M Y') : 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-coins text-danger fs-6 me-3"></i>
                                                <p class="mb-0 fs-9"><strong class="fs-8">Annual Turnover:</strong><br>
                                                    {{ $customer->annual_turnoer ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-calendar-check text-danger fs-6 me-3"></i>
                                                <p class="mb-0 fs-9"><strong class="fs-8">Working Days:</strong>
                                                    <br>{{ $customer->working_day ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                class="d-flex align-items-center bg-light shadow-sm p-2 px-3 rounded h-100">
                                                <i class="fas fa-credit-card text-danger fs-6 me-3"></i>
                                                <p class="mb-0 fs-9"><strong class="fs-8">Payment Mode:</strong><br>
                                                    {{ $customer->payment_mode ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    {{-- <div class="border-bottom border-dashed">
                                        <h4 class="mb-3">Default Address
                                            <button class="btn btn-link p-0" type="button"> <span
                                                    class="fas fa-edit fs-9 ms-3 text-body-quaternary"></span></button>
                                        </h4>
                                    </div> --}}
                                    <div class="mb-3  border-bottom border-dashed">
                                        {{-- <div class="row justify-content-between"> --}}
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight">Address</h5>
                                            </div>
                                            <div class="col-auto">
                                                <p class="text-body-secondary">{{ $customer->address }}
                                                </p>
                                            </div>
                                            {{--
                                        </div> --}}
                                    </div>
                                    <div class=" pt-2">

                                        <div class="row flex-between-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">Full Name</h5>
                                            </div>
                                            <div class="col-auto"><a class="lh-1"
                                                    href="mailto:{{ $customer->name }}">{{ $customer->name }}</a>
                                            </div>
                                        </div>

                                        <div class="row flex-between-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">Mobile Number</h5>
                                            </div>
                                            <div class="col-auto"><a
                                                    href="tel:{{ $customer->phonenumber }}">{{ $customer->phonenumber }}</a>
                                            </div>
                                        </div>

                                        <div class="row flex-between-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">Email Id</h5>
                                            </div>
                                            <div class="col-auto"><a class="lh-1"
                                                    href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
                                            </div>
                                        </div>
                                        <div class="row flex-between-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">City</h5>
                                            </div>
                                            <div class="col-auto"><a class="lh-1"
                                                    href="mailto:{{ $customer->city }}">{{ $customer->city }}</a>
                                            </div>
                                        </div>
                                        <div class="row flex-between-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">Country</h5>
                                            </div>
                                            {{-- <div class="col-auto"><a class="lh-1"
                                                    href="mailto:{{ $customer->country }}">{{ $customer->country }}</a>
                                            </div> --}}
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->


            {{-- <div class="support-chat-container">
                <div class="container-fluid support-chat">
                    <div class="card bg-body-emphasis">
                        <div class="card-header d-flex flex-between-center px-4 py-3 border-bottom border-translucent">
                            <h5 class="mb-0 d-flex align-items-center gap-2">Demo widget<span
                                    class="fa-solid fa-circle text-success fs-11"></span></h5>
                            <div class="btn-reveal-trigger">
                                <button
                                    class="btn btn-link p-0 dropdown-toggle dropdown-caret-none transition-none d-flex"
                                    type="button" id="support-chat-dropdown" data-bs-toggle="dropdown"
                                    data-boundary="window" aria-haspopup="true" aria-expanded="false"
                                    data-bs-reference="parent"><span
                                        class="fas fa-ellipsis-h text-body"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"
                                    aria-labelledby="support-chat-dropdown"><a class="dropdown-item" href="#!">Request a
                                        callback</a><a class="dropdown-item" href="#!">Search in chat</a><a
                                        class="dropdown-item" href="#!">Show history</a><a class="dropdown-item"
                                        href="#!">Report to Admin</a><a class="dropdown-item btn-support-chat"
                                        href="#!">Close Support</a></div>
                            </div>
                        </div>
                        <div class="card-body chat p-0">
                            <div class="d-flex flex-column-reverse scrollbar h-100 p-3">
                                <div class="text-end mt-6"><a
                                        class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                        href="#!">
                                        <p class="mb-0 fw-semibold fs-9">I need help with something</p><span
                                            class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                                    </a><a
                                        class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                        href="#!">
                                        <p class="mb-0 fw-semibold fs-9">I can’t reorder a product I previously
                                            ordered</p><span
                                            class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                                    </a><a
                                        class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                        href="#!">
                                        <p class="mb-0 fw-semibold fs-9">How do I place an order?</p><span
                                            class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                                    </a><a
                                        class="false d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                        href="#!">
                                        <p class="mb-0 fw-semibold fs-9">My payment method not working</p><span
                                            class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                                    </a>
                                </div>
                                <div class="text-center mt-auto">
                                    <div class="avatar avatar-3xl status-online"><img
                                            class="rounded-circle border border-3 border-light-subtle"
                                            src="../../../assets/img/team/30.webp" alt="" /></div>
                                    <h5 class="mt-2 mb-3">Eric</h5>
                                    <p class="text-center text-body-emphasis mb-0">Ask us anything – we’ll get back to
                                        you here or by email within 24 hours.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="card-footer d-flex align-items-center gap-2 border-top border-translucent ps-3 pe-4 py-3">
                            <div
                                class="d-flex align-items-center flex-1 gap-3 border border-translucent rounded-pill px-4">
                                <input class="form-control outline-none border-0 flex-1 fs-9 px-0" type="text"
                                    placeholder="Write message" />
                                <label class="btn btn-link d-flex p-0 text-body-quaternary fs-9 border-0"
                                    for="supportChatPhotos"><span class="fa-solid fa-image"></span></label>
                                <input class="d-none" type="file" accept="image/*" id="supportChatPhotos" />
                                <label class="btn btn-link d-flex p-0 text-body-quaternary fs-9 border-0"
                                    for="supportChatAttachment"> <span class="fa-solid fa-paperclip"></span></label>
                                <input class="d-none" type="file" id="supportChatAttachment" />
                            </div>
                            <button class="btn p-0 border-0 send-btn"><span
                                    class="fa-solid fa-paper-plane fs-9"></span></button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-support-chat p-0 border border-translucent"><span
                        class="fs-8 btn-text text-primary text-nowrap">Chat demo</span><span
                        class="ping-icon-wrapper mt-n4 ms-n6 mt-sm-0 ms-sm-2 position-absolute position-sm-relative"><span
                            class="ping-icon-bg"></span><span class="fa-solid fa-circle ping-icon"></span></span><span
                        class="fa-solid fa-headset text-primary fs-8 d-sm-none"></span><span
                        class="fa-solid fa-chevron-down text-primary fs-7"></span></button>
            </div> --}}


            <!-- ============================================-->
            <!-- <section> begin ============================-->

            <!-- <section> close ============================-->
            <!-- ============================================-->
        </div>
        <livewire:seller.layout.footer />
    </main>

</div>