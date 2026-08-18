<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="row">
            {{-- Current Password --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="update_password_current_password">
                        <i class="fas fa-key text-muted mr-1"></i>
                        {{ __('Current Password') }}
                    </label>

                    <input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                        autocomplete="current-password"
                        placeholder="Enter your current password"
                    >

                    @if ($errors->updatePassword->has('current_password'))
                        <span class="invalid-feedback">
                            {{ $errors->updatePassword->first('current_password') }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- New Password --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="update_password_password">
                        <i class="fas fa-lock text-muted mr-1"></i>
                        {{ __('New Password') }}
                    </label>

                    <input
                        id="update_password_password"
                        name="password"
                        type="password"
                        class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif"
                        autocomplete="new-password"
                        placeholder="Enter new password"
                    >

                    @if ($errors->updatePassword->has('password'))
                        <span class="invalid-feedback">
                            {{ $errors->updatePassword->first('password') }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="update_password_password_confirmation">
                        <i class="fas fa-lock text-muted mr-1"></i>
                        {{ __('Confirm Password') }}
                    </label>

                    <input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif"
                        autocomplete="new-password"
                        placeholder="Confirm your new password"
                    >

                    @if ($errors->updatePassword->has('password_confirmation'))
                        <span class="invalid-feedback">
                            {{ $errors->updatePassword->first('password_confirmation') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-lock mr-1"></i>
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <span
                    class="text-success ml-3"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                >
                    <i class="fas fa-check-circle mr-1"></i>
                    {{ __('Password updated successfully.') }}
                </span>
            @endif
        </div>
    </form>
</section>