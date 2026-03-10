{{-- <div class="container mt-4">
    <h4 class="mb-3">V-Card List</h4>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Sr. No.</th>
                <th>Card Preview</th>
                <th>V-Card Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><img src="{{ asset('assets/img/bg/CARD1.jpg') }}" alt="Card 1"
                        style="height: 100px; border: 1px solid #ddd;"></td>
                <td>V-Card Type 1</td>
                <td>
                    <!-- "Eye" icon for viewing the vCard -->
                    <a href="#" wire:click.prevent="generateVCard('style1')" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><img src="{{ asset('assets/img/bg/CARD2.jpg') }}" alt="Card 2"
                        style="height: 100px; border: 1px solid #ddd;"></td>
                <td>V-Card Type 2</td>
                <td>
                    <a href="#" wire:click.prevent="generateVCard('style2')" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td><img src="{{ asset('assets/img/bg/CARD3.jpg') }}" alt="Card 3"
                        style="height: 100px; border: 1px solid #ddd;"></td>
                <td>V-Card Type 3</td>
                <td>
                    <a href="#" wire:click.prevent="generateVCard('style3')" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td><img src="{{ asset('assets/img/bg/CARD4.jpg') }}" alt="Card 4"
                        style="height: 100px; border: 1px solid #ddd;"></td>
                <td>V-Card Type 4</td>
                <td>
                    <a href="#" wire:click.prevent="generateVCard('style4')" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td><img src="{{ asset('assets/img/bg/CARD5.jpg') }}" alt="Card 5"
                        style="height: 100px; border: 1px solid #ddd;"></td>
                <td>V-Card Type 5</td>
                <td>
                    <a href="#" wire:click.prevent="generateVCard('style5')" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div> --}}

<div>
    <livewire:seller.layout.header />

    <div class="container px-4 py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold text-primary">V-Card Templates</h4>
                    {{-- <div class="d-flex">
                        <input type="text" class="form-control form-control-sm me-2" placeholder="Search templates..."
                            style="max-width: 200px;">
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div> --}}
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width: 5%; min-width: 70px;">#</th>
                                <th style="width: 15%; min-width: 150px;">Template Name</th>
                                <th style="width: 15%; min-width: 150px;">Template Preview</th>
                                <th class="text-center" style="width: 15%; min-width: 150px;">Actions</th>
                                {{-- <th style="width: 200px;"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cardTypes as $index => $card)
                                <tr class="border-top">
                                    <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <h6 class="mb-1">{{ ucfirst($card['type']) }} Template</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative me-3" style="width: 120px; height: 80px;">
                                                <img src="{{ asset('assets/img/bg/' . $card['image']) }}"
                                                    class="rounded border shadow-sm w-100 h-100 object-fit-cover"
                                                    alt="{{ $card['type'] }} template">
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary position-absolute bottom-0 end-0 m-1 small">
                                                    {{ ucfirst($card['type']) }}
                                                </span>
                                            </div>
                                            {{-- <div>
                                                <h6 class="mb-1">{{ ucfirst($card['type']) }} Template</h6>
                                                <p class="small text-muted mb-0">Design ID:
                                                    {{ ucfirst($card['type']) }}</p>
                                            </div> --}}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('v-card', ['leadId' => $leadId, 'type' => $card['type']]) }}"
                                                target="_blank" class="btn btn-outline-primary rounded-start">
                                                <i class="fas fa-eye me-1"></i> Preview
                                            </a>
                                            <button type="button"
                                                wire:click.prevent="downloadVCard('{{ $card['type'] }}', '{{ $leadId }}')"
                                                class="btn btn-outline-success rounded-end">
                                                <i class="fas fa-download me-1"></i> Download
                                            </button>
                                        </div>
                                    </td>
                                    {{-- <td>
                                        <div class="dropdown float-end me-3">
                                            <button class="btn btn-sm btn-light rounded-circle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="fas fa-share-alt me-2"></i>Share</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="fas fa-link me-2"></i>Get Link</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="fas fa-trash-alt me-2"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing <span class="fw-bold">1</span> to <span class="fw-bold">{{ count($cardTypes) }}</span>
                        of
                        {{ count($cardTypes) }} templates
                    </div>
                    {{-- <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.03);
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .card {
            border-radius: 0.75rem;
        }

        .dropdown-menu {
            border-radius: 0.5rem;
        }
    </style>

    <livewire:seller.layout.footer />
</div>
