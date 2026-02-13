@extends('layouts.dashboard')

@section('content')
    <div class="stat-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Add Page SEO</h5>
            <a href="{{ route('pageseo.index') }}" class="btn btn-secondary btn-sm">
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

        <form method="POST" action="{{ route('pageseo.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Page Key</label>
                <input type="text" name="page_key" class="form-control form-control-lg"
                       placeholder="landing / mall / livezone" value="{{ old('page_key') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control form-control-lg"
                       placeholder="Title" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control form-control-lg"
                       placeholder="Meta Title" value="{{ old('meta_title') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <textarea name="meta_keywords" class="form-control" placeholder="Enter meta keywords">{{ old('meta_keywords') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Custom HTML / JS</label>
                <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ old('customScript') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg">
                <i class="fa fa-save me-1"></i> Save
            </button>
        </form>

    </div>
@endsection
