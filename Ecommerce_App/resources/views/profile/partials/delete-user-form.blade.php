<div class="card card-danger ">
    <div class="card-header">
        <h3 class="card-title">Delete Account</h3>
    </div>
    <div class="card-body">
        <p class="text-muted">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to retain.
        </p>

        <!-- Delete Button triggers modal -->
        <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#deleteAccountModal">
            Delete Account
        </button>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                    Please enter your password to confirm.
                </p>

                <div class="form-group mt-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                    @error('password', 'userDeletion')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </div>
        </form>
    </div>
</div>
