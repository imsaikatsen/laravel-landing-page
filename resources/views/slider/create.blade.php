@extends('layouts.dashboard')

@section('content')

<div class="row justify-content-center">

<div class="col-md-8">

<div class="stat-card">

<div class="d-flex align-items-center mb-4">
    <i class="fa fa-images fa-2x text-primary me-3"></i>
    <h4 class="mb-0">Add New Slider</h4>
</div>

<form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
@csrf

<div class="mb-4">

<label class="form-label fw-semibold">Slider Image</label>

<div class="border rounded p-4 text-center bg-light">

    <i class="fa fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>

    <p class="text-muted mb-2">Click or drag image here</p>

    <input type="file" name="image" class="form-control" onchange="previewImage(this)" required>

</div>

<img id="preview" class="mt-3 rounded shadow-sm" style="max-width:100%; display:none;">

</div>

<div class="d-flex justify-content-between">

<a href="{{ route('slider.index') }}" class="btn btn-light border">
    <i class="fa fa-arrow-left"></i> Back
</a>

<button class="btn btn-primary px-4">
    <i class="fa fa-save me-1"></i> Save Slider
</button>

</div>

</form>

</div>

</div>

</div>

<script>
function previewImage(input){
    let preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(input.files[0]);
    preview.style.display = 'block';
}
</script>

@endsection
