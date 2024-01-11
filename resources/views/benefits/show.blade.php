@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="benefit-show-container">
        <div class="benefit-show-picture">
            <img src="{{ asset('storage/' . $benefit->picture) }}" alt="{{ $benefit->benefit_name }}" class="img-fluid benefit-show-img">
        </div>
        <div>
            <div class="row benefit-show-body">
                <div class="col-md-8 mb-8 benefit-show-card-text">
                    <div class="benefit-show-card-intro">
                        <p>{{ $benefit->introduction }}</p>
                    </div>
                    <div class="benefit-show-card-content">
                        <p>{{ $benefit->content }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 benefit-show-card-box">
                    <div class="benefit-show-card-body">
                        <div class="benefit-show-card-title">
                            <h5>{{ $benefit->benefit_name }}</h5>
                        </div>
                        <div class="benefit-show-card-price">
                            @if($benefit->price > 0)

                            @endif

                            <p><span style="font-weight: bold">Kaina:</span> {{ $benefit->price }} €</p>

                        </div>
                        <div class="benefit-show-button">
                            @auth
                            <form method="POST" action="{{ route('benefit.select', $benefit->id) }}">
                                @csrf

                                @if(auth()->user()->selectedBenefits->contains($benefit->id))
                                    <button class="btn btn-secondary" disabled>Pasirinktas</button>
                                @else
                                <button type="submit" class="btn btn-primary">Pasirinkti</button>
                                @endif
                            </form>
                            @endauth

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


</div>
@endsection