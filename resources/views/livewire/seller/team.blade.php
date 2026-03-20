<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class=" bg-white rounded-4 p-5 shadow-lg ">
                    <div class="row gx-3 flex-between-end mb-5">
                        <div class="col-auto">
                            <h2 class="mb-2 text-primary">Our Team</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mb-9" wire:submit.prevent="AddTeam" enctype="multipart/form-data">
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
                                        <img src="{{ config('api.web_base_url') . '/assets/img/customers/team/' . $img_link }}"
                                            alt="Current Image" class="img-fluid rounded shadow-sm w-25" />
                                    @endif
                                    @if ($img_link && is_object($img_link))
                                        <img class="img-fluid rounded shadow-sm w-25"
                                            src="{{ $img_link->temporaryUrl() }}" />
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Profile Pic</label>
                                    <input class="form-control" type="file" wire:model="img_link" />
                                    @error('img_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Name Field -->
                                <div class="mb-3 col-md-10">
                                    <label class="form-label fw-bold">Name</label>
                                    {{-- <input class="form-control" type="hidden" id="id" name="id" value="4">
                                        <input class="form-control" type="hidden" id="cid" name="cid" value=""> --}}
                                    <input class="form-control rounded-3" wire:model="name" type="text"
                                        id="name" name="name" value="" autofocus="">
                                </div>

                                <!-- Designation Field -->
                                <div class="mb-3 col-md-10">
                                    <label class="form-label fw-bold">Designation</label>
                                    <input class="form-control rounded-3" wire:model="designation" type="text"
                                        id="designation" name="designation" value="" placeholder="">
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


                    <div class="table-border-bottom-0">
                        @if ($teams)
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-striped align-middle text-center rounded-4 overflow-hidden shadow-sm">
                                    <thead class=" text-white">
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $item)
                                            <tr @if ($isEdit && $TeamId == $item['id']) style="background-color: #e7fda9;" @endif>
                                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                                <td><img src="{{ config('api.web_base_url') . '/assets/img/customers/team/' . $item['img_link'] }}"
                                                        alt="" class="rounded" width="70"></td>
                                                <td class="fw-semibold text-dark">{{ $item['name'] }}</td>
                                                <td class="text-muted text-truncate" style="max-width: 200px;">
                                                    {{ $item['designation'] }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning"
                                                        wire:click="editTeam({{ $item['id'] }})"><i
                                                            class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="DeleteTeam({{ $item['id'] }})"><i
                                                            class="fas fa-trash-alt me-2"></i>Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                    {{-- <div class="d-flex justify-content-end my-4">
                        @if ($page > 1)
                            <button class="btn btn-primary me-2"
                                wire:click="$set('page', {{ $page - 1 }})">Previous</button>
                        @endif

                        @if ($page < $totalPages)
                            <button class="btn btn-primary"
                                wire:click="$set('page', {{ $page + 1 }})">Next</button>
                        @endif
                    </div> --}}

                </div>
            </div>

            <!-- Delete Confirmation Modal -->


            <!-- Script for Delete Confirmation -->


        </div>
    </div>
</div>
