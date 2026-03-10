<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content m-0 p-0">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('opportunities') }}">Opportunities</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">POs List</li>
                </ol>
            </nav>
            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">POs List</h2>
                </div>
            </div>
            <div class="row g-3">
                @forelse ($documents as $document)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-1 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <h5 class="mb-2  fw-bold">
                                    <i class="fas fa-file-alt text-secondary me-2"></i>
                                    {{ $document->documents->doc_name ?? 'Untitled' }}
                                </h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge bg-light text-dark fw-semibold px-3 py-2 rounded-pill">
                                        Document #{{ $loop->iteration }}
                                    </span>
                                    <a href="https://team.gfeworld.org/customer_doc/{{ $document->doc_link }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>



                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class=" alert-warning text-center rounded-3">
                            No documents found.
                        </div>
                    </div>
                @endforelse
            </div>
            <style>
                .card:hover {
                    transform: translateY(-2px);
                    transition: all 0.3s ease-in-out;
                    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
                }
            </style>

        </div>
    </div>
    <livewire:seller.layout.footer />

</div>