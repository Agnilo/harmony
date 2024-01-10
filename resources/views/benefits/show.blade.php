@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="benefit-show-container">
        <div class="benefit-show-picture">
            <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" class="img-fluid benefit-show-img">
        </div>
        <div>
            <div class="row benefit-show-body">
                <div class="col-md-8 mb-8">

                </div>
                <div class="col-md-4 mb-4">
                    <div class="benefit-show-card-body">
                        <div class="benefit-show-card-title">
                            <h5>{{ $benefit->benefit_name }}</h5>
                        </div>
                        <div class="benefit-show-card-price">
                            @if($benefit->price > 0)
                            <p><span style="font-weight: bold">Kaina:</span> {{ $benefit->price }} €</p>
                            @endif
                        </div>
                        <div class="benefit-show-button">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


</div>
@endsection