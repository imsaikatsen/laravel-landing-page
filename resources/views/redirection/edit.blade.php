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
        </div>
        <a href="{{ $publicUrl }}" class="small text-decoration-none badge bg-info" target="_blank" rel="noopener noreferrer">
            View Content
        </a>
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
                <label class="form-label">Old Url</label>
                <input type="text" class="form-control" name="old_url" name="old_url" @checked(old('old_url', $product->old_url)) placeholder="Enter Old Url" required>
                <div class="invalid-feedback">Please enter a old url</div>
            </div>
            <div class="col-md-3">
                <label class="form-label">New Url</label>
                <input type="number" class="form-control" name="new_url" @checked(old('new_url', $product->new_url)) placeholder="Enter New Url" required>
                <div class="invalid-feedback">Please enter a new url</div>
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
