<div>
    <livewire:seller.layout.header />
    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>

        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="content bg-white rounded-4 p-5 shadow-lg ">
                    <form class="mb-9" wire:submit.prevent="AddProduct" enctype="multipart/form-data">
                        <div class="row gx-3 flex-between-end mb-5">
                            <div class="col-auto">
                                <h2 class="mb-2 text-primary">Products</h2>
                            </div>
                            <!-- <div class="col-auto">
                        <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="button">Discard</button>
                        <button class="btn btn-phoenix-primary me-2 mb-2 mb-sm-0" type="button">Save draft</button>
                        <button class="btn btn-primary mb-2 mb-sm-0" wire:click="generateSlug" type="submit">Publish
                            product</button>
                    </div> -->
                        </div>

                        <div class="row gx-3 gy-4 mb-5 align-items-center">
                            @if ($isEdit && is_string($main_img))
                                <div class="col-12 col-md-7 mx-auto text-center">
                                    <img class="img-fluid rounded shadow-sm w-25"
                                        src="{{ config('api.web_base_url') . '/assets/img/customers/products/' . $main_img }}"
                                        
                                        alt="Current Product Image" />
                                </div>
                            @endif

                            @if ($main_img && is_object($main_img))
                                <div class="col-12 col-md-7 mx-auto text-center">

                                    <img class="w-25" src="{{ $main_img->temporaryUrl() }}" style="max-width: 150px;">
                                </div>
                            @endif
                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="name">Product Image</label>
                                <input name="main_img" class="form-control" type="file" wire:model="main_img" />

                                <p class="text-danger fs-9">
                                    @error('main_img')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="name">Product Name</label>
                                <input class="form-control" id="name" type="text" wire:model="name"
                                    placeholder="Product Name" />
                                <p class="text-danger fs-9">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="category">Categroy</label>
                                <select class="form-select" wire:model="product_cat" id="category">
                                    <option value="">Select</option>
                                    @foreach ($pro_categories as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger fs-9">
                                    @error('product_cat')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="description">Description</label>
                                <textarea class="form-control" id="description" wire:model="des" type="text"
                                    placeholder="Description"></textarea>
                                <p class="text-danger fs-9">
                                    @error('des')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label text-body-highlight fs-8 ps-0 text-capitalize lh-sm"
                                    for="long">Long Description</label>
                                <textarea class="form-control" id="long" type="text" wire:model="long_des"
                                    placeholder="Long Description"></textarea>
                                <p class="text-danger fs-9">
                                    @error('long_des')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>


                            <div class="text-end">
                                <button class="btn btn-primary px-7">{{ $isEdit ? 'Update' : 'Add' }}</button>
                            </div>
                        </div>
                    </form>

                    @if ($products)
                        {{-- <div class="border-y mb-5" id="profileRatingTable"
                            data-list='{"valueNames":["image","name","category","description","long"],"page":6,"pagination":true}'>
                            --}}
                            <div class="table-responsive scrollbar">
                                <table class="table fs-9 mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th class="white-space-nowrap fs-9 border-end border-translucent align-middle ps-0"
                                                style="width:5%;">No.</th>
                                            <th class="sort white-space-nowrap align-middle border-end border-translucent"
                                                scope="col" style="min-width:10px;" data-sort="image">Image</th>
                                            <th class="sort align-middle border-end border-translucent" scope="col"
                                                data-sort="name" style="max-width:30px;">
                                                Name</th>
                                            <th class="sort align-middle border-end border-translucent" scope="col"
                                                style="min-width:50%" data-sort="category">
                                                Category</th>
                                            <th class="sort align-middle border-end border-translucent" scope="col"
                                                style="max-width:50%;" data-sort="description">Description</th>
                                            <th class="sort align-middle border-end border-translucent" scope="col"
                                                style="max-width:50%;" data-sort="longdescription">Long Description</th>
                                            <th class="sort align-middle " scope="col" style="width: 10%">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="profile-review-table-body">
                                        @foreach ($products as $item)
                                            <tr @if ($isEdit && $productId == $item['id']) style="background-color: #e7fda9;" @endif class="hover-actions-trigger btn-reveal-trigger position-static">

                                                <td class="fs-9 align-middle border-end border-translucent">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="align-middle border-end border-translucent white-space-nowrap py-0">
                                                    <a class="" href="#!"><img
                                                            src="{{ config('api.web_base_url') . '/assets/img/customers/products/' . $item['main_img'] }}"
                                                            
                                                            alt="" width="53"></a>
                                                </td>
                                                <td class="align-middle border-end border-translucent review pe-7">
                                                    <p class="fw-semibold text-body-highlight mb-0 line-clamp-2">
                                                        {{ $item['name'] }}
                                                    </p>
                                                </td>

                                                <td class="align-middle border-end border-translucent date white-space-nowrap">
                                                    <p class="text-body-tertiary mb-0">{{ $item['category_name'] }}</p>
                                                <td class="align-middle border-end border-translucent date white-space-nowrap">
                                                    <p class="text-body-tertiary mb-0">{{ $item['des'] }}</p>
                                                <td class="align-middle border-end border-translucent date white-space-nowrap">
                                                    <p class="text-body-tertiary mb-0">{{ $item['long_des'] }}</p>

                                                </td>
                                                <td class="align-middle white-space-nowrap pe-0">


                                                    <button class="btn btn-sm btn-warning rounded shadow-sm"
                                                        wire:click="editProduct({{ $item['id'] }})"><i
                                                            class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                    <button class="btn btn-sm btn-danger rounded shadow-sm"
                                                        wire:click="DeleteProduct({{ $item['id'] }})"><i
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