@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Food Items Management</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.foods.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Add New Food
                </a>
                <a href="{{ route('admin.foods.trash') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-trash me-1"></i> View Trash
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($foods as $food)
                                <tr>
                                    <td style="width: 100px;">
                                        @if($food->image)
                                            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}"
                                                class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $food->name }}</strong></td>
                                    <td class="text-muted">{{ Str::limit($food->description, 100) }}</td>
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
                                            @if(!$food->trashed())
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
                                            @else
                                                <form action="{{ route('admin.foods.restore', $food->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Restore">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.foods.force-delete', $food->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Permanently delete this item? This action cannot be undone.')"
                                                        title="Delete Permanently">
                                                        <i class="fas fa-times-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
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

@push('styles')
    <style>
        .table th {
            font-weight: 600;
        }

        .btn-group .btn {
            padding: 0.25rem 0.5rem;
        }

        .btn-group .btn i {
            width: 1rem;
            text-align: center;
        }
    </style>
@endpush