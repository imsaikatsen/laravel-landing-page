@extends('layouts.dashboard')

@section('content')
    <div class="stat-card">

        <h4 class="mb-3">Create Live Zone</h4>

        <form action="{{ route('livezone.store') }}" method="POST" enctype="multipart/form-data" id="mallForm" novalidate>
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" id="imageInput" class="form-control">
                    <div id="js-image-error" style="color: red; display: none; font-size: 0.8rem; margin-top: 5px;">
                        File is too large! Please select an image under 2MB.
                    </div>
                </div>


        

                <div class="col-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="form-control" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Meta Keywords</label>
                    <input type="text" name="metaKeywords" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="metaTitle" class="form-control form-control-lg" placeholder="Enter Meta Title"
                        value="{{ old('metaTitle') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Meta Description</label>
                    <input type="text" name="metaDescription" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label>Custom Script / HTML Inject</label>
                    <textarea name="customScript" rows="4" class="form-control"></textarea>
                </div>

            </div>

            <button class="btn btn-success mt-2">Save Live Zone</button>
            <a href="{{ route('livezone.index') }}" class="btn btn-secondary mt-2">Back</a>
        </form>
    </div>

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <!-- Frontend Validation Script -->
    <script>
        (function () {
            'use strict'
            const form = document.getElementById('mallForm')
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })()
    </script>

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
