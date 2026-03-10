<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="content bg-white shadow rounded-4">
                    <form class="custom-form glass-effect p-5 rounded-4" wire:submit.prevent="Addwhyus"
                        enctype="multipart/form-data">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="text-primary fw-bold">Why Choose Us</h2>
                        </div>

                        <div class="row ">
                            <div class="col-12 text-center">
                                @if ($isEdit && is_string($img_link))
                                    <img src="{{ config('api.web_base_url') . '/assets/img/customers/' . $img_link }}"
                                        class="img-fluid rounded shadow" style="max-width: 120px;" />
                                @endif
                                @if ($img_link && is_object($img_link))
                                    <img src="{{ $img_link->temporaryUrl() }}" class="img-fluid rounded shadow"
                                        style="max-width: 120px;" />
                                @endif
                            </div>



                            <div class="col-lg-6">
                                <label class="form-label text-white">Upload Image</label>
                                <input type="file" class="form-control rounded" wire:model="img_link">
                                <small class="text-danger">@error('img_link') {{ $message }} @enderror</small>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Icon</label>
                                <input class="form-control" type="text" id="icon" name="icon">
                                <p class="text-danger">@error('img_icon') {{ $message }} @enderror</p>
                            </div>

                            <div class="col-12">
                                <label class="form-label text-white">Heading</label>
                                <input type="text" class="form-control rounded" wire:model="heading"
                                    placeholder="Enter heading">
                                <small class="text-danger">@error('heading') {{ $message }} @enderror</small>
                            </div>

                            <div class="col-12">
                                <label class="form-label text-white">Content</label>
                                <textarea class="form-control rounded" wire:model="content" rows="3"
                                    placeholder="Enter content"></textarea>
                                <small class="text-danger">@error('content') {{ $message }} @enderror</small>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button
                                class="btn btn-primary fs-8 px-5 py-2 shadow-sm">{{$isEdit ? 'Update' : 'Submit'}}</button>
                        </div>
                    </form>

                    @if ($whyusdetails)
                        <div class="table-responsive mt-5">
                            <table class="table table-hover text-center glass-effect text-white">
                                <thead class=" text-white">
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Content</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($whyusdetails as $item)
                                        <tr class="hover-row" @if ($isEdit && $whyusId == $item['id']) style="background-color: #e7fda9;" @endif>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ config('api.web_base_url') . '/assets/img/customers/' . $item['img_link'] }}"
                                                    width="50" class="rounded">
                                            </td>
                                            <td>{{ Str::limit($item['heading'], 20)}}</td>
                                            <td>{{ Str::limit($item['content'], 20)}}</td>
                                            <td class="w-25">
                                                <button class="btn btn-sm btn-warning rounded shadow-sm"
                                                    wire:click="editWhyus({{ $item['id'] }})"><i
                                                        class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                <button class="btn btn-sm btn-danger rounded shadow-sm"
                                                    wire:click="DeleteWhyus({{ $item['id'] }})"><i
                                                        class="fas fa-trash-alt me-2"></i>Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <style>
                .glass-effect {
                    background: rgba(255, 255, 255, 0.1);
                    backdrop-filter: blur(10px);
                    border-radius: 10px;
                    padding: 20px;
                }

                .hover-row:hover {
                    background: rgba(255, 255, 255, 0.2);
                }
            </style>


        </div>

    </div>

</div>