@extends('layouts.dashboard')

@section('content')
    @php
        $selectedCategoryId = old('category_id', $app->category_id);
        $selectedCategory = $categories->firstWhere('id', (int) $selectedCategoryId);
        $categoryActive = $selectedCategoryId ? old('category_active', $app->category_active) : false;
        $previewSlug = generate_slug(old('appTitle', $app->appTitle));
        $publicUrl = $selectedCategory && $categoryActive
            ? route('content.show', ['categorySlug' => $selectedCategory->slug, 'slug' => $previewSlug])
            : route('content.show.simple', ['slug' => $previewSlug]);
    @endphp

    <div class="stat-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-1">Edit Mini App</h5>
            </div>
            <a href="{{ $publicUrl }}" class="small text-decoration-none badge bg-info" target="_blank" rel="noopener noreferrer">
                View Content
            </a>
            <a href="{{ route('miniapp.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('miniapp.update', $app->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select form-select-lg">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $app->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="miniapp-category-active"
                    name="category_active" value="1" @checked(old('category_active', $app->category_active))>
                <label class="form-check-label" for="miniapp-category-active">Category Active</label>
            </div>

            <div class="mb-3">
                <label class="form-label">App Title</label>
                <input type="text" name="appTitle" class="form-control form-control-lg"
                    value="{{ old('appTitle', $app->appTitle) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">App Content</label>
                <textarea name="description" class="form-control summernote-editor">{{ old('description', $app->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">App Icon / Image</label>
                <div class="mb-2">
                    <img src="/miniapps/{{ $app->appImage }}" alt="App Image" width="120" class="rounded shadow-sm">
                </div>
                <input type="file" name="appImage" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <textarea name="metaKeywords" class="form-control">{{ old('metaKeywords', $app->metaKeywords) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="metaTitle" class="form-control form-control-lg"
                    value="{{ old('metaTitle', $app->metaTitle) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="metaDescription" class="form-control">{{ old('metaDescription', $app->metaDescription) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Add HTML / JS</label>
                <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ old('customScript', $app->customScript) }}</textarea>
            </div>


            <button class="btn btn-success btn-lg"><i class="fa fa-save me-1"></i> Update</button>
        </form>

    </div>
@endsection
