<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard | Bharat Tex 2026')</title>
    
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    
    <!-- Cropper.js CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" rel="stylesheet">
</head>
<body class="admin-body">

    <!-- Admin Wrapper -->
    <div class="admin-wrapper">
        <header class="admin-header">
            <div class="admin-brand">
                <a href="{{ route('admin.dashboard') }}">Bharat Tex 2026 Admin</a>
            </div>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                <a href="{{ route('welcome') }}" target="_blank" class="view-catalog-link">View Catalog &rarr;</a>
                
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="admin-logout-btn">Logout</button>
                </form>
            </nav>
        </header>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="admin-alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="admin-alert error" style="background-color: #FEF2F2; border: 1px solid #FCA5A5; color: #DC2626;">
                {{ session('error') }}
            </div>
        @endif

        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    <!-- Cropper.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    @yield('scripts')
</body>
</html>
