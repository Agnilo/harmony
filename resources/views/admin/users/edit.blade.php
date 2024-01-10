@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <br>
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h2><a style="color: #262626">Redaguoti vartotoją {{$user->first_name}}</a></h2>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center" style="background-color: lightgrey">
            <br>
        </div>
        <div class="card-body">
            <form action="{{route('admin.users.update', $user) }}" method="POST">

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

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

                @csrf
                {{method_field('PUT') }}
                <div class="form-group row">
                    <label for="roles" class="col-md-2 col-form-label text-md-right">Vaidmuo</label>

                    <div class="col-md-6">
                        @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                            <label>{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Atnaujinti
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    Grįžti atgal
                </button>
            </form>
        </div>
    </div>
</div>
@endsection