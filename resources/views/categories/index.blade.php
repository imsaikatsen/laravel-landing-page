@extends('layouts.dashboard')

@section('content')
    <div class="stat-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Categories</h5>
            <a href="{{ route('category.create') }}" class="btn btn-success">+ Add Category</a>
        </div>

        @if ($errors->has('delete'))
            <div class="alert alert-danger">{{ $errors->first('delete') }}</div>
        @endif

        <div class="table-responsive shadow-sm rounded bg-dark p-3">
            <table class="table table-striped table-hover text-white align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $k => $category)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form id="delete-category-form-{{ $category->id }}" method="POST"
                                        action="{{ route('category.destroy', $category->id) }}" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmCategoryDelete({{ $category->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmCategoryDelete(id) {
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
                    document.getElementById('delete-category-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
