@extends('layouts.app')

@section('content')
<div class="login-background">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Prisijungimas') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3 card-body-element">
                        <label for="email" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('El. Pašto adresas') }}</label>

                        <div class="col-md-6 card-body-element-input">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" oninvalid="this.setCustomValidity('Prašome įtraukti \'@\' el. pašto adrese.')" oninput="this.setCustomValidity('')">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            @if ($errors->has('custom_email_error'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('custom_email_error') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3 card-body-element">
                        <label for="password" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('Slaptažodis') }}</label>

                        <div class="col-md-6 card-body-element-input">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 card-body-bottom-element">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Prisiminti mane') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0 card-body-bottom-element">
                        <div class="col-md-8 offset-md-4 card-body-bottom-element">
                            <button type="submit" class="btn login-btn">
                                {{ __('Prisijungti') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Pamiršote slaptažodį?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection