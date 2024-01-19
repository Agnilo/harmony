@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h2>Edit Leave Request</h2>
    <form method="POST" action="{{ route('leaveRequest.update', $leaveRequest) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Leave Name -->
        <div class="form-group">
            <label for="leaveRequest_name">Pavadinimas</label>
            <input type="text" id="leaveRequest_name" name="leaveRequest_name" class="form-control" value="{{ $leaveRequest->leaveRequest_name }}"> 
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
@endsection