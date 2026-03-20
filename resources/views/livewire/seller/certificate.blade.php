<div>

    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>

        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="card shadow-lg p-4 border-0 rounded-4">
                    <h2 class="mb-4 text-primary">Certificate</h2>
                    <div class="">
                        {{-- <h5 class="card-header bg-primary text-white p-3">Certificate Details</h5> --}}
                        <div class=" p-4">
                            <form class="mb-9" wire:submit.prevent="AddCertificate" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Profile Picture Upload with Preview -->
                                    {{-- <div class="mb-3 col-md-10">
                                        <label class="form-label fw-bold"></label>
                                        <input class="form-control" type="file" id="image" name="image">
                                        <div class="mt-2">
                                            <img id="imagePreview" src="" class="img-thumbnail d-none" width="100" />
                                        </div>
                                    </div> --}}
                                    <div class="col-12 text-center">
                                        @if ($isEdit && is_string($img_link))
                                            <img src="{{ config('api.web_base_url') . '/assets/img/customers/certificate/' . $img_link }}"
                                                alt="Current Image" class="img-fluid rounded shadow-sm w-25" />
                                        @endif
                                        @if ($img_link && is_object($img_link))
                                            <img class="img-fluid rounded shadow-sm w-25"
                                                src="{{ $img_link->temporaryUrl() }}" />
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Certificate Photo</label>
                                        <input class="form-control" type="file" wire:model="img_link" />
                                        @error('img_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Name Field -->
                                    <div class="mb-3 col-md-10">
                                        <label class="form-label fw-bold">Certificate Title</label>
                                        {{-- <input class="form-control" type="hidden" id="id" name="id" value="4">
                                        <input class="form-control" type="hidden" id="cid" name="cid" value=""> --}}
                                        <input class="form-control rounded-3" wire:model="name" type="text"
                                            id="name" name="name" value="" autofocus="">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-3">
                                    <button type="submit" name="sub" class="btn btn-primary rounded-pill px-4">Save
                                        changes</button>
                                    <button type="reset"
                                        class="btn btn-outline-secondary rounded-pill px-4">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-border-bottom-0">
                        @if ($certificates)
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-striped align-middle text-center rounded-4 overflow-hidden shadow-sm">
                                    <thead class=" text-white">
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($certificates as $item)
                                            <tr @if ($isEdit && $certificateId == $item['id']) style="background-color: #e7fda9;" @endif>
                                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                                <td><img src="{{ config('api.web_base_url') . '/assets/img/customers/certificate/' . $item['img_link'] }}"
                                                        alt="" class="rounded" width="70"></td>
                                                <td class="fw-semibold text-dark">{{ $item['name'] }}</td>

                                                <td>
                                                    <button class="btn btn-sm btn-warning"
                                                        wire:click="editCertificate({{ $item['id'] }})"><i
                                                            class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="DeleteCertificate({{ $item['id'] }})"><i
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


                {{-- <h5 class="card-header bg-dark text-white p-3">Certificate List</h5> --}}


            </div>
        </div>
    </div>
</div>
