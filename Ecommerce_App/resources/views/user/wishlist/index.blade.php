@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
            <h2 class="mb-3 mb-md-0">My Wishlist</h2>
            <a href="{{ route('home') }}" class="btn btn-primary">← Back to Home</a>
        </div>

        <!-- Wishlist Items -->
        <div class="row">
            @forelse ($items as $item)
                <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100 shadow-sm d-flex flex-column">
                        @if ($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top" alt="{{ $item->product->title }}" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->product->title }}</h5>
                            <p class="text-muted mb-1">Category: {{ $item->product->category->name ?? 'Uncategorized' }}</p>
                            <p class="mb-2"><strong>Price:</strong> ${{ number_format($item->product->price, 2) }}</p>

                            <div class="mt-auto">
                                <!-- Add to Cart -->
                                <form action="{{ route('wishlist.addToCart', $item->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100">Add to Cart</button>
                                </form>


                                <!-- Remove from Wishlist -->
                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info">No items in your wishlist.</div>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary mt-3">Browse Products</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
