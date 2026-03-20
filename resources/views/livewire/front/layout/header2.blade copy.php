<header>
    <section class="py-0">
        <div class="container-fluid ">
            <div class="ecommerce-topbar">
                <nav class="navbar navbar-expand-lg navbar-light px-0">
                    <div class="row gx-0 gy-2 w-100 flex-between-center">
                        <div class="col-6 col-sm-2 col-md-4 col-lg-3"><a class="text-decoration-none"
                                href="{{ route('home') }}">
                                <div class="d-flex align-items-center">
                                    <img class="w-100" src="../../../assets/img/logos/GFEPLUSE1.png" alt="phoenix" />
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-2 col-md-3 col-lg-3 order-0 order-md-0 order-lg-1">
                            <ul class="navbar-nav navbar-nav-icons justify-content-end flex-row me-n2">
                               @if(session()->has('buyer_id') || session()->has('seller_id') || session()->has('id'))
<li class="nav-item dropdown">

<a class="nav-link px-2" id="navbarDropdownUser" href="#"
role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
aria-haspopup="true" aria-expanded="false">

<span class="text-body-tertiary avatar avatar-xl" style="height:40px;width:40px;">

{{-- PROFILE IMAGE --}}
@if(session()->has('id') && optional($customer)->profile_image)

<img class="rounded-circle w-100"
src="{{ config('app.pub_aws_url') . $customer->profile_image }}"
alt="" />

@else

<img class="rounded-circle"
src="../../../assets/img/team/72x72/57.webp"
alt="" />

@endif

</span>
</a>

<style>
.navbar .dropdown-menu.dropdown-menu-end.navbar-dropdown-caret {
left: auto !important;
right: 0.4375rem !important;
}
</style>

<div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border mt-2"
aria-labelledby="navbarDropdownUser">

<div class="card shadow-lg border-0 rounded-4 overflow-hidden">

<div class="card-body p-4 text-center">

<div class="position-relative d-inline-block">

<div class="avatar avatar-xl rounded-circle border border-2 border-primary overflow-hidden">

@if(session()->has('id') && optional($customer)->profile_image)

<img class="w-100 h-100 object-fit-cover"
src="{{ config('app.pub_aws_url') . $customer->profile_image }}"
alt="Profile Image" />

@else

<img class="w-100 h-100 object-fit-cover"
src="../../../assets/img/team/72x72/57.webp"
alt="Default Avatar" />

@endif

</div>
</div>

{{-- NAME --}}
@if(session()->has('buyer_id'))

<h6 class="mt-3 fw-semibold text-dark">
{{ session('buyer_name') }}
</h6>

@elseif(session()->has('seller_id'))

<h6 class="mt-3 fw-semibold text-dark">
{{ session('seller_name') }}
</h6>

@elseif(session()->has('id'))

<h6 class="mt-3 fw-semibold text-dark">
{{ $customer->name }}
</h6>

@endif

</div>

<div class="overflow-auto px-3" style="max-height: 6rem;">

<ul class="nav flex-column gap-2">

{{-- PROFILE --}}
@if(session()->has('buyer_id'))

<li class="nav-item">
<a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
href="{{ route('buyer.profile') }}">
<i class="fas fa-user me-2"></i> Profile
</a>
</li>

@elseif(session()->has('seller_id'))

<li class="nav-item">
<a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
href="{{ route('seller.profile') }}">
<i class="fas fa-user me-2"></i> Profile
</a>
</li>

@elseif(session()->has('id'))

<li class="nav-item">
<a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
href="{{ route('seller.profile') }}">
<i class="fas fa-user me-2"></i> Profile
</a>
</li>

@endif

{{-- BUYER DASHBOARD --}}
@if(session()->has('buyer_id'))

<li class="nav-item">
<a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
href="{{ route('buyer.dashboard') }}">
<i class="fas fa-chart-line me-2"></i>
Dashboard
</a>
</li>

@endif

{{-- SELLER DASHBOARD --}}
@if(session()->has('seller_id'))

<li class="nav-item">
<a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
href="{{ route('seller.dashboard') }}">
<i class="fas fa-chart-line me-2"></i>
Dashboard
</a>
</li>

@endif

{{-- CUSTOMER DASHBOARD --}}
@if(session()->has('id'))

<li class="nav-item">
<a class="nav-link py-2 px-3 rounded bg-light text-dark d-flex align-items-center gap-2"
href="{{ route('seller.dashboard') }}">
<i class="fas fa-chart-line me-2"></i>
Dashboard
</a>
</li>

@endif

</ul>

</div>

<div class="card-footer border-0 bg-white p-4 text-center">

<button
class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2"
wire:click="logout">

<i class="fa-solid fa-arrow-right-from-bracket text-light"></i>
Sign out

</button>

<div class="mt-3 text-muted small d-flex justify-content-center gap-2 align-items-center">

<span>&bull;</span>

<a href="{{ route('term-conditions') }}"
class="text-decoration-none text-secondary">
Privacy Policy
</a>

<span>&bull;</span>

<a href="{{ route('term-conditions') }}"
class="text-decoration-none text-secondary">
Terms
</a>

<span>&bull;</span>

<a href="#!"
class="text-decoration-none text-secondary">
Cookies
</a>

</div>

</div>

</div>

</div>

</li>

@else
<li>
<div class="d-flex gap-2">

<!-- Sign-in Button -->
<!-- <a href="{{ route('buyer.login') }}"
class="btn-signin d-flex align-items-center me-1 mb-1 text-decoration-none rounded-pill">

<span class="me-2">
<i class="fa-regular fa-user"></i>
</span>

<p class="mb-0 fw-bolder">Sign-in</p>

</a> -->
<div class="dropdown me-1 mb-1">

<a class="btn-signin dropdown-toggle d-flex align-items-center text-decoration-none rounded-pill"
href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
<span class="me-2"><i class="fa-regular fa-user"></i></span>
<p class="mb-0 fw-bolder">Sign-in</p>
</a>

<ul class="dropdown-menu">

<li><a class="dropdown-item" href="{{ route('buyer.login') }}">Buyer Login</a></li>

<li><a class="dropdown-item" href="{{ route('seller.login') }}">Seller Login</a></li>

</ul>

</div>


<!-- Sign-up Button -->
<!-- <a href="{{ route('buyer.signup') }}"
class="btn-signup d-md-flex d-none align-items-center me-1 mb-1 rounded-pill text-white text-decoration-none">

<span class="me-2">
<i class="fa-regular fa-user"></i>
</span>

<p class="mb-0 fw-bolder">Sign-up</p>

</a> -->
<div class="dropdown me-1 mb-1">

<a class="btn-signup dropdown-toggle d-md-flex d-none align-items-center text-white text-decoration-none rounded-pill"
href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
<span class="me-2"><i class="fa-regular fa-user"></i></span>
<p class="mb-0 fw-bolder">Sign-up</p>
</a>

<ul class="dropdown-menu">

<li>
<a class="dropdown-item" href="{{ route('buyer.signup') }}">
Buyer Signup
</a>
</li>

<li>
<a class="dropdown-item" href="{{ route('seller.signup') }}">
Seller Signup
</a>
</li>

</ul>

</div>
<!-- Start Selling -->
<a href="{{ route('start-selling') }}"
class="btn-start-selling d-md-flex d-none align-items-center me-1 mb-1 rounded-pill text-white text-decoration-none">

<span class="me-2">
<i class="fa-solid fa-store"></i>
</span>

<p class="mb-0 fw-bolder">Start Selling</p>

</a>
</div>


<style>

/* Common Styles */

.btn-signin,
.btn-signup,
.btn-start-selling{
font-size:13px;
padding:6px 5px;
transition:all .3s ease;
display:inline-flex;
align-items:center;
justify-content:center;
border-radius:999px;
}


/* SIGN-IN BUTTON */

.btn-signin{
background:#0d6efd;
border:2px solid #0d6efd;
color:#ffffff;
box-shadow:0 2px 6px rgba(0,0,0,.08);
}

.btn-signin:hover{
background:#0d6efd;
color:#fff;
box-shadow:0 8px 18px rgba(13,110,253,.4);
}


/* SIGN-UP BUTTON */

.btn-signup{
background:linear-gradient(45deg,#120860,#120860);
color:#fff;
border:none;
position:relative;
overflow:hidden;
box-shadow:0 4px 12px rgba(0,0,0,.2);
}

.btn-signup::after{
content:"";
position:absolute;
top:0;
left:-75%;
width:50%;
height:100%;
background:rgba(255,255,255,.5);
transform:skewX(-25deg);
animation:shine 2.5s infinite;
}

.btn-signup:hover{
background:linear-gradient(45deg,#ff4b2b,#ff416c);
box-shadow:0 0 20px rgba(255,65,108,.6);
}


/* START SELLING BUTTON */

.btn-start-selling{
background:linear-gradient(45deg,#22c55e,#16a34a);
color:#fff;
border:none;
position:relative;
overflow:hidden;
box-shadow:0 4px 12px rgba(0,0,0,.2);
}

.btn-start-selling::after{
content:"";
position:absolute;
top:0;
left:-75%;
width:50%;
height:100%;
background:rgba(255,255,255,.4);
transform:skewX(-25deg);
animation:shine 2.5s infinite;
}

.btn-start-selling:hover{
background:linear-gradient(45deg,#16a34a,#22c55e);
box-shadow:0 0 20px rgba(34,197,94,.6);
}


/* SHINE ANIMATION */

@keyframes shine{
0%{ left:-75%; }
100%{ left:125%; }
}

</style>
</li>

@endif
                            </ul>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="search-box ecommerce-search-box w-100">
                                <livewire:components.searchbar2 />
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    <nav class="ecommerce-navbar navbar navbar-expand-lg  ">
        <div class="container-fluid ">
            <div class="dropdown position-relative ">
                <button class="btn ps-0 pe-5 text-nowrap dropdown-toggle dropdown-caret-none text-white"
                    id="categoryDropdown">
                    <span class="fas fa-bars me-2 text-light"></span> Category
                </button>
                <div class="dropdown-menu border pb-3 shadow-lg" id="categoryMenu"
                    style="min-width: 300px; max-width: 350px; display: none;">
                    <div class="card border-0 scrollbar" style="width: 100%; height: 500px; overflow-y: auto;">
                        <div class="card-body">
                            @foreach ($categories as $category)
                                <div class="category-item d-flex align-items-center p-2 border-bottom"
                                    data-category-id="{{ $category->id }}">
                                    <span class="text-primary me-2 {{ $category->icon_class }}"></span>
                                    <a href="/products-category/{{ $category->slug }}"
                                        class="text-decoration-none text-dark flex-grow-1">
                                        {{ $category->cat_name }}
                                    </a>
                                    <span class="fas fa-chevron-right text-muted"></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div id="subcategoryPanel" class="position-absolute d-none bg-white shadow-lg p-3 rounded"
                style="width: 100%; max-width: 300px; left: 300px; top: 35px; z-index: 9999;">
                <h5 id="subcategoryTitle" class="border-bottom pb-2"></h5>
                <ul id="subcategoryList" class="list-unstyled"></ul>
            </div>

            <div id="subSubcategoryPanel" class="position-absolute d-none bg-white shadow-lg p-3"
                style="width: 100%; max-width: 300px; left: 650px; top: 0; z-index: 9999;">
                <h5 id="subSubcategoryTitle" class="border-bottom pb-2"></h5>
                <ul id="subSubcategoryList" class="list-unstyled"></ul>
            </div>

            <style>
                .dropdown-menu {
                    padding: 0 !important;
                }

                @media (max-width: 768px) {

                    #subcategoryPanel {
                        display: none;
                    }
                }
            </style>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let dropdown = document.getElementById("categoryDropdown");
                    let menu = document.getElementById("categoryMenu");
                    let subcategoryPanel = document.getElementById("subcategoryPanel");
                    let subcategoryTitle = document.getElementById("subcategoryTitle");
                    let subcategoryList = document.getElementById("subcategoryList");
                    let subSubcategoryPanel = document.getElementById("subSubcategoryPanel");
                    let subSubcategoryTitle = document.getElementById("subSubcategoryTitle");
                    let subSubcategoryList = document.getElementById("subSubcategoryList");
                    let categories = @json($categories->keyBy('id'));
                    dropdown.addEventListener("click", function(event) {
                        event.stopPropagation();
                        menu.style.display = menu.style.display === "block" ? "none" : "block";
                    });

                    document.querySelectorAll(".category-item").forEach(item => {
                        item.addEventListener("mouseenter", function() {
                            let categoryId = this.dataset.categoryId;
                            let category = categories[categoryId];

                            subcategoryList.innerHTML = "";
                            subcategoryTitle.innerText = category.cat_name;
                            subSubcategoryPanel.classList.add("d-none");

                            if (category.subcategory && category.subcategory.length > 0) {
                                category.subcategory.forEach(sub => {
                                    let li = document.createElement("li");
                                    let a = document.createElement("a");
                                    a.href = `/products-category/${category.slug}/${sub.slug}`;
                                    a.className =
                                        "text-decoration-none d-block text-dark px-2 py-1 border-bottom my-1 subcategory-item";
                                    a.innerText = sub.sub_cat_name;
                                    a.dataset.subcategoryId = sub.id;
                                    a.dataset.categorySlug = category.slug;
                                    li.appendChild(a);
                                    subcategoryList.appendChild(li);
                                });
                                subcategoryPanel.classList.remove("d-none");
                            } else {
                                subcategoryPanel.classList.add("d-none");
                            }
                        });
                    });

                    subcategoryList.addEventListener("mouseover", function(event) {
                        let target = event.target.closest(".subcategory-item");
                        if (!target) return;

                        let subcategoryId = target.dataset.subcategoryId;
                        let categorySlug = target.dataset.categorySlug;
                        let allSubcategories = @json($categories->pluck('subcategory')->flatten()->keyBy('id'));
                        let subcategory = allSubcategories[subcategoryId];

                        subSubcategoryList.innerHTML = "";
                        subSubcategoryTitle.innerText = target.innerText;

                        if (subcategory && subcategory.subsubcategory && subcategory.subsubcategory.length > 0) {
                            subcategory.subsubcategory.forEach(subsub => {
                                let li = document.createElement("li");
                                let a = document.createElement("a");
                                a.href =
                                    `/products-category/${categorySlug}/${subcategory.slug}/${subsub.slug}`;
                                a.className =
                                    "text-decoration-none d-block text-dark px-2 py-1 rounded my-1";
                                a.innerText = subsub.sub_subcat_name;
                                li.appendChild(a);
                                subSubcategoryList.appendChild(li);
                            });

                            subSubcategoryPanel.classList.remove("d-none");
                            subSubcategoryPanel.style.display = "block";

                            let rect = target.getBoundingClientRect();
                            subSubcategoryPanel.style.top = rect.top + "px";
                            subSubcategoryPanel.style.left = (rect.right + 10) + "px";
                        } else {
                            subSubcategoryPanel.classList.add("d-none");
                            subSubcategoryPanel.style.display = "none";
                        }
                    });

                    document.addEventListener("click", function() {
                        menu.style.display = "none";
                        subcategoryPanel.classList.add("d-none");
                        subSubcategoryPanel.classList.add("d-none");
                        subSubcategoryPanel.style.display = "none";
                    });

                    window.addEventListener("resize", function() {
                        if (window.innerWidth < 768) {
                            menu.style.width = "100%";
                            subcategoryPanel.style.width = "100%";
                            subSubcategoryPanel.style.width = "100%";
                        } else {
                            menu.style.width = "350px";
                            subcategoryPanel.style.width = "300px";
                            subSubcategoryPanel.style.width = "300px";
                        }
                    });
                });
            </script>

            <div>
                <!-- Navbar Toggle (3-Line Button for mobile) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="dropdown"
                    data-bs-target="#navbarDropdown">
                    <span class="hamburger-icon"></span>
                </button>

                <!-- More Dropdown for mobile/tablet screens -->
                <div class="d-lg-none">
                    <a class="fs-9  me-3 text-white" href="{{ route('home') }}">Home</a>
                    <div class="dropdown d-lg-none">
                        <div class="d-flex ">



                            <a class="fs-9 nav-link dropdown-toggle text-white" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More
                            </a>
                        </div>
                        <ul class="dropdown-menu droplinks-1" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="{{ route('home') }}">Home</a></li> --}}
                            <li><a class="dropdown-item" href="{{ route('packages') }}">Membership Plans</a></li>
                            <li><a class="dropdown-item" href="{{ route('byleads') }}">Buy Leads</a></li>
                            <li><a class="dropdown-item" href="{{ route('hotdeal') }}">Hot Deals</a></li>
                            <li class="d-block d-md-none"><a class="dropdown-item"
                                    href="{{ route('postbyrequirement') }}"
                                    wire:click.prevent="redirectToPostByRequirement">Post Buy Requirements</a></li>
                         @if (!session('buyer_id') && !session('seller_id') && !session('id'))

<li class="d-block d-md-none">
<a class="dropdown-item" href="{{ route('buyer.signup') }}">
Become Supplier
</a>
</li>

@else

<li class="d-block d-md-none">
<a class="dropdown-item"
href="{{ route('product_add') }}"
wire:click.prevent="redirectToProductAdd">
Sell Now
</a>
</li>

@endif
                            <li><a class="dropdown-item" href="{{ route('trade-finance-solutions') }}">Trade
                                    Finance</a>
                            </li>
                            <li><a class="dropdown-item" href="https://gfecci.org" target="_blank">GFE Chamber</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Navbar Items (for desktop) -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ">
                        <!-- Home link on desktop, hidden on mobile -->
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('packages') }}">Membership Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('byleads') }}">Buy Leads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('hotdeal') }}">Hot Deals</a>
                        </li>
                        <li class="nav-item d-block d-md-none">
                            <a class="nav-link text-white" href="{{ route('postbyrequirement') }}"
                                wire:click.prevent="redirectToPostByRequirement">Post Buy Requirements</a>
                        </li>
                       @if (!session('buyer_id') && !session('seller_id') && !session('id'))

<li class="nav-item d-block d-md-none">
<a class="nav-link text-white" href="{{ route('signup') }}">
Become Supplier
</a>
</li>

@else

<li class="nav-item d-block d-md-none">
<a class="nav-link text-white"
href="{{ route('product_add') }}"
wire:click.prevent="redirectToProductAdd">
Sell Now
</a>
</li>

@endif
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('trade-finance-solutions') }}">Trade
                                Finance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="https://gfecci.org/" target="_blank">GFE Chamber</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <style>
        .navbar .dropdown-menu.dropdown-menu-end.navbar-dropdown-caret {
            left: auto !important;
            right: 10px !important;
        }
    </style>
    <!-- CSS -->
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Hamburger Button */
        .navbar-toggler {
            background: none;
            border: none;
            cursor: pointer;
            display: none;
            flex-direction: column;
            gap: 5px;
            padding: 10px;
        }

        .dropdown .dropdown-menu {
            overflow: visible;
            left: 1.5625rem;
        }

        .dropdown .drop-link-1 {
            overflow: visible;
            left: 1.5625rem;
        }

        .hamburger-icon {
            width: 25px;
            height: 3px;
            background-color: white;
            display: block;
            position: relative;
        }

        .hamburger-icon::before,
        .hamburger-icon::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: white;
            left: 0;
        }

        .hamburger-icon::before {
            top: -8px;
        }

        .hamburger-icon::after {
            top: 8px;
        }

        /* Navbar for mobile */
        @media (max-width: 991px) {
            .d-none.d-lg-block {
                display: none;
            }
        }

        /* Show dropdown on hover (desktop) */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown .dropdown-menu {
            overflow: hidden;
            left: -1.800rem;
        }


        .droplinks-1 {
            overflow: hidden;
            left: -5.900rem !important;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            width: 100%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-menu a {
            padding: 10px;
            display: block;
            color: black;
            text-decoration: none;
            transition: 0.3s;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>



    <!-- Responsive Styles -->
    <style>
        .category-dropdown-menu {
            width: 100%;
            max-width: 1200px;
            scroll-behavior: smooth
        }

        @media (max-width: 991px) {
            .category-dropdown-menu {
                max-width: 100%;
            }
        }
    </style>

    <!-- Script for Dropdown Hover -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    document.querySelectorAll('.subcategories').forEach(sub => sub.classList.add(
                        'd-none'));
                    let subcategory = this.nextElementSibling;
                    if (subcategory) subcategory.classList.remove('d-none');
                });
            });
        });
    </script>




</header>
