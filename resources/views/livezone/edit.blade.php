@extends('layouts.dashboard')

@section('content')
    @php
        $selectedCategoryId = old('category_id', $zone->category_id);
        $selectedCategory = $categories->firstWhere('id', (int) $selectedCategoryId);
        $categoryActive = $selectedCategoryId ? old('category_active', $zone->category_active) : false;
        $previewSlug = generate_slug(old('title', $zone->title));
        $publicUrl = $selectedCategory && $categoryActive
            ? route('content.show', ['categorySlug' => $selectedCategory->slug, 'slug' => $previewSlug])
            : route('content.show.simple', ['slug' => $previewSlug]);
    @endphp
    <div class="stat-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-1">Edit Live Zone</h4>
                <a href="{{ $publicUrl }}" class="small text-decoration-none" target="_blank" rel="noopener noreferrer">
                    {{ $publicUrl }}
                </a>
            </div>
            <a href="{{ route('livezone.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('livezone.update', $zone->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $zone->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="live-category-active"
                            name="category_active" value="1" @checked(old('category_active', $zone->category_active))>
                        <label class="form-check-label" for="live-category-active">Category Active</label>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $zone->title) }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $zone->slug) }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" id="imageInput" class="form-control">
                    <div id="js-image-error" style="color: red; display: none; font-size: 0.8rem; margin-top: 5px;">
                        File is too large! Please select an image under 2MB.
                    </div>
                    @if ($zone->image)
                        <img src="{{ asset('livezones/' . $zone->image) }}" width="80" class="mt-2 rounded">
                    @endif
                </div>

                <div class="col-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="form-control summernote-editor" required>{{ old('description', $zone->description) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Meta Keywords</label>
                    <input type="text" name="metaKeywords" value="{{ old('metaKeywords', $zone->metaKeywords) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="metaTitle" class="form-control form-control-lg" value="{{ old('metaTitle', $zone->metaTitle) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Meta Description</label>
                    <input type="text" name="metaDescription" value="{{ old('metaDescription', $zone->metaDescription) }}" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label>Custom Script / HTML Inject</label>
                    <textarea name="customScript" rows="4" class="form-control">{{ old('customScript', $zone->customScript) }}</textarea>
                </div>

            </div>

            <button class="btn btn-primary mt-2">Update</button>

        </form>

    </div>
    <script>
    $('#imageInput').on('change', function() {
        const file = this.files[0];
        const limit = 2 * 1024 * 1024;

        if (file && file.size > limit) {
            $('#js-image-error').show();
            $(this).val('');
        } else {
            $('#js-image-error').hide();
        }
    });
    </script>
@endsection
