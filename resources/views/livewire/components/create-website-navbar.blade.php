<div>
    {{--
    <livewire:seller.layout.header /> --}}
    <div class="sidebar-container">
        <div class="sidebar">
            <ul class="nav-links">
                <li><a href="{{ route('logo') }}"><i class="fas fa-image"></i> Logo</a></li>
                <li><a href="{{ route('socialmedia') }}"><i class="fas fa-share-alt"></i> Social Media</a></li>
                <li><a href="{{ route('contact_us') }}"><i class="fas fa-phone"></i> Contact Us</a></li>
                <li><a href="{{ route('pro_cat') }}"><i class="fas fa-box"></i> Product Category</a></li>
                <li><a href="{{ route('pro') }}"><i class="fas fa-tag"></i> Products</a></li>
                <li><a href="{{ route('slider') }}"><i class="fas fa-sliders-h"></i> Slider</a></li>
                <li><a href="{{ route('testimonial') }}"><i class="fas fa-comment"></i> Testimonial</a></li>
                <li><a href="{{ route('team') }}"><i class="fa-solid fa-people-group"></i>Team</a></li>
                <li><a href="{{ route('company_info') }}"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="{{ route('whychoose') }}"><i class="fas fa-star"></i> Why Choose Us</a></li>
                <li><a href="{{ route('certificate') }}"><i class="fa-solid fa-trophy"></i> Certificate</a></li>
                <li><a href="{{ route('gallery') }}"><i class="fas fa-camera"></i> Photo Gallery</a></li>
                <li><a href="{{ route('videos') }}"><i class="fa-solid fa-video"></i> Video</a></li>
                <li><a href="{{ route('brochure') }}"><i class="fa-solid fa-cubes-stacked"></i> brochure</a></li>
                <li><a href="{{ route('terms-conditions-website') }}"><i class="fa-solid fa-file-contract"></i> Terms &
                        Conditions</a>
                </li>
                <li><a href="{{ route('refund-policy') }}"><i class="fa-solid fa-money-bill-wave"></i> Refund Policy</a>
                </li>
                <li><a href="{{ route('privacypolicy') }}"><i class="fa-solid fa-shield-halved"></i> privacy Policy</a>
                </li>
                <li><a href="{{ route('where-we-exportcountry') }}"><i class="fa-solid fa-route"></i> Where We Export
                        country</a></li>
            </ul>
        </div>
    </div>

    <style>
        .sidebar-container {
            width: 100%;
            background: #ebebeb;
            height: 100%;
            position: static;
            top: 120px;
            left: 0;
            overflow-y: auto;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            padding: 20px 0;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links li {
            padding: 10px 20px;
        }

        .nav-links li a {
            color: rgb(0, 0, 0);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.3s;
        }

        .nav-links li a:hover {
            /* background-color: green; */
            color: #123bf3;
            /* padding: 10px 0; */

            /* padding: 10px; */
            /* gap: 10px; */
        }

        @media (max-width: 768px) {


            .sidebar-container {
                width: 100%;
                height: auto;
                position: relative;
                overflow-x: auto;
                top: 0px;
                left: 0;
                white-space: nowrap;
            }

            .sidebar {
                flex-direction: row;
                display: flex;
                overflow-x: auto;
                white-space: nowrap;
            }

            .nav-links {
                display: flex;
                flex-direction: row;
                overflow-x: auto;
                width: max-content;
            }

            .nav-links li {
                display: inline-block;
                padding: 10px;
            }
        }
    </style>





</div>