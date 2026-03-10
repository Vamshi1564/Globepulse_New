<div class="tab-pane fade" id="tab-whyus" role="tabpanel"
    aria-labelledby="whyus-tab">
    <div class="row gx-3 gy-4 mb-5">

        <form wire:submit.prevent="submit">

            <div class="col-12 col-lg-12">
                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                    for="name">Why Choose Us Image</label>
                <div class="dropzone dropzone-multiple p-0 mb-5 w-50" id="my-awesome-dropzone" data-dropzone="data-dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple="multiple" />
                    </div>
                    <div class="dz-preview d-flex flex-wrap">
                        <div class="border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:80px;width:80px;"><img class="dz-image" src="#" alt="..." data-dz-thumbnail="data-dz-thumbnail" /><a class="dz-remove text-body-quaternary" href="#!" data-dz-remove="data-dz-remove"><span data-feather="x"></span></a></div>
                    </div>
                    <div class="dz-message text-body-tertiary text-opacity-85" data-dz-message="data-dz-message">Drag your photo here<span class="text-body-secondary px-1">or</span>
                        <button class="btn btn-link p-0" type="button">Browse from device</button><br /><img class="mt-3 me-2" src="../../../assets/img/icons/image-icon.png" width="40" alt="" />
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-6">
                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                    for="heading">Heading</label>
                <input class="form-control" wire:model="heading" id="heading" type="text"
                    placeholder="Heading" />
            </div>

            <div class="col-12 col-lg-12">
                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                    for="content">Content</label>
                <textarea class="form-control" wire:model="content" id="content" type="text"
                    placeholder="Content"></textarea>
            </div>
            <br />

            <div class="text-end">
                <button class="btn btn-primary px-7">Submit</button>
            </div>

        </form>
    </div>

    <div class="border-y" id="profileRatingTable"
        data-list='{"valueNames":["image","heading","content"],"page":6,"pagination":true}'>
        <div class="table-responsive scrollbar">
            <table class="table fs-9 mb-0">
                <thead>
                    <tr>
                        <th class="white-space-nowrap fs-9 align-middle ps-0" style="max-width:20px; width:18px;">
                            <div class="form-check mb-0 fs-8"><input class="form-check-input" id="checkbox-bulk-products-select" type="checkbox" data-bulk-select="{" body":"products-table-body"}" checked="false"></div>
                        </th>

                        <th class="sort align-middle" scope="col" data-sort="image"
                            style="max-width:50%;">Image</th>

                        <th class="sort align-middle" scope="col" data-sort="heading"
                            style="max-width:50%;">Heading</th>

                        <th class="sort align-middle" scope="col" data-sort="content"
                            style="max-width:50%;">Content</th>

                        <th class="sort text-end pe-0 align-middle" scope="col"
                            style="width: 50%">Actions</th>
                    </tr>
                </thead>
                <tbody class="list" id="profile-review-table-body">

                  

                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">

                        <td class="align-middle">
                            <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row="{&quot;product&quot;:&quot;2021 Apple 12.9-inch iPad Pro (Wi‑Fi, 128GB) - Space Gray&quot;,&quot;productImage&quot;:&quot;/products/7.png&quot;,&quot;price&quot;:&quot;$4&quot;,&quot;category&quot;:&quot;Food&quot;,&quot;tags&quot;:[&quot;Ipad&quot;,&quot;Pro&quot;,&quot;Creativity&quot;,&quot;Thunderbolt&quot;,&quot;Space&quot;],&quot;star&quot;:false,&quot;vendor&quot;:&quot;Maimuna’s Bakery&quot;,&quot;publishedOn&quot;:&quot;Nov 1, 7:45 AM&quot;}"></div>
                        </td>

                        <td class="align-middle white-space-nowrap py-0">
                            <a class="" href="../../../apps/e-commerce/landing/product-details.html"><img src="../../../assets/img//products/7.png" alt="" width="53"></a>
                        </td>

                        <td class="align-middle review pe-7">
                            <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                XYZ</p>
                        </td>

                        <td class="align-middle review pe-7">
                            <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                Sreved frgrwsdvc erfeq</p>
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
        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
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
        </div>
    </div>
</div>