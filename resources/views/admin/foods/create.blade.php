@extends('layouts.admin')

@section('content')
    <h1>Add New Food Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}"
                required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <input type="hidden" name="is_available" value="0">
            <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available') ? 'checked' : '' }}>
            <label for="is_available">Is Available</label>
        </div>
        <button type="submit" class="btn btn-primary">Save Food</button>
        <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection