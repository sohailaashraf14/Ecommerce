@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Page Header -->

                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>


                <!-- Update Password -->


                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>


                <!-- Delete Account -->

                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>


            </div>
        </div>
    </div>
@endsection
