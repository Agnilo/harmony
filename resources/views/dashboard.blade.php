@extends('layouts.web')

@section('content')
<div class="dashboard-content">
    <div class="dashboard-greeting">
        <h1>Sveiki, {{ $user->first_name }}!</h1>
        @auth
        @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superuser')))
            <p>Jūs esate prisijungęs kaip:
                @foreach($roles as $role)
                {{ $role->name }}
                @endforeach
            </p>
        @endif
        @endauth
    </div>

    <div class="container dashboard-container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Card 1 content -->
                        Content 1
                    </div>
                </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Card 2 content -->
                        Content 2
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Card 3 content -->
                        Content 3
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Card 4 content -->
                        Content 4
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Card 5 content -->
                        Content 5
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Card 6 content -->
                        Content 6
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection