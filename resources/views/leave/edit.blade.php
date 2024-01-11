@extends('layouts.web')

@section('content')
<div class="web-child-content">
<h2>Edit Leave Request</h2>
        <form method="POST" action="{{ route('leaveRequest.update', $leaveRequest) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Leave Type -->
            <div class="form-group">
                <label for="leave_type">Leave Type</label>
                <select id="leave_type" name="leave_type" class="form-control">
                    <option value="paid_leave" {{ $leaveRequest->leave_type === 'paid_leave' ? 'selected' : '' }}>Paid Leave</option>
                    <option value="unpaid_leave" {{ $leaveRequest->leave_type === 'unpaid_leave' ? 'selected' : '' }}>Unpaid Leave</option>
                </select>
            </div>

            <!-- Reason -->
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" class="form-control" rows="3">{{ $leaveRequest->reason }}</textarea>
            </div>

            <!-- Start Date -->
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $leaveRequest->start_date }}">
            </div>

            <!-- End Date -->
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $leaveRequest->end_date }}">
            </div>

            <!-- Days -->
            <div class="form-group">
                <label for="days">Days</label>
                <input type="number" id="days" name="days" class="form-control" value="{{ $leaveRequest->days }}">
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="file_upload">File Upload</label>
                <input type="file" id="file_upload" name="file_upload" class="form-control-file">
            </div>

            <!-- Remarks -->
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ $leaveRequest->remarks }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Leave Request</button>
        </form>
</div>
@endsection