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
                    <input type="text" id="leaveRequest_name" name="leaveRequest_name" class="form-control" required>
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
                    <input type="text" id="reason" name="reason" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="start_date" class="col-md-2 col-form-label text-md-right">Pradžios data</label>
                <div class="col-md-6">
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="end_date" class="col-md-2 col-form-label text-md-right">Pabaigos data</label>
                <div class="col-md-6">
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="file_upload" class="col-md-2 col-form-label text-md-right">Įkelti failą</label>
                <div class="col-md-6">
                    <input type="file" name="file_upload" class="form-control-file" id="file_upload">
                </div>
            </div>

            <div class="form-group row">
                <label for="remarks" class="col-md-2 col-form-label text-md-right">Komentarai</label>
                <div class="col-md-6">
                    <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <!-- <button type="submit" class="btn btn-primary">Sukurti</button> -->

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