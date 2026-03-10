<div>
    <livewire:seller.layout.header />
    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9 d-flex justify-content-center   min-vh-100 ">
            <div class="container">
                <div class="my-4">
                    <div class="card shadow-lg  border-0 rounded-4 p-5  bg-white">
                        <h2 class="fw-bold text-primary mb-3">Social Media Details</h2>

                        <form class="mb-4" wire:submit.prevent="submit" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6 mb-3 position-relative">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <div class="input-group shadow-sm rounded-pill">
                                        <span class="input-group-text bg-transparent "><i
                                                class="fab fa-twitter text-primary"></i></span>
                                        <input type="text" class="form-control " id="twitter" wire:model="twitter"
                                            placeholder="Enter Twitter URL">
                                    </div>
                                    <p class="text-danger fs-9">@error('twitter'){{ $message }}@enderror</p>
                                </div>

                                <div class="col-6 mb-3 position-relative">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <div class="input-group shadow-sm rounded-pill">
                                        <span class="input-group-text bg-transparent "><i
                                                class="fab fa-linkedin text-primary"></i></span>
                                        <input type="text" class="form-control " id="linkedin" wire:model="linkedin"
                                            placeholder="Enter LinkedIn URL">
                                    </div>
                                    <p class="text-danger fs-9">@error('linkedin'){{ $message }}@enderror</p>
                                </div>

                                <div class="col-6 mb-3 position-relative">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <div class="input-group shadow-sm rounded-pill">
                                        <span class="input-group-text bg-transparent "><i
                                                class="fab fa-instagram text-danger"></i></span>
                                        <input type="text" class="form-control " id="instagram" wire:model="instagram"
                                            placeholder="Enter Instagram URL">
                                    </div>
                                    <p class="text-danger fs-9">@error('instagram'){{ $message }}@enderror</p>
                                </div>

                                <div class="col-6 mb-3 position-relative">
                                    <label for="youtube" class="form-label">YouTube</label>
                                    <div class="input-group shadow-sm rounded-pill">
                                        <span class="input-group-text bg-transparent "><i
                                                class="fab fa-youtube text-danger"></i></span>
                                        <input type="text" class="form-control " id="youtube" wire:model="youtube"
                                            placeholder="Enter YouTube URL">
                                    </div>
                                    <p class="text-danger fs-9">@error('youtube'){{ $message }}@enderror</p>
                                </div>

                                <div class=" mb-4 position-relative">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <div class="input-group shadow-sm rounded-pill">
                                        <span class="input-group-text bg-transparent "><i
                                                class="fab fa-facebook text-primary"></i></span>
                                        <input type="text" class="form-control " id="facebook" wire:model="facebook"
                                            placeholder="Enter Facebook URL">
                                    </div>
                                    <p class="text-danger fs-9">@error('facebook'){{ $message }}@enderror</p>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary fs-8 mt-3 px-5 py-2 shadow-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>

</div>