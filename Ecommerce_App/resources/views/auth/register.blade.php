<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header"><h3 class="card-title">Register</h3></div>
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required />
                </div>

                <div class="form-group">
                    <label for="role">Register as:</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button class="btn btn-primary mt-3">Register</button>
            </form>
        </div>
    </div>
@endsection
