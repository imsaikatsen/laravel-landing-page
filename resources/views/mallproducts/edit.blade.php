@extends('layouts.dashboard')

@section('content')
@php
    $selectedCategoryId = old('category_id', $product->category_id);
    $selectedCategory = $categories->firstWhere('id', (int) $selectedCategoryId);
    $categoryActive = $selectedCategoryId ? old('category_active', $product->category_active) : false;
    $previewSlug = old('title', $product->title) !== $product->title
        ? generate_slug(old('title', $product->title))
        : $product->slug;
    $publicUrl = $selectedCategory && $categoryActive
        ? route('content.show', ['categorySlug' => $selectedCategory->slug, 'slug' => $previewSlug])
        : route('content.show.simple', ['slug' => $previewSlug]);
@endphp
<div class="stat-card p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="mb-1">Edit Mall Product</h5>
            <a href="{{ $publicUrl }}" class="small text-decoration-none" target="_blank" rel="noopener noreferrer">
                {{ $publicUrl }}
            </a>
        </div>
        <a href="{{ route('mallproducts.index') }}" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('mallproducts.update', $product->id) }}" enctype="multipart/form-data" id="productForm" novalidate>
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="mall-category-active"
                        name="category_active" value="1" @checked(old('category_active', $product->category_active))>
                    <label class="form-check-label" for="mall-category-active">Category Active</label>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" required>
                <div class="invalid-feedback">Please enter a product title.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Price</label>
                <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
                <div class="invalid-feedback">Please enter a valid price.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Sold Count</label>
                <input type="number" class="form-control" name="sold_count" value="{{ old('sold_count', $product->sold_count) }}" min="0" required>
                <div class="invalid-feedback">Please enter sold count.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Rating</label>
                <input type="number" class="form-control" name="rating" value="{{ old('rating', $product->rating) }}" min="0" max="5" step="0.1" required>
                <div class="invalid-feedback">Please enter a rating between 0 and 5.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Review Count</label>
                <input type="number" class="form-control" name="review_count" value="{{ old('review_count', $product->review_count) }}" min="0" required>
                <div class="invalid-feedback">Please enter review count.</div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Product Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <div class="form-text">Current Image:</div>
                @if($product->image)
                    <img src="/mall-products/{{ $product->image }}" width="80" class="rounded shadow-sm mt-1">
                @endif
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control summernote-editor" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                <div class="invalid-feedback">Please enter a description.</div>
            </div>

            <div class="col-12">
                <label class="form-label">Meta Keywords</label>
                <input type="text" class="form-control" name="metaKeywords" value="{{ old('metaKeywords', $product->metaKeywords) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="metaTitle" class="form-control form-control-lg" value="{{ old('metaTitle', $product->metaTitle) }}">
            </div>

            <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea class="form-control" name="metaDescription" rows="2">{{ old('metaDescription', $product->metaDescription) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">HTML / JS Inject</label>
                <textarea class="form-control" name="customScript" rows="2">{{ old('customScript', $product->customScript) }}</textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update Product</button>
        </div>
    </form>
</div>

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
