{{-- @extends('layouts.dashboard')

@section('content')
    <a href="{{ route('mallproducts.create') }}" class="btn btn-success mb-3 float-end">+ Add Product</a>
    <table class="table table-dark table-bordered align-middle">

        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Sold</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>
                        @if ($p->image)
                            <img src="/mall-products/{{ $p->image }}" width="60">
                        @endif
                    </td>

                    <td>{{ $p->title }}</td>
                    <td>¥ {{ $p->price }}</td>
                    <td>{{ $p->sold_count }}</td>
                    <td>{{ $p->rating }}</td>
                    <td>
                        <a href="{{ route('mallproducts.edit', $p->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form method="POST" action="{{ route('mallproducts.destroy', $p->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $products->links() }}
@endsection --}}


@extends('layouts.dashboard')

@section('content')
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Sex Mall</h5>
        <a href="{{ route('mallproducts.create') }}" class="btn btn-success">+ Add Product</a>
    </div>

    <div class="table-responsive shadow-sm rounded bg-dark p-3">
        <table class="table table-striped table-hover text-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Sold</th>
                    <th>Rating</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td>
                        @if($p->image)
                            <img src="/mall-products/{{ $p->image }}" width="60" class="rounded shadow-sm">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $p->title }}</td>
                    <td>¥ {{ $p->price }}</td>
                    <td>{{ $p->sold_count }}</td>
                    <td>{{ $p->rating }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('mallproducts.edit', $p->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

                            <form id="delete-form-{{ $p->id }}" method="POST" action="{{ route('mallproducts.destroy', $p->id) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $p->id }})">
                                     <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No Products Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $products->links() }}
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
