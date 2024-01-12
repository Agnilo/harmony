@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="create-benefit-header">

            <h2>Redaguoti privalumą</h2>

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

                <div class="form-group row">
                    <label for="introduction" class="col-md-2 col-form-label text-md-right">Santrauka</label>

                    <div class="col-md-6">
                        <input id="introduction" type="textarea" class="form-control @error('introduction') is-invalid @enderror resizable-textarea textarea-style" name="introduction" value="{{ $benefit->introduction }}" autofocus>

                        @error('introduction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label text-md-right">Turinys</label>

                    <div class="col-md-6">
                        <input id="content" type="textarea" class="form-control @error('content') is-invalid @enderror resizable-textarea textarea-style" name="content" value="{{ $benefit->content }}" autofocus>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @csrf
                {{method_field('PUT') }}

                <div class="form-group row">
                    <label for="picture" class="col-md-2 col-form-label text-md-right">Paveikslėlis</label>

                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" class="benefit-image" width="200">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new_picture" class="col-md-2 col-form-label text-md-right">Naujas paveikslėlis</label>

                    <div class="col-md-6">
                        <label for="new_picture" class="d-block">Įkelti naują paveikslėlį:</label>
                        <input type="file" id="new_picture" name="new_picture" class="form-control-file @error('new_picture') is-invalid @enderror">

                        @error('new_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-md-2 col-form-label text-md-right">Kaina</label>

                    <div class="col-md-6">
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $benefit->price }}" autofocus>

                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary user-create-button-margin-right">
                            Atnaujinti
                        </button>
                        <a href="{{ route('benefits.index') }}" class="btn btn-primary user-create-button-margin-left">
                            Grįžti atgal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection