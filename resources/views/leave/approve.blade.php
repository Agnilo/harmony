@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="card-body card-body-index">
        <h2>Atostogų prašymų valdymas</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Vardas</th>
                    <th scope="col">Pavardė</th>
                    <th scope="col">Prašymas</th>
                    <th scope="col">Atostogų pradžia</th>
                    <th scope="col">Atostogų pabaiga</th>
                    <th scope="col">Prašymo statusas</th>
                    <th scope="col">Veiksmai</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($leaveRequests as $leaveRequest)
                <tr class="expandable-row" data-toggle="collapse" data-target="#details{{ $leaveRequest->id }}" aria-expanded="false" aria-controls="details{{ $leaveRequest->id }}">
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
                        Prašymas neperžiūrėtas
                        @endif
                    </td>
                    <td> Plačiau </td>
                    <!-- <td>

                         <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#details{{ $leaveRequest->id }}" aria-expanded="false" aria-controls="details{{ $leaveRequest->id }}">
                            Plačiau
                        </button>
                        <div class="collapse" id="details{{ $leaveRequest->id }}">
                            <div class="card card-body">
                                <strong>Naudotojas:</strong> {{ $leaveRequest->user->first_name }} {{ $leaveRequest->user->last_name }}<br>
                                <strong>Prašymas:</strong> {{ $leaveRequest->leaveRequest_name }}<br>
                                <strong>Atostogų pradžia:</strong> {{ $leaveRequest->start_date }}<br>
                                <strong>Atostogų pabaiga:</strong> {{ $leaveRequest->end_date }}<br>
                                <strong>Prašymo statusas:</strong>
                                @if($leaveRequest->approval_status === 'pending')
                                Prašymas neperžiūrėtas
                                @elseif($leaveRequest->approval_status === 'approved')
                                Patvirtintas
                                @elseif($leaveRequest->approval_status === 'rejected')
                                Atmestas
                                @else
                                Prašymas neperžiūrėtas
                                @endif<br>
                                
                            </div>
                        </div> 
                    </td>-->
                </tr>
                <tr class="collapse" id="details{{ $leaveRequest->id }}">
                    <td colspan="8">
                        <!-- Collapsible content goes here -->
                        <strong>Naudotojas:</strong> {{ $leaveRequest->user->first_name }} {{ $leaveRequest->user->last_name }}<br>
                        <strong>Prašymas:</strong> {{ $leaveRequest->leaveRequest_name }}<br>
                        <strong>Atostogų pradžia:</strong> {{ $leaveRequest->start_date }}<br>
                        <strong>Atostogų pabaiga:</strong> {{ $leaveRequest->end_date }}<br>
                        <strong>Prašymo statusas:</strong>
                        @if($leaveRequest->approval_status === 'pending')
                        Prašymas neperžiūrėtas
                        @elseif($leaveRequest->approval_status === 'approved')
                        Patvirtintas
                        @elseif($leaveRequest->approval_status === 'rejected')
                        Atmestas
                        @else
                        Prašymas neperžiūrėtas
                        @endif<br>
                        <!-- Add other leave request details as needed -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection