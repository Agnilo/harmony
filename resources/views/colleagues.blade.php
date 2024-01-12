@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="leaveRequest-header">
        <h5>Mano atostogų prašymai</h5>
    </div>
    <div class="row">
        @foreach($users as $user)
        <div class="col-md-3 mb-3 colleagues-card-bottom-margin">
            <div class="colleagues-card">
                <div class="colleagues-card-body">
                    <h5 class="colleagues-card-title">{{ $user->first_name }}</h5>
                    <p class="colleagues-card-text"><span style="font-weight: bold">El. Paštas:</span> {{ $user->email }}</p>
                    <p class="colleagues-card-text"><span style="font-weight: bold">Pareigos:</span> {{ $user->position }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection