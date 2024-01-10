@extends('layouts.web')

@section('content')
<div class="web-child-content">


    <div class="row">
        <div class="col-md-4 mb-4 benefit-card-bottom-margin">
            <div class="benefit-card">
                <div class="benefit-card-header">
                    <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" class="img-fluid benefit-img">
                </div>
                <div class="benefit-card-body">
                    <h5 class="benefit-card-title">{{ $benefit->benefit_name }}</h5>
                    <p class="benefit-card-text">{{ $benefit->description }}</p>
                </div>
                <div class="benefit-card-footer">
                @if($benefit->price > 0)
                    <p><span style="font-weight: bold">Kaina:</span> {{ $benefit->price }} €</p>
                @endif
                </div>
            </div>
        </div>
    </div>


</div>
@endsection