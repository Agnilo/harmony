@extends('layouts.web')

@section('content')
<div class="web-child-content">
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-3 mb-3 colleagues-card-bottom-margin">
                <div class="card">
                    <div class="colleagues-card-body">
                        <h5 class="colleagues-card-title">{{ $user->first_name }}</h5>
                        <p class="colleagues-card-text">El. Paštas: {{ $user->email }}</p>
                        <p class="colleagues-card-text">Pareigos: {{ $user->position }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</div>
@endsection