{{-- <div>
    <livewire:seller.layout.header />
    <div class="content p-0 m-0">
        <div class="container-fluid">
   

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap justify-content-between mb-3">
                <div class="col-11 mx-auto mb-3 mb-md-0 col-md-4 col-lg-3">
                    <div class="bg-white shadow rounded-4 p-3 h-100 sticky-top" style="top: 1rem;">
                        <h6 class="text-center mb-3">My Package List</h6>
                        <div class="nav flex-column " id="projectTabs" role="tablist"
                            aria-orientation="vertical">
                            @foreach ($projects as $project)
                                <button class="nav-link text-start mb-2 border rounded-3 {{ $loop->first ? 'active' : '' }}"
                                    id="tab-{{ $project->id }}" data-bs-toggle="pill"
                                    data-bs-target="#project-{{ $project->id }}" type="button" role="tab"
                                    aria-controls="project-{{ $project->id }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    <div class="fw-semibold text-truncate">{{ $project->name }}</div>
                                    <small class="text-muted d-block">📅
                                        {{ \Carbon\Carbon::parse($project->project_created)->format('M d, Y') }}</small>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="container-fluid">
                        <div class="tab-content" id="projectTabsContent">
                            @foreach ($projects as $project)
                                                            @php $relatedTasks = $tasks->where('rel_id', $project->id);
    
                                                            @endphp

                                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                                id="project-{{ $project->id }}" role="tabpanel"
                                                                aria-labelledby="tab-{{ $project->id }}">

                                                                <div
                                                                    class="card border-0 shadow mb-5 rounded-4 project-info-card position-relative overflow-hidden">
                                                                    <div class="card-body p-4 bg-white rounded-4">
                                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                                            <div>
                                                                                <h4 class="fw-bold text-primary mb-1">{{ $project->name }}</h4>
                                                                                <small class="text-muted">Created on
                                                                                    {{ \Carbon\Carbon::parse($project->project_created)->format('F j, Y') }}</small>
                                                                            </div>
                                                                            <span class="badge rounded-pill px-3 py-2 fs-8 bg-light {{$this->getStatusName($project->status)['badge'] }}">
                                                                                {{$this->getStatusName($project->status)['name'] }}
                                                                            </span>
                                                                        </div>

                                                                        @if ($relatedTasks->isNotEmpty())
                                                                            <div class="row g-3">
                                                                                @foreach ($relatedTasks as $item)
                                                                                    @php $statusInfo = $this->getStatusName($item->status);
                                                                                    @endphp
                                                                                    <div class="col-md-6">
                                                                                        <div
                                                                                            class="card task-card border-0 shadow-sm rounded-3 p-3 d-flex flex-column h-100 bg-light task-card-hover">
                                                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                                                <h6 class="fw-semibold mb-0">{{ $item->name }}</h6>
                                                                                                <span class="badge rounded {{ $statusInfo['badge'] }} bg-light">
                                                                                                    {{ $statusInfo['name'] }}
                                                                                                </span>
                                                                                            </div>
                                                                                            <small class="text-muted">Added on
                                                                                                {{ \Carbon\Carbon::parse($item->dateadded)->format('F j, Y') }}</small>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @else
                                                                            <div class="text-center text-muted fst-italic mt-4">No tasks found for this
                                                                                project.
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>
                            @endforeach
                        </div>

                    </div>
                    <style>
                        .task-card-hover {
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        }

                        .task-card-hover:hover {
                            transform: translateY(-4px);
                            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
                        }

                        .project-info-card {
                            transition: border 0.3s ease;
                            border-left: 5px solid #0d6efd;
                        }

                        .project-info-card:hover {
                            border-left-color: #198754;
                        }
                    </style>
                </div>
            </div>
    </div>
</div>
<livewire:seller.layout.footer />

</div> --}}








<div>
    <livewire:seller.layout.header />
    {{-- <div class="content p-0 m-0">
        <div class="container-fluid">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap justify-content-between mb-3">
                <div class="col-11 mx-auto mb-3 mb-md-0 col-md-4 col-lg-3">
                    <div class="bg-white shadow rounded-4 p-3 h-100 sticky-top" style="top: 1rem;">
                        <h6 class="text-center mb-3">My Package List</h6>
                        <div class="nav flex-column" id="projectTabs" role="tablist" aria-orientation="vertical">
                            @foreach ($projects as $project)
                                <button class="nav-link text-start mb-2 border rounded-3 {{ $loop->first ? 'active' : '' }}"
                                    id="tab-{{ $project->id }}" data-bs-toggle="pill"
                                    data-bs-target="#project-{{ $project->id }}" type="button" role="tab"
                                    aria-controls="project-{{ $project->id }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    <div class="fw-semibold text-truncate">{{ $project->name }}</div>
                                    <small class="text-muted d-block">📅
                                        {{ \Carbon\Carbon::parse($project->project_created)->format('M d, Y') }}</small>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="container-fluid">
                        <div class="tab-content" id="projectTabsContent">
                            @foreach ($projects as $project)
                                @php
    $relatedTasks = $tasks->where('rel_id', $project->id);
                                @endphp

                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="project-{{ $project->id }}" role="tabpanel"
                                    aria-labelledby="tab-{{ $project->id }}">

                                    <div
                                        class="card border-0 shadow mb-5 rounded-4 project-info-card position-relative overflow-hidden">
                                        <div class="card-body p-4 bg-white rounded-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <h4 class="fw-bold text-primary mb-1">{{ $project->name }}</h4>
                                                    <small class="text-muted">Created on
                                                        {{ \Carbon\Carbon::parse($project->project_created)->format('F j, Y') }}</small>
                                                </div>
                                                <span
                                                    class="badge rounded-pill px-3 py-2 fs-8 bg-light {{ $this->getStatusName($project->status)['badge'] }}">
                                                    {{ $this->getStatusName($project->status)['name'] }}
                                                </span>
                                            </div>

                                        
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>








                        <div class="bg-primary  p-3 fw-bolder rounded d-flex flex-wrap justify-content-between">
                            <h4 class="text-white m-0 p-0">Welcome Process</h4>
                            <span class="badge rounded-pill px-2 py-1 fs-9 bg-light {{ $this->getStatusName($project->status)['badge'] }}">
                                {{ $this->getStatusName($project->status)['name'] }}
                            </span>
                        </div>

                        <div class="timeline-grid">

                            <div class="col-6">
                                <div class="mx-2 bg-white rounded shadow-sm p-3 mt-3">
                                    <h3>Training Section</h3>
                                    <div class="step progress1 active-line">
                                        Training
                                        <span class="date">1.5 Months</span>
                                        <span class="status progress1">Status: In progress1</span>
                                    </div>
                                    <div class="step pending cutoff-line">
                                        Review
                                        <span class="status pending">Status: Not Started</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mx-2 bg-white rounded shadow-sm p-3 mt-3">

                                    <h3>Documents</h3>
                                    @if ($relatedTasks->isNotEmpty())
                                        @foreach ($relatedTasks as $item)
                                                                                        @php
                                                    $statusInfo = $this->getStatusName($item->status);
                                                    $statusName = strtolower(trim($statusInfo['name']));
                                                    $date = $item->dateadded ? \Carbon\Carbon::parse($item->dateadded)->format('d-m-Y') : null;

                                                    $statusClass = ($statusName === 'completed') ? 'done' : str_replace(' ', '', $statusName);

                                                    $stepClass = match ($statusName) {
                                                        'complete', 'done' => 'step done active-line',
                                                        'in progress', 'progress1', 'progress2' => 'step progress1 active-line',
                                                        default => 'step pending cutoff-line',
                                                    };
                                                    
                                                                                        @endphp
                                           
                                                                                        <div class="{{ $stepClass }}">
                                                                                            {{ $item->name }}
                                                                                            <span class="date">{{ $date }}</span>
                                                                                            <span class="status {{ $statusClass }}">
                                                                                                Status: {{ $statusInfo['name'] }}
                                                                                            </span>
                                                                                        </div>
                                        @endforeach
                                    @else
                                        <div class="text-center text-muted fst-italic mt-4">No tasks found for this project.</div>
                                    @endif
                                
                                
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mx-2 bg-white rounded shadow-sm p-3 mt-3">

                                    <h3>B2B Social Media</h3>
                                    <div class="step done active-line">
                                        Social Media
                                        <span class=" status done">Status: Done</span>
                                    </div>
                                    <div class="step done active-line">
                                        Website
                                        <span class="status done">Status: Done</span>
                                    </div>
                                    <div class="step progress1 active-line">
                                        Domain
                                        <span class="status progress1">Status: In progress1</span>
                                    </div>
                                    <div class="step pending cutoff-line">
                                        Website Live
                                        <span class="status pending">Status: Not Started</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mx-2 bg-white rounded shadow-sm p-3 mt-3">

                                    <h3>Details</h3>
                                    <div class="step done active-line">
                                        Details
                                        <span class="status done">Status: Done</span>
                                    </div>
                                    <div class="step done active-line">
                                        Documents
                                        <span class="status done">Status: Done</span>
                                    </div>
                                </div>
                            </div>

                        </div>





                    </div>

                </div>

            </div>
        </div>

        <style>
          
        </style>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div> --}}

    <div class="content p-0 m-0">
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '>>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap justify-content-between mb-3">
                <!-- Left Side Project Tabs -->
                <div class="col-11 mx-auto mb-3 mb-md-0 col-md-4 col-lg-3">
                    {{-- <div class="bg-white shadow rounded-4 p-3 h-100 sticky-top" style="top: 1rem;">
                        <h6 class="text-center mb-3">My Package List</h6>
                        <div class="nav flex-column" id="projectTabs" role="tablist" aria-orientation="vertical">
                            @foreach ($projects as $project)
                                <button
                                    class="nav-link text-start mb-2 border rounded-3 {{ $loop->first ? 'active' : '' }}"
                                    id="tab-{{ $project->id }}" data-bs-toggle="pill"
                                    data-bs-target="#project-{{ $project->id }}" type="button" role="tab"
                                    aria-controls="project-{{ $project->id }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    <div class="fw-semibold text-truncate">{{ $project->name }}</div>
                                    <small class="text-muted d-block">📅
                                        {{ \Carbon\Carbon::parse($project->project_created)->format('M d, Y') }}</small>
                                </button>
                            @endforeach
                        </div>
                    </div> --}}
                    <div class="bg-white shadow rounded-4 p-3 h-100 sticky-top" style="top: 1rem;">
                        <h6 class="text-center mb-3">My Package List</h6>
                        <div class="nav flex-column" id="projectTabs" role="tablist" aria-orientation="vertical">
                            @foreach ($projects as $project)
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <button
                                        class="nav-link text-start flex-grow-1 border rounded-3 {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ $project->id }}" data-bs-toggle="pill"
                                        data-bs-target="#project-{{ $project->id }}" type="button" role="tab"
                                        aria-controls="project-{{ $project->id }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <div class="fw-semibold text-truncate">{{ $project->name }}</div>
                                        <small class="text-muted d-block">📅
                                            {{ \Carbon\Carbon::parse($project->project_created)->format('M d, Y') }}</small>
                                    </button>

                                    <!-- Add Ticket Button -->
                                    <button class="btn btn-sm btn-primary ms-2 p-2 fs-10" data-bs-toggle="modal"
                                        data-bs-target="#verticallyCentered222"
                                        wire:click="$set('project_id', {{ $project->id }})"
                                        wire:click="$set('project_name', '{{ $project->name }}')"
                                        data-bs-placement="top"
                                        data-bs-title="Raise a query or complaint for project tasks">
                                        <i class="fas fa-plus"></i> Add Ticket
                                    </button>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-title]'))
                            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                                return new bootstrap.Tooltip(tooltipTriggerEl)
                            })
                        });
                    </script>


                </div>

                {{-- //ticket-model --}}
                <div class="modal fade" id="verticallyCentered222" tabindex="-1"
                    aria-labelledby="verticallyCenteredModalLabel222" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title text-white" id="verticallyCenteredModalLabel222">Add Ticket
                                    @if ($project_name)
                                        <span class="badge bg-light text-dark ms-2">{{ $project_name }}</span>
                                    @endif
                                </h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="ticketSave">
                                    <input type="hidden" wire:model="project_id">

                                    <div class="mb-3">
                                        <label class="form-label">Select Task Title</label>
                                        <select class="form-select" wire:model="selectedTaskTitle">
                                            <option value="">-- Select Task --</option>
                                            @foreach ($tasklist as $task)
                                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ticket Description</label>
                                        <textarea rows="3" class="form-control" placeholder="Add Question" wire:model="description"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-outline-secondary" type="button"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-warning" data-bs-dismiss="modal" type="submit">Save
                                            Ticket</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END Ticket form --}}

                <!-- Right Side Project Details -->
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="container-fluid">
                        <div class="tab-content" id="projectTabsContent">
                            @foreach ($projects as $project)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="project-{{ $project->id }}" role="tabpanel"
                                    aria-labelledby="tab-{{ $project->id }}">

                                    <!-- Project Header -->
                                    <div
                                        class="card border-0 shadow mb-5 rounded-4 project-info-card position-relative overflow-hidden">
                                        <div class="card-body p-4 bg-white rounded-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <h4 class="fw-bold text-primary mb-1">{{ $project->name }}</h4>
                                                    <small class="text-muted">Created on
                                                        {{ \Carbon\Carbon::parse($project->project_created)->format('F j, Y') }}</small>
                                                </div>
                                                {{-- <span
                                                    class="badge rounded-pill px-3 py-2 fs-8 bg-light {{ $this->getStatusName($project->status)['badge'] }}">
                                                    {{ $this->getStatusName($project->status)['name'] }}
                                                </span> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Timeline Sections -->
                                    <div class="timeline-grid">
                                        @foreach ($tasksByProject[$project->id] as $section => $tasks)
                                            @php
                                                $sectionTitle = match ($section) {
                                                    'training' => 'Training Section',
                                                    'documents' => 'Documents',
                                                    'b2b_social_media' => 'B2B Social Media',
                                                    'details' => 'Details',
                                                    default => ucfirst($section),
                                                };
                                            @endphp
                                            <div class="col-6">
                                                <div class="mx-2 bg-white rounded shadow-sm p-3 mt-3">
                                                    <h3>{{ $sectionTitle }}</h3>
                                                    @if ($tasks->isNotEmpty())
                                                        @foreach ($tasks as $item)
                                                            @php
                                                                $statusInfo = $this->getStatusName($item->status);
                                                                $statusName = strtolower(trim($statusInfo['name']));
                                                                $date = $item->dateadded
                                                                    ? \Carbon\Carbon::parse($item->dateadded)->format(
                                                                        'd-m-Y',
                                                                    )
                                                                    : null;

                                                                $statusClass =
                                                                    $statusName === 'completed'
                                                                        ? 'done'
                                                                        : str_replace(' ', '', $statusName);
                                                                $stepClass = match ($statusName) {
                                                                    'complete', 'done' => 'step done active-line',
                                                                    'in progress',
                                                                    'progress1',
                                                                    'progress2'
                                                                        => 'step progress1 active-line',
                                                                    default => 'step pending cutoff-line',
                                                                };
                                                            @endphp

                                                            <div class="{{ $stepClass }}">
                                                                {{ $item->name }}
                                                                <span class="date">{{ $date }}</span>
                                                                <span class="status {{ $statusClass }}">
                                                                    Status:
                                                                    {{ $statusInfo['name'] === 'Deactive' ? 'Inactive' : $statusInfo['name'] }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="text-center text-muted fst-italic mt-4">No tasks
                                                            found</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>



    <style>
        .timeline-grid {
            display: flex;
            flex-wrap: wrap;
            /* gap: 40px; */
            justify-content: center;
        }

        .col-6 {
            /* flex: 1 1 260px; */
            /* background: #fff; */
            /* padding: 20px; */
            /* border-radius: 12px; */
            /* position: relative; */
            /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); */
        }

        .col-6 h3 {
            background: #ffeaa7;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .step {
            position: relative;
            padding: 12px 10px;
            border-radius: 6px;
            margin-bottom: 40px;
            background: #eee;
            border-left: 6px solid #bbb;
            transition: all 0.3s ease;
        }

        .step.done {
            background: #d1f5d3 !important;
            border-left-color: #3498db !important;
        }

        .step.progress1 {
            background: #fff3cd;
            border-left-color: #e67e22;
        }

        .step.pending {
            background: #f8f9fa;
            border-left-color: #bbb;
        }

        .step .date,
        .step .status {
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        .status.done {
            color: #2e86de !important;
        }

        .status.progress1 {
            color: #e67e22;
        }

        .status.pending {
            color: #7f8c8d;
        }

        /* Timeline Lines */
        .step::after {
            content: '';
            position: absolute;
            left: 11px;
            top: 100%;
            width: 4px;
            height: 40px;
            background-color: transparent;
        }

        .step.active-line::after {
            background-color: #3498db;
        }

        .step.progress1-line::after {
            background-color: #e67e22;
        }

        .step.cutoff-line::after {
            background-color: #ccc;
        }

        .step:last-child::after {
            display: none;
        }

        @media (max-width: 768px) {
            .timeline-grid {
                flex-direction: column;
                gap: 30px;
            }
        }
    </style>





    <livewire:seller.layout.footer />
</div>
