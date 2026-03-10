<div>

    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container">
                <div class="my-4">
                    <div class="card shadow-lg border-0 rounded-4 p-5 bg-white">
                        <h2 class="mb-4 text-primary">Upload Your Logo</h2>

                        @if (!empty($customerlogo) && is_string($customerlogo))
                            <div class="mb-4 text-center">
                                <img class="w-25 h-25 rounded-circle shadow"
                                    src="{{ config('api.web_base_url') . '/assets/img/customers/logo/' . $customerlogo }}"
                                    alt="Logo" style="max-width: 150px; max-height: 150px;">
                            </div>
                        @else
                            <p class="text-muted">No logo uploaded yet.</p>
                        @endif

                        <form class="mt-4" wire:submit.prevent="submit" enctype="multipart/form-data">
                            <div class="border border-dashed rounded-4 p-4 bg-white shadow-sm position-relative"
                                id="dropzone">
                                <div class="mb-2">
                                    @if ($logo)
                                        <img class="w-25 rounded shadow" src="{{ $logo->temporaryUrl() }}">
                                    @endif
                                </div>
                                <p class="text-muted">Drag & Drop your logo here or click to upload</p>
                                <input name="logo" type="file" wire:model="logo"
                                    class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer">
                            </div>
                            <p class="text-danger fs-9 mt-2">
                                @error('logo')
                                    {{ $message }}
                                @enderror
                            </p>
                            {{-- <button class="btn btn-primary fs-8 mt-3 px-5 py-2 shadow-sm">Submit</button> --}}

                            <div class="text-center mt-4">
                                <button class="btn btn-primary fs-8 px-5 py-2 shadow-sm">Submit</button>
                            </div>
                        </form>
                    </div>

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow"
                            role="alert">
                            <p class="mb-0 fw-semibold">{{ session('error') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow"
                            role="alert">
                            <p class="mb-0 fw-semibold">{{ session('message') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>

</div>
