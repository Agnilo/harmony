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
                @csrf
                {{ method_field('PUT') }}

                <!-- User Details -->
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
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autofocus>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-2 col-form-label text-md-right">Pavardė</label>
                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autofocus>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Role Selection -->
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

                <!-- Verified Status Selection -->
                <div class="form-group row">
                    <label for="is_verified" class="col-md-2 col-form-label text-md-right">Patvirtintas</label>
                    <div class="col-md-6">
                        <select id="is_verified" name="is_verified" class="form-control">
                            <option value="0" {{ $user->is_verified == 0 ? 'selected' : '' }}>Ne</option>
                            <option value="1" {{ $user->is_verified == 1 ? 'selected' : '' }}>Taip</option>
                        </select>
                    </div>
                </div>

                <!-- Payroll Information -->
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

                <div class="form-group row">
                    <label for="workDays" class="col-md-2 col-form-label text-md-right">Darbo dienos per savaitę</label>
                    <div class="col-md-6">
                        <input id="workDays" type="text" class="form-control @error('workDays') is-invalid @enderror" name="workDays" value="{{ $workDays }}" required autofocus>
                        @error('workDays')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="overtime" class="col-md-2 col-form-label text-md-right">Viršvalandžiai</label>
                    <div class="col-md-6">
                        <input id="overtime" type="text" class="form-control @error('overtime') is-invalid @enderror" name="overtime" value="{{ $overtime }}" required autofocus>
                        @error('overtime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grossSalary" class="col-md-2 col-form-label text-md-right">Bruto atlyginimas</label>
                    <div class="col-md-6">
                        <input id="grossSalary" type="text" class="form-control @error('grossSalary') is-invalid @enderror" name="grossSalary" value="{{ $grossSalary }}" required autofocus>
                        @error('grossSalary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="netSalary" class="col-md-2 col-form-label text-md-right">Neto atlyginimas</label>
                    <div class="col-md-6">
                        <input id="netSalary" type="text" class="form-control @error('netSalary') is-invalid @enderror" name="netSalary" value="{{ $netSalary }}" required autofocus>
                        @error('netSalary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="info" class="col-md-2 col-form-label text-md-right">Papildoma informacija</label>
                    <div class="col-md-6">
                        <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ $info }}" autofocus>
                        @error('info')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary user-create-button-margin-right">Atnaujinti</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary user-create-button-margin-left">Grįžti atgal</a>
            </form>
        </div>
    </div>
</div>
@endsection