@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">

        <div class="create-benefit-header">
            <h2>Privalumas</h2>
        </div>

        <form action="{{ route('benefits.store') }}" method="POST" enctype="multipart/form-data" class="benefit-create-form">
            @csrf

            <div class="form-group row">
                <label for="benefit_name" class="col-md-2 col-form-label text-md-right">Privalumo pavadinimas:</label>
                <div class="col-md-6">
                    <input type="text" name="benefit_name" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label text-md-right">Privalumo aprašymas:</label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="picture" class="col-md-2 col-form-label text-md-right">Pasirinkti paveikslėlį:</label>
                <div class="col-md-6">
                    <input type="file" name="picture" class="form-control-file" id="picture">
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-2 col-form-label text-md-right">Kaina:</label>
                <div class="col-md-6">
                    <input type="number" name="price" step="0.50" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-6 benefit-create-show">
                    Privalumo turinys naudotojui peržiūrint privalumą
                </div>
            </div>

            <div class="form-group row">
                <label for="introduction" class="col-md-2 col-form-label text-md-right">Santrauka:</label>
                <div class="col-md-6">
                    <textarea name="introduction" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-2 col-form-label text-md-right">Turinys:</label>
                <div class="col-md-6">
                    <textarea name="content" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Sukurti privalumą</button>
                    <a href="{{ route('benefits.index') }}" class="btn btn-secondary">Grįžti</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection