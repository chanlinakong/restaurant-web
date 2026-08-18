<section>

    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="font-weight-bold mb-1">
                {{ __('Delete Account') }}
            </h5>

            <p class="text-muted mb-0">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
            </p>
        </div>

        <button
            type="button"
            class="btn btn-outline-danger"
            data-toggle="modal"
            data-target="#confirmUserDeletion"
        >
            <i class="fas fa-trash-alt mr-1"></i>
            {{ __('Delete Account') }}
        </button>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div
        class="modal fade"
        id="confirmUserDeletion"
        tabindex="-1"
        role="dialog"
        aria-labelledby="confirmUserDeletionLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                {{-- Header --}}
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmUserDeletionLabel">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        {{ __('Delete Account') }}
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Body --}}
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body">

                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle mr-2"></i>

                            {{ __('This action cannot be undone. Your account and all associated data will be permanently deleted.') }}
                        </div>

                        <div class="form-group mb-0">
                            <label for="delete_password">
                                {{ __('Password') }}
                            </label>

                            <input
                                id="delete_password"
                                name="password"
                                type="password"
                                class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                                placeholder="{{ __('Enter your password to confirm') }}"
                                autocomplete="current-password"
                            >

                            @if ($errors->userDeletion->has('password'))
                                <span class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </span>
                            @endif
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            <i class="fas fa-times mr-1"></i>
                            {{ __('Cancel') }}
                        </button>

                        <button
                            type="submit"
                            class="btn btn-danger"
                        >
                            <i class="fas fa-trash-alt mr-1"></i>
                            {{ __('Delete Account') }}
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</section>

{{-- Re-open modal when validation fails --}}
@if ($errors->userDeletion->isNotEmpty())
    <script>
        $(document).ready(function () {
            $('#confirmUserDeletion').modal('show');
        });
    </script>
@endif