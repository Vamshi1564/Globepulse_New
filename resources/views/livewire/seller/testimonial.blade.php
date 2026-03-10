<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class=" bg-white shadow-lg rounded-4 p-4">
                    <form class="mb-5" wire:submit.prevent="AddTestimonial" enctype="multipart/form-data">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-4 text-primary">Testimonial Details</h2>
                        </div>

                        <div class="row ">
                            <div class="col-12 text-center">
                                @if ($isEdit && is_string($img_link))
                                    <img src="{{ config('api.web_base_url') . '/assets/img/customers/testimonial/' . $img_link }}"
                                        alt="Current Image" class="img-fluid rounded shadow-sm w-25" />
                                @endif
                                @if ($img_link && is_object($img_link))
                                    <img class="img-fluid rounded shadow-sm w-25" src="{{ $img_link->temporaryUrl() }}" />
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Testimonial Image</label>
                                <input class="form-control" type="file" wire:model="img_link" />
                                @error('img_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Name</label>
                                <input class="form-control" type="text" wire:model="name" placeholder="Enter Name" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Content</label>
                                <textarea class="form-control" wire:model="content"
                                    placeholder="Enter Testimonial"></textarea>
                                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button
                                class="btn btn-primary fs-8 px-5 py-2 shadow-sm">{{ $isEdit ? 'Update' : 'Add Testimonial' }}</button>
                        </div>
                    </form>

                    @if ($testimonials)
                        <div class="table-responsive mt-5">
                            <table class="table table-striped align-middle text-center rounded-4 overflow-hidden shadow-sm">
                                <thead class=" text-white">
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Content</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $item)
                                        <tr @if ($isEdit && $TestimonialId == $item['id']) style="background-color: #e7fda9;" @endif>
                                            <td class="fw-bold">{{ $loop->iteration }}</td>
                                            <td><img src="{{ config('api.web_base_url') . '/assets/img/customers/testimonial/' . $item['img_link'] }}"
                                                    alt="" class="rounded" width="70"></td>
                                            <td class="fw-semibold text-dark">{{ $item['name'] }}</td>
                                            <td class="text-muted text-truncate" style="max-width: 200px;">
                                                {{ $item['content'] }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning"
                                                    wire:click="editTestimonial({{ $item['id'] }})"><i
                                                        class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="DeleteTestimonial({{ $item['id'] }})"><i
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