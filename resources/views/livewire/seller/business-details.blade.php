<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content">
            <form class="mb-9" wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="row gx-3 flex-between-end mb-5">
                    <div class="col-auto">
                        <h2 class="mb-2">Business Details</h2>
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
                                    <div class="row gx-3 gy-4 mb-5">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="CompanyName">Company Name</label>
                                        <input class="form-control" id="CompanyName" type="text"
                                            placeholder="" />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="CeoName">CEO Name</label>
                                        <input class="form-control" id="CeoName" type="text"
                                            placeholder="" />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="year">Year Of Establishment</label>
                                        <input class="form-control" id="year" type="text"
                                            placeholder="" />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="mobile">Business Mobile</label>
                                        <input class="form-control" id="mobile" type="number"
                                            placeholder="" />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="email">Business Email</label>
                                        <input class="form-control" id="email" type="text"
                                            placeholder="" />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="address">Business Address</label>
                                        <input class="form-control" id="address" type="text"
                                            placeholder="" />
                                    </div>

                                    <div class="d-flex flex-between-center mb-2 mt-5">
                                        <div>
                                            <h3 class="text-body-emphasis mb-2">Additional Information</h3>
                                            <!-- <h5 class="text-body-tertiary fw-semibold">Essential for a better life</h5> -->
                                        </div>
                                        <!-- <button class="btn btn-phoenix-primary">View all</button> -->
                                    </div>

                                    <div class="col-12 col-lg-12">
                                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                            for="address">Company Description</label>
                                        <textarea class="form-control" id="address" type="text"
                                            placeholder=""></textarea>
                                    </div>

                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary px-7">Save changes</button>
                                </div>


            </form>
            <livewire:seller.layout.footer />
        </div>
    </div>

</div>

</div>