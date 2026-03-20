<div>

    <livewire:seller.layout.header />



    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .popup-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
        }
    </style>


    <div class="container-fluid my-4">
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 p-3 border-bottom ">
            <div>
                <h3 class="mb-1 fw-bold text-primary">Suppliers and Importers</h3>
            </div>
            <button class="btn btn-primary btn-sm px-4 py-2 mt-3 mt-md-0" wire:click="openModal()">
                <i class="fas fa-plus me-2"></i>Add Detail
            </button>
        </div>


        <!-- Table -->
        <div class="table-responsive  shadow-sm rounded-3">
            <table class="table  table-hover align-middle fs-9 mb-0 ">
                <thead class="bg-primary text-uppercase text-center">
                    <tr class="text-center">
                        <th class="sort text-white white-space-nowrap align-middle border-end border-translucent text-uppercase"
                            scope="col" style="width:15%;">No.</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Company Name</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Profile</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:18%; min-width: 180px;">
                            Contact Person / Owner</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Contact No. 1</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Contact No. 2</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:20%; min-width: 200px;">
                            Email</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Remarks 1</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Remarks 2</th>
                        <th class="sort align-middle text-white border-end border-translucent" scope="col"
                            style="width:15%; min-width: 150px;">
                            Date</th>
                        <th class="align-middle text-white pe-0" scope="col" style="width:5%; min-width: 100px;">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="list text-center" id="products-table-body">
                    @foreach ($data as $item)
                        <tr class="position-static">
                            <td class="align-middle border-end border-translucent white-space-nowrap py-2">
                                <a class="fw-semibold text-primary" href="#!">{{ $loop->iteration }}</a>
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->company_name ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->profile ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->contact_person_owner ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->contact_no_1 ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->contact_no_2 ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->email ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->remarks_1 ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ $item->remarks_2 ?? 'N/A' }}
                            </td>
                            <td class="align-middle border-end border-translucent fw-bold text-body-tertiary py-2">
                                {{ \Carbon\Carbon::parse($item->dateadded)->format('d-M-Y') ?? 'N/A' }}
                            </td>
                            <td class="align-middle white-space-nowrap action py-2">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent">
                                        <span class="fas fa-ellipsis-h fs-10"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <span class="dropdown-item cursor-pointer" wire:click="editSupp({{ $item->id }})"
                                            onclick="scrollToTop()">Edit</span>
                                        <div class="dropdown-divider"></div>
                                        <span class="dropdown-item text-danger cursor-pointer"
                                            wire:click="deleteSupp({{ $item->id }})">Remove</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-end">
            @if ($showPagination)
                <div class="mt-4 flex justify-center items-center space-x-4">
                    <button wire:click="$set('page', {{ max(1, $currentPage - 1) }})" class="px-3 py-1 btn border rounded"
                        @if ($currentPage === 1) disabled @endif>
                        Previous
                    </button>

                    <span class="fs-9">Page {{ $currentPage }} of {{ $totalPages }}</span>

                    <button wire:click="$set('page', {{ min($totalPages, $currentPage + 1) }})"
                        class="px-3 py-1 btn border rounded" @if ($currentPage === $totalPages) disabled @endif>
                        Next
                    </button>
                </div>
            @endif
        </div>

    </div>

    <!-- Popup Form -->
    @if ($isModalOpen)
        <div class="popup-overlay" id="popupForm">
            <div class="popup-form">
                {{-- <form id="detailForm" wire:submit.prevent="{{ $isEditing ? 'updateData' : 'addData' }}"> --}}
                    <form id="detailForm" @if ($isEditing) wire:submit.prevent="updateData" @else
                    wire:submit.prevent="addData" @endif>
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-8 text-center">
                                <h3 class="fw-bold text-primary">
                                    {{ $isEditing ? 'Update Verify Buyers' : 'Add Verify Buyers' }}
                                </h3>
                                <hr class="mx-auto my-3" style="width: 100px; border-top: 2px solid #0d6efd;">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Company Name" wire:model="company_name"
                                    required>
                                @error('company_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Profile" wire:model="profile" required>
                                @error('profile')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Contact Person / Owner"
                                    wire:model="contact_person_owner" required>
                                @error('contact_person_owner')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Contact No. 1"
                                    wire:model="contact_no_1" required>
                                @error('contact_no_1')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Contact No. 2"
                                    wire:model="contact_no_2" required>
                                @error('contact_no_2')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" wire:model="email" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Remarks 1" wire:model="remarks_1"
                                    required>
                                @error('remarks_1')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Remarks 2" wire:model="remarks_2"
                                    required>
                                @error('remarks_2')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button class="btn btn-primary px-5 py-2 fw-semibold" type="submit">
                                <i class="fas fa-save me-2"></i>{{ $isEditing ? 'Update' : 'Add' }} SuppliersImporters
                            </button>
                            <button type="button" class="btn btn-secondary"
                                wire:click="$set('isModalOpen', false)">Cancel</button>
                        </div>
                    </form>
            </div>
        </div>
    @endif
    <div class="col-12 col-sm-12 col-lg-12 col-xl-8">

        @if (session()->has('message'))
            <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                role="alert" id="alert">
                <span class="fas fa-check-circle text-success fs-7 me-3"></span>
                <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <livewire:seller.layout.footer />

</div>