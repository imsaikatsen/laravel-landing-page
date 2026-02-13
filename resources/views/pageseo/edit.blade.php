@extends('layouts.dashboard')

@section('content')
    <div class="stat-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Edit Page SEO</h5>
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

        <form method="POST" action="{{ route('pageseo.update', $seo->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Page Key</label>
                <input type="text" name="page_key" class="form-control form-control-lg"
                       value="{{ $seo->page_key }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control form-control-lg"
                       value="{{ $seo->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control form-control-lg"
                       value="{{ $seo->meta_title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <textarea name="meta_keywords" class="form-control" placeholder="Enter meta keywords">{{ $seo->meta_keywords }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" placeholder="Enter meta description">{{ $seo->meta_description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Custom HTML / JS</label>
                <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ $seo->customScript }}</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg">
                <i class="fa fa-save me-1"></i> Update
            </button>
        </form>

    </div>
@endsection
