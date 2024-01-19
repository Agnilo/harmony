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
                    <input type="text" name="benefit_name" class="form-control @error('benefit_name') is-invalid @enderror">
                    @error('benefit_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label text-md-right">Privalumo aprašymas:</label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="picture" class="col-md-2 col-form-label text-md-right">Pasirinkti paveikslėlį:</label>
                <div class="col-md-6">
                    <input type="file" name="picture" class="form-control-file" id="picture" onchange="validateImage()">
                    <script>
                        function validateImage() {
                            var fileInput = document.getElementById('picture');
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
                <label for="price" class="col-md-2 col-form-label text-md-right">Kaina:</label>
                <div class="col-md-6">
                    <input type="number" name="price" step="0.50" class="form-control @error('price') is-invalid @enderror" value="0.00">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
                    <a href="{{ route('benefits.index') }}" class="btn btn-primary">Atšaukti</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection