@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Edit Product</h1>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Current Image</label><br>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="Product Image">
                        @else
                            No image uploaded
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Change Image</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
