<div>

    <livewire:front.layout.header />

    <!-- <section> begin ============================-->
    <section class="pt-5 pb-9">

        <div class="container-fluid">
            <button class="btn btn-sm btn-phoenix-secondary text-body-tertiary mb-5 d-lg-none" data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn"><span class="fa-solid fa-filter me-2"></span>Filter</button>
            <div class="row">
                <div class="col-lg-2 col-xxl-2 ps-2 ps-xxl-3">
                    <div class="phoenix-offcanvas-filter scrollbar phoenix-offcanvas phoenix-offcanvas-fixed rounded-2"
                        id="productFilterColumn" style="top: 92px; background-color: white; padding: 0 20px !important">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0 mt-3">Filters</h3>
                            <button class="btn d-lg-none p-0 mt-3" data-phoenix-dismiss="offcanvas"><span
                                    class="uil uil-times fs-8"></span></button>
                        </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseAvailability" role="button" aria-expanded="true"
                            aria-controls="collapseAvailability">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight"> Country </div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseAvailability">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="inStockInput" type="checkbox"
                                        name="color" checked>
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="inStockInput">India</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="preBookInput" type="checkbox"
                                        name="color">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="preBookInput">Dubai</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="outOfStockInput" type="checkbox"
                                        name="color">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="outOfStockInput">Malasiya</label>
                                </div>
                            </div>
                        </div>
                        <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseColorFamily" role="button" aria-expanded="true"
                            aria-controls="collapseColorFamily">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Color</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseColorFamily">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckBlack" type="checkbox"
                                        name="color" checked>
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckBlack">Black</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckBlue" type="checkbox"
                                        name="color">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckBlue">Blue</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckRed" type="checkbox"
                                        name="color">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckRed">Red</label>
                                </div>
                            </div>
                        </div> -->
                        <!-- <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseBrands" role="button" aria-expanded="true" aria-controls="collapseBrands">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Packaging</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseBrands">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckBlackberry" type="checkbox"
                                        name="brands" checked>
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckBlackberry">
                                        Bag

                                    </label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckApple" type="checkbox"
                                        name="brands">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckApple">
                                        Bulk

                                    </label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckNokia" type="checkbox"
                                        name="brands">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckNokia">
                                        Box

                                    </label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="flexCheckSony" type="checkbox"
                                        name="brands">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="flexCheckSony">
                                        Bottle

                                    </label>
                                </div>
                              
                            </div>
                        </div> -->
                        <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapsePriceRange" role="button" aria-expanded="true"
                            aria-controls="collapsePriceRange">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Price range</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapsePriceRange">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="input-group me-2">
                                    <input class="form-control" type="text" aria-label="First name"
                                        placeholder="Min">
                                    <input class="form-control" type="text" aria-label="Last name"
                                        placeholder="Max">
                                </div>
                                <button class="btn btn-phoenix-primary px-3" type="button">Go</button>
                            </div>
                        </div>

                        <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapsePriceRange" role="button" aria-expanded="true"
                            aria-controls="collapsePriceRange">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Min. order</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapsePriceRange">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="input-group me-2">
                                    <input class="form-control" type="text" aria-label="First name"
                                        placeholder="Min">
                                </div>
                                <button class="btn btn-phoenix-primary px-3" type="button">Go</button>
                            </div>
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
                        <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
                            href="#collapseDelivery" role="button" aria-expanded="true"
                            aria-controls="collapseDelivery">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="fs-8 text-body-highlight">Payment Term</div><span
                                    class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                            </div>
                        </a>
                        <div class="collapse show" id="collapseDelivery">
                            <div class="mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="freeShippingInput" type="checkbox"
                                        name="delivery" checked>
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
                                    <input class="form-check-input mt-0" id="codInput" type="checkbox"
                                        name="delivery">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="codInput">Advance Payment</label>
                                </div>
                            </div>
                        </div>
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
                        <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse"
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
                                    <input class="form-check-input mt-0" id="rohsInput" type="checkbox"
                                        name="certification">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="rohsInput">RCMC</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="fccInput" type="checkbox"
                                        name="certification">
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
                                    <input class="form-check-input mt-0" id="isoOneInput" type="checkbox"
                                        name="certification">
                                    <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0"
                                        for="isoOneInput">ISO 9001:2015</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input mt-0" id="isoTwoInput" type="checkbox"
                                        name="certification">
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
                        </div>
                    </div>
                    <div class="phoenix-offcanvas-backdrop d-lg-none" data-phoenix-backdrop style="top: 92px"></div>
                </div>
                <div class="col-lg-10 col-xxl-10">
                    <div class="row  gy-6 mb-8">
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">India</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                  
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Manoj verma</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-96******51</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">10 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-2">
                            <!-- <div class="product-card-container h-100 border rounded-2 p-3"> -->
                            <div class="position-relative text-decoration-none product-card h-100 p-4 border rounded-3">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <img width="60" src="../../../assets/img/icons/gfe.svg" alt="">
                                            <div>
                                                <h3 class="fs-8 fw-semibold">Looking for Central air conditioner</h3>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img style="width: 30px; mix-blend-mode: multiply;" src="../assets/img/logos/varify.jpg" alt="">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-location-dot me-1 text-success"></i>
                                                        <p class="fs-8 fw-bold mb-0">india</p>
                                                    </div>
                                                    <p class="fs-8 fw-bold mb-0">3 year</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="head-line"> -->
                                        <p class="mt-3">I am interested in buying Central air conditioner.</p>
                                        <!-- </div> -->
                                        <div class="text-decoration-none">
                                            <ul class="d-flex flex-wrap justify-content-between list-unstyled">
                                                <li>
                                                    <p><b>Buyer Name </b></p>
                                                    <span class="fs-9 fw-semibold">Khurshid Ahmad</span>
                                                </li>
                                                <li>
                                                    <p><b>Mobile No.</b> </p>
                                                    <span class="fs-9 fw-semibold">+91-94******00</span>
                                                </li>
                                                <li>
                                                    <p><b>Quantity</b></p>
                                                    <span class="fs-9 fw-semibold">1 Piece</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary me-1 mb-1" type="button">Contact Buyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="d-flex justify-content-end">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->

    <livewire:front.layout.footer />

</div>