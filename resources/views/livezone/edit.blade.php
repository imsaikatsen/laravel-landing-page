@extends('layouts.dashboard')

@section('content')
    <div class="stat-card">

        <h4 class="mb-3">Edit Live Zone</h4>

        <form action="{{ route('livezone.update', $zone->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $zone->title }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ $zone->slug }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <!-- <input type="file" name="image" class="form-control"> -->
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
                    <textarea name="description" rows="4" class="form-control" required>{{ $zone->description }}</textarea>
                </div>


                <div class="col-md-6 mb-3">
                    <label>Meta Keywords</label>
                    <input type="text" name="metaKeywords" value="{{ $zone->metaKeywords }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="metaTitle" class="form-control form-control-lg" value="{{ old('metaTitle',$zone->metaTitle) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Meta Description</label>
                    <input type="text" name="metaDescription" value="{{ $zone->metaDescription }}" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label>Custom Script / HTML Inject</label>
                    <textarea name="customScript" rows="4" class="form-control">{{ $zone->customScript }}</textarea>
                </div>

            </div>

            <button class="btn btn-primary mt-2">Update</button>
            <a href="{{ route('livezone.index') }}" class="btn btn-secondary mt-2">Back</a>

        </form>

    </div>


    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <script>
    $('#imageInput').on('change', function() {
        const file = this.files[0];
        const limit = 2 * 1024 * 1024;

        if (file && file.size > limit) {
            $('#js-image-error').show();
            $(this).val(''); // Reset file input
        } else {
            $('#js-image-error').hide();
        }
    });
    </script>
@endsection
