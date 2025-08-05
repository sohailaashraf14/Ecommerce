@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <!-- Page Heading -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
                    <h1 class="h3 mb-0 text-gray-800">All Products</h1>
                </div>

                <!-- Category Filter -->
                <form method="GET" class="mb-4">
                    <div class="form-group row align-items-center">
                        <label for="category" class="col-sm-12 col-md-3 col-form-label text-md-right mb-2 mb-md-0">Filter by Category:</label>
                        <div class="col-sm-12 col-md-9">
                            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <!-- Product List -->
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex">
                            <div class="card w-100 h-100 d-flex flex-column shadow-sm">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="card-img-top"
                                         alt="{{ $product->title }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="mb-1"><strong>Category:</strong> {{ $product->category?->name ?? 'Uncategorized' }}</p>
                                    <p class="text-muted mb-2">{{ Str::limit($product->description, 80) }}</p>
                                    <p class="mb-3"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>

                                    <div class="mt-auto">


                                        @auth
                                            @php
                                                $isInWishlist = $product->wishlists()->where('user_id', auth()->id())->exists();
                                            @endphp

                                                <!-- Add to Cart Form -->
                                            <form action="{{ route('cart.store') }}" method="POST" class="mb-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="form-group d-flex flex-column justify-content-center flex-sm-row align-items-start align-items-sm-center gap-2">
                                                    <input type="number" name="quantity" id="quantity" min="1" value="1"
                                                           class="form-control mr-sm-3" style="max-width: 100px;">
                                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                                </div>
                                            </form>
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-block mb-2">View</a>
                                            <!-- Add to Wishlist -->
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"
                                                        class="btn btn-sm btn-block {{ $isInWishlist ? 'btn-danger' : 'btn-outline-danger' }}"
                                                    {{ $isInWishlist ? 'disabled' : '' }}>
                                                    <i class="fas fa-heart"></i> {{ $isInWishlist ? 'In Wishlist' : 'Add to Wishlist' }}
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-info">No products found.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
