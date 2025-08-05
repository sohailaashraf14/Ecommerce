<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Profile Information</h3>
    </div>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="card-body">
            <p class="text-muted mb-3">
                Update your account's profile information and email address.
            </p>

            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                >
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 text-warning">
                        <p>Your email address is unverified.</p>

                        <button
                            form="send-verification"
                            class="btn btn-link p-0"
                        >
                            Click here to re-send the verification email.
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success mt-1">
                                A new verification link has been sent to your email address.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'profile-updated')
                <span class="ml-3 text-success">Saved.</span>
            @endif
        </div>
    </form>
</div>
