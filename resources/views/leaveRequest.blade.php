@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="card-body card-body-index">
        <div>
            <a href="{{ route('leaveRequest.create') }}" class="btn btn-success leaveRequest-new-btn">Sukurti naują atostogų prašymą</a>
        </div>
        <div class="leaveRequest-header">
            <h2>Mano atostogų prašymai</h2>
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
                    <td>
                        @if($leaveRequest->leave_type == 'paid_leave')
                        Apmokamos
                        @elseif($leaveRequest->leave_type == 'unpaid_leave')
                        Neapmokamos
                        @endif
                    </td>
                    <td>{{ $leaveRequest->reason }}</td>
                    <td>{{ $leaveRequest->start_date }}</td>
                    <td>{{ $leaveRequest->end_date }}</td>
                    <td>
                        @if($leaveRequest->approval_status == 'pending')
                        Prašymas neperžiūrėtas
                        @elseif($leaveRequest->approval_status == 'approved')
                        Patvirtintas
                        @elseif($leaveRequest->approval_status == 'rejected')
                        Atmestas
                        @endif
                    </td>
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
</div>
@endsection