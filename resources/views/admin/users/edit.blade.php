@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="create-benefit-header">
            <h2>Redaguoti naudotoją {{ $user->first_name }}</h2>
        </div>
        <div class="card-body card-body-index">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <!-- User Details -->
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">El. Paštas</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">
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
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" autocomplete="first_name">
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
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="position" class="col-md-2 col-form-label text-md-right">Pareigos</label>
                    <div class="col-md-6">
                        <select id="position" name="position" class="form-control">
                            <option value="Specialistas" {{ $user->position == 'Specialistas' ? 'selected' : '' }}>Specialistas</option>
                            <option value="Sistemos administratorius" {{ $user->position == 'Sistemos administratorius' ? 'selected' : '' }}>Sistemos administratorius</option>
                            <option value="Skyriaus vadovas" {{ $user->position == 'Skyriaus vadovas' ? 'selected' : '' }}>Skyriaus vadovas</option>
                            <option value="Personalo valdymo skyriaus vadovas" {{ $user->position == 'Personalo valdymo skyriaus vadovas' ? 'selected' : '' }}>Personalo valdymo skyriaus vadovas</option>
                            <option value="Personalo valdymo skyriaus specialistas" {{ $user->position == 'Personalo valdymo skyriaus specialistas' ? 'selected' : '' }}>Personalo valdymo skyriaus specialistas</option>
                        </select>
                    </div>
                </div>

                @if ($user->userMeta && $user->userMeta->meta_key == 'avatar')
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $user->userMeta->meta_value) }}" alt="User Image" style="max-height: 100px;">
                    </div>
                </div>
                @endif

                <div class="form-group row">
                    <label for="street_address" class="col-md-2 col-form-label text-md-right">Adresas</label>
                    <div class="col-md-6">
                        <input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ $user->street_address }}">
                        @error('street_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="zip_code" class="col-md-2 col-form-label text-md-right">Pašto kodas</label>
                    <div class="col-md-6">
                        <input id="zip_code" type="number" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ $user->zip_code }}">
                        @error('zip_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-md-2 col-form-label text-md-right">Miestas</label>
                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->city }}">
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country" class="col-md-2 col-form-label text-md-right">Šalis</label>
                    <div class="col-md-6">
                        <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $user->country }}">
                        @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-2 col-form-label text-md-right">Naudotojo nuotrauka</label>
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control-file" id="image" onchange="validateImage()">
                        <script>
                            function validateImage() {
                                var fileInput = document.getElementById('image');
                                var maxSize = 2048 * 1024;
                                var allowedTypes = ['image/jpeg', 'image/png', 'image/bmp', 'image/gif', 'image/svg+xml', 'image/webp'];

                                if (fileInput.files && fileInput.files[0]) {
                                    var fileSize = fileInput.files[0].size;
                                    var fileType = fileInput.files[0].type;

                                    if (fileSize > maxSize) {
                                        alert('Pasirinktas failas per didelis. Leistinas dydis 2MB');
                                        fileInput.value = '';
                                        return false;
                                    }

                                    if (!allowedTypes.includes(fileType)) {
                                        alert('Galima įkelti tik šio tipo failus: JPEG, PNG, BMP, GIF, SVG, WebP.');
                                        fileInput.value = '';
                                        return false;
                                    }
                                }

                                return true;
                            }
                        </script>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-2 col-form-label text-md-right">Lytis</div><br>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="radio" id="male" name="gender" value="Vyras" {{ old('gender', $user->gender) == 'Vyras' ? 'checked' : '' }}>
                            <label for="male">Vyras</label><br>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="female" name="gender" value="Moteris" {{ old('gender', $user->gender) == 'Moteris' ? 'checked' : '' }}>
                            <label for="female">Moteris</label><br>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="other" name="gender" value="Kita" {{ old('gender', $user->gender) == 'Kita' ? 'checked' : '' }}>
                            <label for="other">Kita</label><br>
                        </div>
                    </div>
                </div>

                <!-- Role Selection -->
                <div class="form-group row">
                    <div for="roles" class="col-md-2 col-form-label text-md-right">Vaidmuo</div>
                    <div class="col-md-6">
                        @foreach($roles as $role)
                        <div class="form-check">
                            <input type="radio" name="roles" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
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


                <h2 style="padding: 20px 0;">Darbo užmokesčio informacija</h2>

                <div class="form-group row">
                    <label for="work_hours" class="col-md-2 col-form-label text-md-right">Darbo valandos per savaitę</label>
                    <div class="col-md-6">
                        <input id="work_hours" type="text" class="form-control @error('work_hours') is-invalid @enderror" name="work_hours" value="{{ $work_hours }}">
                        @error('work_hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="work_days" class="col-md-2 col-form-label text-md-right">Darbo dienos per savaitę</label>
                    <div class="col-md-6">
                        <input id="work_days" type="text" class="form-control @error('work_days') is-invalid @enderror" name="work_days" value="{{ $work_days }}">
                        @error('work_days')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="overtime" class="col-md-2 col-form-label text-md-right">Viršvalandžiai</label>
                    <div class="col-md-6">
                        <input id="overtime" type="text" class="form-control @error('overtime') is-invalid @enderror" name="overtime" value="{{ $overtime }}">
                        @error('overtime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gross" class="col-md-2 col-form-label text-md-right">Bruto atlyginimas</label>
                    <div class="col-md-6">
                        <input id="gross" type="text" class="form-control @error('gross') is-invalid @enderror" name="gross" value="{{ $gross }}">
                        @error('gross')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="net" class="col-md-2 col-form-label text-md-right">Neto atlyginimas</label>
                    <div class="col-md-6">
                        <input id="net" type="text" class="form-control" name="net" value="{{ $net }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="info" class="col-md-2 col-form-label text-md-right">Papildoma informacija</label>
                    <div class="col-md-6">
                        <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ $info }}">
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