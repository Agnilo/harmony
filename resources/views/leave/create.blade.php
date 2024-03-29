@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="create-benefit-header">

            <h2>Sukurti atostogų prašymą</h2>

        </div>

        <form method="POST" action="{{ route('leaveRequest.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="leaveRequest_name" class="col-md-2 col-form-label text-md-right">Pavadinimas</label>
                <div class="col-md-6">
                    <input type="text" id="leaveRequest_name" name="leaveRequest_name" class="form-control @error('leaveRequest_name') is-invalid @enderror">
                    @error('leaveRequest_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="leave_type" class="col-md-2 col-form-label text-md-right">Atostogų tipas</label>
                <div class="col-md-6">
                    <select id="leave_type" name="leave_type" class="form-control">
                        <option value="paid_leave">Apmokamos atostogos</option>
                        <option value="unpaid_leave">Neapmokamos atostogos</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="reason" class="col-md-2 col-form-label text-md-right">Priežastis</label>
                <div class="col-md-6">
                    <input type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror">
                    @error('reason')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="start_date" class="col-md-2 col-form-label text-md-right">Pradžios data</label>
                <div class="col-md-6">
                    <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror">
                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="end_date" class="col-md-2 col-form-label text-md-right">Pabaigos data</label>
                <div class="col-md-6">
                    <input type="date" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror">
                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="file_upload" class="col-md-2 col-form-label text-md-right">Įkelti failą</label>
                <div class="col-md-6">
                    <input type="file" name="file_upload" class="form-control-file" id="file_upload" onchange="validateFile(this)">

                    <script>
                        function validateFile(fileInput) {
                            var maxSize = 2048 * 1024;
                            if (fileInput.files && fileInput.files[0].size > maxSize) {
                                alert('Pasirinktas failas yra per didelis. Leistinas dydis 2MB.');
                                fileInput.value = '';
                                return false;
                            }

                            var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                            if (fileInput.files && allowedTypes.indexOf(fileInput.files[0].type) === -1) {
                                alert('Galima įkelti tik šio tipo failus: pdf, doc, docx.');
                                fileInput.value = '';
                                return false;
                            }

                            return true;
                        }
                    </script>
                </div>
            </div>

            <div class="form-group row">
                <label for="remarks" class="col-md-2 col-form-label text-md-right">Komentarai</label>
                <div class="col-md-6">
                    <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Sukurti</button>
                    <a href="{{ route('leaveRequest') }}" class="btn btn-primary">Atšaukti</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection