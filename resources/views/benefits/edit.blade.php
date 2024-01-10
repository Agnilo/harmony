@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto h2-padding">
                <h2>Redaguoti privalumą {{$benefit->benefit_name}}</h2>
            </div>
        </div>
        <div class="card-body card-body-index">
            <form action="{{route('benefits.update', $benefit) }}" method="POST" enctype="multipart/form-data">

                <div class="form-group row">
                    <label for="benefit_name" class="col-md-2 col-form-label text-md-right">Pavadinimas</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="benefit_name" value="{{ $benefit->benefit_name }}" required autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-2 col-form-label text-md-right">Aprašymas</label>

                    <div class="col-md-6">
                        <input id="description" type="textarea" rows="4" cols="50" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $benefit->description }}" required autofocus>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @csrf
                {{method_field('PUT') }}

                <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" width="200">

                <div>
                    <label for="picture">Įkelti paveikslėlį:</label>
                    <input type="file" id="picture" name="picture">
                </div>

                <div>
                    <label for="price">Kaina:</label>
                    <input type="number" id="price" name="price" value="{{ $benefit->price }}">
                </div>

                <button type="submit" class="btn btn-primary user-create-button-margin-right">
                    Atnaujinti
                </button>
                <a href="{{ route('benefits.index') }}" class="btn btn-primary user-create-button-margin-left">
                    Grįžti atgal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection