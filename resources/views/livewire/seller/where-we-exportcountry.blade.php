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
                            <h2 class="fw-bold text-primary">Where We Export Country</h2>
                        </div>
                        <form wire:submit.prevent="AddexportCountry" enctype="multipart/form-data">

                            <div class="text-center mb-3">
                                @if ($isEdit && is_string($img_link))
                                    <img src="{{ config('api.web_base_url') . '/assets/img/customers/export_country/' . $img_link }}"
                                        alt="Current Image" class="img-fluid rounded shadow-sm w-25" />
                                @endif
                                @if ($img_link && is_object($img_link))
                                    <img class="img-fluid rounded shadow-sm w-25"
                                        src="{{ $img_link->temporaryUrl() }}" />
                                @endif
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Country Photo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-upload text-dark"></i>
                                    </span>
                                    <input class="form-control" type="file" id="image" wire:model="img_link" />
                                </div>
                                @error('img_link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Country Name</label>
                                <input class="form-control rounded-3" type="text" id="name"
                                    wire:model.defer="country_name" maxlength="30" placeholder="Enter Name" autofocus />
                                @error('country_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Update</button>
                                <button type="reset" class="btn btn-outline-secondary px-4"
                                   >Cancel</button>
                            </div>
                        </form>
                    </div>

                    <div class="card mt-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            @if ($exportcountries)
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle text-center">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>No.</th>
                                                <th>Image</th>
                                                <th>Country Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exportcountries as $item)
                                                <tr>
                                                    <td class="fw-bold">{{ $loop->iteration }}</td>
                                                    <td><img src="{{ config('api.web_base_url') . '/assets/img/customers/export_country/' . $item['img_link'] }}"
                                                            alt="" class="rounded" width="70"></td>
                                                    <td class="fw-semibold text-dark">{{ $item['country_name'] }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning"
                                                            wire:click="editExportCountry({{ $item['id'] }})">
                                                            <i class="fa fa-edit me-1"></i>Edit
                                                        </button>
                                                        <button class="btn btn-sm btn-danger"
                                                            wire:click="DeleteExportCountry({{ $item['id'] }})">
                                                            <i class="fa fa-trash me-1"></i>Delete
                                                        </button>
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
