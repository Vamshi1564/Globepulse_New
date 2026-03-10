<div>
    <livewire:seller.layout.header />

    <div class="container">
        <div class="content">
            <form class="mb-9" wire:submit.prevent="AddSliderImage" enctype="multipart/form-data">
                <div class="row gx-3 flex-between-end mb-5">
                    <div class="col-auto">
                        <h2 class="mb-2">Portfolio Banner Images</h2>
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
                        @if ($isEdit && is_string($slider_img))
                            <div class="col-12 col-md-7 mx-auto text-center">
                                <img src="{{ config('app.pub_aws_url') . $slider_img }}" alt="Current Product Image"
                                    class="w-25" />
                            </div>
                        @endif

                        @if ($slider_img && is_object($slider_img))
                            <div class="col-12 col-md-7 mx-auto text-center">

                                <img class="w-25" src="{{ $slider_img->temporaryUrl() }}" style="max-width: 150px;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label text-body-highlight fs-8 mb-2 text-capitalize lh-sm"
                            for="slider_img">Slider Image</label>
                        <input class="form-control mb-2" id="slider_img" type="file" wire:model="slider_img"
                            placeholder="slider img" />
                        <p class="fs-9 text-danger">
                            @error('slider_img')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>


                    <div class="text-end">
                        <button class="btn btn-primary px-7">{{ $isEdit ? 'Update' : 'Save' }}</button>
                    </div>

                </div>
            </form>

            @if ($slider_images)
                {{-- <div class="border-y" id="profileRatingTable"
                data-list='{"valueNames":["name"],"page":6,"pagination":true}'> --}}
                <div class="table-responsive scrollbar">
                    <table class="table fs-9 mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="white-space-nowrap fs-9 border-end border-translucent align-middle ps-0"
                                    style="width:15%;">No.</th>

                                <th class="sort align-middle border-end border-translucent" scope="col"
                                    data-sort="name">
                                    SLider Image</th>

                                <th class="sort align-middle" scope="col" style="width: 15%">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="profile-review-table-body">
                            @foreach ($slider_images as $item)
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">


                                    <td class="fs-9 align-middle border-end border-translucent">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="align-middle border-end border-translucent review">
                                        <img src="{{ config('app.pub_aws_url') . $item->slider_img }}" width="53"
                                            alt="">

                                    </td>



                                    <td class="align-middle white-space-nowrap">
                                        <div class="btn-reveal-trigger position-static">
                                            <button
                                                class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2">
                                                {{-- <a class="dropdown-item" href="#!">View</a> --}}
                                                <a class="dropdown-item"
                                                    Wire:click = "editSliderImage({{ $item->id }})">Edit</a>
                                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                                    Wire:click = "DeleteSliderImage({{ $item->id }})">Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{-- <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                    <div class="col-auto d-flex">
                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info">
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
            {{-- </div> --}}


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

            <livewire:seller.layout.footer />
        </div>
    </div>

</div>
