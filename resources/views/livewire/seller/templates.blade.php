<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content m-0 p-0">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-resources') }}">My
                            Resources</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Email Templates</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Email Templates</h2>
                </div>
            </div>
            <style>
                .card-hover {
                    transition: 0.3s ease;
                }

                .card-hover:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 0.75rem 1.25rem rgba(0, 0, 0, 0.08);
                }
            </style>

            <div class="row g-4 mb-5">
                @foreach ($templates as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-1 rounded-4 h-100 card-hover">
                            <div class="card-body d-flex flex-column justify-content-between p-4">
                                <h5 class="fw-semibold text-dark mb-0">
                                    {{ $item->title }}
                                </h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        #{{ $loop->iteration }}
                                    </span>
                                    <a wire:click.prevent="download('{{ $item->link }}')"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($showPagination)
                <div class="d-flex justify-content-center align-items-center my-4 flex-wrap gap-2">
                    @if ($page > 1)
                        <button class="btn btn-sm btn-primary" wire:click="$set('page', {{ $page - 1 }})">&laquo;</button>
                    @endif
                    @php
                        $startPage = max(1, $page - 1);
                        $endPage = min($totalPages, $page + 1);
                    @endphp
                    @if ($page > 2)
                        <button class="btn btn-sm btn-outline-primary"
                            wire:click="$set('page', {{ $page - 1 }})">{{ $page - 1 }}</button>
                    @endif
                    <button class="btn btn-sm btn-primary">{{ $page }}</button>
                    @if ($page < $totalPages - 1)
                        <button class="btn btn-sm btn-outline-primary"
                            wire:click="$set('page', {{ $page + 1 }})">{{ $page + 1 }}</button>
                    @endif
                    @if ($page < $totalPages)
                        <button class="btn btn-sm btn-primary" wire:click="$set('page', {{ $page + 1 }})">&raquo;</button>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <livewire:seller.layout.footer />
</div>