@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <h1>Privalumai</h1>

    @foreach($benefits as $benefit)
    <div>
        <h2>{{ $benefit->benefit_name }}</h2>
        <p>{{ $benefit->description }}</p>
        <img src="{{ $benefit->picture }}" alt="{{ $benefit->benefit_name }}">
        <p>Price: {{ $benefit->price }}</p>
    </div>
    @endforeach
</div>
@endsection