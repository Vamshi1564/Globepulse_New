<div>

    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content pt-4 px-0">
            <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}"><i class="bi bi-house-door me-1"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active">Query-Tickets</li>
                </ol>
            </nav>

            <div class="py-3">
                <div class="row align-items-center px-3 py-3 bg-white rounded-3 shadow-sm g-3 g-sm-0">

                    <!-- Left: Icon + Title -->
                    <div class="col-md-4 d-flex align-items-center gap-2">
                        <div class="d-flex bg-danger-subtle align-items-center px-2 py-1 bg-info-subtle rounded me-2">
                            <i class="bi bi-person-exclamation text-danger-dark fs-6"></i>
                        </div>
                        <h3 class="fw-bold text-body mb-0">Query Tickets</h3>
                    </div>

                    <!-- Middle: Search -->
                    <div class="col-md-4">
                        <form wire:submit.prevent="searchStaff">
                            <div class="position-relative">
                                <input type="text" wire:model.live="search"
                                    class="form-control form-control-sm shadow-sm" placeholder="🔍 Search tickets...">
                            </div>
                        </form>
                    </div>

                    <!-- Right: Row per Page -->
                    <div class="col-md-4 d-flex justify-content-md-end align-items-center gap-2">
                        <label for="entriesSelect" class="mb-0 text-muted small">Rows per page:</label>
                        <select class="form-select form-select-sm shadow-sm w-auto" id="entriesSelect"
                            wire:model="taskPerPage" wire:change="changePerPage" wire:loading.attr="disabled">
                            @foreach ($perPageOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>


            <div class="card rounded shadow-sm border p-3">
                <div class="table-responsive scrollbar mx-n1 px-1">
                    <table class="table fs-9 mb-0 leads-table">
                        <thead>
                            <tr>
                                <th class="sort white-space-nowrap text-center align-middle text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:5%; min-width:70px;">
                                    ID
                                </th>
                                <th class="sort white-space-nowrap align-middle text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:17%; min-width:170px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-info-subtle rounded me-2">
                                            <span class=" uil uil-file-shield-alt fs-8"></span>
                                        </div>
                                        <span>Ticket Title</span>
                                    </div>
                                </th>
                                <th class="sort white-space-nowrap align-middle text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:15%; min-width:150px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-info-subtle rounded me-2">
                                            <span class="text-secondary-dark bi bi-people fs-8"></span>
                                        </div>
                                        <span>Customer</span>
                                    </div>
                                </th>

                                <th class="sort white-space-nowrap align-middle text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:15%; min-width:150px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-info-subtle rounded me-2">
                                            <span class="text-secondary-dark bi bi-diagram-3 fs-8"></span>
                                        </div>
                                        <span>Project Name</span>
                                    </div>
                                </th>

                                {{-- <th class="sort white-space-nowrap align-middle pe-0 ps-2 text-uppercase border-end border-translucent"
                                    scope="col" data-sort="priority" style="width:10%; min-width:130px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-danger-subtle rounded me-2">
                                            <i class="bi bi-exclamation-circle text-danger fs-8"></i>
                                        </div>
                                        <span>Priority</span>
                                    </div>
                                </th> --}}
                                <th class="sort white-space-nowrap align-middle pe-0 ps-2 text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:10%; min-width:130px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-success-subtle rounded me-2">
                                            <span class="text-success-dark uil uil-check-circle fs-8"></span>
                                        </div>
                                        <span>Status</span>
                                    </div>
                                </th>

                                {{-- <th class="sort white-space-nowrap align-middle text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:13%; min-width: 130px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-warning-subtle rounded me-2">
                                            <i class="text-warning-dark fa-solid fa-user-tie fs-8"></i>

                                        </div>
                                        <span>Manager</span>
                                    </div>
                                </th>

                                <th class="sort white-space-nowrap align-middle text-uppercase border-end border-translucent"
                                    scope="col" data-sort="name" style="width:13%; min-width: 130px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-warning-subtle rounded me-2">
                                            <span class="text-warning-dark uil uil-user-plus fs-8"></span>

                                        </div>
                                        <span>Assign</span>
                                    </div>
                                </th> --}}
                                <th class="sort align-middle ps-2 pe-0 text-uppercase" scope="col" data-sort="date"
                                    style="width:13%; min-width:130px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-success-subtle rounded me-2">
                                            <span class="text-success-dark uil uil-calendar-alt fs-8"></span>
                                        </div>
                                        <span>Create Date</span>
                                    </div>
                                </th>
                                {{-- <th class="sort align-middle ps-2 pe-0 text-uppercase border-end border-translucent"
                                    scope="col" data-sort="date" style="width:13%; min-width:130px;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-danger-subtle rounded me-2">
                                            <span class="text-danger-dark uil uil-calendar-slash fs-8"></span>
                                        </div>
                                        <span>End Date</span>
                                    </div>
                                </th> --}}
                                {{-- <th class="text-center white-space-nowrap align-middle pe-0 ps-2 text-uppercase "
                                    style="width:10%;">
                                    <div class="d-inline-flex flex-center">
                                        <div class="d-flex align-items-center px-1 py-1 bg-primary-subtle rounded me-2">
                                            <span class="text-primary-dark">
                                                <i class="uil uil-setting fs-8"></i>
                                            </span>
                                        </div>
                                        <span>Actions</span>
                                    </div>
                                </th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td class="text-muted text-center border-end border-translucent">
                                        {{-- <input class="form-check-input" type="checkbox"> --}}
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="contact align-middle white-space-nowrap ps-4 border-end border-translucent fw-semibold text-body-highlight">
                                        <div>
                                            <a href="{{ route('QueryTicketsDetails', ['id' => $ticket->id]) }}"
                                                class="text-dark fw-semibold fs-8" target="_blank">
                                                {{ $ticket->tasks->name ?? 'N/A' }}
                                            </a>
                                        </div>
                                        <div class="badge bg-primary-subtle text-primary">
                                            {{ $ticket->ticket_number }}
                                        </div>
                                    </td>

                                    <td
                                        class="name align-middle white-space-nowrap text-dark fw-semibold border-end border-translucent">
                                        {{ $ticket->customer->name ?? 'N/A' }}
                                    </td>

                                    <td
                                        class="name align-middle white-space-nowrap text-dark fw-semibold border-end border-translucent">
                                        {{ $ticket->project?->name ?? 'N/A' }}
                                    </td>

                                    {{-- <td class="align-middle white-space-nowrap pe-0 ps-3 border-end border-translucent">
                                        <span
                                            class="badge fs-10 fw-bold
        @if (strtolower($ticket->TicketPriority?->name) === 'high') bg-danger
        @elseif(strtolower($ticket->TicketPriority?->name) === 'medium') bg-warning
        @elseif(strtolower($ticket->TicketPriority?->name) === 'low') bg-success
        @else bg-secondary @endif">

                                            @if (strtolower($ticket->TicketPriority?->name) === 'high')
                                                <i class="fas fa-arrow-up me-1"></i>
                                            @elseif(strtolower($ticket->TicketPriority?->name) === 'medium')
                                                <i class="fas fa-arrow-right me-1"></i>
                                            @elseif(strtolower($ticket->TicketPriority?->name) === 'low')
                                                <i class="fas fa-arrow-down me-1"></i>
                                            @else
                                                <i class="fas fa-ellipsis-h me-1"></i>
                                            @endif

                                            {{ ucfirst($ticket->TicketPriority?->name ?? 'N/A') }}
                                        </span>
                                    </td> --}}


                                    <td class="align-middle white-space-nowrap pe-0 ps-3 border-end border-translucent">
                                        <span
                                            class="badge badge-phoenix
        @if (strtolower($ticket->TicketStatuses?->name) === 'open') badge-phoenix-info
        @elseif(strtolower($ticket->TicketStatuses?->name) === 'reopened') badge-phoenix-warning
        @elseif(strtolower($ticket->TicketStatuses?->name) === 'close') badge-phoenix-success
        @else badge-phoenix-secondary @endif">

                                            <span class="badge-label align-top fw-bold">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->TicketStatuses?->name ?? 'N/A')) }}
                                            </span>

                                            <span class="ms-1">
                                                @if (strtolower($ticket->TicketStatuses?->name) === 'open')
                                                    <i class="uil-folder-open" style="font-size:0.85rem;"></i>
                                                @elseif(strtolower($ticket->TicketStatuses?->name) === 'reopened')
                                                    <i class="uil-history" style="font-size:0.85rem;"></i>
                                                @elseif(strtolower($ticket->TicketStatuses?->name) === 'close')
                                                    <i class="uil-check-circle" style="font-size:0.85rem;"></i>
                                                @else
                                                    <i class="bi bi-three-dots" style="font-size:0.85rem;"></i>
                                                @endif
                                            </span>
                                        </span>
                                    </td>


                                    {{-- <td
                                        class="name align-middle white-space-nowrap pe-0 ps-3 text-dark fw-semibold border-end border-translucent">
                                        @php
                                            $firstInitial = strtoupper(
                                                substr($ticket->ExclamationManager?->firstname ?? '', 0, 1),
                                            );
                                            $lastInitial = strtoupper(
                                                substr($ticket->ExclamationManager?->lastname ?? '', 0, 1),
                                            );
                                            $initials = $firstInitial . $lastInitial;
                                        @endphp

                                        @if ($ticket->ExclamationManager)
                                            <div class="rounded-circle bg-dark-blue text-white fw-bold d-flex align-items-center cursor-default justify-content-center me-2"
                                                style="width:28px; height:28px; font-size:0.65rem;"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $ticket->ExclamationManager->firstname }} {{ $ticket->ExclamationManager->lastname }}">
                                                {{ $initials }}
                                            </div>
                                        @else
                                            <div class="rounded-circle bg-secondary text-white fw-bold d-flex align-items-center cursor-default justify-content-center me-2"
                                                style="width:28px; height:28px; font-size:0.65rem;"
                                                title="No Manager">
                                                --
                                            </div>
                                        @endif

                                    </td>

                                    <td
                                        class="name align-middle white-space-nowrap pe-0 ps-3 fw-semibold border-end border-translucent">
                                        <div class="d-flex align-items-center">
                                            @php
                                                $firstInitial = strtoupper(
                                                    substr($ticket->staff?->firstname ?? '', 0, 1),
                                                );
                                                $lastInitial = strtoupper(
                                                    substr($ticket->staff?->lastname ?? '', 0, 1),
                                                );
                                                $initials = $firstInitial . $lastInitial;
                                            @endphp

                                            @if ($ticket->staff)
                                                <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center cursor-default justify-content-center me-2"
                                                    style="width:28px; height:28px; font-size:0.65rem;"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $ticket->staff->firstname }} {{ $ticket->staff->lastname }}">
                                                    {{ $initials }}
                                                </div>
                                            @else
                                                <div class="rounded-circle bg-secondary text-white fw-bold d-flex align-items-center cursor-default justify-content-center me-2"
                                                    style="width:28px; height:28px; font-size:0.65rem;"
                                                    title="No Staff Assigned">
                                                    --
                                                </div>
                                            @endif

                                        </div>
                                    </td> --}}

                                    <td
                                        class="date align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4 text-body-tertiary  fs-9 fw-semibold">
                                        {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, h:i A') ?? 'N/A' }}
                                    </td>
                                    {{-- <td
                                            class="date align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4 text-body-tertiary border-end border-translucent fs-9 fw-semibold">
                                            {{ \Carbon\Carbon::parse($ticket->end_date)->format('Y-m-d') ?? 'N/A' }}
                                        </td> --}}

                                    {{-- <td class="name align-middle white-space-nowrap text-center">
                                        <button
                                            onclick="event.preventDefault();
        updateChatActiveStatus('{{ $ticket->customer?->id ?? '' }}').then(() => {
            localStorage.setItem('receiver_id', '{{ $ticket->customer?->id ?? '' }}');
            localStorage.setItem('receiver_name', '{{ $ticket->customer?->name ?? 'New User' }}');
            window.open('{{ route('chat') }}', '_blank');
        });"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa-solid fa-comments"></i>
                                        </button>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        No tickets found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-0 shadow-sm py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        {{-- Showing X to Y of Z --}}
                        <div class="text-muted small mb-2 mb-md-0">
                            <span class="fw-semibold text-dark">
                                Showing {{ ($taskPage - 1) * $taskPerPage + 1 }}
                                – {{ min($taskPage * $taskPerPage, $totalTaskRecords) }}
                            </span>
                            of <span class="fw-bold text-primary">{{ $totalTaskRecords }}</span> tickets
                        </div>

                        {{-- Pagination Controls --}}
                        <nav>
                            <ul class="pagination mb-0 gap-1">

                                @php
                                    $totalPages = ceil($totalTaskRecords / $taskPerPage);
                                    $startPage = max(1, $taskPage - 2);
                                    $endPage = min($totalPages, $taskPage + 2);
                                @endphp

                                <!-- Prev -->
                                <li class="page-item {{ $taskPage == 1 ? 'disabled' : '' }}">
                                    <button wire:click.prevent="prevPageTask"
                                        class="page-link border-0 rounded-pill px-3 shadow-sm {{ $taskPage == 1 ? 'bg-light text-muted' : 'bg-primary text-white' }}">
                                        &laquo; Prev
                                    </button>
                                </li>

                                <!-- First -->
                                @if ($startPage > 1)
                                    <li class="page-item">
                                        <button wire:click.prevent="goToPage(1)"
                                            class="page-link border-0 rounded-pill px-3 shadow-sm {{ $taskPage == 1 ? 'bg-primary text-white' : 'bg-light text-dark' }}"
                                            wire:key="page-1">1</button>
                                    </li>
                                    @if ($startPage > 2)
                                        <li class="page-item disabled"><span
                                                class="page-link border-0 bg-white">...</span></li>
                                    @endif
                                @endif

                                <!-- Middle Pages -->
                                @for ($i = $startPage; $i <= $endPage; $i++)
                                    <li class="page-item">
                                        <button wire:click.prevent="goToPage({{ $i }})"
                                            class="page-link border-0 rounded-pill px-3 shadow-sm fw-bold 
                            {{ $taskPage == $i ? 'bg-primary text-white' : 'bg-light text-dark' }}"
                                            wire:key="page-{{ $i }}">
                                            {{ $i }}
                                        </button>
                                    </li>
                                @endfor

                                <!-- Last -->
                                @if ($endPage < $totalPages)
                                    @if ($endPage < $totalPages - 1)
                                        <li class="page-item disabled"><span
                                                class="page-link border-0 bg-white">...</span></li>
                                    @endif
                                    <li class="page-item">
                                        <button wire:click.prevent="goToPage({{ $totalPages }})"
                                            class="page-link border-0 rounded-pill px-3 shadow-sm 
                            {{ $taskPage == $totalPages ? 'bg-primary text-white' : 'bg-light text-dark' }}"
                                            wire:key="page-{{ $totalPages }}">{{ $totalPages }}</button>
                                    </li>
                                @endif

                                <!-- Next -->
                                <li class="page-item {{ $taskPage >= $totalPages ? 'disabled' : '' }}">
                                    <button wire:click.prevent="nextPageTask"
                                        class="page-link border-0 rounded-pill px-3 shadow-sm {{ $taskPage >= $totalPages ? 'bg-light text-muted' : 'bg-primary text-white' }}">
                                        Next &raquo;
                                    </button>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script>
        // chat icons add redirect to Hr-chat
        async function updateChatActiveStatus(chatId) {
            if (!chatId) return;

            try {
                const response = await fetch('{{ config('app.erp_base_url') }}chat_active_update.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        chatId: chatId
                    })
                });

                if (!response.ok) {
                    console.error('Failed to update chat active status');
                }
            } catch (error) {
                console.error('Error updating chat active status:', error);
            }
        }
    </script>

    <livewire:seller.layout.footer />

</div>
