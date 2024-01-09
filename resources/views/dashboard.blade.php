@extends('layouts.web')

@section('content')
<div class="dashboard-content">
    <h1>Sveiki, {{ $user->first_name }}!</h1>
    @auth
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superuser')))
    <p>Jūs esate prisijungęs kaip: 
        @foreach($roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </p>
    @endif
    @endauth

</div>
@endsection