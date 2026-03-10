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
                    <li class="breadcrumb-item active" aria-current="page">SocialMediaTradeGroup</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Social Media Trade Group</h2>
                </div>
            </div>
            <style>
                .effect:hover {
                    transform: translateY(-4px);
                    transition: all 0.3s ease-in-out;
                }
            </style>

            <div class="row g-4">
                @foreach ($SocialMedia as $contact)
                    <div class="col-md-6 col-xl-4 effect">
                        <div class="card shadow-sm border-0 h-100 hover-shadow transition rounded-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge bg-info-subtle text-dark px-3 py-2 rounded-pill">
                                        {{ $contact->group_type }}
                                    </span>
                                    <span class="text-muted small bg-light px-3 py-1 rounded">#{{ $loop->iteration }}</span>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ $contact->group_name }}</h5>
                                <p class="mb-0">
                                    <a href="{{ $contact->group_link }}" target="_blank" class="text-decoration-none">
                                        <span class="badge bg-light text-primary d-inline-flex align-items-center">
                                            <i class="fa-solid fa-link me-2 text-primary"></i>
                                            {{ Str::limit($contact->group_link, 40) ?? 'N/A' }}
                                        </span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($showPagination)
                <div class="d-flex justify-content-center align-items-center mt-4">
                    @if ($page > 1)
                        <button class="btn btn-outline-secondary rounded-pill me-2"
                            wire:click="$set('page', {{ $page - 1 }})">&laquo;</button>
                    @endif

                    <div class="d-flex flex-wrap gap-2">
                        @php
                            $startPage = max(1, $page - 1);
                            $endPage = min($totalPages, $page + 1);
                        @endphp

                        @if ($page > 2)
                            <button class="btn btn-outline-primary rounded-pill"
                                wire:click="$set('page', {{ $page - 1 }})">{{ $page - 1 }}</button>
                        @endif

                        <button class="btn btn-primary rounded-pill">{{ $page }}</button>

                        @if ($page < $totalPages - 1)
                            <button class="btn btn-outline-primary rounded-pill"
                                wire:click="$set('page', {{ $page + 1 }})">{{ $page + 1 }}</button>
                        @endif
                    </div>

                    @if ($page < $totalPages)
                        <button class="btn btn-outline-secondary rounded-pill ms-2"
                            wire:click="$set('page', {{ $page + 1 }})">&raquo;</button>
                    @endif
                </div>
            @endif

        </div>
    </div>
    <livewire:seller.layout.footer />
</div>