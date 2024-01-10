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
                <label for="first_name">Vardas:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Pavardė:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="email">El. Paštas:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Slaptažodis:</label>
                <input type="password" id="password" name="password" required>

                <div>
                    <label>Lytis</label><br>
                    <input type="radio" id="male" name="gender" value="Vyras">
                    <label for="male">Vyras</label><br>

                    <input type="radio" id="female" name="gender" value="Moteris">
                    <label for="female">Moteris</label><br>

                    <input type="radio" id="other" name="gender" value="Kita">
                    <label for="other">Kita</label><br>
                </div>

                <button type="submit" class="btn btn-primary">Sukurti</button>
            </form>

        </div>
    </div>
</div>
@endsection