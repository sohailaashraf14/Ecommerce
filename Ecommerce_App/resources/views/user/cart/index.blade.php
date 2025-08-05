@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="h3 mb-4 text-gray-800">Your Shopping Cart</h1>

                @if ($cartItems->isEmpty())
                    <div class="alert alert-info text-center">Your cart is empty.</div>
                @else
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php $total = $item->product->price * $item->quantity; $grandTotal += $total; @endphp
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td>{{ $item->product->category->name ?? 'Uncategorized' }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- Decrease Quantity --}}
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                            <button class="btn btn-sm btn-secondary" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                        </form>

                                        <span class="mx-2">{{ $item->quantity }}</span>

                                        {{-- Increase Quantity --}}
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                            <button class="btn btn-sm btn-secondary">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td>${{ number_format($item->product->price, 2) }}</td>
                                <td>${{ number_format($total, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-left font-weight-bold">Grand Total:</td>
                            <td colspan="2">${{ number_format($grandTotal, 2) }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-primary mr-2">← Back to Home</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
