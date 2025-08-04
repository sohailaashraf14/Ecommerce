@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="text-center">
        <h1>Welcome to the App</h1>
        <p class="lead">Please choose an option:</p>
        <a href="{{ route('login') }}" class="btn btn-primary m-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-success m-2">Register</a>
    </div>
@endsection
