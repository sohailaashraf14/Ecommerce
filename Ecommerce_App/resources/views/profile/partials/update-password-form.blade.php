<div class="card card-info mt-4">
    <div class="card-header">
        <h3 class="card-title">Update Password</h3>
    </div>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <p class="text-muted mb-3">
                Ensure your account is using a long, random password to stay secure.
            </p>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input
                    type="password"
                    name="current_password"
                    id="current_password"
                    class="form-control"
                    autocomplete="current-password"
                >
                @error('current_password', 'updatePassword')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">New Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    autocomplete="new-password"
                >
                @error('password', 'updatePassword')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    autocomplete="new-password"
                >
                @error('password_confirmation', 'updatePassword')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Save</button>

            @if (session('status') === 'password-updated')
                <span class="ml-3 text-success">Saved.</span>
            @endif
        </div>
    </form>
</div>
