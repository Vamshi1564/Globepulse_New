<div>
    <livewire:seller.layout.header />

    <!-- Hot Deal Upload Form -->
    <div class="container my-5">
        <div class="content pt-7">
            <div class="card w-75 mx-auto">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0 text-light"> {{ $isEditing ? 'Update Hot Deal' : 'Add New HotDeal' }}</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="{{ $isEditing ? 'updateData' : 'submit' }}" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label fw-semibold">Product Name</label>
                            <select class="form-select" id="productName" wire:model="product_id">
                                <option value="" selected disabled>Choose a product</option>
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Deal Price ($)</label>
                        <input type="number" class="form-control" id="productPrice" placeholder="Enter deal price">
                    </div> --}}

                        <div class="mb-3">
                            <label for="productDescription" class="form-label fw-semibold">Short Description</label>
                            <textarea class="form-control" id="productDescription" rows="3" wire:model="description"
                                placeholder="Write a short description..."></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="endTime" class="form-label fw-semibold">Deal End Time</label>
                            <input type="datetime-local" class="form-control" id="endTime" wire:model="end_time">
                            @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 mt-3">
                                <span wire:loading wire:target="{{ $isEditing ? 'updateData' : 'submit' }}"
                                    class="spinner-border text-light me-2" style="width: 0.9rem; height: 0.9rem;"
                                    role="status" aria-hidden="true"></span>
                                {{ $isEditing ? 'Update Product' : 'Add HotDeal Product' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="rounded-2 mx-n4 mt-4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1"
                style="filter: drop-shadow(0px 0px 1px rgba(88, 88, 88, 0.379))">
                <div class="table-responsive scrollbar mx-n1 px-1">
                    <table class="table fs-9 mb-0">
                        <thead>
                            <tr class="text-center">

                                <th class="sort white-space-nowrap align-middle border-end border-translucent  text-uppercase"
                                    scope="col" data-sort="dealName" style="width:15%;">
                                    No.
                                </th>

                                <th class="sort align-middle border-end border-translucent" scope="col"
                                    data-sort="price" style="width:15%;">Product Name</th>
                                <th class="sort align-middle border-end border-translucent" scope="col"
                                    data-sort="price" style="width:15%;">Description</th>
                                <th class="sort align-middle border-end border-translucent" scope="col"
                                    data-sort="price" style="width:15%;">End Time</th>
                                <th class="sort align-middle border-end border-translucent" scope="col"
                                    data-sort="price" style="width:15%;">Status</th>

                                <th class="align-middle pe-0" scope="col" style="width:15%;">Action</th>

                            </tr>
                        </thead>
                        <tbody class="list text-center" id="products-table-body">
                            @foreach ($dealproducts as $item)
                                <tr class="position-static">

                                    <td
                                        class="dealName align-middle border-end border-translucent white-space-nowrap py-2">
                                        <a class="fw-semibold text-primary" href="#!">{{ $loop->iteration }}</a>
                                    </td>


                                    <td
                                        class="amount align-middle white-space-nowrap border-end border-translucent fw-bold text-body-tertiary py-2">
                                        {{ $item->product->title ?? 'N/a' }}
                                    </td>
                                    <td
                                        class="amount align-middle white-space-nowrap border-end border-translucent fw-bold text-body-tertiary py-2">
                                        {{ $item->description ?? 'N/a' }}
                                    </td>
                                    <td
                                        class="amount align-middle white-space-nowrap border-end border-translucent fw-bold text-body-tertiary py-2">
                                        {{ $item->deal_enddate ? \Carbon\Carbon::parse($item->deal_enddate)->format('d M Y, h:i A') : 'N/A' }}
                                    </td>
                                    <td
                                        class="amount align-middle white-space-nowrap border-end border-translucent fw-bold text-body-tertiary py-2">
                                        @if ($item->status == '2')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($item->status == '0')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>

                                    <td class="align-middle white-space-nowrap action py-2">
                                        <div class="btn-reveal-trigger position-static">
                                            <button
                                                class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2">
                                                <span class="dropdown-item cursor-pointer"
                                                    wire:click="editSlide({{ $item->id }})"
                                                    onclick="scrollToTop()">Edit</span>
                                                <div class="dropdown-divider"></div>
                                                <span class="dropdown-item text-danger cursor-pointer"
                                                    wire:click="deleteDeal({{ $item->id }})">Remove</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    @if ($showPagination)
                        <div class="d-flex justify-content-center align-items-center my-4">
                            @if ($page > 1)
                                <button class="btn btn-sm btn-primary me-2 mb-sm-0"
                                    wire:click="$set('page', {{ $page - 1 }})">&laquo;</button>
                            @endif

                            <!-- Page Numbers -->
                            <div class="d-flex flex-wrap justify-content-center">
                                @php
                                    // Determine the start and end page range
                                    $startPage = max(1, $page - 1); // Start page (1 before current page)
                                    $endPage = min($totalPages, $page + 1); // End page (1 after current page)
                                @endphp

                                <!-- Show Only 2 Pages (Dynamic) -->
                                @if ($page > 2)
                                    <!-- Show 2nd Page -->
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                        wire:click="$set('page', {{ $page - 1 }})">{{ $page - 1 }}</button>
                                @endif

                                <!-- Current Page -->
                                <button class="btn btn-sm btn-primary me-1">{{ $page }}</button>

                                @if ($page < $totalPages - 1)
                                    <!-- Show 3rd Page -->
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                        wire:click="$set('page', {{ $page + 1 }})">{{ $page + 1 }}</button>
                                @endif
                            </div>

                            <!-- Next Button -->
                            @if ($page < $totalPages)
                                <button class="btn btn-sm btn-primary mb-sm-0"
                                    wire:click="$set('page', {{ $page + 1 }})">&raquo;</button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                role="alert" id="alert">
                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>
    <style>
        .card:hover {
            transform: translateY(-3px);
            transition: transform 0.3s ease;
        }
    </style>
    <livewire:seller.layout.footer />

</div>
