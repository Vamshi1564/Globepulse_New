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
                    <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-5">
                <div class="col-auto d-flex align-items-center gap-2">
                    <h2 class="mb-0 fw-bold">Frequently Asked Questions</h2>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($Faqs as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card faq-card shadow-sm border-0 rounded-4 transition-all hover-shadow">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start mb-2 bg-light p-2">
                                    <div class="badge bg-white text-dark rounded-pill me-2">
                                        {{ $loop->iteration }}
                                    </div>
                                    <h6 class="fw-bold text-primary mb-0">
                                        {{ Str::limit($item->faqs_que, 80) }}
                                    </h6>
                                </div>
                                <div class="text-muted small mb-2">
                                    {{ Str::limit($item->faqs_ans, 120) }}
                                </div>
                                <button class="btn btn-sm btn-outline-primary rounded-pill mt-2" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapse{{ $loop->iteration }}">
                                    View Full Answer
                                </button>
                                <div class="collapse mt-3" id="faqCollapse{{ $loop->iteration }}">
                                    <div class="text-dark small">
                                        {{ $item->faqs_ans }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <style>
                .faq-card {
                    transition: all 0.3s ease-in-out;
                }

                .faq-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
                }
            </style>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $Faqs->onFirstPage() ? 'disabled' : '' }}">
                        <button wire:click="gotoPage(1)" class="page-link">«</button>
                    </li>
                    <li class="page-item {{ $Faqs->onFirstPage() ? 'disabled' : '' }}">
                        <button wire:click="previousPage" class="page-link">‹</button>
                    </li>

                    @php
                        $current = $Faqs->currentPage();
                        $last = $Faqs->lastPage();

                        if ($last <= 3) {
                            $start = 1;
                            $end = $last;
                        } else {
                            if ($current <= 2) {
                                $start = 1;
                                $end = 3;
                            } elseif ($current >= $last - 1) {
                                $start = $last - 2;
                                $end = $last;
                            } else {
                                $start = $current - 1;
                                $end = $current + 1;
                            }
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            $active = $i == $current ? 'active' : '';
                            echo "<li class='page-item $active'><button wire:click=\"gotoPage($i)\" class='page-link'>$i</button></li>";
                        }
                    @endphp

                    <li class="page-item {{ $Faqs->hasMorePages() ? '' : 'disabled' }}">
                        <button wire:click="nextPage" class="page-link">›</button>
                    </li>
                    <li class="page-item {{ $Faqs->currentPage() == $Faqs->lastPage() ? 'disabled' : '' }}">
                        <button wire:click="gotoPage({{ $Faqs->lastPage() }})" class="page-link">»</button>
                    </li>
                </ul>
            </nav>


        </div>
    </div>
    <livewire:seller.layout.footer />
</div>