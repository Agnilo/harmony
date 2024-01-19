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

                <!-- Leave Name
                <div class="form-group">
                    <label for="leaveRequest_name">Pavadinimas</label>
                    <input type="text" id="leaveRequest_name" name="leaveRequest_name" class="form-control" value="{{ $leaveRequest->leaveRequest_name }}">
                </div> -->

                <div class="form-group row">
                    <label for="leaveRequest_name" class="col-md-2 col-form-label text-md-right">Pavadinimas</label>

                    <div class="col-md-6">
                        <input id="leaveRequest_name" type="text" class="form-control @error('leaveRequest_name') is-invalid @enderror" name="leaveRequest_name" value="{{ $leaveRequest->leaveRequest_name }}" required autofocus>

                        @error('leaveRequest_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Leave Type -->
                <div class="form-group">
                    <label for="leave_type">Atostogų tipas</label>
                    <select id="leave_type" name="leave_type" class="form-control">
                        <option value="paid_leave" {{ $leaveRequest->leave_type === 'paid_leave' ? 'selected' : '' }}>Apmokamos atostogos</option>
                        <option value="unpaid_leave" {{ $leaveRequest->leave_type === 'unpaid_leave' ? 'selected' : '' }}>Neapmokamos atostogos</option>
                    </select>
                </div>

                <!-- Reason -->
                <div class="form-group">
                    <label for="reason">Priežastis</label>
                    <textarea id="reason" name="reason" class="form-control" rows="3">{{ $leaveRequest->reason }}</textarea>
                </div>

                <!-- Start Date -->
                <div class="form-group">
                    <label for="start_date">Pradžios data</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $leaveRequest->start_date }}">
                </div>

                <!-- End Date -->
                <div class="form-group">
                    <label for="end_date">Pabaigos data</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $leaveRequest->end_date }}">
                </div>

                <!-- Days -->
                <div class="form-group">
                    <label for="days">Dienos</label>
                    <input type="number" id="days" name="days" class="form-control" value="{{ $leaveRequest->days }}" readonly>
                </div>

                <!-- File Upload -->
                <div class="form-group">
                    <label for="file_upload">Įkelti failą</label>
                    <input type="file" id="file_upload" name="file_upload" class="form-control-file">
                </div>

                <!-- Remarks -->
                <div class="form-group">
                    <label for="remarks">Komentarai</label>
                    <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ $leaveRequest->remarks }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Atnaujinti</button>
            </form>
        </div>
    </div>
</div>
@endsection