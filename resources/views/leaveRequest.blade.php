@extends('layouts.web')

@section('content')
<div class="web-child-content">
    @foreach ($leaveRequests as $leaveRequest)
    <p>{{ $leaveRequest->reason }}</p>
    <p>{{ $leaveRequest->user->first_name }}</p>
    <p>{{ $leaveRequest->user->approval_status }}</p>
    <!-- Add more details as needed -->

    <!-- Buttons for each leave request -->
    <div class="buttons">
        <a href="{{ route('leaveRequest.edit', $leaveRequest) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('leaveRequest.destroy', $leaveRequest) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this leave request?')">Delete</button>
        </form>
    </div>
    @endforeach

    <!-- Button to create a new leave request -->
    <a href="{{ route('leaveRequest.create') }}" class="btn btn-success">Create New Leave Request</a>
</div>
@endsection