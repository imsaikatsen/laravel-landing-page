{{-- @extends('layouts.dashboard')

@section('content')
    <div class="stat-card">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">Slider List</h5>
            <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fa fa-plus me-1"></i> Add Slider
            </a>
        </div>

        <table class="table table-hover align-middle table-borderless">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sliders as $k => $slider)
                    <tr class="shadow-sm rounded mb-2 bg-white align-middle">
                        <td>{{ $k + 1 }}</td>
                        <td>
                            <img src="/sliders/{{ $slider->image }}" width="120" class="rounded shadow-sm">
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-sm btn-warning shadow-sm"
                                    title="Edit Slider">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form id="delete-form-{{ $slider->id }}"
                                    action="{{ route('slider.destroy', $slider->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-danger shadow-sm"
                                        onclick="confirmDelete({{ $slider->id }})" title="Delete Slider">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>


                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- SWEETALERT SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff4444',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection --}}

@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Slider List</h5>
        <a href="{{ route('slider.create') }}" class="btn btn-success">+ Add Slider</a>
    </div>

    <div class="table-responsive shadow-sm rounded bg-dark p-3">
        <table class="table table-striped table-hover text-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $k => $slider)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>
                        @if($slider->image)
                            <img src="/sliders/{{ $slider->image }}" width="120" class="rounded shadow-sm">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-sm btn-warning" title="Edit Slider">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form id="delete-form-{{ $slider->id }}" action="{{ route('slider.destroy', $slider->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $slider->id }})" title="Delete Slider">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">No Sliders Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- SWEETALERT SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection

