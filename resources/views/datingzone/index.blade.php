@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Dating Zones</h5>
        <a href="{{ route('datingzone.create') }}" class="btn btn-success">+ Add New</a>
    </div>

    <div class="table-responsive shadow-sm rounded bg-dark p-3">
        <table class="table table-striped table-hover text-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Tag 1</th>
                    <th>Tag 2</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($zones as $zone)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($zone->image)
                            <img src="{{ asset('datingzones/'.$zone->image) }}" alt="image" width="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $zone->title }}</td>
                    <td class="text-truncate" style="max-width:200px;">{{ $zone->description }}</td>
                    <td>{{ $zone->tag1 }}</td>
                    <td>{{ $zone->tag2 }}</td>
                    <td>{{ $zone->count }}</td>
                    <td>
                        <a href="{{ route('datingzone.edit', $zone->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

                        {{-- <form action="{{ route('datingzone.destroy', $zone->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i></button>
                        </form> --}}
                        <form id="delete-form-{{ $zone->id }}" action="{{ route('datingzone.destroy', $zone->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $zone->id }})">
                                     <i class="fa fa-trash"></i>
                                </button>
                            </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No Dating Zones Found</td>
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
