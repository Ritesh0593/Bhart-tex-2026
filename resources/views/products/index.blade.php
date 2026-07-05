@extends('layouts.app')

@section('title', $category['name'] . ' | Bharat Tex 2026')

@section('content')
<!-- Header matching Page 3 of PDF -->
<header class="app-header">
    <a href="{{ route('categories.index') }}" class="header-back-link" id="btn-back-categories">
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

<!-- Search Container matching PDF -->
<div class="search-container">
    <div class="search-bar-wrapper">
        <span class="search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </span>
        <input type="text" id="search-input" class="search-input" placeholder="Search category" aria-label="Search category">
    </div>
</div>

<!-- Breadcrumbs matching Page 3 of PDF -->
<div class="breadcrumb-container">
    <div class="breadcrumbs-exact">
        Home &gt; Categories &gt; Product line
    </div>
</div>

<!-- Main Grid Content -->
<main class="page-content">
    <div class="items-grid" id="products-grid">
        @forelse($products as $product)
            <a href="{{ route('products.show', $product['slug']) }}" class="category-card-exact" data-name="{{ strtolower($product['name']) }}">
                <div class="card-img-container-exact">
                    <img src="{{ asset($product['thumbnail']) }}" alt="{{ $product['name'] }}" class="card-img-exact">
                </div>
                <div class="card-info-exact">
                    <h3 class="card-name-exact">{{ $product['name'] }}</h3>
                </div>
            </a>
        @empty
            <div class="no-results" style="display: block;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <p>No products available in this category yet.</p>
            </div>
        @endforelse

        <!-- Fallback Empty State -->
        <div id="no-results-msg" class="no-results" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
            <p>No products match your search.</p>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const cards = document.querySelectorAll('.category-card-exact');
        const noResultsMsg = document.getElementById('no-results-msg');

        if (searchInput) {
            searchInput.addEventListener('input', function (e) {
                const query = e.target.value.toLowerCase().trim();
                let visibleCount = 0;

                cards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    if (name.includes(query)) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visibleCount === 0 && cards.length > 0) {
                    noResultsMsg.style.display = 'block';
                } else {
                    noResultsMsg.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection
