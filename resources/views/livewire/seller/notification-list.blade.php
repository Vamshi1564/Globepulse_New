<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content p-0 m-0">
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('opportunities') }}">Opportunities</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Notification List</li>
                </ol>
            </nav>
            <div class="mb-5">
                <div class="row g-3 mb-4">
                    <div class="col-auto">
                        <h2 class="mb-0">Notification List</h2>
                    </div>
                </div>

                @if ($notifications->isNotEmpty())
                    <div class="row g-3">
                        @foreach ($notifications as $item)
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card border-0 shadow-sm rounded-3 h-100 {{ $item->read_status == 1 ? '' : 'bg-light' }}">
                                    <div class="card-body d-flex flex-column justify-content-between p-3 h-100">

                                        <!-- Title & Time -->
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-semibold text-dark mb-0"
                                                style="font-size: 0.95rem; line-height: 1.3;">
                                                <i class="fas fa-bell me-2 text-warning"></i>{{ $item->title }}
                                            </h6>
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                {{-- {{ $item->created_at->diffForHumans(['parts' => 2]) }} --}}
                                                {{ $item->created_at ? $item->created_at->diffForHumans(['parts' => 2]) : '' }}
                                            </small>
                                        </div>

                                        <!-- Status & Button -->
                                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                                            <span
                                                class="badge bg-secondary-subtle text-dark fw-normal rounded-pill px-2 py-1"
                                                style="font-size: 0.75rem;">
                                                Notification #{{ $loop->iteration }}
                                            </span>

                                            <button
                                                wire:click="markAsRead('{{ $item->type }}', {{ $item->source_id }})"
                                                class="btn btn-xs btn-outline-primary px-2 py-1 rounded-pill"
                                                style="font-size: 0.75rem; line-height: 1;">
                                                View
                                            </button>
                                        </div>

                                        <!-- Read/Unread Status -->
                                        <!-- Status Dot Only -->
                                        <div class="mt-2">
                                            <span class="badge rounded-circle bg-light border"
                                                style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
                                                {{-- @if ($item->read_status == 1)
                                                    <i class="fa-solid fa-circle text-danger"
                                                        style="font-size: 6px;"></i> Unread dot
                                                @else
                                                    <i class="fa-solid fa-check text-success"
                                                        style="font-size: 10px;"></i> Read check
                                                @endif --}}

                                                @if ($item->type === 'client')
                                                    @if ($item->read_status == 1)
                                                        <i class="fa-solid fa-circle text-danger"
                                                            style="font-size: 6px;"></i>
                                                    @else
                                                        <i class="fa-solid fa-check text-success"
                                                            style="font-size: 10px;"></i>
                                                    @endif
                                                @endif

                                                {{-- 🔹 Trigger / Group notification --}}
                                                @if ($item->type === 'trigger')
                                                    @if ($item->read_status == 1)
                                                        <i class="fa-solid fa-circle text-danger"
                                                            style="font-size: 6px;"></i>
                                                    @else
                                                        <i class="fa-solid fa-check text-success"
                                                            style="font-size: 10px;"></i>
                                                    @endif
                                                @endif
                                            </span>

                                        </div>


                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class=" alert-warning text-center rounded-3 mt-5">
                        No Notification found.
                    </div>
                @endif
            </div>
            <style>
                .card:hover {
                    transform: translateY(-4px);
                    transition: 0.3s ease-in-out;
                    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.08);
                }
            </style>
        </div>
    </div>
    <livewire:seller.layout.footer />

</div>
