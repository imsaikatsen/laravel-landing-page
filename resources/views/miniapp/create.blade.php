@extends('layouts.dashboard')

@section('content')
    <div class="stat-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Add Mini App</h5>
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

        <form method="POST" action="{{ route('miniapp.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">App Title</label>
                <input type="text" name="appTitle" class="form-control form-control-lg" placeholder="Enter App Title"
                    value="{{ old('appTitle') }}">
            </div>

             <div class="mb-3">
                <label class="form-label">App Description</label>
                <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">App Icon / Image</label>
                <input type="file" name="appImage" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <textarea name="metaKeywords" class="form-control" placeholder="Enter meta keywords">{{ old('metaKeywords') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="metaDescription" class="form-control" placeholder="Enter meta description">{{ old('metaDescription') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Add HTML / JS</label>
                <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ old('customScript') }}</textarea>
            </div>

            <button class="btn btn-success btn-lg"><i class="fa fa-save me-1"></i> Save</button>
        </form>

    </div>
@endsection
