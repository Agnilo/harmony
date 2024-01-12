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
                        Prašymas neperžiūrėtas
                        @endif
                    </td>
                    <td class="user-buttons">
                        <form method="POST" action="{{ route('leaveRequests.updateApproval', $leaveRequest) }}" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <select name="approval_status">
                                <option value="pending" {{ $leaveRequest->approval_status === 'pending' ? 'selected' : '' }}>Prašymas neperžiūrėtas</option>
                                <option value="approved" {{ $leaveRequest->approval_status === 'approved' ? 'selected' : '' }}>Patvirtintas</option>
                                <option value="rejected" {{ $leaveRequest->approval_status === 'rejected' ? 'selected' : '' }}>Atmestas</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Atnaujinti</button>
                        </form>
                    </td>
                    <td class="expandable-row expand-element" data-toggle="collapse" data-target="#details{{ $leaveRequest->id }}" aria-expanded="false" aria-controls="details{{ $leaveRequest->id }}">
                        Plačiau
                    </td>
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