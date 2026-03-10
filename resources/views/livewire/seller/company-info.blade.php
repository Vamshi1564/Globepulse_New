<div>
    <livewire:seller.layout.header />
    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="content bg-white rounded-4 p-5 shadow-lg position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10"
                        style="background: url('https://source.unsplash.com/random/800x600') no-repeat center center/cover;">
                    </div>
                    <form class="mb-4 position-relative" wire:submit.prevent="AddAbout" enctype="multipart/form-data">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            {{-- <h2 class="fw-bold text-dark text-uppercase">About Us</h2> --}}
                            <h2 class="fw-bold text-primary">About Us</h2>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                @if ($isEdit && is_string($img_link))
                                    <img src="{{ config('api.web_base_url') . '/assets/img/customers/about/' . $img_link }}"
                                        class="rounded shadow-lg w-50 border border-3 border-dark" alt="Current Image" />
                                @endif
                                @if ($img_link && is_object($img_link))
                                    <img src="{{ $img_link->temporaryUrl() }}"
                                        class="rounded shadow-lg border border-3 border-primary"
                                        style="max-width: 200px;" />
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Upload Image</label>
                                <input name="img_link" class="form-control" type="file" wire:model="img_link" />
                                <p class="text-danger">@error('img_link') {{ $message }} @enderror</p>
                            </div>



                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Heading</label>
                                <input class="form-control" type="text" wire:model="heading"
                                    placeholder="Enter Heading" />
                                <p class="text-danger">@error('heading') {{ $message }} @enderror</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Content</label>
                                <textarea class="form-control " wire:model="content"
                                    placeholder="Enter Content"></textarea>
                                <p class="text-danger">@error('content') {{ $message }} @enderror</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">Mission</label>
                                <textarea class="form-control " wire:model="mission"
                                    placeholder="Enter Mission"></textarea>
                                <p class="text-danger">@error('mission') {{ $message }} @enderror</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Vision</label>
                                <textarea class="form-control " wire:model="vision"
                                    placeholder="Enter Vision"></textarea>
                                <p class="text-danger">@error('vision') {{ $message }} @enderror</p>
                            </div>
                            <div class="text-end">
                                <button
                                    class="btn btn-primary px-5 py-2 rounded  transition-all">{{ $isEdit ? 'Update' : 'Add' }}</button>
                            </div>
                        </div>
                    </form>
                    @if ($Aboutusdetails)
                        <div class="table-responsive mt-4">
                            <table class="table table-striped text-center border rounded overflow-hidden shadow">
                                <thead class=" text-white">
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Aboutusdetails as $item)
                                        <tr @if ($isEdit && $AboutusId == $item['id']) style="background-color: #e7fda9;" @endif>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ config('api.web_base_url') . '/assets/img/customers/about/' . $item['img_link'] }}"
                                                    alt="" width="50" class="rounded ">
                                            </td>
                                            <td>{{ $item['heading'] }}</td>
                                            <td>{{ Str::limit($item['content'], 20) }}</td>
                                            <td>{{ Str::limit($item['mission'], 20) }}</td>
                                            <td>{{ Str::limit($item['vision'], 20) }}</td>
                                            <td class="w-25">
                                                <button class="btn btn-sm btn-warning rounded shadow-sm"
                                                    wire:click="editAbout({{ $item['id'] }})"><i
                                                        class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                <button class="btn btn-sm btn-danger rounded shadow-sm"
                                                    wire:click="DeleteAbout({{ $item['id'] }})"><i
                                                        class="fas fa-trash-alt me-2"></i>Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success p-3 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3 shadow-lg"
                            role="alert" id="alert">
                            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
</div>