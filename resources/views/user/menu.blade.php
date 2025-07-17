@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Available Menu</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($foods as $food)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top" alt="{{ $food->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $food->name }}</h5>
                            <p class="card-text">{{ Str::limit($food->description, 80) }}</p>
                            <p class="text-success">₹{{ $food->price }}</p>
                            <a href="{{ route('foods.show', $food->id) }}" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No food items available.</p>
            @endforelse
        </div>
    </div>
@endsection