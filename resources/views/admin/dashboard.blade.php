@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Admin Dashboard</h1>
            <a href="{{ route('admin.foods.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Add New Food
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0">Recent Food Items</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($foods as $food)
                                <tr>
                                    <td>{{ $food->id }}</td>
                                    <td><strong>{{ $food->name }}</strong></td>
                                    <td>${{ number_format($food->price, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $food->is_available ? 'bg-success' : 'bg-danger' }}">
                                            {{ $food->is_available ? 'Available' : 'Not Available' }}
                                        </span>
                                        @if($food->trashed())
                                            <span class="badge bg-warning ms-1">In Trash</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.foods.edit', $food) }}"
                                                class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.foods.destroy', $food) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Move this item to trash?')" title="Move to Trash">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                        No food items found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $foods->links() }}
        </div>
    </div>
@endsection