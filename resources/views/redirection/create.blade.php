
@extends('layouts.dashboard')
@section('content')
<div class="stat-card p-4 shadow-sm rounded">
    <h5 class="mb-4">Add New Redirection</h5>
    <form method="POST" action="{{ route('redirection.store') }}" enctype="multipart/form-data" id="productForm" novalidate>
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Old Url</label>
                <input type="text" class="form-control" name="old_url" placeholder="Enter Old Url" required>
                <div class="invalid-feedback">Please enter a old url</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">New Url</label>
                <input type="text" class="form-control" name="new_url" placeholder="Enter New Url" required>
                <div class="invalid-feedback">Please enter a new url</div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Save Product</button>
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
