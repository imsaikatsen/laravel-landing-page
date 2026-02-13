@extends('layouts.dashboard')

@section('content')
    <div class="stat-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Edit Mini App</h5>
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

        <form method="POST" action="{{ route('miniapp.update', $app->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">App Title</label>
                <input type="text" name="appTitle" class="form-control form-control-lg" value="{{ $app->appTitle }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control mb-2" placeholder="Description">{{ $app->description }}</textarea>
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
                <textarea name="metaKeywords" class="form-control">{{ $app->metaKeywords }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="metaDescription" class="form-control">{{ $app->metaDescription }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Add HTML / JS</label>
                <textarea name="customScript" class="form-control" placeholder="Custom JS / Script">{{ old('customScript') }}</textarea>
            </div>


            <button class="btn btn-success btn-lg"><i class="fa fa-save me-1"></i> Update</button>
        </form>

    </div>
@endsection
