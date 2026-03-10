<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content">
            <form class="mb-9" wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="row gx-3 flex-between-end mb-5">
                    <div class="col-auto">
                        <h2 class="mb-2">Statutory Details</h2>
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
                            for="GSTNo">GSTIN</label>
                        <input class="form-control" id="GSTNo" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="PANNo">PAN NO.</label>
                        <input class="form-control" id="PANNo" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="TANNo">TAN NO.</label>
                        <input class="form-control" id="TANNo" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="CINNo">CIN NO.</label>
                        <input class="form-control" id="CINNo" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="BankName">Bank Name</label>
                        <input class="form-control" id="BankName" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="BranchName">Branch Name</label>
                        <input class="form-control" id="BranchName" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="AccountNumber">Account Number</label>
                        <input class="form-control" id="AccountNumber" type="text"
                            placeholder="" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                            for="BankCode">Bank IFSC Code</label>
                        <input class="form-control" id="BankCode" type="text"
                            placeholder="" />
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