@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">📦 Admin Dashboard</h2>

        {{-- Product Summary --}}
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $productCount }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                        View All <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-start align-items-center">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary ">Add Product</a>

        </div><br>

        {{-- Product Table --}}
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title">All Products</h3>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th class="d-none d-sm-table-cell">Price</th>
                            <th class="d-none d-md-table-cell">Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a href="{{ route('admin.products.show', $product->id) }}">
                                        {{ $product->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $product->category ? $product->category->name : 'Uncategorized' }}
                                </td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="Product Image"
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td class="d-none d-sm-table-cell">${{ number_format($product->price, 2) }}</td>
                                <td class="d-none d-md-table-cell">{{ $product->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning ">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
