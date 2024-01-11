@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h2>Leave Requests Approval</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Prašymas</th>
                <th>Atostogų pradžia</th>
                <th>Atostogų pabaiga</th>
                <th>Prašymo statusas</th>
                <th>Veiksmai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveRequests as $leaveRequest)
            <tr>
                <td>{{ $leaveRequest->user->first_name }}</td>
                <td>{{ $leaveRequest->user->last_name }}</td>
                <td>{{ $leaveRequest->leaveRequest_name }}</td>
                <td>{{ $leaveRequest->start_date }}</td>
                <td>{{ $leaveRequest->end_date }}</td>
                <td>
                    @if($leaveRequest->approval_status === 'pending')
                    Prašymas neperžiūrėtas
                    @elseif($leaveRequest->approval_status === 'approved')
                    Patvirtintas
                    @elseif($leaveRequest->approval_status === 'rejected')
                    Atmestas
                    @else
                    -
                    @endif
                </td>
                <td>
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#details{{ $leaveRequest->id }}" aria-expanded="false" aria-controls="details{{ $leaveRequest->id }}">
                        Details
                    </button>
                    <form method="POST" action="{{ route('leaveRequests.updateApproval', $leaveRequest) }}" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <select name="approval_status">
                            <option value="pending" {{ $leaveRequest->approval_status === 'pending' ? 'selected' : '' }}>Prašymas neperžiūrėtas</option>
                            <option value="approved" {{ $leaveRequest->approval_status === 'approved' ? 'selected' : '' }}>Patvirtintas</option>
                            <option value="rejected" {{ $leaveRequest->approval_status === 'rejected' ? 'selected' : '' }}>Atmestas</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                    <div class="collapse" id="details{{ $leaveRequest->id }}">
                        <div class="card card-body">
                            <strong>Naudotojas:</strong> {{ $leaveRequest->user->first_name }} {{ $leaveRequest->user->last_name }}<br>
                            <strong>Prašymas:</strong> {{ $leaveRequest->leaveRequest_name }}<br>
                            <strong>Atostogų pradžia:</strong> {{ $leaveRequest->start_date }}<br>
                            <strong>Atostogų pabaiga:</strong> {{ $leaveRequest->end_date }}<br>
                            <strong>Prašymo statusas:</strong> {{ $leaveRequest->approval_status }}<br>
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