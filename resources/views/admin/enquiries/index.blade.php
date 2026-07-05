@extends('admin.layouts.app')

@section('title', 'Seller Enquiries | Bharat Tex 2026')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Seller Enquiries</h1>
        <p>List of all leads generated when visitors click "Seller Information" and fill out the contact form.</p>
    </div>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Product of Interest</th>
                <th style="width: 120px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enquiries as $enquiry)
                <tr>
                    <td>
                        <span class="font-bold">{{ $enquiry->created_at->format('d M Y') }}</span><br>
                        <small style="color: var(--text-muted);">{{ $enquiry->created_at->format('h:i A') }}</small>
                    </td>
                    <td class="font-bold">{{ $enquiry->name }}</td>
                    <td>
                        <a href="tel:{{ $enquiry->mobile }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500;">
                            {{ $enquiry->mobile }}
                        </a>
                    </td>
                    <td>
                        @if($enquiry->product)
                            <a href="{{ route('products.show', $enquiry->product->slug) }}" target="_blank" style="color: inherit; font-weight: 500;">
                                {{ $enquiry->product->name }}
                            </a>
                            <br>
                            <small style="color: var(--text-muted);">Brand: {{ $enquiry->product->brand_name }}</small>
                        @else
                            <span style="color: var(--text-muted); font-style: italic;">General Interest / Product Deleted</span>
                        @endif
                    <td>
                        <div class="table-actions" style="justify-content: center;">
                            <a href="{{ route('admin.enquiries.destroyGet', $enquiry->id) }}" class="admin-btn delete" onclick="return confirm('Are you sure you want to delete this enquiry lead?');" style="text-decoration: none;">Delete</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No enquiries found in the database.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
