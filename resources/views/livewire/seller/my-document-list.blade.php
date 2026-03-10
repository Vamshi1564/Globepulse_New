<div>
    <livewire:seller.layout.header />
    <div class="content p-0 m-0">

        <div class="container-fluid mb-5">


            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-package') }}">My
                            Package</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">My Digi Locker</li>
                </ol>
            </nav>
            <div class="row gx-3 flex-between-end mb-4">
                <div class="col-auto">
                    <h2 class="mb-2 fw-bold ">My Documents List</h2>
                </div>
            </div>

            <div class="row g-3">
                @forelse ($documents as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-1 h-100 rounded-4">
                            <div class="card-body p-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                                    <h5 class="fw-semibold mb-3 text-dark">
                                        <i class="fas fa-file-alt me-2 text-secondary"></i>
                                        {{ $item->documents->doc_name }}
                                    </h5>

                                    <div>
                                        @if ($item->documents->sample_doc_link)
                                            {{-- @php
                                                $ext = strtolower(
                                                    pathinfo($item->documents->sample_doc_link, PATHINFO_EXTENSION),
                                                );
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                            @endphp --}}
                                            @php
                                                $url = null;

                                                if (!empty($item->documents->sample_doc_link)) {
                                                    $url = Storage::disk('s3')->temporaryUrl(
                                                        'private/customer_doc/' . $item->documents->sample_doc_link,
                                                        now()->addMinutes(1),
                                                    );

                                                    $ext = strtolower(
                                                        pathinfo($item->documents->sample_doc_link, PATHINFO_EXTENSION),
                                                    );

                                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                }
                                            @endphp


                                            @if (in_array($ext, $imageExtensions))
                                                {{-- Show image preview with tooltip --}}
                                                <a href="{{ $url }}" target="_blank" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Sample Document">
                                                    <img src="{{ $url }}" alt="Sample Document"
                                                        class="img-thumbnail" style="max-width: 120px;">
                                                </a>
                                            @else
                                                {{-- Show file icon with tooltip --}}
                                                <a href="{{ $url }}" target="_blank"
                                                    class="d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Sample Document">
                                                    @if ($ext == 'pdf')
                                                        <i
                                                            class="bi bi-file-earmark-pdf-fill text-danger fs-3 me-2"></i>
                                                    @elseif (in_array($ext, ['doc', 'docx']))
                                                        <i
                                                            class="bi bi-file-earmark-word-fill text-primary fs-3 me-2"></i>
                                                    @elseif (in_array($ext, ['xls', 'xlsx']))
                                                        <i
                                                            class="bi bi-file-earmark-excel-fill text-success fs-3 me-2"></i>
                                                    @else
                                                        <i class="bi bi-file-earmark-fill text-secondary fs-3 me-2"></i>
                                                    @endif
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                                            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                                                return new bootstrap.Tooltip(tooltipTriggerEl)
                                            })
                                        });
                                    </script>

                                </div>

                                {{-- <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-light text-dark px-3 py-2 fs-9 rounded-pill">
                                        Document #{{ $loop->iteration }}
                                    </span>
                                    <a target="_blank"
                                        href="https://team.gfeworld.org/customer_doc/{{ $item->doc_link }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill d-flex align-items-center">
                                        <i class="fas fa-download me-2"></i> Download
                                    </a>
                                </div> --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-light text-dark px-3 py-2 fs-9 rounded-pill">
                                        Document #{{ $loop->iteration }}
                                    </span>

                                    @if ($item->doc_link)
                                        {{-- ✅ Normal download if file exists --}}
                                        <a target="_blank" href="{{ config('app.priv_aws_url') . $item->doc_link }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill d-flex align-items-center">
                                            <i class="fas fa-download me-2"></i> Download
                                        </a>
                                    @else
                                        {{-- ❌ No file → show alert --}}
                                        <button type="button" onclick="alert('File not available for download!')"
                                            class="btn btn-sm btn-outline-secondary rounded-pill d-flex align-items-center">
                                            <i class="fas fa-ban me-2"></i> Download
                                        </button>
                                    @endif
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
