<div>
    <livewire:seller.layout.header />

    <div class="container-fluid my-5">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb rounded  py-2">
                <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('my-products') }}">My Products</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Verified Buyers</li>
            </ol>
        </nav>
    </div>


    <!-- Form -->
    <div class="bg-white py-5 ">
        <div class="container-fluid ">
            <form class="mb-5" wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="mb-4">
                    <h2 class="fw-bold mb-0">Verified Buyers</h2>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="hsn" class="form-label fw-semibold">Select HSN Code</label>
                        <select class="form-select shadow-sm" wire:model="hsncode" id="hsn">
                            <option value="">-- Select HSN Code --</option>
                            @foreach ($HsnCode as $data)
                                <option value="{{ $data->HSN }}">{{ $data->HSN }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger small ">
                            @error('hsncode') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm mt-4">Submit</button>
                    </div>
                </div>
            </form>

            <style>
                .flag {
                    width: 24px;
                    /* height: 16px; */
                }
            </style>

            <!-- Buyers Cards -->
            @if ($verifyBuyers && $verifyBuyers->isNotEmpty())
                <div class="row g-4">
                    @foreach ($verifyBuyers as $item)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 border-2 bg-light p-3">
                                <div class="d-flex justify-content-between align-items-center ">
                                    <h5 class="fw-bold mb-2">{{ $item->company_name }}</h5>
                                    <div class="flag-container fs-9 ms-2 d-flex ">
                                        @if(!empty($item->country->flag_img))
                                            <img src="{{ asset('assets/' . $item->country->flag_img) }}"
                                                alt="{{ $item->country->short_name }}" class="flag-shadow" width="24">
                                        @endif
                                        <span class="ms-2 fs-9">{{ $item->country->short_name ?? 'N/A' }}</span>
                                    </div>

                                </div>

                                <div class="position-relative pb-2 border-bottom">
                                    <span class="badge bg-white text-dark shadow-sm">
                                        HSN #{{ $item->hsncode }}
                                    </span>
                                </div>

                                <div class="  rounded-2 my-2">
                                    <p class="fs-8 mb-2">
                                        <strong>Product Name :</strong>
                                        <span class="short-desc">
                                            {{ strlen($item->product_description) > 150 ? Str::limit($item->product_description, 150) : $item->product_description }}
                                        </span>
                                        @if(strlen($item->product_description) > 150)
                                            <span class="full-desc d-none">{{ $item->product_description }}</span>
                                            <a href="javascript:void(0);" class="read-more-toggle text-primary fs-9 fw-bolder"
                                                onclick="toggleDescription(this)">Read More</a>
                                        @endif
                                    </p>


                                    <p class="fs-8 mb-0"><strong>Address :</strong> {{ Str::limit($item->address, 25) }}</p>
                                </div>

                                <div class="contact-info">
                                    {{-- <div class="d-flex align-items-center mb-2">

                                        <span class="fs-8"><strong>Chapter :</strong>{{ $item->chapter }}</span>
                                    </div> --}}
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon-circle bg-success text-white me-2">
                                            <i class="fas fa-envelope fa-sm"></i>
                                        </div>
                                        <span class="fs-8">{{ $item->email }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-info text-white me-2">
                                            <i class="fas fa-phone fa-sm"></i>
                                        </div>
                                        <span class="fs-8">{{ $item->phone }} @if($item->phone_02)/
                                        {{ $item->phone_02 }}@endif</span>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif($hsncode)
                <div class="neumorph-empty-state p-4 text-center rounded-3">
                    <div class="empty-icon mb-3">
                        <i class="fas fa-box-open fa-3x text-muted"></i>
                    </div>
                    <h5 class="fw-bold mb-2">No Results Found</h5>
                    <p class="text-muted mb-3">We couldn't find any buyers for HSN code <span
                            class="fw-bold">{{ $hsncode }}</span></p>
                    <button class="btn btn-neumorph px-4">Search Again</button>
                </div>
            @endif

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

            <script>
                function toggleDescription(el) {
                    const parent = el.closest('p');
                    const shortText = parent.querySelector('.short-desc');
                    const fullText = parent.querySelector('.full-desc');

                    if (shortText.classList.contains('d-none')) {
                        shortText.classList.remove('d-none');
                        fullText.classList.add('d-none');
                        el.textContent = 'Read More';
                    } else {
                        shortText.classList.add('d-none');
                        fullText.classList.remove('d-none');
                        el.textContent = 'Show Less';
                    }
                }
            </script>

        </div>
    </div>





    <livewire:seller.layout.footer />

</div>