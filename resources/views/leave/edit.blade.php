@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="container">
        <div class="create-benefit-header">

            <h2>Redaguoti atostogų prašymą</h2>

        </div>
        <div class="card-body card-body-index">
            <form method="POST" action="{{ route('leaveRequest.update', $leaveRequest) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="leaveRequest_name" class="col-md-2 col-form-label text-md-right">Pavadinimas</label>

                    <div class="col-md-6">
                        <input id="leaveRequest_name" type="text" class="form-control @error('leaveRequest_name') is-invalid @enderror" name="leaveRequest_name" value="{{ $leaveRequest->leaveRequest_name }}" required>

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
                        <select id="leave_type" name="leave_type" class="form-control @error('leave_type') is-invalid @enderror">
                            <option value="paid_leave" {{ $leaveRequest->leave_type === 'paid_leave' ? 'selected' : '' }}>Apmokamos atostogos</option>
                            <option value="unpaid_leave" {{ $leaveRequest->leave_type === 'unpaid_leave' ? 'selected' : '' }}>Neapmokamos atostogos</option>
                        </select>

                        @error('leave_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="reason" class="col-md-2 col-form-label text-md-right">Pavadinimas</label>

                    <div class="col-md-6">
                        <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" value="{{ $leaveRequest->reason }}" required>

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
                        <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ $leaveRequest->start_date }}" required>

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
                        <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ $leaveRequest->end_date }}" required>

                        @error('end_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="days" class="col-md-2 col-form-label text-md-right">Dienos</label>

                    <div class="col-md-6">
                        <input id="days" type="number" class="form-control" name="days" value="{{ $leaveRequest->days }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file_upload" class="col-md-2 col-form-label text-md-right">Įkelti failą</label>

                    <div class="col-md-6">
                        <input id="file_upload" type="file" class="form-control-file" name="file_upload" onchange="validateFile(this)">


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
                        <textarea id="remarks" name="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="3">{{ $leaveRequest->remarks }}</textarea>

                        @error('remarks')
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
                        <a href="{{ route('leaveRequest') }}" class="btn btn-primary user-create-button-margin-left">
                            Grįžti atgal
                        </a>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
@endsection