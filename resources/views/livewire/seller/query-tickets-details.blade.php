<div>

    <livewire:seller.layout.header />

    <section class="container my-5 py-4">
        <!-- Header -->
        <div class="mb-4 d-flex flex-wrap align-items-center justify-content-between bg-white p-3 rounded-3 gap-2">
            <!-- Title with Icon -->
            <h3 class="fw-bold text-dark mb-0 d-flex align-items-center">
                <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white me-2 shadow-sm"
                    style="width: 42px; height: 42px; transition: all 0.3s ease; font-size:18px;">
                    <i class="bi bi-ticket-detailed"></i>
                </span>
                Ticket Details
            </h3>

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small text-muted">
                    <li class="breadcrumb-item">
                        <a href="{{ route('QueryTickets') }}" class="text-decoration-none text-primary">
                            <i class="bi bi-ticket-detailed me-1"></i> Query-Tickets
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                        Ticket Detail
                    </li>
                </ol>
            </nav>
        </div>


        <!-- Ticket Card -->
        <div class="card border-0 shadow-sm mb-5 rounded-4 transition-all hover-shadow">
            <div
                class="card-header bg-body border border-1 border-light d-flex justify-content-between align-items-center flex-wrap gap-3 p-4">
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge bg-primary-subtle text-primary fs-8">
                        <i class="bi bi-ticket-detailed me-1"></i>
                        {{ $ticketDetail->ticket_number ?? 'N/A' }}
                    </span>

                </div>

                <span class="badge bg-light text-dark border">
                    <i class="bi bi-calendar me-1"></i>
                    {{ $ticketDetail->created_at->format('M j, Y') }}
                </span>

                <!-- Priority -->
                {{-- @php
                    $priority = strtolower($ticketDetail->TicketPriority->name ?? 'N/A');
                    $priorityColor = match ($priority) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'success',
                        default => 'secondary',
                    };
                @endphp
                <span class="badge bg-{{ $priorityColor }}-subtle text-{{ $priorityColor }} fw-semibold px-4 py-2">
                    {{ ucfirst($priority) }} Priority
                </span> --}}
            </div>

            <div class="card-body p-4">
                <!-- Assigned Staff and Project -->
                <div
                    class="d-flex flex-wrap align-items-center justify-content-between mb-4 p-3 gap-3 bg-light-subtle rounded-3 shadow-sm">

                    <!-- Left: Assigned Staff -->
                    <div class="d-flex flex-column me-4">
                        <div class="d-flex align-items-center mb-1">
                            <!-- Profile Icon -->
                            <span
                                class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                style="width:40px; height:40px; font-weight:600; font-size:16px;"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $ticketDetail->staff->firstname ?? '' }} {{ $ticketDetail->staff->lastname ?? '' }}">
                                {{ strtoupper(substr($ticketDetail->staff->firstname ?? 'U', 0, 1) . substr($ticketDetail->staff->lastname ?? '', 0, 1)) }}
                            </span>

                            <div class="d-flex flex-column">
                                <small class="text-muted">Assigned to</small>
                                <div class="text-dark fs-8">
                                    {{ $ticketDetail->staff->firstname ?? 'Unassigned' }}
                                    {{ $ticketDetail->staff->lastname ?? '' }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Middle: Project -->
                    <div class="d-flex flex-column me-auto">
                        <div class="d-flex align-items-center mb-1">
                            <span
                                class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                style="width:40px; height:40px; font-weight:600; font-size:16px;">
                                <i class="bi bi-briefcase"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <small class="text-muted">Project</small>
                                <div class="text-dark fs-8">{{ $project_name }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Created At -->
                    <div class="text-end">
                        <small class="text-muted"><i class="bi bi-clock me-1"></i>Created:
                            {{ date('h:i A', strtotime($ticketDetail->create_at)) }}</small>
                    </div>

                </div>


                <hr />

                <!-- Description -->
                <h5 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-file-text me-1 text-primary"></i> Description
                </h5>
                <div class="bg-light rounded-3 p-4 border-start border-primary border-4">
                    <p class="mb-0 text-dark lh-base fs-9 fw-semibold text-justify">{{ $ticketDetail->description }}</p>
                </div>
            </div>
        </div>

        <!-- Ticket Replies -->
        <div
            class="d-flex flex-wrap bg-light-subtle shadow-sm px-3 py-3 rounded-3 align-items-center justify-content-between mb-3">
            <h5 class="fw-bold text-dark">
                <i class="bi bi-chat-left-text me-2 text-primary"></i>
                <span class="bg-primary-subtle text-primary fw-medium rounded-pill fw-bold p-2"> Ticket Replies </span>
            </h5>
            <span
                class="badge bg-primary-subtle text-primary fw-medium rounded-pill fw-bold p-2 fs-8">{{ count($ticketReply) }}</span>
        </div>

        @forelse ($ticketReply as $reply)
            <div class="card border-0 shadow-sm mb-3 rounded-4 bg-white transition-all hover-shadow">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start mb-3 mb-md-4">
                        <!-- Avatar -->
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-0 me-md-3 mb-2 mb-md-0 shadow-sm"
                            style="width: 40px; height: 40px; font-size: 16px; font-weight: 600; min-width: 40px;">
                            {{ strtoupper(substr($reply->staffs->firstname ?? 'U', 0, 1)) . substr($reply->staffs->lastname ?? '', 0, 1) }}
                        </div>

                        <!-- Reply Content -->
                        <div class="w-100">
                            <!-- Name + Date -->
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-start mb-1">
                                <h6 class="fw-semibold text-dark mb-1 mb-md-0">
                                    {{ $reply->staffs->firstname ?? 'Unknown' }} {{ $reply->staffs->lastname ?? '' }}
                                </h6>
                                <small class="mt-1 small text-muted">
                                    {{ \Carbon\Carbon::parse($reply->date)->format('M j, Y \a\t g:i A') }}
                                </small>
                            </div>

                            <!-- Reply Bubble -->
                            <div class="bg-primary-subtle rounded-3 p-2 p-md-3 shadow-sm position-relative mt-2">
                                <p class="mb-0 text-dark lh-base fs-9 fw-semibold text-justify">
                                    {!! nl2br(e($reply->description)) !!}
                                </p>
                                <span
                                    class="position-absolute top-0 end-0 translate-middle-y bg-primary-subtle rounded-circle p-1"
                                    style="width: 20px; height: 20px; opacity: 0.7;">
                                    <i class="bi bi-chat-dots-fill text-primary" style="font-size: 0.85rem;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-light rounded-4">
                <i class="bi bi-chat-left-text fs-4 text-muted"></i>
                <p class="text-muted mt-3 fw-semibold">No staff replies yet.</p>
            </div>
        @endforelse

    </section>

    <style>
        .transition-all {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .avatar {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .lh-base {
            line-height: 1.6;
        }
    </style>

    <livewire:seller.layout.footer />

</div>
