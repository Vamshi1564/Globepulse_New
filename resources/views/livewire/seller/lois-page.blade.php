<div>
    <livewire:seller.layout.header />

    <div class="content m-0 p-0">
        <div class="container-fluid mb-5">
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>

                    <li class="breadcrumb-item active" aria-current="page">LOis List</li>
                </ol>
            </nav>
            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">LOis List</h2>
                </div>
            </div>

            <div class="row g-3">
                @forelse ($documents as $document)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 h-100 rounded-4">
                            <div class="card-body p-4">
                                <h5 class="fw-semibold mb-0">
                                    <i class="fas fa-file-alt  me-2"></i>
                                    {{ $document->documents->doc_name ?? 'Untitled' }}
                                </h5>
                                <div class="d-flex justify-content-between align-items-start mt-3">

                                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                        Document #{{ $loop->iteration }}
                                    </span>
                                    <a href="https://team.gfeworld.org/customer_doc/{{ $document->doc_link }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary rounded-pill d-flex align-items-center">
                                        <i class="fas fa-download me-2"></i> Download
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class=" alert-warning text-center rounded-3">
                            No documents available.
                        </div>
                    </div>
                @endforelse
            </div>



            <style>
                .card:hover {
                    transform: translateY(-2px);
                    transition: 0.3s ease-in-out;
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
                }
            </style>
        </div>
    </div>
    <livewire:seller.layout.footer />
</div>