@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto h2-padding">
                <h2>Sukurti naują naudotoją</h2>
            </div>
        </div>
        <div class="card-body card-body-index">

            <form method="POST" action="{{ route('admin.users.store') }}" class="card-body-layout-flex">
                @csrf
                <div class="form-group row create-row">
                    <label for="first_name" class="col-md-2 col-form-label text-md-right">Vardas:</label>
                    <div class="col-md-6">
                        <input class="form-control type=" text" id="first_name" name="first_name" required>
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="last_name" class="col-md-2 col-form-label text-md-right">Pavardė:</label>
                    <div class="col-md-6">
                        <input class="form-control type=" text" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">El. Paštas:</label>
                    <div class="col-md-6">
                        <input class="form-control type=" email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label for="password" class="col-md-2 col-form-label text-md-right">Slaptažodis:</label>
                    <div class="col-md-6">
                        <input class="form-control type=" password" id="password" name="password" required>
                    </div>
                </div>

                <div class="form-group row create-row">
                    <label class="col-md-2 col-form-label text-md-right">Lytis</label><br>
                    <div class="col-md-6">
                        <input type="radio" id="male" name="gender" value="Vyras">
                        <label for="male">Vyras</label><br>

                        <input type="radio" id="female" name="gender" value="Moteris">
                        <label for="female">Moteris</label><br>

                        <input type="radio" id="other" name="gender" value="Kita">
                        <label for="other">Kita</label><br>
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