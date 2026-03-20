<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />

        </div>
        <div class="col-12 col-lg-9">
            <div class="container ">
                <div class="my-4">
                    <div class=" card shadow-lg border-0 p-5 rounded-4 bg-white">
                        <form class="mb-4" wire:submit.prevent="AddCategory" enctype="multipart/form-data">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="fw-bold text-primary">Product Category</h2>
                            </div>

                            <div class="mb-4">
                                {{-- <label class="form-label fw-semibold text-dark fs-6" for="category">Name</label>
                                --}}
                                <input class="form-control " id="category" type="text" wire:model="name"
                                    placeholder="Enter category name" />
                                <p class="text-danger small mt-1">
                                    @error('name') {{ $message }} @enderror
                                </p>
                            </div>

                            <div class="text-end">
                                <button
                                    class="btn btn-primary fs-8  px-5 py-2 shadow-sm">{{ $isEdit ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>

                        @if ($product_categories)
                            <div class="table-responsive mt-4">
                                <table class="table table-hover align-middle shadow-sm rounded-3 bg-white">
                                    <thead class="bg-gradient text-white">
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_categories as $item)
                                            <tr @if ($isEdit && $productCatId == $item['id']) style="background-color: #e7fda9;" @endif class="hover-highlight">
                                                <td class="text-center w-25">{{ $loop->iteration }}</td>
                                                <td class="text-center w-50 fw-semibold">{{ $item['name'] }}</td>
                                                <td class="text-center w-25">
                                                    <button class="btn btn-sm btn-warning shadow-sm me-2"
                                                        wire:click="editCatname({{ $item['id'] }})"><i
                                                            class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                                                    <button class="btn btn-sm btn-danger shadow-sm"
                                                        wire:click="showDeletePopup({{$item['id']}} , '{{ $item['name'] }}')"><i
                                                            class="fas fa-trash-alt me-2"></i>Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        @if ($showPopup)
                            <div class="custom-popup-overlay d-flex align-items-center justify-content-center"
                                data-aos="zoom-in">
                                <div class=" p-4 rounded shadow-lg bg-white ">
                                    <div class=" text-center">
                                        <div class="delete-icon-container">
                                            <img class="icon-delete" src="../../assets/img/delete.png" alt="Delete Icon">
                                        </div>
                                        <h4 class="mt-3 fw-bold text-danger">Confirm Deletion</h4>
                                    </div>
                                    <div class="popup-body text-center mt-3">
                                        <p class="text-dark fw-semibold" title="{{ $selectedProcatname }}">
                                            {{ Str::limit($selectedProcatname, 10) }}
                                        </p>
                                        <p class="text-muted">Are you sure you want to delete this product?</p>
                                    </div>
                                    <div class="popup-actions d-flex justify-content-between mt-4">
                                        <button class="btn btn-danger flex-grow-1 me-2"
                                            wire:click="DeleteCatname({{ $selectedproductCatId}})">
                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                        </button>
                                        <button class="btn btn-secondary flex-grow-1" wire:click="closePopup()">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <style>
                            .custom-popup-overlay {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background: rgba(0, 0, 0, 0.5);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                z-index: 1050;
                                scroll-behavior: unset;
                            }

                            .custom-popup {
                                width: 380px;
                                border-radius: 10px;
                                padding: 24px;
                            }

                            .delete-icon-container {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                background: rgba(255, 0, 0, 0.1);
                                border-radius: 50%;
                                width: 70px;
                                height: 70px;
                                margin: 0 auto;
                            }

                            .icon-delete {
                                width: 40px;
                            }
                        </style>

                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow"
                                role="alert">
                                <p class="mb-0 fw-semibold">{{ session('error') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow"
                                role="alert">
                                <p class="mb-0 fw-semibold">{{ session('message') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>



        </div>
    </div>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</div>