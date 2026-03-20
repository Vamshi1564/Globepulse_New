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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="fw-bold text-primary">Upload Brochure</h2>
                        </div>
                        <form class="mb-9" wire:submit.prevent="Addbrochure" enctype="multipart/form-data">
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
                                    @if ($isEdit && is_string($brochure_link))
                                        @php
                                            $ext = pathinfo($brochure_link, PATHINFO_EXTENSION);
                                        @endphp
                                        @if (strtolower($ext) === 'pdf')
                                            <a href="{{ config('api.web_base_url') . '/assets/img/customers/brochure/' . $brochure_link }}"
                                                target="_blank" class="text-decoration-none">
                                                <i class="fas fa-file-pdf fa-4x text-danger"></i>
                                                <div class="mt-1 small">View PDF</div>
                                            </a>
                                        @else
                                            <img src="{{ config('api.web_base_url') . '/assets/img/customers/brochure/' . $brochure_link }}"
                                                alt="Current Image" class="img-fluid rounded shadow-sm w-25" />
                                        @endif
                                    @endif

                                    {{-- Show preview for new uploaded file --}}
                                    @if ($brochure_link && is_object($brochure_link))
                                        @php
                                            $uploadExt = strtolower($brochure_link->getClientOriginalExtension());
                                        @endphp
                                        @if ($uploadExt === 'pdf')
                                            <a href="{{ $brochure_link->temporaryUrl() }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="fas fa-file-pdf fa-4x text-danger"></i>
                                                <div class="mt-1 small">Preview PDF</div>
                                            </a>
                                        @else
                                            <img class="img-fluid rounded shadow-sm w-25"
                                                src="{{ $brochure_link->temporaryUrl() }}" />
                                        @endif
                                    @endif

                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Brochure</label>
                                    <input class="form-control" type="file" wire:model="brochure_link" />
                                    @error('brochure_link')
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


                        <div class="table-border-bottom-0">
                            @if ($brochures)
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
                                            @foreach ($brochures as $item)
                                                <tr @if($isEdit && $brochureId == $item['id']) style="background-color: #e7fda9;" @endif>
                                                    <td class="fw-bold">{{ $loop->iteration }}</td>
                                                  
                                                    <td>
                                                        @php
                                                            $fileName = $item['brochure_link'];
                                                            $filePath =
                                                                config('api.web_base_url') .
                                                                '/assets/img/customers/brochure/' .
                                                                $fileName;
                                                            $extension = strtolower(
                                                                pathinfo($fileName, PATHINFO_EXTENSION),
                                                            );
                                                        @endphp

                                                        @if ($extension === 'pdf')
                                                            <a href="{{ $filePath }}" target="_blank"
                                                                class="text-decoration-none">
                                                                <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                                <div class="small text-primary">View PDF</div>
                                                            </a>
                                                        @else
                                                            <img src="{{ $filePath }}" class="rounded"
                                                                width="70" alt="Image" />
                                                        @endif
                                                    </td>

                                                  
                                                    <td class="fw-semibold text-dark">{{ $item['name'] }}</td>

                                                    <td>
                                                        <button class="btn btn-sm btn-warning"
                                                            wire:click="editBrochure({{ $item['id'] }})"><i
                                                                class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                        <button class="btn btn-sm btn-danger"
                                                            wire:click="DeleteBrochure({{ $item['id'] }})"><i
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
    </div>
</div>
