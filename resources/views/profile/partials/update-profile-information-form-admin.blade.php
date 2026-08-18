<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="row">
            {{-- Name --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user text-muted mr-1"></i>
                        {{ __('Name') }}
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter your name"
                    >

                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            {{-- Email --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope text-muted mr-1"></i>
                        {{ __('Email') }}
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        placeholder="Enter your email"
                    >

                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning mt-3 mb-0">
                            <i class="fas fa-exclamation-circle mr-1"></i>

                            {{ __('Your email address is unverified.') }}

                            <button
                                form="send-verification"
                                class="btn btn-link p-0 align-baseline"
                            >
                                {{ __('Resend verification email') }}
                            </button>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="text-success small mt-2">
                                <i class="fas fa-check-circle mr-1"></i>
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        {{-- Save --}}
        <div class="d-flex align-items-center mt-3">
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span
                    class="text-success ml-3"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                >
                    <i class="fas fa-check-circle mr-1"></i>
                    {{ __('Saved successfully.') }}
                </span>
            @endif
        </div>
    </form>
</section>