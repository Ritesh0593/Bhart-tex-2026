@extends('admin.layouts.app')

@section('title', ($product->exists ? 'Edit Product' : 'Create Product') . ' | Bharat Tex 2026')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $product->exists ? 'Edit Product: ' . $product->name : 'Create Product' }}</h1>
        <p>Define product specifications, manufacturer contact card, exhibition stall location, and upload its main listing image.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="admin-btn secondary">Back to List</a>
</div>

<div class="admin-form-card">
    <form action="{{ $product->exists ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <!-- Category Field -->
            <div class="form-group col-md-6">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Name Field -->
            <div class="form-group col-md-6">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required placeholder="e.g. Premium Cotton Hoodie">
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <!-- Price Field -->
            <div class="form-group col-md-4">
                <label for="price">Price (₹)</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required placeholder="e.g. 1499">
                @error('price')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Type Field -->
            <div class="form-group col-md-4">
                <label for="product_type">Product Type</label>
                <input type="text" name="product_type" id="product_type" class="form-control @error('product_type') is-invalid @enderror" value="{{ old('product_type', $product->product_type) }}" required placeholder="e.g. Hooded Sweatshirt">
                @error('product_type')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Brand Name Field -->
            <div class="form-group col-md-4">
                <label for="brand_name">Brand Name</label>
                <input type="text" name="brand_name" id="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{ old('brand_name', $product->brand_name) }}" required placeholder="e.g. Bharat Tex Collection">
                @error('brand_name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <!-- Material Field -->
            <div class="form-group col-md-4">
                <label for="material">Material</label>
                <input type="text" name="material" id="material" class="form-control @error('material') is-invalid @enderror" value="{{ old('material', $product->material) }}" required placeholder="e.g. 100% Premium Cotton Fleece">
                @error('material')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- GSM Field -->
            <div class="form-group col-md-4">
                <label for="gsm">Fabric GSM</label>
                <input type="number" name="gsm" id="gsm" class="form-control @error('gsm') is-invalid @enderror" value="{{ old('gsm', $product->gsm) }}" required placeholder="e.g. 320">
                @error('gsm')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Color Field -->
            <div class="form-group col-md-4">
                <label for="color">Color</label>
                <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $product->color) }}" required placeholder="e.g. Maroon">
                @error('color')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <!-- Sizes Field -->
            <div class="form-group col-md-6">
                <label for="sizes">Sizes Available</label>
                <input type="text" name="sizes" id="sizes" class="form-control @error('sizes') is-invalid @enderror" value="{{ old('sizes', $product->sizes) }}" required placeholder="e.g. S, M, L, XL, XXL">
                <p class="field-hint">Enter comma-separated values.</p>
                @error('sizes')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Manufacturer Field -->
            <div class="form-group col-md-6">
                <label for="manufacturer">Manufacturer</label>
                <input type="text" name="manufacturer" id="manufacturer" class="form-control @error('manufacturer') is-invalid @enderror" value="{{ old('manufacturer', $product->manufacturer) }}" required placeholder="e.g. XYZ Textiles Pvt. Ltd.">
                @error('manufacturer')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <!-- Mobile Field -->
            <div class="form-group col-md-4">
                <label for="mobile">Contact Mobile</label>
                <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile', $product->mobile) }}" required placeholder="e.g. +91 98765 43210">
                @error('mobile')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- State Field -->
            <div class="form-group col-md-4">
                <label for="state">State</label>
                <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $product->state) }}" required placeholder="e.g. Delhi">
                @error('state')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- District Field -->
            <div class="form-group col-md-4">
                <label for="district">District</label>
                <input type="text" name="district" id="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district', $product->district) }}" required placeholder="e.g. New Delhi">
                @error('district')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Address Field -->
        <div class="form-group">
            <label for="address">Stall Exhibition Address</label>
            <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror" required placeholder="e.g. Bharat Mandapam Exhibition Hall, Pragati Maidan, New Delhi – 110001">{{ old('address', $product->address) }}</textarea>
            @error('address')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required placeholder="Describe fabric quality and fit properties...">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hidden input for cropped primary image -->
        <input type="hidden" name="cropped_image_data" id="cropped_image_data">

        <!-- Primary Image Upload Field -->
        <div class="form-group">
            <label>Product Primary Image (Required aspect ratio: 4:5)</label>
            
            <div class="custom-file-upload">
                <input type="file" id="image" class="file-input" accept="image/*">
                <label for="image" class="upload-area">
                    <span class="upload-icon">📤</span>
                    <span class="upload-text" id="upload-label-text">Drag & drop or click to choose primary image</span>
                    <span class="upload-hint">PNG, JPG, WEBP up to 2MB</span>
                </label>
            </div>
            
            @error('image')
                <div class="error-msg">{{ $message }}</div>
            @enderror

            @php
                $primaryImg = $product->images()->where('is_primary', true)->first();
                $previewPath = $primaryImg ? $primaryImg->image_path : '';
            @endphp
            <div class="image-preview-block" id="preview-block" style="{{ $previewPath ? '' : 'display: none;' }}">
                <p>Selected / Current Primary Image:</p>
                <img src="{{ $previewPath ? asset($previewPath) : '' }}" class="admin-form-preview" id="preview-img" alt="Primary Image Preview">
            </div>
        </div>

        <!-- Secondary Gallery Images Upload Field -->
        <div class="form-group" style="margin-top: 25px; border-top: 1px solid var(--border-color); padding-top: 25px;">
            <label>Product Gallery (Secondary Images)</label>
            
            <div class="custom-file-upload">
                <input type="file" name="secondary_images[]" id="secondary_images" class="file-input" accept="image/*" multiple>
                <label for="secondary_images" class="upload-area" style="border-color: #E2E8F0; background-color: #FAFAFA;">
                    <span class="upload-icon">📷</span>
                    <span class="upload-text" id="sec-upload-label-text">Select multiple images for the gallery grid</span>
                    <span class="upload-hint">PNG, JPG, WEBP up to 2MB per file</span>
                </label>
            </div>

            @error('secondary_images.*')
                <div class="error-msg">{{ $message }}</div>
            @enderror

            <!-- Gallery Grid List (Only shows for existing products) -->
            @if($product->exists)
                <div class="admin-gallery-grid-title" style="margin-top: 20px; font-weight: 700; font-size: 0.95rem; color: var(--text-dark);">
                    Uploaded Gallery Images (Click × to delete instantly)
                </div>
                <div class="admin-gallery-grid">
                    @forelse($product->images()->where('is_primary', false)->get() as $secImg)
                        <div class="gallery-item" id="gallery-item-{{ $secImg->id }}">
                            <img src="{{ asset($secImg->image_path) }}" alt="Secondary Gallery Image">
                            <button type="button" class="delete-gallery-btn" onclick="deleteGalleryImage({{ $secImg->id }})">&times;</button>
                        </div>
                    @empty
                        <p class="no-images-text" style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No secondary images uploaded yet.</p>
                    @endforelse
                </div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="admin-btn primary">{{ $product->exists ? 'Update Product' : 'Save Product' }}</button>
            <a href="{{ route('admin.products.index') }}" class="admin-btn secondary">Cancel</a>
        </div>
    </form>
</div>

<!-- Cropper Modal -->
<div id="cropper-modal" class="admin-modal">
    <div class="modal-content">
        <span class="close-modal-btn" onclick="closeCropperModal()">&times;</span>
        <h2>Crop Product Image (4:5 Ratio)</h2>
        <div class="cropper-container" style="max-height: 400px; overflow: hidden; background-color: #f0f0f0; margin-top: 15px; border-radius: 8px;">
            <img id="cropper-image" src="" style="max-width: 100%; max-height: 400px; display: block;">
        </div>
        <div class="modal-actions" style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
            <button type="button" class="admin-btn primary" id="crop-button">Crop & Save</button>
            <button type="button" class="admin-btn secondary" onclick="closeCropperModal()">Cancel</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let cropper;
    const imageInput = document.getElementById('image');
    const cropperModal = document.getElementById('cropper-modal');
    const cropperImage = document.getElementById('cropper-image');
    const cropButton = document.getElementById('crop-button');
    const croppedImageData = document.getElementById('cropped_image_data');
    const previewBlock = document.getElementById('preview-block');
    const previewImg = document.getElementById('preview-img');
    const uploadLabelText = document.getElementById('upload-label-text');
    
    const secondaryImages = document.getElementById('secondary_images');
    const secUploadLabelText = document.getElementById('sec-upload-label-text');

    // Handle primary image input and Cropper trigger
    imageInput.addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            uploadLabelText.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function (event) {
                cropperImage.src = event.target.result;
                cropperModal.style.display = 'flex';
                
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize Cropper.js (4:5 aspect ratio for vertical cards)
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 4 / 5,
                    viewMode: 1,
                    background: false
                });
            };
            reader.readAsDataURL(file);
        }
    });

    cropButton.addEventListener('click', function () {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 480,
                height: 600
            });
            const dataUrl = canvas.toDataURL('image/jpeg', 0.95);
            croppedImageData.value = dataUrl;
            previewImg.src = dataUrl;
            previewBlock.style.display = 'block';
            closeCropperModal();
        }
    });

    function closeCropperModal() {
        cropperModal.style.display = 'none';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    // Handle secondary files label text
    secondaryImages.addEventListener('change', function (e) {
        const count = e.target.files.length;
        if (count > 0) {
            secUploadLabelText.textContent = count + ' gallery file(s) selected';
        } else {
            secUploadLabelText.textContent = 'Select multiple images for the gallery grid';
        }
    });

    // Delete gallery image dynamically via AJAX
    function deleteGalleryImage(id) {
        if (confirm('Are you sure you want to delete this gallery image?')) {
            fetch(`/admin/product-images/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.getElementById(`gallery-item-${id}`);
                    if (item) {
                        item.remove();
                    }
                } else {
                    alert(data.message || 'Failed to delete image.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('An error occurred while deleting the image.');
            });
        }
    }
</script>
@endsection
