<div>
    <livewire:seller.layout.header />

    <div class="container-fluid my-5">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb rounded  py-2">
                <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('my-products') }}">My Products</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Distribution Inquiries</li>
            </ol>
        </nav>
    </div>


    <!-- Form -->
    <div class="bg-white py-5 ">
        <div class="container-fluid ">
            <form class="mb-5" wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="mb-4">
                    <h2 class="fw-bold mb-0">Distribution Inquiries</h2>
                </div>


            </form>

            <style>
                .flag {
                    width: 24px;
                    /* height: 16px; */
                }
            </style>

            <!-- Buyers Cards -->
            {{-- @if ($verifyBuyers && $verifyBuyers->isNotEmpty()) --}}
            <div class="row g-4">
                @forelse($distributions as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-2 bg-light p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <h5 class="fw-bold">
                                    {{ $item->name ?? 'N/A' }}
                                </h5>
                                <div class="flag-container fs-9 ms-2 d-flex">
                                    @if (!empty($item->countrymodel->flag_img))
                                        <img src="{{ asset('assets/' . $item->countrymodel->flag_img) }}"
                                            alt="{{ $item->countrymodel->short_name }}" class="flag-shadow"
                                            width="24">
                                    @endif
                                    <span class="ms-2 fs-9">{{ $item->countrymodel->short_name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="rounded-2 my-2">
                                <p class="fs-8 mb-2">
                                    <strong>Product Name :</strong>
                                    <span>{{ $item->product->title ?? 'N/A' }}</span>
                                </p>

                                <p class="fs-8 mb-0"><strong>Message :</strong></p>
                                <span>{{ $item->message }}</span>
                            </div>

                            <div class="contact-info mt-2">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-circle bg-success text-white me-2">
                                        <i class="fas fa-envelope fa-sm"></i>
                                    </div>
                                    <span class="fs-8">{{ $item->email ?? 'N/A' }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle bg-info text-white me-2">
                                        <i class="fas fa-phone fa-sm"></i>
                                    </div>
                                    <span class="fs-8">{{ $item->phone_number ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No distribution data found.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-3 d-flex justify-content-end">
                <nav>
                    <ul class="pagination">
                        <li class="page-item {{ $distributions->onFirstPage() ? 'disabled' : '' }}">
                            <button wire:click="gotoPage(1)" class="page-link">«</button>
                        </li>

                        <li class="page-item {{ $distributions->onFirstPage() ? 'disabled' : '' }}">
                            <button wire:click="previousPage" class="page-link">‹</button>
                        </li>

                        @php
                            $current = $distributions->currentPage();
                            $last = $distributions->lastPage();

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

                        <li class="page-item {{ $distributions->hasMorePages() ? '' : 'disabled' }}">
                            <button wire:click="nextPage" class="page-link">›</button>
                        </li>

                        <li
                            class="page-item {{ $distributions->currentPage() == $distributions->lastPage() ? 'disabled' : '' }}">
                            <button wire:click="gotoPage({{ $distributions->lastPage() }})"
                                class="page-link">»</button>
                        </li>
                    </ul>
                </nav>
            </div>

            <style>
                .shadow-neumorph {
                    box-shadow: 8px 8px 15px #d1d9e6, -8px -8px 15px #ffffff;
                }

                .icon-circle {
                    width: 24px;
                    height: 24px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .flag-shadow {
                    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
                }
            </style>



        </div>
    </div>





    <livewire:seller.layout.footer />

</div>
