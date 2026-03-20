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
                    <li class="breadcrumb-item active" aria-current="page">Embassy Contacts</li>
                </ol>
            </nav>

            <div class="row gx-3 flex-between-end mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Embassy Contacts</h2>
                </div>
            </div>


            <style>
                .flag {
                    width: 24px;
                }
            </style>
            <style>
                .effect:hover {
                    transform: translateY(-4px);
                    transition: all 0.3s ease-in-out;
                }
            </style>

            <div class="row g-3 mb-5">
                @foreach ($EmbassyContacts as $contact)
                    <div class="col-12 col-md-6 col-lg-4 effect">
                        <div class="card border-2 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class=" p-4 d-flex flex-column justify-content-between">
                                <div class="text-center">
                                    <h5 class="mb-0 text-dark">{{ $contact->name }}</h5>
                                    <div class="small fw-bold text-success my-3">
                                        @if (!empty($contact->country->flag_img) && file_exists(public_path('assets/' . $contact->country->flag_img)))
                                            <img class="flag" loading="lazy"
                                                src="{{ asset('assets/' . $contact->country->flag_img) }}"
                                                alt="{{ $contact->country->short_name ?? 'country Image' }}" />
                                        @else
                                            <img class="img-fluid transition rounded-1" loading="lazy"
                                                src="{{ asset('assets/img/no-image.png') }}" alt="No Image Available" />
                                        @endif
                                        {{ $contact->country->short_name ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="mb-2 text-center">
                                    <a href="mailto:{{ $contact->embassy_email }}"
                                        class="text-primary d-inline-flex align-items-center">
                                        <i class="fas fa-envelope me-2"></i> {{ $contact->embassy_email }}
                                    </a>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a href="mailto:{{ $contact->embassy_email }}">
                                        <button class="btn btn-sm btn-outline-primary">
                                            Contact
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($showPagination)
                <div class="d-flex justify-content-center align-items-center my-4 flex-wrap gap-2">
                    @if ($page > 1)
                        <button class="btn btn-sm btn-outline-primary"
                            wire:click="$set('page', {{ $page - 1 }})">&laquo;</button>
                    @endif
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <button class="btn btn-sm {{ $i == $page ? 'btn-primary' : 'btn-outline-primary' }}"
                            wire:click="$set('page', {{ $i }})">{{ $i }}</button>
                    @endfor
                    @if ($page < $totalPages)
                        <button class="btn btn-sm btn-outline-primary"
                            wire:click="$set('page', {{ $page + 1 }})">&raquo;</button>
                    @endif
                </div>
            @endif

        </div>
    </div>
    <livewire:seller.layout.footer />


</div>