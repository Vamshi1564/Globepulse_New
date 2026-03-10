<div>
    <livewire:seller.layout.header />

    <div class="container mx-auto p-6">
        <div class="content">

            <div class="card max-w-2xl mx-auto bg-white shadow-lg rounded-lg">
                <!-- Header Section -->
                <div class="bg-blue-600 text-white pt-4 px-6">
                    <h1 class="text-3xl font-semibold">Notification</h1>
                </div>

                <!-- Notification Content Section -->
                <div class="p-6">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Message</h2>
                        <p class="text-gray-600 mt-2">{!! nl2br(e($notification->message ?? 'N/A')) !!}</p>
                                                                    

                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <!-- Back Button -->
                        <a href="{{ route('seller-notification-list') }}" class="font-semibold fs-8 me-2">
                            <i class="fa fa-arrow-left mr-2"></i> Back to Notifications List
                        </a>

                        <!-- Timestamp -->
                        <span
                            class="text-sm text-gray-500">{{ $notification->created_at?->diffForHumans(['parts' => 2]) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <livewire:seller.layout.footer />
    </div>

</div>