<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="card  border-0 rounded-4 ">
                    <div class="card-body p-4">
                        <form class="bg-white shadow rounded-4 p-4" wire:submit.prevent="AddGalleryImages"
                            enctype="multipart/form-data">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="fw-bold text-primary">Gallery</h2>
                            </div>
                            <div class="row ">
                                @if ($isEdit && is_string($img_link))
                                    <div class="col-12 text-center">
                                        <img src="{{ config('api.web_base_url') . '/assets/img/customers/gallery/' . $img_link }}"
                                            alt="Current Product Image" class="img-thumbnail w-50 shadow-sm" />
                                    </div>
                                @endif

                                @if ($img_link && is_object($img_link))
                                    <div class="col-12 text-center">
                                        <img class="img-thumbnail w-50 shadow-sm" src="{{ $img_link->temporaryUrl() }}">
                                    </div>
                                @endif

                                <div class="col-lg-6">
                                    <label class="form-label text-dark fw-semibold">Gallery Image</label>
                                    <input name="img_link" class="form-control" type="file" wire:model="img_link" />
                                    <p class="text-danger small mt-1">
                                        @error('img_link')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="form-label text-dark fw-semibold">Name</label>
                                    <input class="form-control" id="name" type="text" wire:model="name"
                                        placeholder="Name" />
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <button
                                        class="btn btn-primary fs-9   shadow-sm">{{ $isEdit ? 'Update' : 'Add Image' }}</button>
                                    <button type="reset" class="btn btn-outline-secondary px-4">Cancel</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-border-bottom-0">

                    @if ($Gallerydetails)
                        <div class="table-responsive mt-4 shadow-sm rounded overflow-hidden">
                            <table class="table text-center align-middle">
                                <thead class="text-white">
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Gallerydetails as $item)
                                        <tr class="border-bottom"
                                            @if ($isEdit && $GalleryId == $item['id']) style="background-color: #e7fda9;" @endif>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ config('api.web_base_url') . '/assets/img/customers/gallery/' . $item['img_link'] }}"
                                                    class="img-fluid rounded" width="50"></td>
                                            <td>{{ $item['name'] }}</td>
                                            <td class="w-25">
                                                <button class="btn btn-sm btn-warning me-2"
                                                    wire:click="editGallery({{ $item['id'] }})"><i
                                                        class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="DeleteGallery({{ $item['id'] }})"><i
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
        </div>
    </div>
</div>

