@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="card-body card-body-index">
        <div class="leaveRequest-new-btn">
            <a href="{{ route('leaveRequest.create') }}" class="btn btn-success">Sukurti naują atostogų prašymą</a>
        </div>
        <div class="leaveRequest-header">
            Mano atostogų prašymai
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Pavadinimas</th>
                    <th scope="col">Atostogų tipas</th>
                    <th scope="col">Priežastis</th>
                    <th scope="col">Pradžios data</th>
                    <th scope="col">Pabaigos data</th>
                    <th scope="col">Statusas</th>
                    <th scope="col">Veiksmai</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($leaveRequests as $leaveRequest)
                <tr>
                    <th scope="row">{{ $leaveRequest->leaveRequest_name }}</th>
                    <td>{{ $leaveRequest->leave_type }}</td>
                    <td>{{ $leaveRequest->reason }}</td>
                    <td>{{ $leaveRequest->start_date }}</td>
                    <td>{{ $leaveRequest->end_date }}</td>
                    <td>{{ $leaveRequest->approval_status }}</td>
                    <td class="user-buttons">
                        <div class="buttons">
                            <a href="{{ route('leaveRequest.edit', $leaveRequest) }}" class="btn btn-primary">Redaguoti</a>
                            <form action="{{ route('leaveRequest.destroy', $leaveRequest) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti?')">Ištrinti</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Button to create a new leave request -->
    <p><a href="{{ route('leaveRequests.approve') }}">Approve Leave Requests</a></p>
</div>
@endsection