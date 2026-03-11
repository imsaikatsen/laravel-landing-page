@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <h5>Edit Dating Zone</h5>

    <form method="POST" action="{{ route('datingzone.update',$zone->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $zone->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="dating-category-active"
                name="category_active" value="1" @checked(old('category_active', $zone->category_active))>
            <label class="form-check-label" for="dating-category-active">Category Active</label>
        </div>

        <input class="form-control mb-2" name="title" placeholder="Title" value="{{ old('title',$zone->title) }}" required>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            @if($zone->image)
                <img src="{{ asset('datingzones/'.$zone->image) }}" alt="zone image" class="mt-2" width="120">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control summernote-editor" placeholder="Description">{{ old('description',$zone->description) }}</textarea>
        </div>

        <div class="mb-3">
            <input class="form-control mb-2" name="tag1" placeholder="Tag 1" value="{{ old('tag1',$zone->tag1) }}">
            <input class="form-control mb-2" name="tag2" placeholder="Tag 2" value="{{ old('tag2',$zone->tag2) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Count</label>
            <input type="number" class="form-control" name="count" placeholder="Count" value="{{ old('count',$zone->count) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea class="form-control" name="metaKeywords" placeholder="Meta Keywords">{{ old('metaKeywords',$zone->metaKeywords) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="metaTitle" class="form-control form-control-lg" value="{{ old('metaTitle',$zone->metaTitle) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea class="form-control" name="metaDescription" placeholder="Meta Description">{{ old('metaDescription',$zone->metaDescription) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Add HTML / JS</label>
            <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ old('customScript',$zone->customScript) }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
