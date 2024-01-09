@extends('layouts.web')

@section('content')
    <div>
    <h1>Welcome, {{ $user->first_name }}</h1>
<p>Email: {{ $user->email }}</p>
    </div>
@endsection
