@extends('admin.layouts.app')

@section('title', ($category->exists ? 'Edit Category' : 'Create Category') . ' | Bharat Tex 2026')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $category->exists ? 'Edit Category: ' . $category->name : 'Create Category' }}</h1>
        <p>Define category title and upload its cover icon image.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="admin-btn secondary">Back to List</a>
</div>

<div class="admin-form-card">
    <form action="{{ $category->exists ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
        @csrf
        @if($category->exists)
            @method('PUT')
        @endif

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required placeholder="e.g. Men's Wear, Knitwear">
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hidden input for cropped image base64 -->
        <input type="hidden" name="cropped_image_data" id="cropped_image_data">

        <!-- Image Upload Field -->
        <div class="form-group">
            <label>Cover Image (Required aspect ratio: 1:1)</label>
            
            <div class="custom-file-upload">
                <input type="file" id="image" class="file-input" accept="image/*">
                <label for="image" class="upload-area">
                    <span class="upload-icon">📤</span>
                    <span class="upload-text" id="upload-label-text">Drag & drop or click to choose cover image</span>
                    <span class="upload-hint">PNG, JPG, WEBP up to 2MB</span>
                </label>
            </div>
            
            @error('image')
                <div class="error-msg">{{ $message }}</div>
            @enderror

            <!-- Image Preview Section -->
            <div class="image-preview-block" id="preview-block" style="{{ ($category->exists && $category->image_path) ? '' : 'display: none;' }}">
                <p>Selected / Current Cover Image:</p>
                <img src="{{ $category->exists ? asset($category->image_path) : '' }}" class="admin-form-preview" id="preview-img" alt="Cover Image Preview">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="admin-btn primary">{{ $category->exists ? 'Update Category' : 'Save Category' }}</button>
            <a href="{{ route('admin.categories.index') }}" class="admin-btn secondary">Cancel</a>
        </div>
    </form>
</div>

<!-- Cropper Modal -->
<div id="cropper-modal" class="admin-modal">
    <div class="modal-content">
        <span class="close-modal-btn" onclick="closeCropperModal()">&times;</span>
        <h2>Crop Cover Image (1:1 Ratio)</h2>
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

    imageInput.addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            uploadLabelText.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function (event) {
                cropperImage.src = event.target.result;
                cropperModal.style.display = 'flex';
                
                // Destroy previous instance if exists
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize Cropper.js
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1, // square ratio for category icons
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
                width: 400,
                height: 400
            });
            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
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
</script>
@endsection
