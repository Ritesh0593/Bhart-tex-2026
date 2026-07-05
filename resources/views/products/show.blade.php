@extends('layouts.app')

@section('title', $product['name'] . ' | Bharat Tex 2026')

@section('content')
<!-- Header matching Page 4 of PDF -->
<header class="app-header">
    <a href="{{ route('categories.show', $category['slug']) }}" class="header-back-link" id="btn-back-product-list">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        <span>Back</span>
    </a>
    
    <div class="header-logo-center">
        <img src="{{ asset('images/logo.png') }}" alt="Bharat Tex 2026 Logo" class="header-logo-img">
    </div>
</header>

<!-- Breadcrumbs matching Page 4 of PDF -->
<div class="breadcrumb-container">
    <div class="breadcrumbs-exact">
        Home &gt; Categories &gt; Product line &gt; Product details
    </div>
</div>

<!-- Product Gallery (Main Image & Thumbnails) -->
<div class="product-gallery">
    <div class="main-image-wrapper">
        <img id="main-product-image" class="fade-in" src="{{ asset($product['images'][0]) }}" alt="{{ $product['name'] }}">
    </div>
    
    @if(count($product['images']) > 1)
        <div class="thumbnails-row">
            @foreach($product['images'] as $index => $img)
                <button class="thumbnail-btn {{ $index === 0 ? 'active' : '' }}" data-src="{{ asset($img) }}" aria-label="View Image {{ $index + 1 }}">
                    <img src="{{ asset($img) }}" alt="Thumbnail {{ $index + 1 }}">
                </button>
            @endforeach
        </div>
    @endif
</div>

<!-- Product Information & Specifications -->
<main class="details-content">
    <div class="product-title-row-exact">
        <h1 class="product-detail-title-exact">{{ $product['name'] }}</h1>
        <div class="product-detail-price-exact">
            ₹{{ number_format($product['price']) }}
        </div>
    </div>

    <!-- Specifications List matching PDF Layout -->
    <div class="spec-list-exact">
        <div class="spec-item-exact">Category &ndash; Apparel</div>
        <div class="spec-item-exact">Product Type &ndash; {{ $product['product_type'] }}</div>
        <div class="spec-item-exact">Material &ndash; {{ $product['material'] }}</div>
        <div class="spec-item-exact">Fabric GSM &ndash; {{ $product['gsm'] }} GSM</div>
        <div class="spec-item-exact">Color &ndash; {{ $product['color'] }}</div>
        <div class="spec-item-exact">Size Available &ndash; {{ implode(', ', $product['sizes']) }}</div>
        <div class="spec-item-exact">Brand Name &ndash; {{ $product['brand_name'] }}</div>
        <div class="spec-item-exact">Manufacturer &ndash; {{ $product['manufacturer'] }}</div>
        <div class="spec-item-exact">State &ndash; {{ $product['state'] }}</div>
        <div class="spec-item-exact">District &ndash; {{ $product['district'] }}</div>
        <div class="spec-item-exact">Address &ndash; {{ $product['address'] }}</div>
        <div class="spec-item-exact">Mobile Number &ndash; 
            <a href="tel:{{ $product['mobile'] }}" style="color: inherit; text-decoration: none;">
                {{ $product['mobile'] }}
            </a>
        </div>
    </div>

    <!-- Product Description -->
    <div class="desc-section-exact">
        <h2 class="desc-title-exact">Product Description</h2>
        <p class="product-desc-exact">{{ $product['description'] }}</p>
    </div>
</main>

<!-- Sticky Footer for Call to Action -->
<div class="sticky-footer" style="display: flex; flex-direction: column; gap: 8px;">
    <a href="{{ route('products.download', $product['slug']) }}" class="primary-btn-exact" id="download-btn" style="text-decoration: none;">Download</a>
    <button type="button" class="primary-btn-exact" id="seller-info-btn" onclick="openSellerModal()" style="background-color: transparent; color: var(--text-dark); border: 1px solid var(--border-color); box-shadow: none;">Seller Information</button>
</div>

<!-- Seller Info Modal -->
<div id="seller-info-modal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Seller Information</h3>
            <button class="close-modal-btn" onclick="closeSellerModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="info-row">
                <span class="info-label">Name</span>
                <span class="info-value">{{ $product['manufacturer'] ?? 'Bharat Textile Exporters' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">sales@bharattex2026.com</span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone</span>
                <span class="info-value">
                    <a href="tel:{{ $product['mobile'] ?? '+919999999999' }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">
                        {{ $product['mobile'] ?? '+91 99999 99999' }}
                    </a>
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Address</span>
                <span class="info-value">{{ $product['address'] ?? 'Bharat Tex Pavilion, Pragati Maidan, New Delhi' }}</span>
            </div>
        </div>
        <div class="modal-footer">
            <button class="primary-btn-exact" onclick="closeSellerModal()" style="border: none;">Close</button>
        </div>
    </div>
</div>

<!-- Custom JavaScript Switcher -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Thumbnail switcher
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail-btn');

        thumbnails.forEach(btn => {
            btn.addEventListener('click', function () {
                // Remove active class from all
                thumbnails.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Change main image source with quick fade transition
                const targetSrc = this.getAttribute('data-src');
                
                mainImage.style.opacity = 0;
                setTimeout(() => {
                    mainImage.src = targetSrc;
                    mainImage.style.opacity = 1;
                }, 150);
            });
        });

        // Seller modal toggle
        const sellerModal = document.getElementById('seller-info-modal');
        
        window.openSellerModal = function() {
            sellerModal.style.display = 'flex';
        };

        window.closeSellerModal = function() {
            sellerModal.style.display = 'none';
        };
        
        // Close modal when clicking outside content area
        sellerModal.addEventListener('click', function(e) {
            if (e.target === sellerModal) {
                closeSellerModal();
            }
        });
    });
</script>
@endsection
