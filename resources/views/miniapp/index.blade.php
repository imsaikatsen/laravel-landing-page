@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Mini App</h5>
        <a href="{{ route('miniapp.create') }}" class="btn btn-success">+ Add Mini App</a>
    </div>

    <div class="table-responsive shadow-sm rounded bg-dark p-3">
        <table class="table table-striped table-hover text-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($apps as $k => $app)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>
                        @if($app->appImage)
                            <img src="/miniapps/{{ $app->appImage }}" width="50" class="rounded shadow-sm">
                        @else
                            <span class="text-muted">No Icon</span>
                        @endif
                    </td>
                    <td>{{ $app->appTitle }}</td>
                    <td class="text-truncate" style="max-width:200px;">{{ $app->description }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('miniapp.edit', $app->id) }}" class="btn btn-sm btn-warning" title="Edit Mini App">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form id="delete-form-{{ $app->id }}" method="POST" action="{{ route('miniapp.destroy', $app->id) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $app->id }})" title="Delete Mini App">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No Mini Apps Found</td>
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

