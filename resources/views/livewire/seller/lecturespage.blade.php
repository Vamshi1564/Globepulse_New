<div>
    <livewire:seller.layout.header />

    <style>
        /* Skeleton Loader Styles */
        .skeleton {
            background-color: #e0e0e0;
            border-radius: 4px;
        }

        .skeleton-title {
            width: 80%;
            height: 20px;
            background: #ddd;
            margin-bottom: 10px;
        }

        .skeleton-text {
            width: 100%;
            height: 15px;
            background: #ddd;
            margin-bottom: 10px;
        }

        .skeleton-btn {
            width: 50%;
            height: 30px;
            background: #ddd;
            margin-top: 20px;
        }
    </style>

    <main class="main" id="top">
        <div class="container mt-5">
            <div class="content">
                <h2 class="text-center mb-4">{{ $batchName }} - Lectures</h2>
                <hr>

                <!-- Skeleton Loader -->
                <div class="row g-4" wire:loading wire:target="loadLectures">
                    @foreach ($lectures as $item)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <div class="skeleton skeleton-title"></div>
                                    <div class="skeleton skeleton-text"></div>
                                    <div class="skeleton skeleton-btn"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Lectures List -->
                <div class="row g-4" wire:init="loadLectures" wire:loading.remove>
                    @forelse  ($lectures as $item)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <h4 class="card-title text-primary">{{ $item->name }}</h4>
                                    <p class="card-text fw-semibold">
                                        {{ \Carbon\Carbon::parse($item->lac_datetime)->format('l, F j, Y g:i A') }}
                                    </p>
                                    @if (in_array($item->id, $attendedLectures))
                                        <span class="text-success">You've registered for this lecture.</span>
                                    @else
                                        <button class="btn btn-sm btn-subtle-primary" wire:loading.attr="disabled"
                                            wire:click="attendLecture('{{ $item->id }}')"
                                            wire:target="attendLecture('{{ $item->id }}')">
                                            <span wire:loading.remove
                                                wire:target="attendLecture('{{ $item->id }}')">Join Lecture</span>
                                            <span wire:loading
                                                wire:target="attendLecture('{{ $item->id }}')">Loading...</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-danger mt-4">
                            <p class="fw-semibold text-danger">No Lectures Available</p>
                        </div>
                    @endforelse
                </div>

                <!-- Success/Error Messages -->
                @if (session()->has('error'))
                    <div class="alert alert-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                        role="alert">
                        <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
                        <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
                        role="alert">
                        <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
                        <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <livewire:seller.layout.footer />
        </div>
    </main>
