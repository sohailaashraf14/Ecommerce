@extends('layouts.app')

@section('title', $product->title)

@section('content')
    <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <h1 class="mb-4">Product Details</h1>
        <div>
            <a href="{{ route('home') }}" class="btn btn-primary">← Back to Home</a>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            <!-- Product Image -->
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="img-fluid rounded shadow"
                         alt="{{ $product->title }}">
                @else
                    <p class="text-muted">No image available</p>
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-12 col-md-6">
                <h2>{{ $product->title }}</h2>
                <p class="text-muted mb-1">
                    <strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}
                </p>
                <h4 class="text-success mb-3">
                    <strong>Price:</strong> ${{ number_format($product->price, 2) }}
                </h4>
                <p>{{ $product->description }}</p>

                @auth
                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <label for="quantity" class="mr-sm-2">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1"
                                   class="form-control mr-sm-3" style="max-width: 100px;">
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </div>
                    </form>

                    <!-- Add to Wishlist Form -->
                    <form action="{{ route('wishlist.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-outline-danger btn-block btn-sm">
                            <i class="fas fa-heart"></i> Add to Wishlist
                        </button>
                    </form>
                @else
                    <p class="text-danger mt-3">
                        Please <a href="{{ route('login') }}">log in</a> to add products to your cart.
                    </p>
                @endauth
            </div>
        </div>
    </div>
@endsection
