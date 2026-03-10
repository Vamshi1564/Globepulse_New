<div>
    <livewire:seller.layout.header />

    <div class="container-fluid">
        <div class="content p-0 m-0 ">

            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-resources') }}">My
                            Resources</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Product Reports</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto">
                    <h2 class="mb-2">Product Reports</h2>
                </div>
            </div>
            <div class="row g-3">
                @foreach ($proreport as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-1 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <p class="mb-0 text-dark fw-bold"><i
                                        class="fas fa-file-alt text-muted me-2"></i>{{ $item->title }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">

                                    <span class="badge bg-light text-dark fw-semibold rounded-pill px-3">
                                        #{{ $loop->iteration }}
                                    </span>
                                    {{-- <a wire:click.prevent="download('{{ $item->link }}')"
                                        class="btn btn-sm text-light bg-primary">
                                        <i class="fas fa-download me-1"></i>Download
                                    </a> --}}
                                    <a href="{{ config('app.pub_aws_url') . $item->link }}" download
                                        class="btn btn-sm text-light bg-primary">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <style>
                .card:hover {
                    transform: translateY(-2px);
                    transition: all 0.3s ease-in-out;
                    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.07);
                }
            </style>

            {{-- <div class="d-flex justify-content-end align-items-center my-2">
                <button wire:click="prevPageProduct" class="btn btn-sm btn-outline-primary"
                    {{ $productPage == 1 ? 'disabled' : '' }}>
                    Previous
                </button>
                <span class="mx-2">Page {{ $productPage }}</span>
                <button wire:click="nextPageProduct" class="btn btn-sm btn-outline-primary"
                    {{ $productPage * $productPerPage >= $totalProductRecords ? 'disabled' : '' }}>
                    Next
                </button>
            </div> --}}
            <div class="mt-3">
                {{-- {{ $CustomerList->links('pagination::bootstrap-5', ['class' => 'pagination-sm']) }}
                                --}}
                <div class="d-none d-md-block">
                    {{ $proreport->links('pagination::bootstrap-5') }}
                </div>
                <!-- Smaller pagination for mobile screens -->
                <div class="d-md-none">
                    {{ $proreport->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>
    <livewire:seller.layout.footer />

</div>
