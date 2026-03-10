<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content">

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Reviews</h2>
                </div>
                <!-- <div class="col-auto">
                        <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="button">Discard</button>
                        <button class="btn btn-phoenix-primary me-2 mb-2 mb-sm-0" type="button">Save draft</button>
                        <button class="btn btn-primary mb-2 mb-sm-0" wire:click="generateSlug" type="submit">Publish
                            product</button>
                    </div> -->
            </div>


            <!-- <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="gender">Gender</label>
                                        <select class="form-select" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="non-binary">Non-binary</option>
                                            <option value="not-to-say">Prefer not to say</option>
                                        </select>
                                    </div> -->



            <div class="table-responsive scrollbar">
                <table class="table fs-9 mb-0">
                    <thead>
                        <tr>
                            <th class="sort white-space-nowrap align-middle" scope="col"
                                style="min-width:220px;" data-sort="product">PRODUCT</th>
                            <th class="sort align-middle" scope="col" data-sort="rating"
                                style="max-width:10%;">RATING</th>
                            <th class="sort align-middle" scope="col"
                                style="min-width:480px" data-sort="review">REVIEW</th>
                            <th class="sort align-middle" scope="col"
                                style="max-width:12%;" data-sort="status">STATUS</th>
                            <th class="sort text-end align-middle" scope="col"
                                style="max-width:10%;" data-sort="date">DATE</th>
                            <th class="sort text-end pe-0 align-middle" scope="col"
                                style="width: 7%"> </th>
                        </tr>
                    </thead>
                    <tbody class="list" id="profile-review-table-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">Fitbit
                                    Sense Advanced Smartwatch with Tools for Heart Health,
                                    Stress Management &amp; Skin Temperature Trends,
                                    Carbon/Graphite, One Size (S &amp; L Bands)</a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa-regular fa-star text-warning-light"
                                    data-bs-theme="light"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    This Fitbit is fantastic! I was trying to be in better shape
                                    and needed some motivation, so I decided to treat myself to
                                    a new Fitbit.</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-success">Approaved<span
                                        class="ms-1" data-feather="check"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Just now</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">iPhone
                                    13 pro max-Pacific Blue-128GB storage</a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa-regular fa-star text-warning-light"
                                    data-bs-theme="light"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    The order was delivered ahead of schedule. To give us
                                    additional time, you should leave the packaging sealed with
                                    plastic.</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-warning">Pending<span
                                        class="ms-1" data-feather="clock"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Dec 9, 2:28 PM</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">Apple
                                    MacBook Pro 13 inch-M1-8/256GB-space</a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star-half-alt star-icon text-warning"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    It's a Mac, after all. Once you've gone Mac, there's no
                                    going back. My first Mac lasted over nine years, and this is
                                    my second.</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-success">Approaved<span
                                        class="ms-1" data-feather="check"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Dec 4, 12:56 PM</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">Apple
                                    iMac 24&quot; 4K Retina Display M1 8 Core CPU, 7 Core GPU,
                                    256GB SSD, Green (MJV83ZP/A) 2021</a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa-regular fa-star text-warning-light"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light"
                                    data-bs-theme="light"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    Personally, I like the minimalist style, but I wouldn't
                                    choose it if I were searching for a computer that I would
                                    use frequently. It's not horrible in terms of speed and
                                    power</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-success">Approaved<span
                                        class="ms-1" data-feather="check"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Nov 28, 7:28 PM</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">Razer
                                    Kraken v3 x Wired 7.1 Surroung Sound Gaming headset</a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">It
                                    performs exactly as expected. There are three of these in
                                    the family.</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-secondary">Cancelled<span
                                        class="ms-1" data-feather="x"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Nov 24, 10:16 AM</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">PlayStation
                                    5 DualSense Wireless Controller</a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    The controller is quite comfy for me. Despite its increased
                                    size, the controller still fits well in my hands.</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-success">Approaved<span
                                        class="ms-1" data-feather="check"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Just now</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a
                                    class="fw-semibold line-clamp-1"
                                    href="../../../apps/e-commerce/landing/product-details.html">2021
                                    Apple 12.9-inch iPad Pro (Wi‑Fi, 128GB) - Space Gray</a>
                            </td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa fa-star text-warning"></span><span
                                    class="fa-regular fa-star text-warning-light"
                                    data-bs-theme="light"></span>
                            </td>
                            <td class="align-middle review pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    The response time and service I received when contacted the
                                    designers were Phenomenal!</p>
                            </td>
                            <td class="align-middle status pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-warning">Pending<span
                                        class="ms-1" data-feather="fas fa-stopwatch"
                                        style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end date white-space-nowrap">
                                <p class="text-body-tertiary mb-0">Nov 07, 9:00 PM</p>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown"
                                        data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                            class="dropdown-item" href="#!">View</a><a
                                            class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a
                                            class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                                        <div class="col-auto d-flex">
                                            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body"
                                                data-list-info="data-list-info"></p><a class="fw-semibold"
                                                href="#!" data-list-view="*">View all<span
                                                    class="fas fa-angle-right ms-1"
                                                    data-fa-transform="down-1"></span></a><a
                                                class="fw-semibold d-none" href="#!" data-list-view="less">View
                                                Less<span class="fas fa-angle-right ms-1"
                                                    data-fa-transform="down-1"></span></a>
                                        </div>
                                        <div class="col-auto d-flex">
                                            <button class="page-link" data-list-pagination="prev"><span
                                                    class="fas fa-chevron-left"></span></button>
                                            <ul class="mb-0 pagination"></ul>
                                            <button class="page-link pe-0" data-list-pagination="next"><span
                                                    class="fas fa-chevron-right"></span></button>
                                        </div>
                                    </div> -->
            <livewire:seller.layout.footer />
        </div>
    </div>

</div>

</div>