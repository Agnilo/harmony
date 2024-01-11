@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h2>Leave Requests Approval</h2>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Leave Request Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Approval Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveRequests as $leaveRequest)
                <tr>
                    <td>{{ $leaveRequest->user->first_name }}</td>
                    <td>{{ $leaveRequest->leaveRequest_name }}</td>
                    <td>{{ $leaveRequest->start_date }}</td>
                    <td>{{ $leaveRequest->end_date }}</td>
                    <td>{{ $leaveRequest->approval_status }}</td>
                    <td>
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#details{{ $leaveRequest->id }}" aria-expanded="false" aria-controls="details{{ $leaveRequest->id }}">
                            Details
                        </button>
                        <form method="POST" action="{{ route('leaveRequests.updateApproval', $leaveRequest) }}" style="display: inline-block;">
                            @csrf
                            @method('put')
                            <select name="approval_status">
                                <option value="pending" {{ $leaveRequest->approval_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $leaveRequest->approval_status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $leaveRequest->approval_status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <div class="collapse" id="details{{ $leaveRequest->id }}">
                            <div class="card card-body">
                                <strong>User:</strong> {{ $leaveRequest->user->first_name }} {{ $leaveRequest->user->last_name }}<br>
                                <strong>Leave Request Name:</strong> {{ $leaveRequest->leaveRequest_name }}<br>
                                <strong>Start Date:</strong> {{ $leaveRequest->start_date }}<br>
                                <strong>End Date:</strong> {{ $leaveRequest->end_date }}<br>
                                <strong>Approval Status:</strong> {{ $leaveRequest->approval_status }}<br>
                                <!-- Add other leave request details as needed -->
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection