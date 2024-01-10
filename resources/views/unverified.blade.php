@extends('layouts.app')

@section('content')
<div class="login-background">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header">{{ __('Naudotojo patvirtinimas') }}</div>

                <div class="card-body">
                    <div class="card-body-additional-header">
                        {{ __('Jūs esate nepatvirtintas naudotojas. Prašome palaukti, kol Administratoriai patvirtins jūsų paskyrą.') }}
                    </div>
                </div>
            </div>
        
    </div>
</div>
@endsection
