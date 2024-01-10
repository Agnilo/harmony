@extends('layouts.web')

@section('content')
<div class="web-child-content">


    <div class="row">
        <div class="col-md-4 mb-4 benefit-card-bottom-margin">
            <div class="benefit-card">
                <div class="benefit-card-header">
                    <img src="{{ asset('storage/' . $benefits->picture) }}" alt="{{ $benefits->benefit_name }}" class="img-fluid benefit-img">
                </div>
                <div class="benefit-card-body">
                    <h5 class="benefit-card-title">{{ $benefits->benefit_name }}</h5>
                    <p class="benefit-card-text">{{ $benefits->description }}</p>
                </div>
                <div class="benefit-card-footer">
                @if($benefit->price > 0)
                    <p><span style="font-weight: bold">Kaina:</span> {{ $benefits->price }} €</p>
                @endif
                </div>
            </div>
        </div>
    </div>

    


</div>
@endsection