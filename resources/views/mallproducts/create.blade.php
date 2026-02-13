{{-- @extends('layouts.dashboard')

@section('content')
    <form method="POST" action="{{ route('mallproducts.store') }}" enctype="multipart/form-data">
        @csrf

        <input class="form-control mb-2" name="title" placeholder="Product Title">
        <input class="form-control mb-2" name="price" placeholder="Price">
        <input class="form-control mb-2" name="sold_count" placeholder="Sold Count">
        <input class="form-control mb-2" name="rating" placeholder="Rating">
        <input class="form-control mb-2" name="review_count" placeholder="Review Count">
        <input type="file" class="form-control mb-2" name="image">
        <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>
        <input class="form-control mb-2" name="metaKeywords" placeholder="Meta Keywords">
        <textarea class="form-control mb-2" name="metaDescription" placeholder="Meta Description"></textarea>
        <textarea class="form-control mb-2" name="customScript" placeholder="HTML / JS Inject"></textarea>
        <button class="btn btn-success">Save</button>

    </form>
@endsection --}}


@extends('layouts.dashboard')

@section('content')
<div class="stat-card p-4 shadow-sm rounded">
    <h5 class="mb-4">Add New Mall Product</h5>

    <form method="POST" action="{{ route('mallproducts.store') }}" enctype="multipart/form-data" id="productForm" novalidate>
        @csrf

        <div class="row g-3">
            <!-- Product Title -->
            <div class="col-md-6">
                <label class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Product Title" required>
                <div class="invalid-feedback">Please enter a product title.</div>
            </div>

            <!-- Price -->
            <div class="col-md-3">
                <label class="form-label">Price (¥)</label>
                <input type="number" class="form-control" name="price" placeholder="0" min="0" step="0.01" required>
                <div class="invalid-feedback">Please enter a valid price.</div>
            </div>

            <!-- Sold Count -->
            <div class="col-md-3">
                <label class="form-label">Sold Count</label>
                <input type="number" class="form-control" name="sold_count" placeholder="0" min="0" required>
                <div class="invalid-feedback">Please enter sold count.</div>
            </div>

            <!-- Rating -->
            <div class="col-md-3">
                <label class="form-label">Rating</label>
                <input type="number" class="form-control" name="rating" placeholder="0" min="0" max="5" step="0.1" required>
                <div class="invalid-feedback">Please enter a rating between 0 and 5.</div>
            </div>

            <!-- Review Count -->
            <div class="col-md-3">
                <label class="form-label">Review Count</label>
                <input type="number" class="form-control" name="review_count" placeholder="0" min="0" required>
                <div class="invalid-feedback">Please enter review count.</div>
            </div>

            <!-- Product Image -->
            <div class="col-md-6">
                <label class="form-label">Product Image</label>
                <input type="file" class="form-control" name="image" accept="image/*" required>
                <div class="invalid-feedback">Please select a product image.</div>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Enter Description" required></textarea>
                <div class="invalid-feedback">Please enter a description.</div>
            </div>

            <!-- Meta Keywords -->
            <div class="col-12">
                <label class="form-label">Meta Keywords</label>
                <input type="text" class="form-control" name="metaKeywords" placeholder="Enter Meta Keywords">
            </div>

            <!-- Meta Description -->
            <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea class="form-control" name="metaDescription" rows="2" placeholder="Enter Meta Description"></textarea>
            </div>

            <!-- Custom Script -->
            <div class="col-12">
                <label class="form-label">HTML / JS Inject</label>
                <textarea class="form-control" name="customScript" rows="2" placeholder="Paste custom HTML / JS here"></textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Save Product</button>
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
