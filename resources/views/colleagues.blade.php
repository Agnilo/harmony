@extends('layouts.web')

@section('content')
<div class="web-child-content">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vardas</th>
                <th scope="col">Email</th>
                <th scope="col">Vaidmuo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->first_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-body">
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->firs_name }}</h5>
                        <p class="card-text">Email: {{ $user->email }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection