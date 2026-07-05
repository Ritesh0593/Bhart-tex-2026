<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Spec Sheet - {{ $product->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1C1A17;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
            font-size: 14px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #E6006B;
            padding-bottom: 20px;
        }
        .logo {
            height: 60px;
            width: auto;
            margin-bottom: 10px;
        }
        .header-title {
            font-size: 20px;
            font-weight: bold;
            color: #1C1A17;
            margin: 0;
        }
        .header-subtitle {
            font-size: 13px;
            color: #6B6661;
            margin: 5px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .product-image-container {
            text-align: center;
            margin-bottom: 25px;
        }
        .product-image {
            max-width: 250px;
            height: auto;
            border-radius: 8px;
        }
        .product-title-section {
            margin-bottom: 20px;
        }
        .product-title {
            font-size: 22px;
            font-weight: bold;
            color: #1C1A17;
            margin: 0 0 5px 0;
        }
        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #E6006B;
            margin: 0;
        }
        .spec-list {
            margin-bottom: 25px;
        }
        .spec-item {
            padding: 6px 0;
            font-size: 14px;
            font-weight: 500;
            color: #1C1A17;
        }
        .divider {
            border-top: 1px solid #E6DED6;
            margin: 20px 0;
        }
        .description-section {
            margin-top: 20px;
        }
        .description-title {
            font-size: 16px;
            font-weight: bold;
            color: #1C1A17;
            margin: 0 0 10px 0;
        }
        .description-text {
            color: #6B6661;
            font-size: 13px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #6B6661;
            border-top: 1px solid #E6DED6;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <!-- Header matching Page 4 of PDF -->
    <div class="header">
        @if(file_exists(public_path('images/logo.png')))
            <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        @endif
        <div class="header-title">Bharat Tex 2026</div>
        <div class="header-subtitle">Global Textile Expo</div>
    </div>

    <!-- Product Image -->
    <div class="product-image-container">
        @if($product->images->isNotEmpty())
            <img src="{{ public_path($product->images->first()->image_path) }}" class="product-image" alt="{{ $product->name }}">
        @endif
    </div>

    <!-- Title and Price -->
    <div class="product-title-section">
        <h1 class="product-title">{{ $product->name }}</h1>
        <div class="product-price">₹{{ number_format($product->price) }}</div>
    </div>

    <!-- Specifications List matching Page 4 of PDF exactly -->
    <div class="spec-list">
        <div class="spec-item">Category &ndash; {{ $product->category->name }}</div>
        <div class="spec-item">Product Type &ndash; {{ $product->product_type }}</div>
        <div class="spec-item">Material &ndash; {{ $product->material }}</div>
        <div class="spec-item">Fabric GSM &ndash; {{ $product->gsm }} GSM</div>
        <div class="spec-item">Color &ndash; {{ $product->color }}</div>
        <div class="spec-item">Size Available &ndash; {{ $product->sizes }}</div>
        <div class="spec-item">Brand Name &ndash; {{ $product->brand_name }}</div>
        <div class="spec-item">Manufacturer &ndash; {{ $product->manufacturer }}</div>
        <div class="spec-item">State &ndash; {{ $product->state }}</div>
        <div class="spec-item">District &ndash; {{ $product->district }}</div>
        <div class="spec-item">Address &ndash; {{ $product->address }}</div>
        <div class="spec-item">Mobile Number &ndash; {{ $product->mobile }}</div>
    </div>

    <div class="divider"></div>

    <!-- Product Description -->
    <div class="description-section">
        <h2 class="description-title">Product Description</h2>
        <p class="description-text">{{ $product->description }}</p>
    </div>

    <!-- Footer branding -->
    <div class="footer">
        Generated automatically at Bharat Tex 2026 Global Expo. All rights reserved.
    </div>

</body>
</html>
