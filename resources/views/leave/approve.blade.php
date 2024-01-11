@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h2>Leave Requests Approval</h2>

    <table>
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
                    <form method="post" action="{{ route('leaveRequests.updateApproval', $leaveRequest) }}">
                        @csrf
                        @method('put')
                        <select name="approval_status">
                            <option value="pending" {{ $leaveRequest->approval_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $leaveRequest->approval_status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $leaveRequest->approval_status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection