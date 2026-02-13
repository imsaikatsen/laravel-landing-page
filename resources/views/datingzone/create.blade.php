@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <h5>Add Dating Zone</h5>

    <form method="POST" action="{{ route('datingzone.store') }}" enctype="multipart/form-data">
        @csrf

        <input class="form-control mb-2" name="title" placeholder="Title" value="{{ old('title') }}" required>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <input class="form-control mb-2" name="tag1" placeholder="Tag 1" value="{{ old('tag1') }}">
            <input class="form-control mb-2" name="tag2" placeholder="Tag 2" value="{{ old('tag2') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Count</label>
            <input type="number" class="form-control" name="count" placeholder="Count" value="{{ old('count',0) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea class="form-control" name="metaKeywords" placeholder="Meta Keywords">{{ old('metaKeywords') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea class="form-control" name="metaDescription" placeholder="Meta Description">{{ old('metaDescription') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Add HTML / JS</label>
            <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ old('customScript') }}</textarea>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
