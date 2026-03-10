@push('custom-meta')
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="canonical" href="https://www.globpulse.com/blog/{{ $slug }}" >
        <meta name="author" content="Globpulse">


        <title>{{ $meta_title }}</title>
        <meta name="description" content="{{ $meta_description }}">
        <meta name="keywords" content="{{ $meta_keywords }}">
        <meta property="og:title" content="{{ $meta_title }}">
        <meta property="og:description" content="{{ $meta_description }}">
        <meta property="og:url" content="https://www.globpulse.com/blog/{{ $slug }}/">
        {{--
        <meta property="og:image" content="https://www.gfebusiness.org/frontend/frontend/img/logo/GFE_Logo.png"> --}}
        <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="80">
        <meta property="og:type" content="website">
        {{-- <meta property="fb:app_id" content="261020518084898" /> --}}
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $meta_title }}">
        <meta name="twitter:site" content="@globpulse">
        <meta name="twitter:description" content="{{ $meta_description }}">

        <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
        <meta name="twitter:image:alt" content="b2b marketplace platform">
        <link rel="manifest" href="manifest.json">
        <meta name="msapplication-TileImage" content="images/icon/icon-144x144.png">
        <link rel="dns-prefetch" href="https://www.globpulse.com/">

@endpush


<div>
    <livewire:front.layout.header />

   
<div>
    <style>
        :root {
            --accent: #4e73df;
            --accent-light: #6c8aec;
            --accent-dark: #3b5bdb;
            --card-bg: #ffffff;
            --bg: #f8fafd;
            --text-color: #2e2e2e;
            --text-light: #6c757d;
            --border-radius: 16px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-light: linear-gradient(135deg, #7c93ee 0%, #8a63b5 100%);
        }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.7;
            color: var(--text-color);
        }

        .main-content {
            margin: 0 auto;
            position: relative;
        }

        /* Background decorative elements */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(78, 115, 223, 0.05);
            animation: float 20s infinite ease-in-out;
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            top: 40px;
            left: -100px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: 100px;
            right: 10px;
            animation-delay: 5s;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 80%;
            animation-delay: 10s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            25% {
                transform: translateY(-20px) translateX(10px);
            }

            50% {
                transform: translateY(10px) translateX(-10px);
            }

            75% {
                transform: translateY(-10px) translateX(-20px);
            }
        }

        /* Blog Content Card */
        .blog-content {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 3rem;
        }

        /* Blog Image */
        .blog-image img {
            width: 100%;
            /* height: 400px; */
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        /* Blog Title */
        .blog-title {
            /* font-size: 2rem; */
            color: #444;
            font-weight: 800;
            margin-bottom: 0.85rem;
        }

        /* Blog Meta Info */
        .blog-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .blog-meta i {
            color: var(--accent);
        }

        /* Banner / CTA Card */
        .banner-modern {
            background: var(--gradient);
            border-radius: var(--border-radius);
            padding: 1.75rem 2rem;
            margin: 2rem 0;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .banner-modern:hover {
            background: var(--gradient-light);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-modern {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            color: white;
            padding: 0.65rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modern:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-3px);
        }

        /* Blog Body */
        .blog-body {
            /* font-size: 1.1rem; */
            color: #444;
            line-height: 1.7;
        }

        /* Modal / Form */
        .modal-content {
            border-radius: var(--border-radius);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .modal-header {
            background: var(--gradient);
            border-bottom: none;
            color: white;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        }

        .btn-primary {
            background: var(--gradient);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: var(--gradient-light);
        }

        @media (max-width: 768px) {
            .blog-image img {
                height: 300px;
            }
        }
    </style>

    <main class="main-content container">
        <!-- Background elements -->
        <div class="bg-elements">
            <div class="bg-circle circle-1"></div>
            <div class="bg-circle circle-2"></div>
            <div class="bg-circle circle-3"></div>
        </div>
        <!-- Blog Content -->
        <div class="blog-content mt-5">
            <!-- Image -->
            <div class="blog-image">
                <img src="{{ $blog->thumbnail
    ? env('BLOG_THUMB_URL') . '/' . $blog->thumbnail
    : 'https://via.placeholder.com/600x400/edf2f7/4a5568?text=Blog+Image' 
                    }}"
                    alt="{{ $blog->title }}">
            </div>

            <!-- Title + Meta -->
            <div class="blog-header">
                <h1 class="blog-title">{{ $blog->title }}</h1>
                <div class="blog-meta">
                    {{-- <span><i class="bi bi-tags"></i> {{ $blog->categories->name ?? 'N/A' }}</span>/ --}}
                    <a href="{{ route('blog.category', ['category' => Str::slug($blog->Categories->name)]) }}"
                        class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-normal text-decoration-none">
                        <i class="bi bi-tags"></i>
                        {{ $blog->Categories->name }}
                    </a>/
                    <a href="{{ route('blog.author', ['name' => Str::slug($blog->author->name ?? 'Admin')]) }}"
                        class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-normal text-decoration-none">
                        <i class="bi bi-person me-1"></i> {{ $blog->author->name ?? 'Admin' }}
                    </a>/

                    <span
                        class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold text-decoration-none"
                        style="font-size: 10px;">
                        <i class="bi bi-calendar me-1"></i>
                            {{ 
        $blog->publish_date
    ? \Carbon\Carbon::parse($blog->publish_date)->format('d-m-Y')
    : \Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')
    }}
                        
                    </span>

                </div>
            </div>

            <!-- First CTA Banner -->
            <div class="banner-modern">
                <h4 class="mb-0">🚀 Unlock Global Growth — Let’s Take Your Business International!</h4>
                <button class="btn-modern" data-bs-toggle="modal" data-bs-target="#blogModal">Book Expert Call</button>
            </div>

            <!-- Blog Body / Content -->
            <div class="blog-body">
                {!! $blog->content !!}
            </div>

            <!-- Second CTA Banner -->
            <div class="banner-modern">
                <h4 class="mb-0">🌍 Unlock Global Growth — Let’s Take Your Business International!</h4>
                <button class="btn-modern" data-bs-toggle="modal" data-bs-target="#blogModal">Book Expert Call</button>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header p-4"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-bottom: none; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h2 class="modal-title fs-4 fw-bold d-flex align-items-center text-white">
                        <i class="bi bi-headset me-2" style="font-size:1.5rem;"></i> Enquiry Form
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">
                    <form action="{{ url('store') }}" method="post">
                        @csrf
                        <input type="hidden" name="lead_type" value="blog">
                        <input type="hidden" name="traffic_type" id="traffic_type">
                        <input type="hidden" name="traffic_source" id="traffic_source">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" wire:model="name"
                                    class="form-control form-control-lg shadow-sm" placeholder="Enter your full name"
                                    required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" wire:model="email"
                                    class="form-control form-control-lg shadow-sm" placeholder="Enter your email">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel" name="phone" wire:model="phone"
                                    class="form-control form-control-lg shadow-sm" placeholder="Enter your phone"
                                    required>
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" wire:model="city"
                                    class="form-control form-control-lg shadow-sm" placeholder="Enter your city"
                                    required>
                                @error('city')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea name="message" wire:model="message" class="form-control form-control-lg shadow-sm"
                                rows="4" placeholder="Enter your message"></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-2 shadow-sm"
                                style="border-radius:50px; font-weight:600; transition: all 0.3s ease;">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

    <livewire:front.layout.footer />
</div>