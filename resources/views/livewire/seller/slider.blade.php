<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="content bg-white rounded-4 p-5 shadow-lg ">
                    <form class="mb-9" wire:submit.prevent="AddSlider" enctype="multipart/form-data">
                        <div class="row gx-3 flex-between-end mb-5">
                            <div class="col-auto">
                                <h2 class="mb-2">Slider Details</h2>
                            </div>
                            <!-- <div class="col-auto">
                        <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="button">Discard</button>
                        <button class="btn btn-phoenix-primary me-2 mb-2 mb-sm-0" type="button">Save draft</button>
                        <button class="btn btn-primary mb-2 mb-sm-0" wire:click="generateSlug" type="submit">Publish
                            product</button>
                    </div> -->
                        </div>

                        <div class="row gx-3 gy-4 mb-5">
                            <div class="col-12 col-lg-12">
                                @if ($isEdit && is_string($img_link))
                                    <div class="col-12 col-md-7 mx-auto text-center">
                                        <img src="{{ config('api.web_base_url') . '/assets/img/customers/slider/' . $img_link }}"
                                            alt="Current Product Image" class="img-fluid rounded shadow-sm w-25" />
                                    </div>
                                @endif

                                @if ($img_link && is_object($img_link))
                                    <div class="col-12 col-md-7 mx-auto text-center">

                                        <img class="img-fluid rounded shadow-sm w-25" src="{{ $img_link->temporaryUrl() }}"
                                            style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="name">Slider Image</label>
                                <input name="main_img" class="form-control" type="file" wire:model="img_link" />

                                <p class="text-danger fs-9">
                                    @error('img_link')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>


                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="slider">Slider Name</label>
                                <input class="form-control" id="slider" type="text" wire:model="name"
                                    placeholder="Slider Name" />
                                <p class="text-danger fs-9">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>


                            <div class="text-end">
                                <button class="btn btn-primary px-7">{{ $isEdit ? 'Update' : 'Add' }}</button>
                            </div>

                        </div>
                    </form>


                    @if ($sliders)
                        {{-- <div class="border-y" id="profileRatingTable"
                            data-list='{"valueNames":["image","name"],"page":6,"pagination":true}'> --}}
                            <div class="table-responsive scrollbar">
                                <table class="table fs-9 mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th class="white-space-nowrap fs-9 border-end border-translucent align-middle ps-0"
                                                style="width:5%;">No.</th>
                                            <th class="sort align-middle border-end border-translucen" scope="col"
                                                data-sort="image" style="width:20%;">
                                                Image</th>

                                            <th class="sort align-middle border-end border-translucen" scope="col"
                                                data-sort="name" style="width:50%;">
                                                Name</th>

                                            <th class="sort align-middle" scope="col" style="width: 10%">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="profile-review-table-body">
                                        @foreach ($sliders as $item)
                                            <tr @if ($isEdit && $sliderId == $item['id']) style="background-color: #e7fda9;" @endif class="hover-actions-trigger btn-reveal-trigger position-static" wire:key="slider-{{ $item['id'] }}">

                                                <td class="fs-9 align-middle border-end border-translucent">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="align-middle border-end border-translucent white-space-nowrap py-0">
                                                    <a class="" href="#!"><img
                                                            src="{{ config('api.web_base_url') . '/assets/img/customers/slider/' . $item['img_link'] }}"
                                                            alt="" width="53"></a>
                                                </td>

                                                <td class="align-middle review border-end border-translucent">
                                                    <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                                        {{ $item['name'] }}
                                                    </p>
                                                </td>

                                                <td class="align-middle white-space-nowrap pe-0">




                                                    <button class="btn btn-sm btn-warning rounded shadow-sm"
                                                        wire:click="editSlider({{ $item['id'] }})"><i
                                                            class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                    <button class="btn btn-sm btn-danger rounded shadow-sm"
                                                        wire:click="DeleteSlider({{ $item['id'] }})"><i
                                                            class="fas fa-trash-alt me-2"></i>Delete</button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                                <div class="col-auto d-flex">
                                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body"
                                        data-list-info="data-list-info">
                                    </p><a class="fw-semibold" href="#!" data-list-view="*">View all<span
                                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a
                                        class="fw-semibold d-none" href="#!" data-list-view="less">View
                                        Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                                </div>
                                <div class="col-auto d-flex">
                                    <button class="page-link" data-list-pagination="prev"><span
                                            class="fas fa-chevron-left"></span></button>
                                    <ul class="mb-0 pagination"></ul>
                                    <button class="page-link pe-0" data-list-pagination="next"><span
                                            class="fas fa-chevron-right"></span></button>
                                </div>
                            </div> --}}

                            <div class="d-flex justify-content-end my-4">
                                @if ($page > 1)
                                    <button class="btn btn-primary me-2"
                                        wire:click="$set('page', {{ $page - 1 }})">Previous</button>
                                @endif

                                @if ($page < $totalPages)
                                    <button class="btn btn-primary" wire:click="$set('page', {{ $page + 1 }})">Next</button>
                                @endif
                            </div>
                    @endif
                        {{--
                    </div> --}}



                    @if (session()->has('error'))
                        <div class="alert alert-subtle-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                            role="alert" id="alert">
                            <span class="fas fa-check-cross fs-7 me-3"></span>
                            <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
                            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                            role="alert" id="alert">
                            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    {{--
                    <livewire:seller.layout.footer /> --}}
                </div>
            </div>

        </div>
    </div>
</div>