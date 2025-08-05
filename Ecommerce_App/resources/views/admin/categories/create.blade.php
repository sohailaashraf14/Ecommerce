@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Create Category</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.categories.index') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Enter category name">
                        @error('name')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
