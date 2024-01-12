@extends('layouts.app')

@section('content')
<div class="login-background">
    <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{ __('Registracija') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 card-body-element">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('Vardas') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 card-body-element">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('Pavardė') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 card-body-element">
                            <label for="email" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('El. pašto adresas') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 card-body-element">
                            <label for="password" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('Slaptažodis') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 card-body-element">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('Pakartoti slaptažodį') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0 card-body-bottom-element">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn login-btn">
                                    {{ __('Registruotis') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>
@endsection
