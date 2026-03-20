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
    {{-- <script>
        window.onload = function() {
            // Hide the skeleton loader
            document.getElementById('skeleton-loader').style.display = 'none';

            // Show the lectures list
            document.getElementById('batches-list').style.display = 'block';
        };
    </script> --}}

    <main class="main" id="top">

        <div class="container mt-5">
            <div class="content">
                <h2 class="text-center mb-4">Batches</h2>
                <hr>
                <div class="row g-4"  wire:loading wire:target="loadBatches">
                    <!-- Skeleton Loader Cards -->
                    @foreach ($batches as $batch)
                        <!-- Adjust number based on the number of batches you're showing -->
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <!-- Skeleton Title -->
                                    <div class="skeleton skeleton-title"></div>
                                    <!-- Skeleton Text -->
                                    <div class="skeleton skeleton-text"></div>
                                    <!-- Skeleton Button -->
                                    <div class="skeleton skeleton-btn"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="batches-list"  wire:init="loadBatches" wire:loading.remove>
                    <div class="row g-4">
                        <!-- Batch Item 1 -->
                        @forelse  ($batches as $item)
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h4 class="card-title text-primary">{{ $item->name }}</h4>
                                        {{-- <p class="card-text fw-semibold">{{ \Carbon\Carbon::parse($item->lac_datetime)->format('l, F j, Y g:i A') }}</p> --}}
                                        <a href="{{ route('lectures', $item->id) }}"><button
                                                class="btn btn-sm btn-subtle-primary">View Lecture</button></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-danger mt-4">
                                <p class="fw-semibold text-danger">No Batches Available</p>                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
            <livewire:seller.layout.footer />
        </div>
    </main>



</div>
