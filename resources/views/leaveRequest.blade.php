@extends('layouts.web')

@section('content')
    <div class="card-body card-body-index">
        <div>
        <a href="{{ route('leaveRequest.create') }}" class="btn btn-success">Sukurti naują atostogų prašymą</a>
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
                            <a href="{{ route('leaveRequest.edit', $leaveRequest) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('leaveRequest.destroy', $leaveRequest) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this leave request?')">Delete</button>
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