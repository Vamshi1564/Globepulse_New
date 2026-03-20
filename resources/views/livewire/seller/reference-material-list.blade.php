<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content p-0 m-0">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-resources') }}">My
                            Resources</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Reference Material List</li>
                </ol>
            </nav>

            <div class=" mb-5 bg-white p-3 rounded">
                <h2 class="fw-bold  d-flex align-items-center">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 me-2 rounded">
                        <i class="fas fa-book"></i>
                    </span>
                    Reference Material List
                </h2>

            </div>
            <div class=" row g-3">
                @forelse ($materials as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div
                            class="card border-top border-bottom border-3 border-primary rounded-4 shadow-sm custom-doc-card h-100">
                            <div class="card-body p-4">

                                <div class="d-flex align-items-start">
                                    <div class="icon-box rounded-3 bg-primary bg-opacity-10 p-2 me-3 col-2">
                                        <img class="w-100" src="../../assets/img/seller-dashboard-icons/attachment.png"
                                            alt="">
                                    </div>

                                    <div class="flex-grow-1 ">
                                        <h5 class="fw-bold text-dark mb-1">{{ $item->title }}</h5>
                                        <small class="text-muted">Document #{{ $loop->iteration }}</small>
                                    </div>
                                </div>

                                <div class="border-top my-3"></div>

                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- <span
                                        class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2 rounded-pill">
                                        #{{ $loop->iteration }}
                                    </span> --}}

                                    <a wire:click.prevent="download('{{ $item->link }}')"
                                        class="btn btn-primary btn-sm rounded-pill w-100 px-3 shadow-sm">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>

                            </div>
                        </div>

                        <style>
                            .custom-doc-card {
                                transition: 0.3s ease;
                                border-left: none !important;
                                border-right: none !important;
                            }

                            .custom-doc-card:hover {
                                transform: translateY(-4px);
                                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
                            }

                            .icon-box {
                                width: 65px;
                                height: 65px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }
                        </style>

                    </div>

                    {{-- <style>
                        .doc-card {
                            transition: all 0.3s ease;
                            background: #ffffff;
                        }

                        .doc-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.12);
                        }

                        .icon-wrap {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                    </style> --}}

                @empty
                    <div class="col-12 text-center">
                        <h5 class="text-danger mt-4">No materials found.</h5>
                    </div>
                @endforelse
            </div>

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
                            $startPage = max(1, $page - 1);
                            $endPage = min($totalPages, $page + 1);
                        @endphp

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
        <style>
            .hover-shadow:hover {
                transform: translateY(-5px);
                box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.08);
            }

            .transition-300 {
                transition: all 0.3s ease-in-out;
            }
        </style>

    </div>
    <livewire:seller.layout.footer />

</div>