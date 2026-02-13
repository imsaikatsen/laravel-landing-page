@extends('layouts.dashboard')

@section('content')
<div class="stat-card p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Page SEO</h5>
        <a href="{{ route('pageseo.create') }}" class="btn btn-success">+ Add Page SEO</a>
    </div>

    <div class="table-responsive shadow-sm rounded bg-dark p-3">
        <table class="table table-striped table-hover text-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Page Key</th>
                    <th>Title</th>
                    <th>Meta Title</th>
                    <th>Meta Keywords</th>
                    <th>Meta Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $k => $p)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $p->page_key }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->meta_title }}</td>
                    <td>{{ $p->meta_keywords }}</td>
                    <td class="text-truncate" style="max-width:200px;">{{ $p->meta_description }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('pageseo.edit', $p->id) }}" class="btn btn-sm btn-warning" title="Edit SEO">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form id="delete-form-{{ $p->id }}" method="POST" action="{{ route('pageseo.destroy', $p->id) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $p->id }})" title="Delete SEO">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No SEO Pages Found</td>
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
            text: "This action cannot be undone!",
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
