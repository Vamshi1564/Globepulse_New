@push('custom-meta')
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $metaTitle }}</title>

    <!-- Meta Description -->
    <meta name="description" content="{{ $metaDescription }}">

    <!-- Meta Keywords -->
    <meta name="keywords" content="{{ $metaKeywords }}">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{$sitemapUrl}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{$sitemapUrl}}">
    {{--
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg"> --}}
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    {{--
    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg"> --}}

    <!-- Robots -->
    <meta name="robots" content="index, follow">
@endpush

<div>

    <livewire:front.layout.header />

    <section class="pt-5 pb-9">

        <div class="container-fluid">
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
                                <span class="accordion-header" id="headingCountry">
                                    <button class="accordion-button bg-white shadow-none p-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCountry" aria-expanded="true"
                                        aria-controls="collapseCountry">
                                        Country
                                    </button>
                                </span>
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
                                <span class="accordion-header" id="headingPrice">
                                    <button class="accordion-button bg-white shadow-none p-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="true"
                                        aria-controls="collapsePrice">
                                        Price Range
                                    </button>
                                </span>
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
                                <span class="accordion-header" id="headingOrder">
                                    <button class="accordion-button bg-white shadow-none p-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOrder" aria-expanded="true"
                                        aria-controls="collapseOrder">
                                        Min. Order
                                    </button>
                                </span>
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



                <!-- -----------START Products----------- -->

                <style>
                    .text-border {
                        text-shadow:
                            -1px -1px 0 black,
                            1px -1px 0 black,
                            -1px 1px 0 black,
                            1px 1px 0 black;
                        /* Creates an outline effect */
                    }
                </style>
                <div class="col-lg-10 col-xxl-10">

                    <!-- Category Section -->
                    <section class="p-0 m-0">
                        <div class="">
                            @if(!empty($bgImage))
                                <div class="py-5 mb-4"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.322),rgba(0, 0, 0, 0.295)), url('{{ $bgImage }}'); background-repeat: no-repeat; background-position: center; background-size: cover;">

                            @else
                                    <div class="py-5 mb-4" style="background-color: rgb(199, 195, 195);">

                                @endif
                                    <h1 class=" fs-7 fs-md-5 fw-bolder text-white p-5 pb-2 ">
                                        {{ $subSubcategory->sub_subcat_name ?? ($subcategory->sub_cat_name ?? $category->cat_name) }}
                                    </h1>

                                    @if(isset($subcategory) && !isset($subSubcategory))
                                        <p class="px-5 pb-3 fs-9 fw-bold text-white m-0 py-0 text-border">
                                            {{ $subcategory->subcat_des ?? '' }}
                                        </p>
                                    @elseif(isset($category) && !isset($subcategory))
                                        <p class="px-5 pb-3 fs-9 fw-bold text-white m-0 py-0 text-border">
                                            {{ $category->cat_des ?? '' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="category-scroll-wrapper">
                                <div class="category-scroll d-flex">
                                    @if (!$subcategory)
                                        @foreach ($subcategories as $subcat)
                                            <a class="category-card text-decoration-none text-dark text-center"
                                                href="{{ route('products-category', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcat->slug]) }}">
                                                <div class="category-card-inner">
                                                    <div class="category-icon mx-auto">
                                                        @if ($subcat->sub_cat_img)
                                                            <img src="{{ config('app.pub_aws_url') . $subcat->sub_cat_img }}"
                                                                alt="{{ $subcat->sub_cat_name }}" class="img-fluid rounded">
                                                        @else
                                                            <span class="fs-4 {{ $subcat->icon_class }} text-info"></span>
                                                        @endif
                                                    </div>
                                                    <p class="fw-semibold mt-3 text-wrap">{{ $subcat->sub_cat_name }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif

                                    @if ($subcategory && !$subSubcategory)
                                        @foreach ($subSubcategories as $subsubcat)
                                            <a class="category-card text-decoration-none text-dark text-center"
                                                href="{{ route('products-category', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug, 'subSubcategorySlug' => $subsubcat->slug]) }}">
                                                <div class="category-card-inner">
                                                    <div class="category-icon mx-auto">
                                                        @if ($subsubcat->sub_subcat_img)
                                                            <img src="{{ config('app.pub_aws_url') . $subsubcat->sub_subcat_img }}"
                                                                alt="{{ $subsubcat->sub_subcat_name }}" class="img-fluid ">
                                                        @else
                                                            <span class="fs-4 {{ $subsubcat->icon_class }} text-info"></span>
                                                        @endif
                                                    </div>
                                                    <p class="fw-semibold mt-3  text-wrap">{{ $subsubcat->sub_subcat_name }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>


                    </section>

                    <style>
                        /* Scroll Wrapper */
                        .category-scroll-wrapper {
                            overflow-x: auto;
                            white-space: nowrap;
                            padding-bottom: 20px;
                            scrollbar-width: thin;
                            -ms-overflow-style: none;
                            /* background: linear-gradient(45deg, #f0f2f5, #e1e4e8); */
                            border-radius: 12px;
                            /* padding: 10px 20px; */
                            /* margin-bottom: 5px; */
                        }

                        /* Hide Scrollbar */
                        .category-scroll-wrapper::-webkit-scrollbar {
                            display: none;
                        }

                        /* Horizontal Scroll */
                        .category-scroll {
                            display: flex;
                            gap: 30px;
                        }

                        /* Category Card */
                        .category-card {
                            flex: 0 0 auto;
                            width: 120px;
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                            border-radius: 10px;
                            overflow: hidden;
                        }



                        .category-card-inner {
                            background-color: #fff;
                            padding: 15px;
                            padding-bottom: 5px;
                            border-radius: 12px;
                            transition: all 0.3s ease;
                            text-align: center;
                        }

                        /* Category Icon */
                        .category-icon img {
                            width: 60px;
                            height: 60px;
                            object-fit: cover;
                            transition: transform 0.3s ease;
                        }


                        /* Category Name */
                        .category-card p {
                            font-size: 14px;
                            font-weight: 600;
                            color: #333;
                            margin-top: 10px;
                        }

                        /* Responsive Styling */
                        @media (max-width: 768px) {
                            .category-card {
                                width: 100px;
                            }

                            .category-icon img {
                                width: 40px;
                                height: 40px;
                            }

                            .category-card p {
                                font-size: 12px;
                            }
                        }
                    </style>


                    <!-- Category close ============================-->


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
                            /* margin-bottom: 8px; */
                        }
                    </style>

                    <div class="products-container mt-4">
                        <div class="row gx-3 gy-6 mb-8">
                            @if ($products->isEmpty())
                                <div class="col-12">
                                    <h4 class="text-center text-danger">Products not Found.</h4>
                                </div>
                            @else
                                @foreach ($products as $product)
                                    <div class="col-6 col-sm-6 col-md-3 col-xxl-2 ">
                                        <div class="product-card-container h-100 position-relative  bg-white rounded-3">
                                            <div class="product-card shadow-lg rounded-3 overflow-hidden h-100 bg-white transition"
                                                title="View product">
                                                <div class="product-image position-relative ">
                                                    <img class="img-fluid transition rounded-1" loading="lazy"
                                                        src="{{ config('app.pub_aws_url') . $product->product_img }}"
                                                        alt="{{ $product->title }}" />

                                                </div>
                                                <div class="px-2 py-3 d-flex flex-column">
                                                    <a class="text-decoration-none stretched-link"
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
                                                            {{ $product->country->currency_symbol ?? '' }}
                                                            {{ $product->min_price }}
                                                        </span>
                                                        -
                                                        <span class="price">
                                                            {{ $product->country->currency_symbol ?? '' }}
                                                            {{ $product->max_price }}
                                                            ({{ $product->country->currency ?? '' }})
                                                        </span>
                                                    </div>
                                                    <p class="text-muted small p-1 m-0">Min Order: {{ $product->min_order }}</p>
                                                    <p class="text-muted small text-truncate p-1 m-0"
                                                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        Business Type: {{ $product->business_type }}</p>
                                                    <div class="d-flex align-items-center  ">
                                                        <img style="width: 55px; mix-blend-mode: multiply;"
                                                            src="{{asset('../../assets/img/logos/varify.gif')}}" alt="Verified">
                                                        <span class="small fw-bold text-success ms-2">
                                                            @if (!empty($product->country->flag_img) && file_exists(public_path('assets/' . $product->country->flag_img)))
                                                                <img class="flag" loading="lazy"
                                                                    src="{{ asset('assets/' . $product->country->flag_img) }}"
                                                                    alt="{{ $product->country->short_name ?? 'Product Image' }}" />
                                                            @else
                                                                <img class="img-fluid transition rounded-1" loading="lazy"
                                                                    src="{{ asset('assets/img/no-image.png') }}"
                                                                    alt="No Image Available" />
                                                            @endif
                                                            {{ $product->country->iso3 ?? 'N/A' }}

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div x-intersect="$wire.loadMore()"></div>

                        @if ($products->hasMorePages())
                            <div class="text-center">
                                <div class="text-end my-4" wire:loading wire:target="loadMore">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading more products...</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <style>
                        .product-card {
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        }

                        .product-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
                        }

                        .flag {
                            width: 24px;
                            /* height: 16px; */
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
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>

    <livewire:front.layout.footer />

</div>