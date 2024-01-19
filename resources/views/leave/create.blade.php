@extends('layouts.web')

@section('content')
<div class="web-child-content">
<h2>Sukurti atostogų prašymą</h2>
        <form method="POST" action="{{ route('leaveRequest.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Leave Name -->
            <div class="form-group">
                <label for="leaveRequest_name">Pavadinimas</label>
                <input type="text" id="leaveRequest_name" name="leaveRequest_name" class="form-control" rows="3">
            </div>

            <!-- Leave Type -->
            <div class="form-group">
                <label for="leave_type">Atostogų tipas</label>
                <select id="leave_type" name="leave_type" class="form-control">
                    <option value="paid_leave">Apmokamos atostogos</option>
                    <option value="unpaid_leave">Neapmokamos atostogos</option>
                </select>
            </div>

            <!-- Reason -->
            <div class="form-group">
                <label for="reason">Priežastis</label>
                <textarea id="reason" name="reason" class="form-control" rows="3"></textarea>
            </div>

            <!-- Start Date -->
            <div class="form-group">
                <label for="start_date">Pradžios data</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>

            <!-- End Date -->
            <div class="form-group">
                <label for="end_date">Pabaigos data</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="file_upload">Įkelti failą</label>
                <input type="file" id="file_upload" name="file_upload" class="form-control-file">
            </div>

            <!-- Remarks -->
            <div class="form-group">
                <label for="remarks">Komentarai</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Sukurti</button>
        </form>
</div>
@endsection