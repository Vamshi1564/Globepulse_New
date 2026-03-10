<div>
    <livewire:seller.layout.header />

    <div class="container px-4 py-4">
        <nav class="mb-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Letter Heads List</li>
            </ol>
        </nav>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold text-primary">Latter-Head Templates</h4>
                    {{-- <div class="d-flex">
                        <input type="text" class="form-control form-control-sm me-2" placeholder="Search templates..."
                            style="max-width: 200px;">
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div> --}}

                    <div>
                        <a class="btn btn-sm btn-warning bg-light text-black" href="{{ route('latter-head-form') }}">
                            <div class="dropdown-item-wrapper">Latter Head Form</div>
                        </a>
                    </div>
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
                            @foreach ($letterHeadTypes as $index => $template)
                                <tr class="border-top">
                                    <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <h6 class="mb-1">{{ ucfirst($template['type']) }} Template</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative me-3" style="width: 120px; height: 80px;">
                                                <img src="{{ asset('assets/img/bg/' . $template['image']) }}"
                                                    alt="Letterhead Preview"
                                                    class="rounded border shadow-sm w-100 h-100">
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary position-absolute bottom-0 end-0 m-1 small">
                                                    {{ ucfirst($template['type']) }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{-- <div class="btn-group btn-group-sm" role="group"> --}}
                                        @if ($letterHeadData)
                                            <a href="{{ route('latter-head', ['id' => $customerId, 'type' => $template['type']]) }}"
                                                target="_blank" class="btn btn-outline-primary rounded-start">
                                                <i class="fas fa-eye me-1"></i> Preview
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                                class="btn btn-outline-primary rounded-start disabled"
                                                aria-disabled="true">
                                                <i class="fas fa-eye me-1"></i> Preview
                                            </a>
                                        @endif
                                        {{-- <button type="button"
                                                wire:click.prevent="downloadLetterhead('{{ $template['type'] }}')"
                                                class="btn btn-outline-success rounded-end">
                                                <i class="fas fa-download me-1"></i> Download
                                            </button> --}}
                                        {{-- </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing <span class="fw-bold">1</span> to <span class="fw-bold">{{ count($cardTypes) }}</span>
                        of
                        {{ count($cardTypes) }} templates
                    </div>
                    <nav>
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
                    </nav>
                </div>
            </div> --}}
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
