@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto h2-padding">
                <h2>Redaguoti vartotoją {{$user->first_name}}</h2>
            </div>
        </div>
        <div class="card-body card-body-index">
            <form action="{{route('admin.users.update', $user) }}" method="POST">

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">El. Paštas</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="first_name" class="col-md-2 col-form-label text-md-right">Vardas</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-2 col-form-label text-md-right">Pavardė</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @csrf
                {{method_field('PUT') }}
                <div class="form-group row">
                    <label for="roles" class="col-md-2 col-form-label text-md-right">Vaidmuo</label>

                    <div class="col-md-6">
                        @foreach($roles as $role)
                        <div class="form-check">
                            <input type="radio" name="roles[]" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                            <label>{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_verified" class="col-md-2 col-form-label text-md-right">Patvirtintas</label>
                    <div class="col-md-6">
                        <select id="is_verified" name="is_verified" class="form-control">
                            <option value="0" {{ $user->is_verified == 0 ? 'selected' : '' }}>Ne</option>
                            <option value="1" {{ $user->is_verified == 1 ? 'selected' : '' }}>Taip</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary user-create-button-margin-right">
                    Atnaujinti
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary user-create-button-margin-left">
                    Grįžti atgal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection