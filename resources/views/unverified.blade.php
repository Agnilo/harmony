<div class="login-background">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header">{{ __('Slaptažodžio patvirtinimas') }}</div>

                <div class="card-body">
                    <div class="card-body-additional-header">
                        {{ __('Prašome patvirtinti slaptažodį prieš tęsiant toliau') }}
                    </div>
                    

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3 card-body-element">
                            <label for="password" class="col-md-4 col-form-label text-md-end card-body-element-input">{{ __('Slaptažodis') }}</label>

                            <div class="col-md-6 card-body-element-input">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 card-body-bottom-element">
                            <div class="col-md-8 offset-md-4 card-body-element-add">
                                <button type="submit" class="btn btn-primary login-btn">
                                    {{ __('Patvirtinti slaptažodį') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" style="margin-left: -2%;" href="{{ route('password.request') }}">
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