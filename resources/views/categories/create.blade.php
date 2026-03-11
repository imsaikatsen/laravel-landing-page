@extends('layouts.dashboard')

@section('content')
    <div class="stat-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Add Category</h5>
            <a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">
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

        <form method="POST" action="{{ route('category.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter category name"
                    value="{{ old('name') }}">
            </div>

            <button class="btn btn-success btn-lg"><i class="fa fa-save me-1"></i> Save</button>
        </form>
    </div>
@endsection
