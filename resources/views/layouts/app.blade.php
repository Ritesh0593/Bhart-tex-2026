<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Bharat Tex 2026 - Mobile Catalog')</title>
    
    <!-- Meta tags for SEO -->
    <meta name="description" content="Explore products and manufacturers at Bharat Tex 2026, the premier global textile expo. Download digital catalogs and spec sheets.">
    <meta name="keywords" content="Bharat Tex 2026, Textile Expo, Mobile Catalog, Indian Textiles, Apparel, Knitwear, Handloom">
    <meta name="robots" content="index, follow">
    
    <!-- Custom Premium Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Premium Mobile Chassis Container -->
    <div class="mobile-container">
        @yield('content')
    </div>

</body>
</html>
