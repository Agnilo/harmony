@extends('layouts.app')

@section('content')
<div class="login-background">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Atkurti slaptažodį') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3 card-body-element">
                            <label for="email" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('El. Pašto adresas') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 card-body-bottom-element">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary login-btn">
                                    {{ __('Atsiųsti slaptažodžio atkūrimo nuorodą') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
