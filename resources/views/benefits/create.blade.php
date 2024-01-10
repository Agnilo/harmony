@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h1>Privalumai</h1>

    <form action="{{ route('benefits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="benefit-create-group">
            <label for="benefit_name">
                Privalumo pavadinimas
            </label>
            <input type="text" name="benefit_name" required>
        </div>
        <div class="benefit-create-group">
            <label for="description">
                Privalumo aprašymas
            </label>
            <textarea name="description" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="picture">
                Pasirinkti paveikslėlį
            </label>
            <input type="file" name="picture" class="form-control-file" id="picture">
        </div>
        <div class="benefit-create-group">
            <label for="price">
                Kaina
            </label>
            <input type="number" name="price" step="0.50" required>
        </div>
        <div class="benefit-create-show"> 
            Privalumo turinys naudotojui peržiūrint privalumą
        </div>
        <div class="benefit-create-group">
            <label for="introduction">
                Santrauka
            </label>
            <textarea name="introduction"></textarea>
        </div>
        <div class="benefit-create-group">
            <label for="content">
                Turinys
            </label>
            <textarea name="content"></textarea>
        </div> 
        <button type="submit">Sukurti privalumą</button>
    </form>
</div>
@endsection