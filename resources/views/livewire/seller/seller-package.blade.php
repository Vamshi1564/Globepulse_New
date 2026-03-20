<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content">

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Package</h2>
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
                            <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:10%;"
                                data-sort="name">NAME</th>
                            <th class="sort align-middle" scope="col" data-sort="price" style="max-width:10%;">PRICE
                            </th>
                            <th class="sort align-middle" scope="col" style="min-width:40%" data-sort="details">
                                Shipment Data</th>
                            <th class="sort align-middle" scope="col" style="min-width:40%" data-sort="details">Buyer
                                Data</th>
                            <th class="sort align-middle" scope="col" style="min-width:20%" data-sort="validity">
                                VALIDITY</th>
                            <th class="sort align-middle" scope="col" style="max-width:20%;" data-sort="status">
                                STATUS</th>
                            <th class="sort align-middle" scope="col" style="max-width:20%;" data-sort="view">VIEW
                            </th>
                            <!-- <th class="sort text-end pe-0 align-middle" scope="col"
                                                        style="width: 7%"> </th> -->
                        </tr>
                    </thead>
                    <tbody class="list" id="profile-review-table-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle product pe-3"><a class="fw-semibold line-clamp-1"
                                    href="">{{ $package->package_name }}</a></td>
                            <!-- <td class="align-middle rating white-space-nowrap fs-10"><span
                                                            class="fa fa-star text-warning"></span><span
                                                            class="fa fa-star text-warning"></span><span
                                                            class="fa fa-star text-warning"></span><span
                                                            class="fa fa-star text-warning"></span><span
                                                            class="fa-regular fa-star text-warning-light"
                                                            data-bs-theme="light"></span>
                                                    </td> -->
                            <td class="align-middle pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    {{ $package->price }}</p>
                            </td>
                            <td class="align-middle pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    {{ $package->shipmentdata }}</p>
                            </td>
                            <td class="align-middle pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    {{ $package->buyer_lead }}</p>
                            </td>
                            <td class="align-middle pe-7">
                                <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                    1 Year</p>
                            </td>
                            <td class="align-middle pe-9"><span
                                    class="badge badge-phoenix fs-10 badge-phoenix-success">Active<span class="ms-1"
                                        data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle pe-7">
                                <a href="{{ route('packages') }}" target="_blank">
                                    <button type="button" class="btn btn-sm btn-primary">View</button>
                                </a>
                            </td>
                            <!-- <td class="align-middle text-end date white-space-nowrap"> -->
                            <!-- <p class="text-body-tertiary mb-0">Just now</p> -->
                            <!-- <a href="{{ route('about') }}" class="btn btn-sm btn-primary"> -->
                            <!-- <button type="button">View</button>
                                            </a>
                                                    </td> -->
                            <!-- <td class="align-middle white-space-nowrap text-end pe-0">
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
                                                    </td> -->
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
        </div>
        <livewire:seller.layout.footer />
    </div>

</div>
