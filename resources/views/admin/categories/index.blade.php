@extends('admin.layouts.app')

@section('title', 'Manage Categories | Bharat Tex 2026')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Categories</h1>
        <p>List of all categories currently showing in the mobile catalog. Adding a new category will make it appear in the grid.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="admin-btn primary">Add Category</a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 80px;">Image</th>
                <th>Name</th>
                <th>Slug</th>
                <th style="width: 180px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        <img src="{{ asset($category['image_path']) }}" class="admin-table-thumb" alt="{{ $category['name'] }}">
                    </td>
                    <td class="font-bold">{{ $category['name'] }}</td>
                    <td><code>{{ $category['slug'] }}</code></td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.categories.edit', $category['id']) }}" class="admin-btn edit">Edit</a>
                            
                            <form action="{{ route('admin.categories.destroy', $category['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? This will delete all products inside it.');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No categories found in the database.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
