@extends('layouts.app')

@section('content')
<div class="container mt-5" >
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card back-color">
                <div class="card-header text-center text-white fs-5">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4 mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input_addon custom-addon">
                                        <i class="fa fa-user fs-2"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4 mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input_addon custom-addon">
                                        <i class="fa fa-lock fs-2"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="input-group">
                                <button type="submit" style="width: inherit;" class="btn btn-primary fs-4 px-5 py-2 login-button" >
                                    {{ __('Sign In') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mt-2 remember-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link forgot-url" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
