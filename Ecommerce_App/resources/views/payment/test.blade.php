<!-- resources/views/payment/test.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container my-5 text-center">
        <h3>Complete Your Payment</h3>
        <iframe src="{{ $iframe_url }}" width="100%" height="600" frameborder="0"></iframe>
    </div>
@endsection
