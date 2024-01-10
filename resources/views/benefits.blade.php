@extends('layouts.web')

@section('content')
<div class="web-child-content">

    @can('edit-benefit')
    <div class="create-new-user-button">
        <a href="{{ route('benefits.index') }}" class="btn btn-primary">
            Valdyti privalumus
        </a>
    </div>
    @endcan

    @foreach($benefits as $benefit)
    <div>
        <h2>{{ $benefit->benefit_name }}</h2>
        <p>{{ $benefit->description }}</p>
        <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" width="200">
        <p>Price: {{ $benefit->price }}</p>
    </div>
    @endforeach


    <div class="row">
        @foreach($users as $user)
        <div class="col-md-3 mb-3 colleagues-card-bottom-margin">
            <div class="colleagues-card">
                <div class="colleagues-card-body">
                    <h5 class="colleagues-card-title">{{ $benefit->benefit_name }}</h5>
                    <p class="colleagues-card-text">{{ $benefit->description }}</p>
                    <p class="colleagues-card-text"><span style="font-weight: bold">Kaina:</span> {{ $benefit->price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>
@endsection