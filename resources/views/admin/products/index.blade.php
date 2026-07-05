@extends('admin.layouts.app')

@section('title', 'Manage Products | Bharat Tex 2026')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Products</h1>
        <p>List of all textile items currently showing in categories. Adding a product dynamically inserts it in the dynamic category grids.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="admin-btn primary">Add Product</a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 80px;">Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Manufacturer</th>
                <th style="width: 180px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @php
                            $primaryImg = $product->images()->where('is_primary', true)->first();
                            $thumb = $primaryImg ? $primaryImg->image_path : 'images/logo.png';
                        @endphp
                        <img src="{{ asset($thumb) }}" class="admin-table-thumb" alt="{{ $product->name }}">
                    </td>
                    <td class="font-bold">{{ $product->name }}</td>
                    <td><span class="admin-badge">{{ $product->category->name }}</span></td>
                    <td class="font-bold text-pink">₹{{ number_format($product->price) }}</td>
                    <td>{{ $product->brand_name }}</td>
                    <td>{{ $product->manufacturer }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="admin-btn edit">Edit</a>
                            
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No products found in the database.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
