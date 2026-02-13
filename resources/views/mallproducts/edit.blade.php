{{-- @extends('layouts.dashboard')

@section('content')
    <form method="POST" action="{{ route('mallproducts.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input class="form-control mb-2" name="title" value="{{ $product->title }}">
        <input class="form-control mb-2" name="price" value="{{ $product->price }}">
        <input class="form-control mb-2" name="sold_count" value="{{ $product->sold_count }}">
        <input class="form-control mb-2" name="rating" value="{{ $product->rating }}">
        <input class="form-control mb-2" name="review_count" value="{{ $product->review_count }}">
        <input type="file" class="form-control mb-2" name="image">
        <textarea class="form-control mb-2" name="description">{{ $product->description }}</textarea>
        <input class="form-control mb-2" name="metaKeywords" value="{{ $product->metaKeywords }}">
        <textarea class="form-control mb-2" name="metaDescription">{{ $product->metaDescription }}</textarea>
        <textarea class="form-control mb-2" name="customScript">{{ $product->customScript }}</textarea>
        <button class="btn btn-primary">Update</button>

    </form>
@endsection --}}

@extends('layouts.dashboard')

@section('content')
<div class="stat-card p-4 shadow-sm rounded">
    <h5 class="mb-4">Edit Mall Product</h5>

    <form method="POST" action="{{ route('mallproducts.update', $product->id) }}" enctype="multipart/form-data" id="productForm" novalidate>
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Product Title -->
            <div class="col-md-6">
                <label class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" value="{{ $product->title }}" required>
                <div class="invalid-feedback">Please enter a product title.</div>
            </div>

            <!-- Price -->
            <div class="col-md-3">
                <label class="form-label">Price (¥)</label>
                <input type="number" class="form-control" name="price" value="{{ $product->price }}" min="0" step="0.01" required>
                <div class="invalid-feedback">Please enter a valid price.</div>
            </div>

            <!-- Sold Count -->
            <div class="col-md-3">
                <label class="form-label">Sold Count</label>
                <input type="number" class="form-control" name="sold_count" value="{{ $product->sold_count }}" min="0" required>
                <div class="invalid-feedback">Please enter sold count.</div>
            </div>

            <!-- Rating -->
            <div class="col-md-3">
                <label class="form-label">Rating</label>
                <input type="number" class="form-control" name="rating" value="{{ $product->rating }}" min="0" max="5" step="0.1" required>
                <div class="invalid-feedback">Please enter a rating between 0 and 5.</div>
            </div>

            <!-- Review Count -->
            <div class="col-md-3">
                <label class="form-label">Review Count</label>
                <input type="number" class="form-control" name="review_count" value="{{ $product->review_count }}" min="0" required>
                <div class="invalid-feedback">Please enter review count.</div>
            </div>

            <!-- Product Image -->
            <div class="col-md-6">
                <label class="form-label">Product Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <div class="form-text">Current Image:</div>
                @if($product->image)
                    <img src="/mall-products/{{ $product->image }}" width="80" class="rounded shadow-sm mt-1">
                @endif
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3" required>{{ $product->description }}</textarea>
                <div class="invalid-feedback">Please enter a description.</div>
            </div>

            <!-- Meta Keywords -->
            <div class="col-12">
                <label class="form-label">Meta Keywords</label>
                <input type="text" class="form-control" name="metaKeywords" value="{{ $product->metaKeywords }}">
            </div>

            <!-- Meta Description -->
            <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea class="form-control" name="metaDescription" rows="2">{{ $product->metaDescription }}</textarea>
            </div>

            <!-- Custom Script -->
            <div class="col-12">
                <label class="form-label">HTML / JS Inject</label>
                <textarea class="form-control" name="customScript" rows="2">{{ $product->customScript }}</textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update Product</button>
        </div>
    </form>
</div>

<!-- Frontend Validation Script -->
<script>
    (function () {
        'use strict'
        const form = document.getElementById('productForm')
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })()
</script>
@endsection

