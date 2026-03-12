@push('custom-meta')

    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}

    <title>Explore Our Product | Innovative Business Solutions</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Discover our premium product designed to support business growth, efficiency, 
                                                                                            and innovation across global markets and industries.">

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="business product, innovative solutions, global product, digital business tool, business growth, 
                                                                                    B2B product, trade solutions, professional tools, business support, global expansion, technology product, 
                                                                                    scalable solutions, product for business, high-performance tools, productivity solutions">

    <!-- Canonical Tag -->
    <link rel="canonical" href="https://www.globpulse.com/products">


    <!-- Open Graph / Facebook -->

    <meta property="og:url" content="https://www.globpulse.com/product">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">


    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

@endpush




<div>
    <livewire:front.layout.header />

    <section class="pt-5 pb-9">

        <div class=" container-fluid">
            <button class="btn btn-sm btn-phoenix-secondary text-body-tertiary mb-5 d-lg-none"
                data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn"><span
                    class="fa-solid fa-filter me-2"></span>Filter</button>
            <div class="row">
                <div class="col-lg-2 col-xxl-2 ps-2 ps-xxl-3">
                    <div class="phoenix-offcanvas-filter scrollbar phoenix-offcanvas phoenix-offcanvas-fixed rounded-3 "
                        id="productFilterColumn" style="top: 92px; background: #f8f9fa; padding: 20px;">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold text-dark">Filters</h4>
                            <button class="btn d-lg-none p-0 text-danger" data-phoenix-dismiss="offcanvas">
                                <i class="uil uil-times fs-5"></i>
                            </button>
                        </div>

                        <div class="accordion" id="filterAccordion">

                            <!-- Country Filter -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingCountry">
                                    <button class="accordion-button bg-white shadow-none p-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCountry" aria-expanded="true"
                                        aria-controls="collapseCountry">
                                        Country
                                    </button>
                                </h2>
                                <div id="collapseCountry" class="accordion-collapse collapse show"
                                    aria-labelledby="headingCountry">
                                    <div class="accordion-body">
                                        <input type="text" wire:model.live="searchCountry" class="form-control mb-3"
                                            placeholder="Search for a country...">
                                        <div class="filter-list" style="max-height: 200px; overflow-y: auto;">
                                            @if ($filteredCountries->isEmpty())
                                                <p class="text-muted small">No countries found.</p>
                                            @else
                                                @foreach ($filteredCountries as $country)
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="{{ $country->country_id }}"
                                                            type="checkbox" wire:model.live="selectedCountries"
                                                            value="{{ $country->country_id }}">
                                                        <label class="form-check-label text-dark"
                                                            for="{{ $country->country_id }}">
                                                            {{ $country->short_name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingPrice">
                                    <button class="accordion-button bg-white shadow-none p-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="true"
                                        aria-controls="collapsePrice">
                                        Price Range
                                    </button>
                                </h2>
                                <div id="collapsePrice" class="accordion-collapse collapse show"
                                    aria-labelledby="headingPrice">
                                    <div class="accordion-body">
                                        <div class="d-flex gap-2">
                                            <input class="form-control" type="text" placeholder="Min"
                                                wire:model="minPrice">
                                            <input class="form-control" type="text" wire:model="maxPrice"
                                                placeholder="Max">
                                        </div>
                                        <button class="btn btn-primary mt-3 w-100"
                                            wire:click="applyFilters">Apply</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Min Order -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingOrder">
                                    <button class="accordion-button bg-white shadow-none p-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOrder" aria-expanded="true"
                                        aria-controls="collapseOrder">
                                        Min. Order
                                    </button>
                                </h2>
                                <div id="collapseOrder" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOrder">
                                    <div class="accordion-body">
                                        <input class="form-control mb-2" wire:model="minOrder" type="text"
                                            placeholder="Min">
                                        <button class="btn btn-primary w-100" wire:click="applyFilters">Apply</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="phoenix-offcanvas-backdrop d-lg-none" data-phoenix-backdrop style="top: 92px"></div>
                </div>

                <!-- <a class="btn px-0 y-4 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseRating" role="button" aria-expanded="true"
                            aria-controls="collapseRating">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Store reviews</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseRating">
                            <div class="d-flex align-items-center mb-1">
                                <input class="form-check-input me-3" id="flexRadio1" type="radio"
                                    name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <input class="form-check-input me-3" id="flexRadio2" type="radio"
                                    name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span>
                                <p class="ms-1 mb-0">&amp; above</p>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <input class="form-check-input me-3" id="flexRadio3" type="radio"
                                    name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span>
                                <p class="ms-1 mb-0">&amp; above </p>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <input class="form-check-input me-3" id="flexRadio4" type="radio"
                                    name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span>
                                <p class="ms-1 mb-0">&amp; above</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input class="form-check-input me-3" id="flexRadio5" type="radio"
                                    name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span><span
                                    class="fa-regular fa-star text-warning-light fs-9 me-1"
                                    data-bs-theme="light"></span>
                                <p class="ms-1 mb-0">&amp; above </p>
                            </div>
                        </div> -->
                <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseDisplayType" role="button" aria-expanded="true"
                            aria-controls="collapseDisplayType">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Display type</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseDisplayType">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="lcdInput" type="checkbox"
                                        name="displayType" checked>
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="lcdInput">LCD</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="ipsInput" type="checkbox"
                                        name="displayType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="ipsInput">IPS</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="oledInput" type="checkbox"
                                        name="displayType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="oledInput">OLED</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="amoledInput" type="checkbox"
                                        name="displayType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="amoledInput">AMOLED</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="retinaInput" type="checkbox"
                                        name="displayType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="retinaInput">Retina</label>
                                </div>
                            </div>
                        </div> -->
                <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseCondition" role="button" aria-expanded="true"
                            aria-controls="collapseCondition">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Condition</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseCondition">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="newInput" type="checkbox"
                                        name="condition" checked>
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="newInput">New</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="usedInput" type="checkbox"
                                        name="condition">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="usedInput">Used</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="refurbrishedInput" type="checkbox"
                                        name="condition">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="refurbrishedInput">Refurbrished</label>
                                </div>
                            </div>
                        </div> -->
                {{-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseDelivery"
                    role="button" aria-expanded="true" aria-controls="collapseDelivery">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="fs-8 text-body-highlight">Payment Term</div><span
                            class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                    </div>
                </a>
                <div class="collapse show" id="collapseDelivery">
                    <div class="mb-2">
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="freeShippingInput" type="checkbox" name="delivery"
                                checked>
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="freeShippingInput">LC</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="oneDayShippingInput" type="checkbox"
                                name="delivery">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="oneDayShippingInput">TT</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="codInput" type="checkbox" name="delivery">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="codInput">Advance Payment</label>
                        </div>
                    </div>
                </div> --}}
                <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseCampaign" role="button" aria-expanded="true"
                            aria-controls="collapseCampaign">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Campaign</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseCampaign">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="summerSaleInput" type="checkbox"
                                        name="campaign">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="summerSaleInput">Summer Sale</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="marchMadnessInput" type="checkbox"
                                        name="campaign">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="marchMadnessInput">March Madness</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flashSaleInput" type="checkbox"
                                        name="campaign">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flashSaleInput">Flash Sale</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="bogoBlastInput" type="checkbox"
                                        name="campaign">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="bogoBlastInput">BOGO Blast</label>
                                </div>
                            </div>
                        </div> -->
                <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseWarranty" role="button" aria-expanded="true"
                            aria-controls="collapseWarranty">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Warranty</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseWarranty">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="threeMonthInput" type="checkbox"
                                        name="warranty">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="threeMonthInput">3 months</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="sixMonthInput" type="checkbox"
                                        name="warranty">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="sixMonthInput">6 months</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="oneYearInput" type="checkbox"
                                        name="warranty">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="oneYearInput">1 year</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="twoYearsInput" type="checkbox"
                                        name="warranty">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="twoYearsInput">2 years</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="threeYearsInput" type="checkbox"
                                        name="warranty">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="threeYearsInput">3 years</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="fiveYearsInput" type="checkbox"
                                        name="warranty">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="fiveYearsInput">5 years</label>
                                </div>
                            </div>
                        </div> -->
                <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseWarrantyType" role="button" aria-expanded="true"
                            aria-controls="collapseWarrantyType">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Warranty Type</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseWarrantyType">
                            <div class="mb-2">
                                <div class="form-check mb-0x">
                                    <input class="form-check-input mt-0" id="replacementInput" type="checkbox"
                                        name="warrantyType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="replacementInput">Replacement</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="serviceInput" type="checkbox"
                                        name="warrantyType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="serviceInput">Service</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="partialCoveregeInput" type="checkbox"
                                        name="warrantyType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="partialCoveregeInput">Partial Coverage</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="appleCareInput" type="checkbox"
                                        name="warrantyType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="appleCareInput">Apple Care</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="moneyBackInput" type="checkbox"
                                        name="warrantyType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="moneyBackInput">Money back</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="extendableInput" type="checkbox"
                                        name="warrantyType">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="extendableInput">Extendable</label>
                                </div>
                            </div>
                        </div> -->
                {{-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                    href="#collapseCertification" role="button" aria-expanded="true"
                    aria-controls="collapseCertification">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="fs-8 text-body-highlight">Product Certifications</div><span
                            class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                    </div>
                </a>
                <div class="collapse show" id="collapseCertification">
                    <div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="rohsInput" type="checkbox" name="certification">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="rohsInput">RCMC</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="fccInput" type="checkbox" name="certification">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="fccInput">FSSAI</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="conflictInput" type="checkbox"
                                name="certification">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="conflictInput">APEDA</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="isoOneInput" type="checkbox" name="certification">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="isoOneInput">ISO 9001:2015</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="isoTwoInput" type="checkbox" name="certification">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="isoTwoInput">ISO 27001:2013</label>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input mt-0" id="isoThreeInput" type="checkbox"
                                name="certification">
                            <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                for="isoThreeInput">IEC 61000-4-2</label>
                        </div>
                    </div>
                </div> --}}

                {{-- @if ($products->isNotEmpty()) --}}
                <div class="col-lg-10 col-xxl-10">
                    {{-- @if ($products->isEmpty())
                    <h3 class="text-center">No products found matching "{{ $searchTerm }}".</h3>
                    @else --}}

                    {{-- <div class="card mb-5 d-none d-sm-block">
                        <div class="d-flex p-3">
                            <div class="col-3 col-md-3  ">
                                <!-- <a href="#!"> -->
                                <!-- <div class="w-100"> -->
                                <!-- <video class="w-100 " poster="https://s.alicdn.com/@img/imgextra/i4/6000000007295/O1CN01V4ft7v23lA4wjpEux_!!6000000007295-0-tbvideo.jpg_q60.jpg" height="340" preload="auto" controls="" loop="" autoplay="">
                                        <source src="http://videocdn.alibaba.com/4f4e1c368ac918af/c39862649dfd9349/20220909_8cc32cb4cf2827d5_377067183429_mp4_264_hd_unlimit_taobao.mp4?bizCode=icbu_vod_video" type="video/mp4">
                                    </video> -->

                                <iframe class="w-100 rounded-3" height="287"
                                    src="https://www.youtube.com/embed/Jc8rgeyi7fI?autoplay=1&mute=1"
                                    allow="autoplay; encrypted-media" allowfullscreen>
                                </iframe>


                                <!-- </div> -->
                                <!-- </a> -->
                            </div>
                            <div class="col-9 col-sm-12 col-md-9 ">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class="d-flex">
                                        <img style="width: 50px;" src="../../assets/img/icons/gfe.svg" alt="">
                                        <a href="#!">
                                            <h4 class="fs-8">Shenzhen Galime Electronics Technology Ltd.</h4>
                                            <p class="mb-0">Home & Garden</p>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <button class="btn btn-outline-primary me-1 mb-1" type="button">Chat
                                            Now</button>
                                        <button
                                            class="btn btn-outline-primary me-1 mb-1 d-block d-sm-none d-md-none d-lg-none d-xl-block"
                                            type="button">Contact</button>
                                    </div>
                                </div>

                                <div class="px-3 mt-2">

                                    <div class="swiper-theme-container products-slider text-center">
                                        <div class="swiper swiper theme-slider"
                                            data-swiper='{"delay": 4000, "loop": true, "speed": 1000,"slidesPerView":1,"spaceBetween":16,"breakpoints":{"450":{"slidesPerView":2,"spaceBetween":16},"576":{"slidesPerView":3,"spaceBetween":20},"768":{"slidesPerView":3,"spaceBetween":20},"992":{"slidesPerView":3,"spaceBetween":20},"1200":{"slidesPerView":5,"spaceBetween":16}}}'>
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid" src="{{ asset('../../assets/india/MSME.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1"
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid"
                                                                        src="{{ asset('../../assets/india/Coconut-Certificate.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/bananaaa.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Banana</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid"
                                                                        src="{{ asset('../../assets/india/Spice-Board-Cerificate.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/carateee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Carate</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid" src="{{ asset('../../assets/india/ISO.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple</p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid" src="{{ asset('../../assets/india/GMP.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid"
                                                                        src="{{ asset('../../assets/india/GCCI-Certificate.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div class="position-relative mb-3">
                                                                    <img class="img-fluid" src="{{ asset('../../assets/india/FSSAI.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div
                                                                    class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                                    <img class="img-fluid" src="{{ asset('../../assets/india/FIEO.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div
                                                        class="position-relative text-decoration-none product-card h-100">
                                                        <div class="d-flex flex-column justify-content-between h-100">
                                                            <div>
                                                                <!-- <div
                                                                    class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                                    <img class="img-fluid" src="{{ asset('../../assets/india/APEDA.webp') }}"
                                                                        alt="" />
                                                                </div> -->

                                                                <div class="card" style="max-width:20rem;">
                                                                    <div class="p-2">
                                                                        <div style="background-color: #f5f7fa;">
                                                                            <img class="card-img-top img-wt1 "
                                                                                src="../../assets/img//bg/appleeee.png"
                                                                                alt="..." />
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <h5 class="card-title">Apple</h5>
                                                                            <p class="card-text">This is Apple </p>
                                                                            <p class="mb-0">$15 - $20</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-nav swiper-product-nav">
                                            <div class="swiper-button-next top-50"><span
                                                    class="fas fa-chevron-right nav-icon"></span></div>
                                            <div class="swiper-button-prev top-50"><span
                                                    class="fas fa-chevron-left nav-icon"></span></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card d-block d-sm-none">

                        <div class="col-sm-12 col-md-9">
                            <div class="d-flex justify-content-between p-2">
                                <a href="#!">
                                    <h4 class="fs-9">Shenzhen Galime Electronics Technology Co., Ltd.</h4>
                                    <p>Home & Garden</p>
                                </a>
                                <div>
                                    <button class="btn btn-outline-primary me-1 mb-1 text-nowrap" type="button">Chat
                                        Now</button>
                                </div>
                            </div>

                            <div class="p-3">

                                <div class="swiper-theme-container products-slider text-center">
                                    <div class="swiper swiper theme-slider"
                                        data-swiper='{"autoplay":true,"loop":true,"slidesPerView":2,"spaceBetween":16,"breakpoints":{"450":{"slidesPerView":2,"spaceBetween":16},"576":{"slidesPerView":3,"spaceBetween":20},"768":{"slidesPerView":4,"spaceBetween":20},"992":{"slidesPerView":5,"spaceBetween":20},"1200":{"slidesPerView":5,"spaceBetween":16}}}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid" src="{{ asset('../../assets/india/MSME.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('../../assets/india/Coconut-Certificate.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('../../assets/india/Spice-Board-Cerificate.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid" src="{{ asset('../../assets/india/ISO.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid" src="{{ asset('../../assets/india/GMP.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('../../assets/india/GCCI-Certificate.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div class="position-relative mb-3">
                                                                <img class="img-fluid" src="{{ asset('../../assets/india/FSSAI.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div
                                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                                <img class="img-fluid" src="{{ asset('../../assets/india/FIEO.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="position-relative text-decoration-none product-card h-100">
                                                    <div class="d-flex flex-column justify-content-between h-100">
                                                        <div>
                                                            <!-- <div
                                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                                <img class="img-fluid" src="{{ asset('../../assets/india/APEDA.webp') }}"
                                                                    alt="" />
                                                            </div> -->

                                                            <div class="card" style="max-width:20rem;">
                                                                <div class="p-2">
                                                                    <div style="background-color: #f5f7fa;">
                                                                        <img class="card-img-top img-wt1 "
                                                                            src="../../assets/img//bg/appleeee.png"
                                                                            alt="..." />
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <h5 class="card-title">Apple</h5>
                                                                        <p class="card-text">This is Apple</p>
                                                                        <p class="mb-0">$15 - $20</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-nav swiper-product-nav">
                                        <div class="swiper-button-next top-50"><span
                                                class="fas fa-chevron-right nav-icon"></span></div>
                                        <div class="swiper-button-prev top-50"><span
                                                class="fas fa-chevron-left nav-icon"></span></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div> --}}


                    {{-- <p>Showing 100,000+ products from global suppliers for "Corn"
                    </p> --}}
                    <style>
                        .product-title {
                            font-size: 16px;
                            margin-bottom: 10px;
                            line-height: 1.2;
                        }

                        .price-range {
                            font-size: 14px;
                            font-weight: bold;
                            color: #333;
                            margin-bottom: 8px;
                        }
                    </style>

                    <div class="row gx-3 gy-6 mb-8">
                        @if ($products->isEmpty())
                            <div class="col-12">
                                <h4 class="text-center text-danger">Products not Found.</h4>
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="col-6 col-sm-6 col-md-3 col-xxl-2 ">
                                    <div class="product-card-container h-100 position-relative p-1 bg-white rounded-3">
                                        <div class="product-card shadow-lg rounded-3 overflow-hidden h-100 bg-white transition"
                                            title="View product">
                                            <div class="product-image position-relative ">
                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                    src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                    alt="{{ $product->title }}" />

                                            </div>
                                            <div class="px-2 py-3 d-flex flex-column">
                                                <a class="text-decoration-none stretched-link intent-trigger"
                                                    href="{{ route('product-detail', ['slug' => $product->slug]) }}">
                                                    <h3 class="text-dark mb-2 fw-bold product-title"
                                                        style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden; text-overflow: ellipsis; max-height: 3em; line-height: 1.5em; word-break: break-word;"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $product->title }}">
                                                        {{ $product->title }}
                                                    </h3>


                                                </a>
                                                {{-- <p class="text-warning mb-2">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </p> --}}


                                                <div class="price-range">
                                                    <span class="price">
                                                        {{ $product->country->currency_symbol ?? '' }} {{ $product->min_price }}
                                                    </span>
                                                    -
                                                    <span class="price">
                                                        {{ $product->country->currency_symbol ?? '' }} {{ $product->max_price }}
                                                        ({{ $product->country->currency ?? '' }})
                                                    </span>
                                                </div>



                                                <p class="text-muted small">Min Order: {{ $product->min_order }}</p>
                                                <p class="text-muted small text-truncate"
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    Business Type: {{ $product->business_type }}</p>
                                                <div class="d-flex align-items-center gap-2 ">
                                                    <img style="width: 55px; mix-blend-mode: multiply;"
                                                        src="{{asset('../../assets/img/logos/varify.gif')}}" alt="Verified">
                                                    <span class="small fw-bold text-success">
                                                        @if (!empty($product->country->flag_img) && file_exists(public_path('assets/' . $product->country->flag_img)))
                                                            <img class="flag" loading="lazy"
                                                                src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                alt="{{ $product->country->short_name ?? 'Product Image' }}" />
                                                        @else
                                                            <img class="img-fluid transition rounded-1" loading="lazy"
                                                                src="{{ asset('assets/img/no-image.png') }}"
                                                                alt="No Image Available" />
                                                        @endif
                                                        {{ $product->country->iso2 ?? 'N/A' }}

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div x-intersect="$wire.loadMore()"></div>

                        @if ($products->hasMorePages())
                            <div class="text-center my-4" wire:loading wire:target="loadMore">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading more products...</span>
                                </div>
                            </div>
                        @endif


                        <style>
                            .product-card {
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                            }

                            .flag {
                                width: 24px;
                                /* height: 16px; */
                            }

                            .product-card:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
                            }

                            .product-image img {
                                transition: transform 0.3s ease;
                            }

                            .product-image:hover img {
                                transform: scale(1.05);
                            }

                            .line-clamp-2 {
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                            }
                        </style>
                        {{-- <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/1.png"
                                                    alt="" /><span
                                                    class="badge text-bg-success fs-10 product-verified-badge">Verified<span
                                                        class="fas fa-check ms-1"></span></span>
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Fitbit Sense Advanced
                                                    Smartwatch with Tools for Heart Health, Stress Management &amp; Skin
                                                    Temperature ...</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(74 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <p class="me-2 text-body text-decoration-line-through mb-0">$49.99</p>
                                                <h3 class="text-body-emphasis mb-0">$34.99</h3>
                                            </div>
                                            <p class="text-success fw-bold fs-9 lh-1 mb-0">Deal time ends in days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/2.png"
                                                    alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">iPhone 13 pro
                                                    max-Pacific Blue, 128GB storage</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(33 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="fs-9 text-body-highlight fw-bold mb-2">Stock limited</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <p class="me-2 text-body text-decoration-line-through mb-0">$899.99</p>
                                                <h3 class="text-body-emphasis mb-0">$850.99</h3>
                                            </div>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">5 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/3.png"
                                                    alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Apple MacBook Pro 13
                                                    inch-M1-8/256GB-Space Gray</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(97 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="fs-9 text-body-highlight fw-bold mb-2">Apple care included</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <p class="me-2 text-body text-decoration-line-through mb-0">$12.00</p>
                                                <h3 class="text-body-emphasis mb-0">$11.00</h3>
                                            </div>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/4.png"
                                                    alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Apple iMac 24&quot; 4K
                                                    Retina Display M1 8 Core CPU, 7 Core GPU, 256GB SSD, Green
                                                    (MJV83ZP/A) 2021</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(134 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="fs-9 text-body-highlight fw-bold mb-2">Exchange with kidney</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <p class="me-2 text-body text-decoration-line-through mb-0">$1499.00
                                                </p>
                                                <h3 class="text-body-emphasis mb-0">$1399.00</h3>
                                            </div>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">7 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/5.png"
                                                    alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Razer Kraken v3 x
                                                    Wired 7.1 Surroung Sound Gaming headset</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(59 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$59.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/7.png"
                                                    alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">2021 Apple 12.9-inch
                                                    iPad Pro (Wi‑Fi, 128GB) - Space Gray</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(13 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$799.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/12.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">HORI Racing Wheel Apex
                                                    for PlayStation 4/3, and PC</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(64 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$299.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">1 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button
                                                    class="btn btn-wish btn-wish-primary z-2 d-toggle-container active"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Remove from wishlist"><span class="fas fa-heart"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid" src="../../../assets/img/products/1.png"
                                                    alt="" /><span
                                                    class="badge text-bg-success fs-10 product-verified-badge">Verified<span
                                                        class="fas fa-check ms-1"></span></span>
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Amazfit T-Rex Pro
                                                    Smart Watch with GPS, Outdoor Fitness Watch for Men, Military
                                                    Standard Certified</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(32 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$20.00</h3>
                                            <p class="text-success fw-bold fs-9 lh-1 mb-0">Deal time ends in 24 hours
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/16.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Apple AirPods Pro</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(39 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$59.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">3 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/10.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Apple Magic Mouse
                                                    (Wireless, Rechargable) - Silver</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(6 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$89.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/25.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">RESPAWN 200 Racing
                                                    Style Gaming Chair, in Gray RSP 200 GRY</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(8 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$499.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/27.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">LEVOIT Humidifiers for
                                                    Bedroom Large Room 6L Warm and Cool Mist for...</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(3 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$299.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">3 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/26.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">NETGEAR Nighthawk Pro
                                                    Gaming XR500 Wi-Fi Router with 4 Ethernet Ports...</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(8 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$49.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">4 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/18.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Rachael Ray Cucina
                                                    Bakeware Set Includes Nonstick Bread Baking Cookie Sheet...</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(1 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$29.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">3 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/17.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">Xbox Series S</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(6 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$19.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/24.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">FURINNO Computer
                                                    Writing Desk, Walnut</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(8 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$199.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
                            <div class="product-card-container h-100">
                                <div class="position-relative text-decoration-none product-card h-100">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div
                                                class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                                <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                                                        data-fa-transform="down-1"></span><span
                                                        class="far fa-heart d-none-hover"
                                                        data-fa-transform="down-1"></span>
                                                </button><img class="img-fluid"
                                                    src="../../../assets/img/products/20.png" alt="" />
                                            </div><a class="stretched-link"
                                                href="../../../apps/e-commerce/landing/product-details.html">
                                                <h6 class="mb-2 lh-sm line-clamp-3 product-name">ASUS TUF Gaming F15
                                                    Gaming Laptop</h6>
                                            </a>
                                            <p class="fs-9"><span class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa fa-star text-warning"></span><span
                                                    class="fa-regular fa-star text-warning-light"
                                                    data-bs-theme="light"></span><span
                                                    class="text-body-quaternary fw-semibold ms-1">(3 people
                                                    rated)</span>
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-body-emphasis">$150.00</h3>
                                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- @else
                    <p>No products found matching "{{ $searchTerm }}".</p> --}}
                    {{-- @endif --}}
                    {{-- <div class="d-flex justify-content-end">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <span class="fas fa-chevron-left"> </span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#"> <span class="fas fa-chevron-right"></span></a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}

                    {{-- @endif --}}
                </div>
            </div>

            <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->


    {{-- <div class="support-chat-container">
        <div class="container-fluid support-chat">
            <div class="card bg-body-emphasis">
                <div class="card-header d-flex flex-between-center px-4 py-3 border-bottom border-translucent">
                    <h5 class="mb-0 d-flex align-items-center gap-2">Demo widget<span
                            class="fa-solid fa-circle text-success fs-11"></span></h5>
                    <div class="btn-reveal-trigger">
                        <button class="btn btn-link p-0 dropdown-toggle dropdown-caret-none transition-none d-flex"
                            type="button" id="support-chat-dropdown" data-bs-toggle="dropdown" data-boundary="window"
                            aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span
                                class="fas fa-ellipsis-h text-body"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2" aria-labelledby="support-chat-dropdown"><a
                                class="dropdown-item" href="#!">Request a callback</a><a class="dropdown-item"
                                href="#!">Search in chat</a><a class="dropdown-item" href="#!">Show history</a><a
                                class="dropdown-item" href="#!">Report to Admin</a><a
                                class="dropdown-item btn-support-chat" href="#!">Close Support</a></div>
                    </div>
                </div>
                <div class="p-2 chat p-0">
                    <div class="d-flex flex-column-reverse scrollbar h-100 p-3">
                        <div class="text-end mt-6"><a
                                class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">I need help with something</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a><a
                                class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">I can’t reorder a product I previously ordered</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a><a
                                class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">How do I place an order?</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a><a
                                class="false d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">My payment method not working</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a>
                        </div>
                        <div class="text-center mt-auto">
                            <div class="avatar avatar-3xl status-online"><img
                                    class="rounded-circle border border-3 border-light-subtle"
                                    src="../../../assets/img/team/30.webp" alt="" /></div>
                            <h5 class="mt-2 mb-3">Eric</h5>
                            <p class="text-center text-body-emphasis mb-0">Ask us anything – we’ll get back to you here
                                or by email within 24 hours.</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center gap-2 border-top border-translucent ps-3 pe-4 py-3">
                    <div class="d-flex align-items-center flex-1 gap-3 border border-translucent rounded-pill px-4">
                        <input class="form-control outline-none border-0 flex-1 fs-9 px-0" type="text"
                            placeholder="Write message" />
                        <label class="btn btn-link d-flex p-0 text-body-quaternary fs-9 border-0"
                            for="supportChatPhotos"><span class="fa-solid fa-image"></span></label>
                        <input class="d-none" type="file" accept="image/*" id="supportChatPhotos" />
                        <label class="btn btn-link d-flex p-0 text-body-quaternary fs-9 border-0"
                            for="supportChatAttachment"> <span class="fa-solid fa-paperclip"></span></label>
                        <input class="d-none" type="file" id="supportChatAttachment" />
                    </div>
                    <button class="btn p-0 border-0 send-btn"><span
                            class="fa-solid fa-paper-plane fs-9"></span></button>
                </div>
            </div>
        </div>
        <button class="btn btn-support-chat p-0 border border-translucent"><span
                class="fs-8 btn-text text-primary text-nowrap">Chat demo</span><span
                class="ping-icon-wrapper mt-n4 ms-n6 mt-sm-0 ms-sm-2 position-absolute position-sm-relative"><span
                    class="ping-icon-bg"></span><span class="fa-solid fa-circle ping-icon"></span></span><span
                class="fa-solid fa-headset text-primary fs-8 d-sm-none"></span><span
                class="fa-solid fa-chevron-down text-primary fs-7"></span></button>
    </div> --}}


    <!-- ============================================-->
    <!-- <section> begin ============================-->


    <livewire:front.layout.footer />

</div>