<!-- resources/views/payment/thankyou.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <h1>🎉 Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to Home</a>
    </div>
@endsection
