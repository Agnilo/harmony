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
        @foreach($benefits as $benefit)
        <div class="col-md-4 mb-4 benefit-card-bottom-margin">
            <div class="benefit-card">
                <div class="card-header">
                    <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" class="img-fluid">
                </div>
                <div class="benefit-card-body">
                    <h5 class="benefit-card-title">{{ $benefit->benefit_name }}</h5>
                    <p class="benefit-card-text">{{ $benefit->description }}</p>
                    <p class="benefit-card-text"><span style="font-weight: bold">Kaina:</span> {{ $benefit->price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>
@endsection