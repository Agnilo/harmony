@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto h2-padding">
                <h2>Redaguoti vartotoją {{ $user->first_name }}</h2>
            </div>
        </div>
        <div class="card-body card-body-index">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">

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

                <!-- Other user details -->

                @csrf
                {{ method_field('PUT') }}

                <!-- Role selection -->
                <div class="form-group row">
                    <label for="roles" class="col-md-2 col-form-label text-md-right">Vaidmuo</label>
                    <div class="col-md-6">
                        <div>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                    <label>{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Verified status selection -->
                <div class="form-group row">
                    <label for="is_verified" class="col-md-2 col-form-label text-md-right">Patvirtintas</label>
                    <div class="col-md-6">
                        <div>
                            <select id="is_verified" name="is_verified" class="form-control">
                                <option value="0" {{ $user->is_verified == 0 ? 'selected' : '' }}>Ne</option>
                                <option value="1" {{ $user->is_verified == 1 ? 'selected' : '' }}>Taip</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Payroll information -->
                <h2>Payroll Information</h2>

                <div class="form-group row">
                    <label for="workHours" class="col-md-2 col-form-label text-md-right">Darbo valandos per savaitę</label>
                    <div class="col-md-6">
                        <input id="workHours" type="text" class="form-control @error('workHours') is-invalid @enderror" name="workHours" value="{{ $workHours }}" required autofocus>

                        @error('workHours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Other payroll details -->
                
                <!-- Buttons -->
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