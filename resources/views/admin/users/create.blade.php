@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="create-benefit-header">
            <h2>Sukurti naują naudotoją</h2>
        </div>
        <div class="card-body card-body-index">

            <form method="POST" action="{{ route('admin.users.store') }}" class="card-body-layout-flex" enctype="multipart/form-data">
                @csrf
                <div class="form-group row create-row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">El. Paštas</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="first_name" class="col-md-2 col-form-label text-md-right">Vardas</label>
                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="last_name" class="col-md-2 col-form-label text-md-right">Pavardė</label>
                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="street_address" class="col-md-2 col-form-label text-md-right">Adresas</label>
                    <div class="col-md-6">
                        <input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ old('street_address') }}">
                        @error('street_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="zip_code" class="col-md-2 col-form-label text-md-right">Pašto kodas</label>
                    <div class="col-md-6">
                        <input id="zip_code" type="number" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ old('zip_code') }}">
                        @error('zip_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="city" class="col-md-2 col-form-label text-md-right">Miestas</label>
                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="country" class="col-md-2 col-form-label text-md-right">Šalis</label>
                    <div class="col-md-6">
                        <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}">
                        @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="password" class="col-md-2 col-form-label text-md-right">Slaptažodis</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="position" class="col-md-2 col-form-label text-md-right">Pareigos</label>
                    <div class="col-md-6">
                        <select id="position" name="position" class="form-control">
                            <option value="Specialistas" {{ old('position', 'Specialistas') == 'Specialistas' ? 'selected' : '' }}>Specialistas</option>
                            <option value="Sistemos administratorius" {{ old('position') == 'Sistemos administratorius' ? 'selected' : '' }}>Sistemos administratorius</option>
                            <option value="Skyriaus vadovas" {{ old('position') == 'Skyriaus vadovas' ? 'selected' : '' }}>Skyriaus vadovas</option>
                            <option value="Personalo valdymo skyriaus vadovas" {{ old('position') == 'Personalo valdymo skyriaus vadovas' ? 'selected' : '' }}>Personalo valdymo skyriaus vadovas</option>
                            <option value="Personalo valdymo skyriaus specialistas" {{ old('position') == 'Personalo valdymo skyriaus specialistas' ? 'selected' : '' }}>Personalo valdymo skyriaus specialistas</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label class="col-md-2 col-form-label text-md-right">Lytis</label><br>
                    <div class="col-md-6">
                        <input type="radio" id="male" name="gender" value="Vyras" {{ old('gender') == 'Vyras' ? 'checked' : '' }}>
                        <label for="male">Vyras</label><br>

                        <input type="radio" id="female" name="gender" value="Moteris" {{ old('gender') == 'Moteris' ? 'checked' : '' }}>
                        <label for="female">Moteris</label><br>

                        <input type="radio" id="other" name="gender" value="Kita" {{ old('gender') == 'Kita' ? 'checked' : '' }}>
                        <label for="other">Kita</label><br>
                    </div>
                </div>


                <div class="form-group row create-row">
                    <label for="image" class="col-md-2 col-form-label text-md-right">Naudotojo nuotrauka</label>
                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" onchange="validateImage()">
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


                <h2 style="padding: 20px 0;">Darbo užmokesčio informacija</h2>

                <div class="form-group row create-row">
                    <label for="work_hours" class="col-md-2 col-form-label text-md-right">Darbo valandos per savaitę</label>
                    <div class="col-md-6">
                        <input id="work_hours" type="text" class="form-control @error('work_hours') is-invalid @enderror" name="work_hours" value="{{ old('work_hours') }}">
                        @error('work_hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="work_days" class="col-md-2 col-form-label text-md-right">Darbo dienos per savaitę</label>
                    <div class="col-md-6">
                        <input id="work_days" type="text" class="form-control @error('work_days') is-invalid @enderror" name="work_days" value="{{ old('work_days') }}">
                        @error('work_days')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="overtime" class="col-md-2 col-form-label text-md-right">Viršvalandžiai</label>
                    <div class="col-md-6">
                        <input id="overtime" type="text" class="form-control @error('overtime') is-invalid @enderror" name="overtime" value="{{ old('overtime') }}">
                        @error('overtime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="gross" class="col-md-2 col-form-label text-md-right">Bruto atlyginimas</label>
                    <div class="col-md-6">
                        <input id="gross" type="text" class="form-control @error('gross') is-invalid @enderror" name="gross" value="{{ old('gross') }}">
                        @error('gross')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- <div class="form-group row create-row">
                    <label for="net" class="col-md-2 col-form-label text-md-right">Neto atlyginimas</label>
                    <div class="col-md-6">
                        <input id="net" type="text" class="form-control @error('net') is-invalid @enderror" name="net" value="{{ old('net') }}" required autofocus>
                        @error('net')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> -->

                <div class="form-group row create-row">
                    <label for="info" class="col-md-2 col-form-label text-md-right">Papildoma informacija</label>
                    <div class="col-md-6">
                        <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ old('info') }}">
                        @error('info')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="user-create-button">
                    <button type="submit" class="btn btn-primary user-create-button-margin-right">
                        Sukurti
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary user-create-button-margin-left">
                        Atšaukti
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection