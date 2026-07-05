@extends('admin.layouts.app')

@section('title', 'Admin Dashboard | Bharat Tex 2026')

@section('content')
<div class="admin-dashboard-header">
    <h1>Dashboard</h1>
    <p>Welcome to the Bharat Tex 2026 Web Catalog admin portal. Manage categories, products, stall specifications, and catalog PDF data.</p>
</div>

<!-- Metrics Cards Grid -->
<div class="admin-metrics-grid">
    <div class="metric-card">
        <div class="metric-value">{{ $categoriesCount }}</div>
        <div class="metric-label">Total Categories</div>
        <a href="{{ route('admin.categories.index') }}" class="metric-link">Manage Categories &rarr;</a>
    </div>
    
    <div class="metric-card">
        <div class="metric-value">{{ $productsCount }}</div>
        <div class="metric-label">Total Products</div>
        <a href="{{ route('admin.products.index') }}" class="metric-link">Manage Products &rarr;</a>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="admin-quick-actions">
    <h2>Quick Actions</h2>
    <div class="actions-buttons">
        <a href="{{ route('admin.categories.create') }}" class="admin-btn primary">Add New Category</a>
        <a href="{{ route('admin.products.create') }}" class="admin-btn primary">Add New Product</a>
        <a href="{{ route('welcome') }}" target="_blank" class="admin-btn secondary">Open Live Catalog</a>
    </div>
</div>
@endsection
