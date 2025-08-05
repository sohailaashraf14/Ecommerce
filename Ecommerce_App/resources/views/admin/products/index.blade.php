@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="m-0">Products</h1>
            <div class="container-fluid d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mr-3">Back to Dashboard</a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover m-0">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price ($)</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="60">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->category?->name ??'Uncategorized' }}</td>

                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-secondary">View</a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($products->isEmpty())
                        <div class="p-3 text-center">No products available.</div>
                    @endif

                    <div class="mt-4 mb-4 ml-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
