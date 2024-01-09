@extends('layouts.web')

@section('content')
    <div class="dashboard-content">
        <h1>Sveiki, {{ $user->first_name }}!</h1>
        @auth
            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superuser')))
            <p>Jūs esate prisijungęs kaip: {{ $roles->name }}</p>
            @endif
        @endauth
        
    </div>
@endsection
