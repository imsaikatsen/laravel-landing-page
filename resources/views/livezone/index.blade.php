@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Live Zones</h5>
        <a href="{{ route('livezone.create') }}" class="btn btn-success">+ Add New</a>
    </div>

    <div class="table-responsive shadow-sm rounded bg-dark p-3">
        <table class="table table-striped table-hover text-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($zones as $zone)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $zone->title }}</td>
                    <td>
                        @if($zone->image)
                            <img src="{{ asset('livezones/'.$zone->image) }}" width="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td class="text-truncate" style="max-width:200px;">{{ $zone->description }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('livezone.edit', $zone->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

                            <form id="delete-form-{{ $zone->id }}" action="{{ route('livezone.destroy', $zone->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $zone->id }})">
                                     <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No Live Zones Found</td>
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

