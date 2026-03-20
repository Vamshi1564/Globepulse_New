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
                            <h2 class="mb-2 text-primary">Video</h2>
                        </div>
                    </div>
                    <div class="form-container">
                        <form id="formAccountSettings" wire:submit.prevent="AddVideo" method="POST"
                            enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="name" class="form-label">Video Title</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter video title" wire:model="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Video Link</label>
                                <input class="form-control" type="url" id="link" name="link"
                                    placeholder="Paste video link here" wire:model="link" required>
                            </div>


                            <div class="d-flex justify-content-between">
                                <button type="submit" name="sub" class="btn btn-primary">Save Changes</button>
                                {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
                            </div>
                        </form>
                    </div>


                    <div class="table-border-bottom-0">
                        @if ($videos)
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
                                        @foreach ($videos as $item)
                                            <tr @if($isEdit && $videoId == $item['id']) style="background-color: #e7fda9;" @endif>
                                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                                <td style="width: 200px; height: 120px;">
                                                    <iframe width="100%" height="100%"
                                                        src="{{ Str::contains($item['link'], 'youtube') ? Str::replace('watch?v=', 'embed/', $item['link']) : $item['link'] }}"
                                                        frameborder="0" allowfullscreen>
                                                    </iframe>
                                                </td>

                                                <td class="fw-semibold text-dark">{{ $item['name'] }}</td>

                                                <td>
                                                    <button class="btn btn-sm btn-warning"
                                                        wire:click="editVideo({{ $item['id'] }})"><i
                                                            class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="Deletevideo({{ $item['id'] }})"><i
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
