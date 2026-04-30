<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Catalog') — BookXchange</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

{{-- ── Navbar ──────────────────────────────────────────────── --}}
<nav class="navbar navbar-expand-md navbar-dark be-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('catalog.index') }}">
            <i class="bi bi-book-half me-1"></i>BookXchange
        </a>

        <div class="d-flex align-items-center gap-1">
            {{-- Mobile: opens sidebar offcanvas --}}
            <button class="btn btn-outline-light btn-sm d-lg-none"
                    data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                    aria-label="Toggle sidebar">
                <i class="bi bi-layout-sidebar"></i>
            </button>
            {{-- Desktop: collapses sidebar inline --}}
            <button class="btn btn-outline-light btn-sm d-none d-lg-flex"
                    id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="bi bi-layout-sidebar"></i>
            </button>
            {{-- Navbar collapse (hamburger) --}}
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navMain">
            {{-- Search --}}
            <form class="d-flex mx-auto my-2 my-md-0" style="max-width:480px; width:100%;"
                  method="GET" action="{{ route('catalog.index') }}">
                <input class="form-control me-1" type="search" name="q"
                       placeholder="Search by title or author…"
                       value="{{ request('q') }}">
                <select class="form-select me-1" name="category" style="max-width:140px;">
                    <option value="">All categories</option>
                    @foreach($navCategories ?? [] as $cat)
                        <option value="{{ $cat->slug }}"
                            {{ request('category') === $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            {{-- User area (right) --}}
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Log in
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="navbar-text">
                            <i class="bi bi-person-circle me-1"></i>
                            <strong>{{ auth()->user()->username }}</strong>
                            <span class="badge bg-secondary ms-1">{{ auth()->user()->role }}</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light ms-2">
                                <i class="bi bi-box-arrow-right"></i> Log out
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

{{-- ── Body wrapper ─────────────────────────────────────────── --}}
<div class="be-wrapper">

    {{-- Sidebar — offcanvas on mobile, inline on desktop --}}
    <aside class="offcanvas-lg offcanvas-start be-sidebar" id="sidebar"
           tabindex="-1" aria-labelledby="sidebarLabel">

        {{-- Offcanvas header (mobile only) --}}
        <div class="offcanvas-header d-lg-none border-bottom pb-2">
            <span class="fw-semibold" id="sidebarLabel">
                <i class="bi bi-book-half me-1"></i>BookXchange
            </span>
            <button type="button" class="btn-close"
                    data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
        </div>

        <div class="offcanvas-body flex-column p-0 d-flex">

            <p class="sidebar-heading text-uppercase mt-1">
                <i class="bi bi-compass"></i> Browse
            </p>
            <a class="sidebar-link {{ request()->routeIs('catalog.index') ? 'active' : '' }}"
               href="{{ route('catalog.index') }}">
                <i class="bi bi-grid-3x3-gap"></i> All Books
            </a>

            <p class="sidebar-heading text-uppercase mt-3">
                <i class="bi bi-tags"></i> Categories
            </p>
            @foreach($navCategories ?? [] as $cat)
                <a class="sidebar-link {{ request('category') === $cat->slug ? 'active' : '' }}"
                   href="{{ route('catalog.index', ['category' => $cat->slug]) }}">
                    <i class="bi bi-journal-bookmark"></i> {{ $cat->name }}
                </a>
            @endforeach

            @auth
                <p class="sidebar-heading text-uppercase mt-3">
                    <i class="bi bi-person"></i> My Account
                </p>
                <a class="sidebar-link {{ request()->routeIs('profile.index') ? 'active' : '' }}"
                   href="{{ route('profile.index') }}">
                    <i class="bi bi-collection"></i> My Books
                </a>
                <a class="sidebar-link" href="{{ route('profile.index') }}#inbox">
                    <i class="bi bi-inbox"></i> Inbox
                </a>
                <a class="sidebar-link {{ request()->routeIs('books.create') ? 'active' : '' }}"
                   href="{{ route('books.create') }}">
                    <i class="bi bi-plus-circle"></i> Publish a Book
                </a>

                @if(auth()->user()->isAdmin())
                    <p class="sidebar-heading text-uppercase mt-3">
                        <i class="bi bi-shield-check"></i> Admin
                    </p>
                    <a class="sidebar-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}"
                       href="{{ route('admin.categories') }}">
                        <i class="bi bi-folder2-open"></i> Categories
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.disputes') ? 'active' : '' }}"
                       href="{{ route('admin.disputes') }}">
                        <i class="bi bi-flag"></i> Disputes
                    </a>
                @endif
            @endauth

        </div>
    </aside>

    {{-- Main content --}}
    <main class="be-main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

</div>

{{-- ── Footer ───────────────────────────────────────────────── --}}
<footer class="be-footer">
    <p class="mb-1">&copy; {{ date('Y') }} BookXchange — Second-hand book exchange platform</p>
    <p class="mb-0">
        <a class="footer-link" href="{{ route('contact') }}">
            <i class="bi bi-envelope"></i> Contact
        </a>
        &nbsp;·&nbsp;
        <a class="footer-link" href="{{ asset('como_se_hizo.pdf') }}" target="_blank">
            <i class="bi bi-file-pdf"></i> Project Report
        </a>
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    const sidebar = document.getElementById('sidebar');
    const toggle  = document.getElementById('sidebarToggle');
    const LG      = 992;

    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.classList.add('be-collapsed');
    }

    toggle.addEventListener('click', function () {
        sidebar.classList.toggle('be-collapsed');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('be-collapsed'));
    });
})();
</script>
@stack('scripts')
</body>
</html>
