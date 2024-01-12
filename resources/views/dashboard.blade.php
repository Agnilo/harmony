@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <div class="dashboard-greeting">
        <h1>Sveiki, {{ $user->first_name }}!</h1>

        @can('edit-users')
            <p>Jūs esate prisijungęs kaip:
                @foreach($roles as $role)
                {{ $role->name }}
                @endforeach
            </p>
        @endcan

    </div>

    <div class="container dashboard-container">
        <div class="row dashboard-row">
            <img src="{{ asset('images/brandLogo.png') }}" alt="Example Image" class="dashboard-img">
        </div>
    </div>


</div>
@endsection