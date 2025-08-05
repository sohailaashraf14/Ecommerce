@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')
    <!-- Page Header -->
    <div class="container-fluid d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Product Details</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mr-2">← Back to Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back to Products</a>
        </div>
    </div>

    <!-- Product Details Card -->
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-5 text-center mb-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->title }}">
                        @else
                            <p class="text-muted">No image available</p>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="col-md-7">
                        <h3 class="mb-3">{{ $product->title }}</h3>
                        <p><strong>Category:</strong>
                            {{ $product->category ? $product->category->name : 'Uncategorized' }}
                        </p>

                        <p><strong>Description:</strong></p>
                        <p>{{ $product->description }}</p>
                        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
