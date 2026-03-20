<div>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-4 p-md-5">

                        <!-- Icon -->
                        <div class="mb-3">
                            <div class="rounded-circle bg-danger-subtle d-inline-flex 
                                        align-items-center justify-content-center"
                                 style="width:64px;height:64px;">
                                <i class="bi bi-wifi-off text-danger fs-3"></i>
                            </div>
                        </div>

                        <!-- Title -->
                        <h5 class="fw-bold mb-2">
                            Connection Issue
                        </h5>

                        <!-- Message -->
                        <p class="text-muted small mb-4">
                            We’re unable to load the payment page right now.
                            Please check your internet connection and try again.
                        </p>

                        <!-- Action -->
                        <button wire:click="retry"
                                class="btn btn-primary w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i>
                            Retry Payment
                        </button>

                        <!-- Hint -->
                        <div class="mt-3 text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            This page will refresh once the connection is restored.
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
