@push('custom-meta')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>B2B Marketplace Blog, B2B Trade News, Wholesale, Logistics & Trends | Globpulse</title>
    <meta name="description"
        content="Explore the latest B2B marketplace insights, trade news, wholesale business tips, logistics updates, and global trends to grow your international business.">

    <meta name="keywords"
        content="b2b marketplace blog, b2b trade news, wholesale marketplace, global trade insights, import export business, international trade platform, supply chain trends, global trade news, export import guide, b2b business strategies, trade market insights">

    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}" />


    <meta name="author" content="Globpulse">
    <meta property="og:title" content="B2B Marketplace Blog, B2B Trade News, Wholesale, Logistics & Trends | Globpulse">

    <meta property="og:description"
        content="Explore the latest B2B marketplace insights, trade news, wholesale business tips, logistics updates, and global trends to grow your international business.">

    <meta property="og:url" content="https://www.globpulse.com//b2b-marketplace-blog/">
    <meta property="og:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="80">
    <meta property="og:type" content="website">

    <meta name="twitter:image" content="https://www.globpulse.com/assets/img/icons/gfe.svg">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="B2B Marketplace Blog, B2B Trade News, Wholesale, Logistics & Trends | Globpulse">
    <meta name="twitter:site" content="@globpulse">
    <meta name="twitter:description"
        content="Explore the latest B2B marketplace insights, trade news, wholesale business tips, logistics updates, and global trends to grow your international business.">
    <meta name="twitter:image:alt" content="GFE Business Logo">

@endpush


<div>
    <livewire:front.layout.header />

<div>

    <div class="container-fluid pb-5">
        <main class="main-content">
            <div class="text-center mb-5">
                <h1 class="fw-bold text-primary d-inline-block position-relative mt-3 py-2 fs-5">
                    {{ $pageTitle ?? 'B2B Marketplace Blog, Trade News & Global Business Insights' }}
                    <span class="position-absolute start-50 translate-middle-x bottom-0"></span>
                </h1>

                <p class="lead text-muted mt-3">
                    @if ($isCategory)
                        Showing all posts under <strong>"{{ $categoryName }}"</strong> category.
                    @elseif ($isAuthor)
                        Showing all posts written by <strong>{{ $authorName }}</strong>.
                    @else
                        
                    @endif
                </p>
            </div>




            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-md-6 col-lg-4 ">
                        <article class="blog-card flex-fill shadow-lg border-0 rounded-4 overflow-hidden transform-on-hover">
                            <div class="blog-card-img-wrapper">
                                <img     src="{{ $blog->thumbnail ? env('BLOG_THUMB_URL') . '/' . $blog->thumbnail : 'https://via.placeholder.com/600x400/edf2f7/4a5568?text=Blog+Image' }}" alt="{{ $blog->title }}" class="blog-card-img img-fluid w-100 h-100">
                                <div class="blog-card-overlay d-flex align-items-center justify-content-center">
                                    <a href="{{route('blog-detile', ['slug' => $blog->slug]) }}"
                                        class="btn btn-outline-light btn-lg rounded-pill px-4"> Read More </a>
                                </div>
                            </div>

                                                                                            <!-- Card Body -->
                            <div class="blog-card-body d-flex flex-column p-4">
                                <div class="row justify-content-between align-items-center mb-2">
                                    <div class="col-12 col-lg-6">
                                        <a href="{{ route('blog.category', ['category' => Str::slug($blog->Categories->name)]) }}"
                                        class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-normal text-decoration-none">
                                        {{ $blog->Categories->name ?? 'NA' }}</a>
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3 mt-lg-0 text-start text-lg-end">
                                        <time class="date-pill"><i class="bi bi-clock-history me-1"></i>
                                        {{ $blog->publish_date ? \Carbon\Carbon::parse($blog->publish_date)->format('d-m-Y') : \Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')}}</time>
                                    </div>
                                </div>

                                        <h2 class="blog-card-title fw-bold mb-3 text-truncate" title="{{ $blog->title }}">{{ $blog->title }}</h2>

                                    <div class="blog-card-text text-secondary mb-4 flex-grow-1" style="text-align: justify;">
                                        {!! $this->limitWordsHtml($blog->content, 25) !!}
                                    </div>

                                                                                                <!-- Author -->
                                                                                                <div class="d-flex align-items-center pt-3 border-top">
                                                                                                    @php
    $authorName = $blog->Author?->name ?? 'Unknown Author';
    $nameParts = explode(' ', trim($authorName));
    $initials = strtoupper(
        substr($nameParts[0] ?? 'U', 0, 1) . substr($nameParts[1] ?? '', 0, 1),
    );
                                                                                                    @endphp

                                                                                                    <!-- Avatar with tooltip -->
                                                                                                    <div class="avatar-gradient rounded-pill me-2" data-bs-toggle="tooltip"
                                                                                                        data-bs-placement="top" title="{{ $authorName }}">
                                                                                                        <span class="fw-bold">{{ $initials }}</span>
                                                                                                    </div>

                                                                                                    <!-- Author name as clickable link -->
                                                                                                    <div>
                                                                                                        <a href="{{ route('blog.author', ['name' => Str::slug($authorName)]) }}"
                                                                                                            class="text-decoration-none fw-semibold text-dark">
                                                                                                            {{ $authorName }}
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>



                                                                                            </div>
                                                                                        </article>
                                                                                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
          @if ($totalBlogs > 0)
    <div class="card-footer  p-2 mt-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="bg-primary-subtle p-2 rounded text-black-50 fw-bold small mb-2 mb-md-0">
                Showing {{ ($currentPage - 1) * $perPage + 1 }}
                to {{ min($currentPage * $perPage, $totalBlogs) }}
                of <span class="">{{ $totalBlogs }}</span> entries
            </div>

            <div class="d-flex flex-wrap gap-1">
                @php
    $totalPages = ceil($totalBlogs / $perPage);
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);
                @endphp

                <!-- Prev -->
                <button wire:click.prevent="prevPagePost" class="btn btn-sm btn-outline-primary"
                    {{ $currentPage == 1 ? 'disabled' : '' }}>
                    &laquo; Prev
                </button>

                <!-- First -->
                @if ($startPage > 1)
                    <button wire:click.prevent="gotoPage(1)" class="btn btn-sm btn-outline-primary"
                        wire:key="page-1">1</button>
                    @if ($startPage > 2)
                        <span class="px-2">...</span>
                    @endif
                @endif

                <!-- Middle Pages -->
                @for ($i = $startPage; $i <= $endPage; $i++)
                    <button wire:click.prevent="gotoPage({{ $i }})"
                        class="btn btn-sm {{ $currentPage == $i ? 'btn-primary' : 'btn-outline-primary' }}"
                        wire:key="page-{{ $i }}">
                        {{ $i }}
                    </button>
                @endfor

                <!-- Last -->
                @if ($endPage < $totalPages)
                    @if ($endPage < $totalPages - 1)
                        <span class="px-2">...</span>
                    @endif
                    <button wire:click.prevent="gotoPage({{ $totalPages }})"
                        class="btn btn-sm btn-outline-primary"
                        wire:key="page-{{ $totalPages }}">{{ $totalPages }}</button>
                @endif

                <!-- Next -->
                <button wire:click.prevent="nextPagePost" class="btn btn-sm btn-outline-primary"
                    {{ $currentPage >= $totalPages ? 'disabled' : '' }}>
                    Next &raquo;
                </button>
            </div>
        </div>
    </div>
@endif





        </main>
    </div>

    <style>
        :root {
            --primary-color: #6a68ff;
            /* A vibrant purple/blue */
            --primary-light-color: #e0e0ff;
            --secondary-color: #4a5568;
            /* Darker gray for text */
            --background-light: #f7fafc;
            /* Light background for the page */
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.08);
            --transition-speed: 0.3s ease;
        }

        body {
            background-color: var(--background-light);
            font-family: 'Inter', sans-serif;
            /* A modern sans-serif font */
            color: var(--secondary-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .bg-primary-subtle {
            background-color: var(--primary-light-color) !important;
        }

        .blog-card {
            background-color: var(--card-bg);
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 2rem var(--shadow-color);
        }

        .date-pill {
            background-color: var(--primary-light-color);
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .blog-card:hover .date-pill {
            background-color: #9b8fff;
            color: #fff;
            transform: translateY(-2px);
        }


        .blog-card-img-wrapper {
            position: relative;
            height: 270px;
            width: 100%;
            /* Consistent image height */
            overflow: hidden;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .blog-card-img {
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-card-img {
            transform: scale(1.02);
        }

        .blog-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            /* Slightly darker overlay on hover */
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .blog-card:hover .blog-card-overlay {
            opacity: 1;
        }

        .blog-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .blog-card-title {
            /* font-size: 1.25rem; */
            line-height: 1.4;
            color: #4a5568;
            min-height: 3rem;
            /* Ensure consistent height for title */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .blog-card-text {
            font-size: 0.95rem;
            line-height: 1.6;
            /* min-height: 4rem; */
            /* Consistent height for excerpt */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #718096;
            /* A slightly lighter gray for body text */
        }

        .avatar-gradient {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #9b8fff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s var(--transition-speed);
        }

        .avatar-gradient:hover {
            transform: scale(1.03);
            cursor: default;
            box-shadow: 0 4px 12px rgba(106, 104, 255, 0.4);
        }


        /* Read More button within the overlay */
        .blog-card-overlay .btn {
            border-color: rgba(255, 255, 255, 0.7);
            color: rgba(255, 255, 255, 0.9);
        }

        .blog-card-overlay .btn:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }
    </style>

</div>

<livewire:front.layout.footer />

</div>